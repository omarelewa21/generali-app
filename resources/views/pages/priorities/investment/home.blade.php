<?php
 /**
 * Template Name: Investment Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Investment - Home</title>

@section('content')
@php
    // Retrieving values from the session
    $investmentPriority = session('customer_details.priorities.investments_discuss');
    $protectionPriority = session('customer_details.priorities.protection_discuss');
    $retirementPriority = session('customer_details.priorities.retirement_discuss');
    $educationPriority = session('customer_details.priorities.education_discuss');
    $savingsPriority = session('customer_details.priorities.savings_discuss');

    $gender = session('customer_details.avatar.gender', 'Male');
    $skintone = session('customer_details.avatar.skin_tone', 'white');
@endphp

<div id="investment_home" class="needs_home">
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
                <div class="wrapper-needs-grey main-default-bg">
                    <section class="header py-3 py-md-0">@include ('templates.nav.nav-sidebar-needs')</section>
                    <section class="content-needs">
                        <div class="col-12 justify-content-center align-items-center position-relative d-xl-flex d-none">
                            @if(isset($gender) || isset($skintone))
                                <div id="lottie-animation" class="position-absolute needs_avatar" style="bottom:-50px;"></div>
                            @else
                                <img src="{{ asset('images/needs/investment/home/avatar.png') }}" height="90%" width="auto" class="position-absolute" style="bottom:-50px" alt="Investment Home">
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
                                <div class="col-xl-6 col-xxl-5 text-center">
                                    <h2 class="display-5 fw-bold py-5 py-xl-4">Now let's plan for your Lump Sum Investments.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        @php
                                            if ($savingsPriority === 'true') {
                                                $route = route('savings.gap');
                                            } elseif ($educationPriority === 'true') {
                                                $route = route('education.gap');
                                            } elseif ($retirementPriority === 'true') {
                                                $route = route('retirement.gap');
                                            } elseif ($protectionPriority === 'true') {
                                                $route = route('protection.gap');
                                            }
                                            else {
                                                $route = route('financial.priorities.discuss');
                                            }
                                        @endphp
                                        <a href="{{ $route }}" class="btn btn-secondary text-uppercase flex-fill me-md-2">Back</a>
                                        <a href="{{route('investment.coverage')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
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
    var needs_priority = '{{$investmentPriority}}';
    var genderSet = '{{$gender}}';
    var skintone = '{{$skintone}}';
    var gender = genderSet.toLowerCase();
</script>
@endsection 