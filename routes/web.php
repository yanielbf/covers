<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/customize/{model}', function (Request $request, $model) {
    return view('index', ['url'=> asset('storage/3d/1.glb'), 'model' => $model]);
});

Route::get('/created-models', function (Request $request) {
    $directory = 'images';
    $files = Storage::files($directory);
    $fileNames = collect($files)->map(function ($file) {
        return basename($file);
    });
    return view('created-covers', ['files' => $fileNames]);
})->name('created-models');

Route::get('/created-covers', function (Request $request) {
    $directory = 'images';
    $files = Storage::files($directory);
    $fileNames = collect($files)->map(function ($file) {
        return basename($file);
    });
    return view('created-covers', ['files' => $fileNames]);
})->name('created-covers');

Route::get('/delete-covers/{id}', function (Request $request, $id) {
    $filePath = 'images/' . $id;
    if (Storage::exists($filePath)) {
        Storage::delete($filePath);
        Session::flash('message', 'Archivo eliminado correctamente');
    } else {
        Session::flash('message', 'El archivo no existe');
    }
    return redirect()->route('created-covers');
})->name('delete-covers');
