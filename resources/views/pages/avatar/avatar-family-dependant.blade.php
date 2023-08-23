<?php
 /**
 * Template Name: Family Dependant Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $familyDependant = isset($arrayData['familyDependant']) ? json_encode($arrayData['familyDependant']) : '';
@endphp

<div id="avatar_family_dependant" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default px-0">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-design-placeholder content-avatar-default overflow-auto overflow-hidden">
                    <div class="avatar-bg position-relative imageContainerParents"></div>
                    <div class="avatar-bg position-relative imageContainerSpouse">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male-no-shadow.svg') }}" width="auto" height="98%" alt="Main character" class="changeImage position-absolute" style="left:40px">
                    </div>
                    <div class="avatar-bg position-relative imageContainerChildren"></div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form action="{{ route('handle.avatar.selection') }}" method="post" class="buttonForm">
                    @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-3 fw-bold">Great, now let’s get to know your family. </h1>
                                        <p class="text-white display-6 lh-base">Click to select your family details.</p>
                                    </div>
                                </div>
                                <div class="row px-4 pb-4 px-sm-5">
                                    @if ($errors->has('familyDependantButtonInput'))
                                        <div class="col-12">
                                            <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class="text">{{ $errors->first('familyDependantButtonInput') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'spouse' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 @if(isset($arrayData['familyDependant']) && in_array('spouse', $arrayData['familyDependant'])) default @endif" data-avatar="spouse" data-required="" id="spouseButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/spouse-icon.png') }}" width="auto" height="100px" alt="Spouse">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Spouse</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'children' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 @if(isset($arrayData['familyDependant']) && in_array('child_1', $arrayData['familyDependant'])) default @endif" data-avatar="children" data-required="" id="childButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/children-icon.png') }}" width="auto" height="100px" alt="Child(ren)">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Child(ren)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'parents' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0 @if(isset($arrayData['familyDependant']) && in_array('parent_1', $arrayData['familyDependant'])) default @endif" data-avatar="parents" data-required="" id="parentButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/parents-icon.png') }}" width="auto" height="100px" alt="Parent(s)">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Parent(s)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                        <div class="col-12 button-bg {{$familyDependant === 'siblings' ? 'selected' : ''}}">
                                            <div class="col-12 py-4 d-flex align-items-center justify-content-center hover border-default">
                                                <button class="border-0" data-avatar="siblings" data-required="" id="siblingButton">
                                                    <img src="{{ asset('images/avatar-family-dependant/siblings-icon.png') }}" width="auto" height="100px" alt="Sibling(s)">
                                                    <p class="avatar-text text-center pt-4 mb-0 fw-bold">Sibling(s)</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <section class="footer bg-accent-light-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="familyDependantButtonInput" id="familyDependantButtonInput" value="{{$familyDependant}}">
                                        <input type="hidden" name="urlInput" id="urlInput" value="avatar.family.dependant.details">
                                        <a href="{{route('avatar.marital.status')}}" class="btn btn-primary flex-fill text-uppercase me-md-2">Back</a>
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

<script>
// Manually convert the PHP array to JSON
var passingArrays = {!! json_encode(session('passingArrays')) !!};

// Access the elements of the array in JavaScript
var maritalStatus = passingArrays.maritalStatus;

// Disable the 'Spouse' button if maritalStatus is 'single'
if (maritalStatus === 'single') {
    const spouseButton = document.getElementById('spouseButton');
    const childButton = document.getElementById('childButton');
    spouseButton.disabled = true;
    childButton.disabled = true;

    // Remove hover effect if it is disabled
    const spouseParentDiv = spouseButton.parentElement;
    const childParentDiv = childButton.parentElement;
    spouseParentDiv.classList.remove('hover');
    childParentDiv.classList.remove('hover');

    const spouseImg = spouseButton.querySelector('img');
    const childImg = childButton.querySelector('img');
    spouseImg.style.opacity = '0.5'; 
    childImg.style.opacity = '0.5'; 

} else if (maritalStatus === 'divorced' || maritalStatus === 'widowed') {
    const spouseButton = document.getElementById('spouseButton');
    spouseButton.disabled = true;
}

const spouseButton = document.getElementById('spouseButton');
const childButton = document.getElementById('childButton');
const parentButton = document.getElementById('parentButton');
const siblingButton = document.getElementById('siblingButton');
const nextButton = document.getElementById('nextButton');
const familyDependantButtonInput = document.getElementById('familyDependantButtonInput');
const clickedAvatars = [];

let childClickCount = 0;
let parentClickCount = 0;
let siblingClicked = false;
let spouseClicked = false;

childButton.addEventListener('click', function(event) {
    event.preventDefault();

    childClickCount++;

    if (childClickCount <= 2) {
        const dataAvatar = `child_${childClickCount}`;
        clickedAvatars.push(dataAvatar);
        familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
    }
});

parentButton.addEventListener('click', function(event) {
    event.preventDefault();

    parentClickCount++;

    if (parentClickCount <= 2) {
        const dataAvatar = `parent_${parentClickCount}`;
        clickedAvatars.push(dataAvatar);
        familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
    }
});

siblingButton.addEventListener('click', function(event) {
    event.preventDefault();

    if (!siblingClicked) {
        const dataAvatar = 'sibling';
        clickedAvatars.push(dataAvatar);
        familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
        siblingClicked = true;
    }
});

spouseButton.addEventListener('click', function(event) {
    event.preventDefault();

    if (!spouseClicked) {
        const dataAvatar = 'spouse';
        clickedAvatars.push(dataAvatar);
        familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
        spouseClicked = true;
    }
});

</script>

@endsection