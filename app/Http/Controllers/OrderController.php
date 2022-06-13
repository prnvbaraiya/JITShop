<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use App\Models\Address;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders= Order::orderBy('updated_at','DESC')->get();
        $columns = ['id','user_id', 'total', 'status', 'Edit', 'Delete'];
        $tableName= 'Orders';
        return view('admin.pages.orders.index',compact('columns','orders','tableName'));
    }

    public function edit(Order $order)
    {
        $status= ['pending'=>'pending',
                    'dispatch'=>'Ready To Dispatch',
                    'onWay'=>'On The Way',
                    'arrived'=>'Arrived Final Destination',
                    'delivery'=>'Out for delivery',
                    'cancelled'=>'Cancelled',
                    'rejected'=>'Rejected'];
        return view('admin.pages.orders.edit',compact('order','status'));
    }

    public function update(Order $order)
    {
        $data= request()->all();
        $order->update($data);
        return redirect('/admin/orders');
    }

    public function receipt(Order $order){
        $user= User::find($order->user_id);
        $address= Address::find($order->address_id)->address;
        $produtsIds= json_decode(OrderItems::find($order->order_items_id)->product_ids);
        $quantities= json_decode(OrderItems::find($order->order_items_id)->quantity);
        $products= [];
        $price= [];
        $total= [];
        $data=[];
        $orderTotal= 0;
        for($i=0;$i<count($produtsIds);$i++)
        {
            $product= Product::find($produtsIds[$i]);
            $data[$i]=[
                'name'=> $product->name,
                'quantity'=> $quantities[$i],
                'price'=> $product->price,
                'total'=> $product->price*$quantities[$i]
            ];
        }
        return view('pages.receipt',compact('user','address','order','data'));
    }
    
    public function thankYou()
    {
        return view('pages.ThankYou');
    }
}
