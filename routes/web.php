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
Route::GET('/user/profile/{id}', 'UserController@profile')->name('user.profile');
Route::GeT('/user/parametre/{id}', 'UserController@parametreUser')->name('user.parametre');
Route::PUT('/user/update', 'UserController@updateUser')->name('user.update');
Route::PUT('/user/updateImage/', 'UserController@updateImage')->name('user.updateImage');


Route::get('/admin/home', 'HomeController@index')->name('home');
Route::get("/Registration", "HomeController@registration")->name('registration');
Route::resource('societe', 'SocieteController');
Route::resource('/admin/employer', 'EmployerController');
Route::resource('/admin/presenceEmp', 'PresenceController');
Route::POST('/admin/presenceEmp/pointerAll','PresenceController@saveAll')->name('presence.saveAll');
Route::get('employer/suppprime/{id}', 'EmployerController@destroy')->name('employer.delete');
Route::get('employer/suppression/{id}', 'EmployerController@forceDelete')->name('employer.forceDelete');
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
Route::get('admin/paie/apercu/{id}', 'PaieController@apercu')->name('paie.apercu');
Route::get('admin/paie/pdf', 'PaieController@getPdf')->name('paie.getpdf');
Route::get('admin/paie/cherche', 'PaieController@cherchePaie')->name('paie.cherche');
Route::get('admin/paie/edit/{id}', 'PaieController@edit')->name('paie.edit');
Route::get('admin/paie/showPaie/{id}', 'PaieController@showPaie')->name('paie.showPaie');
Route::get('admin/paie/destroy/{id}', 'PaieController@destroy')->name('paie.destroy');
Route::PUT('admin/paie/update/{id}', 'PaieController@update')->name('paie.update');

// parrametre route
Route::get('/admin/parametre/','ParametreController@index')->name('para.index');
Route::get('/admin/parametre/employer/{id}','ParametreController@restoref')->name('para.emp.restore');
