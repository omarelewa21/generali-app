@extends('templates.master')

@section('title')
<title>Savings - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $savings = session('customer_details.savings_needs');
    $savingsGoalDuration = session('customer_details.savings_needs.investmentTimeFrame');
    $newTotalSavingsNeeded = session('customer_details.savings_needs.newTotalSavingsNeeded');
    $savingsGoalPA = session('customer_details.savings_needs.annualReturn');
    $savingsAnnualReturn = session('customer_details.savings_needs.annualReturnAmount');
    $savingsFundPercentage = session('customer_details.savings_needs.fundPercentage', '0');
@endphp

<div id="savings-summary">
    <div class="container-fluid">
        <div class="row vh-100 scrollable-content">
            <div class="col-12">
                <div class="row h-100 bg-needs-master-full wrapper-needs-summary-default">
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
                    <form novalidate action="{{route('form.submit.savings.gap')}}" method="POST" class="m-0 content-summary-default">
                        @csrf
                        <section class="row align-items-end mh-100">
                            <div class="col-12 position-relative mh-100 scrollable-content">
                                <div class="row h-100">
                                    <div class="col-12 col-xl-5 d-flex align-items-center justify-content-center z-1 mh-100 h-100">
                                        <div class="row graph-wrapper mt-5 mt-xl-0">
                                            <div class="col-12 d-flex justify-content-center summary-graph mt-md-6">
                                                <div class="svg-container" style="transform:scale(1.3)">
                                                    <div class="card-gap" id="gap">
                                                        <div class="card-gap__percent">
                                                            <svg>
                                                                <defs>
                                                                <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                                    <stop offset="10%"   stop-color="{{ $savingsFundPercentage >= 100 ? 'rgba(100, 238, 215)' : '#FF7D7A' }}"/>
                                                                    <stop offset="100%" stop-color="{{ $savingsFundPercentage >= 100 ? '#14A38B' : '#C1210D' }}"/>
                                                                </linearGradient >
                                                                </defs>
                                                                <g id="circle">
                                                                    <circle cx="90" cy="90" r="144" stroke="url(#gradient)"></circle>
                                                                    <circle r="15" style="fill:white;display:none;" id="dotCircle"></circle>
                                                                </g>
                                                            </svg>
                                                            <div class="circle"></div>
                                                            <div class="circle circle__medium"></div>
                                                            <div class="circle circle__small"></div>
                                                            <div class="card-gap__number text-primary text-center" style="font-size:80px;line-height:90px;">{{floor(floatval($savingsFundPercentage))}}%
                                                                <h5 class="f-family text-black" style="font-size:25px;">covered</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center py-2 summary-title">
                                                <h5 class="f-family fw-700">Total Savings Fund</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 d-flex align-items-center z-1 justify-content-center h-100 mh-100">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-12 mb-3 justify-content-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-11 col-md-10 col-xs-10 d-flex align-items-center">
                                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                                            <div class="m-0 d-flex align-items-center w-md-50">
                                                                <img src="{{ asset('images/needs/icon/clock.png') }}">
                                                                <h6 class="f-family fw-700 m-0 ps-3">After the next</h6>
                                                            </div>
                                                            <div class="m-0 ml-auto">
                                                                <h4 class="f-family fw-700 summary-value m-0">{{$savingsGoalDuration}} years</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="align-self-center green-tick"></span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3 justify-content-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-11 col-md-10 col-xs-10 d-flex align-items-center">
                                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                                            <div class="m-0 d-flex align-items-center w-md-50">
                                                                <img src="{{ asset('images/needs/icon/umbrella.png') }}">
                                                                <h6 class="f-family fw-700 m-0 ps-3">I want to achieve my goals with</h6>
                                                            </div>
                                                            <div class="m-0 ml-auto">
                                                                <h4 class="f-family fw-700 summary-value m-0">RM {{number_format(floatval($newTotalSavingsNeeded))}}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="align-self-center green-tick"></span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3 justify-content-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-11 col-md-10 col-xs-10 d-flex align-items-center">
                                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                                            <div class="m-0 d-flex align-items-center w-md-50">
                                                                <img src="{{ asset('images/needs/icon/saving.png') }}">
                                                                <h6 class="f-family fw-700 m-0 ps-3">I am expecting to have an annual returns of</h6>
                                                            </div>
                                                            <div class="m-0 ml-auto">
                                                                <h4 class="f-family fw-700 summary-value m-0">{{$savingsGoalPA}}% p.a.</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="align-self-center green-tick"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-block d-md-none footer bg-white py-4 z-1">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                                    <a href="{{route('savings.risk.profile')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default d-none d-md-block">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('savings.risk.profile')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var savingsAnnualReturn =  {{$savingsAnnualReturn}};
    var newTotalSavingsNeeded = {{$newTotalSavingsNeeded}};
    var percentage = {{$savingsFundPercentage}};
</script>

@endsection