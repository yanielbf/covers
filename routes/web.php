<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/{model}', function (Request $request, $model) {
    return view('index', ['url'=> asset('storage/3d/1.glb'), 'model' => $model]);
});

Route::get('/welcome', function () {
    return view('welcome');
});
