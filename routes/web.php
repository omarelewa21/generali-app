<?php

use App\Http\Controllers\ProgressBarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\formValidateRetirementNeeds;

/* main pages */
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::view('/basic-details', 'pages.main.basic-details')->name('basic.details');
Route::post('/basic-details', [FormController::class, 'submit'])->name('form.submit');

/* avatar pages */
Route::view('/welcome', 'pages.avatar.avatar-welcome')->name('avatar.welcome');
Route::view('/marital-status', 'pages.avatar.avatar-marital-status')->name('avatar.marital.status');
Route::view('/family-dependant', 'pages.avatar.avatar-family-dependant')->name('avatar.family.dependant');
Route::view('/family-dependant-details', 'pages.avatar.avatar-family-dependant-details')->name('avatar.family.dependant.details');
Route::view('/assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');
Route::get('/identity-details', [FormController::class, 'identityData'])->name('identity.details');
Route::view('/gender', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::post('/gender', [AvatarController::class, 'changeImage'])->name('change.image');
// Route::get('/avatar-gender-selection', [FormController::class, 'formSession'])->name('avatar.gender.selection');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::view('/priorities-menu', 'pages.priorities.priorities-menu')->name('priorities.menu');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateAvatar'])->name('validate.avatar');
// Route::get('/select-options', 'SelectOptionController@index')->name('select-options');

/* Priorities */
Route::view('/top-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::view('/priorities-to-discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');
Route::view('/protection-coverage', 'pages.priorities.protection.protection-coverage')->name('protection.coverage');
Route::view('/protection-monthly-support', 'pages.priorities.protection.protection-monthly-support')->name('protection.monthly.support');
Route::view('/protection-supporting-years', 'pages.priorities.protection.protection-supporting-years')->name('protection.supporting.years');

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
Route::view('/investment-gap', 'pages.priorities.investment.investment-gap')->name('investment.gap');

/* Priorities - Retirement */
// Route::view('/retirement-home', 'pages.priorities.retirement.retirement-home')->name('retirement.home');
Route::get('/retirement-home', [ProgressBarController::class, 'progressBarLoading'])->name('retirement.home');
Route::view('/retirement-coverage', 'pages.priorities.retirement.retirement-coverage')->name('retirement.coverage');
Route::Post('/retirement-coverage', [formValidateRetirementNeeds::class, 'validateAvatarSelection'])->name('form.retirement.validateAvatar');
Route::view('/retirement-ideal', 'pages.priorities.retirement.retirement-ideal')->name('retirement.ideal');
Route::view('/retirement-age-to-retire', 'pages.priorities.retirement.retirement-age-to-retire')->name('retirement.age.to.retire');
Route::view('/retirement-allocated-funds', 'pages.priorities.retirement.retirement-allocated-funds ')->name('retirement.allocated.funds');
Route::Post('/retirement-age-to-retire', [formValidateRetirementNeeds::class, 'submitRetirementAgeToRetire'])->name('form.age.to.retire');
Route::view('/retirement-years-till-retire', 'pages.priorities.retirement.retirement-years-till-retire')->name('retirement.years.till.retire');
Route::view('/retirement-allocated-funds-aside', 'pages.priorities.retirement.retirement-allocated-funds-aside')->name('retirement.allocated.funds.aside');

Route::get('/files/{filename}', function($filename){
    return \Storage::download($filename); // assuming default disk is set to 'public'
});


