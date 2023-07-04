@extends('templates.master')

@section('title')

<title>Protection - Home</title>
@section('content')

<div class="container-fluid overflow-hidden">
    <div class="row vh-100">
        <div class="col-12 col-sm-2 col-xl-2 px-sm-2 px-0 bg-primary sticky-top">
            @include('templates.nav.nav-white-menu')
            <div class="nav-header text-white mx-4">
                <h4 class="display-5 font-bold fw-bold px-4 mt-4 text-center text-lg-start">My Priorities</h4>
            </div>
        </div>
        <div class="col d-flex p-0 flex-column h-sm-100">
            <hr class="py-2 m-0 bg-primary opacity-100" />
            <section>
                <div class="row justify-content-end align-items-center bg-accent-bg-grey">
                    <div class="col-auto ">
                        <p class="display-6 text-dark d-inline-flex">Protection</p>
                        <div class="progress color d-inline-flex mx-2">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">1</div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-vh row overflow-auto bg-accent-bg-grey">
                <div class="protection-home d-flex flex-column align-items-center justify-content-center"
                    style="background-image: url('{{ asset('images/needs/protection/bg-home.png') }}');">
                    <img class="protection-home-avatar position-absolute"
                        src="{{ asset('images/needs/protection/home-protection-avatar.png') }}" alt="avatar-protection">
                </div>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-6">
                <h4 class="display-5 text-dark text-center">Let’s figure out what you need for Protection.</h4>
                    </div>
                </div>
            </section>
            <section>
                <div class="row bg-white py-4 px-2 sticky-bottom">
                    <div class="col d-flex justify-content-end">
                        <a href="{{route('pdpa.disclosure')}}" class="btn btn-primary text-uppercase">Back</a>
                        <a href="{{route('avatar.welcome') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection