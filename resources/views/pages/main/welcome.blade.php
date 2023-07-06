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

@include('templates.nav.nav-red')

<div id="home" class="vh-100">
    <section class="main-content position-relative">
        <div class="container px-5">
            <div class="row">
                <div class="col-xxl-6">
                    <h1 class="text-uppercase text-dark">Welcome!</h1>
                    <h2 class="text-uppercase text-dark">Your Future Awaits.</h2>
                    <p class="text-dark py-4">We’re glad you’re looking to secure your future with us.<br>
                        Let’s begin by getting to know you
                        better.</p>
                    <a href="{{ route('pdpa.disclosure') }}" class="btn btn-primary">START YOUR JOURNEY</a>
                </div>
            </div>
        </div>
    </section>
    <section class="footer position-absolute bottom-0 start-0">
        <img src="{{ asset('images/welcome-page/home-vector.png') }}" width="30%" alt="Footer Vector">
        <div class="position-absolute bottom-0 end-0 d-none d-xs-none d-sm-none d-md-none d-lg-block">
            <img src="{{ asset('images/welcome-page/welcome-avatar.png') }}" style="width: calc(100vh - 60px);" alt="Footer Vector">
        </div>
    </section>
</div>
@endsection