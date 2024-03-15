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
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ProtectionController;
use App\Http\Controllers\RetirementController;
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HealthMedicalController;
use App\Http\Controllers\DebtCancellationController;

/* Main pages */
Route::view('/', 'pages.main.welcome')->name('welcome');
Route::get('/welcome-new', [FormController::class, 'createNewForm'])->name('welcome-new');
Route::view('/pdpa-disclosure', 'pages.main.pdpa-disclosure')->name('pdpa.disclosure');
Route::post('/pdpa-disclosure', [FormController::class, 'pdpa'])->name('form.pdpa.disclosure');
Route::get('/basic-details', [DropdownController::class, 'titles'])->name('basic.details');
Route::post('/basic-details', [FormController::class, 'basicDetails'])->name('form.basic.details');

/* Avatar pages */
Route::view('/welcome', 'pages.avatar.welcome')->name('avatar.welcome');
// Route::view('/marital-status', 'pages.avatar.marital-status')->name('marital.status');

Route::get('/marital-status',[DropdownController::class,'maritalStatus'])->name('marital.status');
Route::post('/marital-status', [FormController::class, 'handleAvatarSelection'])->name('form.avatar.marital.status');

// Route::view('/family-dependent', 'pages.avatar.family-dependent')->name('family.dependent');
Route::get('/family-dependent',[DropdownController::class,'familyDependent'])->name('family.dependent');
Route::post('/family-dependent', [FormController::class, 'handleAvatarSelection'])->name('form.avatar.family.dependent');

Route::get('/family-dependent/details', [DropdownController::class, 'familyDependentDetails'])->name('family.dependent.details');
Route::post('/family-dependent/details', [FormController::class, 'familyDependentDetails'])->name('form.family.dependent.details');

// Route::view('/assets', 'pages.avatar.assets')->name('avatar.my.assets');
Route::get('/assets', [DropdownController::class, 'assets'])->name('assets');
Route::post('/assets', [FormController::class, 'handleAvatarSelection'])->name('assets');

Route::get('/identity-details', [DropdownController::class, 'identityDetails'])->name('identity.details');
Route::post('/identity-details', [FormController::class, 'submitIdentity'])->name('form.submit.identity');

Route::view('/avatar', 'pages.avatar.gender')->name('avatar');
Route::post('/avatar', [AvatarController::class, 'changeImage'])->name('change.image');
Route::post('/change-image', [AvatarController::class, 'changeImage'])->name('changeImage');
Route::post('/handle-avatar-selection', [FormController::class, 'handleAvatarSelection'])->name('handle.avatar.selection');
Route::post('/validate-avatar', [FormController::class, 'validateButton'])->name('validate.avatar');



/* Priorities */
// Route::view('/financial-priorities', 'pages.priorities.top-priorities')->name('top.priorities');
Route::get('/financial-priorities', [DropdownController::class, 'financialPriorities'])->name('financial.priorities');
Route::post('/financial-priorities', [FormController::class, 'topPriorities'])->name('form.top.priorities');
// Route::view('/financial-priorities/discuss', 'pages.priorities.priorities-discuss')->name('priorities.to.discuss');
Route::get('/financial-priorities/discuss', [DropdownController::class, 'financialPrioritiesDiscuss'])->name('financial.priorities.discuss');
Route::post('/financial-priorities/discuss', [FormController::class, 'priorities'])->name('priorities.redirect');

/* Priorities - Protection */
Route::prefix('protection')->group(function () {
    Route::get('/', [PriorityController::class, 'protectionHome'])->name('protection.home');
    
    Route::get('/coverage', [PriorityController::class, 'protectionCoverage'])->name('protection.coverage');
    Route::post('/coverage', [ProtectionController::class, 'validateProtectionCoverageSelection'])->name('validate.protection.coverage.selection');
    
    Route::get('/amount-needed', [PriorityController::class, 'protectionAmountNeeded'])->name('protection.amount.needed');
    Route::post('/amount-needed', [ProtectionController::class, 'validateProtectionAmountNeeded'])->name('validate.protection.amount.needed');
    
    Route::get('/existing-policy', [PriorityController::class, 'protectionExistingPolicy'])->name('protection.existing.policy');
    Route::post('/existing-policy', [ProtectionController::class, 'validateProtectionExistingPolicy'])->name('validate.protection.existing.policy');
    
    Route::get('/gap', [PriorityController::class, 'protectionGap'])->name('protection.gap');
    Route::post('/gap', [ProtectionController::class, 'submitProtectionGap'])->name('form.submit.protection.gap');
});

/* Priorities - Retirement */
Route::prefix('retirement')->group(function () {

    Route::get('/', [PriorityController::class, 'retirementHome'])->name('retirement.home');

    Route::get('/coverage', [PriorityController::class, 'retirementCoverage'])->name('retirement.coverage');
    Route::post('/coverage', [RetirementController::class, 'validateRetirementCoverageSelection'])->name('validate.retirement.coverage.selection');

    Route::get('/ideal', [PriorityController::class, 'retirementIdeal'])->name('retirement.ideal');
    Route::post('/ideal', [RetirementController::class, 'validateIdeal'])->name('validate.retirement.ideal');

    Route::get('/monthly-support', [PriorityController::class, 'retirementMonthlySupport'])->name('retirement.monthly.support');
    Route::post('/monthly-support', [RetirementController::class, 'validateRetirementMonthlySupport'])->name('validate.retirement.monthly.support');

    Route::get('/period', [PriorityController::class, 'retirementPeriod'])->name('retirement.period');
    Route::post('/period', [RetirementController::class, 'validateRetirementPeriod'])->name('validate.retirement.period');

    Route::get('/allocated-funds', [PriorityController::class, 'retirementAllocatedFunds'])->name('retirement.allocated.funds');
    Route::post('/allocated-funds', [RetirementController::class, 'validateRetirementOthers'])->name('validate.retirement.allocated.funds');

    Route::get('/gap', [PriorityController::class, 'retirementGap'])->name('retirement.gap');
    Route::post('/gap', [RetirementController::class, 'submitRetirementGap'])->name('form.submit.retirement.gap');  
});

Route::get('/retirement-supporting-years', [PriorityController::class, 'retirementSupportingYears'])->name('retirement.supporting.years');
Route::post('/retirement-supporting-years', [RetirementController::class, 'validateSupportingYears'])->name('validate.supporting.years');

Route::get('/retirement-retire-age', [PriorityController::class, 'retirementAge'])->name('retirement.retire.age');
Route::post('/retirement-retire-age', [RetirementController::class, 'validateRetireAge'])->name('validate.retire.age');

/* Priorities - Education */
Route::prefix('education')->group(function () {
    Route::get('/', [PriorityController::class, 'educationHome'])->name('education.home');

    Route::get('/coverage', [PriorityController::class, 'educationCoverage'])->name('education.coverage');
    Route::post('/coverage', [EducationController::class, 'validateEducationCoverageSelection'])->name('validate.education.coverage.selection');

    Route::get('/amount-needed', [PriorityController::class, 'educationAmountNeeded'])->name('education.amount.needed');
    Route::post('/amount-needed', [EducationController::class, 'validateEducationAmountNeeded'])->name('validate.education.amount.needed');

    Route::get('/existing-fund', [PriorityController::class, 'educationExistingFund'])->name('education.existing.fund');
    Route::post('/existing-fund', [EducationController::class, 'validateEducationExistingFund'])->name('validate.education.existing.fund');

    Route::get('/gap',[PriorityController::class, 'educationGap'])->name('education.gap');
    Route::post('/gap', [EducationController::class, 'submitEducationGap'])->name('form.submit.education.gap');
});

Route::get('/education-amount', [PriorityController::class, 'educationAmount'])->name('education.amount');
Route::post('/education-amount', [EducationController::class, 'validateEducationAmount'])->name('validate.education.amount');

Route::get('/education-supporting-years', [PriorityController::class, 'educationSupportingYears'])->name('education.supporting.years');
Route::post('/education-supporting-years', [EducationController::class, 'validateEducationSupportingYears'])->name('validate.education.supporting');

/* Priorities - Savings */
Route::prefix('savings')->group(function () {

    Route::get('/savings', [PriorityController::class, 'savingsHome'])->name('savings.home');

    Route::get('/coverage', [PriorityController::class, 'savingsCoverage'])->name('savings.coverage');
    Route::post('/coverage', [SavingsController::class, 'validateSavingsCoverageSelection'])->name('validate.savings.coverage.selection');

    Route::get('/goals', [PriorityController::class, 'savingsGoals'])->name('savings.goals');
    Route::post('/goals', [SavingsController::class, 'goals'])->name('form.goals');

    Route::get('/amount-needed', [PriorityController::class, 'savingsAmountNeeded'])->name('savings.amount.needed');
    Route::post('/amount-needed', [SavingsController::class, 'validateSavingsAmountNeeded'])->name('validate.savings.amount.needed');

    Route::get('/annual-return', [PriorityController::class, 'savingsAnnualReturn'])->name('savings.annual.return');
    Route::post('/annual-return', [SavingsController::class, 'validateSavingsAnnualReturn'])->name('validate.savings.annual.return');

    Route::get('/gap',[PriorityController::class, 'savingsGap'])->name('savings.gap');
    Route::post('/gap', [SavingsController::class, 'submitSavingsGap'])->name('form.submit.savings.gap');

});

Route::get('/savings-monthly-payment', [PriorityController::class, 'savingsMonthlyPayment'])->name('savings.monthly.payment');
Route::post('/savings-monthly-payment', [SavingsController::class, 'validateMonthlyPayment'])->name('validate.monthly.payment');

Route::get('/savings-goal-duration', [PriorityController::class, 'savingsGoalDuration'])->name('savings.goal.duration');
Route::post('/savings-goal-duration', [SavingsController::class, 'validateGoalDuration'])->name('validate.goal.duration');

/* Priorities - Investment */
Route::prefix('investment')->group(function () {

    Route::get('/', [PriorityController::class, 'investmentHome'])->name('investment.home');

    Route::get('/coverage', [PriorityController::class, 'investmentCoverage'])->name('investment.coverage');
    Route::post('/coverage', [InvestmentController::class, 'validateInvestmentCoverageSelection'])->name('validate.investment.coverage.selection');

    Route::get('/amount-needed', [PriorityController::class, 'investmentAmountNeeded'])->name('investment.amount.needed');
    Route::post('/amount-needed', [InvestmentController::class, 'validateInvestmentAmountNeeded'])->name('validate.investment.amount.needed');

    Route::get('/annual-return', [PriorityController::class, 'investmentAnnualReturn'])->name('investment.annual.return');
    Route::post('/annual-return', [InvestmentController::class, 'validateInvestmentAnnualReturn'])->name('validate.investment.annual.return');

    Route::get('/risk-profile',[PriorityController::class, 'investmentRiskProfile'])->name('investment.risk.profile');
    Route::post('/risk-profile', [InvestmentController::class, 'validateInvestmentRiskProfile'])->name('validate.investment.risk.profile');

    Route::get('/gap', [PriorityController::class, 'investmentGap'])->name('investment.gap');
    Route::post('/gap', [InvestmentController::class, 'submitInvestmentGap'])->name('form.submit.investment.gap');

});

Route::get('/investment-monthly-payment', [PriorityController::class, 'investmentMonthlyPayment'])->name('investment.monthly.payment');
Route::post('/investment-monthly-payment', [InvestmentController::class, 'validateInvestmentMonthlyPayment'])->name('validate.investment.monthly.payment');

Route::get('/investment-supporting',[PriorityController::class, 'investmentSupporting'])->name('investment.supporting');
Route::post('/investment-supporting', [InvestmentController::class, 'validateInvestmentSupporting'])->name('validate.investment.supporting');

// Risk Profile
Route::get('/risk-profile', [PriorityController::class, 'riskProfile'])->name('risk.profile');
Route::post('/risk-profile', [SummaryController::class, 'validateRiskProfile'])->name('validate.risk.profile');

/* Priorities - Health and Medical */
Route::prefix('health-medical')->group(function () {

    Route::get('/', [PriorityController::class, 'healthMedicalHome'])->name('health.medical.home');

    Route::get('/medical-selection', [PriorityController::class, 'healthMedicalSelection'])->name('health.medical.medical.selection');
    Route::post('/medical-selection', [HealthMedicalController::class, 'validateHealthMedicalSelection'])->name('validate.health.medical.selection');

    Route::get('/critical-illness/coverage', [PriorityController::class, 'healthMedicalCriticalIllnessCoverage'])->name('health.medical.critical.illness.coverage');
    Route::post('/critical-illness/coverage', [HealthMedicalController::class, 'validateCriticalIllnessCoverageSelection'])->name('validate.critical.illness.coverage.selection');

    Route::get('/critical-illness/amount-needed', [PriorityController::class, 'healthMedicalCriticalAmountNeeded'])->name('health.medical.critical.amount.needed');
    Route::post('/critical-illness/amount-needed', [HealthMedicalController::class, 'validateCriticalIllnessAmountNeeded'])->name('validate.critical.illness.amount.needed');

    Route::get('/critical-illness/existing-care', [PriorityController::class, 'healthMedicalCriticalExistingProtection'])->name('health.medical.critical.existing.protection');
    Route::post('/critical-illness/existing-care', [HealthMedicalController::class, 'validateCriticalIllnessExistingProtection'])->name('validate.critical.illness.existing.protection');

    Route::get('/critical-illness/gap', [PriorityController::class, 'healthMedicalCriticalGap'])->name('health.medical.critical.gap');
    Route::post('/critical-illness/gap', [HealthMedicalController::class, 'submitCriticalIllnessGap'])->name('form.submit.critical.illness.gap');

    Route::get('/medical-planning/coverage', [PriorityController::class, 'healthMedicalPlanningCoverage'])->name('health.medical.medical.planning.coverage');
    Route::post('/medical-planning/coverage', [HealthMedicalController::class, 'validateMedicalPlanningCoverageSelection'])->name('validate.medical.planning.coverage.selection');

    Route::get('/medical-planning/hospital-selection', [PriorityController::class, 'healthMedicalHospitalSelection'])->name('health.medical.planning.hospital.selection');
    Route::post('/medical-planning/hospital-selection', [HealthMedicalController::class, 'validateMedicalPlanningHospitalSelection'])->name('validate.medical.planning.hospital.selection');

    Route::get('/medical-planning/room-selection', [PriorityController::class, 'healthMedicalRoomSelection'])->name('health.medical.planning.room.selection');
    Route::post('/health-medical/medical-planning/room-selection', [HealthMedicalController::class, 'validateMedicalPlanningRoomSelection'])->name('validate.medical.planning.room.selection');

    Route::get('/medical-planning/amount-needed', [PriorityController::class, 'healthMedicalPlanningAmountNeeded'])->name('health.medical.planning.amount.needed');
    Route::post('/medical-planning/amount-needed', [HealthMedicalController::class, 'validateMedicalPlanningAmountNeeded'])->name('validate.medical.planning.amount.needed');

    Route::get('/medical-planning/existing-care', [PriorityController::class, 'healthMedicalPanningExistingProtection'])->name('health.medical.planning.existing.protection');
    Route::post('/medical-planning/existing-care', [HealthMedicalController::class, 'validateMedicalPlanningExistingProtection'])->name('validate.medical.planning.existing.protection');

    Route::get('/medical-planning/gap', [PriorityController::class, 'healthMedicalPlanningGap'])->name('health.medical.planning.gap');
    Route::post('/medical-planning/gap', [HealthMedicalController::class, 'submitMedicalPlanningGap'])->name('form.submit.medical.planning.gap');

});

/* Priorities - Debt Cancellation */
Route::prefix('debt-cancellation')->group(function () {

    Route::get('/', [PriorityController::class, 'debtCancellationHome'])->name('debt.cancellation.home');

    Route::get('/coverage', [PriorityController::class, 'debtCancellationCoverage'])->name('debt.cancellation.coverage');
    Route::post('/coverage', [DebtCancellationController::class, 'validateDebtCancellationCoverage'])->name('validate.debt.cancellation.coverage');

    Route::get('/amount-needed', [PriorityController::class, 'debtCancellationAmountNeeded'])->name('debt.cancellation.amount.needed');
    Route::post('/amount-needed', [DebtCancellationController::class, 'validateDebtCancellationAmountNeeded'])->name('validate.debt.cancellation.amount.needed');

    Route::get('/existing-debt', [PriorityController::class, 'debtCancellationExistingDebt'])->name('debt.cancellation.existing.debt');
    Route::post('/existing-debt', [DebtCancellationController::class, 'validateDebtCancellationExistingDebt'])->name('validate.debt.existing.debt');

    Route::get('/critical-illness', [PriorityController::class, 'debtCancellationCriticalIllness'])->name('debt.cancellation.critical.illness');
    Route::post('/critical-illness', [DebtCancellationController::class, 'validateDebtCancellationCriticalIllness'])->name('validate.debt.critical.illness');

    Route::get('/gap', [PriorityController::class, 'debtCancellationGap'])->name('debt.cancellation.gap');
    Route::post('/gap', [DebtCancellationController::class, 'submitDebtCancellationGap'])->name('form.submit.debt.cancellation.gap');
});



Route::get('/debt-cancellation-outstanding-loan', [PriorityController::class, 'debtCancellationOutStandingLoan'])->name('debt.cancellation.outstanding.loan');
Route::post('/debt-cancellation-outstanding-loan', [DebtCancellationController::class, 'validateDebtCancellationOutstandingLoan'])->name('validate.debt.outstanding.loan');

Route::get('/debt-cancellation-settlement-years', [PriorityController::class, 'debtCancellationSettlementYears'])->name('debt.cancellation.settlement.years');
Route::post('/debt-cancellation-settlement-years', [DebtCancellationController::class, 'validateDebtCancellationSettlementYears'])->name('validate.debt.settlement.years');

// Summary
Route::post('/existing-policy', [FormController::class, 'existingPolicy'])->name('form.existing.policy');
Route::get('/existing-policy', [DropdownController::class, 'existingPolicy'])->name('existing.policy');

Route::prefix('financial-statement')->group(function () {

    Route::get('/monthly-goals',  [PriorityController::class, 'monthlyGoals'])->name('financial.statement.monthly.goals');
    Route::post('/monthly-goals', [SummaryController::class, 'validateSummaryMonthlyGoals'])->name('validate.summary.monthly.goals');

    Route::get('/expected-income',  [PriorityController::class, 'expectedIncome'])->name('financial.statement.expected.income');
    Route::post('/expected-income', [SummaryController::class, 'validateSummaryExpectedIncome'])->name('validate.summary.expected.income');

    Route::get('/increment-amount',  [PriorityController::class, 'incrementAmount'])->name('financial.statement.increment.amount');
    Route::post('/increment-amount', [SummaryController::class, 'validateSummaryIncrementAmount'])->name('validate.summary.increment.amount');

});

// Route::view('/summary', 'pages.summary.summary')->name('summary');
Route::view('/overview-new', 'pages.summary.overview-new')->name('overview-new');
// Route::view('/overview', 'pages.summary.overview')->name('overview');

Route::get('/overview', [DropdownController::class, 'overView'])->name('overview');
Route::get('/summary', [DropdownController::class, 'summary'])->name('summary');



// Sessions
Route::get('/clear-session', [SessionController::class, 'clearSessionData'])->name('clear_session_data');
Route::get('/getSessionData', [SessionController::class, 'getSessionData'])->name('get.session.data');
Route::get('/clear-session-storage', [SessionController::class, 'clearSessionStorage'])->name('clear_session_storage');

// Admin Dashboard
Route::view('/login', 'pages.login')->name('login');
// Route::view('/agent', 'pages.dashboard.agent')->name('dashboard');
Route::view('/agent/logs', 'pages.dashboard.logs')->name('logs');
Route::get('/agent', [AgentController::class,'index'])->name('agent.index');
Route::get('/agent/logs', [TransactionController::class,'index'])->name('transaction.index');
Route::get('/delete/{id}', [AgentController::class, 'softDelete'])->name('delete');

// Route::get('/agent/logs', function () {
//     return view('pages.dashboard.logs');
// });

Route::get('/salesforce/auth', [SalesforceController::class, 'redirectToSalesforce']);
Route::get('/authentication/getAccessToken',[SalesforceController::class, 'handleSalesforceCallback']);

Route::get('/send_fes','App\Http\Controllers\FesController@sendFes')->name('send_fes');