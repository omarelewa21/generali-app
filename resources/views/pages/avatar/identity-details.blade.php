<?php
 /**
 * Template Name: Avatar - Identity Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Identity Details</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="identity_details" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <img src="{{ asset('images/avatar/male-avatar.svg') }}" width="350px" alt="Male Avatar">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary">
                <div class="scrollable-content">
                    <section class="main-content scrollable-padding">
                        <div class="container">
                            <div class="row px-4 py-4">
                                <div class="col-12">
                                    <h4 class="display-4 text-white font-normal pb-3">Now let’s get into the details.</h4>
                                    <p class="text-white display-6">*All fields are mandatory, so we can make the best recommendations for you.</p>
                                </div>
                            </div>
                            <div class="row px-4 py-3">
                                <div class="col-12">
                                    <label for="firstName" class="form-label text-white">Citizenship:</label>
                                    <select class="form-select bg-white" aria-label="00">
                                        <option selected>Select</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row px-4 py-3">
                                <div class="col-12">
                                    <label for="firstName" class="form-label text-white">ID Type:</label>
                                    <select class="form-select bg-white" aria-label="00">
                                        <option selected>Select</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row px-4 py-3">
                                <div class="col-12">
                                    <label for="firstName" class="form-label text-white">ID Number:</label>
                                    <select class="form-select bg-white" aria-label="00">
                                        <option selected>Select</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('avatar.my.assets')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('top.priorities') }}" class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection