<?php
 /**
 * Template Name: Financial Statement - Overview Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Overview</title>
@endsection

@section('content')

<div id="overview">
    <div class="container-fluid">
        <div class="row wrapper-overview">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 pb-5">
                            <h2 class="display-5 fw-bold lh-base">Summary Overview</h2>
                        </div>
                    </div>
                    <div class="row chart">
                        <div class="col-md-6 pb-5">
                            <img src="{{ asset('images/summary/pie.png') }}" width="60%" alt="Widowed">
                        </div>
                        <div class="col-md-6 pb-5">
                            <img src="{{ asset('images/summary/percentage.png') }}" width="60%" alt="Widowed">
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                            <a href="{{route('summary.monthly-goals')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                            <a href="{{route('summary.increment-amount')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Next</a>
                            <!-- <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection