<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;
use \App\Models\Brand;
use \App\Models\Product;

class HomeController extends Controller
{
    public function getBrands()
    {
        return Brand::get();
    }

    public static function getCategories()
    {
        return Category::get();
    }

    public function category(Category $category)
    {
        return view('pages.category',compact('category'));
    }

    public function product(Product $product)
    {
        return view('pages.product',compact('product'));
    }
}
