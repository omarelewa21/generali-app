@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education" style="max-height:100vh;height:100vh;">
            <section class="col-12 d-flex needs-master-nav">
                <div class="col-2 col-md-3 col-lg-3 sticky-top">
                    @include('templates.nav.nav-needs-red')
                </div>
                <div class="col-10 col-md-9 col-lg-9">
                    <div class="row d-flex justify-content-end align-items-center pt-3">
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
            <section class="col-12 d-flex justify-content-center py-2 text-center needs-master-title align-items-center">
                <h5 class="m-0">I'd like to provide coverage for my:</h5>
            </section>
            <section class="needs-master-content">
                <div class="col-12">
                    <div class="row overflow-auto d-flex justify-content-center h-100 position-relative">
                        <div class="col-12 col-md-6 col-xl-3 h-100 position-relative">
                            <!-- <div class="row d-flex m-auto"> -->
                            <div class="d-flex justify-content-center h-100">
                                <img src="{{ asset('images/avatar/button-gender-male.png') }}" class="h-90" style="z-index:9999;">
                                <p class="py-2 py-xxl-3 m-auto position-absolute bottom-0" style="z-index:9999;"><strong>Self</strong></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 h-100 position-relative">
                            <!-- <div class="row d-flex m-auto"> -->
                            <div class="d-flex justify-content-center h-100">
                                <img src="{{ asset('images/avatar/daughter.png') }}" class="h-90" style="z-index:9999;">
                                <p class="py-2 py-xxl-3 m-auto position-absolute bottom-0" style="z-index:9999;"><strong>Child</strong></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="needs-master-footer footer bg-white">
                <div class="bg-btn_bar py-4 px-2 sticky-bottom bg-white">
                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                        <a href="{{route('education.coverage')}}" class="btn btn-primary me-md-2 text-uppercase">Back</a>
                        <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Next</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection

<!-- @extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education" style="height:100vh;">
            <section class="col-12 d-flex">
                <div class="col-2 sticky-top">
                    @include('templates.nav.nav-needs-red')
                </div>
                <div class="col-7">
                </div>
                <div class="col-3">
                    <div class="row d-flex justify-content-end align-items-center pt-3">
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
            <section>
                <div class="col-12">
                    <div class="row overflow-auto">
                        
                    </div>
                </div>
            </section>
            <section class="needs-home-footer footer bg-needs_text py-4 fixed-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('education.coverage')}}" class="btn btn-primary me-md-2 text-uppercase">Back</a>
                            <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Next</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection -->
