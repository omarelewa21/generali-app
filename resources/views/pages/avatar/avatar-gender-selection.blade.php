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
                                <button class="col-2 color-box border-0 mx-1 gendercolor" style="background-color: #F5DEB3;" data-color="F5DEB3"></button>
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
                        <img src="{{ asset('images/avatar/' . (session('image') ? session('image') : 'gender-male') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content scrollable-padding-avatar">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5">
                                <div class="col-12">
                                    @if(isset($firstName))
                                        <h4 class="display-4 text-white font-normal pb-3 fw-bold">Nice to meet you,<br/>{{ $firstName }}</h4>
                                    @else 
                                        <h4 class="display-4 text-white font-normal pb-3 fw-bold">Nice to meet you.</h4>
                                    @endif
                                    <p class="text-white display-6">Please click to select your gender.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white" id="gendermale">
                                            <img src="{{ asset('images/avatar/button-gender-male.png') }}" width="150px" alt="Gender Male">
                                            <h6 class="avatar-text text-center pt-4">Male</h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 py-1">
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
</script>

@endsection