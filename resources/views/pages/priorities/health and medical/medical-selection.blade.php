<?php
 /**
 * Template Name: Health & Medical Selection Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Health & Medical - Selection</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $healthPriority = session('customer_details.priorities.health-medical_discuss');
    $selectedHealthMedical = session('customer_details.selected_needs.need_6.number_of_selection');
    $selectedCritical = session('customer_details.selected_needs.need_6.advance_details.critical_illness.critical_illness_plan');
    $selectedMedical = session('customer_details.selected_needs.need_6.advance_details.health_care.medical_care_plan');
    $gender = session('customer_details.avatar.gender', 'Male');
    $skintone = session('customer_details.avatar.skin_tone', 'white');
@endphp

<div id="health-medical-selection" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.health.medical.selection')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-5 fw-bold lh-sm text-center">I'd like to select coverage for:​</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content">
                    <div class="container h-100">
                        <div class="row justify-content-center h-100 d-flex align-items-end" id="hnm-selection">
                            <div class="h-100 d-flex justify-content-center align-items-center col-5">
                                <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($selectedCritical === 'Critical Illness') default @endif" id="critical_illness" data-avatar="Critical Illness" data-required="">
                                    <div>
                                        @if(isset($gender) || isset($skintone))
                                            <div id="lottie-animation-critical" class="selection_height"></div>
                                        @else
                                            <img src="{{ asset('images/needs/health-medical/selection/critical-illness-avatar.webp') }}" width="auto" class="m-auto selection_height pb-3">
                                        @endif
                                        <p class="avatar-text text-center pt-2 mb-0 fw-bold">Critical Illness Care</p>
                                    </div>
                                </button>
                            </div>
                            <div class="h-100 d-flex justify-content-center align-items-center col-5">
                                <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($selectedMedical === 'Health Planning') default @endif" id="medical_planning" data-avatar="Health Planning" data-required="">
                                    <div>
                                        @if(isset($gender) || isset($skintone))
                                            <div id="lottie-animation-medical" class="selection_height"></div>
                                        @else
                                            <img src="{{ asset('images/needs/health-medical/selection/hospitalisation-avatar.webp') }}" width="auto" class="m-auto selection_height pb-3">
                                        @endif
                                        <p class="avatar-text text-center pt-2 mb-0 fw-bold">Medical Plan Care</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 plant d-none d-xl-block">
                            <img src="{{ asset('images/needs/health-medical/selection/plant.webp') }}" class="mh-100 position-absolute center" style="top:62%;">
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('selectionHealthMedicalInput'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('selectionHealthMedicalInput') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="selectionHealthMedicalInput" id="selectionHealthMedicalInput" value="{{$selectedHealthMedical}}">
                                    <input type="hidden" name="selectionCriticalInput" id="selectionCriticalInput" value="{{$selectedCritical}}">
                                    <input type="hidden" name="selectionMedicalInput" id="selectionMedicalInput" value="{{$selectedMedical}}">
                                    <a href="{{route('health.medical.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="footer-avatar-grey"></div>
        </div>
    </div>
</div>

<script>
    var needs_priority = '{{$healthPriority}}';
    var genderSet = '{{$gender}}';
    var skintone = '{{$skintone}}';
    var gender = genderSet.toLowerCase();
</script>
@endsection