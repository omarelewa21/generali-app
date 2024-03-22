<?php
 /**
 * Template Name: Marital Status Page
 */
?>

@extends('templates.master')

@section('title')
<title>Marital Status</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $maritalStatus = session('customer_details.identity_details.marital_status');
    $transactionId = session('transaction_id') ?? ($_GET['transaction_id'] ?? null);
@endphp

<div id="avatar_marital_status">
    <div class="container-fluid">
        <div class="row parallax-section">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar-default order-md-1 order-sm-2 order-2 px-0 parallax-inner parallax-bottom">
                <div class="header"><div class="row">@include('templates.nav.nav-red-white-menu')</div></div>
                <section class="avatar-design-placeholder content-avatar-default overflow-hidden">
                    <div class="col-12 position-relative text-center d-flex justify-content-center">
                        <div id="lottie-animation"></div>
                        <div class="imageContainerMarried"></div>
                    </div>
                </section>
                <div class="bottomObeserver"></div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section parallax-inner parallax-top">
                <div class="scrollable-content">
                    <form action="{{ route('handle.avatar.selection',['transaction_id'=> $transactionId]) }}" method="post" class="buttonForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-3 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-md-3 fw-bold">May we know your relationship status?</h1>
                                        <p class="text-white display-6">Click to select your marital status.</p>
                                    </div>
                                </div>
                                <div class="row px-4 px-md-5">
                                    @if ($errors->has('maritalStatusButtonInput'))
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('maritalStatusButtonInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row px-4 px-md-5 pb-md-5 action_button_slider">
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($maritalStatus === 'Single') default @endif" data-avatar="Single" data-required="" id="singleButton">
                                                    <img src="{{ asset('images/marital-status/single-icon.webp') }}" width="100%" alt="Single" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Single</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($maritalStatus === 'Married') default @endif" data-avatar="Married" data-required="" id="marriedButton">
                                                    <img src="{{ asset('images/marital-status/married-icon.webp') }}" width="100%" alt="Married" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Married</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($maritalStatus === 'Divorced') default @endif" data-avatar="Divorced" data-required="" id="divorcedButton">
                                                    <img src="{{ asset('images/marital-status/divorced-icon.webp') }}" width="100%" alt="Divorced" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Divorced</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 @if($maritalStatus === 'Widowed') default @endif" data-avatar="Widowed" data-required="" id="widowedButton">
                                                    <img src="{{ asset('images/marital-status/widowed-icon.webp') }}" width="100%" alt="Widowed" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Widowed</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center px-5 pb-md-5 mt-3 mx-auto mb-3 d-none w-75">
                                    <button type="button" class="slick-btns me-3 slick-prev">Prev</button>
                                    <div class="slick-scrollbar"></div>
                                    <button type="button" class="slick-btns ms-3 slick-next">Next</button>
                                </div>
                            </div>
                        </section>

                        <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="maritalStatusButtonInput" id="maritalStatusButtonInput" value="{{$maritalStatus}}">
                                        <input type="hidden" name="urlInput" id="urlInput" value="family.dependent">
                                        <a href="{{route('identity.details')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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

<script>
    var gender_session = {!! json_encode(session('customer_details.avatar.gender')) !!};
    var avatar_session = {!! json_encode(session('customer_details.avatar.image')) !!};
</script>
@endsection