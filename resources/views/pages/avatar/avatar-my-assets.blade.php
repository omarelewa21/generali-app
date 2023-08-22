<?php
 /**
 * Template Name: Existing Assets Page
 */
?>

@extends('templates.master')

@section('title')
<title>My Assets</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $assets = isset($arrayData['assets']) ? $arrayData['assets'] : '';
    $dataUrl = isset($arrayData['dataUrl']) ? $arrayData['dataUrl'] : '';
@endphp

<div id="avatar_my_assets" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default assets-overlay overflow-hidden px-0">
                <section class="avatar-design-placeholder content-avatar-default position-relative imageContainerHouse"></section>
                <section class="footer-avatar-default d-flex justify-content-center">
                    <div class="col-12 position-relative imageContainerCar"></div>
                    <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="50%" alt="" class="position-absolute" style="bottom: 50px;">
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white pb-3 fw-bold">Right, let’s get an idea of your finances and loans.</h1>
                                    <p class="text-white display-6 lh-base">Click to add your assets next to your avatar.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'car' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0" data-avatar="car" data-required="" id="carButton">
                                                <img src="{{ asset('images/avatar-my-assets/car-icon-02.png') }}" width="auto" height="100px" alt="Car">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Car</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'motorcycle' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0" data-avatar="motorcycle" data-required="" id="scooterButton">
                                                <img src="{{ asset('images/avatar-my-assets/motorcycle-icon.png') }}" width="auto" height="100px" alt="Motorcycle">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Motorcycle</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'house' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0" data-avatar="house" data-required="" id="houseButton">
                                                <img src="{{ asset('images/avatar-my-assets/house-icon.png') }}" width="auto" height="100px" alt="House">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">House</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'bungalow' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0" data-avatar="bungalow" data-required="">
                                                <img src="{{ asset('images/avatar-my-assets/bungalow-icon.png') }}" width="auto" height="100px" alt="Bungalow">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Bungalow</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'apartment' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0" data-avatar="apartment" data-required="">
                                                <img src="{{ asset('images/avatar-my-assets/apartment-icon.png') }}" width="auto" height="100px" alt="Apartment">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Apartment</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'others' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0" data-avatar="others" data-required="">
                                                <img src="{{ asset('images/avatar-my-assets/others-icon.png') }}" width="auto" height="100px" alt="Others">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('avatar.family.dependant.details')}}" class="btn btn-primary flex-fill text-uppercase me-md-2">Back</a>
                                    <a href="{{route('top.priorities') }}" class="btn btn-primary flex-fill text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection