<?php
 /**
 * Template Name: Top Priorities Page
 */
?>

@extends('templates.master')

@section('title')
<title>Top Priorities</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="top_priorities" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center">
                        <h4 class="fw-bold">Here's how I see my priorities:</h4>
                        <img src="{{ asset('/images/top-priorities/priorities-grid.png') }}" width="500px" class="mx-auto d-block pt-4" alt="">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white fw-bold pb-3">What are your top financial priorities?</h1>
                                    <p class="text-white display-6">Select your priorities by first to last.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="protection" data-required="">
                                            <img src="{{ asset('images/top-priorities/protection-icon.png') }}" width="auto" height="100px" alt="Protection">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Protection</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="retirement" data-required="">
                                            <img src="{{ asset('images/top-priorities/retirement-icon.png') }}" width="auto" height="100px" alt="Retirement">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Retirement</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="education" data-required="">
                                            <img src="{{ asset('images/top-priorities/education-icon.png') }}" width="auto" height="100px" alt="Education">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Education</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="savings" data-required="">
                                            <img src="{{ asset('images/top-priorities/savings-icon.png') }}" width="auto" height="100px" alt="Savings">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Savings</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="debt-cancellation" data-required="">
                                            <img src="{{ asset('images/top-priorities/debt-cancellation-icon.png') }}" width="auto" height="100px" alt="Debt Cancellation">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Debt Cancellation</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="health-medical" data-required="">
                                            <img src="{{ asset('images/top-priorities/health-medical-icon.png') }}" width="auto" height="100px" alt="Health & Medical">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Health & Medical</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="investments" data-required="">
                                            <img src="{{ asset('images/top-priorities/investments-icon.png') }}" width="auto" height="100px" alt="Investments">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Investments</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="others" data-required="">
                                            <img src="{{ asset('images/top-priorities/others-icon.png') }}" width="auto" height="100px" alt="Others">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                    <a href="{{route('avatar.my.assets')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('priorities.to.discuss') }}" class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection