<?php
 /**
 * Template Name: Avatar - Gender Selection Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Gender Selection</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="avatar_gender_selection" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar">
                <section class="avatar-color-palatte header-avatar d-flex justify-content-center align-items-end">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="text-dark pb-3 display-6 fw-bold">Pick the skin colour that’s closest to yours.</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 color-box-wrapper d-flex justify-content-center align-items-center justify-content-center">
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #F5DEB3;" data-color="FFAE9E"></button>
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #F4A460;" data-color="F4A460"></button>
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #D2B48C;" data-color="D2B48C"></button>
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #A0522D;" data-color="A0522D"></button>
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #8B4513;" data-color="8B4513"></button>
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #654321;" data-color="654321"></button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="avatar-design-placeholder content-avatar pt-4 overflow-auto">
                    <div class="col-12 text-center d-flex justify-content-center">
                    <img src="{{ asset('/images/avatar/avatar/' . (isset($arrayData['image']) ? $arrayData['image'] : 'gender-male') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    @if(isset($arrayData['FirstName']))
                                        <h1 class="display-4 text-white font-normal pb-3 fw-bold">Nice to meet you,<br/>{{ $arrayData['FirstName'] }}</h1>
                                    @else 
                                        <h1 class="display-4 text-white font-normal pb-3 fw-bold">Nice to meet you.</h1>
                                    @endif
                                    <p class="text-white display-6">Please click to select your gender.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white" id="gendermale">
                                            <img src="{{ asset('images/avatar/button-gender-male.png') }}" width="150px" alt="Gender Male">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Male</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-5 d-flex align-items-center justify-content-center border border-danger">
                                        <button class="border-0 bg-white" id="genderfemale">
                                            <img src="{{ asset('images/avatar/button-gender-female.png') }}" width="150px" alt="Gender Female">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Female</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                    <a href="{{route('avatar.welcome')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{ route('identity.details') }}" class="btn btn-primary text-uppercase">Next</a>
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