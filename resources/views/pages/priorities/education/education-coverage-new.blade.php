<?php
 /**
 * Template Name: Education Coverage New Page
 */
?>

@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayDataEducation = session('passingArraysEducation');
    $educationSelectedAvatar= isset($arrayDataEducation['educationSelectedAvatar']) ?
    $arrayDataEducation['educationSelectedAvatar'] : '';
@endphp

<div id="education-coverage" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 vh-100 wrapper-needs-coverage-default bg-education-home">
                <div class="header-needs-default">
                    <div class="col-lg-6 col-md-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </div>
                <section class="content-needs-default overflow-auto overflow-hidden bg-education-coverage">
                    <div class="col-12">
                        <div class="row d-flex justify-content-center align-items-center text-center">
                            <h5>I'd like to provide coverage for my:</h5>
                        </div>
                    </div>
                </section>
                <section class="footer bg-btn_bar py-4 fixed-bottom footer-needs-default">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                            <a href="{{route('education.home')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                            <button type="submit" class="btn btn-primary flex-fill text-uppercase">Next</button>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
    </div>
</div>