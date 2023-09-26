@extends('templates.master')

@section('title')
<title>Protection - Existing Policy</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $educationSelectedImage = isset($arrayData['education']['educationSelectedImage']) ? $arrayData['education']['educationSelectedImage'] : '';
    $edcationSaving = isset($arrayData['education']['edcationSaving']) ? $arrayData['education']['edcationSaving'] : '';
    $totalEducationFundNeeded = isset($arrayData['education']['totalEducationFundNeeded']) ? $arrayData['education']['totalEducationFundNeeded'] : '';
    $newTotalEducationFundNeeded = isset($arrayData['education']['newTotalEducationFundNeeded']) ? $arrayData['education']['newTotalEducationFundNeeded'] : '';
    $educationFundPercentage = isset($arrayData['education']['educationFundPercentage']) ? $arrayData['education']['educationFundPercentage'] : 0;
    $educationSavingAmount = isset($arrayData['education']['educationSavingAmount']) ? $arrayData['education']['educationSavingAmount'] : '';
    $totalAmountNeeded = isset($arrayData['education']['totalAmountNeeded']) ? $arrayData['education']['totalAmountNeeded'] : '';
@endphp

<div id="education-content"  class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-education-others bg-education-others-mob wrapper-needs-supporting-default">
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
                                        <h3 id="TotalEducationFund" class="m-1 text-light text-center">RM {{ $newTotalEducationFundNeeded === null || $newTotalEducationFundNeeded === '' ? number_format(floatval($newTotalEducationFundNeeded)) : number_format(floatval($newTotalEducationFundNeeded))}}</h3>
                                        <p class="text-light text-center">Total Education Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('form.submit.education.other')}}" method="POST" id="children_education" class="m-0 content-supporting-default @if ($errors->has('education_saving_amount')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="education-monthly-content">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{ asset('images/needs/education/other/education-other-avatar.png') }}" class="mt-auto mh-100 w-auto mw-100 avatar-img">
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('education_saving_amount') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-10 col-md-9 py-xl-5 my-xl-5">
                                                <p class="f-34 m-0 fw-700">Luckily, I do have funds saved up for my child’s education.<br>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio @error('education_saving_amount') checked-yes @enderror {{$edcationSaving === 'yes' ? 'checked-yes' : ''}}" id="yes" name="education_other_savings" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('display','block');jQuery('#education_saving_amount').attr('required',true);"
                                                        {{ (isset($arrayData['education']['edcationSaving']) && $arrayData['education']['edcationSaving'] === 'yes' || $errors->has('education_saving_amount') ? 'checked' : '')  }} >
                                                        <label for="yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('display','none');jQuery('#education_saving_amount').removeAttr('required',false);"
                                                        {{ (isset($arrayData['education']['edcationSaving']) && $arrayData['education']['edcationSaving'] === 'no' && !$errors->has('education_saving_amount') ? 'checked' : '') }} >
                                                        <label for="no" class="form-label">No</label>
                                                    </span>
                                                </p>
                                                <p class="hide-content">Current savings amount:
                                                    <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-45 money f-34 @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" value="{{ $educationSavingAmount !== null ? number_format(floatval($educationSavingAmount)) : $educationSavingAmount }}" required></span>
                                                </p>
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$educationFundPercentage}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('education.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('education_saving_amount') || $errors->has('education_other_savings'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('education_saving_amount') }}{{ $errors->first('education_other_savings') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('education_saving_amount') }}{{ $errors->first('education_other_savings') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('education_saving_amount') || $errors->has('education_other_savings') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('education.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var education_saving = document.getElementById('education_saving_amount');
    var yesRadio = document.getElementById('yes');
    var noRadio = document.getElementById('no');
    var totalAmountNeeded = document.getElementById("total_amountNeeded");
    var totalEducationPercentage = document.getElementById("percentage");
    var oldTotalFund = parseFloat({{ $newTotalEducationFundNeeded }});
    var educationFundPercentage = parseFloat({{ $educationFundPercentage }});
    var sessionTotalAmount = parseFloat({{ $totalAmountNeeded }});
    var sessionSavingAmount = parseFloat({{$educationSavingAmount}});

    education_saving.addEventListener("input", function() {

        // Retrieve the current input value
        var educationSavingValue = education_saving.value;

        // Remove non-digit characters
        const cleanedValue = parseFloat(educationSavingValue.replace(/\D/g, ''));

        // Attempt to parse the cleaned value as a float
        const parsedValue = parseFloat(cleanedValue);

        // Check if the parsed value is a valid number
        if (!isNaN(parsedValue)) {
        // If it's a valid number, format it with commas
            const formattedValue = parsedValue.toLocaleString('en-MY');
            this.value = formattedValue;
        } else {
        // If it's not a valid number, display the cleaned value as is
            this.value = educationSavingValue;
        }

        var savingAmount = parseInt(cleanedValue);

        var total = oldTotalFund - savingAmount;
        var totalPercentage = savingAmount / oldTotalFund * 100;
        
        $('.retirement-progress-bar').css('width', totalPercentage + '%');
        if (total <= 0){
            totalAmountNeeded.value = 0;
            totalEducationPercentage.value = 100;
            $('.retirement-progress-bar').css('width','100%');
        }
        else{
            totalAmountNeeded.value = total;
            totalEducationPercentage.value = totalPercentage;
            $('.retirement-progress-bar').css('width', totalPercentage + '%');
        }

    });
    // Add event listeners to the radio buttons
    yesRadio.addEventListener('change', function () {
        jQuery('.hide-content').css('display','block');
        // education_saving.value = ''; // Clear the money input
        // totalAmountNeeded.value = '';
        // totalEducationPercentage.value = '';
    });

    noRadio.addEventListener('change', function () {
        jQuery('.hide-content').css('display','none');
        education_saving.value = 0; // Clear the money input
        totalAmountNeeded.value = oldTotalFund;
        var totalPercentage = 0 / oldTotalFund * 100;
        totalEducationPercentage.value = totalPercentage;
    });

    document.addEventListener('DOMContentLoaded', function() {

        education_saving.addEventListener('blur', function() {
            validateNumberField(education_saving);
            // passValue(education_saving);
        });

        if (yesRadio.classList.contains('checked-yes')) {
            jQuery('.hide-content').css('display','block');
        }
        
        function validateNumberField(field) {

            const value = field.value.trim();
            var pattern = /^[0-9,]+$/;

            if (value === '' || isNaN(value)) {
                // field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            } else {
                // field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            }
            if (pattern.test(value)){
                document.getElementById("education_saving_amount").classList.remove("is-invalid");
            }
        }
    });
    
    if (sessionSavingAmount !== '' || sessionSavingAmount !== 0) {
        var newTotal = oldTotalFund - sessionSavingAmount;
        var newTotalPercentage = sessionSavingAmount / oldTotalFund * 100;
        if (newTotal <= 0){
            totalAmountNeeded.value = 0;
            totalEducationPercentage.value = 100;
            $('.retirement-progress-bar').css('width','100%');
        }
        else{
            totalAmountNeeded.value = newTotal;
            totalEducationPercentage.value = newTotalPercentage;
            $('.retirement-progress-bar').css('width', newTotalPercentage + '%');
        }
    } 
</script>
@endsection