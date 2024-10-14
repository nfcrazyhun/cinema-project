<?php

use Illuminate\Support\Facades\Route;



// Fix for 404 on page refresh
// https://stackoverflow.com/a/51399889
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
