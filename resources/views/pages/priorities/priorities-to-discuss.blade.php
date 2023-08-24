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
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>    
                <section class="avatar-design-placeholder content-avatar-default">
                <div class="col-12 text-center position-relative">
                        <h4 class="fw-bold">Here's how I see my priorities:</h4>

                        <div id="sortable" class="position-relative pt-3">
                            <div class="svg-container first">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 166 138" fill="none">
                                        <path d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">1</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="svg-container second">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190 180" fill="none">
                                        <path d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">2</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="svg-container third">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 187 191" fill="none">
                                        <path d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="55%" y="55%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">3</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="svg-container fourth">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152 167" fill="none">
                                        <path d="M151.489 147.333C118.661 147.333 87.4099 154.078 59.0512 166.266L0.950684 30.6854C47.1751 10.9411 98.0516 0 151.477 0V147.333H151.489Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="60%" y="50%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">4</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="svg-container fifth">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 154 168" fill="none">
                                        <path d="M153.329 31.2456L94.4173 166.472C65.9329 154.158 34.5108 147.333 1.49997 147.333H1.48853V0H1.49997C55.4398 0 106.762 11.1583 153.329 31.2456Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="45%" y="50%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">5</text>
                                    </svg>
                                </div>
                        
                            </div>
                            <div class="svg-container sixth">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 188 192" fill="none">
                                        <path d="M187.104 89.929L78.7096 190.525C57.0262 167.649 30.7706 149.139 1.41748 136.472L60.3296 1.24561C108.486 22.0188 151.555 52.3726 187.104 89.929Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="47%" y="55%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">6</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="svg-container seventh">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190 179" fill="none">
                                        <path d="M188.39 123.625L50.0827 177.679C38.961 149.166 22.4099 123.351 1.70947 101.526L110.104 0.929199C143.469 36.1648 170.239 77.7226 188.39 123.625Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">7</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="svg-container eight">
                                <div class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 166 139" fill="none">
                                        <path d="M166 131.42L17.051 138.988C16.811 109.618 11.1758 81.5276 1.08276 55.6783L139.39 1.62451C155.358 41.9819 164.674 85.7006 166 131.42Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">8</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 position-absolute" style="bottom: -60%;">
                            <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                        </div>
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
                            <div class="row px-4 pb-2 px-sm-5">
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
                                                        <div class="col-md-9">
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                        </div>
                                                        <div class="col-md-3 form-check form-switch form-check-reverse d-flex p-0">
                                                            <label class="form-check-label display-6 toggle-label toggle-label-left" for="flexSwitchCheckDefaultCovered">NO</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                            <label class="form-check-label display-6 toggle-label toggle-label-right" for="flexSwitchCheckDefaultCovered">YES</label>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
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
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
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
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
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
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultCovered">I've got this covered</label>
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefaultCovered">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 px-3">
                                                        <div class="col-12 form-check form-switch form-check-reverse">
                                                            <label class="form-check-label display-6" for="flexSwitchCheckDefaultDiscuss">I'd like to discuss this</label>
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
.toggle-label-left {
    order: 1; /* Position the NO label first */
}

.toggle-label-right {
    order: 3; /* Position the YES label last */
}

.form-check-input {
    order: 2; /* Position the checkbox in the middle */
}


</style>
@endsection