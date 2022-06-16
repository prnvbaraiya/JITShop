<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;
use \App\Models\Brand;
use \App\Models\Product;
use \App\Models\Vendor;

class HomeController extends Controller
{
    public function index()
    {
        $categories= Category::get();
        $sellers= Vendor::get();
        return view('pages.index',compact('categories','sellers'));
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
        return view('pages.product',compact('product'));
    }
}
