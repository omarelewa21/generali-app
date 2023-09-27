<?php
 /**
 * Template Name: Protection Monthly Support
 */
?>
@extends('templates.master')

@section('title')
<title>Protection - Monthly Support</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $protectionMonthlySupport = isset($arrayData['protection']['protectionMonthlySupport']) ? $arrayData['protection']['protectionMonthlySupport'] : '';
    $totalProtectionNeeded = isset($arrayData['protection']['totalProtectionNeeded']) ? $arrayData['protection']['totalProtectionNeeded'] : '';
    $protectionFundPercentage = isset($arrayData['protection']['protectionFundPercentage']) ? $arrayData['protection']['protectionFundPercentage'] : 0;
@endphp


<div id="protection-monthly" class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-protection bg-half wrapper-needs-supporting-default">
                    <section class="header-needs-default">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                                @include('templates.nav.nav-red-menu')
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0 mt-lg-0">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-md-2 px-lg-2">
                                        <div
                                            class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$protectionFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalProtectionFund" class="m-1 text-light text-center">RM {{ $totalProtectionNeeded !== null ? number_format(floatval($totalProtectionNeeded)) : $totalProtectionNeeded }}</h3>
                                        <p class="text-light text-center">Total Protection Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.monthly.support')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('protection_monthly_support')) pb-7 @endif h-100">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 align-items-end justify-content-center z-1 mh-100 second-order protection-monthly mt-auto">
                                        <img src="{{ asset('images/needs/protection/protection-monthly.png') }}" class="mh-100 z-1 p-2 mw-mob h-100 m-auto">
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('protection_monthly_support') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order pt-4 pt-lg-0 z-1 mob-align-top">
                                        <div class="row justify-content-center">
                                            <div class="col-10 col-md-8 d-flex align-items-center">
                                                <p class="f-34"><strong>If anything should happen to me, I'd like to support my family with</strong><br>
                                                    <span class="currencyinput f-34">RM<input type="text" name="protection_monthly_support" class="form-control d-inline-block w-50 money f-34 @error('protection_monthly_support') is-invalid @enderror" id="protection_monthly_support" value="{{ $protectionMonthlySupport !== null ? number_format(floatval($protectionMonthlySupport)) : $protectionMonthlySupport }}" required></span>
                                                    <strong>/month.</strong>
                                                </p>
                                                <input type="hidden" name="total_protectionNeeded" id="total_protectionNeeded" value="{{$totalProtectionNeeded}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('protection.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('protection_monthly_support'))
                            <section class="row alert-support z-99 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('protection_monthly_support') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('protection_monthly_support') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('protection_monthly_support') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
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
    // Get the input value
    var monthlyInput = document.getElementById("protection_monthly_support");
    var totalProtectionNeeded = document.getElementById("total_protectionNeeded");

    var totalProtectionFund = document.getElementById("TotalProtectionFund");

    monthlyInput.addEventListener("input", function() {

        // Retrieve the current input value
        var monthlyInputValue = monthlyInput.value;

        // Remove non-digit characters
        const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));

        // Attempt to parse the cleaned value as a float
        const parsedValue = parseFloat(cleanedValue);

        // Check if the parsed value is a valid number
        if (!isNaN(parsedValue)) {
        // If it's a valid number, format it with commas
            const formattedValue = parsedValue.toLocaleString('en-MY');
            this.value = formattedValue;
        } else {
        // If it's not a valid number, display the cleaned value as is
            this.value = monthlyInputValue;
        }

        var monthlyAmount = parseInt(cleanedValue);

        // Calculate months
        var amountPerYear = monthlyAmount * 12;

        if (isNaN(monthlyAmount)) {
            // Input is not a valid number
            totalProtectionFund.innerText = "RM 0";
            displayAvatar.innerText = "RM 0";
        } else {
            // Input is a valid number, perform the calculation
            // Display the result
            var result = amountPerYear.toLocaleString();

            totalProtectionFund.innerText = "RM " + result;
        }

        // Set the value of the hidden input field
        totalProtectionNeeded.value = amountPerYear;
    });

    document.addEventListener("DOMContentLoaded", function() {
        monthlyInput.addEventListener("blur", function() {
            validateNumberField(monthlyInput);
    });

    function validateNumberField(field) {
        var value = field.value.replace(/,/g, ''); // Remove commas
        var numericValue = parseFloat(value);

        if (isNaN(numericValue)) {
            // field.classList.remove("is-valid");
            field.classList.add("is-invalid");

        } else {
            // field.classList.add("is-valid");
            field.classList.remove("is-invalid");
        }
    }

});

</script>
@endsection