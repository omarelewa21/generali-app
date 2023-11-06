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
                                <a href="{{ route('avatar.gender.selection') }}" class="btn btn-primary text-uppercase">Create</a>
                                <a href="{{ route('identity.details') }}" class="btn but-skip btn-outline-primary text-uppercase">Skip</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer-main">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/avatar-welcome/main-male.png') }}" width="auto" height="100%" alt="Male Avatar">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/avatar-welcome/main-female.png') }}" width="auto" height="100%" alt="Female Avatar">
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    var basic_details = {!! json_encode(session('customer_details.basic_details')) !!};
    var avatar = {!! json_encode(session('customer_details.avatar')) !!};
    var identity_details = {!! json_encode(session('customer_details.identity_details')) !!};
    var family_details = {!! json_encode(session('customer_details.family_details.dependant')) !!};
</script>
@endsection