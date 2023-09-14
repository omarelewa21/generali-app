<?php
 /**
 * Template Name: Education Monthly Needed Amount
 */
?>
@extends('templates.master')

@section('title')
<title>Education - Monthly Needed Amount</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $educationSelectedImage = isset($arrayData['education']['educationSelectedImage']) ? $arrayData['education']['educationSelectedImage'] : '';
    $educationMonthlyAmount = isset($arrayData['education']['educationMonthlyAmount']) ? $arrayData['education']['educationMonthlyAmount'] : '';
    $totalEducationFundNeeded = isset($arrayData['education']['totalEducationFundNeeded']) ? $arrayData['education']['totalEducationFundNeeded'] : '';
    $newTotalEducationFundNeeded = isset($arrayData['education']['newTotalEducationFundNeeded']) ? $arrayData['education']['newTotalEducationFundNeeded'] : '';
    $educationFundPercentage = isset($arrayData['education']['educationFundPercentage']) ? $arrayData['education']['educationFundPercentage'] : 0;
    $totalEducationYear = isset($arrayData['education']['totalEducationYear']) ? $arrayData['education']['totalEducationYear'] : '';
    $totalAmountNeeded = isset($arrayData['education']['totalAmountNeeded']) ? $arrayData['education']['totalAmountNeeded'] : '';
    $educationSavingAmount = isset($arrayData['education']['educationSavingAmount']) ? $arrayData['education']['educationSavingAmount'] : '';
    $edcationSaving = isset($arrayData['education']['edcationSaving']) ? $arrayData['education']['edcationSaving'] : '';
@endphp


<div id="education-supporting" class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-needs-desktop bg-half wrapper-needs-supporting-default">
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
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$educationFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalEducationFund" class="m-1 text-light text-center">RM {{ $totalEducationFundNeeded !== null ? number_format(floatval($totalEducationFundNeeded)) : $totalEducationFundNeeded }}</h3>
                                        <p class="text-light text-center">Total Education Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('form.submit.education.monthly')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('monthly_education_amount')) pb-7 @endif h-100">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="education-monthly-content">
                                    <div class="col-12 col-xl-6 avatar-supporting-wrapper align-items-end justify-content-center z-1 mh-100 second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{ asset('images/needs/education/monthly-amount/education-monthly-avatar.png') }}" class="mt-auto mh-100 w-auto mw-100 mx-auto avatar-img">
                                            <!-- <p class="py-2 m-0 avatar-text" id="displayFund">RM {{ $totalEducationFundNeeded !== null ? number_format(floatval($totalEducationFundNeeded)) : $totalEducationFundNeeded }}</p> -->
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('educationMonthlyAmount') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center">
                                            <div class="col-10 col-md-8 d-flex align-items-center">
                                                <p class="f-34"><strong>I plan to fund my child’s education with a total of</strong><br>
                                                    <span class="currencyinput f-34">RM<input type="text" name="monthly_education_amount" class="form-control d-inline-block w-50 money f-34 @error('monthly_education_amount') is-invalid @enderror" id="monthly_education_amount" value="{{ $educationMonthlyAmount !== null ? number_format(floatval($educationMonthlyAmount)) : $educationMonthlyAmount }}" required></span>
                                                    <!-- <span class="currencyinput f-34">RM<input type="text" name="monthly_education_amount" class="form-control d-inline-block w-50 money f-34 @error('monthly_education_amount') is-invalid @enderror" id="monthly_education_amount" value="{{$educationMonthlyAmount}}" required></span> -->
                                                    <strong>/month.</strong>
                                                </p>
                                                <input type="hidden" name="total_educationFund" id="total_educationFund" value="{{$totalEducationFundNeeded}}">
                                                <!-- <input type="hidden" name="tertiary_education_years" id="tertiary_education_years" value="{{$totalEducationYear}}">
                                                <input type="hidden" name="newTotal_educationFund" id="newTotal_educationFund" value="{{$newTotalEducationFundNeeded}}">
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$educationFundPercentage}}">
                                                <input type="hidden" name="education_saving_amount" id="education_saving_amount" value="{{$educationSavingAmount}}">
                                                <input type="hidden" name="education_other_savings" id="education_other_savings" value="{{$edcationSaving}}"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('monthly_education_amount'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('monthly_education_amount') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('monthly_education_amount') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('monthly_education_amount') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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
    var monthlyInput = document.getElementById("monthly_education_amount");

    // var totalEducationYear = document.getElementById("tertiary_education_years");
    var totalEducationFund = document.getElementById("TotalEducationFund");
    var totalEducationFundNeeded = document.getElementById("total_educationFund");
    // var totalAmountNeeded = document.getElementById("total_amountNeeded");
    // var totalEducationPercentage = document.getElementById("percentage");
    // var education_saving_amount = document.getElementById('education_saving_amount');
    // var education_saving = document.getElementById('education_other_savings');
    
    // var newTotalFund = document.getElementById("newTotal_educationFund");
    // var displayAvatar = document.getElementById("displayFund");

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
            totalEducationFund.innerText = "RM 0";
            // displayAvatar.innerText = "RM 0";
        } else {
            // Input is a valid number, perform the calculation
            // Display the result
            var result = amountPerYear.toLocaleString();

            totalEducationFund.innerText = "RM " + result;
            // displayAvatar.innerText = "RM " + result;
        }

        // Set the value of the hidden input field
        totalEducationFundNeeded.value = amountPerYear;
        // If type new value, clear the session year and pass again
        // totalEducationYear.value = '';
        // newTotalFund.value = '';
        // totalAmountNeeded.value = '';
        // totalEducationPercentage.value = '';
        // education_saving_amount.value = '';
        // education_saving.value = '';
        // $('.retirement-progress-bar').css('width', '0%');
    });

    document.addEventListener("DOMContentLoaded", function() {
        monthlyInput.addEventListener("blur", function() {
            validateNumberField(monthlyInput);
    });

    // function validateNumberField(field) {
    //     const value = field.value.trim();

    //     var pattern = /^[0-9,]+$/;

    //     if (value === "" || isNaN(value)) {
    //         // field.classList.remove("is-valid");
    //         field.classList.add("is-invalid");
    //     }else{
    //         // field.classList.add("is-valid");
    //         field.classList.remove("is-invalid");
    //     }
    //     if (pattern.test(value)){
    //         document.getElementById("monthly_education_amount").classList.remove("is-invalid");
    //     }
    // } 
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