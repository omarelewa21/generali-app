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
use App\Http\Controllers\HealthMedicalController;
use App\Http\Controllers\DebtCancellationController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\SessionController;

/* Main pages */
// Route::post('/store-select', [DropdownController::class, 'storeSelect'])->name('store.select');
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::post('/pdpa-disclosure', [FormController::class, 'pdpa'])->name('form.pdpa.disclosure');
Route::post('/basic-details', [FormController::class, 'basicDetails'])->name('form.basic.details');
Route::get('/basic-details', [DropdownController::class, 'titles'])->name('basic.details');

/* Avatar pages */
Route::view('/welcome', 'pages.avatar.avatar-welcome')->name('avatar.welcome');
Route::view('/marital-status', 'pages.avatar.avatar-marital-status')->name('avatar.marital.status');
Route::view('/family-dependant', 'pages.avatar.avatar-family-dependant')->name('avatar.family.dependant');
// Route::get('/family-dependant', [SessionController::class, 'getSession'])->name('get.session');
Route::get('/family-dependant/details', [DropdownController::class, 'familyDependantDetails'])->name('avatar.family.dependant.details');
Route::post('/family-dependant/details', [FormController::class, 'familyDependantDetails'])->name('form.family.dependant.details');
Route::view('/assets', 'pages.avatar.avatar-my-assets')->name('avatar.my.assets');
Route::get('/identity-details', [DropdownController::class, 'identityDetails'])->name('identity.details');
Route::view('/avatar', 'pages.avatar.avatar-gender-selection')->name('avatar.gender.selection');
Route::post('/avatar', [AvatarController::class, 'changeImage'])->name('change.image');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::view('/priorities-menu', 'pages.priorities.priorities-menu')->name('priorities.menu');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateButton'])->name('validate.avatar');

/* Priorities */
Route::view('/financial-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::post('/financial-priorities', [FormController::class, 'topPriorities'])->name('form.top.priorities');
Route::view('/financial-priorities/discuss', 'pages.priorities.priorities-to-discuss')->name('priorities.to.discuss');
Route::post('/financial-priorities/discuss', [FormController::class, 'priorities'])->name('priorities.redirect');

/* Priorities - Protection */
Route::view('/protection-home', 'pages.priorities.protection.protection-home')->name('protection.home');
// this is for testing
Route::view('/protection', 'pages.priorities.protection.protection-home-new')->name('protection.home.new');
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

/* Priorities - Health and Medical */
Route::view('/health-medical-home', 'pages.priorities.health and medical.health-medical-home')->name('health.medical.home');
Route::view('/health-medical-selection', 'pages.priorities.health and medical.health-medical-selection')->name('health.medical.selection');
Route::post('/health-medical-selection', [HealthMedicalController::class, 'validateHealthMedicalSelection'])->name('validate.health.medical.selection');
Route::view('/health-medical/critical-illness/coverage', 'pages.priorities.health and medical.critical-illness.coverage')->name('health.medical.critical.illness.coverage');
Route::post('/health-medical/critical-illness/coverage', [HealthMedicalController::class, 'validateCriticalIllnessCoverageSelection'])->name('validate.critical.illness.coverage.selection');
Route::view('/health-medical/critical-illness/amount-needed', 'pages.priorities.health and medical.critical-illness.amount-needed')->name('health.medical.critical.amount.needed');
Route::post('/health-medical/critical-illness/amount-needed', [HealthMedicalController::class, 'validateCriticalIllnessAmountNeeded'])->name('validate.critical.illness.amount.needed');
Route::view('/health-medical/critical-illness/existing-protection', 'pages.priorities.health and medical.critical-illness.existing-protection')->name('health.medical.critical.existing.protection');
Route::post('/health-medical/critical-illness/existing-protection', [HealthMedicalController::class, 'validateCriticalIllnessExistingProtection'])->name('validate.critical.illness.existing.protection');
Route::view('/health-medical/critical-illness/gap', 'pages.priorities.health and medical.critical-illness.gap')->name('health.medical.critical.gap');
Route::post('/health-medical/critical-illness/gap', [HealthMedicalController::class, 'submitCriticalIllnessGap'])->name('form.submit.critical.illness.gap');
Route::view('/health-medical/medical-planning/coverage', 'pages.priorities.health and medical.medical-planning.coverage')->name('health.medical.medical.planning.coverage');
Route::post('/health-medical/medical-planning/coverage', [HealthMedicalController::class, 'validateMedicalPlanningCoverageSelection'])->name('validate.medical.planning.coverage.selection');
Route::view('/health-medical/medical-planning/hospital-selection', 'pages.priorities.health and medical.medical-planning.hospital-selection')->name('health.medical.planning.hospital.selection');
Route::post('/health-medical/medical-planning/hospital-selection', [HealthMedicalController::class, 'validateMedicalPlanningHospitalSelection'])->name('validate.medical.planning.hospital.selection');
Route::view('/health-medical/medical-planning/room-selection', 'pages.priorities.health and medical.medical-planning.room-selection')->name('health.medical.planning.room.selection');
Route::post('/health-medical/medical-planning/room-selection', [HealthMedicalController::class, 'validateMedicalPlanningRoomSelection'])->name('validate.medical.planning.room.selection');
Route::view('/health-medical/medical-planning/amount-needed', 'pages.priorities.health and medical.medical-planning.amount-needed')->name('health.medical.planning.amount.needed');
Route::post('/health-medical/medical-planning/amount-needed', [HealthMedicalController::class, 'validateMedicalPlanningAmountNeeded'])->name('validate.medical.planning.amount.needed');
Route::view('/health-medical/medical-planning/existing-protection', 'pages.priorities.health and medical.medical-planning.existing-protection')->name('health.medical.planning.existing.protection');
Route::post('/health-medical/medical-planning/existing-protection', [HealthMedicalController::class, 'validateMedicalPlanningExistingProtection'])->name('validate.medical.planning.existing.protection');
Route::view('/health-medical/medical-planning/gap', 'pages.priorities.health and medical.medical-planning.gap')->name('health.medical.planning.gap');
Route::post('/health-medical/medical-planning/gap', [HealthMedicalController::class, 'submitMedicalPlanningGap'])->name('form.submit.medical.planning.gap');

/* Priorities - Debt Cancellation */
Route::view('/debt-cancellation-home', 'pages.priorities.debt-cancellation.debt-cancellation-home')->name('debt.cancellation.home');
Route::view('/debt-cancellation-coverage', 'pages.priorities.debt-cancellation.debt-cancellation-coverage')->name('debt.cancellation.coverage');
Route::post('/debt-cancellation-coverage', [DebtCancellationController::class, 'validateDebtCancellationCoverage'])->name('validate.debt.cancellation.coverage');
Route::view('/debt-cancellation-outstanding-loan', 'pages.priorities.debt-cancellation.debt-cancellation-outstanding-loan')->name('debt.cancellation.outstanding.loan');
Route::post('/debt-cancellation-outstanding-loan', [DebtCancellationController::class, 'validateDebtCancellationOutstandingLoan'])->name('validate.debt.outstanding.loan');
Route::view('/debt-cancellation-settlement-years', 'pages.priorities.debt-cancellation.debt-cancellation-settlement-years')->name('debt.cancellation.settlement.years');
Route::post('/debt-cancellation-settlement-years', [DebtCancellationController::class, 'validateDebtCancellationSettlementYears'])->name('validate.debt.settlement.years');
Route::view('/debt-cancellation-existing-debt', 'pages.priorities.debt-cancellation.debt-cancellation-existing-debt')->name('debt.cancellation.existing.debt');
Route::post('/debt-cancellation-existing-debt', [DebtCancellationController::class, 'validateDebtCancellationExistingDebt'])->name('validate.debt.existing.debt');
Route::view('/debt-cancellation-critical-illness', 'pages.priorities.debt-cancellation.debt-cancellation-critical-illness')->name('debt.cancellation.critical.illness');
Route::post('/debt-cancellation-critical-illness', [DebtCancellationController::class, 'validateDebtCancellationCriticalIllness'])->name('validate.debt.critical.illness');
Route::view('/debt-cancellation-gap', 'pages.priorities.debt-cancellation.debt-cancellation-gap')->name('debt.cancellation.gap');
Route::post('/debt-cancellation-gap', [DebtCancellationController::class, 'submitDebtCancellationGap'])->name('form.submit.debt.cancellation.gap');

// Summary
Route::post('/existing-policy', [FormController::class, 'existingPolicy'])->name('form.existing.policy');
Route::get('/existing-policy', [DropdownController::class, 'existingPolicy'])->name('existing.policy');
Route::view('/financial-statement/monthly-goals', 'pages.summary.monthly-goals')->name('summary.monthly-goals');
Route::view('/financial-statement/expected-income', 'pages.summary.expected-income')->name('summary.expected-income');
Route::view('/financial-statement/increment-amount', 'pages.summary.increment-amount')->name('summary.increment-amount');
Route::view('/summary', 'pages.summary.summary')->name('summary');
Route::view('/overview', 'pages.summary.overview')->name('overview');

// Sessions
Route::get('/clear-session', [SessionController::class, 'clearSessionData'])->name('clear_session_data');
Route::get('/getSessionData', [SessionController::class, 'getSessionData'])->name('get.session.data');
