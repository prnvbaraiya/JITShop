<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        $columns = ['id','name','email','mobile','Edit','Delete'];
        $tableName = 'user';
        return view('admin.pages.user.index',compact('users','columns','tableName'));
    }

    public function add()
    {
        $tableName = 'user';
        return view('admin.pages.user.add',compact('tableName'));
    }

    public function store()
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>['required','email','unique:users'],
            'password'=>['required','confirmed'],
            'mobile'=>['required','numeric','digits:10'],
        ]);
        $hashedPassword = Hash::make(request()->password);
        $data = array_merge(
            $data,
            ['password'=>$hashedPassword]
        );
        User::create($data);
        if(request()->session()->has('loginId')){
            return redirect('/admin/user')->with('message','added Successfully');
        }
        return $this->check();
    }
    
    public function edit(User $user)
    {
        return view('admin.pages.user.edit',compact('user'));
    }
    
    public function update(User $user)
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>['required','email'],
            'mobile'=>['required','numeric','digits:10'],
        ]);
        $user->update($data);
        $users = User::get();
        if(Session::has('userId'))
            Session::put('userName',$data['name']);
        if(request()->session()->has('loginId')){
            return redirect('/admin/user')->with('message','Updated Successfully');
        }
        return $this->profile();
        
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/user')->with('danger-message','Deleted Successfully');
    }

    public function check()
    {
        $data = request()->validate([
            'email'=>'required',
            'password'=>'required',  
        ]);
        $user = User::where('email','=',$data['email'])->first();
        if($user)
        {
            if(Hash::check($data['password'], $user['password']))
            {
                request()->session()->put('userId',$user->id);
                request()->session()->put('userName',$user->name);
                return redirect('/');
            }
            else
            {
                return redirect('/login')->with('message','Password is Wrong');
            }
        }
        else
        {
            return redirect('/login')->with('message','email is not registered');
        }
    }

    public static function isUser(){
        if(Session::has('userId')){
            return true;
        }
        return false;
    }

    public function profile(){
        $user = $this->getUser(Session::get('userId'));
        return view('pages.profile',compact('user'));
    }

    public function wallet(){
        return view('pages.wallet');
    }

    public function orderHistory(){
        $tableName = 'Order History';
        $columns = ['id','item','total','time'];
        $contents = ([['id'=>'1',
                        'item'=>'mobile',
                        'total'=>'123',
                        'time'=>'12:30']]);
        return view('pages.orderHistory',compact('tableName','columns','contents'));
    }

    public static function getUser($id){
        return User::findOrFail($id);
    }

    public function logout()
    {
        Session::flush();
        if(Session::has('userId'))
        {
            Session::pull('userId');
            Session::pull('userName');
        }
        return redirect('/');
    }
}
