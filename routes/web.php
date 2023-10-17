<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\formProtectionController;
use App\Http\Controllers\formRetirementController;
use App\Http\Controllers\ProtectionController;
use App\Http\Controllers\RetirementController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SavingsController;
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
Route::get('/family-dependant-details', [DropdownController::class, 'familyDependantDetails'])->name('avatar.family.dependant.details');
Route::post('/family-dependant-details', [FormController::class, 'familyDependantDetails'])->name('form.family.dependant.details');
Route::view('/assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');
Route::get('/identity-details', [DropdownController::class, 'identityDetails'])->name('identity.details');
Route::view('/gender', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::post('/gender', [AvatarController::class, 'changeImage'])->name('change.image');
// Route::get('/avatar-gender-selection', [FormController::class, 'formSession'])->name('avatar.gender.selection');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::view('/priorities-menu', 'pages.priorities.priorities-menu')->name('priorities.menu');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateButton'])->name('validate.avatar');

/* Priorities */
Route::view('/top-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::post('/top-priorities', [FormController::class, 'topPriorities'])->name('form.top.priorities');
Route::view('/top-priorities-new', 'pages.priorities.top-priorities-new')->name('top.priorities.new');
Route::view('/priorities-to-discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');

/* Priorities - Protection */
Route::view('/protection-home-archived', 'pages.priorities.protection.protection-home-archived')->name('protection.home.archived');
Route::view('/protection-coverage-archived', 'pages.priorities.protection.protection-coverage-archived')->name('protection.coverage.archived');
Route::post('/protection-coverage-archived', [formProtectionController::class, 'submitProtectionCoverage'])->name('form.protection.coverage');
Route::view('/protection-monthly-support-archived', 'pages.priorities.protection.protection-monthly-support-archived')->name('protection.monthly.support.archived');
Route::post('/protection-monthly-support-archived', [formProtectionController::class, 'submitProtectionMonthlySupport'])->name('form.protection.monthly.support');
Route::view('/protection-supporting-years-archived', 'pages.priorities.protection.protection-supporting-years-archived')->name('protection.supporting.years.archived');
Route::post('/protection-supporting-years-archived', [formProtectionController::class, 'submitProtectionSupportingYears'])->name('form.protection.supporting.years');
Route::view('/protection-existing-policy-archived', 'pages.priorities.protection.protection-existing-policy-archived')->name('protection.existing.policy.archived');
Route::post('/protection-existing-policy-archived', [formProtectionController::class, 'submitProtectionExistingPolicy'])->name('form.protection.existing.policy');
Route::view('/protection-gap-archived', 'pages.priorities.protection.protection-gap-archived')->name('protection.gap.archived');
Route::view('/protection-gap2', 'pages.priorities.protection.protection-gap2')->name('protection.gap2');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');
Route::view('/protection-coverage', 'pages.priorities.protection.protection-coverage')->name('protection.coverage');
Route::post('/protection-coverage', [ProtectionController::class, 'validateProtectionCoverageSelection'])->name('validate.protection.coverage.selection');
Route::view('/protection-monthly-support', 'pages.priorities.protection.protection-monthly-support')->name('protection.monthly.support');
Route::post('/protection-monthly-support', [ProtectionController::class, 'validateMonthlySupport'])->name('validate.monthly.support');
Route::view('/protection-supporting-years', 'pages.priorities.protection.protection-supporting-years')->name('protection.supporting.years');
Route::post('/protection-supporting-years', [ProtectionController::class, 'validateProtectionSupporting'])->name('validate.protection.supporting');
Route::view('/protection-existing-policy', 'pages.priorities.protection.protection-existing-policy')->name('protection.existing.policy');
Route::post('/protection-existing-policy', [ProtectionController::class, 'validateProtectionExistingPolicy'])->name('validate.protection.existing.policy');
Route::view('/protection-gap', 'pages.priorities.protection.protection-gap')->name('protection.gap');
Route::post('/protection-gap', [ProtectionController::class, 'submitProtectionGap'])->name('form.submit.protection.gap');

/* Priorities - Retirement */
Route::view('/retirement-home', 'pages.priorities.retirement.retirement-home')->name('retirement.home');
Route::view('/retirement-coverage', 'pages.priorities.retirement.retirement-coverage')->name('retirement.coverage');
Route::post('/retirement-coverage', [RetirementController::class, 'validateRetirementCoverageSelection'])->name('validate.retirement.coverage.selection');
Route::view('/retirement-ideal', 'pages.priorities.retirement.retirement-ideal')->name('retirement.ideal');
Route::Post('/retirement-ideal', [RetirementController::class, 'validateIdeal'])->name('validate.retirement.ideal');
Route::view('/retirement-monthly-support', 'pages.priorities.retirement.retirement-monthly-support')->name('retirement.monthly.support');
Route::Post('/retirement-monthly-support', [RetirementController::class, 'validateMonthlySupport'])->name('validate.retirement.monthly.support');
Route::view('/retirement-supporting-years', 'pages.priorities.retirement.retirement-supporting-years')->name('retirement.supporting.years');
Route::Post('/retirement-supporting-years', [RetirementController::class, 'validateSupportingYears'])->name('validate.supporting.years');
Route::view('/retirement-retire-age', 'pages.priorities.retirement.retirement-retire-age')->name('retirement.retire.age');
Route::Post('/retirement-retire-age', [RetirementController::class, 'validateRetireAge'])->name('validate.retire.age');
Route::view('/retirement-others', 'pages.priorities.retirement.retirement-others')->name('retirement.others');
Route::Post('/retirement-others', [RetirementController::class, 'validateOthers'])->name('validate.others');
Route::view('/retirement-gap', 'pages.priorities.retirement.retirement-gap')->name('retirement.gap');
Route::post('/retirement-gap', [RetirementController::class, 'submitRetirementGap'])->name('form.submit.retirement.gap');

/* Priorities - Education */
Route::view('/education-home', 'pages.priorities.education.education-home')->name('education.home');
Route::view('/education-coverage', 'pages.priorities.education.education-coverage')->name('education.coverage');
Route::post('/education-coverage', [EducationController::class, 'validateEducationCoverageSelection'])->name('validate.education.coverage.selection');
Route::view('/education-amount', 'pages.priorities.education.education-amount')->name('education.amount');
Route::post('/education-amount', [EducationController::class, 'validateEducationAmount'])->name('validate.education.amount');
Route::view('/education-supporting-years', 'pages.priorities.education.education-supporting-years')->name('education.supporting.years');
Route::post('/education-supporting-years', [EducationController::class, 'validateEducationSupportingYears'])->name('validate.education.supporting');
Route::view('/education-existing-fund', 'pages.priorities.education.education-existing-fund')->name('education.existing.fund');
Route::post('/education-existing-fund', [EducationController::class, 'validateEducationExistingFund'])->name('validate.education.existing.fund');
Route::view('/education-gap', 'pages.priorities.education.education-gap')->name('education.gap');
Route::post('/education-gap', [EducationController::class, 'submitEducationGap'])->name('form.submit.education.gap');

/* Priorities - Savings */
Route::view('/savings-home', 'pages.priorities.savings.savings-home')->name('savings.home');
Route::view('/savings-coverage', 'pages.priorities.savings.savings-coverage')->name('savings.coverage');
Route::post('/savings-coverage', [SavingsController::class, 'validateSavingsCoverageSelection'])->name('validate.savings.coverage.selection');
Route::view('/savings-monthly-payment', 'pages.priorities.savings.savings-monthly-payment')->name('savings.monthly.payment');
Route::post('/savings-monthly-payment', [SavingsController::class, 'validateMonthlyPayment'])->name('validate.monthly.payment');
Route::view('/savings-goals', 'pages.priorities.savings.savings-goals')->name('savings.goals');
Route::post('/savings-goals', [SavingsController::class, 'goals'])->name('form.goals');
Route::view('/savings-goal-duration', 'pages.priorities.savings.savings-goal-duration')->name('savings.goal.duration');
Route::post('/savings-goal-duration', [SavingsController::class, 'validateGoalDuration'])->name('validate.goal.duration');
Route::view('/savings-annual-return', 'pages.priorities.savings.savings-annual-return')->name('savings.annual.return');
Route::post('/savings-annual-return', [SavingsController::class, 'validateSavingsAnnualReturn'])->name('validate.savings.annual.return');
Route::view('/savings-risk-profile', 'pages.priorities.savings.savings-risk-profile')->name('savings.risk.profile');
Route::post('/savings-risk-profile', [SavingsController::class, 'validateSavingsRiskProfile'])->name('validate.savings.risk.profile');
Route::view('/savings-gap', 'pages.priorities.savings.savings-gap')->name('savings.gap');
Route::post('/savings-gap', [SavingsController::class, 'submitSavingsGap'])->name('form.submit.savings.gap');

/* Priorities - Investment */
Route::view('/investment-home', 'pages.priorities.investment.investment-home')->name('investment.home');
Route::view('/investment-coverage', 'pages.priorities.investment.investment-coverage')->name('investment.coverage');
Route::post('/investment-coverage', [InvestmentController::class, 'validateInvestmentCoverageSelection'])->name('validate.investment.coverage.selection');
Route::view('/investment-monthly-payment', 'pages.priorities.investment.investment-monthly-payment')->name('investment.monthly.payment');
Route::post('/investment-monthly-payment', [InvestmentController::class, 'validateInvestmentMonthlyPayment'])->name('validate.investment.monthly.payment');
Route::view('/investment-supporting', 'pages.priorities.investment.investment-supporting')->name('investment.supporting');
Route::post('/investment-supporting', [InvestmentController::class, 'validateInvestmentSupporting'])->name('validate.investment.supporting');
Route::view('/investment-annual-return', 'pages.priorities.investment.investment-annual-return')->name('investment.annual.return');
Route::post('/investment-annual-return', [InvestmentController::class, 'validateInvestmentAnnualReturn'])->name('validate.investment.annual.return');
Route::view('/investment-risk-profile', 'pages.priorities.investment.investment-risk-profile')->name('investment.risk.profile');
Route::post('/investment-risk-profile', [InvestmentController::class, 'validateInvestmentRiskProfile'])->name('validate.investment.risk.profile');
Route::view('/investment-gap', 'pages.priorities.investment.investment-gap')->name('investment.gap');
Route::post('/investment-gap', [InvestmentController::class, 'submitInvestmentGap'])->name('form.submit.investment.gap');

/* Priorities - Retirement */
Route::view('/retirement-home-archived', 'pages.priorities.retirement.retirement-home-archived')->name('retirement.home.archived');
Route::view('/retirement-coverage-archived', 'pages.priorities.retirement.retirement-coverage-archived')->name('retirement.coverage.archived');
Route::Post('/retirement-coverage-archived', [formRetirementController::class, 'submitRetirementCoverage'])->name('form.retirement.coverage');
Route::view('/retirement-ideal-archived', 'pages.priorities.retirement.retirement-ideal-archived')->name('retirement.ideal.archived');
Route::Post('/retirement-ideal-archived', [formRetirementController::class, 'submitRetirementIdeal'])->name('form.retirement.ideal');
Route::view('/retirement-age-to-retire-archived', 'pages.priorities.retirement.retirement-age-to-retire-archived')->name('retirement.age.to.retire.archived');
Route::Post('/retirement-age-to-retire-archived', [formRetirementController::class, 'submitRetirementAgeToRetire'])->name('form.age.to.retire');
Route::view('/retirement-allocated-funds-archived', 'pages.priorities.retirement.retirement-allocated-funds-archived ')->name('retirement.allocated.funds.archived');
Route::Post('/retirement-allocated-funds-archived', [formRetirementController::class, 'submitRetirementAllocatedFunds'])->name('form.retirement.allocated.funds');
Route::view('/retirement-years-till-retire-archived', 'pages.priorities.retirement.retirement-years-till-retire-archived')->name('retirement.years.till.retire.archived');
Route::Post('/retirement-years-till-retire-archived', [formRetirementController::class, 'submitRetirementYearsTillRetire'])->name('form.retirement.years.till.retire');
Route::view('/retirement-allocated-funds-aside-archived', 'pages.priorities.retirement.retirement-allocated-funds-aside-archived')->name('retirement.allocated.funds.aside.archived');
Route::Post('/retirement-allocated-funds-aside-archived', [formRetirementController::class, 'submitRetirementAllocatedFundsAside'])->name('form.retirement.allocated.funds.aside');
Route::view('/retirement-gap-archived', 'pages.priorities.retirement.retirement-gap-archived')->name('retirement.gap.archived');

// Route::get('/files/{filename}', function($filename){
//     return \Storage::download($filename); // assuming default disk is set to 'public'
// });

// Sessions
Route::get('/clear-session', [SessionController::class, 'clearSessionData'])->name('clear_session_data');