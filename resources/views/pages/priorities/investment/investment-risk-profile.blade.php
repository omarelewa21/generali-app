<?php
 /**
 * Template Name: Investment Risk Profile Page
 */
?>

@extends('templates.master')

@section('title')
<title>Investment - Risk Profile</title>

@section('content')

@php
    // Retrieving values from the session
    $investment = session('customer_details.investment_needs');
    $investmentRiskProfile = session('customer_details.investment_needs.riskProfile');
    $investmentPotentialReturn = session('customer_details.investment_needs.potentialReturn');
@endphp

<div id="investment-risk-profile" class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-needs-desktop bg-half wrapper-needs-supporting-default">
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
                    <form novalidate action="{{route('validate.investment.risk.profile')}}" method="POST" class="m-0 content-supporting-default">
                        @csrf
                        <section class="row edu-con mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 z-1 mh-100 second-order mt-auto">
                                        <div class="row align-items-end justify-content-center">
                                            <div class="text-center education-support mh-100 z-1 h-100 align-items-end">
                                                <img src="{{ asset('images/needs/risk-profile/high-risk.png') }}" id="high-risk-img" class="mt-auto mh-100 mw-100 mx-auto w-auto avatar-img" style="display:block;">
                                                <img src="{{ asset('images/needs/risk-profile/medium-risk.png') }}" id="medium-risk-img" class="mt-auto mh-100 mx-auto w-auto avatar-img" style="display:none;">
                                                <img src="{{ asset('images/needs/risk-profile/low-risk.png') }}" id="low-risk-img" class="mt-auto mh-100 mx-auto w-auto avatar-img" style="display:none;">
                                            </div>
                                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                                            <a href="{{route('investment.annual.return')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-8">
                                                <div class="row justify-content-start align-items-center">
                                                    <h4 class="f-34 f-family fw-700 mb-5">I am willing to take</h4>
                                                    <div class="col-12 mb-3">
                                                        <button class="border-0 risk-btn f-family @if($investmentRiskProfile === 'High Risk') default @endif" id="high-risk" data-avatar="High Risk" data-required="{{old('investmentRiskProfileInput') === 'High Risk' ? 'selected' : ''}}">High Risk</button>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1" id="high-risk-potential-content" style="display:none;">
                                                        <p class="risk-potential-title px-3">Potential Return:</p>
                                                        <div class="row">
                                                            <div class="col-12 d-flex">
                                                                <button class="potential-btn risk-potential-content f-family @if($investmentRiskProfile === 'High Risk' && $investmentPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                                                <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($investmentRiskProfile === 'High Risk' && $investmentPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                                                <button class="potential-btn risk-potential-content f-family @if($investmentRiskProfile === 'High Risk' && $investmentPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1">
                                                        <button class="border-0 risk-btn f-family @if($investmentRiskProfile === 'Medium Risk') default @endif" id="medium-risk" data-avatar="Medium Risk" data-required="{{old('investmentRiskProfileInput') === 'Medium Risk' ? 'selected' : ''}}">Medium Risk</button>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1" id="medium-risk-potential-content" style="display:none;">
                                                        <p class="risk-potential-title px-3">Potential Return:</p>
                                                        <div class="row">
                                                            <div class="col-12 d-flex">
                                                                <button class="potential-btn risk-potential-content f-family @if($investmentRiskProfile === 'Medium Risk' && $investmentPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                                                <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($investmentRiskProfile === 'Medium Risk' && $investmentPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                                                <button class="potential-btn risk-potential-content f-family @if($investmentRiskProfile === 'Medium Risk' && $investmentPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 z-1">
                                                        <button class="border-0 risk-btn f-family @if($investmentRiskProfile === 'Low Risk') default @endif" id="low-risk" data-avatar="Low Risk" data-required="{{old('investmentRiskProfileInput') === 'Low Risk' ? 'selected' : ''}}">Low Risk</button>
                                                    </div>
                                                    <div class="col-12 mb-3 risk-potential-content z-1" id="low-risk-potential-content" style="display:none;">
                                                        <p class="risk-potential-title px-3">Potential Return:</p>
                                                        <div class="row">
                                                            <div class="col-12 d-flex">
                                                                <button class="potential-btn risk-potential-content f-family @if($investmentRiskProfile === 'Low Risk' && $investmentPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                                                <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($investmentRiskProfile === 'Low Risk' && $investmentPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                                                <button class="potential-btn risk-potential-content f-family @if($investmentRiskProfile === 'Low Risk' && $investmentPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="investmentRiskProfileInput" id="investmentRiskProfileInput" value="{{old('investmentRiskProfileInput', $investmentRiskProfile)}}">
                                                    <input type="hidden" name="investmentPotentialReturnInput" id="investmentPotentialReturnInput" value="{{$investmentPotentialReturn}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('investmentRiskProfileInput') || $errors->has('investmentPotentialReturnInput'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->has('investmentRiskProfileInput') && $errors->has('investmentPotentialReturnInput') ? $errors->first('investmentRiskProfileInput') : $errors->first('investmentPotentialReturnInput') }}{{$errors->first('investmentRiskProfileInput')}}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->has('investmentRiskProfileInput') && $errors->has('investmentPotentialReturnInput') ? $errors->first('investmentRiskProfileInput') : $errors->first('investmentPotentialReturnInput') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('savingsRiskProfileInput') || $errors->has('savingsPotentialReturnInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('investment.annual.return')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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