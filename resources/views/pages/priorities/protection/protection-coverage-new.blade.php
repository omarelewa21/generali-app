<?php
 /**
 * Template Name: Protection - Coverage Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Protection - Coverage</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $protection = session('customer_details.protection_needs');
    $selfGender = session('customer_details.identity_details.gender');
    $childData = session('customer_details.family_details.dependant.children_data');
    $spouseData = session('customer_details.family_details.dependant.spouse_data');
    $protectionSelectedAvatar = session('customer_details.protection_needs.coveragePerson');
@endphp

<div id="protection_coverage" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu-needs')</div></div>
            <section class="content-needs-grey">
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <div class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-5 fw-bold lh-base text-center">I’d like to provide coverage for my:</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-content">
                    <div class="container h-100">
                        <div class="row justify-content-center h-100">
                            <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                <button class="border-0 bg-transparent position-relative choice h-100 @if($protectionSelectedAvatar === 'self') default @endif" id="self" data-avatar="self" data-required="">
                                    <img src="{{ asset('images/avatar/coverage/avatar-coverage-' .($selfGender === 'female' ? 'female' : 'male').'.png') }}" height="100%" width="auto">
                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Self</p>
                                </button>
                            </div>
                            @if ($spouseData)
                                <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                    <button class="border-0 bg-transparent choice h-100 position-relative @if($protectionSelectedAvatar === 'spouse') default @endif" id="spouse" data-avatar="spouse" data-required="">
                                        <img src="{{ asset('images/avatar/coverage/avatar-coverage-spouse-'.($selfGender === 'female' ? 'male' : 'female').'.png') }}" height="100%" width="auto">
                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">Spouse</p>
                                    </button>
                                </div>
                            @endif
                            @if ($childData)
                                @foreach($childData as $child)
                                    <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                        <button class="border-0 bg-transparent choice h-100 position-relative @if($protectionSelectedAvatar === $child['full_name']) default @endif" id="{{ $child['full_name'] }}" data-avatar="{{ $child['full_name'] }}" data-required="">
                                            <img src="{{ asset('images/avatar/coverage/avatar-coverage-child-'.str_replace(' ', '_', $child['gender']).'.png') }}" height="100%" width="auto">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">{{ $child['full_name'] }}</p>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer footer-avatar-grey">
                <div class="bg-white py-4 fixed-bottom footer-scroll">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a href="{{route('protection.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                <a href="{{route('protection.coverage.new')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<style>
    
</style>
@endsection