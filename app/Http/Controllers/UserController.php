<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItems;
use App\Models\Vendor;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        $columns = ['id', 'name', 'email', 'mobile'];
        $tableName = 'user';
        return view('admin.pages.user.index', compact('users', 'columns', 'tableName'));
    }

    public function wishlist(Product $product){
        $wishlist= Wishlist::where('user_id',Session::get('userId'))->where('product_id',$product->id)->first();
        if($wishlist){
            $wishlist->delete();
        } else{
            $wishlist= Wishlist::firstOrCreate([
                'user_id'=>Session::get('userId'),
                'product_id'=>$product->id,
            ]);
        }
    }

    public function add()
    {
        $tableName = 'user';
        return view('admin.pages.user.add', compact('tableName'));
    }

    public function store()
    {
        if(request('loginType')){
            $data = request()->validate([
                'name' => 'required',
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required'],
                'mobile' => ['required', 'numeric', 'digits:10'],
            ]);
            $hashedPassword = Hash::make(request()->password);
            $data = array_merge(
                $data,
                ['password' => $hashedPassword]
            );
            User::create($data);
            if (request()->session()->has('loginId')) {
                return redirect('/admin/user')
                    ->with('alert-type','success')
                    ->with('message', 'added Successfully');
            }
            return $this->check();
        } else {
            $data = request()->validate([
                'name'=>'required',
                'email'=>'required|unique:vendor|email',
                'mobile'=>'required|numeric|digits:10',
                'password'=>'required'
            ]);
            $hashedPassword = Hash::make(request()->password);
            $data = array_merge(
                $data,
                ['password'=>$hashedPassword]
            );
            Vendor::create($data);
            return redirect('/vendor/')
                    ->with('alert-type','success')
                    ->with('message','Added Successfully');
        }
    }

    public function edit(User $user)
    {
        return view('admin.pages.user.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'mobile' => ['required', 'numeric', 'digits:10'],
        ]);
        $user->update($data);
        $users = User::get();
        if (Session::has('userId'))
            Session::put('userName', $data['name']);
        if (request()->session()->has('loginId')) {
            return redirect('/admin/user')
                    ->with('alert-type','success')
                    ->with('message', 'Updated Successfully');
        }
        $addresses = request('address');
        if (request('address')) {
            if (Address::whereIn('user_id', [Session::get('userId')])->first()) {
                $prevAddresses = Address::whereIn('user_id', [Session::get('userId')])->get();
                if (count($addresses) < count($prevAddresses)) {
                    DB::delete('delete from address where user_id = ?', [Session::get('userId')]);
                }
                $prevAddresses = Address::whereIn('user_id', [Session::get('userId')])->get();
                for ($i = 0; $i < count($prevAddresses); $i++) {
                    DB::update('update address set address = ? where id = ?', [$addresses[$i], $prevAddresses[$i]->id]);
                }
                $this->addNewAddress(count($prevAddresses),$addresses);
            } else {
                $this->addNewAddress(0,$addresses);
            }
        }
        return redirect('/profile')
                ->with('alert-type','success')
                ->with('message','Updedted Successfully');
    }

    public function addNewAddress($index=0,$addresses=[])
    {
        $len= strlen(request()->url());
        for ($i = $index; $i < count($addresses); $i++) {
            DB::insert('insert into address (address_number, user_id, address) values (?, ?, ?)', [$i + 1, Session::get('userId'), $addresses[$i]]);
        }
        if(substr(request()->url(),$len-12,$len-1)=="/add/address"){
            $addresses= request('address');
            DB::insert('insert into address (address_number, user_id, address) values (?, ?, ?)', [$i + 1, Session::get('userId'), $addresses]);
            return redirect('/checkoutAddress');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/user')
                ->with('alert-type','error')
                ->with('message', 'Deleted Successfully');
    }

    public function check()
    {
        $data = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', '=', $data['email'])->first();
        if ($user) {
            if (Hash::check($data['password'], $user['password'])) {
                request()->session()->put('userId', $user->id);
                request()->session()->put('userName', $user->name);
                return redirect(url()->previous())
                    ->with('alert-type','success')
                    ->with('message','Login Successfully');
            } else {
                return redirect('/login')
                        ->with('message', 'Password is Wrong')
                        ->with('color', 'danger');
            }
        } else {
            return redirect('/login')
                        ->with('message', 'email is not registered')
                        ->with('color', 'danger');
        }
    }

    public static function isUser()
    {
        if (Session::has('userId')) {
            return true;
        }
        return false;
    }

    public function profile()
    {
        $user = $this->getUser(Session::get('userId'));
        return view('pages.profile', compact('user'));
    }

    public function wallet()
    {
        return view('pages.wallet');
    }

    public function orderHistory()
    {
        $tableName = 'Order History';
        $orders= Order::whereIn('user_id',[Session::get('userId')])->get();
        $status= ['pending'=>'pending',
                    'dispatch'=>'Ready To Dispatch',
                    'onWay'=>'On The Way',
                    'arrived'=>'Arrived Final Destination',
                    'delivered'=>'Product Delivered',
                    'delivery'=>'Out for delivery',
                    'cancelled'=>'Cancelled',
                    'rejected'=>'Rejected'];
        for($i=0;$i<count($orders);$i++){
            $orders[$i]['orderId']= $orders[$i]['order_items_id'];
            $orders[$i]['product']= Product::find($orders[$i]['product_id'])->name;
            $orders[$i]['status']= $status[$orders[$i]['status']];
        }
        $columns = ['Products', 'total', 'time','status'];
        $color= true;
        return view('pages.orderHistory', compact('tableName', 'columns', 'orders','color'));
    }

    public static function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/')
                ->with('alert-type','error')
                ->with('message','Successfully Logout');
    }
}
