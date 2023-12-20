<?php
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
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransactionController;

/* Main pages */
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::post('/pdpa-disclosure', [FormController::class, 'pdpa'])->name('form.pdpa.disclosure');
Route::post('/basic-details', [FormController::class, 'basicDetails'])->name('form.basic.details');
Route::get('/basic-details', [DropdownController::class, 'titles'])->name('basic.details');

/* Avatar pages */
Route::view('/welcome', 'pages.avatar.welcome')->name('avatar.welcome');
Route::view('/marital-status', 'pages.avatar.marital-status')->name('avatar.marital.status');
Route::view('/family-dependant', 'pages.avatar.family-dependant')->name('avatar.family.dependant');
Route::get('/family-dependant/details', [DropdownController::class, 'familyDependantDetails'])->name('avatar.family.dependant.details');
Route::post('/family-dependant/details', [FormController::class, 'familyDependantDetails'])->name('form.family.dependant.details');
Route::view('/assets', 'pages.avatar.assets')->name('avatar.my.assets');
Route::get('/identity-details', [DropdownController::class, 'identityDetails'])->name('identity.details');
Route::view('/avatar', 'pages.avatar.gender')->name('avatar.gender.selection');
Route::post('/avatar', [AvatarController::class, 'changeImage'])->name('change.image');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateButton'])->name('validate.avatar');

/* Priorities */
Route::view('/financial-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::post('/financial-priorities', [FormController::class, 'topPriorities'])->name('form.top.priorities');
Route::view('/financial-priorities/discuss', 'pages.priorities.priorities-discuss')->name('priorities.to.discuss');
Route::post('/financial-priorities/discuss', [FormController::class, 'priorities'])->name('priorities.redirect');

/* Priorities - Protection */
Route::view('/protection', 'pages.priorities.protection.home')->name('protection.home');
Route::view('/protection/coverage', 'pages.priorities.protection.coverage')->name('protection.coverage');
Route::post('/protection/coverage', [ProtectionController::class, 'validateProtectionCoverageSelection'])->name('validate.protection.coverage.selection');
Route::view('/protection/amount-needed', 'pages.priorities.protection.amount-needed')->name('protection.amount.needed');
Route::post('/protection/amount-needed', [ProtectionController::class, 'validateProtectionAmountNeeded'])->name('validate.protection.amount.needed');
Route::view('/protection/existing-policy', 'pages.priorities.protection.existing-policy')->name('protection.existing.policy');
Route::post('/protection/existing-policy', [ProtectionController::class, 'validateProtectionExistingPolicy'])->name('validate.protection.existing.policy');
Route::view('/protection/gap', 'pages.priorities.protection.gap')->name('protection.gap');
Route::post('/protection/gap', [ProtectionController::class, 'submitProtectionGap'])->name('form.submit.protection.gap');

/* Priorities - Retirement */
Route::view('/retirement', 'pages.priorities.retirement.home')->name('retirement.home');
Route::view('/retirement/coverage', 'pages.priorities.retirement.coverage')->name('retirement.coverage');
Route::post('/retirement/coverage', [RetirementController::class, 'validateRetirementCoverageSelection'])->name('validate.retirement.coverage.selection');
Route::view('/retirement/ideal', 'pages.priorities.retirement.ideal')->name('retirement.ideal');
Route::Post('/retirement/ideal', [RetirementController::class, 'validateIdeal'])->name('validate.retirement.ideal');
Route::view('/retirement/monthly-support', 'pages.priorities.retirement.monthly-support')->name('retirement.monthly.support');
Route::Post('/retirement/monthly-support', [RetirementController::class, 'validateRetirementMonthlySupport'])->name('validate.retirement.monthly.support');
Route::view('/retirement/period', 'pages.priorities.retirement.period')->name('retirement.period');
Route::Post('/retirement/period', [RetirementController::class, 'validateRetirementPeriod'])->name('validate.retirement.period');
Route::view('/retirement/allocated-funds', 'pages.priorities.retirement.allocated-funds')->name('retirement.allocated.funds');
Route::Post('/retirement/allocated-funds', [RetirementController::class, 'validateRetirementOthers'])->name('validate.retirement.allocated.funds');
Route::view('/retirement/gap', 'pages.priorities.retirement.gap')->name('retirement.gap');
Route::post('/retirement/gap', [RetirementController::class, 'submitRetirementGap'])->name('form.submit.retirement.gap');

Route::view('/retirement-supporting-years', 'pages.priorities.retirement.retirement-supporting-years')->name('retirement.supporting.years');
Route::Post('/retirement-supporting-years', [RetirementController::class, 'validateSupportingYears'])->name('validate.supporting.years');
Route::view('/retirement-retire-age', 'pages.priorities.retirement.retirement-retire-age')->name('retirement.retire.age');
Route::Post('/retirement-retire-age', [RetirementController::class, 'validateRetireAge'])->name('validate.retire.age');

/* Priorities - Education */
Route::view('/education', 'pages.priorities.education.home')->name('education.home');
Route::view('/education/coverage', 'pages.priorities.education.coverage')->name('education.coverage');
Route::post('/education/coverage', [EducationController::class, 'validateEducationCoverageSelection'])->name('validate.education.coverage.selection');
Route::view('/education/amount-needed', 'pages.priorities.education.amount-needed')->name('education.amount.needed');
Route::post('/education/amount-needed', [EducationController::class, 'validateEducationAmountNeeded'])->name('validate.education.amount.needed');
Route::view('/education/existing-fund', 'pages.priorities.education.existing-fund')->name('education.existing.fund');
Route::post('/education/existing-fund', [EducationController::class, 'validateEducationExistingFund'])->name('validate.education.existing.fund');
Route::view('/education/gap', 'pages.priorities.education.gap')->name('education.gap');
Route::post('/education/gap', [EducationController::class, 'submitEducationGap'])->name('form.submit.education.gap');

Route::view('/education-amount', 'pages.priorities.education.education-amount')->name('education.amount');
Route::post('/education-amount', [EducationController::class, 'validateEducationAmount'])->name('validate.education.amount');
Route::view('/education-supporting-years', 'pages.priorities.education.education-supporting-years')->name('education.supporting.years');
Route::post('/education-supporting-years', [EducationController::class, 'validateEducationSupportingYears'])->name('validate.education.supporting');

/* Priorities - Savings */
Route::view('/savings', 'pages.priorities.savings.home')->name('savings.home');
Route::view('/savings/coverage', 'pages.priorities.savings.coverage')->name('savings.coverage');
Route::post('/savings/coverage', [SavingsController::class, 'validateSavingsCoverageSelection'])->name('validate.savings.coverage.selection');
Route::view('/savings/goals', 'pages.priorities.savings.goals')->name('savings.goals');
Route::post('/savings/goals', [SavingsController::class, 'goals'])->name('form.goals');
Route::view('/savings/amount-needed', 'pages.priorities.savings.amount-needed')->name('savings.amount.needed');
Route::post('/savings/amount-needed', [SavingsController::class, 'validateSavingsAmountNeeded'])->name('validate.savings.amount.needed');
Route::view('/savings/annual-return', 'pages.priorities.savings.annual-return')->name('savings.annual.return');
Route::post('/savings/annual-return', [SavingsController::class, 'validateSavingsAnnualReturn'])->name('validate.savings.annual.return');
Route::view('/savings/risk-profile', 'pages.priorities.savings.risk-profile')->name('savings.risk.profile');
Route::post('/savings/risk-profile', [SavingsController::class, 'validateSavingsRiskProfile'])->name('validate.savings.risk.profile');
Route::view('/savings/gap', 'pages.priorities.savings.gap')->name('savings.gap');
Route::post('/savings/gap', [SavingsController::class, 'submitSavingsGap'])->name('form.submit.savings.gap');

Route::view('/savings-monthly-payment', 'pages.priorities.savings.savings-monthly-payment')->name('savings.monthly.payment');
Route::post('/savings-monthly-payment', [SavingsController::class, 'validateMonthlyPayment'])->name('validate.monthly.payment');
Route::view('/savings-goal-duration', 'pages.priorities.savings.savings-goal-duration')->name('savings.goal.duration');
Route::post('/savings-goal-duration', [SavingsController::class, 'validateGoalDuration'])->name('validate.goal.duration');

/* Priorities - Investment */
Route::view('/investment', 'pages.priorities.investment.home')->name('investment.home');
Route::view('/investment/coverage', 'pages.priorities.investment.coverage')->name('investment.coverage');
Route::post('/investment/coverage', [InvestmentController::class, 'validateInvestmentCoverageSelection'])->name('validate.investment.coverage.selection');
Route::view('/investment/amount-needed', 'pages.priorities.investment.amount-needed')->name('investment.amount.needed');
Route::post('/investment/amount-needed', [InvestmentController::class, 'validateInvestmentAmountNeeded'])->name('validate.investment.amount.needed');
Route::view('/investment/annual-return', 'pages.priorities.investment.annual-return')->name('investment.annual.return');
Route::post('/investment/annual-return', [InvestmentController::class, 'validateInvestmentAnnualReturn'])->name('validate.investment.annual.return');
Route::view('/investment/risk-profile', 'pages.priorities.investment.risk-profile')->name('investment.risk.profile');
Route::post('/investment/risk-profile', [InvestmentController::class, 'validateInvestmentRiskProfile'])->name('validate.investment.risk.profile');
Route::view('/investment/gap', 'pages.priorities.investment.gap')->name('investment.gap');
Route::post('/investment/gap', [InvestmentController::class, 'submitInvestmentGap'])->name('form.submit.investment.gap');

Route::view('/investment-monthly-payment', 'pages.priorities.investment.investment-monthly-payment')->name('investment.monthly.payment');
Route::post('/investment-monthly-payment', [InvestmentController::class, 'validateInvestmentMonthlyPayment'])->name('validate.investment.monthly.payment');
Route::view('/investment-supporting', 'pages.priorities.investment.investment-supporting')->name('investment.supporting');
Route::post('/investment-supporting', [InvestmentController::class, 'validateInvestmentSupporting'])->name('validate.investment.supporting');

/* Priorities - Health and Medical */
Route::view('/health-medical', 'pages.priorities.health and medical.home')->name('health.medical.home');
Route::view('/health-medical/medical-selection', 'pages.priorities.health and medical.medical-selection')->name('health.medical.selection');
Route::post('/health-medical/medical-selection', [HealthMedicalController::class, 'validateHealthMedicalSelection'])->name('validate.health.medical.selection');
Route::view('/health-medical/critical-illness/coverage', 'pages.priorities.health and medical.critical-illness.coverage')->name('health.medical.critical.illness.coverage');
Route::post('/health-medical/critical-illness/coverage', [HealthMedicalController::class, 'validateCriticalIllnessCoverageSelection'])->name('validate.critical.illness.coverage.selection');
Route::view('/health-medical/critical-illness/amount-needed', 'pages.priorities.health and medical.critical-illness.amount-needed')->name('health.medical.critical.amount.needed');
Route::post('/health-medical/critical-illness/amount-needed', [HealthMedicalController::class, 'validateCriticalIllnessAmountNeeded'])->name('validate.critical.illness.amount.needed');
Route::view('/health-medical/critical-illness/existing-care', 'pages.priorities.health and medical.critical-illness.existing-protection')->name('health.medical.critical.existing.protection');
Route::post('/health-medical/critical-illness/existing-care', [HealthMedicalController::class, 'validateCriticalIllnessExistingProtection'])->name('validate.critical.illness.existing.protection');
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
Route::view('/health-medical/medical-planning/existing-care', 'pages.priorities.health and medical.medical-planning.existing-protection')->name('health.medical.planning.existing.protection');
Route::post('/health-medical/medical-planning/existing-care', [HealthMedicalController::class, 'validateMedicalPlanningExistingProtection'])->name('validate.medical.planning.existing.protection');
Route::view('/health-medical/medical-planning/gap', 'pages.priorities.health and medical.medical-planning.gap')->name('health.medical.planning.gap');
Route::post('/health-medical/medical-planning/gap', [HealthMedicalController::class, 'submitMedicalPlanningGap'])->name('form.submit.medical.planning.gap');

/* Priorities - Debt Cancellation */
Route::view('/debt-cancellation', 'pages.priorities.debt-cancellation.home')->name('debt.cancellation.home');
Route::view('/debt-cancellation/coverage', 'pages.priorities.debt-cancellation.coverage')->name('debt.cancellation.coverage');
Route::post('/debt-cancellation/coverage', [DebtCancellationController::class, 'validateDebtCancellationCoverage'])->name('validate.debt.cancellation.coverage');
Route::view('/debt-cancellation/amount-needed', 'pages.priorities.debt-cancellation.amount-needed')->name('debt.cancellation.amount.needed');
Route::post('/debt-cancellation/amount-needed', [DebtCancellationController::class, 'validateDebtCancellationAmountNeeded'])->name('validate.debt.cancellation.amount.needed');
Route::view('/debt-cancellation/existing-debt', 'pages.priorities.debt-cancellation.existing-debt')->name('debt.cancellation.existing.debt');
Route::post('/debt-cancellation/existing-debt', [DebtCancellationController::class, 'validateDebtCancellationExistingDebt'])->name('validate.debt.existing.debt');
Route::view('/debt-cancellation/critical-illness', 'pages.priorities.debt-cancellation.critical-illness')->name('debt.cancellation.critical.illness');
Route::post('/debt-cancellation/critical-illness', [DebtCancellationController::class, 'validateDebtCancellationCriticalIllness'])->name('validate.debt.critical.illness');
Route::view('/debt-cancellation/gap', 'pages.priorities.debt-cancellation.gap')->name('debt.cancellation.gap');
Route::post('/debt-cancellation/gap', [DebtCancellationController::class, 'submitDebtCancellationGap'])->name('form.submit.debt.cancellation.gap');

Route::view('/debt-cancellation-outstanding-loan', 'pages.priorities.debt-cancellation.debt-cancellation-outstanding-loan')->name('debt.cancellation.outstanding.loan');
Route::post('/debt-cancellation-outstanding-loan', [DebtCancellationController::class, 'validateDebtCancellationOutstandingLoan'])->name('validate.debt.outstanding.loan');
Route::view('/debt-cancellation-settlement-years', 'pages.priorities.debt-cancellation.debt-cancellation-settlement-years')->name('debt.cancellation.settlement.years');
Route::post('/debt-cancellation-settlement-years', [DebtCancellationController::class, 'validateDebtCancellationSettlementYears'])->name('validate.debt.settlement.years');

// Summary
Route::post('/existing-policy', [FormController::class, 'existingPolicy'])->name('form.existing.policy');
Route::get('/existing-policy', [DropdownController::class, 'existingPolicy'])->name('existing.policy');
Route::view('/financial-statement/monthly-goals', 'pages.summary.monthly-goals')->name('summary.monthly-goals');
Route::post('/financial-statement/monthly-goals', [SummaryController::class, 'validateSummaryMonthlyGoals'])->name('validate.summary.monthly.goals');
Route::view('/financial-statement/expected-income', 'pages.summary.expected-income')->name('summary.expected-income');
Route::post('/financial-statement/expected-income', [SummaryController::class, 'validateSummaryExpectedIncome'])->name('validate.summary.expected.income');
Route::view('/financial-statement/increment-amount', 'pages.summary.increment-amount')->name('summary.increment-amount');
Route::post('/financial-statement/increment-amount', [SummaryController::class, 'validateSummaryIncrementAmount'])->name('validate.summary.increment.amount');
Route::view('/summary', 'pages.summary.summary')->name('summary');
Route::view('/overview-new', 'pages.summary.overview')->name('overview');
Route::view('/overview', 'pages.summary.overview-new')->name('overview-new');

// Sessions
Route::get('/clear-session', [SessionController::class, 'clearSessionData'])->name('clear_session_data');
Route::get('/getSessionData', [SessionController::class, 'getSessionData'])->name('get.session.data');

// Admin Dashboard
Route::view('/login', 'pages.login')->name('login');
Route::view('/agent', 'pages.dashboard.agent')->name('dashboard');
Route::view('/agent/logs', 'pages.dashboard.logs')->name('logs');
// Route::get('/agent/logs', [TransactionController::class, 'index'])->name('transactions.logs');
Route::get('/agent/logs', function () {
    return view('pages.dashboard.logs');
});