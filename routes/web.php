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
    return view('welcome');
});

Route::get("/", "FrontendController@index")->name("home");
Route::get("/about", "FrontendController@about")->name("about");
Route::get("/contact", "FrontendController@contact")->name("contact");
Route::get("/login", "FrontendController@login")->name("login");
Route::get("/register", "FrontendController@register")->name("register");
Route::get("/cart", "FrontendController@cart")->name("cart")->middleware(['isLoggedIn']);
Route::get("/product/{id}", "FrontendController@product")->name("product");

Route::get("/search", "ToolController@show");

Route::get("/category-filter", "CategoryController@categoryTool");

Route::get('/fetch_data', 'FrontendController@fetchtools');

Route::post("/do-login", "LoginController@login")->name("dologin");
Route::post("/do-register", "LoginController@register")->name("doregister");
Route::get("/logout", "LoginController@logout")->name("logout")->middleware(['isLoggedIn']);

Route::post("/contact/insert", "ContactController@insertContact")->name("insertContact");

Route::group(['middleware' => 'isLoggedIn'], function (){
    Route::post("/cart/insert", "CartController@insertCart");
    Route::delete("/cart/delete", "CartController@deleteCart");
    Route::get("/cart/amount", "CartController@getNewAmount");
    Route::get("/cart/tools", "CartController@getAllFromCart");
    Route::get("/cart/cart-number", "CartController@numberOfTools");
    Route::delete("/cart/buy", "CartController@buyTools");
});


Route::get("/pagination", "ToolController@pagination");

Route::group(['middleware' => ['admin','isLoggedIn']], function (){
    Route::get("/admin/showAll", "Admin\UserController@showAjax");
    Route::get("/admin/logs", "Admin\LogController@index")->name("logs");
    Route::get("/admin/tools/showAll", "Admin\ToolController@showAjax");
    Route::get("/admin/category/showAll", "Admin\CategoryController@showAjax");
    Route::get("/admin/contact/showAll", "Admin\ContactController@showAjax");
    Route::resources([
        "/admin/contact" => "Admin\ContactController",
        "/admin/tools" => "Admin\ToolController",
        "/admin/category" => "Admin\CategoryController",
        "/admin" => "Admin\UserController"

    ]);
});



