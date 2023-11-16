<?php
 /**
 * Template Name: Existing Assets Page
 */
?>

@extends('templates.master')

@section('title')
<title>Assets</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $assets = session('customer_details.assets');
@endphp

<div id="avatar_my_assets">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar-grey assets-overlay overflow-hidden px-0 order-md-1 order-sm-2 order-2">
                <div class="header"><div class="row">@include('templates.nav.nav-red-white-menu')</div></div>
                <section class="avatar-design-placeholder content position-relative imageContainerHouse"></section>
                <section class="footer-avatar-grey d-flex justify-content-center">
                    <div class="col-12 position-relative imageContainerCar"></div>
                    <img src="{{ asset($image) }}" width="auto" height="70%" alt="Avatar" class="changeImage position-absolute" style="bottom: 50px;">
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section z-index-1">
                <div class="scrollable-content">
                <form action="{{ route('handle.avatar.selection') }}" method="post" class="buttonForm">
                    @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-3 pb-2 px-sm-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-3 fw-bold">Right, let’s get an idea of your finances and loans.</h1>
                                        <p class="text-white display-6">Click to add your assets next to your avatar.</p>
                                    </div>
                                </div>
                                <div class="row mx-4 pb-4 mx-sm-5 slider">
                                    @if ($errors->has('assetsButtonInput'))
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('assetsButtonInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($assets['car']) && $assets['car'] === true) default @endif" data-avatar="car" data-required="" id="carButton">
                                                    <img src="{{ asset('images/avatar-my-assets/car-icon-02.png') }}" width="auto" height="100px" alt="Car">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Car</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($assets['scooter']) && $assets['scooter'] === true) default @endif" data-avatar="motorcycle" data-required="" id="scooterButton">
                                                    <img src="{{ asset('images/avatar-my-assets/motorcycle-icon.png') }}" width="auto" height="100px" alt="Motorcycle">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Motorcycle</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($assets['house']) && $assets['house'] === true) default @endif" data-avatar="house" data-required="" id="houseButton">
                                                    <img src="{{ asset('images/avatar-my-assets/house-icon.png') }}" width="auto" height="100px" alt="House">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">House</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($assets['bungalow']) && $assets['bungalow'] === true) default @endif" data-avatar="bungalow" data-required="" id="bungalowButton">
                                                    <img src="{{ asset('images/avatar-my-assets/bungalow-icon.png') }}" width="auto" height="100px" alt="Bungalow">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Bungalow</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($assets['condo']) && $assets['condo'] === true) default @endif" data-avatar="apartment" data-required="" id="condoButton">
                                                    <img src="{{ asset('images/avatar-my-assets/apartment-icon.png') }}" width="auto" height="100px" alt="Apartment">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Apartment</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($assets['others']) && $assets['others'] === true) default @endif" data-avatar="othersAssets" data-required="" data-bs-toggle="modal" data-bs-target="#otherAssets">
                                                    <img src="{{ asset('images/avatar-my-assets/others-icon.png') }}" width="auto" height="100px" alt="Others">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="assetsButtonInput" id="assetsButtonInput" value="{{ json_encode($assets) }}">
                                        <input type="hidden" name="urlInput" id="urlInput" value="top.priorities">
                                        <a href="{{route('avatar.family.dependant.details')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
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
                <input type="text" name="otherAssetsInput" class="form-control bg-white @error('otherAssetsInput') is-invalid @enderror" id="otherAssetsInput" placeholder="Add your asset" value="{{ old('otherAssetsInput', $assets['others_data'] ?? '') }}">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar btn-exit-assetsOthers" data-bs-dismiss="modal">Submit</button>
            </div>
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