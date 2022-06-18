<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;
use \App\Models\Brand;
use \App\Models\Product;
use \App\Models\User;
use \App\Models\Vendor;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $categories= Category::get();
        $sellers= Vendor::get();
        $bestSProducts= Product::orderBy('sold_quantity','desc')->limit(8)->get();
        return view('pages.index',compact('categories','sellers','bestSProducts'));
    }
    public function getBrands()
    {
        return Brand::get();
    }

    public static function getCategories()
    {
        return Category::get();
    }

    public function products(Category $content)
    {
        return view('pages.products',compact('content'));
    }

    public function seller(Vendor $content)
    {
        return view('pages.products',compact('content'));
    }

    public function product(Product $product)
    {
        $inWishlist= User::find(Session::get('userId'))->wishlist->contains('product_id',$product->id);
        return view('pages.product',compact('product','inWishlist'));
    }
}
