<?php
 /**
 * Template Name: Avatar - Gender Selection Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Gender Selection</title>@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="avatar_gender_selection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-7 gender-selection-bg">
                <section class="avatar-color-palatte">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="display-6 text-dark">Pick the skin colour that’s closest to yours.</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 color-box-wrapper d-flex justify-content-center align-items-center justify-content-center">
                            <div class="col-2">
                                <div class="color-box" style="background-color: #F5DEB3;"></div>
                            </div>
                            <div class="col-2">
                                <div class="color-box" style="background-color: #F4A460;"></div>
                            </div>
                            <div class="col-2">
                                <div class="color-box" style="background-color: #D2B48C;"></div>
                            </div>
                            <div class="col-2">
                                <div class="color-box" style="background-color: #A0522D;"></div>
                            </div>
                            <div class="col-2">
                                <div class="color-box" style="background-color: #8B4513;"></div>
                            </div>
                            <div class="col-2">
                                <div class="color-box" style="background-color: #654321;"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="avatar-design-placeholder">
                    <div class="row pt-5">
                        <div class="col-12 text-center d-flex justify-content-center">
                            <img src="{{ asset('images/avatar/gender-male.svg') }}" width="350px" alt="Male Avatar">
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-5 col-lg-5 bg-primary px-0 overflow-auto full-height-100">
                <section class="main-content py-4 px-4">
                    <div class="container">
                        <div class="row pb-4">
                            <div class="col-12">
                                <h4 class="display-4 text-white font-normal pb-3">Nice to meet you,<br/>Peter</h4>
                                <p class="text-white display-6">Please click to select your gender.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xxl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                    <button class="border-0 bg-white">
                                        <img src="{{ asset('images/avatar/button-gender-male.png') }}" width="150px" alt="Gender Male">
                                        <h6 class="avatar-text text-center pt-4">Male</h6>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-xxl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                    <button class="border-0 bg-white">
                                        <img src="{{ asset('images/avatar/button-gender-female.png') }}" width="150px" alt="Gender Female">
                                        <h6 class="avatar-text text-center pt-4">Female</h6>
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
                                    <a href="{{route('avatar.welcome')}}" class="btn btn-primary text-uppercase">Back</a>
                                    <a href="{{ route('avatar.marital.status') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
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