@extends('templates.master')

@section('title')
<title>Education - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $education = session('customer_details.education_needs');
    $totalEducationYear = session('customer_details.education_needs.tertiaryEducationYear');
    $educationSavingAmount = session('customer_details.education_needs.existingFundAmount');
    $totalEducationNeeded = session('customer_details.education_needs.totalEducationNeeded');
    $educationFundPercentage = session('customer_details.education_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.education_needs.totalAmountNeeded');
@endphp

<div id="education-summary" class="summary-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('form.submit.education.gap')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-4 text-center">Total Education Fund</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-xl-5 col-lg-5 col-md-12 h-100 d-flex justify-content-center align-items-end">
                                <div class="svg-container h-100" style="transform:scale(1.3)">
                                    <div class="card-gap h-100" id="gap">
                                        <div class="card-gap__percent h-100">
                                            <svg>
                                                <defs>
                                                    <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                        <stop offset="10%"   stop-color="{{ $educationFundPercentage >= 100 ? 'rgba(100, 238, 215)' : '#FF7D7A' }}"/>
                                                        <stop offset="100%" stop-color="{{ $educationFundPercentage >= 100 ? '#14A38B' : '#C1210D' }}"/>
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
                                            <div class="card-gap__number text-primary text-center">{{ $totalAmountNeeded > $totalEducationNeeded ? '100' : floor(floatval($educationFundPercentage))}}%
                                                <p class="avatar-text text-center fw-bold text-black">covered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-12 py-5">
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-clock.png') }}" alt="clock icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">Within the next</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">{{$totalEducationYear}} years</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-umbrella.png') }}" alt="umbrella icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">I want to give my child a head start with</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">RM {{number_format(floatval($totalEducationNeeded))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-saving.png') }}" alt="saving icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">I have put aside</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">RM {{number_format(floatval($educationSavingAmount))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-summary.png') }}" alt="summary icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">So I need to plan for</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end {{ $totalAmountNeeded === '0' ? 'text-correct' : '' }}">RM {{number_format(floatval($totalAmountNeeded))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center {{ $totalAmountNeeded === '0' ? 'green-tick' : 'red-tick' }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('education.existing.fund')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

<script>
    var educationSavingAmount =  {{$educationSavingAmount}};
    var newTotalEducationFundNeeded = {{$totalEducationNeeded}};
    var percentage = {{$educationFundPercentage}};
</script>

@endsection