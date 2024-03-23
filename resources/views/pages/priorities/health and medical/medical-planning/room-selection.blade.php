<?php
 /**
 * Template Name: Health Medical - Hospitalisation Room Selection Page
 */
?>

@extends('templates.master')

@section('title')
<title>Health Medical - Hospitalisation Room Selection Page</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $healthPriority = session('customer_details.priorities.health-medical_discuss');
    $selectedRoom = session('customer_details.selected_needs.need_6.advance_details.health_care.room_option');
    $selectedHospital = session('customer_details.selected_needs.need_6.advance_details.health_care.type_of_hospital');
    $gender = session('customer_details.avatar.gender', 'Male');
    $skintone = session('customer_details.avatar.skin_tone', 'white');
@endphp

<div id="hospital-room-selection">
    <div class="container-fluid">
        <div class="row parallax-section">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar-default order-md-1 order-sm-2 order-2 px-0 parallax-inner parallax-bottom">
                <div class="header"><div class="row">@include('templates.nav.nav-red-white-menu')</div></div>
                <section class="avatar-design-placeholder content-avatar-default overflow-hidden">
                    <div class="col-12 text-center d-flex justify-content-center room-selection-title">
                        <div class="col-xl-6 col-lg-10 col-md-12 col-8">
                            <h2 class="display-5 fw-bold lh-sm text-center">If I had to be hospitalized, I'd rather have:</h2>
                        </div>
                    </div>
                    <div class="col-12 text-center d-flex justify-content-center room-selection-content z-1">
                        @if(isset($gender) || isset($skintone))
                            <div id="lottie-animation" class="w-auto" style="height:200%;"></div>
                        @else
                            <img src="{{ asset('images/needs/health-medical/medical-planning/room-selection/avatar.webp') }}" alt="room selection avatar" width="auto" height="200%">
                        @endif
                    </div>
                    <div class="col-12 text-center d-flex justify-content-center bg-accent-light-white room-selection-footer"></div>
                </section>
                <div class="bottomObeserver bg-accent-light-white"></div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section parallax-inner parallax-top">
                <div class="scrollable-content">
                    <form action="{{ route('validate.medical.planning.room.selection') }}" method="post" class="buttonForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                            <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                                <div class="row px-4 pt-3 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12 pt-3 pt-md-5">
                                        <p class="text-white display-6 lh-base">Select your preferred room option.</p>
                                    </div>
                                </div>
                                <div class="row px-4 px-md-5">
                                    @if ($errors->has('roomTypeInput'))
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('roomTypeInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row px-4 px-md-5 pb-md-5 action_button_slider d-md-none d-block">
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($selectedRoom === 'my own space') default @endif" data-avatar="my own space" data-required="">
                                                    <img src="{{ asset('images/needs/health-medical/medical-planning/room-selection/own-space-icon.webp') }}" width="auto" height="100px" alt="own-space" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">My own space</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($selectedRoom === 'a companion') default @endif" data-avatar="a companion" data-required="">
                                                    <img src="{{ asset('images/needs/health-medical/medical-planning/room-selection/a-companion-icon.webp') }}" width="auto" height="100px" alt="a-companion" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">A companion</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($selectedRoom === 'more roommates') default @endif" data-avatar="more roommates" data-required="">
                                                    <img src="{{ asset('images/needs/health-medical/medical-planning/room-selection/more-roomate-icon.webp') }}" width="auto" height="100px" alt="more-roommates" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">More roommates</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-4 px-md-5 pb-md-5 d-md-block d-none">
                                    <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg @if($selectedRoom === 'my own space') default @endif">
                                            <div class="col-12 d-flex align-items-center justify-content-start hover">
                                                <button class="border-0 w-100 d-flex align-items-center py-4 @if($selectedRoom === 'my own space') default @endif" data-avatar="my own space" data-required="">
                                                    <div class="col-md-4 col-12">
                                                        <img class="needs-icon" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/own-space-icon.webp') }}" width="auto" height="110px" alt="own-space">
                                                    </div>
                                                    <div class="col-md-8 col-12 d-flex">
                                                        <p class="avatar-text text-start mb-0 fw-bold lh-normal">My own space</p>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg @if($selectedRoom === 'a companion') default @endif">
                                            <div class="col-12 d-flex align-items-center justify-content-start hover">
                                                <button class="border-0 w-100 d-flex align-items-center py-4 @if($selectedRoom === 'a companion') default @endif" data-avatar="a companion" data-required="">
                                                    <div class="col-4">
                                                        <img class="needs-icon" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/a-companion-icon.webp') }}" width="auto" height="100px" alt="a-companion">
                                                    </div>
                                                    <div class="col-8 d-flex">
                                                        <p class="avatar-text text-start mb-0 fw-bold lh-normal">A companion</p>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg @if($selectedRoom === 'more roommates') default @endif">
                                            <div class="col-12 d-flex align-items-center justify-content-start hover">
                                                <button class="border-0 w-100 d-flex align-items-center py-4 @if($selectedRoom === 'more roommates') default @endif" data-avatar="more roommates" data-required="">
                                                    <div class="col-4">
                                                        <img class="needs-icon" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/more-roomate-icon.webp') }}" width="auto" height="100px" alt="more-roommates">
                                                    </div>
                                                    <div class="col-8 d-flex">
                                                        <p class="avatar-text text-start mb-0 fw-bold lh-normal">More roommates</p>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <input type="hidden" name="roomTypeInput" id="roomTypeInput" value="{{$selectedRoom}}">
                                        <a href="{{route('health.medical.medical.planning.hospital.selection')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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
    var needs_priority = '{{json_encode($healthPriority)}}';
    var selectionInput = document.getElementById('roomTypeInput');
    var lastPageInput = '{{$selectedHospital}}';
    var genderSet = '{{$gender}}';
    var skintone = '{{$skintone}}';
    var gender = genderSet.toLowerCase();
</script>
@endsection