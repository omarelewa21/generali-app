@extends('templates.master')

@section('title')
<title>Protection - Existing Policy</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $existingPolicy = isset($arrayData['protection']['existingPolicy']) ? $arrayData['protection']['existingPolicy'] : '';
    $existingPolicyAmount = isset($arrayData['protection']['existingPolicyAmount']) ? $arrayData['protection']['existingPolicyAmount'] : '';
    $newTotalProtectionNeeded = isset($arrayData['protection']['newTotalProtectionNeeded']) ? $arrayData['protection']['newTotalProtectionNeeded'] : '';
    $protectionFundPercentage = isset($arrayData['protection']['protectionFundPercentage']) ? $arrayData['protection']['protectionFundPercentage'] : 0;
    $totalAmountNeeded = isset($arrayData['protection']['totalAmountNeeded']) ? $arrayData['protection']['totalAmountNeeded'] : '';
@endphp

<div id="protection-existing-policy"  class="vh-100 scroll-content">
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
                                        <h3 id="TotalProtectionFund" class="m-1 text-light text-center">RM {{ $newTotalProtectionNeeded === null || $newTotalProtectionNeeded === '' ? number_format(floatval($newTotalProtectionNeeded)) : number_format(floatval($newTotalProtectionNeeded))}}</h3>
                                        <p class="text-light text-center">Total Protection Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.protection.existing.policy')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('existing_policy_amount')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{ asset('images/needs/protection/protection-existing.png') }}" class="mt-auto mh-100 h-100 mw-100 w-auto avatar-img">
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('existing_policy_amount') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-start first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-10 col-md-9 py-xl-5 my-xl-5">
                                                <p class="f-34 m-0 fw-700">Luckily, I do have an existing life insurance policy.<br>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio @error('existing_policy_amount') checked-yes @enderror {{$existingPolicy === 'yes' ? 'checked-yes' : ''}}" id="yes" name="protection_existing_policy" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('display','block');jQuery('#existing_policy_amount').attr('required',true);"
                                                        {{ (isset($arrayData['protection']['existingPolicy']) && $arrayData['protection']['existingPolicy'] === 'yes' || $errors->has('existing_policy_amount') ? 'checked' : '')  }} >
                                                        <label for="yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="no" name="protection_existing_policy" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('display','none');jQuery('#existing_policy_amount').removeAttr('required',false);"
                                                        {{ (isset($arrayData['protection']['existingPolicy']) && $arrayData['protection']['existingPolicy'] === 'no' && !$errors->has('existing_policy_amount') ? 'checked' : '') }} >
                                                        <label for="no" class="form-label">No</label>
                                                    </span>
                                                </p>
                                                <p class="hide-content">Existing policy amount:
                                                    <span class="currencyinput f-34">RM<input type="text" name="existing_policy_amount" class="form-control d-inline-block w-45 money f-34 @error('existing_policy_amount') is-invalid @enderror" id="existing_policy_amount" value="{{ $existingPolicyAmount !== null ? number_format(floatval($existingPolicyAmount)) : $existingPolicyAmount }}" required></span>
                                                </p>
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$protectionFundPercentage}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('protection.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('existing_policy_amount') || $errors->has('protection_existing_policy'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('existing_policy_amount') }}{{ $errors->first('protection_existing_policy') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('existing_policy_amount') }}{{ $errors->first('protection_existing_policy') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('existing_policy_amount') || $errors->has('protection_existing_policy') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var existing_policy_amount = document.getElementById('existing_policy_amount');
    var yesRadio = document.getElementById('yes');
    var noRadio = document.getElementById('no');
    var totalAmountNeeded = document.getElementById("total_amountNeeded");
    var totalProtectionPercentage = document.getElementById("percentage");
    var oldTotalFund = parseFloat({{ $newTotalProtectionNeeded }});
    var protectionFundPercentage = parseFloat({{ $protectionFundPercentage }});
    var sessionExistingPolicyAmount = parseFloat({{$existingPolicyAmount}});

    existing_policy_amount.addEventListener("input", function() {

        // Retrieve the current input value
        var existingPolicyAmountValue = existing_policy_amount.value;

        // Remove non-digit characters
        const cleanedValue = parseFloat(existingPolicyAmountValue.replace(/\D/g, ''));

        // Check if the parsed value is a valid number
        if (!isNaN(cleanedValue)) {
        // If it's a valid number, format it with commas
            const formattedValue = cleanedValue.toLocaleString('en-MY');
            this.value = formattedValue;
        } else {
        // If it's not a valid number, display the cleaned value as is
            this.value = existingPolicyAmountValue;
        }

        var existingAmount = parseInt(cleanedValue);

        var total = oldTotalFund - existingAmount;
        var totalPercentage = existingAmount / oldTotalFund * 100;
        
        $('.retirement-progress-bar').css('width', totalPercentage + '%');
        if (total <= 0){
            totalAmountNeeded.value = 0;
            totalProtectionPercentage.value = 100;
            $('.retirement-progress-bar').css('width','100%');
        }
        else{
            totalAmountNeeded.value = total;
            totalProtectionPercentage.value = totalPercentage;
            $('.retirement-progress-bar').css('width', totalPercentage + '%');
        }

    });
    // Add event listeners to the radio buttons
    yesRadio.addEventListener('change', function () {
        jQuery('.hide-content').css('display','block');
    });

    noRadio.addEventListener('change', function () {
        jQuery('.hide-content').css('display','none');
        existing_policy_amount.value = 0; // Clear the money input
        totalAmountNeeded.value = oldTotalFund;
        var totalPercentage = 0 / oldTotalFund * 100;
        totalProtectionPercentage.value = totalPercentage;
    });

    document.addEventListener('DOMContentLoaded', function() {

        existing_policy_amount.addEventListener('blur', function() {
            validateNumberField(existing_policy_amount);
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
                document.getElementById("existing_policy_amount").classList.remove("is-invalid");
            }
        }
    });
    
    if (sessionExistingPolicyAmount !== '' || sessionExistingPolicyAmount !== 0) {
        var newTotal = oldTotalFund - sessionExistingPolicyAmount;
        var newTotalPercentage = sessionExistingPolicyAmount / oldTotalFund * 100;
        if (newTotal <= 0){
            totalAmountNeeded.value = 0;
            totalProtectionPercentage.value = 100;
            $('.retirement-progress-bar').css('width','100%');
        }
        else{
            totalAmountNeeded.value = newTotal;
            totalProtectionPercentage.value = newTotalPercentage;
            $('.retirement-progress-bar').css('width', newTotalPercentage + '%');
        }
    } 
</script>
@endsection