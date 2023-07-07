@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')


<div id="education">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xl-2 col-md-3 col-12 bg-primary">
                @include('templates.nav.nav-needs')
            </div>
            <div class="col-lg-9 col-xl-10 col-md-9 col-12 font-color-default text-center overflow-y-scroll vh-100">
                <section class="row bg-needs h-100">
                    <div class="bg-primary" style="height:19px;"></div>
                    <!-- Progress bar menu -->
                    <!-- <div>
                        <div class="row justify-content-end align-items-center">
                            <div class="col-auto ">
                                <p class="display-6 text-dark d-inline-flex">Education</p>
                                <div class="progress color d-inline-flex mx-2">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">3</div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div style="height: fit-content;">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-md-10">
                                <img src="{{ asset('images/needs/education/education-home.png') }}" class="m-auto w-100 h-100">
                            </div>
                        </div>
                    </div>
                    <div style="height: fit-content;">
                        <div class="row d-flex justify-content-center bg-needs_text py-4">
                            <div class="col-12 col-md-4">
                                <h5 class="">Let's figure out what you need for Protection.</h5>
                            </div>
                        </div>
                    </div>
                    <div class="footer height-mobile" style="height: fit-content;">
                        <div class="row py-4 bg-btn_bar d-flex">
                            <div class="d-flex justify-content-end">
                                <a href="{{route('welcome')}}" class="btn btn-primary text-uppercase">back</a>
                                <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase mx-2">next</a>
                            </div>
                        </div>
                    </div>
                </section>  
            </div>
        </div>
    </div>
</div>

@endsection 