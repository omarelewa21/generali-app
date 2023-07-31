<?php
 /**
 * Template Name: Priorities To Discuss Page
 */
?>

@extends('templates.master')

@section('title')
<title>Priorities To Discuss</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="priorities_to_discuss" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4">
                    <div class="col-12 text-center">
                        <h4 class="fw-bold">I'd like to figure out future plans for these:</h4>
                        <img src="{{ asset('/images/top-priorities/priorities-grid.png') }}" width="500px" class="mx-auto d-block pt-4" alt="">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white fw-bold pb-3">Let's go through what you'd like to discuss.</h1>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accordionPriorities">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                    <img src="{{ asset('images/top-priorities/protection-icon.svg') }}" width="60px" height="auto" alt="Protection" class="pe-4"> Protection
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionPriorities">
                                                <div class="accordion-body">
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultDiscuss">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    <img src="{{ asset('images/top-priorities/retirement-icon.svg') }}" width="60px" height="auto" alt="Retirement" class="pe-4"> Retirement
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionPriorities">
                                                <div class="accordion-body">
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultDiscuss">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    <img src="{{ asset('images/top-priorities/education-icon.svg') }}" width="60px" height="auto" alt="Education" class="pe-4"> Education
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionPriorities">
                                                <div class="accordion-body">
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultDiscuss">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                    <img src="{{ asset('images/top-priorities/savings-icon.svg') }}" width="60px" height="auto" alt="Savings" class="pe-4"> Savings
                                                </button>
                                            </h2>
                                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionPriorities">
                                                <div class="accordion-body">
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultDiscuss">
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
                                    <a href="{{route('top.priorities')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('protection.home') }}" class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#accordionPriorities .form-check-reverse {
    text-align:left;
}
</style>
@endsection