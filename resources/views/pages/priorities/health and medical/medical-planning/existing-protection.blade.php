@extends('templates.master')

@section('title')
<title>Health Medical - Medical Planning Existing Protection Page</title>

@section('content')

@php
    // Retrieving values from the session
    $healthMedical = session('customer_details.health-medical_needs');
    $existingProtection = session('customer_details.health-medical_needs.medical_planning.existingProtection');
    $existingProtectionAmount = session('customer_details.health-medical_needs.medical_planning.existingProtectionAmount');
    $totalHealthMedicalNeeded = session('customer_details.health-medical_needs.medical_planning.totalHealthMedicalNeeded');
    $healthMedicalFundPercentage = session('customer_details.health-medical_needs.medical_planning.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.health-medical_needs.medical_planning.totalAmountNeeded');
@endphp

<div id="medical-existing-protection" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.medical.planning.existing.protection')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$healthMedicalFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalHealthMedicalFund" class="text-center display-3 text-uppercase text-white">RM{{ $existingProtectionAmount === null || $existingProtectionAmount === '' ? number_format(floatval($totalHealthMedicalNeeded)) : ($totalHealthMedicalNeeded > $existingProtectionAmount ? number_format(floatval($totalHealthMedicalNeeded - $existingProtectionAmount)) : '0') }}</h1>
                                <p class="text-white display-6 lh-base text-center">Total Health & Medical Fund Needed</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/health-medical/medical-planning/existing-protection/avatar.png') }}" width="auto" height="100%" alt="Existing Policy">
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-6 py-5 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm">I already have Medical/ Hospitalisation coverage.</h2>
                                <p class="d-flex pt-5">
                                    <span class="me-5 d-flex">
                                        <input type="radio" class="needs-radio @error('existing_protection_amount') checked-yes @enderror {{$existingProtection === 'yes' ? 'checked-yes' : ''}}" id="yes" name="medical_existing_protection" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','1');jQuery('#existing_protection_amount').attr('required',true);"
                                        {{ ($existingProtection && $existingProtection === 'yes' || $errors->has('existing_protection_amount') ? 'checked' : '')  }} >
                                        <label for="yes" class="form-label display-6 lh-base">Yes</label>
                                    </span>
                                    <span class="d-flex me-5">
                                        <input type="radio" class="needs-radio" id="no" name="medical_existing_protection" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','0');jQuery('#existing_protection_amount').removeAttr('required',false);"
                                        {{ ($existingProtection && $existingProtection === 'no' && !$errors->has('existing_protection_amount') ? 'checked' : '') }} >
                                        <label for="no" class="form-label display-6 lh-base">No</label>
                                    </span>
                                </p>
                                <div class="hide-content">
                                    <p class="display-6">Current covered amount: <span class="text-primary fw-bold border-bottom border-dark border-3 currencyField display-5 d-inline-block">RM<input type="text" name="existing_protection_amount" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('existing_protection_amount') is-invalid @enderror" id="existing_protection_amount" value="{{ $existingProtectionAmount !== null ? number_format(floatval($existingProtectionAmount)) : $existingProtectionAmount }}" required></span></p>
                                </div>
                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                <input type="hidden" name="percentage" id="percentage" value="{{$healthMedicalFundPercentage}}">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('existing_protection_amount') || $errors->has('medical_existing_protection'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('existing_protection_amount') }} {{ $errors->first('medical_existing_protection') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('health.medical.planning.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="footer-avatar-grey d-none d-md-block"></div>
        </div>
    </div>
</div>
<script>
    var oldTotalFund = parseFloat({{ $totalHealthMedicalNeeded }});
    var fundPercentage = parseFloat({{ $healthMedicalFundPercentage }});
    var sessionExistingProtectionAmount = parseFloat({{$existingProtectionAmount}});
</script>
@endsection