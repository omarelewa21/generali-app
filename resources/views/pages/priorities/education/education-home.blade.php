@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education-home">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row needs-home-mobile">
            <div class="col-12 col-sm-3 col-xl-2 col-md-3 col-lg-3 bg-primary sticky-top needs-mobile-nav">
                @include('templates.nav.nav-needs-white')
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-12 col-md-8 mx-md-0 px-md-0 py-md-5 py-3 text-white">
                        <h4 class="display-5 font-bold fw-bold">My Priorities</h4>
                    </div>
                </div>
            </div>
            <div class="col d-flex p-0 flex-column bg-needs needs-mobile-content">
                <hr class="py-2 m-0 bg-primary opacity-100 border-0 needs-home-line"/>
                <section class="needs-home-nav">
                    <div class="col-12">
                        <div class="row d-flex justify-content-end align-items-center">
                            <div class="col-3 col-xs-3 col-sm-2 col-md-2 col-xl-1">
                                <div class="row d-flex">
                                    <p class="display-6 m-0">Education</p>
                                </div>
                            </div>
                            <div class="col-3 col-md-2 col-xl-1 py-2">
                                <div class="row d-flex">
                                    <div class="progress blue m-auto">
                                        <span class="progress-left">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <span class="progress-right">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <div class="progress-value">
                                            <span class="progress-text">3</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="education-wrapper overflow-hidden position-relative needs-home-content needs-height">
                    <div class="col-12 h-100 needs-row">
                        <img src="{{ asset('images/needs/education/education-home.png') }}" class="position-relative m-auto avatar-height" style="z-index:99999;">
                        <h5 class="d-flex justify-content-center text-center w-md-50 px-2 px-md-0 m-auto py-3 position-relative" style="z-index:99999;">Let's get into your plans for Education.</h5>
                    </div>
                    <div class="d-flex justify-content-center bg-needs_text pd-needs-home position-absolute w-100 bottom-0">
                        <div class="col-11 col-md-4 text-center">
                            
                        </div>
                    </div>
                </section>
                <section class="needs-home-footer footer bg-needs_text">
                    <div class="bg-btn_bar py-4 px-2 sticky-bottom">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('welcome')}}" class="btn btn-primary text-uppercase">Back</a>
                            <a href="{{route('education.coverage')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection 
 <!-- <section class="h-100 d-flex position-relative">
                    <div class="col-12 text-center bg-needs_text mt-auto">
                        <div class="row d-flex align-items-center justify-content-center">
                            <h4 class="display-5" style="padding-bottom:15px;padding-top:180px;">Let's get into your plans for Education.</h4>
                        </div>
                        <div class="position-absolute w-100 top-0">
                            <img class="m-auto"
                            src="{{ asset('images/needs/education/education-home.png') }}" alt="avatar-education">
                        </div>
                    </div>
                </section> -->
                <!-- <section class="main-vh row overflow-auto position-relative">
                    <div class="education-home d-flex flex-column align-items-center justify-content-center">
                        <img class="education-home-avatar position-absolute m-auto"
                            src="{{ asset('images/needs/education/education-home.png') }}" alt="avatar-education">
                    </div>
                    <div class="col-12 mt-auto">
                        <div class="d-flex align-items-center justify-content-center bg-needs_text">
                            <div class="col-lg-4 col-md-6">
                                <h4 class="display-5 text-dark text-center">Let's get into your plans for Education.</h4>
                            </div>
                        </div>
                    </div>
                </section>  -->


                <!-- <section class="position-relative h-100 content-main">
                    <div class="col-11 col-md-10 col-xl-7 m-auto">
                        <div class="row d-flex justify-content-center">
                            <img src="{{ asset('images/needs/education/education-home.png') }}" class="m-auto" style="z-index:9999;width:97%">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-needs_text pd-needs-home position-absolute w-100 bottom-0">
                        <div class="col-11 col-md-4 text-center">
                            <h5 class="">Let's get into your plans for Education.</h5>
                        </div>
                    </div>
                </section> -->
                <!-- <section class="education-home-content">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset('images/needs/education/education-home.png') }}" alt="Education Home">
                    </div>
                    <div class="d-flex justify-content-center align-items-center bg-needs_text">
                        <h5>Let's get into your plans for Education.</h5>
                    </div> -->
                    <!-- <div class="position-fixed bottom-0 right-0 col-12 col-sm-10 col-xl-10 col-md-9 col-lg-9"> -->
                <!-- <div class="mt-auto"> -->
                    <!-- <section class="position-relative"> -->
                    <!-- <section class=""> -->
                        <!-- <div class="position-absolute w-100 h-100 needs-top">
                            <div class="col-11 col-md-10 col-xl-7 m-auto">
                                <div class="row d-flex justify-content-center">
                                    <img src="{{ asset('images/needs/education/education-home.png') }}" class="m-auto w-100 h-100">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="d-flex justify-content-center bg-needs_text pd-needs-home">
                            <div class="col-11 col-md-4 font-color-default text-center">
                                <h5 class="">Let's get into your plans for Education.</h5>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="bg-btn_bar py-4 px-2 sticky-bottom">
                            <div class="col d-flex justify-content-end">
                                <a href="{{route('welcome')}}" class="btn btn-primary text-uppercase">Back</a>
                                <a href="{{route('education.coverage')}}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                            </div>
                        </div>
                    </section> -->
                <!-- </div>   -->
                 <!-- <section class="education-home-text bg-needs_text">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <h5>Let's get into your plans for Education.</h5>
                    </div>
                </section> -->