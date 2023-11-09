<?php
 /**
 * Template Name: Welcome Page
 */
?>

@extends('templates.master')

@section('title')
<title>Welcome</title>
@endsection

@section('content')

<div id="home" class="wrapper-home">
    <div class="header-home">@include('templates.nav.nav-red')</div>
    <section class="content-home">
        <div class="container px-5">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-md-12">
                    <div class="col-12">
                        <h1 class="text-uppercase text-primary">Welcome!</h1>
                        <h2 class="text-uppercase text-primary">Your Future Awaits.</h2>
                        <p class="py-4">We’re glad you’re looking to secure your future with us.<br>
                            Let’s begin by getting to know you
                            better.</p>
                        <a href="{{ route('pdpa.disclosure') }}" class="btn btn-primary">START YOUR JOURNEY</a>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-md-12 d-flex justify-content-center pt-xl-0 pt-sm-5 pt-5">
                    <img src="{{ asset('images/welcome-page/welcome-avatar.png') }}" alt="Footer Vector" class="homeVector">
                </div>
            </div>
        </div>
    </section>
    <section class="footer footer-home position-absolute bottom-0 start-0">
        <img src="{{ asset('images/welcome-page/home-vector.png') }}" width="30%" alt="Footer Vector" class="footerVector">
    </section>
</div>

@endsection