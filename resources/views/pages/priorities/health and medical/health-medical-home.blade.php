<?php
 /**
 * Template Name: Health and Medical Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Health and Medical - Home</title>

@section('content')

<div id="health-medical-home" class="vh-100 overflow-x-hidden scrollable-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3 col-xl-2 bg-primary sidebanner z-99">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3 py-md-5">
                    <h4 class="display-5 fw-bold text-white">My Priorities</h4>
                </div>
            </div>
            <div class="col-12 col-md-9 col-xl-10 bg-accent-bg-grey text-dark px-0">
                <div class="vh-md-100 overflow-y-auto overflow-x-hidden">
                    <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block" />
                    <section class="needs-home-wrapper bg-needs-home">
                        <div class="container needs-home-contents bg-hm-home-element">
                            <div class="row needs-home-avatar-wrapper justify-content-center h-100">
                                <div class="col-12 needs-home-avatars z-1 align-items-end">
                                    <div class="position-relative h-100 mh-100 z-1 d-flex justify-content-center align-items-end">
                                        <img src="{{ asset('images/needs/health-medical/home/health-medical-home-avatar.png') }}" class="mh-90 z-1 mw-100">
                                    </div>
                                </div>
                                <div class="col-12 needs-home-text z-1 align-items-end d-grid">
                                    <div class="col-md-10 col-xl-6 col-12 d-flex justify-content-center text-center m-auto z-1">
                                        <h4 class="py-3 f-family fw-700">Let's get you covered on the Health & Medical front.</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="col-12 show-mobile footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4 z-1 bg-white py-4">
                                    <a href="{{route('investment.gap')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <a href="{{route('health.medical.selection')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
                                </div>
                                <div class="col-12 position-absolute bottom-0 show-mobile">
                                    <div class="row">
                                        <div class="needs-stand-bg bg-btn_bar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 hide-mobile">
                        <div class="row">
                            <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg"></div>
                        </div>
                    </div>
                    <section class="footer bg-white py-4 fixed-bottom hide-mobile">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('investment.gap')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <a href="{{route('health.medical.selection')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
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