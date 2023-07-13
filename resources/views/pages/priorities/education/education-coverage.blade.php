@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default bg-education" style="max-height:100vh;">
        <div class="row">
            <section class="col-12 d-flex">
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
            <section class="col-12 d-flex justify-content-center py-2 text-center">
                <h5>I'd like to provide coverage for my:</h5>
            </section>
            <section>
                <div class="col-12">
                    <div class="row overflow-auto">
                        <section class="col-12">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-md-3">
                                    <div class="row d-flex m-auto">
                                        <img src="{{ asset('images/avatar/button-gender-male.png') }}">
                                        <p class="py-2"><strong>Self</strong></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="row d-flex m-auto">
                                        <img src="{{ asset('images/avatar/daughter.png') }}">
                                        <p class="py-2"><strong>Child</strong></p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            <section class="footer bg-needs_text py-4 fixed-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('education.home')}}" class="btn btn-primary me-md-2 text-uppercase">Back</a>
                            <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Next</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
 <!-- <section>
                            <div class="col-12">
                                <div class="row d-flex justify-content-center">
                                    <div class="d-grid">
                                        <div class="row d-flex m-auto">
                                                <img src="{{ asset('images/avatar/button-gender-male.png') }}">
                                                <p class="py-2"><strong>Self</strong></p>
                                            </div> -->
                                <!-- <div class="row d-flex justify-content-center py-2 text-center">
                                    
                                        <div class="col-12 col-md-3">
                                            <div class="row d-flex m-auto">
                                                <img src="{{ asset('images/avatar/button-gender-male.png') }}">
                                                <p class="py-2"><strong>Self</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="row d-flex m-auto">
                                                <img src="{{ asset('images/avatar/daughter.png') }}">
                                                <p class="py-2"><strong>Child</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </div>
                            </div>
                        </section> -->
                        <!-- <section class="footer bg-needs_text py-4">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('education.home')}}" class="btn btn-primary me-md-2 text-uppercase">Back</a>
                                    <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </section> -->

<!-- <div class="footer height-mobile" style="height: fit-content;">
    <div class="row py-4 bg-btn_bar d-flex">
        <div class="d-flex justify-content-end">
            <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">back</a>
            <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase mx-2">next</a>
        </div>
    </div>
</div> -->