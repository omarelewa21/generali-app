<?php
 /**
 * Template Name: Basic Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Basic Details</title>
@endsection

@section('content')

<div id="basic_details" class="vh-100">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-5 py-xxl-5 py-xl-5 py-lg-5 py-md-5 py-sm-3 py-3">
                    <h4 class="display-5 font-bold fw-bold">Hello! Let's get to know you better.</h4>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey text-dark">
                <div class="vh-100 overflow-y-auto overflow-x-hidden">
                    <form novalidate action="{{ route('form.submit') }}" method="POST">
                        @csrf
                        <section class="main-content scrollable-padding">
                            <div class="container">
                                <div class="row pt-4 px-5 pb-3 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-4 sticky-top bg-accent-bg-grey">
                                    <div class="col-12">
                                        <h1 class="display-3 text-uppercase">Do introduce yourself.</h1>
                                    </div>
                                </div>
                                <div class="row px-5 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="title" class="form-label">Title</label>
                                                <select name="title" class="form-select @error('title') is-invalid @enderror" aria-label="Title" id="titleSelect" required>
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="Mr." @if(old('title') == 'Mr.') selected @endif>Mr.</option>
                                                    <option value="Ms." @if(old('title') == 'Ms.') selected @endif>Ms.</option>
                                                    <option value="Mrs." @if(old('title') == 'Mrs.') selected @endif>Mrs.</option>
                                                    <option value="Madam" @if(old('title') == 'Madam') selected @endif>Madam</option>
                                                    <option value="Datuk" @if(old('title') == 'Datuk') selected @endif>Datuk</option>
                                                    <option value="Datin" @if(old('title') == 'Datin') selected @endif>Datin</option>
                                                    <option value="Dato Seri" @if(old('title') == 'Dato Seri') selected @endif>Dato Seri</option>
                                                    <option value="Datin Seri" @if(old('title') == 'Datin Seri') selected @endif>Datin Seri</option>
                                                    <option value="Tan Sri" @if(old('title') == 'Tan Sri') selected @endif>Tan Sri</option>
                                                    <option value="Puan Sri" @if(old('title') == 'Puan Sri') selected @endif>Puan Sri</option>
                                                    <option value="Dr." @if(old('title') == 'Dr.') selected @endif>Dr.</option>
                                                    <option value="Tun" @if(old('title') == 'Tun') selected @endif>Tun</option>
                                                    <option value="Sir" @if(old('title') == 'Sir') selected @endif>Sir</option>
                                                    <option value="Justice" @if(old('title') == 'Justice') selected @endif>Justice</option>
                                                    <option value="Others" @if(old('title') == 'Others') selected @endif>Others</option>
                                                </select>
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-5">
                                                <label for="firstName" class="form-label">First Name:</label>
                                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" id="firstNameInput" placeholder="First Name" value="{{ old('firstName') }}" autocomplete="off" required>
                                                    @error('firstName')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label for="lastName" class="form-label">Last Name:</label>
                                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" id="lastNameInput" placeholder="Last Name" value="{{ old('lastName') }}" autocomplete="off" required>
                                                    @error('lastName')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-5">
                                                <label for="mobileNumber" class="form-label">Mobile Number:</label>
                                                <input type="tel" name="mobileNumber" class="form-control @error('mobileNumber') is-invalid @enderror" id="mobileNumber" placeholder="+60 000-0000 000" value="{{ old('mobileNumber') }}" autocomplete="off" required>
                                                    @error('mobileNumber')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label for="housePhoneNumber" class="form-label">House Phone Number:</label>
                                                <input type="tel" name="housePhoneNumber" class="form-control @error('housePhoneNumber') is-invalid @enderror" id="housePhoneNumber" placeholder="+60 000-0000 000" value="{{ old('housePhoneNumber') }}" autocomplete="off">
                                                    @error('housePhoneNumber')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-5">
                                                <label for="email" class="form-label">Email Address:</label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="yourname@email.com" value="{{ old('email') }}" autocomplete="off">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    
                        <section class="footer bg-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                        <a href="{{route('pdpa.disclosure')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
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
    var titleSelect = document.getElementById('titleSelect');
    var firstNameInput = document.getElementById('firstNameInput');
    var lastNameInput = document.getElementById('lastNameInput');
    var mobileNumberInput = document.getElementById('mobileNumber');
    var housePhoneNumberInput = document.getElementById('housePhoneNumber');
    var emailInput = document.getElementById('email');

    titleSelect.addEventListener('blur', function() {
        validateSelectField(titleSelect);
    });

    firstNameInput.addEventListener('blur', function() {
        validateInputField(firstNameInput);
    });

    lastNameInput.addEventListener('blur', function() {
        validateInputField(lastNameInput);
    });

    mobileNumberInput.addEventListener('blur', function() {
        validateMobileNumberField(mobileNumberInput);
    });

    housePhoneNumberInput.addEventListener('blur', function() {
        validateHousePhoneNumberField(housePhoneNumberInput);
    });

    emailInput.addEventListener('blur', function() {
        validateEmailField(emailInput);
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
        if (field.value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateMobileNumberField(field) {
        if (field.value && isValidMobileNumber(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateHousePhoneNumberField(field) {
        if (field.value && isValidHousePhoneNumber(field.value)) {
        field.classList.add('is-valid');
        field.classList.remove('is-invalid');
        } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        }
    }

    function validateEmailField(field) {
        if (field.value && isValidEmail(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function isValidMobileNumber(mobileNumber) {
        // Regular expression pattern to validate mobile number format
        var mobileNumberRegex = /^0\d{10}$/;

        // Test the mobile number against the regex pattern
        var isValid = mobileNumberRegex.test(mobileNumber);

        return isValid;
    }

    function isValidHousePhoneNumber(phoneNumber) {
        // Regular expression pattern to validate house phone number format
        var phoneNumberRegex = /^0\d{10}$/;

        // Test the phone number against the regex pattern
        var isValid = phoneNumberRegex.test(phoneNumber);

        return isValid;
    }

    function isValidEmail(email) {
        // Implement your email validation logic here
        // You can use a regular expression or any other method to validate the email format
        // Return true if the email is valid, false otherwise
        // Regular expression pattern to validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Test the email against the regex pattern
        var isValid = emailRegex.test(email);

        return isValid;
    }
});
</script>
@endsection