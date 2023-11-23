<?php
 /**
 * Template Name: Investment Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Investment - Home</title>

@section('content')

<div id="investment_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3">
                    <h2 class="display-5 fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey px-0">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block">
                <div class="wrapper-needs-grey main-default-bg">
                    <section class="header"></section>
                    <section class="content-needs">
                        <div class="col-12 d-flex justify-content-center align-items-center position-relative">
                            <img src="{{ asset('images/needs/investment/home/avatar.png') }}" height="100%" width="auto" class="position-absolute" style="bottom:-55px" alt="Protection Home">
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row justify-content-center align-items-center" style="height:70%">
                                <div class="col-xxl-5 col-xl-6 col-lg-7 col-9 text-center">
                                    <h2 class="display-5 fw-bold py-4">Now let's plan for your lump sum investments.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('savings.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                        <a href="{{route('investment.coverage')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
                                    </div>
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