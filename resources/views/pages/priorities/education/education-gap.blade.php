@extends('templates.master')

@section('title')
<title>Education - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $totalEducationYear = isset($arrayData['education']['totalEducationYear']) ? $arrayData['education']['totalEducationYear'] : '';
    $totalEducationFundNeeded = isset($arrayData['education']['totalEducationFundNeeded']) ? $arrayData['education']['totalEducationFundNeeded'] : '';
    $newTotalEducationFundNeeded = isset($arrayData['education']['newTotalEducationFundNeeded']) ? $arrayData['education']['newTotalEducationFundNeeded'] : '';
    $educationSavingAmount = isset($arrayData['education']['educationSavingAmount']) ? $arrayData['education']['educationSavingAmount'] : '';
    $totalAmountNeeded = isset($arrayData['education']['totalAmountNeeded']) ? $arrayData['education']['totalAmountNeeded'] : '';
    $educationFundPercentage = isset($arrayData['education']['educationFundPercentage']) ? $arrayData['education']['educationFundPercentage'] : 0;
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
                                                                <g id="circle">
                                                                    <circle cx="90" cy="90" r="144" stroke="url(#gradient)">
                                                                    </circle>
                                                                    <circle cx="" cy="" r="15" style="fill:white" id="dotCircle"></circle>
                                                                </g>
                                                            </svg>
                                                            <div class="circle"></div>
                                                            <div class="circle circle__medium"></div>
                                                            <div class="circle circle__small"></div>
                                                            <div class="card-gap__number text-primary text-center" style="font-size:80px;line-height:90px;">{{ $totalAmountNeeded > $newTotalEducationFundNeeded ? '100' : number_format(floatval($educationFundPercentage))}}%
                                                                <h5 class="f-family text-black" style="font-size:25px;">covered</h5>
                                                            </div>
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
                                                                <h4 class="f-family fw-700 summary-value m-0">RM {{number_format(floatval($newTotalEducationFundNeeded))}}</h4>
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
                                                    <a href="{{route('education.other')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
                                        <a href="{{route('education.other')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
        var dotCircle = document.getElementById("dotCircle");
        var percentage = {{$educationFundPercentage}};

        circle.style.strokeDasharray = 904.896;
        let change = 904.896 - (904.896 * Covered) / 100; 
        if (change < 0) {
            change = 0; // 0 represents 100% coverage
            circle.style.strokeDashoffset = change;
            // console.log('change', change);
        }
        else   {
            circle.style.strokeDashoffset = change; // 904.896 represents 0% coverage

            // // Calculate the position for the dotCircle based on the end point of the graph
            const percent = Math.round(percentage);
            if (percent === 100 || percent === 0){
                dotCircle.style.display = "none";
            }
            else{
                if (percent === 1 || percent === 2){
                    startX = 234;
                    startY = 90;
                    var x = startX - percent;
                    var y = startY += 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 3 && percent <= 6){
                    startX = 238;
                    startY = 94;
                    var x = startX -= 2 * percent;
                    var y = startY += 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 7 && percent <= 10){
                    startX = 250;
                    startY = 92;
                    var x = startX -= 4 * percent;
                    var y = startY += 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 11 && percent <= 15){
                    startX = 260;
                    startY = 110;
                    var x = startX -= 5 * percent;
                    var y = startY += 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 16 && percent <= 21){
                    startX = 300;
                    startY = 145;
                    var x = startX -= 8 * percent;
                    var y = startY += 4 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 22 && percent <= 26){
                    startX = 340;
                    startY = 209;
                    var x = startX -= 10 * percent;
                    var y = startY + percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 27 && percent <= 28){
                    startX = 289;
                    startY = 205;
                    var x = startX -= 8 * percent;
                    var y = startY + percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if(percent === 29){
                    dotCircle.setAttribute("cx", "50");
                    dotCircle.setAttribute("cy", "229");
                }
                else if (percent === 30 ){
                    dotCircle.setAttribute("cx", "44");
                    dotCircle.setAttribute("cy", "226");
                }
                else if (percent >= 31 && percent <= 35){
                    startX = 355;
                    startY = 384;
                    var x = startX -= 10 * percent;
                    var y = startY -= 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 36 && percent <= 42){
                    startX = 180;
                    startY = 385;
                    var x = startX -= 5 * percent;
                    var y = startY -= 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 43 && percent <= 47){
                    startX = 90;
                    startY = 500;
                    var x = startX -= 3 * percent;
                    var y = startY -= 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 48 && percent <= 49){
                    startX = 93;
                    startY = 492;
                    var x = startX -= 3 * percent;
                    var y = startY -= 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent === 50 ){
                    dotCircle.setAttribute("cx", "-55");
                    dotCircle.setAttribute("cy", "90");
                }
                else if (percent >= 51 && percent <= 58){
                    startX = -157;
                    startY = 492;
                    var x = startX += 2 * percent;
                    var y = startY -= 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 59 && percent <= 61){
                    startX = -207;
                    startY = 364;
                    var x = startX += 3 * percent;
                    var y = startY -= 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 62 && percent <= 64){
                    startX = -325;
                    startY = 364;
                    var x = startX += 5 * percent;
                    var y = startY -= 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 65 && percent <= 67){
                    startX = -386;
                    startY = 300;
                    var x = startX += 6 * percent;
                    var y = startY -= 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 68 && percent <= 69){
                    startX = -318;
                    startY = 166;
                    var x = startX += 5 * percent;
                    var y = startY -= 3 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y); -38
                }
                else if (percent === 70 ){
                    dotCircle.setAttribute("cx", "46");
                    dotCircle.setAttribute("cy", "-47");
                }
                else if (percent >= 71 && percent <= 77){
                    startX = -518;
                    startY = 22;
                    var x = startX += 8 * percent; 
                    var y = startY - percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 78 && percent <= 80){
                    startX = -670;
                    startY = -209;
                    var x = startX += 10 * percent; 
                    var y = startY += 2 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 81 && percent <= 85){
                    startX = -508;
                    startY = -370;
                    var x = startX += 8 * percent; 
                    var y = startY += 4 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 86 && percent <= 90){
                    startX = -336;
                    startY = -539;
                    var x = startX += 6 * percent; 
                    var y = startY += 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 91 && percent <= 93){
                    startX = -245;
                    startY = -718;
                    var x = startX += 5 * percent; 
                    var y = startY += 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 94 && percent <= 97){
                    startX = 37;
                    startY = -620;
                    var x = startX += 2 * percent; 
                    var y = startY += 7 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent === 98){
                    dotCircle.setAttribute("cx", "231");
                    dotCircle.setAttribute("cy", "59");
                }
                else if (percent === 99){
                    dotCircle.setAttribute("cx", "235");
                    dotCircle.setAttribute("cy", "90");
                }
            }
        }
    });
</script>

@endsection