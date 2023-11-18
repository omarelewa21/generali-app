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
    $protection = session('customer_details.protection_needs');
    $protectionMonthlySupport = session('customer_details.protection_needs.monthlySupportAmount');
    $existingPolicyAmount = session('customer_details.protection_needs.existingPolicyAmount');
    $protectionSupportingYears = session('customer_details.protection_needs.supportingYears');
    $totalProtectionNeeded = session('customer_details.protection_needs.totalProtectionNeeded', '0');
    $newTotalProtectionNeeded = session('customer_details.protection_needs.newTotalProtectionNeeded');
    $protectionFundPercentage = session('customer_details.protection_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.protection_needs.totalAmountNeeded');
    $existingPolicy = session('customer_details.protection_needs.existingPolicy');
    
@endphp


<div id="protection-monthly">
    <div class="container-fluid">
        <div class="row vh-100 scroll-content">
            <div class="col-12">
                <div class="row h-100 bg-half-content wrapper-needs-half-master-default">
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
                                        <h3 id="TotalProtectionFund" class="m-1 text-light text-center f-50">RM
                                            <!-- {{ ($newTotalProtectionNeeded !== null && $newTotalProtectionNeeded !== '' && $protectionSupportingYears !== null && $totalProtectionNeeded !== '' && $existingPolicyAmount === '') ? number_format(floatval($totalProtectionNeeded) * floatval($protectionSupportingYears))
                                                : ( ($newTotalProtectionNeeded !== null && $newTotalProtectionNeeded !== '' && $existingPolicyAmount !== '') ? ($existingPolicyAmount > (floatval($totalProtectionNeeded) * floatval($protectionSupportingYears)) ? '0' : number_format(floatval($totalProtectionNeeded) * floatval($protectionSupportingYears) - $existingPolicyAmount)) : number_format(floatval($totalProtectionNeeded)) ) }}</h3> -->
                                                {{
                                                ($protectionSupportingYears === null && $existingPolicyAmount === null)
                                                    ? number_format(floatval($totalProtectionNeeded))
                                                    : (
                                                        ($protectionSupportingYears !== null)
                                                            ? number_format(floatval($totalProtectionNeeded) * floatval($protectionSupportingYears))
                                                            : (
                                                                ($existingPolicyAmount !== '' && $protectionSupportingYears !== '')
                                                                    ? number_format(floatval($newTotalProtectionNeeded))
                                                                    : number_format(floatval($totalAmountNeeded))
                                                            )
                                                    )
                                                }}
                                        </h3>
                                        <p class="text-light text-center">Total Protection Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.monthly.support')}}" method="POST" class="m-0 content-half-master-default @if ($errors->has('protection_monthly_support')) pb-7 @endif h-100">
                        @csrf
                        <section class="row half-master-content align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 align-items-end justify-content-center z-1 mh-100 second-order needs-half-master-content mt-auto">
                                        <img src="{{ asset('images/needs/protection/protection-monthly.png') }}" class="mh-100 z-1 p-2 mw-mob h-100 m-auto">
                                        <div class="col-12 position-absolute bottom-0 d-block d-md-none">
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
                            <div class="col-12 d-block d-md-none footer bg-white py-4 z-1">
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
                            <section class="row alert-support z-99 d-none d-md-block">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('protection_monthly_support') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 d-block d-md-none fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('protection_monthly_support') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 d-none d-md-block">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('protection_monthly_support') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default d-none d-md-block">
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

@endsection