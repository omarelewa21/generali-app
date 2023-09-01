<?php
 /**
 * Template Name: Education Supporting Years
 */
?>
@extends('templates.master')

@section('title')
<title>Education - Supporting Years</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayDataEducation = session('passingArrays');
    $educationSelectedAvatar = isset($arrayDataEducation['educationSelectedAvatar']) ? $arrayDataEducation['educationSelectedAvatar'] : '';
    $educationSelectedImage = isset($arrayDataEducation['educationSelectedImage']) ? $arrayDataEducation['educationSelectedImage'] : '';
@endphp


<div id="education-supporting" class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-needs-desktop wrapper-needs-supporting-default">
                    <section class="header-needs-default">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                                @include('templates.nav.nav-red-menu')
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0 mt-lg-0">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-md-2 px-lg-2">
                                        <div
                                            class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style=""
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalEducationValueText" class="m-1 text-light text-center">RM</h3>
                                        <p class="text-light text-center">Total Education Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('form.submit.education.supporting')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('educationSelectedAvatarInput')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con">
                            <div class="col-12 position-relative">
                                <div class="row h-100">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 bg-education-supporting second-order">
                                        <div class="text-center education-support mh-100 z-1">
                                            <img src="{{$educationSelectedImage}}" class="mt-auto mh-100 mx-auto avatar-img">
                                            <p class="py-2 m-0 avatar-text">RM</p>
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg {{ $errors->has('educationSelectedAvatarInput') ? 'error-padding' : '' }}" style="background-color:#c21b17 !important;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order py-5">
                                        <div class="row justify-content-center">
                                            <div class="col-10 col-md-8 d-flex align-items-center">
                                                <p class="f-34"><strong>I plan to study</strong>
                                                    <span class="currencyinput f-34"><input type="text" name="tertiary_education_years" class="form-control d-inline-block w-30 money f-34" id="tertiary_education_years" required></span>
                                                    <strong>years for my education.</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-btn_bar py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <input type="hidden" name="educationSelectedAvatarInput" id="educationSelectedAvatarInput" value="{{$educationSelectedAvatar}}">
                                            <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('educationSelectedAvatarInput'))
                            <section class="col-12 alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-warning d-flex align-items-center m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('educationSelectedAvatarInput') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-warning d-flex align-items-center m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('educationSelectedAvatarInput') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bottom-0 needs-stand-bg {{ $errors->has('educationSelectedAvatarInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-btn_bar py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <input type="hidden" name="educationSelectedAvatarInput" id="educationSelectedAvatarInput" value="{{$educationSelectedAvatar}}">
                                        <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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
    document.addEventListener('DOMContentLoaded', function() {
        var education_coverage_1 = document.getElementById('education_year_1');
        var education_coverage_2 = document.getElementById('education_year_2');
        var education_coverage_3 = document.getElementById('education_year_3');

        education_coverage_1.addEventListener('blur', function() {
            validateAgeNumberField(education_coverage_1);
        });
        education_coverage_2.addEventListener('blur', function() {
            validateAgeNumberField(education_coverage_2);
        });
        education_coverage_3.addEventListener('blur', function() {
            validateAgeNumberField(education_coverage_3);
        });

        function validateAgeNumberField(field) {
            var minAge = 1;
            var maxAge = 100;

            var value = parseInt(field.value);

            if (!isNaN(value) && value >= minAge && value <= maxAge) {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            }
        }
    });
</script>
@endsection