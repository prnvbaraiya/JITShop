<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }
    
    public function index()
    {
        $paymentMethods = PaymentMethod::get();
        $columns = ['id','name','available','Edit','Delete'];
        $tableName = 'payment Method';
        return view('admin.pages.paymentMethod.index',compact('paymentMethods','columns','tableName'));
    }

    public function add()
    {
        return view('admin.pages.paymentMethod.add');
    }

    public function store()
    {
        $data = request()->validate([
            'name'=>'required',
            'available'=>''
        ]);
        if (isset($_POST['available'])) {
            $data = array_merge(
                $data,
                ['available'=>'1']
            );
        } else {
            $data = array_merge(
                $data,
                ['available'=>'0']
            );
        }
        PaymentMethod::create($data);
        return redirect('/admin/paymentMethod')->with('message','added Successfully');
    }
    
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.pages.paymentMethod.edit',compact('paymentMethod'));
    }
    
    public function update(PaymentMethod $paymentMethod)
    {
        $data = request()->all();
        request()->validate([
            'name'=>'required',
            'available'=>''
        ]);
        if (isset($_POST['available'])) {
            $data = array_merge(
                $data,
                ['available'=>'1']
            );
        } else {
            $data = array_merge(
                $data,
                ['available'=>'0']
            );
        }
        $paymentMethod->update($data);
        $paymentMethods = PaymentMethod::get();
        return redirect('/admin/paymentMethod')->with('message','Updated Successfully');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect('/admin/paymentMethod')->with('danger-message','Deleted Successfully');
    }
}
