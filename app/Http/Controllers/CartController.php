<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Session;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.cart');
    }
    public function store(Product $product)
    {
        $data = request()->all();
        $data = array_merge(
            $data,
            ['user_id'=> Session::get('userId')],
            ['product_id'=> $product->id]
        );
        $newQuantity= $product->quantity - request('quantity');
        $newProductData = ['quantity'=>$newQuantity];
        $product->update($newProductData);
        $cartItems= Cart::whereIn('user_id',array(Session::get('userId')))->get();
        for($i=0;$i<count($cartItems);$i++){
            if($cartItems[$i]->product_id==$product->id){
                $data['quantity']+=request('quantity');
                DB::update('update cart set quantity = ? where user_id = ?', [$data['quantity'],$data['user_id']]);
                return view('pages.cart',compact('cartItems'));
            }
        }
        Cart::create($data);
        return view('pages.cart',compact('cartItems'));
    }

    public static function getCart()
    {
        return Cart::whereIn('user_id',array(Session::get('userId')))->get();
    }

    public static function getProduct($product)
    {
        $product= Product::whereIn('id',array($product))->first();
        return $product;
    }

    public function destroy(Cart $cart)
    {
        
        $cart->delete();
        return redirect('/cart');
    }
}
