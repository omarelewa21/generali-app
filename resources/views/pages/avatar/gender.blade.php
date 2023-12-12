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
    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $firstName = session('customer_details.basic_details.first_name');
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
                        <div class="row d-flex justify-content-center">
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
                    <button type="button" class="btn btn-outline-primary slide-button left-center position-absolute" id="avatar-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="24" viewBox="0 0 29 24" fill="none">
                            <path d="M11.9036 0.370117C11.9036 0.370117 11.9636 0.400117 11.9936 0.400117C12.6836 0.510117 13.1836 1.05012 13.2036 1.75012C13.2136 2.15012 13.0636 2.50012 12.7836 2.79012C12.7536 2.83012 12.7136 2.86012 12.6736 2.90012C10.2336 5.34012 7.79364 7.78012 5.35364 10.2201C5.33364 10.2401 5.31364 10.2601 5.28364 10.3001C5.32364 10.3001 5.34364 10.3001 5.37364 10.3001C6.52364 10.3001 7.67364 10.3001 8.82364 10.3001C14.9536 10.3001 21.0936 10.3001 27.2236 10.3001C27.5336 10.3001 27.8436 10.3501 28.1036 10.5301C28.5936 10.8601 28.8436 11.4701 28.7036 12.0401C28.5636 12.6301 28.0936 13.0501 27.4936 13.1201C27.4136 13.1201 27.3236 13.1201 27.2436 13.1201C20.0636 13.1201 12.8836 13.1201 5.70364 13.1201C5.56364 13.1201 5.43364 13.1201 5.28364 13.1201C5.31364 13.1501 5.32364 13.1701 5.34364 13.1901C6.08364 13.9301 6.81364 14.6701 7.55364 15.4001C9.21364 17.0501 10.8636 18.7101 12.5236 20.3601C12.6136 20.4501 12.7136 20.5301 12.7936 20.6301C13.1636 21.0501 13.2636 21.5301 13.0736 22.0601C12.8936 22.5901 12.5036 22.9001 11.9536 22.9901C11.4936 23.0601 11.0836 22.9201 10.7536 22.5901C7.51364 19.3501 4.26364 16.1001 1.02364 12.8601C0.853641 12.6901 0.683642 12.5101 0.583642 12.2801C0.343642 11.7201 0.463642 11.1301 0.923642 10.6701C1.60364 9.99012 2.28364 9.31012 2.97364 8.62012C5.57364 6.02012 8.17364 3.42012 10.7836 0.820117C11.0136 0.590117 11.2936 0.430117 11.6236 0.400117C11.6336 0.400117 11.6536 0.380117 11.6636 0.370117C11.7436 0.370117 11.8336 0.370117 11.9136 0.370117H11.9036Z" fill="#C1210D"/>
                        </svg>
                    </button>

                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset($image) }}" width="auto" height="100%" alt="Avatar" class="changeImage pb-2" id="avatar-clothes">
                        <!-- <div id="lottie-animation" width="auto" height="100%" alt="Avatar" class="changeImage pb-2" id="avatar-clothes"></div> -->
                    </div>
                    
                    <button type="button" class="btn btn-outline-primary slide-button right-center position-absolute" id="avatar-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="0 0 30 23" fill="none">
                            <path d="M17.7663 22.7119C17.7663 22.7119 17.7063 22.6819 17.6763 22.6819C16.9863 22.5719 16.4863 22.0319 16.4663 21.3319C16.4563 20.9319 16.6063 20.5819 16.8863 20.2919C16.9163 20.2519 16.9563 20.2219 16.9963 20.1819C19.4363 17.7419 21.8763 15.3019 24.3163 12.8619C24.3363 12.8419 24.3563 12.8219 24.3863 12.7819C24.3463 12.7819 24.3263 12.7819 24.2963 12.7819C23.1463 12.7819 21.9963 12.7819 20.8463 12.7819C14.7163 12.7819 8.57628 12.7819 2.44628 12.7819C2.13628 12.7819 1.82628 12.7319 1.56628 12.5519C1.07628 12.2219 0.826283 11.6119 0.966283 11.0419C1.10628 10.4519 1.57628 10.0319 2.17628 9.96191C2.25628 9.96191 2.34628 9.96191 2.42628 9.96191C9.60628 9.96191 16.7863 9.96191 23.9663 9.96191C24.1063 9.96191 24.2363 9.96191 24.3863 9.96191C24.3563 9.93191 24.3463 9.91191 24.3263 9.89191C23.5863 9.15191 22.8563 8.41191 22.1163 7.68191C20.4563 6.03191 18.8063 4.37191 17.1463 2.72191C17.0563 2.63191 16.9563 2.55191 16.8763 2.45191C16.5063 2.03191 16.4063 1.55191 16.5963 1.02191C16.7763 0.49191 17.1663 0.18191 17.7163 0.0919103C18.1763 0.0219107 18.5863 0.161912 18.9163 0.491912C22.1563 3.73191 25.4063 6.98191 28.6463 10.2219C28.8163 10.3919 28.9863 10.5719 29.0863 10.8019C29.3263 11.3619 29.2063 11.9519 28.7463 12.4119C28.0663 13.0919 27.3863 13.7719 26.6963 14.4619C24.0963 17.0619 21.4963 19.6619 18.8863 22.2619C18.6563 22.4919 18.3763 22.6519 18.0463 22.6819C18.0363 22.6819 18.0163 22.7019 18.0063 22.7119C17.9263 22.7119 17.8363 22.7119 17.7563 22.7119L17.7663 22.7119Z" fill="#C1210D"/>
                        </svg>
                    </button>
                </section>
            </div>
            
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section">
                <div class="scrollable-content">
                    <form novalidate action="{{route('change.image')}}" method="POST" id="gender_selection">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-3 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        @if(isset($firstName))
                                            <h1 class="display-4 text-white font-normal pb-3 fw-bold text-center text-md-start">Nice to meet you, {{ $firstName }}</h1>
                                        @else 
                                            <h1 class="display-4 text-white font-normal pb-3 fw-bold text-center text-md-start">Nice to meet you.</h1>
                                        @endif
                                        <p class="text-white display-6 lh-base text-center text-md-start">Please click to select your gender.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-md-5">
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
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Male</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-6 col-md-12 text-dark fade-effect py-2 px-2">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 w-100 py-4 gender-button @if($gender === 'Female') default @endif" data-avatar="Female" data-required="" value="female" id="genderfemale">
                                                    <img src="{{ asset('images/gender-selection/button-gender-female.png') }}" width="117.5" alt="Gender Female">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Female</p>
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
                                        <a href="{{route('avatar.welcome')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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
    const animationFemale = lottie.loadAnimation({
        container: document.getElementById('lottie-animation'),
        renderer: 'svg', 
        loop: true,
        autoplay: true,
        path: '{{ asset('images/avatar-general/gender-female.json') }}'
    });
</script>
@endsection