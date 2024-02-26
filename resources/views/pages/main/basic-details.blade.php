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

@php
    // Retrieving values from the session
    $basicDetails ??= session('customer_details.basic_details');
    $transactionId ??= request()->input('transaction_id');
@endphp

<div id="basic_details">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 px-0 bg-primary sidebanner">
                <div class="navbar-scroll fixed-top">
                    @include('templates.nav.nav-white-menu')
                    <div class="text-white px-4 px-xl-5 fixed-sm-top bg-primary">
                        <h2 class="display-5 fw-bold py-3">Hello! Let's get to know you better.</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey px-0 content-section">
                <div>
                    <form novalidate action="{{ route('form.basic.details', ['transaction_id' => request()->input('transaction_id')]) }}" method="POST">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row pt-4 px-4 pt-md-5 sticky-md-top bg-accent-bg-grey">
                                    <div class="col-12">
                                        <h1 class="display-5 text-uppercase">Do introduce yourself.</h1>
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
                                        <div class="row">
                                            <div class="col-xxl-3 col-lg-4 col-md-12">
                                                <label for="titleSelect" class="form-label">Title <span class="text-danger">*</span></label>
                                                <select name="title" class="form-select @error('title') is-invalid @enderror" aria-label="Title" id="titleSelect" required>
                                                    <option value="" selected disabled>Please Select</option>
                                                    @foreach ($titles as $title)
                                                        <option value="{{ $title->titles }}" {{ old('title', $basicDetails['title'] ?? '') === $title->titles ? 'selected' : '' }}>{{ $title->titles }}</option>
                                                    @endforeach
                                                </select>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-xxl-9 col-lg-8 col-md-12 pt-5 pt-lg-0">
                                                <label for="fullNameInput" class="form-label">Full Name (as per I.C) <span class="text-danger">*</span></label>
                                                <input type="text" name="fullName" class="form-control @error('fullName') is-invalid @enderror" id="fullNameInput" placeholder="Full Name" value="{{ old('fullName', $basicDetails['full_name'] ?? '') }}" required>
                                                @error('fullName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="pt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="mobileNumberInput" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="tel" name="mobileNumber" class="form-control @error('mobileNumber') is-invalid @enderror" id="mobileNumberInput" value="{{ old('mobileNumber', $basicDetails['mobile_number'] ?? '') }}" required>
                                                    @error('mobileNumber')
                                                        <div class="invalid-feedback" id="errorMsg">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="pt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <label for="houseNumberInput" class="form-label">House Phone Number</label>
                                                <div class="input-group">
                                                    <input type="tel" name="housePhoneNumber" class="form-control @error('housePhoneNumber') is-invalid @enderror" id="houseNumberInput" value="{{ old('housePhoneNumber', $basicDetails['house_phone_number'] ?? '') }}">
                                                    @error('housePhoneNumber')
                                                        <div class="invalid-feedback" id="errorMsgHouse">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="pt-5 col-md-12">
                                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" autocomplete="email" placeholder="yourname@email.com" value="{{ old('email', $basicDetails['email'] ?? '') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                                        <a href="{{route('pdpa.disclosure',['transaction_id' => $transactionId])}}" class="btn btn-secondary text-uppercase flex-fill me-md-2">Back</a>
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
    var fullNameInput = document.getElementById('fullNameInput');
    var emailInput = document.getElementById('email');

    titleSelect.addEventListener('blur', function() {
        validateSelectField(titleSelect);
    });

    fullNameInput.addEventListener('blur', function() {
        validateInputField(fullNameInput);
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
        if (field.value && isValidName(field.value)) {
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

    function isValidName(name) {
        // Return true if the wording is 30 characters, false otherwise
        var nameRegex = /^[A-Za-z,\s\/]{1,100}$/;

        var isValid = nameRegex.test(name);

        return isValid;
    }

    function isValidEmail(email) {
        // Return true if the email is valid, false otherwise
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        var isValid = emailRegex.test(email);

        return isValid;
    }
});
</script>

@endsection