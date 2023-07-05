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

<div id="home">
    <section class="main-content position-relative">
        <div class="container px-5">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-uppercase text-dark">Welcome!</h1>
                    <h2 class="text-uppercase text-dark">Your Future Awaits.</h2>
                    <p class="text-dark py-4">We’re glad you’re looking to secure your future with us.<br>
                        Let’s begin by getting to know you
                        better.</p>
                    <a href="{{ route('pdpa.disclosure') }}" class="btn btn-primary py-3">START YOUR JOURNEY</a>
                </div>
            </div>
        </div>
    </section>
    <section class="footer position-absolute bottom-0 start-0">
        <img src="{{ asset('images/welcome-page/home-vector.png') }}" width="30%" alt="Footer Vector">
    </section>
</div>
@endsection