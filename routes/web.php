<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AvatarController;

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
Route::view('/avatar-gender-selection', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::post('/avatar-gender-selection', [AvatarController::class, 'changeImage'])->name('change.image');
// Route::get('/avatar-gender-selection', [FormController::class, 'formSession'])->name('avatar.gender.selection');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateAvatar'])->name('validate.avatar');

/* Priorities */
Route::view('/top-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::view('/priorities-to-discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');

/* Priorities - Education */
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');
Route::view('/education-coverage', 'pages.priorities.education.education-coverage')->name('education.coverage');
Route::view('/education-supporting-years', 'pages.priorities.education.education-supporting-years')->name('education.supporting.years');
Route::view('/education-other', 'pages.priorities.education.education-other')->name('education.other');
Route::view('/education-gap', 'pages.priorities.education.education-gap')->name('education.gap');

/* Priorities - Investment */
Route::view('/investment-home', 'pages.priorities.investment.investment-home')->name('investment.home');
Route::view('/investment-coverage', 'pages.priorities.investment.investment-coverage')->name('investment.coverage');
Route::view('/investment-supporting', 'pages.priorities.investment.investment-supporting')->name('investment.supporting');
Route::view('/investment-annual-return', 'pages.priorities.investment.investment-annual-return')->name('investment.annual.return');
Route::view('/investment-expected-return', 'pages.priorities.investment.investment-expected-return')->name('investment.expected.return');

/* Priorities - Retirement */
Route::view('/retirement-home', 'pages.priorities.retirement.retirement-home')->name('retirement.home');
Route::view('/retirement-coverage', 'pages.priorities.retirement.retirement-coverage')->name('retirement.coverage');

Route::get('/files/{filename}', function($filename){
    return \Storage::download($filename); // assuming default disk is set to 'public'
});


