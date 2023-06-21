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
    return view('pages.main.welcome');
});
Route::get('/pdpa-disclosure', function () {
    return view('pages.main.pdpa-disclosure');
});
Route::get('/basic-details', function () {
    return view('pages.main.basic-details');
});
Route::get('/avatar-welcome', function () {
    return view('pages.avatar.avatar-welcome');
});
Route::get('/avatar-gender-selection', function () {
    return view('pages.avatar.avatar-gender-selection');
});

Route::get('/protection', function () {
    return view('pages.priorities.protection.protection');
});
Route::get('/test-ipad', function () {
    return view('test-ipad');
});