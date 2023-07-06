<?php
 /**
 * Template Name: Avatar - Family Dependant Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant Details</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="avatar_family_dependant" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-7 gender-selection-bg vh-100">
                <section class="avatar-design-placeholder">
                    <div class="row pt-5">
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
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-5 col-lg-5 bg-primary px-0 overflow-auto full-height-100">
                <section class="main-content py-4 px-4">
                    <div class="container">
                        <div class="row pb-4">
                            <div class="col-12">
                                <h4 class="display-4 text-white font-normal pb-3">Thanks for introducing your family!</h4>
                                <p class="text-white display-6">Tell us more about each of them.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Spouse
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="row py-2">
                                                    <div class="col-12">
                                                        <label for="firstName" class="form-label">First Name:</label>
                                                        <input type="text" class="form-control" id="firstNameInput" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-12">
                                                        <label for="lastName" class="form-label">Last Name:</label>
                                                        <input type="text" class="form-control" id="lastNameInput" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-12">
                                                        <label for="dob" class="form-label">Date of Birth: (Age)</label>
                                                        <input type="dropdown" class="form-control" id="dobInput" placeholder="0000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Child
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Parent 1
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                Parent 2
                                            </button>
                                        </h2>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="footer bg-accent-light-white py-4 position-fixed button-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('avatar.family.dependant')}}" class="btn btn-primary text-uppercase">Back</a>
                                    <a href="{{route('avatar.my.assets') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
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