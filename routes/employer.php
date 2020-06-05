<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/LoginEmployer', function () {
    return view('espaceEmployer.view.login');
})->name('espace.login');

Route::resource('espaceEmployer', 'EspaceContrller');
