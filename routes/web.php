<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::post('/register', 'App\Http\Controllers\UserController@store');
Route::post('/login', 'App\Http\Controllers\UserController@check')->name('login');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');
Route::get('/profile', 'App\Http\Controllers\UserController@profile');
Route::get('/wallet', 'App\Http\Controllers\UserController@wallet');
Route::get('/orderHistory', 'App\Http\Controllers\UserController@orderHistory');

Route::post('/cart', 'App\Http\Controllers\CartController@store');
Route::get('/cart', 'App\Http\Controllers\CartController@index');
Route::get('/cart/remove/{cart}', 'App\Http\Controllers\CartController@destroy');
Route::get('/checkoutAddress', 'App\Http\Controllers\AddressController@index');
Route::post('/paymentMethod', 'App\Http\Controllers\PaymentMethodController@show');
Route::post('/makeOrder', 'App\Http\Controllers\PaymentMethodController@makeOrder');

Route::patch('/profile/{user}', 'App\Http\Controllers\UserController@update');
Route::get('/category/{category}', 'App\Http\Controllers\HomeController@category');
Route::get('/product/{product}', 'App\Http\Controllers\HomeController@product');

// Route::group(['prefix' => 'admin',  'middleware' => 'adminAuth'],function(){
Route::prefix('admin')->group(function () {

    Route::controller(App\Http\Controllers\AdminController::class)->group(function () {
        Route::get('/', 'signin')->middleware('alreadyLogin');
        Route::post('/', 'check');
        Route::get('/signup', 'signup')->middleware('alreadyLogin');
        Route::post('/signup', 'store');
        Route::get('/dashboard', 'view')->middleware('adminAuth');
        Route::get('/logout', 'logout');
    });

    Route::prefix('orders')->group(function () {
        Route::controller(App\Http\Controllers\OrderController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{order}', 'edit');
            Route::patch('{order}', 'update');
            Route::get('delete/{order}', 'destroy');
        });
    });

    Route::prefix('brand')->group(function () {
        Route::controller(App\Http\Controllers\BrandController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{brand}', 'edit');
            Route::patch('{brand}', 'update');
            Route::get('delete/{brand}', 'destroy');
        });
    });

    Route::prefix('category')->group(function () {
        Route::controller(App\Http\Controllers\CategoryController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{category}', 'edit');
            Route::patch('{category}', 'update');
            Route::get('delete/{category}', 'destroy');
        });
    });

    Route::prefix('discount')->group(function () {
        Route::controller(App\Http\Controllers\DiscountController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{discount}', 'edit');
            Route::patch('{discount}', 'update');
            Route::get('delete/{discount}', 'destroy');
        });
    });

    Route::prefix('attribute')->group(function () {
        Route::controller(App\Http\Controllers\AttributeController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{attribute}', 'edit');
            Route::patch('{attribute}', 'update');
            Route::get('delete/{attribute}', 'destroy');
        });
    });

    Route::prefix('product')->group(function () {
        Route::controller(App\Http\Controllers\ProductController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{product}', 'edit');
            Route::patch('{product}', 'update');
            Route::get('delete/{product}', 'destroy');
        });
    });

    Route::prefix('user')->middleware('adminAuth')->group(function () {
        Route::controller(App\Http\Controllers\UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{user}', 'edit');
            Route::patch('{user}', 'update');
            Route::get('delete/{user}', 'destroy');
        });
    });

    Route::prefix('paymentMethod')->group(function () {
        Route::controller(App\Http\Controllers\PaymentMethodController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'add');
            Route::post('/', 'store');
            Route::get('{paymentMethod}', 'edit');
            Route::patch('{paymentMethod}', 'update');
            Route::get('delete/{paymentMethod}', 'destroy');
        });
    });
});
