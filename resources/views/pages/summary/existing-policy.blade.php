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
    $existingPolicy = session('customer_details.existing_policy');
    $basicDetails = session('customer_details.basic_details');

    $debtPriority = session('customer_details.priorities.debt-cancellationDiscuss');
    $protectionPriority = session('customer_details.priorities.protectionDiscuss');
    $retirementPriority = session('customer_details.priorities.retirementDiscuss');
    $educationPriority = session('customer_details.priorities.educationDiscuss');
    $savingsPriority = session('customer_details.priorities.savingsDiscuss');
    $investmentPriority = session('customer_details.priorities.investmentsDiscuss');
    $healthPriority = session('customer_details.priorities.health-medicalDiscuss');
    $selectedMedical = session('customer_details.health-medical_needs.medicalPlanningSelection');
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
                        <section class="main-content">
                            <div class="container">
                                <div class="row pt-4 px-4 pb-4 pt-md-5 sticky-md-top bg-accent-bg-grey">
                                    <div class="col-12">
                                        <h1 class="display-3 text-uppercase">Please fill in your existing policies.</h1>
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
                                    <div class="col-12 py-4" id="form" data-index="1">
                                        <input type="hidden" class="policy" name="policy" id="policy" value="policy">
                                        <h4 class="display-7 text-gray pb-4">Policy 1</h4>
                                        <div class="row">
                                            <div class="col-md-12 pb-5">
                                                <p class="text-gray">What is your role in this policy?</p>
                                                <div class="d-flex btn-group @error('policyRole') is-invalid @enderror" role="group">
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check role" name="policyRole" id="policyOwnerInput" autocomplete="off" value="owner"
                                                        {{ (old('policyRole') === 'owner' || (isset($existingPolicy['policy_1']['role']) && $existingPolicy['policy_1']['role'] === 'owner')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The policy owner</span>
                                                    </label>
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check role" name="policyRole" id="policyInsuredInput" autocomplete="off" value="life insured"
                                                        {{ (old('policyRole') === 'life insured' || (isset($existingPolicy['policy_1']['role']) && $existingPolicy['policy_1']['role'] === 'life insured')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The life insured</span>
                                                    </label>
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check role" name="policyRole" id="policyBothInput" autocomplete="off" value="both"
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
                                            <div class="pt-4 col-12">
                                                <label for="policyFullNameInput" class="form-label">Full Name (as per I.C)<span class="text-danger">*</span></label>
                                                <input type="text" name="policyFullName" class="form-control @error('policyFullName') is-invalid @enderror" id="policyFullNameInput" placeholder="Full Name" value="{{ old('policyFullName', $existingPolicy['policy_1']['full_name'] ?? '') }}" required>
                                                @error('policyFullName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="companySelect" class="form-label">Company Name <span class="text-danger">*</span></label>
                                                <select name="company" class="form-select @error('company') is-invalid @enderror" aria-label="Company" id="companySelect" autocomplete="off" required>
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
                                                <input type="number" name="inceptionYear" class="form-control @error('inceptionYear') is-invalid @enderror" id="inceptionYearInput" placeholder="Year" value="{{ old('inceptionYear', $existingPolicy['policy_1']['inception_year'] ?? '') }}">
                                                @error('inceptionYear')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="policyPlanSelect" class="form-label">Type of Plan <span class="text-danger">*</span></label>
                                                <select name="policyPlan" class="form-select @error('policyPlan') is-invalid @enderror" aria-label="Policy Plan" id="policyPlanSelect" required>
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
                                                <input type="number" name="maturityYear" class="form-control @error('maturityYear') is-invalid @enderror" id="maturityYearInput" placeholder="Year" value="{{ old('maturityYear', $existingPolicy['policy_1']['maturity_Year'] ?? '') }}">
                                                @error('maturityYear')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="premiumModeSelect" class="form-label">Premium Mode <span class="text-danger">*</span></label>
                                                <select name="premiumMode" class="form-select @error('premiumMode') is-invalid @enderror" aria-label="Premium Mode" id="premiumModeSelect" required>
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
                                                    <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="premiumContribution" class="form-control border-black @error('premiumContribution') is-invalid @enderror" id="premiumContributionInput" value="{{ isset($existingPolicy['policy_1']['premium_contribution']) && ($existingPolicy['policy_1']['premium_contribution'] !== '' || $existingPolicy['policy_1']['premium_contribution'] !== null) ? number_format(floatval($premiumContribution)) : '' }} ">
                                                    @error('premiumContribution')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="lifeCoverageInput" class="form-label">Life Coverage <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="lifeCoverage" class="form-control border-black @error('lifeCoverage') is-invalid @enderror" id="lifeCoverageInput" value="{{ isset($existingPolicy['policy_1']['life_coverage']) && ($existingPolicy['policy_1']['life_coverage'] !== '' || $existingPolicy['policy_1']['life_coverage'] !== null) ? number_format(floatval($lifeCoverage)) : '' }}">
                                                    @error('lifeCoverage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="criticalIllnessInput" class="form-label">Critical Illness Benefit <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="fw-bold mt-auto text-placeholder border-btm lh-placeholder">RM</span><input type="text" name="criticalIllness" class="form-control border-black @error('criticalIllness') is-invalid @enderror" id="criticalIllnessInput" value="{{ isset($existingPolicy['policy_1']['critical_illness']) && ($existingPolicy['policy_1']['critical_illness'] !== '' || $existingPolicy['policy_1']['critical_illness'] !== null) ? number_format(floatval($criticalIllness)) : '' }}">
                                                    @error('criticalIllness')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="addFields"></div>
                                        <div class="row">
                                            <div class="col-md-12 py-5">
                                                <a id="addFieldsBtn" class="text-uppercase text-dark fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#addBenefits"><img src="{{ asset('images/existing-policy/button-add.png') }}" width="28px" alt="Add Benefits" class="me-2">Add Benefits</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row customAddBtn pb-5">
                                    <div class="col-md-12">
                                        <fieldset class="border-top border-dark">
                                            <legend><a id="addFormsBtn"><img src="{{ asset('images/existing-policy/button-add.png') }}" width="28px" alt="Add Benefits" class="mx-3"></a></legend>
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
                                                if($selectedMedical === 'Medical Planning Care'){
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
                                                $route = route('priorities.to.discuss');
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
                    <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar btn-exit-benefits" data-bs-dismiss="modal" data-index="1">Submit</button>
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
var dobYear = dob.slice(-4);

document.addEventListener('DOMContentLoaded', function() {
    var policyFullName = document.getElementById('policyFullNameInput');
    var companySelect = document.getElementById('companySelect');
    var companyOthers = document.getElementById('companyOthers');
    var inceptionYearInput = document.getElementById('inceptionYearInput');
    var policyPlanSelect = document.getElementById('policyPlanSelect');
    var maturityYearInput = document.getElementById('maturityYearInput');
    var premiumModeSelect = document.getElementById('premiumModeSelect');
    var premiumContributionInput = document.getElementById('premiumContributionInput');
    var lifeCoverageInput = document.getElementById('lifeCoverageInput');
    var criticalIllnessInput = document.getElementById('criticalIllnessInput');

    companySelect.addEventListener('blur', function() {
        validateSelectField(companySelect);
    });

    policyFullName.addEventListener('blur', function() {
        validateInputField(policyFullName);
    });

    companyOthers.addEventListener('blur', function() {
        validateInputFieldOthers(companyOthers);
    });

    inceptionYearInput.addEventListener('blur', function() {
        validateNumberField(inceptionYearInput);
    });

    policyPlanSelect.addEventListener('blur', function() {
        validateSelectField(policyPlanSelect);
    });

    maturityYearInput.addEventListener('blur', function() {
        validateNumberFieldMaturity(maturityYearInput);
    });

    premiumModeSelect.addEventListener('blur', function() {
        validateSelectField(premiumModeSelect);
    });

    premiumContributionInput.addEventListener('blur', function() {
        validateCurrencyField(premiumContributionInput);
    });

    lifeCoverageInput.addEventListener('blur', function() {
        validateCurrencyField(lifeCoverageInput);
    });

    criticalIllnessInput.addEventListener('blur', function() {
        validateCurrencyField(criticalIllnessInput);
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
    premiumContributionInput.addEventListener("input", function() {
        // Retrieve the current input value
        var premiumContributionInputValue = premiumContributionInput.value;
    
        // Remove non-digit characters
        const cleanedValue = parseFloat(premiumContributionInputValue.replace(/\D/g, ''));

        if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            this.value = formattedValue;
        } else {
            // If it's not a valid number, display the cleaned value as is
            this.value = premiumContributionInputValue;
        }
    });
    lifeCoverageInput.addEventListener("input", function() {
        // Retrieve the current input value
        var lifeCoverageInputValue = lifeCoverageInput.value;
    
        // Remove non-digit characters
        const cleanedValue = parseFloat(lifeCoverageInputValue.replace(/\D/g, ''));

        if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            this.value = formattedValue;
        } else {
            // If it's not a valid number, display the cleaned value as is
            this.value = lifeCoverageInputValue;
        }
    });
    criticalIllnessInput.addEventListener("input", function() {
        // Retrieve the current input value
        var criticalIllnessInputValue = criticalIllnessInput.value;
    
        // Remove non-digit characters
        const cleanedValue = parseFloat(criticalIllnessInputValue.replace(/\D/g, ''));

        if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            this.value = formattedValue;
        } else {
            // If it's not a valid number, display the cleaned value as is
            this.value = criticalIllnessInputValue;
        }
    });
});
</script>

@endsection