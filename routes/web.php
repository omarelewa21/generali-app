<?php

use App\Http\Controllers\ProgressBarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\SvgController;

/* main pages */
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::view('/basic-details', 'pages.main.basic-details')->name('basic.details');
Route::post('/basic-details', [FormController::class, 'submit'])->name('form.submit');

/* avatar pages */
Route::view('/avatar-welcome', 'pages.avatar.avatar-welcome')->name('avatar.welcome');
Route::view('/avatar-marital-status', 'pages.avatar.avatar-marital-status')->name('avatar.marital.status');
Route::view('/avatar-family-dependant', 'pages.avatar.avatar-family-dependant')->name('avatar.family.dependant');
Route::view('/avatar-family-dependant-details', 'pages.avatar.avatar-family-dependant-details')->name('avatar.family.dependant.details');
Route::view('/avatar-my-assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');
Route::get('/identity-details', [FormController::class, 'countries'])->name('identity.details');
Route::post('/avatar-gender-selection', [AvatarController::class, 'changeImage'])->name('change.image');
Route::get('/avatar-gender-selection', [FormController::class, 'formSession'])->name('avatar.gender.selection');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
// Route::get('/edit-svg', [SvgController::class, 'editSvg'])->name('editSvg');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');

Route::view('/priorities-menu', 'pages.priorities.priorities-menu')->name('priorities.menu');

/* Priorities */
Route::view('/top-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::view('/priorities-to-discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');

/* Priorities - Education */
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');
Route::view('/education-coverage', 'pages.priorities.education.education-coverage')->name('education.coverage');
Route::view('/education-supporting-years', 'pages.priorities.education.education-supporting-years')->name('education.supporting.years');

/* Priorities - Retirement */
// Route::view('/retirement-home', 'pages.priorities.retirement.retirement-home')->name('retirement.home');
Route::get('/retirement-home', [ProgressBarController::class, 'progressBarLoading'])->name('retirement.home');
Route::view('/retirement-coverage', 'pages.priorities.retirement.retirement-coverage')->name('retirement.coverage');
Route::view('/retirement-ideal', 'pages.priorities.retirement.retirement-ideal')->name('retirement.ideal');
Route::view('/retirement-age-to-retire', 'pages.priorities.retirement.retirement-age-to-retire')->name('retirement.age.to.retire');
Route::view('/retirement-allocated-funds', 'pages.priorities.retirement.retirement-allocated-funds ')->name('retirement.allocated.funds');


Route::get('/files/{filename}', function($filename){
    return \Storage::download($filename); // assuming default disk is set to 'public'
});


