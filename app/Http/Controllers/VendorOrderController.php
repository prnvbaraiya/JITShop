<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use App\Models\Address;
use App\Models\Product;

class VendorOrderController extends Controller
{
    public function index()
    {
        $orders= Order::orderBy('updated_at','DESC')->get();
        $columns = ['id','user_id', 'total', 'status', 'Edit', 'Delete'];
        $tableName= 'Orders';
        return view('vendor.pages.orders.index',compact('columns','orders','tableName'));
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
        return view('vendor.pages.orders.edit',compact('order','status'));
    }

    public function update(Order $order)
    {
        $data= request()->all();
        $order->update($data);
        return redirect('/vendor/orders');
    }
}
