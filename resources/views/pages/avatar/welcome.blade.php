<?php
 /**
 * Template Name: Avatar Welcome Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Build Your Signature Look</title>
@endsection

@section('content')

@php
    // Retrieving values from the previous page
    $transactionId ??= session('transaction_id');
@endphp

<div id="avatar_welcome">
    <div class="container-fluid">
        <div class="row wrapper">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
            <section class="content">
                <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <h1 class="display-3 text-uppercase text-dark">Now, shall we build your signature look?</h1>
                            <div class="d-grid gap-2 col-6 mx-auto pt-4">
                                <a href="{{ route('avatar') }}" class="btn btn-primary text-uppercase">Create</a>
                                <a href="{{ route('identity.details') }}" class="btn but-skip btn-outline-primary text-uppercase">Skip</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer-main">
                <div class="d-flex justify-content-center align-items-center">
                    <!-- <img src="{{ asset('images/avatar-welcome/main-male.png') }}" width="auto" height="100%" alt="Male Avatar"> -->
                    <div id="lottie-male-animation" class="homeVector" style="width:auto; height:100%"></div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <!-- <img src="{{ asset('images/avatar-welcome/main-female.png') }}" width="auto" height="100%" alt="Female Avatar"> -->
                    <div id="lottie-female-animation" class="homeVector" style="width:auto; height:100%"></div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    // Load the animation using Lottie
    const animationMale = lottie.loadAnimation({
        container: document.getElementById('lottie-male-animation'),
        renderer: 'svg', 
        loop: true,
        autoplay: true,
        path: '{{ asset('images/avatar-welcome/male-avatar.json') }}'
    });

    const animationFemale = lottie.loadAnimation({
        container: document.getElementById('lottie-female-animation'),
        renderer: 'svg', 
        loop: true,
        autoplay: true,
        path: '{{ asset('images/avatar-welcome/female-avatar.json') }}'
    });
</script>
@endsection