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
@endphp

<div id="basic_details">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-md-5 py-3">
                    <h2 class="display-5 font-bold fw-bold">Excellent, we’re all ready to secure your future. Just let us know what you’re already covered for.</h2>
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
                                <div class="row px-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div class="text">There was a problem with your submission. Errors are marked below.</div>
                                        </div>
                                    @endif
                                    <div class="col-12 py-4">
                                        <h4 class="display-7 text-gray pb-4">Policy 1</h4>
                                        <div class="row">
                                            <div class="col-md-12 pb-5">
                                                <p class="text-gray">What is your role in this policy?</p>
                                                <div class="d-flex btn-group @error('policyRole') is-invalid @enderror" role="group">
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check" name="policyRole" id="policyOwnerInput" autocomplete="off" value="owner"
                                                        {{ (old('policyRole') === 'owner' || (isset($identityDetails['gender']) && $identityDetails['gender'] === 'male')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The policy owner</span>
                                                    </label>
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check" name="policyRole" id="policyInsuredInput" autocomplete="off" value="life insured"
                                                        {{ (old('policyRole') === 'life insured' || (isset($identityDetails['gender']) && $identityDetails['gender'] === 'female')) ? 'checked' : '' }}>
                                                        <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">The life insured</span>
                                                    </label>
                                                    <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                        <input type="radio" class="btn-check" name="policyRole" id="policyBothInput" autocomplete="off" value="both"
                                                        {{ (old('policyRole') === 'both' || (isset($identityDetails['gender']) && $identityDetails['gender'] === 'female')) ? 'checked' : '' }}>
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
                                            <div class="pt-4 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="policyFirstNameInput" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" name="policyFirstName" class="form-control @error('policyFirstName') is-invalid @enderror" id="policyFirstNameInput" placeholder="First Name" value="{{ old('policyFirstName', $basicDetails['first_name'] ?? '') }}" required>
                                                @error('policyFirstName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="pt-4 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="policyLastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" name="policyLastName" class="form-control @error('policyLastName') is-invalid @enderror" id="policyLastNameInput" placeholder="Last Name" value="{{ old('policyLastName', $basicDetails['last_name'] ?? '') }}" required>
                                                @error('policyLastName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="companySelect" class="form-label">Company Name <span class="text-danger">*</span></label>
                                                <select name="company" class="form-select @error('company') is-invalid @enderror" aria-label="Company" id="companySelect" autocomplete="off" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->companies }}" {{ old('company', $existingPolicy['company'] ?? '') === $company->companies ? 'selected' : '' }}>{{ $company->companies }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="inceptionYearInput" class="form-label">Policy Inception Year <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" name="inceptionYear" class="form-control @error('inceptionYear') is-invalid @enderror" id="inceptionYearInput" placeholder="Year" value="{{ old('inceptionYear', $basicDetails['house_phone_number'] ?? '') }}">
                                                    @error('inceptionYear')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="policyPlanSelect" class="form-label">Type of Plan <span class="text-danger">*</span></label>
                                                <select name="policyPlan" class="form-select @error('policyPlan') is-invalid @enderror" aria-label="Policy Plan" id="policyPlanSelect" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($policyPlans as $plan)
                                                        <option value="{{ $plan->policy_plans }}" {{ old('policyPlan', $existingPolicy['company'] ?? '') === $plan->policy_plans ? 'selected' : '' }}>{{ $plan->policy_plans }}</option>
                                                    @endforeach
                                                </select>
                                                @error('policyPlan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="maturityYearInput" class="form-label">Year of Maturity <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" name="maturityYear" class="form-control @error('maturityYear') is-invalid @enderror" id="maturityYearInput" placeholder="Year" value="{{ old('maturityYear', $basicDetails['house_phone_number'] ?? '') }}">
                                                    @error('maturityYear')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="premiumModeSelect" class="form-label">Premium Mode <span class="text-danger">*</span></label>
                                                <select name="premiumMode" class="form-select @error('premiumMode') is-invalid @enderror" aria-label="Premium Mode" id="premiumModeSelect" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($premiumModes as $mode)
                                                        <option value="{{ $mode->Modes }}" {{ old('policyPlan', $existingPolicy['company'] ?? '') === $mode->Modes ? 'selected' : '' }}>{{ $mode->Modes }}</option>
                                                    @endforeach
                                                </select>
                                                @error('policyPlan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="premiumContributionInput" class="form-label">Premium Contribution <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">RM</span><input type="number" name="premiumContribution" class="form-control @error('premiumContribution') is-invalid @enderror" id="premiumContributionInput" value="{{ old('premiumContribution', $basicDetails['house_phone_number'] ?? '') }}">
                                                    @error('premiumContribution')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="lifeCoverageInput" class="form-label">Life Coverage <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">RM</span><input type="number" name="lifeCoverage" class="form-control @error('lifeCoverage') is-invalid @enderror" id="lifeCoverageInput" value="{{ old('lifeCoverage', $basicDetails['house_phone_number'] ?? '') }}">
                                                    @error('lifeCoverage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="criticalIllnessInput" class="form-label">Critical Illness Benefit <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">RM</span><input type="number" name="criticalIllness" class="form-control @error('criticalIllness') is-invalid @enderror" id="criticalIllnessInput" value="{{ old('criticalIllness', $basicDetails['house_phone_number'] ?? '') }}">
                                                    @error('criticalIllness')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="addFields"></div>
                                        <div class="row">
                                            <div class="col-md-12 py-5">
                                                <a id="addFieldsBtn" class="text-uppercase text-dark fw-bold text-decoration-none"><img src="{{ asset('images/existing-policy/button-add.png') }}" width="28px" alt="Add Benefits" class="me-2 py-5">Add Benefits</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('pdpa.disclosure')}}" class="btn btn-secondary text-uppercase flex-fill me-md-2">Back</a>
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
</div>

<!-- Modal -->
<div class="modal fade" id="addBenefits" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBenefitsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end px-3 py-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header px-5 pt-2 pb-0">
                <h3 class="modal-title text-center text-uppercase otherModalText" id="addBenefitsLabel">I Have</h3>
            </div>
            <div class="modal-body text-white text-center px-5 pt-5 bg-primary">
                <input type="text" name="addBenefitsInput" class="form-control bg-white @error('addBenefitsInput') is-invalid @enderror" id="addBenefitsInput" placeholder="Add your asset" value="{{ old('addBenefitsInput', $assets['others_data'] ?? '') }}">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar btn-exit-assetsOthers" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var policyFirstNameInput = document.getElementById('policyFirstNameInput');
    var policyLastNameInput = document.getElementById('policyLastNameInput');
    var companySelect = document.getElementById('companySelect');
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

    policyFirstNameInput.addEventListener('blur', function() {
        validateInputField(policyFirstNameInput);
    });

    policyLastNameInput.addEventListener('blur', function() {
        validateInputField(policyLastNameInput);
    });

    inceptionYearInput.addEventListener('blur', function() {
        validateNumberField(inceptionYearInput);
    });

    policyPlanSelect.addEventListener('blur', function() {
        validateSelectField(policyPlanSelect);
    });

    maturityYearInput.addEventListener('blur', function() {
        validateNumberField(maturityYearInput);
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

    function validateNumberField(field) {
        if (field.value && isValidYear(field.value)) {
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

    function isValidName(name) {
        // Return true if the wording is 30 characters, false otherwise
        var nameRegex = /^[A-Za-z\s]{1,30}$/;

        var isValid = nameRegex.test(name);

        return isValid;
    }

    function isValidYear(year) {
        // Return true if the year is valid (1900 to 2099), false otherwise
        var yearRegex = /^(19\d{2}|20\d{2})$/;

        var isValid = yearRegex.test(year);

        return isValid;
    }

    function isValidCurrency(currency) {
        // Return true if the currency is valid, false otherwise
        var currencyRegex = /^\$?\d+(\.\d{2})?$/;

        var isValid = currencyRegex.test(currency);

        return isValid;
    }
});
</script>

@endsection