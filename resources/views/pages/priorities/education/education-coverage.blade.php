<?php
 /**
 * Template Name: Education Coverage Page
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
    <div class="container-fluid font-color-default text-center">
        <div class="row bg-education">
            <div class="col-lg-6 col-md-12">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-lg-6 col-md-12">
                @include ('templates.nav.nav-sidebar-needs')
            </div>
        </div>
        <form novalidate action="{{route('validate.coverage.selection')}}" method="POST" id="coverage_selection" class="form-horizontal p-0 needs-validation">
            @csrf
            {{-- error message notifications --}}
            @if ($errors->has('protectionSelectedAvatar'))
            <div class="toast slide-in-from-bottom position-absolute pos-bottom-error w-100" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true" data-bs-autohide="false">
                <div class="alert alert-danger d-flex align-items-center mb-0 py-2">
                    <div class="flex-grow-1 d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                             viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <span class="mx-2 fs-18">{{ $errors->first('educationSelectedAvatar') }}</span>
                    </div>
                    <button type="button" class="btn-custom-close text-danger" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                
                </div>
            </div>
            @endif
            {{-- end of error message notifications --}}
                
            <section>
                <div class="col-12 text-dark px-0 my-4 bg-education-home">
                    <div class="row d-flex justify-content-center">
                        <div class="row position-relative py-4 py-md-5 d-flex align-items-center">
                            <h5>I'd like to provide coverage for my:</h5>
                        </div>
                        <div class="container">
                            {{-- hidden by default on desktop using JS script js/coverage-carousel.js --}}
                            <div class="prev-arrow position-absolute top-50 start-0 translate-middle-y px-4 px-md-5">
                                <i class="bi bi-arrow-left-circle text-primary"></i>
                            </div>

                            {{-- hidden by default on desktop using JS script js/coverage-carousel.js --}}
                            <div class="next-arrow position-absolute top-50 end-0 translate-middle-y px-4 px-md-5">
                                <i class="bi bi-arrow-right-circle text-primary"></i>
                            </div>
                        </div>
                        <div class="container row d-flex m-auto btn-group coverage-avatar" data-carousel="true">
                            <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                                <button
                                    class="btn border-0 bg-transparent box-shadow avatar-button {{ $educationSelectedAvatar === 'self' ? 'selected-box-shadow' : '' }}"
                                    data-type="self" id="button-self-avatar">
                                    <img src="{{ asset('images/needs/education/education-avatar/Male.png') }}" class="self-avatar"
                                        alt="self-character">
                                    <h6 class="text-center py-2">Self</h6>
                                </button>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                                <button
                                    class="btn border-0 bg-transparent box-shadow avatar-button {{ $educationSelectedAvatar === 'child-1' ? 'selected-box-shadow' : '' }}"
                                    data-type="child-1" id="button-child-1-avatar">
                                    <img src="{{ asset('images/needs/education/education-avatar/Daughter.png') }}" class="child-1"
                                        alt="child-1-character">
                                    <h6 class="text-center py-2">Child 1</h6>
                                </button>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                                <button
                                    class="btn border-0 bg-transparent box-shadow avatar-button {{ $educationSelectedAvatar === 'child-2' ? 'selected-box-shadow' : '' }}"
                                    data-type="child-2" id="button-child-2-avatar">
                                    <img src="{{ asset('images/needs/education/education-avatar/Son.png') }}" class="child-2"
                                        alt="child-2-character">
                                    <h6 class="text-center py-2">Child 2</h6>
                                </button>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                                <button
                                    class="btn border-0 bg-transparent box-shadow avatar-button {{ $educationSelectedAvatar === 'child-3' ? 'selected-box-shadow' : '' }}"
                                    data-type="child-3" id="button-child-3-avatar">
                                    <img src="{{ asset('images/needs/education/education-avatar/Kid.png') }}" class="child-3"
                                        alt="child-1-character">
                                    <h6 class="text-center py-2">Child 3</h6>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="educationSelectedAvatar" id="educationSelectedAvatarInput" value="{{$educationSelectedAvatar}}">
                        <div class="d-flex needs-grey-bg-md justify-content-center position-absolute w-100 bottom-0">
                            <div class="col-12 col-md-4 text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer bg-white py-4 fixed-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                            <a href="{{route('education.home')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                            <button type="submit" class="btn btn-primary flex-fill text-uppercase">Next</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>

<script>

// Add event listener to each button with the 'data-required' attribute
const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
dataAvatarButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the button click
    });
});

</script>

@endsection