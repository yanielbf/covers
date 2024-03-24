<?php

use Illuminate\Support\Facades\Route;

Route::get('/{model}', function () {
    return view('index', ['url'=> asset('storage/3d/1.glb')]);
});

Route::get('/welcome', function () {
    return view('welcome');
});
