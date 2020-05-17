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
})->name('loginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/Registration","HomeController@registration")->name('registration');
Route::resource('societe', 'SocieteController');
Route::resource('/admin/employer', 'EmployerController');

