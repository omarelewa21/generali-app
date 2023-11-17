<?php
 /**
 * Template Name: Financial Statement - Monthly Goals Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Monthly Goals</title>
@endsection

@section('content')

<div id="monthly_goals" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
            <section class="content d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 d-flex justify-content-end">
                            <div class="col-xxl-6">
                                <h2 class="display-5 fw-bold text-end lh-base">I’m willing to set aside</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Just keep this empty -->
                        </div>
                        <div class="col-md-4 d-flex justify-content-start">
                            <div class="col-xxl-7">
                                <h2 class="display-5 fw-bold text-start lh-base">per month to fulfill my goals.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer footer-avatar-grey">
                <div class="container">
                    <div class="row justify-content-center position-relative">
                        <div class="col-md-4 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                            <img src="{{ asset('images/summary/bank-container.png') }}" width="100%" alt="Monthly Goals">
                            <div class="col-12 position-absolute px-5">
                                <p class="display-3 currencyField"><span class="text-black fw-bold border-bottom border-dark border-3">RM<input type="number" name="existing_policy_monthly_support" class="form-control position-relative border-0 d-inline-block w-50 fw-bold text-primary @error('existing_policy_monthly_support') is-invalid @enderror" id="existing_policy_monthly_support" value="" required></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white py-4 fixed-bottom footer-scroll">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a href="{{route('existing.policy')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                <a href="{{route('summary.expected-income')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Next</a>
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