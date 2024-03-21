<?php
 /**
 * Template Name: Gender Selection Page
 */
?>

@extends('templates.master')

@section('title')
<title>Gender Selection</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $gender = session('customer_details.avatar.gender', 'Male');
    $skintone = session('customer_details.avatar.skin_tone', 'white');
    $image = session('customer_details.avatar.image', '/images/avatar-general/gender-male.json');
    $fullName = session('customer_details.basic_details.full_name');
    $transactionId ??= request()->input('transaction_id');
@endphp

<div id="avatar_gender_selection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar px-0 order-md-1 order-sm-2 order-2">
                <div class="header"><div class="row">@include('templates.nav.nav-red-white-menu')</div></div>
                <section class="avatar-color-palatte d-flex justify-content-center top-avatar">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="pb-3 display-6 fw-bold">Pick the skin colour that’s closest to yours.</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mx-2">
                            <div class="blocks col-12 color-box-wrapper d-flex justify-content-center align-items-center justify-content-center">
                                <a href="#" class="skin-tone block" style="--bg: var(--gradient-1);" data-color="white">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="skin-tone block" style="--bg: var(--gradient-2);" data-color="asianfair">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="skin-tone block" style="--bg: var(--gradient-3);" data-color="asiandark">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="skin-tone block" style="--bg: var(--gradient-4);" data-color="brown">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="skin-tone block" style="--bg: var(--gradient-5);" data-color="mixed">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="skin-tone block" style="--bg: var(--gradient-6);" data-color="black">
                                    <div class="block__item"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="avatar-design-placeholder bottom-avatar position-relative">
                    <div class="col-12 text-center d-flex justify-content-center">
                        {{-- <img src="{{ asset($image) }}" width="auto" height="100%" alt="Avatar" class="changeImage pb-2" id="avatar-clothes"> --}}
                        <div id="lottie-animation"></div>
                    </div>
                </section>
            </div>
            
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section">
                <div class="scrollable-content">
                    <form novalidate action="{{route('change.image',['transaction_id' => $transactionId])}}" method="POST" id="gender_selection">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-3 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        @if(isset($fullName))
                                            <h1 class="display-4 text-white font-normal pb-md-3 fw-bold text-center text-md-start">Nice to meet you, {{ $fullName }}</h1>
                                        @else 
                                            <h1 class="display-4 text-white font-normal pb-md-3 fw-bold text-center text-md-start">Nice to meet you.</h1>
                                        @endif
                                        <p class="text-white display-6 text-center text-md-start">Please click to select your gender.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-5 px-md-5">
                                    @if ($errors->has('genderSelection'))
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('genderSelection') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-6 col-lg-6 col-md-12 text-dark fade-effect py-2 px-2">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 gender-button @if($gender === 'Male') default @endif" data-avatar="Male" data-required="" value="male" id="gendermale">
                                                    <img src="{{ asset('images/gender-selection/button-gender-male.png') }}" width="140" alt="Gender Male">
                                                    <p class="avatar-text text-center text-dark pt-4 mb-0 fw-bold">Male</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-6 col-md-12 text-dark fade-effect py-2 px-2">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 gender-button @if($gender === 'Female') default @endif" data-avatar="Female" data-required="" value="female" id="genderfemale">
                                                    <img src="{{ asset('images/gender-selection/button-gender-female.png') }}" width="140" alt="Gender Female">
                                                    <p class="avatar-text text-center text-dark pt-4 mb-0 fw-bold">Female</p>
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
                                        <input type="hidden" name="genderImage" id="genderImage" value="{{$image}}">
                                        <input type="hidden" name="genderSelection" id="genderSelection" value="{{$gender}}">
                                        <input type="hidden" name="skinSelection" id="skinSelection" value="{{$skintone}}">
                                        <a href="{{route('avatar.welcome',['transaction_id' => $transactionId])}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                                        <button class="btn btn-primary text-uppercase flex-fill" id="nextBtn" type="submit">Next</button>
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
</script>
@endsection