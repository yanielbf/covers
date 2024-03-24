<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/upload', function (Request $request) {
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'filename' => 'required|string'
    ]);

    $image = $request->file('image');
    $filename = $request->input('filename');

    $path = $image->storeAs('images', $filename);

    return response()->json(['path' => $path]);
});
