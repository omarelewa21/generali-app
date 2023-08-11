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

<div id="basic_details" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-md-5 py-3">
                    <h2 class="display-5 font-bold fw-bold">Hello! Let's get to know you better.</h2>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey text-dark px-0">
                <div class="vh-100 overflow-y-auto overflow-x-hidden">
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div class="text">There was a problem with your submission. Errors are marked below.</div>
                        </div>
                    @endif
                    <form novalidate action="{{ route('form.submit') }}" method="POST">
                        @csrf
                        <section class="main-content extra-padding">
                            <div class="container">
                                <div class="row pt-4 px-4 pb-4 pt-md-5 sticky-md-top bg-accent-bg-grey">
                                    <div class="col-12">
                                        <h1 class="display-3 text-uppercase">Do introduce yourself.</h1>
                                    </div>
                                </div>
                                <div class="row px-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                                <select name="title" class="form-select @error('title') is-invalid @enderror" aria-label="Title" id="titleSelect" required>
                                                    <option value="" selected disabled>Please Select</option>
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
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" id="firstNameInput" placeholder="First Name" value="{{ old('firstName') }}" required>
                                                    @error('firstName')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" id="lastNameInput" placeholder="Last Name" value="{{ old('lastName') }}" required>
                                                    @error('lastName')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="mobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+60</span>
                                                    <input type="tel" name="mobileNumber" class="form-control @error('mobileNumber') is-invalid @enderror" id="mobileNumber" placeholder="1234567890" value="{{ old('mobileNumber') }}" required>
                                                    @error('mobileNumber')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="housePhoneNumber" class="form-label">House Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+60</span>
                                                    <input type="tel" name="housePhoneNumber" class="form-control @error('housePhoneNumber') is-invalid @enderror" id="housePhoneNumber" placeholder="1234567890" value="{{ old('housePhoneNumber') }}">
                                                    @error('housePhoneNumber')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="yourname@email.com" value="{{ old('email') }}">
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
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('pdpa.disclosure')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
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
        var mobileNumberRegex = /^[1-9]\d{8,9}$/;

        // Test the mobile number against the regex pattern
        var isValid = mobileNumberRegex.test(mobileNumber);

        return isValid;
    }

    function isValidHousePhoneNumber(phoneNumber) {
        // Regular expression pattern to validate house phone number format
        var phoneNumberRegex = /^[1-9]\d{8,9}$/;

        // Test the phone number against the regex pattern
        var isValid = phoneNumberRegex.test(phoneNumber);

        return isValid;
    }

    function isValidEmail(email) {
        // Implement your email validation logic here
        // You can use a regular expression or any other method to validate the email format
        // Return true if the email is valid, false otherwise
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        var isValid = emailRegex.test(email);

        return isValid;
    }
});
</script>

@endsection