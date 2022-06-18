<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Session;

class VendorController extends Controller
{
    public function edit()
    {
        $vendor= Vendor::find(Session::get('vendorId'));
        return view('vendor.pages.dashboard.edit',compact('vendor'));
    }

    public function update()
    {
        $vendor= Vendor::find(Session::get('vendorId'));
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:vendor,email,'.$vendor->id,
            'mobile'=>'required|numeric|digits:10',
            'image'=>'',
            'shop_name'=>'required',
            'shop_address'=>'required'
        ]);
        if (request('image') != null) {
            if($vendor->image!=null){
                $filePath = public_path() . $vendor->image;
                File::delete($filePath);
            }
            $imagePath = request('image')->store('vendor', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(275, 183);
            $image->save();
            $imagePath = "/storage/" . $imagePath;
            $data = array_merge(
                $data,
                ['image' => $imagePath]
            );
        }
        Session::put('vendorName',$data['name']);
        $vendor->update($data);
        return redirect('/vendor/dashboard')
                ->with('alert-type','success')
                ->with('message','Details Updated Successfully');
    }

    public function view(){
        $vendor= Vendor::find(Session::get('vendorId'));

        $ordersCount= Order::where('vendor_id',$vendor->id)->count();
        $productsCount= $vendor->product->count();
        return view('vendor.pages.index',compact('vendor','ordersCount','productsCount'));
    }

    public function signup(){
        return view('vendor.pages.signup');
    }

    public function signin(){
        return view('vendor.pages.login');
    }

    public function check(){
        $data = request()->validate([
            'email'=>'required',
            'password'=>'required',  
        ]);
        $vendor = Vendor::where('email','=',$data['email'])->first();
        if($vendor)
        {
            if(Hash::check($data['password'], $vendor['password']))
            {
                request()->session()->put('vendorId',$vendor->id);
                request()->session()->put('vendorName',$vendor->name);
                return redirect('/vendor/dashboard')
                        ->with('alert-type','success')
                        ->with('message','Login Successfully');
            }
            else
            {
                return redirect('/vendor')
                        ->with('alert-type','error')
                        ->with('message','Password is Wrong');
            }
        }
        else
        {
            return redirect('/vendor')
                    ->with('alert-type','error')
                    ->with('message','E-mail is not Registered');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/')
                ->with('alert-type','error')
                ->with('message','Logout Successfully');
    }
}
