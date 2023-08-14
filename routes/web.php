<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\AvatarGenderSelectionController;
use App\Http\Controllers\formProtectionController;
use App\Http\Controllers\formRetirementController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\SessionController;

/* main pages */
Route::post('/store-select', [DropdownController::class, 'storeSelect'])->name('store.select');
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::post('/basic-details', [FormController::class, 'basicDetails'])->name('form.submit');
Route::get('/basic-details', [DropdownController::class, 'titles'])->name('basic.details');
Route::post('/save-button-click', [FormController::class, 'pdpa'])->name('save.button.click');

/* avatar pages */
Route::view('/welcome', 'pages.avatar.avatar-welcome')->name('avatar.welcome');
Route::view('/marital-status', 'pages.avatar.avatar-marital-status')->name('avatar.marital.status');
Route::view('/family-dependant', 'pages.avatar.avatar-family-dependant')->name('avatar.family.dependant');
Route::view('/family-dependant-details', 'pages.avatar.avatar-family-dependant-details')->name('avatar.family.dependant.details');
Route::view('/assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');
Route::get('/identity-details', [DropdownController::class, 'identityDetails'])->name('identity.details');
Route::view('/gender', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::post('/gender', [AvatarController::class, 'changeImage'])->name('change.image');
Route::view('/new-gender', 'pages.avatar.avatar-new-gender-selection')->name('avatar.new.gender.selection');
Route::post('/new-gender', [AvatarGenderSelectionController::class, 'newChangeImage'])->name('new.change.image');
// Route::get('/avatar-gender-selection', [FormController::class, 'formSession'])->name('avatar.gender.selection');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::post('/new-change-image', [AvatarGenderSelectionController::class, 'newChangeImage'])->name('newChangeImage');
Route::view('/priorities-menu', 'pages.priorities.priorities-menu')->name('priorities.menu');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateButton'])->name('validate.avatar');

/* Priorities */
Route::view('/top-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::view('/priorities-to-discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');
Route::view('/protection-coverage', 'pages.priorities.protection.protection-coverage')->name('protection.coverage');
Route::post('/protection-coverage', [formProtectionController::class, 'submitProtectionCoverage'])->name('form.protection.coverage');
Route::view('/protection-monthly-support', 'pages.priorities.protection.protection-monthly-support')->name('protection.monthly.support');
Route::post('/protection-monthly-support', [formProtectionController::class, 'submitProtectionMonthlySupport'])->name('form.protection.monthly.support');
Route::view('/protection-supporting-years', 'pages.priorities.protection.protection-supporting-years')->name('protection.supporting.years');
Route::post('/protection-supporting-years', [formProtectionController::class, 'submitProtectionSupportingYears'])->name('form.protection.supporting.years');
Route::view('/protection-existing-policy', 'pages.priorities.protection.protection-existing-policy')->name('protection.existing.policy');
Route::post('/protection-existing-policy', [formProtectionController::class, 'submitProtectionExistingPolicy'])->name('form.protection.existing.policy');
Route::view('/protection-gap', 'pages.priorities.protection.protection-gap')->name('protection.gap');


/* Priorities - Education */
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');
Route::view('/education-coverage', 'pages.priorities.education.education-coverage')->name('education.coverage');
Route::post('/education-coverage', [EducationController::class, 'validateCoverageSelection'])->name('validate.coverage.selection');
Route::view('/education-supporting-years', 'pages.priorities.education.education-supporting-years')->name('education.supporting.years');
Route::post('/education-supporting-years', [EducationController::class, 'submitEducationSupporting'])->name('form.submit.education.supporting');
Route::view('/education-other', 'pages.priorities.education.education-other')->name('education.other');
Route::post('/education-other', [EducationController::class, 'submitEducationOther'])->name('form.submit.education.other');
Route::view('/education-gap', 'pages.priorities.education.education-gap')->name('education.gap');
Route::post('/education-gap', [EducationController::class, 'submitEducationGap'])->name('form.submit.education.gap');

/* Priorities - Investment */
Route::view('/investment-home', 'pages.priorities.investment.investment-home')->name('investment.home');
Route::view('/investment-coverage', 'pages.priorities.investment.investment-coverage')->name('investment.coverage');
Route::post('/investment-coverage', [InvestmentController::class, 'validateCoverageSelection'])->name('validate.coverage.selection');
Route::view('/investment-supporting', 'pages.priorities.investment.investment-supporting')->name('investment.supporting');
Route::post('/investment-supporting', [InvestmentController::class, 'submitInvestmentSupporting'])->name('form.submit.investment.supporting');
Route::view('/investment-annual-return', 'pages.priorities.investment.investment-annual-return')->name('investment.annual.return');
Route::post('/investment-annual-return', [InvestmentController::class, 'submitInvestmentAnnualReturn'])->name('form.submit.investment.annual.return');
Route::view('/investment-expected-return', 'pages.priorities.investment.investment-expected-return')->name('investment.expected.return');
Route::post('/investment-expected-return', [InvestmentController::class, 'submitInvestmentExpectedReturn'])->name('form.submit.investment.expected.return');
Route::view('/investment-gap', 'pages.priorities.investment.investment-gap')->name('investment.gap');
Route::post('/investment-gap', [InvestmentController::class, 'submitInvestmentGap'])->name('form.submit.investment.gap');

/* Priorities - Retirement */
Route::view('/retirement-home', 'pages.priorities.retirement.retirement-home')->name('retirement.home');
Route::view('/retirement-coverage', 'pages.priorities.retirement.retirement-coverage')->name('retirement.coverage');
Route::Post('/retirement-coverage', [formRetirementController::class, 'submitRetirementCoverage'])->name('form.retirement.coverage');
Route::view('/retirement-ideal', 'pages.priorities.retirement.retirement-ideal')->name('retirement.ideal');
Route::Post('/retirement-ideal', [formRetirementController::class, 'submitRetirementIdeal'])->name('form.retirement.ideal');
Route::view('/retirement-age-to-retire', 'pages.priorities.retirement.retirement-age-to-retire')->name('retirement.age.to.retire');
Route::Post('/retirement-age-to-retire', [formRetirementController::class, 'submitRetirementAgeToRetire'])->name('form.age.to.retire');
Route::view('/retirement-allocated-funds', 'pages.priorities.retirement.retirement-allocated-funds ')->name('retirement.allocated.funds');
Route::Post('/retirement-allocated-funds', [formRetirementController::class, 'submitRetirementAllocatedFunds'])->name('form.retirement.allocated.funds');
Route::view('/retirement-years-till-retire', 'pages.priorities.retirement.retirement-years-till-retire')->name('retirement.years.till.retire');
Route::Post('/retirement-years-till-retire', [formRetirementController::class, 'submitRetirementYearsTillRetire'])->name('form.retirement.years.till.retire');
Route::view('/retirement-allocated-funds-aside', 'pages.priorities.retirement.retirement-allocated-funds-aside')->name('retirement.allocated.funds.aside');
Route::Post('/retirement-allocated-funds-aside', [formRetirementController::class, 'submitRetirementAllocatedFundsAside'])->name('form.retirement.allocated.funds.aside');
Route::view('/retirement-gap', 'pages.priorities.retirement.retirement-gap')->name('retirement.gap');

Route::get('/files/{filename}', function($filename){
    return \Storage::download($filename); // assuming default disk is set to 'public'
});

// Sessions
Route::get('/clear-session', [SessionController::class, 'clearSessionData'])->name('clear_session_data');


