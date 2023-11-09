@extends('templates.master')

@section('title')
<title>Health Medical - Critical Illness Existing Protection Page</title>

@section('content')

@php
    // Retrieving values from the session
    $healthMedical = session('customer_details.health_medical_needs');
    $existingProtection = session('customer_details.health_medical_needs.critical_illness.existingProtection');
    $existingProtectionAmount = session('customer_details.health_medical_needs.critical_illness.existingProtectionAmount');
    $totalHealthMedicalNeeded = session('customer_details.health_medical_needs.critical_illness.totalHealthMedicalNeeded');
    $healthMedicalFundPercentage = session('customer_details.health_medical_needs.critical_illness.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.health_medical_needs.critical_illness.totalAmountNeeded');
@endphp

<div id="critical-existing-protection"  class="vh-100 scroll-content">
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
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$healthMedicalFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalHealthMedicalFund" class="m-1 text-light text-center f-50">RM{{ $existingProtectionAmount !== null && $totalHealthMedicalNeeded !== '' ? number_format(floatval($totalHealthMedicalNeeded) - floatval($existingProtectionAmount)) : number_format(floatval($totalHealthMedicalNeeded))}}</h3>
                                        <p class="text-light text-center">Total Health & Medical Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.critical.illness.existing.protection')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('existing_protection_amount')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{ asset('images/needs/health-medical/critical-illness/existing-protection/avatar.png') }}" class="mt-auto mh-100 h-100 mw-100 w-auto avatar-img mx-auto">
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('existing_protection_amount') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-start first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-10 col-md-9 py-xl-5 my-xl-5">
                                                <p class="f-34 m-0 fw-700">I already have Critical Illness protection.<br>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio @error('existing_protection_amount') checked-yes @enderror {{$existingProtection === 'yes' ? 'checked-yes' : ''}}" id="yes" name="critical_existing_protection" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('display','block');jQuery('#existing_protection_amount').attr('required',true);"
                                                        {{ ($existingProtection && $existingProtection === 'yes' || $errors->has('existing_protection_amount') ? 'checked' : '')  }} >
                                                        <label for="yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="no" name="critical_existing_protection" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('display','none');jQuery('#existing_protection_amount').removeAttr('required',false);"
                                                        {{ ($existingProtection && $existingProtection === 'no' && !$errors->has('existing_protection_amount') ? 'checked' : '') }} >
                                                        <label for="no" class="form-label">No</label>
                                                    </span>
                                                </p>
                                                <p class="hide-content">Current savings amount:
                                                    <span class="currencyinput f-34">RM<input type="text" name="existing_protection_amount" class="form-control d-inline-block w-45 money f-34 @error('existing_protection_amount') is-invalid @enderror" id="existing_protection_amount" value="{{ $existingProtectionAmount !== null ? number_format(floatval($existingProtectionAmount)) : $existingProtectionAmount }}" required></span>
                                                </p>
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$healthMedicalFundPercentage}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('health.medical.critical.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('existing_protection_amount') || $errors->has('critical_existing_protection'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('existing_protection_amount') }}{{ $errors->first('critical_existing_protection') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('existing_protection_amount') }}{{ $errors->first('critical_existing_protection') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('existing_protection_amount') || $errors->has('critical_existing_protection') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('health.medical.critical.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var oldTotalFund = parseFloat({{ $totalHealthMedicalNeeded }});
    var fundPercentage = parseFloat({{ $healthMedicalFundPercentage }});
    var sessionExistingProtectionAmount = parseFloat({{$existingProtectionAmount}});
</script>
@endsection