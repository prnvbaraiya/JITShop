<?php

namespace App\Http\Controllers;

use \App\Models\PaymentMethod;
use \App\Models\Address;
use \App\Models\Cart;
use \App\Models\Product;
use \App\Models\OrderItems;
use \App\Models\Order;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Session;

class PaymentMethodController extends Controller
{

    public function index()
    {
        $paymentMethods = PaymentMethod::get();
        $columns = ['id', 'name', 'available', 'Edit', 'Delete'];
        $tableName = 'paymentMethod';
        return view('admin.pages.paymentMethod.index', compact('paymentMethods', 'columns', 'tableName'));
    }

    public function add()
    {
        return view('admin.pages.paymentMethod.add');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'available' => ''
        ]);
        if (isset($_POST['available'])) {
            $data = array_merge(
                $data,
                ['available' => '1']
            );
        } else {
            $data = array_merge(
                $data,
                ['available' => '0']
            );
        }
        PaymentMethod::create($data);
        return redirect('/admin/paymentMethod')->with('message', 'added Successfully');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.pages.paymentMethod.edit', compact('paymentMethod'));
    }

    public function update(PaymentMethod $paymentMethod)
    {
        $data = request()->all();
        request()->validate([
            'name' => 'required',
            'available' => ''
        ]);
        if (isset($_POST['available'])) {
            $data = array_merge(
                $data,
                ['available' => '1']
            );
        } else {
            $data = array_merge(
                $data,
                ['available' => '0']
            );
        }
        $paymentMethod->update($data);
        $paymentMethods = PaymentMethod::get();
        return redirect('/admin/paymentMethod')->with('message', 'Updated Successfully');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect('/admin/paymentMethod')->with('danger-message', 'Deleted Successfully');
    }

    public function show()
    {
        $address = Address::find(request('address'));
        $paymentMethods = PaymentMethod::get();
        return view('pages.paymentMethod', compact('address', 'paymentMethods'));
    }

    public function makeOrder()
    {
        if(!Session::has('cartId')){
            return redirect('/');
        }
        $data = request()->all();
        $cart = Cart::whereIn('user_id', [Session::get('userId')])->get();
        $orderItems = array_merge(
            ['user_id' => Session::get('userId')],
        );
        $productIds = [];
        $quantities = [];
        $total = 0;
        for ($i = 0, $k = 0; $i < count($cart); $i++) {
            $productIds[$i] = $cart[$i]->product_id;
            $quantities[$i] = $cart[$i]->quantity;
            $total += $quantities[$i] * Product::find($productIds[$i])->price;
        }
        $productIds = json_encode($productIds);
        $quantities = json_encode($quantities);
        DB::beginTransaction();
        try {
            DB::insert('insert into order_items (user_id, product_ids, quantity, total) values (?, ?, ?, ?)', [Session::get('userId'), $productIds, $quantities, $total]);
            $data = array_merge(
                $data,
                ['user_id' => Session::get('userId')],
                ['total' => $total],
            );
            $orderItemsId = OrderItems::whereIn('user_id', [Session::get('userId')])->get();
            $orderItemsId = $orderItemsId[count($orderItemsId) - 1]->id;
            DB::insert('insert into ordert (user_id, vendor_id, order_items_id, address_id, total) values (?, ?, ?, ?, ?)', [$data['user_id'], "vendor_id", $orderItemsId, $data['address_id'], $total]);
            DB::delete('delete from cart where user_id = ?', [Session::get('userId')]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        Session::forget('cartId');
        $orderId= Order::whereIn('order_items_id',[$orderItemsId])->first()->id;
        return redirect('/order/Complete/'.$orderId);
    }

}
