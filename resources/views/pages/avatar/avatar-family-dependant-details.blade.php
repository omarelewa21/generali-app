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

<div id="avatar_family_dependant" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center d-flex justify-content-center">
                        <div class="col-12 position-relative">
                            <div class="position-absolute male-avatar-character">
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
                            <div class="position-absolute children-girl">
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
                                    <h4 class="display-4 text-white font-normal pb-3">Thanks for introducing your family!</h4>
                                    <p class="text-white display-6">Tell us more about each of them.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accordionDependantDetails">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                    Spouse
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionDependantDetails">
                                                <div class="accordion-body">
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">First Name:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="lastName" class="form-label">Last Name:</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="dob" class="form-label">Date of Birth: (Age)</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
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
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Years of Support:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Dependent Marital Status:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
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
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionDependantDetails">
                                                <div class="accordion-body">
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">First Name:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="lastName" class="form-label">Last Name:</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="dob" class="form-label">Date of Birth: (Age)</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
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
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Years of Support:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Dependent Marital Status:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    Parent 1
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionDependantDetails">
                                                <div class="accordion-body">
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">First Name:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="lastName" class="form-label">Last Name:</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="dob" class="form-label">Date of Birth: (Age)</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
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
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Years of Support:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Dependent Marital Status:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                    Parent 2
                                                </button>
                                            </h2>
                                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionDependantDetails">
                                                <div class="accordion-body">
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">First Name:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="lastName" class="form-label">Last Name:</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="dob" class="form-label">Date of Birth: (Age)</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select class="form-select" aria-label="00">
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
                                                                    <select class="form-select" aria-label="00">
                                                                        <option selected>Select</option>
                                                                        <option value="00">00</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Years of Support:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <label for="firstName" class="form-label">Dependent Marital Status:</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('avatar.family.dependant')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('avatar.my.assets') }}" class="btn btn-primary text-uppercase">Next</a>
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