<?php

use App\Http\Controllers\HelloController;
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


// HTTP Method get("uri", $callbackFunction)
Route::get('/pzn', function() {
    return "Belajar Laravel di Programmer Zaman Now";
});


Route::redirect('/youtube', '/pzn');

Route::fallback(function() {
    return '404 by Programmer Zaman Now';
});

Route::view('/hello', 'hello', ['nama' => 'Ahmad Ali Mutezar']);

Route::get('/hello-again', function() {
    return view('hello', ['nama' => 'Sahira Salsabila']);
});

Route::get('/hello-world', function() {
    return view('hello.world', ['nama' => 'Fulan bin Fulan']);
});


// Route Parameter
Route::get('/products/{id}', function ($productId){
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function($productId, $itemId) {
    return "Product $productId, Item $itemId"; 
})->name('product.item.detail');


// Where(parameter, [regex])
Route::get('/categories/{id}', function($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');


// Route Parameter Optional, cukup tambahkan ? tetapi harus set default value di closure function
Route::get('/users/{id?}', function($userId = '404') {
    return "User $userId";
})->name('user.detail');


// Route conflict tidak akan error, tetapi mempriotiaskan route yang paling pertama di load (paling atas)
Route::get('/conflict/{name}', function($name) {
    return "Conflict $name";
});

Route::get('/conflict/ali', function() {
    return "Conflict Ahmad Ali Mutezar";
});


// Named Route
Route::get('/produk/{id}', function($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});


// Controller Registration Route
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);