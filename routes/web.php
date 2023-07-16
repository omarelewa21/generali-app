<?php

use Illuminate\Support\Facades\Route;

/* main pages */
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::view('/basic-details', 'pages.main.basic-details')->name('basic.details');

/* avatar pages */
Route::view('/avatar-welcome', 'pages.avatar.avatar-welcome')->name('avatar.welcome');
Route::view('/avatar-gender-selection', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::view('/avatar-marital-status', 'pages.avatar.avatar-marital-status')->name('avatar.marital.status');
Route::view('/avatar-family-dependant', 'pages.avatar.avatar-family-dependant')->name('avatar.family.dependant');
Route::view('/avatar-family-dependant-details', 'pages.avatar.avatar-family-dependant-details')->name('avatar.family.dependant.details');
Route::view('/avatar-my-assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');
Route::view('/identity-details', 'pages.avatar.identity-details')->name('identity.details');

/* Priorities */
Route::view('/top-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::view('/priorities-to-discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');

/* Priorities - Education */
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');
Route::view('/education-coverage', 'pages.priorities.education.education-coverage')->name('education.coverage');

/* Priorities - Retirement */
Route::view('/retirement-home', 'pages.priorities.retirement.retirement-home')->name('retirement.home');
Route::view('/retirement-coverage', 'pages.priorities.retirement.retirement-coverage')->name('retirement.coverage');


