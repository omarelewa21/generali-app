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

<div id="identity_details" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-7 gender-selection-bg vh-100">
                <section class="avatar-design-placeholder">
                    <div class="row pt-5">
                        <div class="col-12 text-center d-flex justify-content-center">
                            <img src="{{ asset('images/avatar/male-avatar.svg') }}" width="350px" alt="Male Avatar">
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-5 col-lg-5 bg-primary px-0 overflow-auto full-height-100">
                <section class="main-content py-4 px-4">
                    <div class="container">
                        <div class="row pb-4">
                            <div class="col-12">
                                <h4 class="display-4 text-white font-normal pb-3">Now let’s get into the details.</h4>
                                <p class="text-white display-6">*All fields are mandatory, so we can make the best recommendations for you.</p>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-12">
                                <label for="firstName" class="form-label">Citizenship:</label>
                                <input type="text" class="form-control" id="firstNameInput" placeholder="First Name">
                            </div>
                        </div>
                    </div>
                </section>
        
                <section class="footer bg-accent-light-white py-4 position-fixed button-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('avatar.my.assets')}}" class="btn btn-primary text-uppercase">Back</a>
                                    <a href="{{route('top.priorities') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection