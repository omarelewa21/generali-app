<?php
 /**
 * Template Name: Basic Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Basic Details</title>
@endsection

@section('content')

<div id="basic_details" class="vh-100">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-5 py-xxl-5 py-xl-5 py-lg-5 py-md-5 py-sm-3 py-3">
                    <h4 class="display-5 font-bold fw-bold">Hello! Let's get to know you better.</h4>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey text-dark">
                <div class="vh-100 overflow-y-auto overflow-x-hidden">
                    <section class="main-content scrollable-padding">
                        <div class="container">
                            <div class="row pt-4 px-5 pb-3 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-4 sticky-top bg-accent-bg-grey">
                                <div class="col-12">
                                    <h1 class="display-3 text-uppercase">Do introduce yourself.</h1>
                                </div>
                            </div>
                            <div class="row px-5 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="title" class="form-label">Title</label>
                                            <select class="form-select" aria-label="Title">
                                                <option selected>Select</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Madam">Madam</option>
                                                <option value="Datuk">Datuk</option>
                                                <option value="Datin">Datin</option>
                                                <option value="Dato Seri">Dato Seri</option>
                                                <option value="Datin Seri">Datin Seri</option>
                                                <option value="Tan Sri">Tan Sri</option>
                                                <option value="Puan Sri">Puan Sri</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Tun">Tun</option>
                                                <option value="Sir">Sir</option>
                                                <option value="Justice">Justice</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-5">
                                            <label for="firstName" class="form-label">First Name:</label>
                                            <input type="text" class="form-control" id="firstNameInput" placeholder="First Name">
                                        </div>
                                        <div class="col-md-6 mt-5">
                                            <label for="lastName" class="form-label">Last Name:</label>
                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-5">
                                            <label for="mobileNumber" class="form-label">Mobile Number:</label>
                                            <input type="text" class="form-control" id="mobileNumber" placeholder="+60 00-000 000">
                                        </div>
                                        <div class="col-md-6 mt-5">
                                            <label for=housePhoneNumber" class="form-label">House Phone Number:</label>
                                            <input type="text" class="form-control" id="housePhoneNumber"
                                                placeholder="+60 00-000 000">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-5">
                                            <label for="email" class="form-label">Email Address:</label>
                                            <input type="text" class="form-control" id="email" placeholder="yourname@email.com">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('pdpa.disclosure')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('avatar.welcome') }}" class="btn btn-primary text-uppercase">Next</a>
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