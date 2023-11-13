<?php
 /**
 * Template Name: Financial Statement - Increment Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Increment</title>
@endsection

@section('content')

<div id="increment" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu')</div></div>
            <section class="content d-flex justify-content-center align-items-md-center">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6">
                            <!-- Just keep this empty -->
                        </div>
                        <div class="col-md-6 d-flex justify-content-md-start justify-content-sm-center">
                            <div class="col-xxl-7 col-xl-8 text-md-start text-sm-center text-center">
                                <h2 class="display-5 fw-bold lh-base">I am expecting my income to increase by</h2>
                                <p class="display-5 fw-bold currencyField"><span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="number" name="existing_policy_monthly_support" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('existing_policy_monthly_support') is-invalid @enderror" id="existing_policy_monthly_support" value="" required></span>/ month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer footer-avatar-grey">
                <div class="container">
                    <div class="row position-relative">
                        <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                            <img src="{{ asset('images/summary/vector.png') }}" width="auto" height="500px" alt="Increment" class="mobileImg">
                        </div>
                    </div>
                </div>
                <div class="bg-white py-4 fixed-bottom footer-scroll">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a href="{{route('summary.expected-income')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                <a href="{{route('summary')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Next</a>
                                <!-- <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection