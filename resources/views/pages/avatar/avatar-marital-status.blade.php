<?php
 /**
 * Template Name: Marital Status Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Marital Status</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="avatar_marital_status" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-design-placeholder content-avatar-default">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset('/images/avatar-general/' . (isset($arrayData['image']) ? $arrayData['image'] : 'gender-male') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form action="{{ route('handle.avatar.selection') }}" method="post" class="buttonForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-3 fw-bold">May we know your relationship status?</h1>
                                        <p class="text-white display-6 lh-base">Click to select your marital status.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-sm-5">
                                    @if ($errors->has('maritalStatusButtonInput'))
                                        <div class="col-12 pb-3">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('maritalStatusButtonInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 @if(isset($arrayData['maritalStatus']) && $arrayData['maritalStatus'] === 'single') default @endif" data-avatar="single" data-required="">
                                                    <img src="{{ asset('images/avatar-marital-status/single-icon.png') }}" width="auto" height="100px" alt="Single">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Single</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 @if(isset($arrayData['maritalStatus']) && $arrayData['maritalStatus'] === 'married') default @endif" data-avatar="married" data-required="">
                                                    <img src="{{ asset('images/avatar-marital-status/married-icon.png') }}" width="auto" height="100px" alt="Married">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Married</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 @if(isset($arrayData['maritalStatus']) && $arrayData['maritalStatus'] === 'divorced') default @endif" data-avatar="divorced" data-required="">
                                                    <img src="{{ asset('images/avatar-marital-status/divorced-icon.png') }}" width="auto" height="100px" alt="Divorced">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Divorced</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0 @if(isset($arrayData['maritalStatus']) && $arrayData['maritalStatus'] === 'widowed') default @endif" data-avatar="widowed" data-required="">
                                                    <img src="{{ asset('images/avatar-marital-status/widowed-icon.png') }}" width="auto" height="100px" alt="Widowed">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Widowed</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="maritalStatusButtonInput" id="maritalStatusButtonInput" value="{{$maritalStatus}}">
                                        <input type="hidden" name="urlInput" id="urlInput" value="{{$dataUrl}}">
                                        <a href="{{route('identity.details')}}" class="btn btn-primary flex-fill text-uppercase me-md-2">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton" data-url="avatar.family.dependant">Next</button>
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
// Add event listener to each button with the 'data-required' attribute
const dataButtons = document.querySelectorAll('[data-avatar]');

dataButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the button click

        const nextButton = document.getElementById('nextButton');
        const dataUrl = nextButton.getAttribute('data-url');

        // Get the selected data-avatar value
        const dataAvatar = this.getAttribute('data-avatar');

        // Update the hidden input field value with the selected avatar
        document.getElementById('maritalStatusButtonInput').value = dataAvatar;
        document.getElementById('urlInput').value = dataUrl;
    });
});
</script>
@endsection