@extends('templates.master')

@section('title')
<title>Health & Medical - Medical Planning Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $healthPriority = session('customer_details.priorities.health-medical_discuss');
    $health_medical = session('customer_details.selected_needs.need_6.advance_details.health_care');
    $existingProtectionAmount = session('customer_details.selected_needs.need_6.advance_details.health_care.existing_amount');
    $medicalYear = session('customer_details.selected_needs.need_6.advance_details.health_care.year');
    $totalHealthMedicalNeeded = session('customer_details.selected_needs.need_6.advance_details.health_care.goals_amount');
    $healthMedicalFundPercentage = session('customer_details.selected_needs.need_6.advance_details.health_care.fund_percentage', '0');
    $totalAmountNeeded = session('customer_details.selected_needs.need_6.advance_details.health_care.insurance_amount');
@endphp

<div id="medical-summary" class="secondary-default-bg summary-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('form.submit.medical.planning.gap')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-4 text-center">Total Medical Plan Care Fund</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-xl-5 col-md-12 h-100 d-flex justify-content-center align-items-end graph-col">
                                <div class="svg-container h-100 graph-size">
                                    <div class="card-gap h-100" id="gap">
                                        <div class="card-gap__percent h-100">
                                            <svg>
                                                <defs>
                                                    <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                        <stop offset="10%"   stop-color="{{ $healthMedicalFundPercentage >= 100 ? 'rgba(100, 238, 215)' : '#FF7D7A' }}"/>
                                                        <stop offset="100%" stop-color="{{ $healthMedicalFundPercentage >= 100 ? '#14A38B' : '#C1210D' }}"/>
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
                                            <div class="card-gap__number text-primary text-center">
                                                <img src="{{ asset('images/top-priorities/new-health-medical-icon.png') }}" class="mb-3 sum-needs-icon"><br>
                                                <span>{{ $totalAmountNeeded > $totalHealthMedicalNeeded ? '100' : floor(floatval($healthMedicalFundPercentage))}}%</span>
                                                <p class="avatar-text text-center fw-bold text-black mt-2 mt-md-0">covered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-md-12 py-xxxl-5 gap-col pt-sm-3 pt-0 pt-xl-0">
                                <!-- <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-clock.png') }}" class="sum-icon" alt="clock icon" width="45">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">After the next</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">{{$medicalYear}} years</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div> -->
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-umbrella.png') }}" class="sum-icon" alt="umbrella icon" width="45">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">I want to be prepared for any hospitalisation expenses with</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">RM {{number_format(floatval($totalHealthMedicalNeeded))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-saving.png') }}" class="sum-icon" alt="saving icon" width="45">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">So far, I have set aside</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">RM {{$existingProtectionAmount === '' ? '0' : number_format(floatval($existingProtectionAmount))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-summary.png') }}" class="sum-icon" alt="summary icon" width="45">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">So I need a hospitalisation plan for</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end {{ $totalAmountNeeded === '0' ? 'text-correct' : '' }}">RM {{number_format(floatval($totalAmountNeeded) + (floatval($totalAmountNeeded) * (11 /100)) )}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center {{ $totalAmountNeeded === '0' ? 'green-tick' : 'red-tick' }}"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <p>*Calculated based on an average inflation rate of 11%.​</p>
                                    </div>
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
                                    <a href="{{route('health.medical.planning.existing.protection')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

<div class="modal fade" id="missingLastPageInputFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingLastPageInputFieldsLabel">You're required to enter previous value before you proceed to this page.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input the value in previous page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<script>
    var existingProtectionAmount =  parseFloat({{$existingProtectionAmount}});
    var percentage = parseFloat({{$healthMedicalFundPercentage}});
    var totalHealthMedicalNeeded = parseFloat({{$totalHealthMedicalNeeded}});
    var needs_priority = '{{$healthPriority}}';
    var lastPageInput = {!! json_encode($health_medical) !!};
</script>

@endsection