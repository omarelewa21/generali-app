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

<div id="retirement_home" class="vh-100">

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
                <div class="vh-100 overflow-auto">
                    @include ('templates.nav.nav-sidebar-needs')
                    <section class="main-content scrollable-padding">
                        <div class="container-fluid">
                            <div id="retirement-character" class="row d-flex justify-content-center position-relative">
                                <img src="{{ asset('images/needs/retirement/retirement-character.svg') }}"
                                    style="width:350px" alt="Retirement Character">
                                    {{-- <div id="bm"> </div> --}}
                            </div>
                            <div class="row bg-accent-bg-grey text-center justify-content-center position-relative">
                                <div class="col-auto py-lg-5 py-md-0">
                                </div>
                            </div>
                            <div class="row bg-accent-bg-grey text-center justify-content-center position-relative">
                                <div class="col-6 py-4">
                                    <h4 class="display-5 img-fluid">Now let's talk about your plans for Retirement.</h1>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.home')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('retirement.home') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
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