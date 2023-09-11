@extends('templates.master')

@section('title')
<title>Education - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $totalEducationYear = isset($arrayData['totalEducationYear']) ? $arrayData['totalEducationYear'] : '';
    $totalEducationFundNeeded = isset($arrayData['totalEducationFundNeeded']) ? $arrayData['totalEducationFundNeeded'] : '';
    $newTotalEducationFundNeeded = isset($arrayData['newTotalEducationFundNeeded']) ? $arrayData['newTotalEducationFundNeeded'] : '';
    $educationSavingAmount = isset($arrayData['educationSavingAmount']) ? $arrayData['educationSavingAmount'] : '';
    $totalAmountNeeded = isset($arrayData['totalAmountNeeded']) ? $arrayData['totalAmountNeeded'] : '';
    $educationFundPercentage = isset($arrayData['educationFundPercentage']) ? $arrayData['educationFundPercentage'] : 0;
@endphp

<div id="education-summary"  class="vh-100 scrollable-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-education-gap wrapper-needs-gap-default">
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
                    <form novalidate action="{{route('form.submit.education.gap')}}" method="POST" class="m-0 content-gap-default">
                        @csrf
                        <section class="row align-items-end mh-100">
                            <div class="col-12 position-relative mh-100 scrollable-content">
                                <div class="row h-100">
                                    <div class="col-12 col-xl-5 d-flex align-items-center justify-content-center z-1 mh-100">
                                        <div class="row graph-wrapper">
                                            <div class="col-12 d-flex justify-content-center graph-graph mt-md-6">
                                                <div class="svg-container" style="transform:scale(1.3)">
                                                    <div class="card-gap" id="gap">
                                                        <div class="card-gap__percent">
                                                            <svg>
                                                                <defs>
                                                                <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                                    <stop offset="10%"   stop-color="#FF7D7A"/>
                                                                    <stop offset="100%" stop-color="#C1210D"/>
                                                                </linearGradient >
                                                                </defs>
                                                                <circle cx="90" cy="90" r="144" stroke="url(#gradient)" id="circle"></circle>
                                                                {{-- <circle cx="-55" cy="90" r="10" style="fill:white" id="dotCircle"></circle> --}}
                                                            </svg>
                                                            <div class="circle"></div>
                                                            <div class="circle circle__medium"></div>
                                                            <div class="circle circle__small"></div>
                                                            <div class="card-gap__number text-primary">{{ $totalAmountNeeded > $newTotalEducationFundNeeded ? '100' : number_format(floatval($educationFundPercentage))}}%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center py-2 gap-title">
                                                <h5 class="f-family fw-700">Total Education Fund</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 d-flex align-items-center z-1 justify-content-center mt-5 mt-xl-0 mb-4 mb-md-0">
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
                                                                <h4 class="f-family fw-700 summary-value m-0">{{$totalEducationYear}} years</h4>
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
                                                                <h6 class="f-family fw-700 m-0 ps-3">I want to give my child a head start with</h6>
                                                            </div>
                                                            <div class="m-0 ml-auto">
                                                                <h4 class="f-family fw-700 summary-value m-0">RM {{number_format(floatval($totalEducationFundNeeded))}}</h4>
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
                                                                <h6 class="f-family fw-700 m-0 ps-3">I have set aside</h6>
                                                            </div>
                                                            <div class="m-0 ml-auto">
                                                                <h4 class="f-family fw-700 summary-value m-0">RM {{number_format(floatval($educationSavingAmount))}}</h4>
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
                                                                <img src="{{ asset('images/needs/icon/summary.png') }}">
                                                                <h6 class="f-family fw-700 m-0 ps-3">So I need a plan for</h6>
                                                            </div>
                                                            <div class="m-0 ml-auto">
                                                                <h4 class="f-family fw-700 summary-value m-0 {{ $totalAmountNeeded === '0' ? 'text-correct' : '' }}">RM {{number_format(floatval($totalAmountNeeded))}}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="align-self-center {{ $totalAmountNeeded === '0' ? 'green-tick' : 'red-tick' }}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                                    <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('education.other')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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
    document.addEventListener("DOMContentLoaded", function() {
        var educationSavingAmount =  {{$educationSavingAmount}};
        var newTotalEducationFundNeeded = {{$newTotalEducationFundNeeded}};
        var Uncovered = (100 - Covered).toFixed(2);
        var Covered = (educationSavingAmount / newTotalEducationFundNeeded * 100).toFixed(2);
        var circle = document.getElementById("circle");

        circle.style.strokeDasharray = 904.896;
        let change = 904.896 - (904.896 * Covered) / 100; 
        if (change < 0) {
            change = 0; // 0 represents 100% coverage
            circle.style.strokeDashoffset = change;
            // console.log('change', change);
        }
        else   {
            circle.style.strokeDashoffset = change; // 904.896 represents 0% coverage
        }
    });
</script>

@endsection