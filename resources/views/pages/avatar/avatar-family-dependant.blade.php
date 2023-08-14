<?php
 /**
 * Template Name: Family Dependant Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $familyDependant = isset($arrayData['familyDependant']) ? $arrayData['familyDependant'] : '';
    $dataUrl = isset($arrayData['dataUrl']) ? $arrayData['dataUrl'] : '';
@endphp

<div id="avatar_family_dependant" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default px-0">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-design-placeholder content-avatar-default overflow-auto overflow-hidden">
                    <div class="avatar-bg position-relative imageContainerParents"></div>
                    <div class="avatar-bg position-relative imageContainerSpouse">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male-no-shadow.svg') }}" width="auto" height="98%" alt="Main character" class="changeImage position-absolute" style="left:40px">
                    </div>
                    <div class="avatar-bg position-relative imageContainerChildren"></div>
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
                                        <h1 class="display-4 text-white pb-3 fw-bold">Great, now let’s get to know your family. </h1>
                                        <p class="text-white display-6 lh-base">Click to select your family details.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-sm-5">
                                    @if ($errors->has('familyDependantButtonInput'))
                                        <div class="col-12 pb-3">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('familyDependantButtonInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'spouse' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0" data-avatar="spouse" data-required="" id="spouseButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/spouse-icon.png') }}" width="auto" height="100px" alt="Spouse">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Spouse</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'children' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0" data-avatar="children" data-required="" id="childButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/children-icon.png') }}" width="auto" height="100px" alt="Child(ren)">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Child(ren)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'parents' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0" data-avatar="parents" data-required="" id="parentButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/parents-icon.png') }}" width="auto" height="100px" alt="Parent(s)">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Parent(s)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'siblings' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                                <button class="border-0" data-avatar="siblings" data-required="" id="siblingButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/siblings-icon.png') }}" width="auto" height="100px" alt="Sibling(s)">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Sibling(s)</p>
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
                                        <input type="hidden" name="familyDependantButtonInput" id="familyDependantButtonInput" value="{{$familyDependant}}">
                                        <input type="hidden" name="urlInput" id="urlInput" value="{{$dataUrl}}">
                                        <a href="{{route('avatar.marital.status')}}" class="btn btn-primary flex-fill text-uppercase me-md-2">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton" data-url="avatar.family.dependant.details">Next</button>
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
// Manually convert the PHP array to JSON
var passingArrays = {!! json_encode(session('passingArrays')) !!};

// Access the elements of the array in JavaScript
var maritalStatus = passingArrays.maritalStatus;

// Disable the 'Spouse' button if maritalStatus is 'single'
if (maritalStatus === 'single') {
    const spouseButton = document.getElementById('spouseButton');
    const childButton = document.getElementById('childButton');
    spouseButton.disabled = true;
    childButton.disabled = true;

    // Remove hover effect if it is disabled
    const spouseParentDiv = spouseButton.parentElement;
    const childParentDiv = childButton.parentElement;
    spouseParentDiv.classList.remove('hover');
    childParentDiv.classList.remove('hover');

    const spouseImg = spouseButton.querySelector('img');
    const childImg = childButton.querySelector('img');
    spouseImg.style.opacity = '0.5'; 
    childImg.style.opacity = '0.5'; 

} else if (maritalStatus === 'divorced' || maritalStatus === 'widowed') {
    const spouseButton = document.getElementById('spouseButton');
    spouseButton.disabled = true;
}

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
        document.getElementById('familyDependantButtonInput').value = dataAvatar;
        document.getElementById('urlInput').value = dataUrl;
    });
});





// // Get the elements you need
// const avatarForm = document.getElementById('avatarForm');
// const nextButton = document.getElementById('nextButton');
// let selectedAvatar = null;

// var selectedFamilies = []; // Array to store selected data-avatar values

// // Add event listener to each button with the 'data-required' attribute
// const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
// dataAvatarButtons.forEach(button => {
//     button.addEventListener('click', function(event) {
//         event.preventDefault(); // Prevent the default behavior of the button click
    
//         selectedAvatarValue = this.getAttribute('data-avatar');

//         // Check if the value is already in the array
//         const index = selectedFamilies.indexOf(selectedAvatarValue);
//         if (index !== -1) {
//             // Value already exists, remove it (deselect the button)
//             selectedFamilies.splice(index, 1);
//             this.removeAttribute('data-required'); // Remove the 'selected' attribute
//         } else {
//             // Value does not exist, add it to the array (select the button)
//             selectedFamilies.push(selectedAvatarValue);
//             this.setAttribute('data-required', 'selected'); // Add the 'selected' attribute
//         }

//         selectedAvatar = this.getAttribute('data-required');
//         // Update the hidden input field value
//         document.getElementById('urlInput').value = 'avatar.family.dependant.details';
//     });
// });

// avatarForm.addEventListener('submit', function(event) {
//     event.preventDefault(); // Prevent form submission
    
//     if (selectedFamilies.length === 0) {
//         // If no button is selected, prevent form submission and show an error message
//         const errorContainer = document.getElementById('errorContainer');
//         errorContainer.innerHTML = 'Please select your family details.';
//         errorContainer.style.display = 'block';
//         return;
//     }

//     // Perform your server-side validation here using Laravel or JavaScript fetch API
//     // Use the selectedFamilies array instead of sending a separate fetch request
//     fetch('/validate-avatar', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use Blade templating to get the CSRF token
//         },
//         body: JSON.stringify({
//             'data-required': selectedAvatar,
//             'selectedFamilies': selectedFamilies, // Include the selectedFamilies array in the request body
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.validationPassed) {
//             // Form validation passed, proceed with the form submission
//             // This will only trigger when the Next button is clicked, not the data-required buttons
//             avatarForm.submit(); // "this" refers to the avatarForm element
//         } else {
//             // Form validation failed, handle the error (display an error message, etc.)
//             const errorContainer = document.getElementById('errorContainer');
//             errorContainer.innerHTML = 'Form validation failed: ' + data.errors.join(', ');
//             errorContainer.style.display = 'block';
//         }
//     })
//     .catch(error => {
//         // Handle any errors that occur during the fetch request
//         console.error('Error during fetch request:', error);
//     });
// });

</script>

@endsection