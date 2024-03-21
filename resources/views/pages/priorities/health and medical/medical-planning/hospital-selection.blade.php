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
    $healthPriority = session('customer_details.priorities.health-medical_discuss');
    $selectedHospital = session('customer_details.selected_needs.need_6.advance_details.health_care.type_of_hospital');
    $relationship = session('customer_details.selected_needs.need_6.advance_details.health_care.relationship');
@endphp

<div id="medical-hospital-selection" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.medical.planning.hospital.selection')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-5 fw-bold lh-sm text-center">If I had to seek treatment, I would prefer to visit a:</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content pt-0">
                    <div class="container h-100">
                    <div class="row justify-content-center h-100 d-flex align-items-end" id="hnm-selection">
                            <div class="h-100 d-flex justify-content-center align-items-center col-5">
                                <button class="border-0 bg-transparent position-relative choice d-flex justify-content-center h-100 @if($selectedHospital === 'private hospital') default @endif" id="private_hospital" data-avatar="private hospital" data-required="">
                                    <div class="mt-auto">
                                        <img src="{{ asset('images/needs/health-medical/medical-planning/hospital-selection/private-hospital.png') }}" width="auto" height="90%" class="m-auto pb-4">
                                        <p class="avatar-text text-center mb-0 fw-bold">Private hospital</p>
                                    </div>
                                </button>
                            </div>
                            <div class="h-100 d-flex justify-content-center align-items-center col-5">
                                <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($selectedHospital === 'general hospital') default @endif" id="general_hospital" data-avatar="general hospital" data-required="">
                                    <div class="mt-auto">
                                        <img src="{{ asset('images/needs/health-medical/medical-planning/hospital-selection/general-hospital.png') }}" width="auto" height="90%" class="m-auto pb-4">
                                        <p class="avatar-text text-center mb-0 fw-bold">General hospital</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 plant d-none d-xl-block">
                            <img src="{{ asset('images/needs/health-medical/medical-planning/hospital-selection/avatar.png') }}" class="mh-55 mw-100 position-absolute center hospital_avatar">
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('medicalHospitalSelectedInput'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('medicalHospitalSelectedInput') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="medicalHospitalSelectedInput" id="medicalHospitalSelectedInput" value="{{$selectedHospital}}">
                                    <a href="{{route('health.medical.medical.planning.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var selectionInput = document.getElementById('medicalHospitalSelectedInput');
    var needs_priority = '{{json_encode($healthPriority)}}';
    var lastPageInput = '{{$relationship}}';
</script>
@endsection