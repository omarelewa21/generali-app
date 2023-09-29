<?php
 /**
 * Template Name: Protection Coverage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Protection - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $protectionSelectedAvatar = isset($arrayData['protection']['protectionSelectedAvatar']) ? $arrayData['protection']['protectionSelectedAvatar'] : '';
    $protectionSelectedImage = isset($arrayData['protection']['protectionSelectedImage']) ? $arrayData['protection']['protectionSelectedImage'] : '';
@endphp

<div id="protection-coverage" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 vh-100 wrapper-needs-coverage-default bg-education-gap">
                <section class="header-needs-default">
                    <div class="col-lg-6 col-md-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </section>
                <form novalidate action="{{route('validate.protection.coverage.selection')}}" method="POST" class="content-needs-default m-0">
                    @csrf
                    <section class="overflow-auto overflow-hidden row content-block">
                        <div class="col-12 header-content-coverage">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <h4 class="f-34 f-family fw-700">I'd like to provide coverage for my:</h4>
                            </div>
                        </div>
                        <div class="col-11 m-auto selection-content-coverage h-100 coverage_slick z-1">
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['protection']['protectionSelectedAvatar']) && $arrayData['protection']['protectionSelectedAvatar'] === 'self') default @endif" id="self" data-avatar="self" data-required="">
                                    <img src="{{ asset('images/avatar/coverage/avatar-coverage-male.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Self</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['protection']['protectionSelectedAvatar']) && $arrayData['protection']['protectionSelectedAvatar'] === 'spouse') default @endif" id="spouse" data-avatar="spouse" data-required="">
                                    <img src="{{ asset('images/avatar/coverage/avatar-coverage-spouse-female.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Spouse</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['protection']['protectionSelectedAvatar']) && $arrayData['protection']['protectionSelectedAvatar'] === 'child') default @endif" id="child" data-avatar="child" data-required="">
                                    <img src="{{ asset('images/avatar/coverage/avatar-coverage-children.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Child</strong></p>
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('protectionSelectedAvatarInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('protectionSelectedAvatarInput'))
                        <section class="row warning z-1">
                            <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('protectionSelectedAvatarInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-white py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="protectionSelectedAvatarInput" id="protectionSelectedAvatarInput" value="{{$protectionSelectedAvatar}}">
                                    <input type="hidden" name="protectionSelectedAvatarImage" id="protectionSelectedAvatarImage" value="{{$protectionSelectedImage}}">
                                    <a href="{{route('protection.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

<script>

    // Add event listener to each button with the 'data-required' attribute
    const dataButtons = document.querySelectorAll('[data-avatar]');

    dataButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the button click

            dataButtons.forEach(btn => btn.removeAttribute('data-required'));
            // Add 'selected' attribute to the clicked button
            this.setAttribute('data-required', 'selected');

            selectedAvatar = this.getAttribute('data-required');

            dataButtons.forEach(btn => btn.classList.remove('selected'));

            const nextButton = document.getElementById('nextButton');

            // Get the selected data-avatar value
            const dataAvatar = this.getAttribute('data-avatar');
            const dataAvatarImg = this.querySelector('img').getAttribute('src');

            // Update the hidden input field value with the selected avatar
            document.getElementById('protectionSelectedAvatarInput').value = dataAvatar;
            document.getElementById('protectionSelectedAvatarImage').value = dataAvatarImg;
        });
    });

    // Preselect the button on page load
    window.addEventListener('DOMContentLoaded', function() {
        const defaultBtn = document.querySelectorAll('.default');

        defaultBtn.forEach(defaultBtn => {
            // Add the 'selected' class to the closest .button-bg div of each default button
            defaultBtn.classList.add('selected');
        });
    });

</script>

@endsection