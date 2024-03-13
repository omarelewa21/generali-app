<?php
 /**
 * Template Name: Savings Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Savings - Home</title>

@section('content')
@php
    // Retrieving values from the session
    $savingsPriority = session('customer_details.priorities.savings_discuss');
    $protectionPriority = session('customer_details.priorities.protection_discuss');
    $retirementPriority = session('customer_details.priorities.retirement_discuss');
    $educationPriority = session('customer_details.priorities.education_discuss');
@endphp

<div id="savings_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3">
                    <h2 class="display-5 fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey content-section px-0">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block">
                <div class="wrapper-needs-grey main-default-bg">
                    <section class="header py-3 py-md-0">@include ('templates.nav.nav-sidebar-needs')</section>
                    <section class="content-needs">
                        <div class="col-12 d-flex justify-content-center align-items-center position-relative">
                            <img src="{{ asset('images/needs/savings/home/avatar.png') }}" height="100%" width="auto" class="position-absolute" style="bottom:-60px" alt="Savings Home">
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container h-100">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-xl-7 text-center">
                                    <h2 class="display-5 fw-bold lh-sm py-4">Let’s make a plan to achieve your goals with Regular Savings.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        @php
                                            if ($educationPriority === 'true') {
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
                                        <a href="{{route('savings.coverage')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
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
    var needs_priority = '{{json_encode($savingsPriority)}}';
</script>
@endsection 