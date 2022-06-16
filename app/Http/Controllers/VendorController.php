<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;
use Session;

class VendorController extends Controller
{
    public function view(){
        $vendor= Vendor::find(Session::get('vendorId'));
        return view('vendor.pages.index',compact('vendor'));
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

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
