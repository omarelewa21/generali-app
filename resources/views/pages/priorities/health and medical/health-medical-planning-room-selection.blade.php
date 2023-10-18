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
    $arrayData = session('passingArrays');
    $savingsGoals = isset($arrayData['savings']['savingsGoals']) ? json_encode($arrayData['savings']['savingsGoals']) : '';
@endphp

<div id="savings-goals" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 position-relative vh-100 wrapper-avatar-default bg-white" style="z-index: 1;">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>    
                <section class="avatar-design-placeholder content-avatar-default">
                    <div class="col-12 text-center">
                        <div class="row justify-content-center">
                            <div class="col-8 col-md-5">
                                <h4 class="fw-bold">If I had to stay, I would rather have:</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('medicalHospitalSelectedInput') ? 'error-padding' : '' }}"></div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <p class="text-white display-6 lh-base">Select your preferred room option.</p>
                                </div>
                            </div>
                            <div id="needs" class="row px-4 pb-4 px-sm-5 needs">
                                <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                            <button class="border-0 w-100 d-flex align-items-center @if(isset($arrayData['savings']['savingsGoals']) && is_array($arrayData['savings']['savingsGoals']) && in_array('goal-travel', $arrayData['savings']['savingsGoals'])) default @endif" data-avatar="goal-travel" data-required="">
                                                <div class="col-4">
                                                    <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-travel.png') }}" width="auto" height="110px" alt="goal-travel">
                                                </div>
                                                <div class="col-8 d-flex justify-content-center">
                                                    <p class="avatar-text text-start mb-0 fw-bold lh-normal col-7">My own space</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                            <button class="border-0 w-100 d-flex align-items-center @if(isset($arrayData['savings']['savingsGoals']) && is_array($arrayData['savings']['savingsGoals']) && in_array('goal-wedding', $arrayData['savings']['savingsGoals'])) default @endif" data-avatar="goal-wedding" data-required="">
                                                <div class="col-4">
                                                    <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-wedding.png') }}" width="auto" height="100px" alt="goal-wedding">
                                                </div>
                                                <div class="col-8 d-flex justify-content-center">
                                                    <p class="avatar-text text-start mb-0 fw-bold lh-normal col-7">A companion</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                            <button class="border-0 w-100 d-flex align-items-center @if(isset($arrayData['savings']['savingsGoals']) && is_array($arrayData['savings']['savingsGoals']) && in_array('goal-home', $arrayData['savings']['savingsGoals'])) default @endif" data-avatar="goal-home" data-required="">
                                                <div class="col-4">
                                                    <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-home.png') }}" width="auto" height="100px" alt="goal-home">
                                                </div>
                                                <div class="col-8 d-flex justify-content-center">
                                                    <p class="avatar-text text-start mb-0 fw-bold lh-normal col-7">More roommates</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <form action="{{ route('form.goals') }}" method="post" class="buttonForm">
                        @csrf
                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="savingsGoalsBtnInput" id="savingsGoalsBtnInput" value="{{$savingsGoals}}">
                                        <a href="{{route('savings.coverage')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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
    var sessionData = {!! isset($savingsGoals) && $savingsGoals ? $savingsGoals : '[]' !!};
</script>
@endsection