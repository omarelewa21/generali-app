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

@include('templates.nav.nav-red-menu')

<div id="avatar_welcome">
    <section class="main-content position-relative">
        <div class="container px-5">
            <div class="row d-flex text-center justify-content-center">
                <div class="col-6">
                    <h1 class="display-3 headline1 text-uppercase text-dark pb-5">Now, shall we build your signature look?</h1>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="{{ route('avatar.gender.selection') }}" class="btn btn-primary text-uppercase">Create</a>
                        <a href="{{ route('welcome') }}" class="btn but-skip btn-outline-primary text-uppercase">Skip</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="footer">
        <div class="position-absolute male">
            <img src="{{ asset('images/avatar/main-male.png') }}" width="300px" alt="Male Avatar">
        </div>
        <div class="position-absolute female">
            <img src="{{ asset('images/avatar/main-female.png') }}" width="300px" alt="Female Avatar">
        </div>
    </section>
</div>
@endsection