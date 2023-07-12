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
<div id="avatar_gender_selection" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar">
                <section class="avatar-color-palatte header-avatar d-flex justify-content-center align-items-end">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="display-6 text-dark">Pick the skin colour that’s closest to yours.</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 color-box-wrapper d-flex justify-content-center align-items-center justify-content-center">
                                <button class="col-2 color-box border-0 mx-1" style="background-color: #F5DEB3;"></button>
                                <button class="col-2 color-box border-0 mx-1" style="background-color: #F4A460;"></button>
                                <button class="col-2 color-box border-0 mx-1" style="background-color: #D2B48C;"></button>
                                <button class="col-2 color-box border-0 mx-1" style="background-color: #A0522D;"></button>
                                <button class="col-2 color-box border-0 mx-1" style="background-color: #8B4513;"></button>
                                <button class="col-2 color-box border-0 mx-1" style="background-color: #654321;"></button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="avatar-design-placeholder content-avatar pt-4">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset('images/avatar/gender-male.svg') }}" width="auto" height="100%" alt="Male Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary">
                <div class="scrollable-content">
                    <section class="main-content scrollable-padding pt-3">
                        <div class="container">
                            <div class="row px-4 py-4">
                                <div class="col-12">
                                    <h4 class="display-4 text-white font-normal pb-3">Nice to meet you,<br/>Peter</h4>
                                    <p class="text-white display-6">Please click to select your gender.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white" id="gendermale">
                                            <img src="{{ asset('images/avatar/button-gender-male.png') }}" width="150px" alt="Gender Male">
                                            <h6 class="avatar-text text-center pt-4">Male</h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white" id="genderfemale">
                                            <img src="{{ asset('images/avatar/button-gender-female.png') }}" width="150px" alt="Gender Female">
                                            <h6 class="avatar-text text-center pt-4">Female</h6>
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
                                    <a href="{{ route('avatar.marital.status') }}" class="btn btn-primary text-uppercase">Next</a>
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
// Change the image of the avatar according to the gender selected
document.addEventListener('DOMContentLoaded', function() {
    var genderMaleBtn = document.getElementById('gendermale');
    var genderFemaleBtn = document.getElementById('genderfemale');
    var changeImageElement = document.querySelector('.changeImage');

    genderMaleBtn.addEventListener('click', function() {
        changeImage('male');
    });

    genderFemaleBtn.addEventListener('click', function() {
        changeImage('female');
    });

    function changeImage(gender) {
        var formData = new FormData();
        formData.append('gender', gender);

        fetch('{{ route('change.image') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            changeImageElement.src = data.image;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
</script>
@endsection