<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;
use \App\Models\Brand;

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
}
