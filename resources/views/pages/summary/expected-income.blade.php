<?php
 /**
 * Template Name: Financial Statement - Expected Income Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Expected Income</title>
@endsection

@section('content')

<div id="expected_income" class="overflow-hidden secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-avatar">
            <div class="header-avatar col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
            <section class="top-avatar">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-6 col-xl-6 pb-5">
                            <h2 class="display-5 fw-bold lh-base text-center">To be perfectly honest, I am expecting my income to change.</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="http://127.0.0.1:8000/gender" class="btn btn-primary text-uppercase btn-lg" style="z-index:1">Yes</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Just keep this empty -->
                        </div>
                        <div class="col-md-4">
                            <div class="col-12 d-flex justify-content-start">
                                <a href="http://127.0.0.1:8000/gender" class="btn btn-primary text-uppercase btn-lg" style="z-index:1">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bottom-avatar">
                <div class="col-md-12 d-flex justify-content-center">
                    <img src="{{ asset('images/summary/avatar-open-hands.png') }}" height="100%" width="auto" alt="Expected Income">
                </div>
            </section>
            <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                            <a href="{{route('pages.summary.monthly-goals')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection