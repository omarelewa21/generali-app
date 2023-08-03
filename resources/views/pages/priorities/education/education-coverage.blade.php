<?php
 /**
 * Template Name: Education Coverage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default text-center">
        <div class="row bg-education vh-100">
            <section class="col-12 d-flex needs-coverage-nav">
                <!-- <div class="row"> -->
                    <div class="col-6">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-6">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                <!-- </div> -->
                
            </section>
            <section class="col-12 d-flex justify-content-center py-2 text-center needs-coverage-title align-items-center hide-mobile">
                <h5>I'd like to provide coverage for my:</h5>
                <div id="errorContainer" style="display: none;" class="alert alert-danger"></div>
            </section>
            <form novalidate action="{{route('validate.coverage.selection')}}" method="POST" id="coverage_selection">
                @csrf
                <section class="needs-coverage-content">
                    <div class="col-12">
                        <div class="row overflow-auto overflow-x-hidden d-flex justify-content-center h-100 align-items-end">
                            <div class="row position-relative desktop-height d-flex align-items-end">
                                <div class="col-12 show-mobile">
                                    <h5>I'd like to provide coverage for my:</h5>
                                    <div id="errorContainerMob" style="display: none;" class="alert alert-danger"></div>
                                </div>
                                <div class="col-12 education_coverage z-99 slick-height">
                                    <!-- <div class="col-12"> -->
                                        <div class="slick-slide">
                                            <button class="border-0 bg-transparent choice mh-100 h-100 slick-padding" id="Child" data-avatar="Child" data-required="">
                                                <img src="{{ asset('images/avatar-gender-selection/button-gender-male.png') }}" class="m-auto mh-100 mw-100">
                                                <p class="py-2 m-0"><strong>Self</strong></p>
                                            </button>
                                        </div>
                                        <div class="slick-slide">
                                            <button class="border-0 bg-transparent choice mh-100 h-100 slick-padding" id="Child" data-avatar="Child" data-required="">
                                                <img src="{{ asset('images/avatar/daughter.png') }}" class="m-auto mh-100 mw-100">
                                                <p class="py-2 m-0"><strong>Child</strong></p>
                                            </button>
                                        </div>
                                        <div class="slick-slide">
                                            <button class="border-0 bg-transparent choice mh-100 h-100 slick-padding" id="Self" data-avatar="Self" data-required="">
                                                <img src="{{ asset('images/avatar/son.png') }}" class="m-auto mh-100 mw-100">
                                                <p class="py-2 m-0"><strong>Child 2</strong></p>
                                            </button>
                                        </div>
                                        <div class="slick-slide">
                                            <button class="border-0 bg-transparent choice mh-100 h-100 slick-padding" id="Child" data-avatar="Child" data-required="">
                                                <img src="{{ asset('images/avatar/young-kid.png') }}" class="m-auto mh-100 mw-100">
                                                <p class="py-2 m-0"><strong>Child 3</strong></p>
                                            </button>
                                        </div>
                                        <div class="slick-slide">
                                            <button class="border-0 bg-transparent choice mh-100 h-100 slick-padding" id="Self" data-avatar="Self" data-required="">
                                                <img src="{{ asset('images/avatar-gender-selection/button-gender-female.png') }}" class="m-auto mh-100 mw-100">
                                                <p class="py-2 m-0"><strong>Self 2</strong></p>
                                            </button>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="position-absolute bottom-0 bg-needs_text p-master row"></div>
                            </div>
                            <!-- <div class="col-12 show-mobile bg-btn_bar">
                                <div class="py-4 px-2">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <input type="hidden" name="selectedCoverageInput" id="selectedCoverageInput">
                                        <input type="hidden" name="urlInput" id="urlInput" value="education.supporting.years">
                                        <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">Back</a>
                                        <button class="btn btn-primary text-uppercase" id="nextBtn" type="submit">Next</button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar row">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <input type="hidden" name="selectedCoverageInput" id="selectedCoverageInput">
                            <input type="hidden" name="urlInput" id="urlInput" value="education.supporting.years">
                            <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">Back</a>
                            <button class="btn btn-primary text-uppercase" id="nextBtn" type="submit">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.education_coverage').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 2,
            prevArrow:'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" style="width: 33px;height: 43px;color:#333333;position: absolute;left:15px;z-index: 10000;top: 45%;cursor: pointer;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg>',
            nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" style="width: 33px;height: 43px;color:#333333;position: absolute;right: 15px;z-index: 10000;top: 45%;cursor: pointer;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        centerMode: true,
                        slidesToShow: 2,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        centerMode: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerMode: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
// Get the elements you need
const coverageSelection = document.getElementById('coverage_selection');
const nextButton = document.getElementById('nextBtn');
let selectedAvatar = null;

// Add event listener to each button with the 'data-required' attribute
const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
dataAvatarButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the button click

        // Remove 'selected' attribute from all buttons
        dataAvatarButtons.forEach(btn => btn.removeAttribute('data-required'));
        // Add 'selected' attribute to the clicked button
        this.setAttribute('data-required', 'selected');
        // Store the selected data-avatar value
        selectedAvatar = this.getAttribute('data-required');
        selectedAvatarValue = this.getAttribute('data-avatar');

        // Update the hidden input field value with the selected avatar
        document.getElementById('selectedCoverageInput').value = selectedAvatarValue;
        // document.getElementById('urlInput').value = 'education.supporting.years';
    });
});

// Add event listener to the form's submit event
coverageSelection.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    if (!selectedAvatar) {
        // If no button is selected, prevent form submission and show an error message
        const errorContainer = document.getElementById('errorContainer');
        errorContainer.innerHTML = 'Please select who you want to provide coverage for.';
        errorContainer.style.display = 'block';

        const errorContainerMob = document.getElementById('errorContainerMob');
        errorContainerMob.innerHTML = 'Please select who you want to provide coverage for.';
        errorContainerMob.style.display = 'block';
        return;
    }

    // Perform your server-side validation here using Laravel or JavaScript fetch API
    // Use the selectedAvatar value instead of sending a separate fetch request
    fetch('/validate-avatar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use Blade templating to get the CSRF token
        },
        body: JSON.stringify({
            'data-required': selectedAvatar, // Include the selectedAvatar value in the request body
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.validationPassed) {
            // Form validation passed, proceed with the form submission
            // This will only trigger when the Next button is clicked, not the data-required buttons
            coverageSelection.submit(); // "this" refers to the coverageSelection element
        } else {
            // Form validation failed, handle the error (display an error message, etc.)
            const errorContainer = document.getElementById('errorContainer');
            errorContainer.innerHTML = 'Form validation failed: ' + data.errors.join(', ');
            errorContainer.style.display = 'block';
        }
    })
    .catch(error => {
        // Handle any errors that occur during the fetch request
        console.error('Error during fetch request:', error);
    });
});

</script>

@endsection