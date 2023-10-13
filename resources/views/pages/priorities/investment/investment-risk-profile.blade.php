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
@endphp

<div id="investment-risk-profile" class="vh-100 bg-master-mob">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 vh-100 wrapper-needs-coverage-default bg-education-gap">
                <section class="header-needs-default">
                    <div class="col-lg-6 col-md-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </section>
                <form novalidate action="{{route('validate.investment.risk.profile')}}" method="POST" class="content-needs-default m-0">
                    @csrf
                    <section class="overflow-auto overflow-hidden row content-block">
                        <div class="col-12 risk-header">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <h4 class="f-34 f-family fw-700">I am willing to take</h4>
                            </div>
                        </div>
                        <div class="col-12 risk-selection">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <div class="col-md-2 col-4 d-flex justify-content-center align-items-center px-1">
                                    <button class="border-0 w-100 risk-btn f-family @if($investmentRiskProfile === 'high-risk') default @endif" id="high-risk" data-avatar="high-risk" data-required="">High Risk</button>
                                </div>
                                <div class="col-md-2 col-4 d-flex justify-content-center align-items-center px-1">
                                    <button class="border-0 w-100 risk-btn f-family @if($investmentRiskProfile === 'medium-risk') default @endif" id="medium-risk" data-avatar="medium-risk" data-required="">Medium Risk</button>
                                </div>
                                <div class="col-md-2 col-4 d-flex justify-content-center align-items-center px-1">
                                    <button class="border-0 w-100 risk-btn f-family @if($investmentRiskProfile === 'low-risk') default @endif" id="low-risk" data-avatar="low-risk" data-required="">Low Risk</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-11 m-auto risk-content mh-100 h-100 z-1">
                            <div class="slick-slide d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/needs/risk-profile/high-risk.png') }}" id="high-risk-img" class="mt-auto mh-100 mx-auto coverage-image" style="display:none;">
                                <img src="{{ asset('images/needs/risk-profile/medium-risk.png') }}" id="medium-risk-img" class="mt-auto mh-100 mx-auto coverage-image" style="display:none;">
                                <img src="{{ asset('images/needs/risk-profile/low-risk.png') }}" id="low-risk-img" class="mt-auto mh-100 mx-auto coverage-image" style="display:none;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('investmentRiskProfileInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('investmentRiskProfileInput'))
                        <section class="row warning z-1">
                            <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('investmentRiskProfileInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-white py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="investmentRiskProfileInput" id="investmentRiskProfileInput" value="{{$investmentRiskProfile}}">
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

@endsection