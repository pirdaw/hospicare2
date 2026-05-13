<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/formpoli', function () {
    return view('formpoli');
});

Route::get('/formpasienbaru', function () {
    return view('formpasienbaru');
});

Route::get('/formpasienlama', function () {
    return view('formpasienlama');
});

Route::get('/datakunjungan', function () {
    return view('datakunjungan');
});