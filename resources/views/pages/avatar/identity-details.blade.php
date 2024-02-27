<?php
 /**
 * Template Name: Identity Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Identity Details</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $identityDetails = session('customer_details.identity_details') ?? $basicDetails;
    $selectedCountry = session('customer_details.identity_details.country', 'Malaysia');
    $transactionId = session('transaction_id') ?? ($_GET['transaction_id'] ?? null);
    
@endphp

<div id="identity_details">
    <div class="container-fluid">
        <div class="row parallax-section">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar-default px-0 parallax-inner parallax-top">
                <div class="header">
                    <div class="row">
                        @include('templates.nav.nav-red-red-menu')
                    </div>
                </div>
                <section class="avatar-design-placeholder content-avatar-default overflow-hidden">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset($image) }}" width="auto" height="100%" alt="Avatar" class="changePosition">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 parallax-inner parallax-bottom">
                <div class="scrollable-content">
                    <form novalidate action="{{ route('form.submit.identity',['transaction_id' => $transactionId]) }}" method="POST" id="identityForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-3 fw-bold">Now let’s get into the details.</h1>
                                        <p class="text-white display-6 lh-base">*All fields are mandatory, so we can make the best recommendations for you.</p>
                                    </div>
                                </div>
                                <div class="form-container pb-0 pb-md-5">
                                    @if ($errors->any())
                                        <div class="row px-4 pb-3 px-md-5">
                                            <div class="col-12">
                                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    <div class="text">There was a problem with your submission. Errors are marked below.</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12">
                                            <label for="countrySelect" class="form-label text-white">Citizenship *</label>
                                            <select name="country" class="form-select bg-white @error('country') is-invalid @enderror" aria-label="Countries" id="countrySelect" autocomplete="country" required>
                                                <option value="" selected disabled>Please Select</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->countries }}" {{ ($selectedCountry === $country->countries || (!$selectedCountry && $country->countries === 'Malaysia')) ? 'selected' : '' }}>
                                                        {{ $country->countries }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
                                            <label for="idType" class="form-label text-white">ID Type *</label>
                                            <select name="idType" class="form-select bg-white @error('idType') is-invalid @enderror" aria-label="ID Type" id="idType" required>
                                                <option value="" selected disabled>Please Select</option>
                                                @foreach ($idtypes as $idtype)
                                                    <option value="{{ $idtype->idtypes }}" {{ old('idType', $identityDetails['id_type'] ?? '') === $idtype->idtypes ? 'selected' : '' }}>{{ $idtype->idtypes }}</option>
                                                @endforeach
                                            </select>
                                            @error('idType')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-md-5" id="groups">
                                        <div class="col-12 pt-4" id="newicgroup" style="display: none;">
                                            <label for="idNumber" class="form-label text-white">ID Number *</label>
                                            <input type="text" name="idNumber" class="form-control bg-white @error('idNumber') is-invalid @enderror" id="idNumber" placeholder="xxxxxx-xx-xxxx" value="{{ old('idNumber', $identityDetails['id_number'] ?? '') }}">
                                            @error('idNumber')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="passportgroup" style="display: none;">
                                            <label for="passportNumber" class="form-label text-white">Passport Number *</label>
                                            <input type="text" name="passportNumber" class="form-control bg-white @error('passportNumber') is-invalid @enderror" id="passportNumber" placeholder="A122345" value="{{ old('passportNumber', $identityDetails['passport_number'] ?? '') }}">
                                            @error('passportNumber')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="birthcertgroup" style="display: none;">
                                            <label for="birthCert" class="form-label text-white">Birth Certificate Number *</label>
                                            <input type="text" name="birthCert" class="form-control bg-white @error('birthCert') is-invalid @enderror" id="birthCert" placeholder="T122345" value="{{ old('birthCert', $identityDetails['birth_cert'] ?? '') }}">
                                            @error('birthCert')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="policegroup" style="display: none;">
                                            <label for="policeNumber" class="form-label text-white">Police / Army Number *</label>
                                            <input type="text" name="policeNumber" class="form-control bg-white @error('policeNumber') is-invalid @enderror" id="policeNumber" placeholder="Enter Police / Army Number" value="{{ old('policeNumber', $identityDetails['police_number'] ?? '') }}">
                                            @error('policeNumber')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 pt-4" id="registrationgroup" style="display: none;">
                                            <label for="registrationNumber" class="form-label text-white">Registration Number *</label>
                                            <input type="text" name="registrationNumber" class="form-control bg-white @error('registrationNumber') is-invalid @enderror" id="registrationNumber" placeholder="Enter Registration Number" value="{{ old('registrationNumber', $identityDetails['registration_number'] ?? '') }}">
                                            @error('registrationNumber')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="gendergroup">
                                            <label for="identityrMaleInput" class="form-label text-white">Gender *</label>
                                            <div class="d-flex bg-white btn-group @error('gender') is-invalid @enderror" role="group">
                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                    <input type="radio" class="btn-check" name="gender" id="identityrMaleInput" autocomplete="off" value="Male"
                                                    {{ (old('gender') === 'Male' || (isset($identityDetails['gender']) && $identityDetails['gender'] === 'Male')) ? 'checked' : '' }}>
                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                </label>
                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                    <input type="radio" class="btn-check" name="gender" id="identityFemaleInput" autocomplete="off" value="Female"
                                                    {{ (old('gender') === 'Female' || (isset($identityDetails['gender']) && $identityDetails['gender'] === 'Female')) ? 'checked' : '' }}>
                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                </label>
                                            </div>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12 pt-4">
                                            @php
                                                // Get the current year, month, and day
                                                $currentYear = date('Y');

                                                // Generate arrays for the date, month, and year ranges
                                                $dateRange = range(1, 31);
                                                $dateRange = array_map(function ($day) {
                                                    return sprintf('%02d', $day);
                                                }, $dateRange);

                                                $monthNames = [
                                                    '01' => 'January',
                                                    '02' => 'February',
                                                    '03' => 'March',
                                                    '04' => 'April',
                                                    '05' => 'May',
                                                    '06' => 'June',
                                                    '07' => 'July',
                                                    '08' => 'August',
                                                    '09' => 'September',
                                                    '10' => 'October',
                                                    '11' => 'November',
                                                    '12' => 'December',
                                                ];

                                                $yearRange = range($currentYear - 100, $currentYear);

                                                // Set the selected values
                                                $selectedDay = old('day', null); 
                                                $selectedMonth = old('month', null);
                                                $selectedYear = old('year', null);

                                                // Adjust the selected month value to "01" format
                                                if ($selectedMonth !== null) {
                                                    $selectedMonth = sprintf('%02d', $selectedMonth);
                                                }
                                                if ($selectedDay !== null) {
                                                    $selectedDay = sprintf('%02d', $selectedDay);
                                                }
                                            @endphp
                                            <label for="day" class="form-label text-white">Date of Birth * <span id="ageDiv">( <div id="age" class="d-inline-block"></div> )</span></label>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                    @if(isset($identityDetails['dob']))
                                                        {!! Form::select('day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('day', substr($identityDetails['dob'], -2)), ['class' => 'form-select bg-white' . ($errors->has('day') ? ' is-invalid' : ''), 'id' => 'day']) !!}
                                                    @else
                                                        {!! Form::select('day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('day'), ['class' => 'form-select bg-white' . ($errors->has('day') ? ' is-invalid' : ''), 'id' => 'day']) !!}
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                    @if(isset($identityDetails['dob']))
                                                        {!! Form::select('month', ['' => 'Select'] + $monthNames, old('month', substr($identityDetails['dob'], 5, 2)), ['class' => 'form-select bg-white' . ($errors->has('month') ? ' is-invalid' : ''), 'id' => 'month']) !!}
                                                    @else
                                                        {!! Form::select('month', ['' => 'Select'] + $monthNames, old('month'), ['class' => 'form-select bg-white' . ($errors->has('month') ? ' is-invalid' : ''), 'id' => 'month']) !!}
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                    @if(isset($identityDetails['dob']))
                                                        {!! Form::select('year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                            return substr($year, 0, 4);
                                                        }, $yearRange), $yearRange), old('year', substr($identityDetails['dob'], 0, 4)), ['class' => 'form-select bg-white' . ($errors->has('year') ? ' is-invalid' : ''), 'id' => 'year']) !!}
                                                        @else
                                                        {!! Form::select('year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                            return substr($year, 0, 4);
                                                        }, $yearRange), $yearRange), old('year'), ['class' => 'form-select bg-white' . ($errors->has('year') ? ' is-invalid' : ''), 'id' => 'year']) !!}
                                                    @endif
                                                </div>
                                                @if ($errors->has('day') || $errors->has('month') || $errors->has('year'))
                                                    <div class="col-md-12">
                                                        @if ($errors->has('year'))
                                                            <div class="invalid-feedback" style="display:block">{{ $errors->first('year') }}</div>
                                                        @elseif ($errors->has('month'))
                                                            <div class="invalid-feedback" style="display:block">{{ $errors->first('month') }}</div>
                                                        @elseif ($errors->has('day'))
                                                            <div class="invalid-feedback" style="display:block">{{ $errors->first('day') }}</div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12 pt-4">
                                            <label for="smoker" class="form-label text-white">Your Habits *</label>
                                            <div class="d-flex btn-group @error('btnradio') is-invalid @enderror" role="group">
                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                    <input type="radio" class="btn-check" name="btnradio" id="smoker" autocomplete="off" value="Smoker"
                                                    {{ (old('btnradio') === 'Smoker' || (isset($identityDetails['habits']) && $identityDetails['habits'] === 'Smoker')) ? 'checked' : '' }}>
                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Smoker</span>
                                                </label>
                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                    <input type="radio" class="btn-check" name="btnradio" id="nonSmoker" autocomplete="off" value="Non-Smoker"
                                                    {{ (old('btnradio') === 'Non-Smoker' || (isset($identityDetails['habits']) && $identityDetails['habits'] === 'Non-Smoker')) ? 'checked' : '' }}>
                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Non-Smoker</span>
                                                </label>
                                            </div>
                                            @error('btnradio')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
                                            <label for="educationLevelSelect" class="form-label text-white">Education Level *</label>
                                            <select name="educationLevel" class="form-select bg-white @error('educationLevel') is-invalid @enderror" aria-label="Countries" id="educationLevelSelect" required>
                                                <option value="" selected disabled>Please Select</option>
                                                @foreach ($educationLevels as $educationLevel)
                                                    <option value="{{ $educationLevel->level }}" {{ old('educationLevel', $identityDetails['education_level'] ?? '') === $educationLevel->level ? 'selected' : '' }}>{{ $educationLevel->level }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('educationLevel'))
                                            <div class="col-12">
                                                @error('educationLevel')
                                                    <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
                                            <label for="occupationSelect" class="form-label text-white">Occupation *</label>
                                            <select name="occupation" class="form-select bg-white @error('occupation') is-invalid @enderror" aria-label="Countries" id="occupationSelect" required>
                                                <option value="" selected disabled>Please Select</option>
                                                @foreach ($occupations as $occupation)
                                                    <option value="{{ $occupation->name }}" {{ old('occupation', $identityDetails['occupation'] ?? '') === $occupation->name ? 'selected' : '' }}>{{ $occupation->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('occupation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="bottomObeserver"></div>
                        <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('avatar')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                                        <button class="btn btn-primary flex-fill text-uppercase" type="submit" id="submitButton">Next</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var countrySelect = document.getElementById('countrySelect');
    var idType = document.getElementById('idType');
    var idNumber = document.getElementById('idNumber');
    var passportNumber = document.getElementById('passportNumber');
    var birthCert = document.getElementById('birthCert');
    var policeNumber = document.getElementById('policeNumber');
    var registrationNumber = document.getElementById('registrationNumber');
    var educationLevelSelect = document.getElementById('educationLevelSelect');
    var occupationSelect = document.getElementById('occupationSelect');

    countrySelect.addEventListener('blur', function() {
        validateSelectField(countrySelect);
    });
    
    idType.addEventListener('blur', function() {
        validateSelectField(idType);
    });

    idNumber.addEventListener('blur', function() {
        validateIDNumberField(idNumber);
    });

    passportNumber.addEventListener('blur', function() {
        validateInputField(passportNumber);
    });

    birthCert.addEventListener('blur', function() {
        validateInputField(birthCert);
    });

    policeNumber.addEventListener('blur', function() {
        validateInputField(policeNumber);
    });

    registrationNumber.addEventListener('blur', function() {
        validateInputField(registrationNumber);
    });

    educationLevelSelect.addEventListener('blur', function() {
        validateSelectField(educationLevelSelect);
    });

    occupationSelect.addEventListener('blur', function() {
        validateSelectField(occupationSelect);
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

    function validateIDNumberField(field) {
        if (field.value && isValidIDNumber(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateInputField(field) {
        if (field.value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function isValidIDNumber(idNumber) {
        // Regular expression pattern to validate mobile number format
        var IDNumberRegex = /^[0-9]{6}-[0-9]{2}-[0-9]{4}$/;

        // Test the mobile number against the regex pattern
        var isValid = IDNumberRegex.test(idNumber);

        return isValid;
    }
});

</script>

@endsection