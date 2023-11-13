<?php
 /**
 * Template Name: Health & Medical - Medical Planning Room Selection
 */
?>

@extends('templates.master')

@section('title')
<title>Health & Medical - Medical Planning Room Selection</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $healthMedical = session('customer_details.health_medical_needs');
    $selectedRoom = session('customer_details.health_medical_needs.medical_planning.roomOption');
@endphp

<div id="hospital-room-selection">
    <div class="container-fluid">
        <div class="row scrollable-content vh-100 overflow-hidden">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 position-relative vh-100 wrapper-avatar-default bg-white z-1">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>    
                <section class="avatar-design-placeholder content-avatar-default">
                    <div class="col-12 text-center wrapper-room-selection">
                        <div class="row justify-content-center room-selection-title">
                            <div class="col-8 col-xxl-6 m-auto">
                                <h4 class="fw-bold">If I had to stay, I would rather have:</h4>
                            </div>
                        </div>
                        <div class="row justify-content-center single room-selection-content">
                            <div class="col-12 z-1 mt-auto single-patient position-relative" id="room-first-col">
                                <img class="pb-5 ml-auto own-space" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/Plant.png') }}">
                                <div class="windows couple-room"></div>
                                <img class="avatar-patient mw-100 mt-auto couple-room" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/single-room-avatar.png') }}">
                                <img class="position-absolute roommate more-rooms" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/first-roommate.png') }}">
                            </div>
                            <div class="col-12 z-99 mt-auto mx-auto mh-100 patient position-relative" id="room-center-col">
                                <img class="ml-auto windows own-space" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/window.png') }}">
                                <img class="mw-100 mh-100 row mx-auto avatar-patient mt-auto own-space" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/single-room-avatar.png') }}">
                                <img class="windows mw-100 w-75 couple-room" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/window.png') }}">
                                <img class="mw-100 row avatar-patient mt-auto ms-auto pb-3 couple-room" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/single-room-counter.png') }}">
                                <img class="position-absolute w-75 roommate more-rooms" style="left:10%;" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/beside-counter.png') }}">
                            </div>
                            <div class="col-12 z-1 mt-auto single-patient-2 position-relative" id="room-last-col">
                                <img class="pb-3 mr-auto own-space" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/single-room-counter.png') }}">
                                <img class="ml-auto windows pt-4 couple-room" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/clock.png') }}">
                                <img class="avatar-patient mw-100 mt-auto couple-room" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/campanion-avatar.png') }}">
                                <img class="position-absolute roommate more-rooms" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/second-roommate.png') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg"></div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form action="{{ route('validate.medical.planning.room.selection') }}" method="post" class="buttonForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                    <div class="col-12">
                                        <p class="text-white display-6 lh-base">Select your preferred room option.</p>
                                    </div>
                                </div>
                                @if ($errors->has('roomTypeInput'))
                                    <div class="row px-4 pb-4 px-sm-5">
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('roomTypeInput') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div id="needs" class="row px-4 pb-4 px-sm-5 needs">
                                    <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg @if($selectedRoom === 'my own space') default @endif">
                                            <div class="col-12 d-flex align-items-center justify-content-start hover">
                                                <button class="border-0 w-100 d-flex align-items-center py-4 @if($selectedRoom === 'my own space') default @endif" data-avatar="my own space" data-required="">
                                                    <div class="col-4">
                                                        <img class="needs-icon" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/own-space-icon.png') }}" width="auto" height="110px" alt="own-space">
                                                    </div>
                                                    <div class="col-8 d-flex">
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
                                                        <img class="needs-icon" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/a-companion-icon.png') }}" width="auto" height="100px" alt="a-companion">
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
                                                        <img class="needs-icon" src="{{ asset('images/needs/health-medical/medical-planning/room-selection/more-roomate-icon.png') }}" width="auto" height="100px" alt="more-roommates">
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
                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="roomTypeInput" id="roomTypeInput" value="{{$selectedRoom}}">
                                        <a href="{{route('health.medical.planning.hospital.selection')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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
    var selectionInput = document.getElementById('roomTypeInput');
</script>
@endsection