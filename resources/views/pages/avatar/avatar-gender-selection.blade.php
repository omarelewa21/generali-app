<?php
 /**
 * Template Name: Gender Selection Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Gender Selection</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $gender = isset($arrayData['gender']) ? $arrayData['gender'] : '';
@endphp

<div id="avatar_gender_selection" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar">
                <div class="header-avatar">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-color-palatte d-flex justify-content-center top-avatar">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="text-dark pb-3 display-6 fw-bold">Pick the skin colour that’s closest to yours.</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="blocks col-12 color-box-wrapper d-flex justify-content-center align-items-center justify-content-center">
                                <a href="#" class="block" style="--bg: var(--gradient-1);">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="block" style="--bg: var(--gradient-2);">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="block" style="--bg: var(--gradient-3);">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="block" style="--bg: var(--gradient-4);">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="block" style="--bg: var(--gradient-5);">
                                    <div class="block__item"></div>
                                </a>
                                <a href="#" class="block" style="--bg: var(--gradient-6);">
                                    <div class="block__item"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="avatar-design-placeholder pt-4 bottom-avatar position-relative bg-gender">
                    <!-- <button type="button" class="btn btn-outline-primary slide-button left-top position-absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="24" viewBox="0 0 29 24" fill="none">
                            <path d="M11.9036 0.370117C11.9036 0.370117 11.9636 0.400117 11.9936 0.400117C12.6836 0.510117 13.1836 1.05012 13.2036 1.75012C13.2136 2.15012 13.0636 2.50012 12.7836 2.79012C12.7536 2.83012 12.7136 2.86012 12.6736 2.90012C10.2336 5.34012 7.79364 7.78012 5.35364 10.2201C5.33364 10.2401 5.31364 10.2601 5.28364 10.3001C5.32364 10.3001 5.34364 10.3001 5.37364 10.3001C6.52364 10.3001 7.67364 10.3001 8.82364 10.3001C14.9536 10.3001 21.0936 10.3001 27.2236 10.3001C27.5336 10.3001 27.8436 10.3501 28.1036 10.5301C28.5936 10.8601 28.8436 11.4701 28.7036 12.0401C28.5636 12.6301 28.0936 13.0501 27.4936 13.1201C27.4136 13.1201 27.3236 13.1201 27.2436 13.1201C20.0636 13.1201 12.8836 13.1201 5.70364 13.1201C5.56364 13.1201 5.43364 13.1201 5.28364 13.1201C5.31364 13.1501 5.32364 13.1701 5.34364 13.1901C6.08364 13.9301 6.81364 14.6701 7.55364 15.4001C9.21364 17.0501 10.8636 18.7101 12.5236 20.3601C12.6136 20.4501 12.7136 20.5301 12.7936 20.6301C13.1636 21.0501 13.2636 21.5301 13.0736 22.0601C12.8936 22.5901 12.5036 22.9001 11.9536 22.9901C11.4936 23.0601 11.0836 22.9201 10.7536 22.5901C7.51364 19.3501 4.26364 16.1001 1.02364 12.8601C0.853641 12.6901 0.683642 12.5101 0.583642 12.2801C0.343642 11.7201 0.463642 11.1301 0.923642 10.6701C1.60364 9.99012 2.28364 9.31012 2.97364 8.62012C5.57364 6.02012 8.17364 3.42012 10.7836 0.820117C11.0136 0.590117 11.2936 0.430117 11.6236 0.400117C11.6336 0.400117 11.6536 0.380117 11.6636 0.370117C11.7436 0.370117 11.8336 0.370117 11.9136 0.370117H11.9036Z" fill="#C1210D"/>
                        </svg>
                    </button> -->
                    <button type="button" class="btn btn-outline-primary slide-button left-center position-absolute" id="avatar-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="24" viewBox="0 0 29 24" fill="none">
                            <path d="M11.9036 0.370117C11.9036 0.370117 11.9636 0.400117 11.9936 0.400117C12.6836 0.510117 13.1836 1.05012 13.2036 1.75012C13.2136 2.15012 13.0636 2.50012 12.7836 2.79012C12.7536 2.83012 12.7136 2.86012 12.6736 2.90012C10.2336 5.34012 7.79364 7.78012 5.35364 10.2201C5.33364 10.2401 5.31364 10.2601 5.28364 10.3001C5.32364 10.3001 5.34364 10.3001 5.37364 10.3001C6.52364 10.3001 7.67364 10.3001 8.82364 10.3001C14.9536 10.3001 21.0936 10.3001 27.2236 10.3001C27.5336 10.3001 27.8436 10.3501 28.1036 10.5301C28.5936 10.8601 28.8436 11.4701 28.7036 12.0401C28.5636 12.6301 28.0936 13.0501 27.4936 13.1201C27.4136 13.1201 27.3236 13.1201 27.2436 13.1201C20.0636 13.1201 12.8836 13.1201 5.70364 13.1201C5.56364 13.1201 5.43364 13.1201 5.28364 13.1201C5.31364 13.1501 5.32364 13.1701 5.34364 13.1901C6.08364 13.9301 6.81364 14.6701 7.55364 15.4001C9.21364 17.0501 10.8636 18.7101 12.5236 20.3601C12.6136 20.4501 12.7136 20.5301 12.7936 20.6301C13.1636 21.0501 13.2636 21.5301 13.0736 22.0601C12.8936 22.5901 12.5036 22.9001 11.9536 22.9901C11.4936 23.0601 11.0836 22.9201 10.7536 22.5901C7.51364 19.3501 4.26364 16.1001 1.02364 12.8601C0.853641 12.6901 0.683642 12.5101 0.583642 12.2801C0.343642 11.7201 0.463642 11.1301 0.923642 10.6701C1.60364 9.99012 2.28364 9.31012 2.97364 8.62012C5.57364 6.02012 8.17364 3.42012 10.7836 0.820117C11.0136 0.590117 11.2936 0.430117 11.6236 0.400117C11.6336 0.400117 11.6536 0.380117 11.6636 0.370117C11.7436 0.370117 11.8336 0.370117 11.9136 0.370117H11.9036Z" fill="#C1210D"/>
                        </svg>
                    </button>
                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset('/images/avatar-general/' . (isset($arrayData['image']) ? $arrayData['image'] : 'gender-male') . '-1.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage pb-2" id="avatar-clothes">
                    </div>
                    <!-- <button type="button" class="btn btn-outline-primary slide-button right-top position-absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="0 0 30 23" fill="none">
                            <path d="M17.7663 22.7119C17.7663 22.7119 17.7063 22.6819 17.6763 22.6819C16.9863 22.5719 16.4863 22.0319 16.4663 21.3319C16.4563 20.9319 16.6063 20.5819 16.8863 20.2919C16.9163 20.2519 16.9563 20.2219 16.9963 20.1819C19.4363 17.7419 21.8763 15.3019 24.3163 12.8619C24.3363 12.8419 24.3563 12.8219 24.3863 12.7819C24.3463 12.7819 24.3263 12.7819 24.2963 12.7819C23.1463 12.7819 21.9963 12.7819 20.8463 12.7819C14.7163 12.7819 8.57628 12.7819 2.44628 12.7819C2.13628 12.7819 1.82628 12.7319 1.56628 12.5519C1.07628 12.2219 0.826283 11.6119 0.966283 11.0419C1.10628 10.4519 1.57628 10.0319 2.17628 9.96191C2.25628 9.96191 2.34628 9.96191 2.42628 9.96191C9.60628 9.96191 16.7863 9.96191 23.9663 9.96191C24.1063 9.96191 24.2363 9.96191 24.3863 9.96191C24.3563 9.93191 24.3463 9.91191 24.3263 9.89191C23.5863 9.15191 22.8563 8.41191 22.1163 7.68191C20.4563 6.03191 18.8063 4.37191 17.1463 2.72191C17.0563 2.63191 16.9563 2.55191 16.8763 2.45191C16.5063 2.03191 16.4063 1.55191 16.5963 1.02191C16.7763 0.49191 17.1663 0.18191 17.7163 0.0919103C18.1763 0.0219107 18.5863 0.161912 18.9163 0.491912C22.1563 3.73191 25.4063 6.98191 28.6463 10.2219C28.8163 10.3919 28.9863 10.5719 29.0863 10.8019C29.3263 11.3619 29.2063 11.9519 28.7463 12.4119C28.0663 13.0919 27.3863 13.7719 26.6963 14.4619C24.0963 17.0619 21.4963 19.6619 18.8863 22.2619C18.6563 22.4919 18.3763 22.6519 18.0463 22.6819C18.0363 22.6819 18.0163 22.7019 18.0063 22.7119C17.9263 22.7119 17.8363 22.7119 17.7563 22.7119L17.7663 22.7119Z" fill="#C1210D"/>
                        </svg>
                    </button> -->
                    <button type="button" class="btn btn-outline-primary slide-button right-center position-absolute" id="avatar-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="0 0 30 23" fill="none">
                            <path d="M17.7663 22.7119C17.7663 22.7119 17.7063 22.6819 17.6763 22.6819C16.9863 22.5719 16.4863 22.0319 16.4663 21.3319C16.4563 20.9319 16.6063 20.5819 16.8863 20.2919C16.9163 20.2519 16.9563 20.2219 16.9963 20.1819C19.4363 17.7419 21.8763 15.3019 24.3163 12.8619C24.3363 12.8419 24.3563 12.8219 24.3863 12.7819C24.3463 12.7819 24.3263 12.7819 24.2963 12.7819C23.1463 12.7819 21.9963 12.7819 20.8463 12.7819C14.7163 12.7819 8.57628 12.7819 2.44628 12.7819C2.13628 12.7819 1.82628 12.7319 1.56628 12.5519C1.07628 12.2219 0.826283 11.6119 0.966283 11.0419C1.10628 10.4519 1.57628 10.0319 2.17628 9.96191C2.25628 9.96191 2.34628 9.96191 2.42628 9.96191C9.60628 9.96191 16.7863 9.96191 23.9663 9.96191C24.1063 9.96191 24.2363 9.96191 24.3863 9.96191C24.3563 9.93191 24.3463 9.91191 24.3263 9.89191C23.5863 9.15191 22.8563 8.41191 22.1163 7.68191C20.4563 6.03191 18.8063 4.37191 17.1463 2.72191C17.0563 2.63191 16.9563 2.55191 16.8763 2.45191C16.5063 2.03191 16.4063 1.55191 16.5963 1.02191C16.7763 0.49191 17.1663 0.18191 17.7163 0.0919103C18.1763 0.0219107 18.5863 0.161912 18.9163 0.491912C22.1563 3.73191 25.4063 6.98191 28.6463 10.2219C28.8163 10.3919 28.9863 10.5719 29.0863 10.8019C29.3263 11.3619 29.2063 11.9519 28.7463 12.4119C28.0663 13.0919 27.3863 13.7719 26.6963 14.4619C24.0963 17.0619 21.4963 19.6619 18.8863 22.2619C18.6563 22.4919 18.3763 22.6519 18.0463 22.6819C18.0363 22.6819 18.0163 22.7019 18.0063 22.7119C17.9263 22.7119 17.8363 22.7119 17.7563 22.7119L17.7663 22.7119Z" fill="#C1210D"/>
                        </svg>
                    </button>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    @if(isset($arrayData['FirstName']))
                                        <h1 class="display-4 text-white font-normal pb-3 fw-bold">Nice to meet you, {{ $arrayData['FirstName'] }}</h1>
                                    @else 
                                        <h1 class="display-4 text-white font-normal pb-3 fw-bold">Nice to meet you.</h1>
                                    @endif
                                    <p class="text-white display-6 lh-base">Please click to select your gender.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2">
                                    <div class="col-12 button-bg {{$gender === 'male' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['gender']) && $arrayData['gender'] === 'male') default @endif" data-avatar="Male" data-required="" id="gendermale">
                                                <img src="{{ asset('images/avatar-gender-selection/button-gender-male.png') }}" width="200px" alt="Gender Male">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Male</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2">
                                    <div class="col-12 button-bg {{$gender === 'female' ? 'selected' : ''}}">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['gender']) && $arrayData['gender'] === 'female') default @endif" data-avatar="Female" data-required="" id="genderfemale">
                                                <img src="{{ asset('images/avatar-gender-selection/button-gender-female.png') }}" width="200px" alt="Gender Female">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Female</p>
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
                                    <a href="{{route('avatar.welcome')}}" class="btn btn-outline-primary flex-fill text-uppercase me-md-2">Back</a>
                                    <a href="{{ route('identity.details') }}" class="btn btn-primary flex-fill text-uppercase" data-url="avatar.family.dependant">Next</a>
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
// Pass the values to app.js to change the image of the avatar according to the gender selected
const routeChangeImage = '{{ route('change.image') }}';
const csrfToken = '{{ csrf_token() }}';

const avatar = document.getElementById('avatar-clothes');
const btnLeft = document.getElementById('avatar-left');
const btnRight = document.getElementById('avatar-right');

const svgFileNames = ['male-1', 'male-2', 'male-3', 'male-4', 'male-5']; // Add more SVG file names as needed
let currentIndex = 0;

const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
dataAvatarButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the button click

        // Remove 'selected' attribute from all buttons
        dataAvatarButtons.forEach(btn => btn.removeAttribute('data-required'));
        // Add 'selected' attribute to the clicked button
        this.setAttribute('data-required', 'selected');
        // Store the selected data-avatar value
        selectedGender = this.getAttribute('data-required');
        selectedGenderValue = this.getAttribute('data-avatar');

        var imageSrc = selectedGenderValue === 'Female' ? 'gender-female' : 'gender-male';

        // Update the image source
        avatar.attr('src', '{{ asset("/images/avatar-general/") }}' + imageSrc + '-1.svg');

        // Update the image source based on the selected gender and index
        updateAvatarSource();
        
    });
});

// Function to update the avatar image source based on gender and index
function updateAvatarSource() {
    const prefix = selectedGenderValue === 'Female' ? 'fe' : '';
    // const newImageSrc = "{{ asset('/images/avatar-general') }}" + "/" + prefix + svgFileNames[currentIndex];
    const newImageSrc = "{{ asset('/images/avatar-general/gender-') }}" + prefix + svgFileNames[currentIndex] + ".svg";
    avatar.setAttribute('src', newImageSrc);
}

// Attach event listeners for sliding buttons
btnLeft.addEventListener('click', function() {
    currentIndex = (currentIndex - 1 + svgFileNames.length) % svgFileNames.length;
    const newImageSrc = "{{ asset('/images/avatar-general/gender-') }}" + svgFileNames[currentIndex] + ".svg";
    avatar.setAttribute('src', newImageSrc);
    updateAvatarSource();
});

btnRight.addEventListener('click', function() {
    currentIndex = (currentIndex + 1) % svgFileNames.length;
    const newImageSrc = "{{ asset('/images/avatar-general/gender-') }}" + svgFileNames[currentIndex] + ".svg";
    avatar.setAttribute('src', newImageSrc);
    updateAvatarSource();
});

// $(document).ready(function() {
//   $('.gendercolor').click(function() {
//     var color = $(this).data('color'); // Get the color from the data attribute of the clicked button

//     // Send an AJAX request to trigger the changeImage method and update the SVG
//     $.ajax({
//       url: '{{ route('changeImage') }}',
//       type: 'POST',
//       data: {
//         color: color
//       },
//       headers: {
//         'X-CSRF-TOKEN': '{{ csrf_token() }}'
//         }
//     });
//   });
// });

// $(document).ready(function() {
//   $('.gendercolor').click(function() {
//     var color = $(this).data('color'); // Get the color from the data-color attribute of the clicked button
//     // var secondaryColor = $(this).data('secondary-color'); // Get the secondary color from the data-secondary-color attribute of the clicked button

//     // Send an AJAX request to trigger the changeImage method and update the SVG
//     $.ajax({
//       url: '{{ route('changeImage') }}',
//       type: 'POST',
//       data: {
//         color: color,
//         // secondaryColor: secondaryColor // Include the secondaryColor in the AJAX request data
//       },
//       headers: {
//         'X-CSRF-TOKEN': '{{ csrf_token() }}'
//         }

//         success: function(response) {
//         alert(response.message);

//         // Update the SVG image with the modified image URL
//         var imageElement = $('.changeImage'); // Assuming you have an image element with the class "changeImage"
//         imageElement.attr('src', response.image);

//         // Optionally, you can perform additional actions here
//       },
//       error: function(xhr, status, error) {
//         // Handle any errors that occur during the request
//         console.error(xhr.responseText);
//       }
//     });
//   });
// });

</script>

@endsection