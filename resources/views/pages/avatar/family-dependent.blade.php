<?php
 /**
 * Template Name: Family Dependent Page
 */
?>

@extends('templates.master')

@section('title')
<title>Family Dependent</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $familyDependent = session('customer_details.family_details');
    $transactionId = session('transaction_id') ?? ($_GET['transaction_id'] ?? null);
@endphp

<div id="avatar_family_dependent">
    <div class="container-fluid">
        <div class="row parallax-section">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar-default px-0 order-md-1 order-sm-2 order-2 parallax-inner parallax-bottom">
                <div class="header">
                    <div class="row">
                        @include('templates.nav.nav-red-white-menu')
                    </div>
                </div>
                <section class="avatar-design-placeholder content-avatar-default overflow-hidden">
                    <div class="col-12 position-relative text-center d-flex justify-content-center imageContainerParents"></div>
                    <div class="col-12 position-relative text-center d-flex justify-content-center imageContainerSpouse">
                        <div id="lottie-animation"></div>
                        <div class="imageContainerMarried"></div>
                    </div>
                    <div class="col-12 position-relative text-center d-flex justify-content-center imageContainerChildren"></div>
                </section>
                <div class="bottomObeserver"></div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section parallax-inner parallax-top">
                <div class="scrollable-content">
                    <form action="{{ route('handle.avatar.selection') }}" method="post" class="buttonForm">
                    @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-3 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-md-3 fw-bold">Great, now let’s get to know your family.</h1>
                                        <p class="text-white display-6">Click to select your family details.</p>
                                    </div>
                                </div>
                                <div class="row px-4 px-md-5">
                                    @if ($errors->has('familyDependentButtonInput'))
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('familyDependentButtonInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row px-4 px-md-5 pb-md-5 action_button_slider">
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if (isset($familyDependent['spouse']) && $familyDependent['spouse'] === true) default @endif" data-avatar="spouse" data-required="" id="spouseButton">
                                                    <img src="{{ asset('images/family-dependent/spouse-icon.webp') }}" width="100%" alt="Spouse" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Spouse</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($familyDependent['children']) && $familyDependent['children'] === true) default @endif" data-avatar="children" data-required="" id="childButton" data-bs-toggle="modal" data-bs-target="#childrenAvatars">
                                                    <img src="{{ asset('images/family-dependent/children-icon.webp') }}" width="100%" alt="Child(ren)" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Child(ren)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($familyDependent['parents']) && $familyDependent['parents'] === true) default @endif" data-avatar="parents" data-required="" id="parentButton" data-bs-toggle="modal" data-bs-target="#parentAvatars">
                                                    <img src="{{ asset('images/family-dependent/parents-icon.webp') }}" width="100%" alt="Parent(s)" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Parent(s)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect py-2 px-2 inner_action_button">
                                        <div class="col-12 button-bg">
                                            <div class="col-12 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 w-100 py-4 @if(isset($familyDependent['siblings']) && $familyDependent['siblings'] === true) default @endif" data-avatar="siblings" data-required="" id="siblingButton">
                                                    <img src="{{ asset('images/family-dependent/siblings-icon.webp') }}" width="100%" alt="Sibling(s)" class="mx-auto">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Sibling(s)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center px-5 pb-md-5 mt-3 mx-auto mb-3 d-none w-75">
                                    <button type="button" class="slick-btns me-3 slick-prev">Prev</button>
                                    <div class="slick-scrollbar"></div>
                                    <button type="button" class="slick-btns ms-3 slick-next">Next</button>
                                </div>
                            </div>
                        </section>
                        
                        <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="familyDependentButtonInput" id="familyDependentButtonInput" value="{{ json_encode($familyDependent) }}">
                                        @if ((!isset($familyDependent['spouse']) || $familyDependent['spouse'] === false) && (!isset($familyDependent['children']) || $familyDependent['children'] === false) && (!isset($familyDependent['parents']) || $familyDependent['parents'] === false) && (!isset($familyDependent['siblings']) || $familyDependent['siblings'] === false))
                                            <input type="hidden" name="urlInput" id="urlInput" value="assets">
                                        @else
                                            <input type="hidden" name="urlInput" id="urlInput" value="family.dependent.details">
                                        @endif
                                        <a href="{{route('marital.status')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
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

<!-- Modal -->
<div class="modal fade" id="parentAvatars" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="parentAvatarsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end px-3 py-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header px-md-5 pt-2 pb-0">
                <h3 class="modal-title text-center text-uppercase otherModalText" id="parentAvatarsLabel">Parent(s)</h3>
            </div>
            <div class="modal-body text-center text-center px-5 pt-5 bg-primary">
                <select name="parents" class="form-select bg-white @error('parents') is-invalid @enderror" aria-label="Parents" id="parentsSelect" required>
                    <option value="noParents">No parents</option> 
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="both">Both Parents</option>
                </select>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar btn-exit-parent" data-bs-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="childrenAvatars" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="childrenAvatarsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end px-3 py-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header px-md-5 pt-2 pb-0">
                <h3 class="modal-title text-center text-uppercase otherModalText" id="childrenAvatarsLabel">Child(ren)</h3>
            </div>
            <div class="modal-body text-center text-center px-5 pt-5 bg-primary">
                <select name="children" class="form-select bg-white @error('children') is-invalid @enderror" aria-label="Children" id="childrenSelect" required>
                    <option value="noChildren">No children</option>    
                    @for ($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar btn-exit-children" data-bs-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="missingFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingFieldsLabel">Marital status is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to fill up the form in Marital Status page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
    var marital_status = {!! json_encode(session('customer_details.identity_details.marital_status')) !!};
    var spouse_session = {!! json_encode(session('customer_details.family_details.spouse')) !!};
    var gender_session = {!! json_encode(session('customer_details.avatar.gender')) !!};   
    var avatar_session = {!! json_encode(session('customer_details.avatar.image')) !!}; 
</script>
@endsection