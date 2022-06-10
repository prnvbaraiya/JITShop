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
    public function store()
    {
        $data = request()->all();
        $product= $this->getProduct(request('product_id'));
        DB::beginTransaction();
        $data = array_merge(
            $data,
            ['user_id'=> Session::get('userId')],
            ['product_id'=> $product->id]
        );
        $newQuantity= $product->quantity - request('quantity');
        if($newQuantity>=0){
            try{
                DB::update('update product set quantity = ? where id = ?', array($newQuantity,$product->id));
                $cartItem= DB::select('select * from cart where user_id = ? and product_id = ?', [Session::get('userId'),$product->id]);
                if($cartItem){
                    $cartItem[0]->quantity+=request('quantity');
                    DB::update('update cart set quantity = ? where product_id = ? and user_id = ?', [$cartItem[0]->quantity,$product->id,$data['user_id']]);
                } else{
                    DB::insert('insert into cart (user_id, product_id, quantity)values (?, ?, ?)', [$data['user_id'],$data['product_id'],$data['quantity']]);
                }
                DB::commit();
            } catch(Exception $e){
                DB::rollback();
            }
        }
        return redirect('/cart');
    }

    public static function getCart()
    {
        return Cart::whereIn('user_id',array(Session::get('userId')))->get();
    }

    public static function getProduct($product)
    {
        return Product::whereIn('id',array($product))->first();
    }

    public function destroy(Cart $cart)
    {
        $product= $this->getProduct($cart->product_id);
        DB::beginTransaction();
        try{
            $newQuantity= $product->quantity+$cart->quantity;
            DB::update('update product set quantity = ? where id = ?', array($newQuantity,$product->id));
            DB::delete('delete from cart where id = ?', [$cart->id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
        }
        return redirect('/cart');
    }
}
