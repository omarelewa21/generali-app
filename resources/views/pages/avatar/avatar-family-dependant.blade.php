<?php
 /**
 * Template Name: Avatar - Family Dependant Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="avatar_family_dependant" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="row">
                        <div class="col-12 col-xxl-4 position-relative avatar-bg">
                            <img src="{{ asset('/images/parent-father.svg') }}" width="auto" height="100%" alt="Parent" class="changeImage position-absolute start-0" style="bottom:2%;">
                            <img src="{{ asset('/images/avatar/avatar/parent-mother.svg') }}" width="auto" height="100%" alt="Parent" class="changeImage position-absolute" style="right:0;bottom:2%;max-height:88%">
                        </div>
                        <div class="col-12 col-xxl-4 position-relative avatar-bg">
                            <img src="{{ asset('/images/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Main character" class="changeImage position-absolute start-0" style="z-index:1;bottom:2%">
                            <img src="{{ asset('/images/spouse.svg') }}" width="auto" height="100%" alt="Spouse" class="changeImage position-absolute" style="right:0;max-height: 93%;bottom:2%">
                        </div>
                        <div class="col-12 col-xxl-4 position-relative">
                            <!-- <img src="{{ asset('/images/avatar/avatar/children-girl.svg') }}" width="auto" height="100%" alt="Children" class="changeImage position-absolute" style="left:0;bottom:2%;z-index:1;max-height: 45%;">
                            <img src="{{ asset('/images/avatar/avatar/children-boy.svg') }}" width="auto" height="100%" alt="Children" class="changeImage position-absolute end-0" style="bottom:2%;max-height:65%"> -->
                        </div>
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
                                    <h1 class="display-4 text-white font-normal pb-3 fw-bold">Great, now let’s get to know your family. </h1>
                                    <p class="text-white display-6">Click to select your family details.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white" data-avatar="spouse" data-required="" id="spouseButton">
                                            <img src="{{ asset('images/avatar-family-dependant/spouse-icon.svg') }}" width="150px" height="100px" alt="Spouse">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Spouse</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white" data-avatar="children" data-required="" id="childButton">
                                            <img src="{{ asset('images/avatar-family-dependant/children-icon.svg') }}" width="150px" height="100px" alt="Child(ren)">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Child(ren)</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white" data-avatar="parents" data-required="" id="parentButton">
                                            <img src="{{ asset('images/avatar-family-dependant/parents-icon.svg') }}" width="150px" height="100px" alt="Parent(s)">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Parent(s)</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white" data-avatar="siblings" data-required="" id="siblingButton">
                                            <img src="{{ asset('images/avatar-family-dependant/siblings-icon.svg') }}" width="150px" height="100px" alt="Sibling(s)">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Sibling(s)</p>
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
                                    <input type="hidden" name="urlInput" id="urlInput">
                                    <a href="{{route('avatar.marital.status')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <!-- <a href="{{route('avatar.family.dependant.details') }}" class="btn btn-primary text-uppercase" id="nextButton">Next</a> -->
                                    <button type="submit" class="btn btn-primary text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </section></form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .avatar-bg {
        background-image: url('/images/Shadow.png');
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: contain;
    }
</style>
<script>
// Manually convert the PHP array to JSON
var passingArrays = {!! json_encode(session('passingArrays')) !!};

// Access the elements of the array in JavaScript
var maritalStatus = passingArrays.maritalStatus;

// Get the elements you need
const avatarForm = document.getElementById('avatarForm');
const nextButton = document.getElementById('nextButton');
let selectedAvatar = null;

// Disable the 'Spouse' button if maritalStatus is 'single'
if (maritalStatus === 'single') {
    const spouseButton = document.getElementById('spouseButton');
    const childButton = document.getElementById('childButton');
    spouseButton.disabled = true;
    childButton.disabled = true;
} else if (maritalStatus === 'divorced' || maritalStatus === 'widowed') {
    const spouseButton = document.getElementById('spouseButton');
    spouseButton.disabled = true;
}
var selectedFamilies = []; // Array to store selected data-avatar values

// Add event listener to each button with the 'data-required' attribute
const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
dataAvatarButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the button click
    
        selectedAvatarValue = this.getAttribute('data-avatar');

        // Check if the value is already in the array
        const index = selectedFamilies.indexOf(selectedAvatarValue);
        if (index !== -1) {
            // Value already exists, remove it (deselect the button)
            selectedFamilies.splice(index, 1);
            this.removeAttribute('data-required'); // Remove the 'selected' attribute
        } else {
            // Value does not exist, add it to the array (select the button)
            selectedFamilies.push(selectedAvatarValue);
            this.setAttribute('data-required', 'selected'); // Add the 'selected' attribute
        }

        selectedAvatar = this.getAttribute('data-required');
        // Update the hidden input field value
        document.getElementById('urlInput').value = 'avatar.family.dependant.details';
    });
});

avatarForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    
    if (selectedFamilies.length === 0) {
        // If no button is selected, prevent form submission and show an error message
        const errorContainer = document.getElementById('errorContainer');
        errorContainer.innerHTML = 'Please select your family details.';
        errorContainer.style.display = 'block';
        return;
    }

    // Perform your server-side validation here using Laravel or JavaScript fetch API
    // Use the selectedFamilies array instead of sending a separate fetch request
    fetch('/validate-avatar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use Blade templating to get the CSRF token
        },
        body: JSON.stringify({
            'data-required': selectedAvatar,
            'selectedFamilies': selectedFamilies, // Include the selectedFamilies array in the request body
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