<?php
 /**
 * Template Name: Education Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Education - Home</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $educationPriority = session('customer_details.priorities.education_discuss');
    $protectionPriority = session('customer_details.priorities.protection_discuss');
    $retirementPriority = session('customer_details.priorities.retirement_discuss');

    $check =  session('customer_details.customers_choice');
@endphp

<div id="education_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3">
                    <h2 class="display-5 fw-bold">My Priorities</h2>
                    <h2 class="display-5 fw-bold">{{$check}}</h2>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey content-section px-0">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block">
                <div class="wrapper-needs-grey main-default-bg">
                    <section class="header py-3 py-md-0">@include ('templates.nav.nav-sidebar-needs')</section>
                    <section class="content-needs">
                        <div class="col-12 d-flex justify-content-center align-items-center position-relative vector">
                            <img src="{{ asset('images/needs/education/home-vector.png') }}" height="90%" width="auto" class="position-absolute" style="bottom:-50px" alt="Education Home">
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container h-100">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-xl-6 text-center">
                                    <h2 class="display-5 fw-bold lh-sm py-4">Let’s get into your plans for Education.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        @php
                                            if ($retirementPriority === 'true') {
                                                $route = route('retirement.gap');
                                            } elseif ($protectionPriority === 'true') {
                                                $route = route('protection.gap');
                                            }
                                            else {
                                                $route = route('financial.priorities.discuss');
                                            }
                                        @endphp
                                        <!-- <a href="{{route('retirement.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a> -->
                                        <a href="{{ $route }}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                        <a href="{{route('education.coverage')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
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
    var needs_priority = '{{$educationPriority}}';
</script>
@endsection 