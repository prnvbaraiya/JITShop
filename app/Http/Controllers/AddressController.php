<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Session;

class AddressController extends Controller
{
    public function index()
    {
        $addresses= Address::whereIn('user_id',[Session::get('userId')])->get();
        return view('pages.checkoutAddress',compact('addresses'));
    }
}
