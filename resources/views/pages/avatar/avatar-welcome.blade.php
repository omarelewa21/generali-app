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

<div id="avatar_welcome" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row wrapper">
            <div class="header">@include('templates.nav.nav-red-menu')</div>
            <section class="content position-relative d-flex justify-content-center align-items-center h-100">
                <div class="container px-5">
                    <div class="row d-flex text-center justify-content-center">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 py-4">
                            <h1 class="display-3 headline1 text-uppercase text-dark pb-5">Now, shall we build your signature look?</h1>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="{{ route('avatar.gender.selection') }}" class="btn btn-primary text-uppercase">Create</a>
                                <a href="{{ route('identity.details') }}" class="btn but-skip btn-outline-primary text-uppercase">Skip</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer-main">
                <div class="d-flex justify-content-center align-items-center" style="grid-column: span 1 / auto;">
                    <img src="{{ asset('images/avatar-welcome/main-male.png') }}" width="auto" height="100%" alt="Male Avatar">
                </div>
                <div class="d-flex justify-content-center align-items-center" style="grid-column: span 1 / auto;">
                    <img src="{{ asset('images/avatar-welcome/main-female.png') }}" width="auto" height="100%" alt="Female Avatar">
                </div>
            </section>
        </div>
    </div>
</div>

@endsection