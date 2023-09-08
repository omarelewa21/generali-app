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
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-design-placeholder content-avatar-default position-relative imageContainerHouse"></section>
                <section class="footer-avatar-default d-flex justify-content-center">
                    <div class="col-12 position-relative">
                        <img src="{{ asset('/images/avatar-my-assets/car-vector.png') }}" width="auto" height="100%" alt="" class="position-absolute" style="bottom:150px;right:-200px">
                        <img src="{{ asset('/images/avatar-my-assets/scooter-vector.png') }}" width="auto" height="100%" alt="" class="position-absolute" style="bottom:150px;left:0">
                    </div>
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
                                    <p class="text-white display-6">Click to add your assets next to your avatar.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'car' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                            <button class="border-0" data-avatar="car" data-required="" id="carButton">
                                                <img src="{{ asset('images/avatar-my-assets/car-icon-02.png') }}" width="auto" height="100px" alt="Car">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Car</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'motorcycle' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                            <button class="border-0" data-avatar="motorcycle" data-required="" id="scooterButton">
                                                <img src="{{ asset('images/avatar-my-assets/motorcycle-icon.png') }}" width="auto" height="100px" alt="Motorcycle">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Motorcycle</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'house' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                            <button class="border-0" data-avatar="house" data-required="" id="houseButton">
                                                <img src="{{ asset('images/avatar-my-assets/house-icon.png') }}" width="auto" height="100px" alt="House">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">House</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'bungalow' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                            <button class="border-0" data-avatar="bungalow" data-required="" id="bungalowButton">
                                                <img src="{{ asset('images/avatar-my-assets/bungalow-icon.png') }}" width="auto" height="100px" alt="Bungalow">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Bungalow</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'apartment' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                            <button class="border-0" data-avatar="apartment" data-required="" id="condoButton">
                                                <img src="{{ asset('images/avatar-my-assets/apartment-icon.png') }}" width="auto" height="100px" alt="Apartment">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Apartment</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg {{$assets === 'others' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                            <button class="border-0" data-avatar="others" data-required="" data-bs-toggle="modal" data-bs-target="#otherAssets">
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

<!-- Modal -->
<div class="modal fade" id="otherAssets" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="otherAssetsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end px-3 py-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header px-5 pt-2 pb-0">
                <h3 class="modal-title text-center text-uppercase otherModalText" id="otherAssetsLabel">I Have</h3>
            </div>
            <div class="modal-body text-white text-center px-5 pt-5 bg-primary">
                <input type="text" name="otherAssetsInput" class="form-control bg-white @error('otherAssetsInput') is-invalid @enderror" id="otherAssetsInput" placeholder="Add your asset" value="{{ old('otherAssetsInput', $arrayData['otherAssetsInput'] ?? '') }}">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection