@extends('templates.master')

@section('title')
<title>Savings - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $protectionSupportingYears = isset($arrayData['protection']['protectionSupportingYears']) ? $arrayData['protection']['protectionSupportingYears'] : '';
    $existingPolicyAmount = isset($arrayData['protection']['existingPolicyAmount']) ? $arrayData['protection']['existingPolicyAmount'] : '';
    $newTotalProtectionNeeded = isset($arrayData['protection']['newTotalProtectionNeeded']) ? $arrayData['protection']['newTotalProtectionNeeded'] : '';
    $totalAmountNeeded = isset($arrayData['protection']['totalAmountNeeded']) ? $arrayData['protection']['totalAmountNeeded'] : '';
    $protectionFundPercentage = isset($arrayData['protection']['protectionFundPercentage']) ? $arrayData['protection']['protectionFundPercentage'] : 0;
@endphp

<div id="protection-summary"  class="vh-100 scrollable-content">
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
                    <form novalidate action="{{route('form.submit.protection.gap')}}" method="POST" class="m-0 content-gap-default">
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
                                                                        <stop offset="10%"   stop-color="{{ $protectionFundPercentage === 100 ? 'rgba(100, 238, 215)' : '#FF7D7A' }}"/>
                                                                        <stop offset="100%" stop-color="{{ $protectionFundPercentage === 100 ? '#14A38B' : '#C1210D' }}"/>
                                                                        <circle cx="90" cy="90" r="15" style="fill:white"></circle>
                                                                    </linearGradient >
                                                                </defs>
                                                                <g id="circle">
                                                                    <circle cx="90" cy="90" r="144" stroke="url(#gradient)"></circle>
                                                                    <!-- <circle  cx="0" cy="0" r="15" style="fill:white" id="dotCircle"/> -->
                                                                </g>
                                                            </svg>
                                                            <div class="circle"></div>
                                                            <div class="circle circle__medium"></div>
                                                            <div class="circle circle__small"></div>
                                                            <div class="card-gap__number text-primary text-center" style="font-size:80px;line-height:90px;">{{ $totalAmountNeeded > $newTotalProtectionNeeded ? '100' : number_format(floatval($protectionFundPercentage))}}%
                                                                <h5 class="f-family text-black" style="font-size:25px;">covered</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center py-2 gap-title">
                                                <h5 class="f-family fw-700">Total Protection Fund</h5>
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
                                                                <h4 class="f-family fw-700 summary-value m-0">{{$protectionSupportingYears}} years</h4>
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
                                                                <h4 class="f-family fw-700 summary-value m-0">RM {{number_format(floatval($newTotalProtectionNeeded))}}</h4>
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
                                                                <h4 class="f-family fw-700 summary-value m-0">RM {{number_format(floatval($existingPolicyAmount))}}</h4>
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
                                                    <a href="{{route('protection.existing.policy')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
                                        <a href="{{route('protection.existing.policy')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
        var existingPolicyAmount =  {{$existingPolicyAmount}};
        var newTotalProtectionNeeded = {{$newTotalProtectionNeeded}};
        var Uncovered = (100 - Covered).toFixed(2);
        var Covered = (existingPolicyAmount / newTotalProtectionNeeded * 100).toFixed(2);
        var circle = document.getElementById("circle");
        var dotCircle = document.getElementById("dotCircle");

        circle.style.strokeDasharray = 904.896;
        let change = 904.896 - (904.896 * Covered) / 100; 
        if (change < 0) {
            change = 0; // 0 represents 100% coverage
            circle.style.strokeDashoffset = change;
            // console.log('change', change);
        }
        else   {
            circle.style.strokeDashoffset = change; // 904.896 represents 0% coverage
            
            // Calculate the position for the dotCircle based on the end point of the graph
            var radius = 144; // Assuming the radius of the circle
            var angle = (Covered / 100) * 360; // Convert percentage to degrees
            var x = radius * Math.cos((angle * Math.PI) / 180);
            var y = radius * Math.sin((angle * Math.PI) / 180);

            // Update the cx attribute of the dotCircle
            dotCircle.setAttribute("cx", x);
            // You may also want to update the cy attribute based on the y value if needed
            dotCircle.setAttribute("cy", y);
        }
    });
</script>

@endsection