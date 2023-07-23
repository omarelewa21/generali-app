{{-- Priorities Menu page --}}

@extends('templates.master')

@section('title')
<title>Priorities - Menu</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="avatar_my_assets" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="pt-4">
                    <div class="text-center">
                        <img src="{{ asset('images/needs/needs-chart-empty.svg') }}" width="100%" height="380px"
                            alt="Needs Chart">
                        <div id="container">
                            <div id="left-container">
                                <!-- Circle container - Drop target -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary">
                <div class="scrollable-content">
                    <section class="main-content scrollable-padding">
                        <div class="container">
                            <div class="row px-4 py-4">
                                <div class="col-12">
                                    <h4 class="display-4 text-white font-normal pb-3">What are your top financial
                                        priorities?</h4>
                                    <p class="text-white display-6">Select your priorities by first to last.</p>
                                </div>
                            </div>
                            <div id="right-container">
                                <div class="col-6" id="protection-menu-needs"> <img class="draggable"
                                        src="{{ asset('images/needs/protection-icon.svg') }}" width="150px"
                                        height="100px" alt="Protection">
                                    </div>
                                <div class="col-6 draggable"><img src="{{ asset('images/needs/retirement-icon.svg') }}"
                                        width="150px" height="100px" alt="Retirement"></div>
                            <div class="row px-4">
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img class="draggable" src="{{ asset('images/needs/protection-icon.svg') }}" width="150px"
                                                height="100px" alt="Protection">
                                            <h6 class="avatar-text text-center pt-4">Protection</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img class="draggable"
                                                src="{{ asset('images/needs/retirement-icon.svg') }}" width="150px"
                                                height="100px" alt="Motorcycle">
                                            <h6 class="avatar-text text-center pt-4">Retirement</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/needs/education-icon.svg') }}" width="150px"
                                                height="100px" alt="Education">
                                            <h6 class="avatar-text text-center pt-4">Education</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/needs/savings-icon.svg') }}" width="150px"
                                                height="100px" alt="Savings">
                                            <h6 class="avatar-text text-center pt-4">Savings</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/needs/debt-cancellation-icon.svg') }}"
                                                width="150px" height="100px" alt="Debt Cancellation">
                                            <h6 class="avatar-text text-center pt-4">Debt Cancellation</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/needs/health-medical-icon.svg') }}" width="150px"
                                                height="100px" alt="Health and Medical">
                                            <h6 class="avatar-text text-center pt-4">Health & Medical</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/needs/investment-icon.svg') }}" width="150px"
                                                height="100px" alt="Investments">
                                            <h6 class="avatar-text text-center pt-4">Debt Cancellation</h6>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/needs/others-icon.svg') }}" width="150px"
                                                height="100px" alt="Others">
                                            <h6 class="avatar-text text-center pt-4">Health & Medical</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('avatar.family.dependant.details')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('identity.details') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
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