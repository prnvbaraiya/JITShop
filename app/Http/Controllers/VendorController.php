<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function view(){
        return view('vendor.pages.index');
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
                return redirect('/vendor/dashboard');
            }
            else
            {
                return redirect('/vendor')->with('danger-message','Password is Wrong');
            }
        }
        else
        {
            return redirect('/vendor')->with('danger-message','email is not registered');
        }
    }

    public function store(){
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>['required']
        ]);
        $hashedPassword = Hash::make(request()->password);
        $data = array_merge(
            $data,
            ['password'=>$hashedPassword]
        );
        Vendor::create($data);
        $vendor = Vendor::where('email','=',$data['email'])->first();
        request()->session()->put('vendorId',$vendor->id);
        request()->session()->put('vendorName',$vendor->name);
        return $this->view();
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
