<?php
 /**
 * Template Name: Savings Coverage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Savings - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $savings = session('customer_details.savings_needs');
    $selfData = session('customer_details.basic_details');
    $selfGender = session('customer_details.identity_details.gender');
    $childData = session('customer_details.family_details.dependant.children_data');
    $spouseData = session('customer_details.family_details.dependant.spouse_data');
    $savingsSelectedAvatar = session('customer_details.savings_needs.coveragePerson');
@endphp

<div id="savings-coverage" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.savings.coverage.selection')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-5 fw-bold lh-sm text-center">I’d like to set up a regular savings program for my:</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content">
                    <div class="container h-100">
                        <div class="row justify-content-center h-100 coverage_slick">
                            @if ($selfData)
                                <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                    <button class="border-0 bg-transparent position-relative choice d-flex justify-content-center h-100 @if($savingsSelectedAvatar === $selfData['full_name']) default @endif" id="{{ $selfData['full_name'] }}" data-avatar="{{ $selfData['full_name'] }}" data-required="">
                                        <div>
                                            <img src="{{ asset('images/avatar/coverage/avatar-coverage-' .($selfGender === 'female' ? 'female' : 'male').'.png') }}" height="80%" width="auto" class="m-auto">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Self</p>
                                        </div>
                                    </button>
                                </div>
                            @endif
                            @if ($spouseData)
                                <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                    <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($savingsSelectedAvatar === $spouseData['full_name']) default @endif" id="{{ $spouseData['full_name'] }}" data-avatar="{{ $spouseData['full_name'] }}" data-required="">
                                        <div>
                                            <img src="{{ asset('images/avatar/coverage/avatar-coverage-spouse-'.($selfGender === 'female' ? 'male' : 'female').'.png') }}" height="80%" width="auto" class="m-auto">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">{{ $spouseData['full_name'] }}</p>
                                        </div>
                                    </button>
                                </div>
                            @endif
                            @if ($childData)
                                @foreach($childData as $child)
                                    <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                        <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($savingsSelectedAvatar === $child['full_name']) default @endif" id="{{ $child['full_name'] }}" data-avatar="{{ $child['full_name'] }}" data-required="">
                                            <div>
                                                <img src="{{ asset('images/avatar/coverage/avatar-coverage-child-'.str_replace(' ', '_', $child['gender']).'.png') }}" height="80%" width="auto" class="m-auto">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">{{ $child['full_name'] }}</p>
                                            </div>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('savingsSelectedAvatarInput'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savingsSelectedAvatarInput') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="savingsSelectedAvatarInput" id="savingsSelectedAvatarInput" value="{{$savingsSelectedAvatar}}">
                                    <a href="{{route('savings.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="footer-avatar-grey"></div>
        </div>
    </div>
</div>

@endsection