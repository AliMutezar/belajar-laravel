<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponeController;
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
Route::get('/pzn', function () {
    return "Belajar Laravel di Programmer Zaman Now";
});


Route::redirect('/youtube', '/pzn');

Route::fallback(function () {
    return '404 by Programmer Zaman Now';
});

Route::view('/hello', 'hello', ['nama' => 'Ahmad Ali Mutezar']);

Route::get('/hello-again', function () {
    return view('hello', ['nama' => 'Sahira Salsabila']);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['nama' => 'Fulan bin Fulan']);
});


// Route Parameter
Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');


// Where(parameter, [regex])
Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');


// Route Parameter Optional, cukup tambahkan ? tetapi harus set default value di closure function
Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');


// Route conflict tidak akan error, tetapi mempriotiaskan route yang paling pertama di load (paling atas)
Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/conflict/ali', function () {
    return "Conflict Ahmad Ali Mutezar";
});


// Named Route
Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});


// Controller Registration Route
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controll\ers\HelloController::class, 'hello']);


// Request Input
Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);
Route::post('/input/hello/inputAll', [\App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);
Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/exept', [\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

// Upload
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware(App\Http\Middleware\VerifyCsrfToken::class);


// Response
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);


// Group Route
Route::prefix('/response/type')->group(function() {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});


// Cookie Controller Single
// Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
// Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
// Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);


// Cokkie Controller Group
Route::controller(\App\Http\Controllers\CookieController::class)->group(function(){
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});


// Redirect
Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);



//URL Generation with named route, ada 3 cara buat manggilnya
Route::get('/redirect/named', function(){
    return route('redirect-hello', ['name' => 'Ali']);
    // return url()->route('redirect-hello', ['name' => 'Ali']);
    // return \Illuminate\Support\Facades\URL::route('redirect-hello', ['name' => 'Ali']);
});



// Middleware Route
// Route::get('/middleware/api', function() {
//     return "OK";
// })->middleware([\App\Http\Middleware\ContohMiddleWare::class]);

// bisa juga meregistrasikan middleware per route dengan alias
Route::get('/middleware/api', function() {
    return "OK";
})->middleware(["contoh"]);


// Middleware Group
// Route::get('/middleware/group', function() {
//     return "GROUP PZN";
// })->middleware(["pzn"]);


// // Middleware Paramater
// Route::get('/middleware/api', function() {
//         return "OK";
// })->middleware(['contoh:PZN, 401']);


// Bisa pake middleware yang single, atau yang middleware group seperti dibawah ini
// Middleware Group
Route::middleware(['contoh:PZN, 401'])->prefix('/middleware')->group(function() {
    Route::get('/group', function() {
        return "GROUP PZN";
    })->middleware(["pzn"]);


    Route::get('/api', function() {
            return "OK";
    })->middleware(['contoh:PZN, 401']);
});


// CSRF
Route::get('/form', [App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [App\Http\Controllers\FormController::class, 'submitForm']);



// URL Generation Controller Action
Route::get('/url/action', function(){
    return action([\App\Http\Controllers\FormController::class, 'form'], []);
    return url()->action([\App\Http\Controllers\FormController::class, 'form'], []);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class, 'form'], []);
});


// URL Generation
Route::get('/url/current', function() {
    return \Illuminate\Support\Facades\URL::full();
});


// Session
Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);


// Error Handling
Route::get('/error/sample', function() {
    throw new Exception("Sample Error");
});

Route::get('/error/manual', function() {
    report(new Exception("Sample Error"));
    return "OK";
});


Route::get('/error/validation', function() {
    throw new \App\Exceptions\ValidationException("Validation Error Nih Bro");
});
