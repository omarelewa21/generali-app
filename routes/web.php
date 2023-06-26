<?php

use Illuminate\Support\Facades\Route;

/* main pages */
Route::view('/', 'pages.main.welcome')->name('home');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::view('/basic-details', 'pages.main.basic-details')->name('basic.details');

/* avatar pages */
Route::view('/avatar-welcome', 'pages.avatar.avatar-welcome')->name('avatar.welcome');
Route::view('/avatar-gender-selection', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::view('/avatar-marital-status', 'pages.avatar.avatar-marital-status')->name('avatar.marital.status');
Route::view('/avatar-family-dependant', 'pages.avatar.avatar-family-dependant')->name('avatar.family.dependant');
Route::view('/avatar-my-assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');

/* Priorities - Retirement */


