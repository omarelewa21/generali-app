<?php
 /**
 * Template Name: Savings Risk Profile Page
 */
?>

@extends('templates.master')

@section('title')
<title>Savings - Risk Profile</title>

@section('content')

@php
    // Retrieving values from the session
    $savings = session('customer_details.savings_needs');
    $savingsRiskProfile = session('customer_details.savings_needs.riskProfile');
    $savingsPotentialReturn = session('customer_details.savings_needs.potentialReturn');
@endphp

<div id="savings-risk-profile">
    <div class="container-fluid">
        <div class="row vh-100 scroll-content">
            <div class="col-12">
                <div class="row h-100 bg-half-master wrapper-needs-half-master-default">
                    <section class="header-needs-default">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                                @include('templates.nav.nav-red-menu')
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.savings.risk.profile')}}" method="POST" class="m-0 content-half-master-default">
                        @csrf
                        <section class="row half-master-content align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 align-items-end justify-content-center z-1 mh-100 second-order needs-half-master-content">
                                        <img src="{{ asset('images/needs/risk-profile/high-risk.png') }}" id="high-risk-img" class="mh-100 z-1 p-2 mw-mob h-100 m-auto" style="display:block;">
                                        <img src="{{ asset('images/needs/risk-profile/medium-risk.png') }}" id="medium-risk-img" class="mh-100 z-1 p-2 mw-mob h-100 m-auto" style="display:none;">
                                        <img src="{{ asset('images/needs/risk-profile/low-risk.png') }}" id="low-risk-img" class="mh-100 z-1 p-2 mw-mob h-100 m-auto" style="display:none;">
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order pt-4 pt-lg-0 z-1 mob-align-top">
                                        <div class="row justify-content-center">
                                            <div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-8 d-flex align-items-center">
                                                <div class="row justify-content-start align-items-center">
                                                    <h4 class="f-34 f-family fw-700 mb-5">I am willing to take</h4>
                                                    <div class="col-12 mb-3 z-1">
                                                        <button class="border-0 risk-btn f-family @if($savingsRiskProfile === 'High Risk') default @endif" id="high-risk" data-avatar="High Risk" data-required="{{old('savingsRiskProfileInput') === 'High Risk' ? 'selected' : ''}}">High Risk</button>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1" id="high-risk-potential-content" style="display:none;">
                                                        <p class="risk-potential-title px-3">Potential Return:</p>
                                                        <div class="row">
                                                            <div class="col-12 d-flex">
                                                                <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'High Risk' && $savingsPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                                                <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($savingsRiskProfile === 'High Risk' && $savingsPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                                                <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'High Risk' && $savingsPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1">
                                                        <button class="border-0 risk-btn f-family @if($savingsRiskProfile === 'Medium Risk') default @endif" id="medium-risk" data-avatar="Medium Risk" data-required="{{old('savingsRiskProfileInput') === 'Medium Risk' ? 'selected' : ''}}">Medium Risk</button>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1" id="medium-risk-potential-content" style="display:none;">
                                                        <p class="risk-potential-title px-3">Potential Return:</p>
                                                        <div class="row">
                                                            <div class="col-12 d-flex">
                                                                <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Medium Risk' && $savingsPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                                                <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($savingsRiskProfile === 'Medium Risk' && $savingsPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                                                <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Medium Risk' && $savingsPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1">
                                                        <button class="border-0 risk-btn f-family @if($savingsRiskProfile === 'Low Risk') default @endif" id="low-risk" data-avatar="Low Risk" data-required="{{old('savingsRiskProfileInput') === 'Low Risk' ? 'selected' : ''}}">Low Risk</button>
                                                    </div>
                                                    <div class="col-12 mb-3 risk-potential-content" id="low-risk-potential-content" style="display:none;">
                                                        <p class="risk-potential-title px-3">Potential Return:</p>
                                                        <div class="row">
                                                            <div class="col-12 d-flex">
                                                                <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Low Risk' && $savingsPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                                                <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($savingsRiskProfile === 'Low Risk' && $savingsPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                                                <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Low Risk' && $savingsPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="savingsRiskProfileInput" id="savingsRiskProfileInput" value="{{old('savingsRiskProfileInput', $savingsRiskProfile)}}">
                                                    <input type="hidden" name="savingsPotentialReturnInput" id="savingsPotentialReturnInput" value="{{$savingsPotentialReturn}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-block d-md-none footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('savings.annual.return')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('savingsRiskProfileInput') || $errors->has('savingsPotentialReturnInput'))
                            <section class="row alert-support z-1 d-none d-md-block">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->has('savingsRiskProfileInput') && $errors->has('savingsPotentialReturnInput') ? $errors->first('savingsRiskProfileInput') : $errors->first('savingsPotentialReturnInput') }}{{$errors->first('savingsRiskProfileInput')}}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 d-block d-md-none fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->has('savingsRiskProfileInput') && $errors->has('savingsPotentialReturnInput') ? $errors->first('savingsRiskProfileInput') : $errors->first('savingsPotentialReturnInput') }}</div>
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
                                        <a href="{{route('savings.annual.return')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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