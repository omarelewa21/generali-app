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
                        <img src="{{ asset('images/avatar/avatar-' . session('image') . '.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form novalidate action="{{ route('form.submit.identity') }}" method="POST">
                        @csrf
                        <section class="main-content scrollable-padding-avatar">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5">
                                    <div class="col-12">
                                        <h4 class="display-4 text-white font-normal pb-3 fw-bold">Now let’s get into the details.</h4>
                                        <p class="text-white display-6 lh-base">*All fields are mandatory, so we can make the best recommendations for you.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-sm-5">
                                    <div class="col-12">
                                        <label for="country" class="form-label text-white">Citizenship:</label>
                                        <select class="form-select bg-white @error('country') is-invalid @enderror" name="country" aria-label="Countries" id="countrySelect" required>
                                            <option value="" selected disabled>Select</option>
                                            @foreach($countries as $code => $name)
                                                <option value="{{ $code }}" @if(old('country') == $code) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback text-white">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 pt-4">
                                        <label for="idType" class="form-label text-white">ID Type</label>
                                        <select name="idType" class="form-select bg-white @error('idType') is-invalid @enderror" aria-label="ID Type" id="idTypeTest" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="New IC" @if(old('idType') == 'New IC') selected @endif>New IC</option>
                                            <option value="Passport" @if(old('idType') == 'Passport') selected @endif>Passport</option>
                                            <option value="Birth Certificate" @if(old('idType') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                            <option value="Police / Army" @if(old('idType') == 'Police / Army') selected @endif>Police / Army</option>
                                            <option value="Registration" @if(old('idType') == 'Registration') selected @endif>Registration</option>
                                        </select>
                                        @error('idType')
                                            <div class="invalid-feedback text-white">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 pt-4">
                                        <label for="idNumber" class="form-label text-white">ID Number:</label>
                                        <input type="number" name="idNumber" class="form-control bg-white @error('idNumber') is-invalid @enderror" id="idNumber" placeholder="xxxxxx-xx-xxxx" value="{{ old('idNumber') }}" autocomplete="off" required>
                                        @error('idNumber')
                                            <div class="invalid-feedback text-white">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 pt-4">
                                        <label for="dob" class="form-label">Date of Birth: (Age)</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-select bg-white" aria-label="00">
                                                    <option selected>Select</option>
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-select bg-white" aria-label="00">
                                                    <option selected>Select</option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-select bg-white" aria-label="00">
                                                    <option selected>Select</option>
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                        <a href="{{route('avatar.gender.selection')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                        <button class="btn btn-primary text-uppercase" type="submit">Next</button>
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
@endsection