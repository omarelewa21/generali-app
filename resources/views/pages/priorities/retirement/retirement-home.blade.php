<?php
 /**
 * Template Name: Protection Homepage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Retirement - Home</title>
@endsection

@section('content')

<div id="basic_details" class="vh-100">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-5 py-xxl-5 py-xl-5 py-lg-5 py-md-5 py-sm-3 py-3">
                    <h4 class="display-5 font-bold fw-bold">My Priorities</h4>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 text-dark px-0 retirement-bg">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0" />
                <div class="vh-100 overflow-y-auto overflow-x-hidden">

                @include ('templates.nav.nav-sidebar-needs')

                    <section class="main-content scrollable-padding">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                {{-- <img src="{{ asset('images/needs/protection/protection-home-avatar.png') }}"
                                    style="width:350px" alt="Protection"> --}}
                            </div>
                            <div
                                class="row pt-4 px-5 pb-3 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-4 bg-accent-bg-grey text-center">
                                <div class="col-12">
                                    <h4>Now let's talk about your plans for Retirement.</h1>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('pdpa.disclosure')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('avatar.welcome') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
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
                        style="background-image: url('{{ asset('images/needs/retirement/bg-home.png') }}');">
                        <img class="protection-home-avatar position-absolute"
                            src="{{ asset('images/needs/protection/home-protection-avatar.png') }}"
                            alt="avatar-protection">
                    </div>
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <h4 class="display-5 text-dark text-center">Let’s figure out what you need for Protection.
                            </h4>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row bg-white py-4 px-2 sticky-bottom">
                        <div class="col d-flex justify-content-end">
                            <a href="{{route('retirement.home')}}" class="btn btn-primary text-uppercase">Back</a>
                            <a href="{{route('retirement.home') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection