<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::post('/ejercicio3', [ProductController::class, 'store'])->name('products.store');





// Route::get('/contact', fn () => Response::view('contact'));

// Route::post('/contact', function (Request $request) {
//     $data = $request->all();

//     // $contact = new Contact();
//     // $contact->name = $data['name'];
//     // $contact->phone_number = $data['phone_number'];
//     // $contact->save();

//     Contact::create($data);

//     return "Contacto guardado";
// });






// Ejercicio 2
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
// FIN Ejercicio 2

// Ejercicio 1
Route::get('/ejercicio1', function () {
    return "GET OK";
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});
// FIN Ejercicio 1

// CSRF
// Route::get('/change-password', fn () => Response::view('change-password'));
// Route::post('/change-password', function (Request $request) {
//     if (Auth::check()) {
//         return new HttpResponse("Autenticado");
//     } else {
//         return (new HttpResponse("NO Autenticado"))->setStatusCode(401);
//     }
// });

// Usar métodos de Laravel
// Route::post('/change-password', function (Request $request) {
//     if (auth()->check()) {
//         return response("Contraseña cambiada a {$request->get('password')}");
//     } else {
//         return response("NO Autenticado", 401);
//     }
// });
// FIN CSRF


// Route::get('/contact', function () {
//     return Response::view('contact');
// });

// Guardar contactos con SQL
// PHP 8.0+ Función de flecha
// Route::get('/contact', fn () => Response::view('contact'));

// Route::post('/contact', function (Request $request) {
//     $data = $request->all();
//     // dd($data);
//     // return Response::json(["message" => "Hola"])->setStatusCode(400);
//     DB::statement("INSERT INTO contacts (name, phone_number) VALUES (?,?)", [$data['name'], $data['phone_number']]);

//     return "Contacto guardado";
// });
// Guardar contactos con SQL
