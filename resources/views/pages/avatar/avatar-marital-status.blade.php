<?php
 /**
 * Template Name: Avatar - Marital Status Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Marital Status</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="avatar_marital_status" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center d-flex justify-content-center">
                    <img src="{{ asset('/images/avatar/avatar/' . (isset($arrayData['image']) ? $arrayData['image'] : 'gender-male') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form action="{{ route('handle.avatar.selection') }}" method="post" id="avatarForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white font-normal pb-3 fw-bold">May we know your relationship status?</h1>
                                        <p class="text-white display-6">Click to select your marital status.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-sm-5">
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                        <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                            <button class="border-0 bg-white" data-avatar="single" data-required="">
                                                <img src="{{ asset('images/avatar/single-icon.svg') }}" width="150px" height="100px" alt="Single">
                                                <p class="avatar-text text-center pt-4 fw-bold">Single</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                        <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                            <button class="border-0 bg-white" data-avatar="married" data-required="">
                                                <img src="{{ asset('images/avatar/married-icon.svg') }}" width="150px" height="100px" alt="Married">
                                                <p class="avatar-text text-center pt-4 fw-bold">Married</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                        <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                            <button class="border-0 bg-white" data-avatar="divorced" data-required="">
                                                <img src="{{ asset('images/avatar/divorced-icon.svg') }}" width="150px" height="100px" alt="Divorced">
                                                <p class="avatar-text text-center pt-4 fw-bold">Divorced</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                        <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center border border-danger">
                                            <button class="border-0 bg-white" data-avatar="widowed" data-required="">
                                                <img src="{{ asset('images/avatar/widowed-icon.svg') }}" width="150px" height="100px" alt="Widowed">
                                                <p class="avatar-text text-center pt-4 fw-bold">Widowed</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-sm-5">
                                    <!-- Container to display error messages -->
                                    <div id="errorContainer" style="display: none;" class="alert alert-danger"></div>
                                </div>
                            </div>
                        </section>

                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                        <!-- Add a hidden input field to store the selected avatar value -->
                                        <input type="hidden" name="selectedAvatarInput" id="selectedAvatarInput">
                                        <input type="hidden" name="urlInput" id="urlInput">
                                        <a href="{{route('identity.details')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                        <!-- <a href="{{route('avatar.family.dependant') }}" class="btn btn-primary text-uppercase" id="nextButton">Next</a> -->
                                        <button type="submit" class="btn btn-primary text-uppercase" id="nextButton">Next</button>
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
// Get the elements you need
const avatarForm = document.getElementById('avatarForm');
const nextButton = document.getElementById('nextButton');
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
        document.getElementById('selectedAvatarInput').value = selectedAvatarValue;
        document.getElementById('urlInput').value = 'avatar.family.dependant';
    });
});

// Add event listener to the form's submit event
avatarForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    if (!selectedAvatar) {
        // If no button is selected, prevent form submission and show an error message
        const errorContainer = document.getElementById('errorContainer');
        errorContainer.innerHTML = 'Please select your marital status.';
        errorContainer.style.display = 'block';
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
            avatarForm.submit(); // "this" refers to the avatarForm element
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