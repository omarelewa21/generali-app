<?php
 /**
 * Template Name: Health & Medical - Medical Planning Hospital Selection Page
 */
?>

@extends('templates.master')

@section('title')
<title>Health & Medical - Medical Planning Hospital Selection</title>

@section('content')

@php
    // Retrieving values from the session
    $healthMedical = session('customer_details.health-medical_needs');
    $selectedHospital = session('customer_details.health-medical_needs.medical_planning.typeOfHospital');
@endphp

<div id="medical-hospital-selection">
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12 vh-100 wrapper-needs-master-full-default bg-needs-master-full">
                <section class="header-needs-default">
                    <div class="col-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </section>
                <form novalidate action="{{route('validate.medical.planning.hospital.selection')}}" method="POST" class="content-needs-default m-0">
                    @csrf
                    <section class="overflow-auto overflow-hidden row content-block">
                        <div class="col-12 header-content-coverage">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <div class="col-xl-5 col-xxl-4 col-md-6 col-12">
                                    <h4 class="f-34 f-family fw-700">If I had to seek treatment, I would prefer to visit a:</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 m-auto selection-content-coverage h-100 z-1">
                            <div class="row justify-content-center align-items-end position-relative" id="hnm-selection">
                                <div class="col-xl-5 col-12 hnm-selection">
                                    <button class="border-0 bg-transparent choice h-100 mx-auto slick-padding mt-auto button-needs justify-content-center align-items-center @if($selectedHospital === 'private hospital') default @endif" id="private_hospital" data-avatar="private hospital" data-required="">
                                        <img src="{{ asset('images/needs/health-medical/medical-planning/hospital-selection/private-hospital.png') }}" class="mt-auto mx-auto mw-100 mh-100">
                                        <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Private hospital</strong></p>
                                    </button>
                                </div>
                                <div class="col-xl-5 col-12 hnm-selection">
                                    <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto mx-auto button-needs justify-content-center align-items-center @if($selectedHospital === 'general hospital') default @endif" id="general_hospital" data-avatar="general hospital" data-required="">
                                        <img src="{{ asset('images/needs/health-medical/medical-planning/hospital-selection/general-hospital.png') }}" class="mt-auto mx-auto mw-100 mh-100">
                                        <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>General hospital</strong></p>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-2 hospital d-none d-xl-block">
                                <img src="{{ asset('images/needs/health-medical/medical-planning/hospital-selection/avatar.png') }}" class="mh-55 mw-100 position-absolute center">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('medicalHospitalSelectedInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('medicalHospitalSelectedInput'))
                        <section class="row warning z-1">
                            <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('medicalHospitalSelectedInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-white py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="medicalHospitalSelectedInput" id="medicalHospitalSelectedInput" value="{{$selectedHospital}}">
                                    <a href="{{route('health.medical.medical.planning.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
<script>
    var selectionInput = document.getElementById('medicalHospitalSelectedInput');
</script>
@endsection