<?php

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

Route::get('/', 'ProductController@index');

Route::resource('categories', 'CategoryController');
Route::resource('manufacturers', 'ManufacturerController');
Route::resource('suppliers', 'SupplierController');
Route::resource('/products','ProductController');
// Route::get('/products/create', 'ProductController@create')->middleware('isAdmin');
Route::resource('/orders','OrderController');
Route::get("/products", 'ProductController@index');
Route::post("/products", 'ProductController@store');
Route::get("/products/{id}/restore", 'ProductController@restore');
Route::post('/search/products', 'ProductController@search');

//product filter by ajax
// 
Route::get('productsCat', 'ProductController@productsCat');

Route::delete("/cart/empty", "CartController@emptyCart");
//Route to confirm the order after checkout
Route::get("/cart/confirm", "CartController@confirmOrder");
Route::resource('cart', 'CartController'); //base url /cart
//q: what is post /cart? -> store

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/productsCat', function(){
// 	if(Request::ajax()){
// 		return'data';
// 	}
// });