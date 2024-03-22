<?php
 /**
 * Template Name: Retirement Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Retirement - Home</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $retirementPriority = session('customer_details.priorities.retirement_discuss');
    $protectionPriority = session('customer_details.priorities.protection_discuss');

    $gender = session('customer_details.avatar.gender', 'Male');
    $skintone = session('customer_details.avatar.skin_tone', 'white');
@endphp

<div id="retirement_home" class="needs_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3">
                    <h2 class="display-5 fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-xl-9 bg-accent-bg-grey content-section px-0">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-xl-block">
                <div class="wrapper-needs-grey">
                    <section class="header py-3 py-md-0">@include ('templates.nav.nav-sidebar-needs')</section>
                    <section class="content-needs">
                        <div class="col-12 justify-content-center align-items-center position-relative d-xl-flex d-none">
                            @if(isset($gender) || isset($skintone))
                                <div id="lottie-animation" class="position-absolute needs_avatar d-flex justify-content-center" style="bottom:-40px;"></div>
                            @else
                                <img src="{{ asset('images/needs/retirement/home-vector.webp') }}" height="90%" width="auto" class="position-absolute" style="bottom:-40px" alt="Retirement Home">
                            @endif
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey needs_home_bottom">
                        <div class="col-12 d-xl-none d-block position-absolute needs_avatar_mob">
                            @if(isset($gender) || isset($skintone))
                                <div id="lottie-animation-mob" class="needs_avatar"></div>
                            @endif
                        </div>
                        <div class="container py-md-5 py-0 py-xl-0 h-100 bg-grey">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-xl-6 text-center">
                                    <h2 class="display-5 fw-bold py-5 py-xl-4 px-sm-3">Now let's talk about your plans for Retirement.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{$protectionPriority === 'true' ? route('protection.gap') : route('priorities.to.discuss')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                        <a href="{{route('retirement.coverage')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var needs_priority = '{{$retirementPriority}}';
    var genderSet = '{{$gender}}';
    var skintone = '{{$skintone}}';
    var gender = genderSet.toLowerCase();
</script>
@endsection 