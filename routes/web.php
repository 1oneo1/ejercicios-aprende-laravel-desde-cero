<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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
    return view('welcome');
});

// Ejercicio 1

Route::get('/ejercicio1', function () {
    return "GET OK";
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/contact', function () {
//     return Response::view('contact');
// });

// PHP 8.0+
Route::get('/contact', fn () => Response::view('contact'));

Route::post('/contact', function (Request $request) {
    // dd($request);
    return Response::json(["message" => "Hola"])->setStatusCode(400);
});

Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json($request);
});

Route::post('/ejercicio2/b', function (Request $request) {
    $price = $request->get('price');
    if (!is_numeric($price) || $price <= 0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    }

    return Response::json($request);
});

Route::post('/ejercicio2/c', function (Request $request) {

    $discountPor = 0;
    $price = $request->get('price');

    if ($request->query->has('discount')) {
        $discount = $request->get('discount');
        switch ($discount) {
            case 'SAVE5':
                $price = $price - $price * 0.05;
                $discountPor = 5;
                break;
            case 'SAVE10':
                $price = $price - $price * 0.10;
                $discountPor = 10;
                break;
            case 'SAVE15':
                $price = $price - $price * 0.15;
                $discountPor = 15;
                break;
        }
    }

    $response = $request->all();
    $response['price'] = $price;
    $response['discount'] = $discountPor;

    return Response::json($response);
});
