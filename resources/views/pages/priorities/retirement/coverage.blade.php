<?php
 /**
 * Template Name: Retirement Coverage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Retirement - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $retirement = session('customer_details.retirement_needs');
    $selfData = session('customer_details.basic_details');
    $selfGender = session('customer_details.identity_details.gender');
    $spouseData = session('customer_details.family_details.dependant.spouse_data');
    $retirementSelectedAvatar = session('customer_details.retirement_needs.coveragePerson');
@endphp

<div id="retirement-coverage">
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12 vh-100 wrapper-needs-master-full-default bg-needs-master-full">
                <section class="header-needs-default">
                    <div class="col-lg-6 col-md-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </section>
                <form novalidate action="{{route('validate.retirement.coverage.selection')}}" method="POST" class="content-needs-default m-0">
                    @csrf
                    <section class="overflow-auto overflow-hidden row content-block">
                        <div class="col-12 header-content-coverage">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <h4 class="f-34 f-family fw-700">I'd like to provide coverage for my:</h4>
                            </div>
                        </div>
                        <div class="col-11 m-auto selection-content-coverage h-100 coverage_slick z-1">
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if($retirementSelectedAvatar === $selfData['full_name']) default @endif" id="{{ $selfData['full_name'] }}" data-avatar="{{ $selfData['full_name'] }}" data-required="">
                                    <img src="{{ asset('images/avatar/coverage/avatar-coverage-' .($selfGender === 'female' ? 'female' : 'male').'.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Self</strong></p>
                                </button>
                            </div>
                            @if ($spouseData)
                                <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                    <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if($retirementSelectedAvatar === $spouseData['full_name']) default @endif" id="{{ $spouseData['full_name'] }}" data-avatar="{{ $spouseData['full_name'] }}" data-required="">
                                        <img src="{{ asset('images/avatar/coverage/avatar-coverage-spouse-'.($selfGender === 'female' ? 'male' : 'female').'.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                        <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>{{ $spouseData['full_name'] }}</strong></p>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('retirementSelectedAvatarInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('retirementSelectedAvatarInput'))
                        <section class="row warning z-1">
                            <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('retirementSelectedAvatarInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-white py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="retirementSelectedAvatarInput" id="retirementSelectedAvatarInput" value="{{$retirementSelectedAvatar}}">
                                    <a href="{{route('retirement.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

@endsection