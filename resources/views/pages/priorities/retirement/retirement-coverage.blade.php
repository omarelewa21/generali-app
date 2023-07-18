<?php
 /**
 * Template Name: Protection Homepage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Retirement - Coverage</title>
@endsection

@section('content')

<div id="retirement_coverage" class="vh-100">

    <div class="container-fluid p-0">
        @include('templates.nav.nav-red-menu')
        <div class="row">
            @include ('templates.nav.nav-sidebar-needs')
            <div class="col-12 text-dark px-0 retirement-coverage">
                <div class="vh-100 overflow-auto">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                            <h5>I’d like to provide coverage for my:</h5>
                            </div>
                        </div>
                        <div class="row position-relative" id="coverage-avatar">
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/self.svg') }}" style="width:100px"
                                    alt="self-character">
                                <h6 class="text-center py-2">Self</h6>
                            </div>
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/spouse.svg') }}" style="width:100px"
                                    alt="spouse">
                                <h6 class="text-center py-2">Spouse</h6>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/kid.svg') }}" style="width:100px" alt="kid">
                                <h6 class="text-center py-2">Child(ren)</h6>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/parent.svg') }}" style="width:200px"
                                    alt="parent">
                                <h6 class="text-center py-2">Parent</h6>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="row bg-accent-bg-grey text-center justify-content-center">

                        </div>
                    </section>
                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.home')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('retirement.home') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @endsection