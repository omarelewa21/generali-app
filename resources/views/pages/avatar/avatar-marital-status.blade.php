<?php
 /**
 * Template Name: Avatar - Marital Status Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Marital Status</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="avatar_marital_status">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-7 gender-selection-bg">
                <section class="avatar-design-placeholder">
                    <div class="row pt-5">
                        <div class="col-12 text-center d-flex justify-content-center">
                            <img src="{{ asset('images/avatar/male-avatar.svg') }}" width="350px" alt="Male Avatar">
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-5 col-lg-5 bg-primary px-0 overflow-auto full-height-100">
                <section class="main-content py-4 px-4">
                    <div class="container">
                        <div class="row pb-4">
                            <div class="col-12">
                                <h4 class="display-4 text-white font-normal pb-3">May we know your relationship status?</h4>
                                <p class="text-white display-6">Click to select your marital status.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xxl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center">
                                    <button class="border-0 bg-white">
                                        <img src="{{ asset('images/avatar/single-icon.svg') }}" width="150px" height="100px" alt="Single">
                                        <h6 class="avatar-text text-center pt-4">Single</h6>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-xxl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center">
                                    <button class="border-0 bg-white">
                                        <img src="{{ asset('images/avatar/married-icon.svg') }}" width="150px" height="100px" alt="Married">
                                        <h6 class="avatar-text text-center pt-4">Married</h6>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-xxl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center">
                                    <button class="border-0 bg-white">
                                        <img src="{{ asset('images/avatar/divorced-icon.svg') }}" width="150px" height="100px" alt="Divorced">
                                        <h6 class="avatar-text text-center pt-4">Divorced</h6>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-xxl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center">
                                    <button class="border-0 bg-white">
                                        <img src="{{ asset('images/avatar/widowed-icon.svg') }}" width="150px" height="100px" alt="Widowed">
                                        <h6 class="avatar-text text-center pt-4">Widowed</h6>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="footer bg-accent-light-white py-4 position-fixed button-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('avatar.gender.selection')}}" class="btn btn-primary text-uppercase">Back</a>
                                    <a href="{{route('avatar.family.dependant') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection