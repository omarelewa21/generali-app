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
    $arrayData = session('passingArrays');
@endphp

<div id="identity_details" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-design-placeholder content-avatar-default">
                    <div class="col-12 text-center d-flex justify-content-center">
                    <img src="{{ asset('/images/avatar-general/' . (isset($arrayData['image']) ? $arrayData['image'] : 'gender-male') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form novalidate action="{{ route('form.submit.identity') }}" method="POST">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white font-normal pb-3 fw-bold">Now let’s get into the details.</h1>
                                        <p class="text-white display-6 lh-base">*All fields are mandatory, so we can make the best recommendations for you.</p>
                                    </div>
                                </div>
                                <div class="form-container pb-5">
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12">
                                            <label for="country" class="form-label text-white">Citizenship</label>
                                            <select class="form-select bg-white @error('country') is-invalid @enderror" name="country" aria-label="Countries" id="countrySelect" required>
                                                <option value="" selected disabled>Please Select</option>
                                                @foreach($countries as $code => $name)
                                                    <option value="{{ $code }}" @if(old('country') == $code) selected @endif>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
                                            <label for="idType" class="form-label text-white">ID Type</label>
                                            <select name="idType" class="form-select bg-white @error('idType') is-invalid @enderror" aria-label="ID Type" id="idType" required>
                                                <option value="" selected disabled>Please Select</option>
                                                <option value="New IC" @if(old('idType') == 'New IC') selected @endif>New IC</option>
                                                <option value="Passport" @if(old('idType') == 'Passport') selected @endif>Passport</option>
                                                <option value="Birth Certificate" @if(old('idType') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                                <option value="Police / Army" @if(old('idType') == 'Police / Army') selected @endif>Police / Army</option>
                                                <option value="Registration" @if(old('idType') == 'Registration') selected @endif>Registration</option>
                                            </select>
                                            @error('idType')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 pt-4" id="newicgroup" style="display: none;">
                                            <label for="idNumber" class="form-label text-white">ID Number</label>
                                            <input type="text" name="idNumber" class="form-control bg-white @error('idNumber') is-invalid @enderror" id="idNumber" placeholder="xxxxxx-xx-xxxx" value="{{ old('idNumber') }}">
                                            @error('idNumber')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="passportgroup" style="display: none;">
                                            <label for="passportNumber" class="form-label text-white">Passport Number</label>
                                            <input type="text" name="passportNumber" class="form-control bg-white @error('passportNumber') is-invalid @enderror" id="passportNumber" placeholder="A122345" value="{{ old('passportNumber') }}">
                                            @error('passportNumber')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="birthcertgroup" style="display: none;">
                                            <label for="birthCert" class="form-label text-white">Birth Certificate Number</label>
                                            <input type="text" name="birthCert" class="form-control bg-white @error('birthCert') is-invalid @enderror" id="birthCert" placeholder="T122345" value="{{ old('birthCert') }}">
                                            @error('birthCert')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 pt-4" id="policegroup" style="display: none;">
                                            <label for="policeNumber" class="form-label text-white">Police / Army Number</label>
                                            <input type="text" name="policeNumber" class="form-control bg-white @error('policeNumber') is-invalid @enderror" id="policeNumber" placeholder="Enter Police / Army Number" value="{{ old('policeNumber') }}">
                                            @error('policeNumber')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 pt-4" id="registrationgroup" style="display: none;">
                                            <label for="registrationNumber" class="form-label text-white">Registration Number</label>
                                            <input type="text" name="registrationNumber" class="form-control bg-white @error('registrationNumber') is-invalid @enderror" id="registrationNumber" placeholder="Enter Registration Number" value="{{ old('registrationNumber') }}">
                                            @error('registrationNumber')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 pt-4">
                                            @php
                                                // Generate arrays for the date, month, and year ranges
                                                $dateRange = range(1, 31);
                                                $dateRange = array_map(function ($day) {
                                                    return sprintf('%02d', $day);
                                                }, $dateRange);
                                                $monthRange = range(1, 12);
                                                $monthRange = array_map(function ($month) {
                                                    return sprintf('%02d', $month);
                                                }, $monthRange);
                                                $yearRange = range(date('Y') - 100, date('Y') - 18); // Assuming minimum age is 18

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
                                            <label for="dob" class="form-label text-white">Date of Birth ( <div id="age" class="d-inline-block"></div> )</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    {!! Form::select('day', array_combine($dateRange, $dateRange), $selectedDay, ['class' => 'form-select bg-white', 'id' => 'day']) !!}
                                                </div>
                                                <div class="col-md-4">
                                                    {!! Form::select('month', array_combine($monthRange, $monthRange), $selectedMonth, ['class' => 'form-select bg-white', 'id' => 'month']) !!}
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- {!! Form::select('year', $yearRange, $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!} -->
                                                    {!! Form::select('year', array_combine(array_map(function ($year) {
                                                        return substr($year, -2);
                                                    }, $yearRange), $yearRange), $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 pt-4">
                                            <div class="row">
                                                <label for="habits" class="form-label text-white">Your Habits</label>
                                            </div>
                                            <div class="row">
                                                <div class="btn-group @error('btnradio') is-invalid @enderror" role="group">
                                                    <div class="col-6">
                                                        <input type="radio" class="btn-check" name="btnradio" id="smoker" autocomplete="off" value="smoker">
                                                        <label class="btn btn-outline-primary" for="smoker">Smoker</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="radio" class="btn-check" name="btnradio" id="nonSmoker" autocomplete="off" value="nonSmoker">
                                                        <label class="btn btn-outline-primary" for="nonSmoker">Non-Smoker</label>
                                                    </div>
                                                </div>
                                                @error('btnradio')
                                                    <div class="invalid-feedback text-white">Please select your habits</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
                                            <label for="educationLevel" class="form-label text-white">Education Level</label>
                                            <select name="educationLevel" class="form-select bg-white @error('educationLevel') is-invalid @enderror" aria-label="Education Level" id="educationLevel" required>
                                                <option value="" selected disabled>Please Select</option>
                                                <option value="New IC" @if(old('educationLevel') == 'New IC') selected @endif>New IC</option>
                                                <option value="Passport" @if(old('educationLevel') == 'Passport') selected @endif>Passport</option>
                                                <option value="Birth Certificate" @if(old('educationLevel') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                                <option value="Police / Army" @if(old('educationLevel') == 'Police / Army') selected @endif>Police / Army</option>
                                                <option value="Registration" @if(old('educationLevel') == 'Registration') selected @endif>Registration</option>
                                            </select>
                                            @error('educationLevel')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
                                            <label for="occupation" class="form-label text-white">Occupation</label>
                                            <select name="occupation" class="form-select bg-white @error('occupation') is-invalid @enderror" aria-label="Occupation" id="occupation" required>
                                                <option value="" selected disabled>Please Select</option>
                                                @foreach($rows as $row)
                                                    <option value="{{ $row[0] }}">{{ $row[0] }}</option>
                                                @endforeach
                                            </select>
                                            @error('occupation')
                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                        <a href="{{route('avatar.gender.selection')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                        <button class="btn btn-primary text-uppercase" type="submit">Next</button>
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
        var IDNumberRegex = /^\d{6}-\d{2}-\d{4}$/;

        // Test the mobile number against the regex pattern
        var isValid = IDNumberRegex.test(idNumber);

        return isValid;
    }
});
</script>
@endsection