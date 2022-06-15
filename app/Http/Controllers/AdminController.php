<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminController extends Controller
{
    protected $guarded = [];
    public function view()
    {
        return view('admin.pages.index');
    }

    public function signup()
    {
        return view('admin.pages.signup');
    }

    public function signin()
    {
        return view('admin.pages.login');
    }

    public function store()
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required|unique:admin',
            'password'=>['required']
        ]);
        $hashedPassword = Hash::make(request()->password);
        $data = array_merge(
            $data,
            ['password'=>$hashedPassword]
        );
        Admin::create($data);
        $admin = Admin::where('email','=',$data['email'])->first();
        request()->session()->put('loginId',$admin->id);
        request()->session()->put('adminName',$admin->name);
        return redirect('/admin/dashboard');
    }

    public function check()
    {
        $data = request()->validate([
            'email'=>'required',
            'password'=>'required',  
        ]);
        $admin = Admin::where('email','=',$data['email'])->first();
        if($admin)
        {
            if(Hash::check($data['password'], $admin['password']))
            {
                request()->session()->put('loginId',$admin->id);
                request()->session()->put('adminName',$admin->name);
                return redirect('/admin/dashboard');
            }
            else
            {
                return redirect('/admin')->with('danger-message','Password is Wrong');
            }
        }
        else
        {
            return redirect('/admin')->with('danger-message','email is not registered');
        }
    }

    public function logout()
    {
        Session::flush();
        // if(Session::has('loginId'))
        // {
        //     Session::pull('loginId');
        //     Session::pull('adminName');
        // }
        return redirect('/');
    }
}
