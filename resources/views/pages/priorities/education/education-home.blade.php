@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')


<div class="container-fluid overflow-hidden">
    <div class="row vh-100">
        <div class="col-12 col-sm-2 col-xl-2 col-md-3 col-lg-3 bg-primary sticky-top">
            @include('templates.nav.nav-needs-white')
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-8 mx-md-0 px-md-0 py-md-5 py-3 text-white">
                    <h4 class="display-5 font-bold fw-bold">My Priorities</h4>
                </div>
            </div>
        </div>
        <div class="col d-flex p-0 flex-column h-sm-100 bg-needs">
            <hr class="py-2 m-0 bg-primary opacity-100" style="order:-1;"/>
            <section>
                <div class="row justify-content-end align-items-center">
                    <div class="col-auto ">
                        <p class="display-6 text-dark d-inline-flex p-4">Education</p>
                        <!-- <div class="progress color d-inline-flex mx-2">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">3</div>
                        </div> -->
                    </div>
                </div>
            </section>
            <section class="position-relative h-100">
                <!-- <div class="w-100 h-100"> -->
                    <div class="col-11 col-md-10 col-xl-7 m-auto">
                        <div class="row d-flex justify-content-center">
                            <img src="{{ asset('images/needs/education/education-home.png') }}" class="m-auto" style="z-index:9999;width:97%">
                        </div>
                    </div>
                <!-- </div> -->
                <div class="d-flex justify-content-center bg-needs_text pd-needs-home position-absolute w-100 bottom-0">
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
                </section>
            <div class="position-fixed bottom-0 right-0 col-12 col-sm-10 col-xl-10 col-md-9 col-lg-9">
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
            </div>  
        </div>
    </div>
</div>

@endsection 