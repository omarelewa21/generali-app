<?php
 /**
 * Template Name: Retirement - Retire Age
 */
?>
@extends('templates.master')

@section('title')
<title>Retirement - Retire Age</title>

@section('content')

@php
    // Retrieving values from the session
    $retirement = session('customer_details.retirement_needs');
    $retirementAge = session('customer_details.retirement_needs.retirementAge');
    $newTotalRetirementNeeded = session('customer_details.retirement_needs.newTotalRetirementNeeded');
    $retirementFundPercentage = session('customer_details.retirement_needs.fundPercentage', '0');
@endphp


<div id="retirement-age">
    <div class="container-fluid">
        <div class="row vh-100 scroll-content">
            <div class="col-12">
                <div class="row h-100 bg-retire-age wrapper-needs-half-master-default">
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
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$retirementFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalRetirementFund" class="m-1 text-light text-center f-50">RM{{ $newTotalRetirementNeeded === null || $newTotalRetirementNeeded === '' ? number_format(floatval($newTotalRetirementNeeded)) : number_format(floatval($newTotalRetirementNeeded))}}</h3>
                                        <p class="text-light text-center">Total Retirement Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.retire.age')}}" method="POST" class="m-0 content-half-master-default @if ($errors->has('retirement_age')) pb-7 @endif h-100">
                        @csrf
                        <section class="row half-master-content align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-monthly-content">
                                    <div class="col-12 col-xl-6 needs-half-master-content align-items-end justify-content-center z-1 mh-100 second-order mt-auto">
                                        <!-- <div class="text-center education-support mh-100 z-1 h-100"> -->
                                            <img src="{{ asset('images/needs/retirement/retire-age/retire-age-avatar.png') }}" class="mh-100 z-1 p-2 mw-mob h-100 m-auto">
                                            <!-- <img src="{{ asset('images/needs/retirement/retire-age/retire-age-avatar.png') }}" class="mt-auto mh-100 w-auto mw-100 mx-auto avatar-img"> -->
                                        <!-- </div> -->
                                        <div class="col-12 position-absolute bottom-0 d-block d-md-none">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('retirement_age') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center">
                                            <div class="col-10 col-sm-6 col-md-6 col-lg-5 col-xl-7 col-xxl-6 col-xxxl-5 d-flex align-items-center">
                                                <p class="f-34"><strong>I'd like to retire at the age of</strong>
                                                    <span class="currencyinput f-34"><input type="text" name="retirement_age" class="form-control d-inline-block money text-center f-34 w-50" id="retirement_age" value="{{$retirementAge}}" required></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-block d-md-none footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('retirement.monthly.support')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('retirement_age'))
                            <section class="row alert-support z-1 d-none d-md-block">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirement_age') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 d-block d-md-none fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirement_age') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 d-none d-md-block">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('retirement_age') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default d-none d-md-block">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('retirement.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    
    var newTotalFund = parseFloat({{ $newTotalRetirementNeeded }});
    
</script>

@endsection