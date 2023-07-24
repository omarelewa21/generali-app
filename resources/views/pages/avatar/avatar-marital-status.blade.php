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

<div id="avatar_marital_status" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <!-- <img src="{{ asset('images/avatar/male-avatar.svg') }}" width="350px" alt="Male Avatar"> -->
                        <img src="{{ asset('images/avatar/avatar/' . (session('image') ? session('image') : 'gender-male') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white font-normal pb-3 fw-bold">May we know your relationship status?</h1>
                                    <p class="text-white display-6">Click to select your marital status.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/single-icon.svg') }}" width="150px" height="100px" alt="Single">
                                            <p class="avatar-text text-center pt-4 fw-bold">Single</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/married-icon.svg') }}" width="150px" height="100px" alt="Married">
                                            <p class="avatar-text text-center pt-4 fw-bold">Married</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/divorced-icon.svg') }}" width="150px" height="100px" alt="Divorced">
                                            <p class="avatar-text text-center pt-4 fw-bold">Divorced</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/widowed-icon.svg') }}" width="150px" height="100px" alt="Widowed">
                                            <p class="avatar-text text-center pt-4 fw-bold">Widowed</p>
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
                                    <a href="{{route('identity.details')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('avatar.family.dependant') }}" class="btn btn-primary text-uppercase" id="nextButton">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>

@endsection