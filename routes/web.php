<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::Post('/', 'UserController@store')->name('user.store');

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/Registration", "HomeController@registration")->name('registration');
Route::resource('societe', 'SocieteController');
Route::resource('/admin/employer', 'EmployerController');
Route::resource('/admin/presenceEmp', 'PresenceController');
Route::get('employer/suppprime/{id}', 'EmployerController@destroy')->name('employer.delete');
Route::get('/admin/outil/salire', 'EmployerController@InfoCalculSalire')->name('admin.salire');
Route::get('/admin/outil/ir', 'EmployerController@infoIr')->name('admin.ir');
///////////////////////////////////////////////////////////////////////////////
Route::get('/admin/presence/test', 'PresenceController@pointerEmployer')->name('presence.historique');
Route::get('/admin/presence/delete', 'PresenceController@deletePresence')->name('presence.delete');
Route::get('/admin/presence/employer', 'PresenceController@getEmployerPresence')->name('presence.employer');
Route::get('/admin/presence/getPdf', 'PresenceController@getpdfF')->name('presence.pdf');
Route::POST('/admin/presence/employer/{id}', 'PresenceController@savePresence')->name('presence.save');
Route::PUT('/admin/presence/update', 'PresenceController@updatePresence')->name('presence.updateP');
//Avance
Route::resource('/admin/avance', 'AvanceController');
Route::get('/admin/avance/historique', 'AvanceController@historique')->name('avance.historique');
// Route::resource('admin/paie', 'PaieController');
// Route::get('admin/paie/show/', 'PaieController@showInfo')->name('paie.showInfo');
Route::get('admin/paie/show/', 'PaieController@show')->name('paie.show');
Route::get('admin/paie/index/', 'PaieController@index')->name('paie.index');
Route::get('admin/paie/create/', 'PaieController@create')->name('paie.create');
Route::get('admin/paie/salireNet/', 'PaieController@getsalaireNet')->name('paie.salNet');
