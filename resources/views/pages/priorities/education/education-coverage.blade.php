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
    $education = session('customer_details.education_needs');
    $childData = session('customer_details.family_details.dependant.children_data');
    $educationSelectedAvatar = session('customer_details.education_needs.coveragePerson');
@endphp

<div id="education-coverage">
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12 vh-100 wrapper-needs-master-full-default bg-needs-master-full">
                <section class="header-needs-default">
                    <div class="col-lg-6 col-md-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </section>
                <form novalidate action="{{route('validate.education.coverage.selection')}}" method="POST" class="content-needs-default m-0">
                    @csrf
                    <section class="overflow-auto overflow-hidden row content-block">
                        <div class="col-12 header-content-coverage">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <h4 class="f-34 f-family fw-700">I'd like to provide coverage for my:</h4>
                            </div>
                        </div>
                        <div class="col-11 m-auto selection-content-coverage h-100 coverage_slick z-1">
                            @if ($childData)
                                @foreach($childData as $child)
                                    <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                        <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if($educationSelectedAvatar === $child['first_name'].''.$child['last_name']) default @endif" id="{{ $child['first_name'] }} {{ $child['last_name'] }}" data-avatar="{{ $child['first_name'] }} {{ $child['last_name'] }}" data-required="">
                                            @php
                                            $birthdate = $child['dob'];

                                            // Convert DOB to DateTime object
                                            $dobDate = \DateTime::createFromFormat('d-m-Y', $birthdate);

                                            //Get current Date
                                            $currentDate = new \DateTime();

                                            // Calculate the difference between the two dates
                                            $ageInterval = $currentDate->diff($dobDate);
                                            $age = $ageInterval->y; // Access the years property of the interval

                                            @endphp
                                            <p class="py-2 m-auto m-0 f-family coverage-age text-white d-flex justify-content-center align-items-center">Age: {{$age}}</p>
                                            <img src="{{ asset('images/avatar/coverage/avatar-coverage-child-'.str_replace(' ', '_', $child['gender']).'.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                            <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>{{ $child['first_name'] }} {{ $child['last_name'] }}</strong></p>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('educationSelectedAvatarInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('educationSelectedAvatarInput'))
                        <section class="row warning z-1">
                            <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('educationSelectedAvatarInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-white py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="educationSelectedAvatarInput" id="educationSelectedAvatarInput" value="{{$educationSelectedAvatar}}">
                                    <a href="{{route('education.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

@endsection