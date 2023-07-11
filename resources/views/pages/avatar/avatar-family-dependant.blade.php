<?php
 /**
 * Template Name: Avatar - Family Dependant Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="avatar_family_dependant" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <div class="col-12 position-relative">
                            <div class="position-absolute male-avatar-character" style="z-index:1">
                                <img src="{{ asset('images/avatar/male-avatar.svg') }}" width="350px" alt="Male Avatar">
                            </div>
                            <div class="position-absolute parent-father">
                                <img src="{{ asset('images/avatar/parent-father.svg') }}" width="500px" alt="Parent Father Avatar">
                            </div>
                            <div class="position-absolute parent-mother">
                                <img src="{{ asset('images/avatar/parent-mother.svg') }}" width="156px" alt="Parent Mother Avatar">
                            </div>
                            <div class="position-absolute spouse">
                                <img src="{{ asset('images/avatar/spouse.svg') }}" width="270px" alt="Spouse Avatar">
                            </div>
                            <div class="position-absolute children-girl" style="z-index:1">
                                <img src="{{ asset('images/avatar/children-girl.svg') }}" width="150px" alt="Girl Avatar">
                            </div>
                            <div class="position-absolute children-boy">
                                <img src="{{ asset('images/avatar/children-boy.svg') }}" width="150px" alt="Boy Avatar">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary">
                <div class="scrollable-content">
                    <section class="main-content scrollable-padding">
                        <div class="container">
                            <div class="row px-4 py-4">
                                <div class="col-12">
                                    <h4 class="display-4 text-white font-normal pb-3">Great, now let’s get to know your family. </h4>
                                    <p class="text-white display-6">Click to select your family details.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/spouse-icon.svg') }}" width="150px" height="100px" alt="Spouse">
                                            <h6 class="avatar-text text-center pt-4">Spouse</h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/children-icon.svg') }}" width="150px" height="100px" alt="Child(ren)">
                                            <h6 class="avatar-text text-center pt-4">Child(ren)</h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect pe-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/parents-icon.svg') }}" width="150px" height="100px" alt="Parent(s)">
                                            <h6 class="avatar-text text-center pt-4">Parent(s)</h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 text-dark fade-effect ps-xxl-1 py-1">
                                    <div class="col-12 bg-white py-4 d-flex align-items-center justify-content-center">
                                        <button class="border-0 bg-white">
                                            <img src="{{ asset('images/avatar/siblings-icon.svg') }}" width="150px" height="100px" alt="Sibling(s)">
                                            <h6 class="avatar-text text-center pt-4">Sibling(s)</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('avatar.marital.status')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('avatar.family.dependant.details') }}" class="btn btn-primary text-uppercase">Next</a>
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