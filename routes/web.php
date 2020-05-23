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
Route::resource('/admin/presence', 'PresenceController');
Route::get('employer/suppprime/{id}','EmployerController@destroy')->name('employer.delete');
Route::get('/admin/outil/salire','EmployerController@InfoCalculSalire')->name('admin.salire');
Route::get('/admin/outil/ir','EmployerController@infoIr')->name('admin.ir');
Route::get('/admin/presence/pointage/{id}','PresenceController@pointerEmployer')->name('presence.pointer');
Route::POST('/admin/presence/employer','PresenceController@getEmployerPresence')->name('presence.employer');
Route::POST('/admin/presence/employer/{id}','PresenceController@savePresence')->name('presence.save');



