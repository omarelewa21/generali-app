<?php
 /**
 * Template Name: Existing Policy Page
 */
?>

@extends('templates.master')

@section('title')
<title>Existing Policy</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $existingPolicy = json_decode(session('customer_details.existing_policy'), true);
    $basicDetails = session('customer_details.basic_details');

    $debtPriority = session('customer_details.priorities.debt-cancellation_discuss');
    $protectionPriority = session('customer_details.priorities.protection_discuss');
    $retirementPriority = session('customer_details.priorities.retirement_discuss');
    $educationPriority = session('customer_details.priorities.education_discuss');
    $savingsPriority = session('customer_details.priorities.savings_discuss');
    $investmentPriority = session('customer_details.priorities.investments_discuss');
    $healthPriority = session('customer_details.priorities.health-medical_discuss');
    $selectedMedical = session('customer_details.selected_needs.need_6.advance_details.health_care.medical_care_plan');

@endphp

<div id="existing_policy">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3">
                    <h2 class="display-5 fw-bold">Excellent, we’re all ready to secure your future. Just let us know what you’re already covered for.</h2>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey text-dark px-0 content-section">
                <div>
                    <form novalidate action="{{ route('form.existing.policy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="existingPolicy">
                        <section class="main-content">
                            <div class="container">
                                <div class="row pt-4 px-4 pt-md-5 sticky-md-top bg-accent-bg-grey">
                                    <div class="col-12">
                                        <h1 class="display-5 text-uppercase">Please fill in your existing policies.</h1>
                                    </div>
                                </div>
                                <div class="row px-4" id="formContainer">
                                    @if ($errors->any())
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div class="text">There was a problem with your submission. Errors are marked below.</div>
                                        </div>
                                    @endif
                                    <div class="custom-alert"></div>
                                    <div class="col-12 pt-4 pb-2" id="form" data-index="1">
                                        <h4 class="display-7 text-gray pb-2">Policy 1</h4>
                                        <div class="row">
                                            <div class="col-md-12 pb-5">
                                                <p class="text-gray">What is your role in this policy?</p>
                                                <div class="d-flex btn-group @error('policyRole') is-invalid @enderror" role="group">
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check role" name="policyRole" id="policyOwnerInput" autocomplete="off" value="owner" data-key="role"
                                                        {{ (old('policyRole') === 'owner' || (isset($existingPolicy['policy_1']['role']) && $existingPolicy['policy_1']['role'] === 'owner')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The policy owner</span>
                                                    </label>
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check role" name="policyRole" id="policyInsuredInput" autocomplete="off" value="life insured" data-key="role"
                                                        {{ (old('policyRole') === 'life insured' || (isset($existingPolicy['policy_1']['role']) && $existingPolicy['policy_1']['role'] === 'life insured')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The life insured</span>
                                                    </label>
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check role" name="policyRole" id="policyBothInput" autocomplete="off" value="both" data-key="role"
                                                        {{ (old('policyRole') === 'both' || (isset($existingPolicy['policy_1']['role']) && $existingPolicy['policy_1']['role'] === 'both')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Both</span>
                                                    </label>
                                                </div>
                                                @error('policyRole')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <h4 class="display-7 text-gray">Policy Details</h4>
                                        <div class="row">
                                            <div class="pt-3 col-12">
                                                <label for="policyFullNameInput" class="form-label">Full Name (as per I.C)<span class="text-danger">*</span></label>
                                                <input type="text" name="policyFullName" class="form-control @error('policyFullName') is-invalid @enderror" id="policyFullNameInput" placeholder="Full Name" value="{{ old('policyFullName', $existingPolicy['policy_1']['full_name'] ?? '') }}" data-key="full_name" required>
                                                @error('policyFullName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="companySelect" class="form-label">Company Name <span class="text-danger">*</span></label>
                                                <select name="company" class="form-select @error('company') is-invalid @enderror" aria-label="Company" id="companySelect" autocomplete="off" data-key="company" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->companies }}" {{ old('company', $existingPolicy['policy_1']['company'] ?? '') === $company->companies ? 'selected' : '' }}>{{ $company->companies }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12" id="companyOthers" style="display:none">
                                                <label for="companyOthersText" class="form-label">Specify Company Name <span class="text-danger">*</span></label>
                                                <input type="text" name="companyOthers" class="form-control @error('companyOthers') is-invalid @enderror" id="companyOthersText" placeholder="Please specify" value="{{ old('companyOthers', $existingPolicy['policy_1']['company_others'] ?? '') }}">
                                                @error('companyOthers')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="inceptionYearInput" class="form-label">Policy Inception Year <span class="text-danger">*</span></label>
                                                <input type="number" name="inceptionYear" class="form-control @error('inceptionYear') is-invalid @enderror" id="inceptionYearInput" placeholder="Year" value="{{ old('inceptionYear', $existingPolicy['policy_1']['inception_year'] ?? '') }}" data-key="inception_year">
                                                @error('inceptionYear')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="policyPlanSelect" class="form-label">Type of Plan <span class="text-danger">*</span></label>
                                                <select name="policyPlan" class="form-select @error('policyPlan') is-invalid @enderror" aria-label="Policy Plan" id="policyPlanSelect" data-key="plan_type" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($policyPlans as $plan)
                                                        <option value="{{ $plan->policy_plans }}" {{ old('policyPlan', $existingPolicy['policy_1']['policy_plan'] ?? '') === $plan->policy_plans ? 'selected' : '' }}>{{ $plan->policy_plans }}</option>
                                                    @endforeach
                                                </select>
                                                @error('policyPlan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="maturityYearInput" class="form-label">Year of Maturity <span class="text-danger">*</span></label>
                                                <input type="number" name="maturityYear" class="form-control @error('maturityYear') is-invalid @enderror" id="maturityYearInput" placeholder="Year" value="{{ old('maturityYear', $existingPolicy['policy_1']['maturity_Year'] ?? '') }}" data-key="maturity_year">
                                                @error('maturityYear')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="premiumModeSelect" class="form-label">Premium Mode <span class="text-danger">*</span></label>
                                                <select name="premiumMode" class="form-select @error('premiumMode') is-invalid @enderror" aria-label="Premium Mode" id="premiumModeSelect" data-key="premium_mode" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($premiumModes as $mode)
                                                        <option value="{{ $mode->Modes }}" {{ old('premiumMode', $existingPolicy['policy_1']['premium_mode'] ?? '') === $mode->Modes ? 'selected' : '' }}>{{ $mode->Modes }}</option>
                                                    @endforeach
                                                </select>
                                                @error('premiumMode')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="premiumContributionInput" class="form-label">Premium Contribution <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="premiumContribution" class="form-control border-black @error('premiumContribution') is-invalid @enderror" id="premiumContributionInput" value="{{ isset($existingPolicy['policy_1']['premium_contribution']) && ($existingPolicy['policy_1']['premium_contribution'] !== '' || $existingPolicy['policy_1']['premium_contribution'] !== null) ? number_format(floatval($existingPolicy['policy_1']['premium_contribution'])) : '' }} " data-key="premium_contribution">
                                                    @error('premiumContribution')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="lifeCoverageInput" class="form-label">Life Coverage <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="lifeCoverage" class="form-control border-black @error('lifeCoverage') is-invalid @enderror" id="lifeCoverageInput" value="{{ isset($existingPolicy['policy_1']['life_coverage']) && ($existingPolicy['policy_1']['life_coverage'] !== '' || $existingPolicy['policy_1']['life_coverage'] !== null) ? number_format(floatval($lifeCoverage)) : '' }}" data-key="life_coverage_amount">
                                                    @error('lifeCoverage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="criticalIllnessInput" class="form-label">Critical Illness Benefit <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="criticalIllness" class="form-control border-black @error('criticalIllness') is-invalid @enderror" id="criticalIllnessInput" value="{{ isset($existingPolicy['policy_1']['critical_illness']) && ($existingPolicy['policy_1']['critical_illness'] !== '' || $existingPolicy['policy_1']['critical_illness'] !== null) ? number_format(floatval($criticalIllness)) : '' }}" data-key="critical_illness_amount">
                                                    @error('criticalIllness')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3" id="addFields">
                                            <div class="col-md-12 py-5 pb-2">
                                                <a id="addFieldsBtn" class="text-uppercase text-dark fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#addBenefits"><img src="{{ asset('images/existing-policy/button-add.png') }}" width="28px" alt="Add Benefits" class="me-2">Add Benefits</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row customAddBtn pb-5">
                                    <div class="col-md-12">
                                        <fieldset class="border-top border-dark">
                                            <legend><a id="addFormsBtn"><img src="{{ asset('images/existing-policy/button-add.png') }}" width="28px" alt="Add Benefits" class="mx-3" style="cursor: pointer"></a></legend>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        @php
                                            if ($debtPriority === 'true' || $debtPriority === true) {
                                                $route = route('debt.cancellation.gap');
                                            } elseif ($healthPriority === 'true' || $healthPriority === true) {
                                                if($selectedMedical === 'Health Planning'){
                                                    $route = route('health.medical.planning.gap');
                                                } else{ 
                                                    $route = route('health.medical.critical.gap');
                                                }
                                            } elseif ($investmentPriority === 'true' || $investmentPriority === true) {
                                                $route = route('investment.gap');
                                            } elseif ($savingsPriority === 'true' || $savingsPriority === true) {
                                                $route = route('savings.gap');
                                            } elseif ($educationPriority === 'true' || $educationPriority === true) {
                                                $route = route('education.gap');
                                            } elseif ($retirementPriority === 'true' || $retirementPriority === true) {
                                                $route = route('retirement.gap');
                                            } elseif ($protectionPriority === 'true' || $protectionPriority === true) {
                                                $route = route('protection.gap');
                                            }
                                            else {
                                                $route = route('financial.priorities.discuss');
                                            }
                                        @endphp
                                        <a href="{{ $route }}" class="btn btn-secondary text-uppercase flex-fill me-md-2">Back</a>
                                        <button class="btn btn-primary text-uppercase flex-fill" type="submit">Next</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addBenefits" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBenefitsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-end px-3 py-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header px-5 pt-2 pb-0">
                    <h3 class="modal-title text-center text-uppercase otherModalText" id="addBenefitsLabel">Benefits</h3>
                </div>
                <div class="modal-body text-white text-center px-5 pt-5 bg-primary">
                    <input type="text" name="addBenefitsInput" class="form-control bg-white @error('addBenefitsInput') is-invalid @enderror" id="addBenefitsInput" placeholder="Add your benefits" value="{{ old('addBenefitsInput', $assets['others_data'] ?? '') }}">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" id="addBenefitsBtn" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar btn-exit-benefits" data-bs-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var dob = {!! json_encode(session('customer_details.identity_details.dob')) !!};
// var existingPolicy = {!! json_encode(session('customer_details.existing_policy')) !!};
// var full_name = {!! json_encode(session('customer_details.basic_details.full_name')) !!};
// var family_details = {!! json_encode(session('customer_details.family_details.dependent.children_data')) !!};
try {
    var dobYear = dob.slice(-4);
} catch (error) {}

var existingPolicies = {
    "policy_1": {
        "role": "",
        "full_name": "",
        "company": "",
        "inception_year": "",
        "plan_type": "",
        "maturity_year": "",
        "premium_mode": "",
        "premium_contribution": "",
        "life_coverage_amount": "",
        "critical_illness_amount": "",
        "additionalBenefit": [],
    }
};

document.addEventListener('DOMContentLoaded', function() {
    $(document).on("blur", "[name='policyFullName']", (e) => {
        validateInputField(e.currentTarget);
    });

    $(document).on("blur", "[name='company'], [name='policyPlan'], [name='premiumMode']", (e) => {
        validateSelectField(e.currentTarget);
    });

    $(document).on("blur", "[name='companyOthers']", (e) => {
        validateInputFieldOthers(e.currentTarget);
    });

    $(document).on("blur", "[name='inceptionYear']", (e) => {
        validateNumberField(e.currentTarget);
    });

    $(document).on("blur", "[name='maturityYear']", (e) => {
        validateNumberFieldMaturity(e.currentTarget);
    });

    $(document).on("blur", "[name='premiumContribution'], [name='lifeCoverage'], [name='criticalIllness']", (e) => {
        validateCurrencyField(e.currentTarget);
    });

    function validateSelectField(field) {
        if (field.value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateInputField(field) {
        if (field.value && isValidName(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateInputFieldOthers(field) {
        if (field.value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateNumberField(field) {
        if (field.value && isValidYear(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateNumberFieldMaturity(field) {
        if (field.value && isValidYearMaturity(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateCurrencyField(field) {
        if (field.value && isValidCurrency(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function isValidYear(year) {
        // Return true if the year is valid (1900 to current year), false otherwise
        var yearRegex = /^(19\d{2}|20\d{2})$/;
        var currentYear = new Date().getFullYear();

        if (yearRegex.test(year) && parseInt(year) >= 1900 && parseInt(year) <= currentYear) {
            return true;
        } else {
            return false;
        }
    }

    function isValidYearMaturity(year) {
        var currentYear = new Date().getFullYear();
        var customerAge = currentYear - dobYear;
        var maturityYear = 100 - customerAge;
        var allowedYear = currentYear + maturityYear;

        if (parseInt(year) >= currentYear && parseInt(year) <= allowedYear) {
            return true;
        } else {
            return false;
        }
    }

    function isValidCurrency(currency) {
        // Return true if the currency is valid, false otherwise
        var currencyRegex = /^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/;

        var isValid = currencyRegex.test(currency);
        return isValid;
    }

    function isValidName(name) {
        // Return true if the wording is 30 characters, false otherwise
        var nameRegex = /^[A-Za-z,\s\/]{1,100}$/;

        var isValid = nameRegex.test(name);

        return isValid;
    }
    $(document).on("input", "[name='premiumContribution']", (e) => {
        // Retrieve the current input value
        const premiumContributionInputValue = e.currentTarget.value;
    
        // Remove non-digit characters
        const cleanedValue = parseFloat(premiumContributionInputValue.replace(/\D/g, ''));

        if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            e.currentTarget.value = formattedValue;
        } else {
            // If it's not a valid number, display the cleaned value as is
            e.currentTarget.value = premiumContributionInputValue;
        }
    });
    $(document).on("input", "[name='lifeCoverage']", (e) => {
        // Retrieve the current input value
        const lifeCoverageInputValue = e.currentTarget.value;
    
        // Remove non-digit characters
        const cleanedValue = parseFloat(lifeCoverageInputValue.replace(/\D/g, ''));

        if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            e.currentTarget.value = formattedValue;
        } else {
            // If it's not a valid number, display the cleaned value as is
            e.currentTarget.value = lifeCoverageInputValue;
        }
    });
    $(document).on("input", "[name='criticalIllness']", (e) => {
        // Retrieve the current input value
        const criticalIllnessInputValue = e.currentTarget.value;
    
        // Remove non-digit characters
        const cleanedValue = parseFloat(criticalIllnessInputValue.replace(/\D/g, ''));

        if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            e.currentTarget.value = formattedValue;
        } else {
            // If it's not a valid number, display the cleaned value as is
            e.currentTarget.value = criticalIllnessInputValue;
        }
    });

    $("#addFormsBtn").on("click", () => {
        const index = parseInt($("#form").attr("data-index")) + 1;
        if (index <= 7) {
            $("#form").attr("data-index", index);
            $("#form").append(`<h4 class="display-7 text-gray pb-4 mt-5 d-flex justify-content-between"><span>Policy ${index}</span><i class="fa-solid fa-trash-can text-danger align-self-center ms-3 delete-policy" data-index="${index}"></i></h4>`);
            
            $("#form").append(`<div class="row">
                <div class="col-md-12 pb-5">
                    <p class="text-gray">What is your role in this policy?</p>
                    <div class="d-flex btn-group" role="group">
                        <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                            <input type="radio" class="btn-check role" name="policyRole${index}" id="policyOwnerInput" autocomplete="off" value="owner" data-key="role">
                            <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The policy owner</span>
                        </label>
                        <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                            <input type="radio" class="btn-check role" name="policyRole${index}" id="policyInsuredInput" autocomplete="off" value="life insured" data-key="role">
                            <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The life insured</span>
                        </label>
                        <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                            <input type="radio" class="btn-check role" name="policyRole${index}" id="policyBothInput" autocomplete="off" value="both" data-key="role">
                            <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Both</span>
                        </label>
                    </div>
                </div>
            </div>`);
            $("#form").append(`<h4 class="display-7 text-gray">Policy Details</h4>`);
            $("#form").append(`<div class="row">
                <div class="pt-4 col-12">
                    <label for="policyFullNameInput" class="form-label">Full Name (as per I.C)<span class="text-danger">*</span></label>
                    <input type="text" name="policyFullName" class="form-control " id="policyFullNameInput" placeholder="Full Name" value="" data-key="full_name" required="">
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="companySelect" class="form-label">Company Name <span class="text-danger">*</span></label>
                    <select name="company" class="form-select " aria-label="Company" id="companySelect" autocomplete="off" data-key="company" required="">
                        ${$("select#companySelect").html()}
                    </select>
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12" id="companyOthers" style="display:none">
                    <label for="companyOthersText" class="form-label">Specify Company Name <span class="text-danger">*</span></label>
                    <input type="text" name="companyOthers" class="form-control " id="companyOthersText" placeholder="Please specify" value="">
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="inceptionYearInput" class="form-label">Policy Inception Year <span class="text-danger">*</span></label>
                    <input type="number" name="inceptionYear" class="form-control " id="inceptionYearInput" placeholder="Year" value="" data-key="inception_year">
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="policyPlanSelect" class="form-label">Type of Plan <span class="text-danger">*</span></label>
                    <select name="policyPlan" class="form-select " aria-label="Policy Plan" id="policyPlanSelect" data-key="plan_type" required="">
                        ${$("select#policyPlanSelect").html()}
                    </select>
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="maturityYearInput" class="form-label">Year of Maturity <span class="text-danger">*</span></label>
                    <input type="number" name="maturityYear" class="form-control " id="maturityYearInput" placeholder="Year" value="" data-key="maturity_year">
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="premiumModeSelect" class="form-label">Premium Mode <span class="text-danger">*</span></label>
                    <select name="premiumMode" class="form-select " aria-label="Premium Mode" id="premiumModeSelect" data-key="premium_mode" required="">
                        ${$("select#premiumModeSelect").html()}
                    </select>
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="premiumContributionInput" class="form-label">Premium Contribution <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="premiumContribution" class="form-control border-black " id="premiumContributionInput" value=" " data-key="premium_contribution">
                    </div>
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="lifeCoverageInput" class="form-label">Life Coverage <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="lifeCoverage" class="form-control border-black " id="lifeCoverageInput" value="" data-key="life_coverage_amount">
                    </div>
                </div>
                <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="criticalIllnessInput" class="form-label">Critical Illness Benefit <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="criticalIllness" class="form-control border-black " id="criticalIllnessInput" value="" data-key="critical_illness_amount">
                    </div>
                </div>
            </div>`);
            $("#form").append(`<div class="row mb-3" id="addFields">
                <div class="col-md-12 py-5 pb-2">
                    <a id="addFieldsBtn" class="text-uppercase text-dark fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#addBenefits"><img src="/images/existing-policy/button-add.png" width="28px" alt="Add Benefits" class="me-2">Add Benefits</a>
                </div>
            </div>`);

            const $target = $('.main-content');
            $target.animate({scrollTop: $target.prop("scrollHeight")}, 500);

            existingPolicies[`policy_${index}`] = {
                "role": "",
                "full_name": "",
                "company": "",
                "inception_year": "",
                "plan_type": "",
                "maturity_year": "",
                "premium_mode": "",
                "premium_contribution": "",
                "life_coverage_amount": "",
                "critical_illness_amount": "",
                "additionalBenefit": [],
            };
        }
    });

    $(document).on("change", "form input, form select", (e) => {
        const key = $(e.currentTarget).attr("data-key");
        const name = $(e.currentTarget).attr("name");
        if (name == "additionalBenefit") {
            const index = parseInt($(e.currentTarget).attr("data-index"));
            const id = parseInt($(e.currentTarget).attr("data-object-id"));

            existingPolicies[`policy_${index+1}`].additionalBenefit[id][key] = $(e.currentTarget).val();
        } else {
            const id = $(e.currentTarget).attr("id");
            const index = $(`[id="${id}"]`).index($(e.currentTarget));

            existingPolicies[`policy_${index+1}`][key] = $(e.currentTarget).val();
            $("[name='existingPolicy']").val(JSON.stringify(existingPolicies));
        }
        $("[name='existingPolicy']").val(JSON.stringify(existingPolicies));
    });

    $(document).on("click", "[id='addFieldsBtn']", (e) => {
        const id = $(e.currentTarget).attr("id");
        const index = $(`[id="${id}"]`).index($(e.currentTarget));

        $("#addBenefitsBtn").attr("data-index", index);
    });

    $("#addBenefitsBtn").on("click", (e) => {
        const index = parseInt($(e.currentTarget).attr("data-index"));
        const benefitsNo = $(`[data-id='additionalBenefit${index+1}']`).length;
        const additionalBenefit = existingPolicies[`policy_${index+1}`].additionalBenefit;
        const benefitName = capitalizeFirstWord($("#addBenefitsInput").val());

        if (benefitsNo < 4 && benefitName.length) {
            if (!additionalBenefit.some(benefit => benefit.benefit === benefitName)) {
                additionalBenefit.push({
                    benefit: benefitName,
                    benefit_amount: "",
                });

                $(`[id='addFields']:eq(${index})`).prev().append(`<div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <label for="additionalBenefit${index+1}_${benefitsNo}" class="form-label">${benefitName}</label>
                    <div class="input-group">
                        <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span>
                        <input type="text" class="form-control border-black" name="additionalBenefit" id="additionalBenefit${index+1}_${benefitsNo}" data-id="additionalBenefit${index+1}" value="" data-index="${index}" data-object-id="${benefitsNo}" data-key="benefit_amount">
                        <i class="fa-solid fa-trash-can text-danger align-self-center ms-3 delete-benefit" data-key="policy_${index+1}" data-index="${benefitsNo}"></i>
                    </div>
                </div>`);
                $("#addBenefitsInput").val("");
            }
        }
    });

    $(document).on("click", "i.delete-benefit", (e) => {
        const key = $(e.currentTarget).attr("data-key");
        const index = $(e.currentTarget).attr("data-index");

        existingPolicies[key].additionalBenefit.splice(index, 1);
        $(e.currentTarget).parent().parent().remove();

        $("[name='existingPolicy']").val(JSON.stringify(existingPolicies));
    });

    $(document).on("click", "i.delete-policy", (e) => {
        const index = parseInt($(e.currentTarget).attr("data-index"));

        delete existingPolicies[`policy_${index}`];

        $(e.currentTarget).parent().nextAll().slice(0, 4).remove();
        $(e.currentTarget).parent().remove();

        const $target = $('.main-content');
        $target.animate({scrollTop: $target.prop("scrollHeight")}, 500);

        const policiesNo = parseInt($("#form").attr("data-index"));
        if (policiesNo > index) {
            for (let i = index+1; i <= policiesNo; i++) {
                const newIndex = i-1;
                const header = $(`span:contains('Policy ${i}')`);
                if (header.length) {
                    header.text(`Policy ${newIndex}`);
                    header.next().attr("data-index", newIndex);

                    $(`[name='policyRole${i}']`).attr("name", "policyRole" + newIndex);
                    header.parent().next("[id='addFields']");

                    const additionalBenefit = $(`[data-id='additionalBenefit${i}']`);
                    for (let x = 0; x < additionalBenefit.length; x++) {
                        const objectId = $(additionalBenefit[x]).attr("data-object-id");
                        $(additionalBenefit[x]).attr("id", `additionalBenefit${newIndex}_${objectId}`);
                        $(additionalBenefit[x]).parent().prev().attr("for", `additionalBenefit${newIndex}_${objectId}`);

                        $(additionalBenefit[x]).attr("data-id", `additionalBenefit${newIndex}`);
                        $(additionalBenefit[x]).attr("data-index", newIndex-1);
                        $(additionalBenefit[x]).next().attr("data-key", `policy_${newIndex}`);

                        existingPolicies[`policy_${newIndex}`] = existingPolicies[`policy_${i}`];
                        delete existingPolicies[`policy_${i}`];
                    }
                }
            }
        }

        $("#form").attr("data-index", policiesNo - 1);
        $("[name='existingPolicy']").val(JSON.stringify(existingPolicies));
    });

    const capitalizeFirstWord = (str) => {
        const words = str.split(' ');

        if (words.length > 0) {
            words[0] = words[0].charAt(0).toUpperCase() + words[0].slice(1);
        }

        return words.join(' ');
    }
});
</script>

@endsection