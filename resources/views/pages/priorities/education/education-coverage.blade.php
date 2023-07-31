@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education vh-100">
            <section class="col-12 d-flex needs-coverage-nav">
                <!-- <div class="row"> -->
                    <div class="col-6">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-6">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                <!-- </div> -->
                
            </section>
            <section class="col-12 d-flex justify-content-center py-2 text-center needs-coverage-title align-items-center">
                <h5 class="m-0">I'd like to provide coverage for my:</h5>
            </section>
            <section class="needs-coverage-content hide">
                <div class="col-12">
                    <div class="row overflow-auto d-flex justify-content-center h-100 position-relative">
                        <div class="col-12 col-md-6 col-xl-3 h-100 position-relative p-0">
                            <!-- <div class="row d-flex m-auto"> -->
                            <div class="d-flex justify-content-center h-100 position-relative">
                                <button class="border-0 bg-transparent choice z-99" id="Self">
                                    <img src="{{ asset('images/avatar-gender-selection/button-gender-male.png') }}" class="h-90">
                                    <p class="my-1"><strong>Self</strong></p>
                                </button>
                                <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                    <div class="col-11 col-md-4 text-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 h-100 position-relative">
                            <!-- <div class="row d-flex m-auto"> -->
                            <div class="d-flex justify-content-center h-100">
                                <button class="border-0 bg-transparent choice z-99" id="Child">
                                <!-- <button class="border-0 bg-transparent choice z-99" id="<?php //$education_coverage_option; ?>"> -->
                                    <img src="{{ asset('images/avatar/daughter.png') }}" class="h-90">
                                    <p class="my-1"><strong>Child</strong></p>
                                    <!-- <p class="py-2 py-xxl-3 m-auto position-absolute bottom-0"><strong>Child</strong></p> -->
                                </button>
                                <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                    <div class="col-11 col-md-4 text-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile">
                            <div class="col-11 col-md-4 text-center">
                                
                            </div>
                        </div>
                        <div class="col-12 show-mobile bg-btn_bar">
                            <div class="py-4 px-2">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">Back</a>
                                    <a href="{{route('education.supporting.years')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="needs-master-footer footer bg-btn_bar p-0 hide-mobile">
                <div class="py-4 px-2">
                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                        <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">Back</a>
                        <a href="{{route('education.supporting.years')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection