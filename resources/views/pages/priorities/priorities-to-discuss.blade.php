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
                                                            <label for="firstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            <label for="lastName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            @php
                                                                // Generate arrays for the date, month, and year ranges
                                                                $dateRange = range(1, 31);
                                                                $dateRange = array_map(function ($day) {
                                                                    return sprintf('%02d', $day);
                                                                }, $dateRange);
                                                                $monthRange = range(1, 12);
                                                                $monthRange = array_map(function ($month) {
                                                                    return sprintf('%02d', $month);
                                                                }, $monthRange);
                                                                $yearRange = range(date('Y') - 100, date('Y') - 18); // Assuming minimum age is 18

                                                                // Set the selected values
                                                                $selectedDay = old('day', null); 
                                                                $selectedMonth = old('month', null); 
                                                                $selectedYear = old('year', null);

                                                                // Adjust the selected month value to "01" format
                                                                if ($selectedMonth !== null) {
                                                                    $selectedMonth = sprintf('%02d', $selectedMonth);
                                                                }
                                                                if ($selectedDay !== null) {
                                                                    $selectedDay = sprintf('%02d', $selectedDay);
                                                                }
                                                            @endphp
                                                            <label for="dob" class="form-label">Date of Birth ( <div id="age" class="d-inline-block"></div> )</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::select('day', array_combine($dateRange, $dateRange), $selectedDay, ['class' => 'form-select bg-white', 'id' => 'day']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {!! Form::select('month', array_combine($monthRange, $monthRange), $selectedMonth, ['class' => 'form-select bg-white', 'id' => 'month']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!-- {!! Form::select('year', $yearRange, $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!} -->
                                                                    {!! Form::select('year', array_combine(array_map(function ($year) {
                                                                        return substr($year, -2);
                                                                    }, $yearRange), $yearRange), $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="firstName" class="form-label">Years of Support</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="occupation" class="form-label">Dependent Marital Status</label>
                                                            <select name="occupation" class="form-select bg-white @error('occupation') is-invalid @enderror" aria-label="Occupation" id="occupation" required>
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="New IC" @if(old('occupation') == 'New IC') selected @endif>New IC</option>
                                                                <option value="Passport" @if(old('occupation') == 'Passport') selected @endif>Passport</option>
                                                                <option value="Birth Certificate" @if(old('occupation') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                                                <option value="Police / Army" @if(old('occupation') == 'Police / Army') selected @endif>Police / Army</option>
                                                                <option value="Registration" @if(old('occupation') == 'Registration') selected @endif>Registration</option>
                                                            </select>
                                                            @error('occupation')
                                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                                            @enderror
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
                                                            <label for="firstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            <label for="lastName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            @php
                                                                // Generate arrays for the date, month, and year ranges
                                                                $dateRange = range(1, 31);
                                                                $dateRange = array_map(function ($day) {
                                                                    return sprintf('%02d', $day);
                                                                }, $dateRange);
                                                                $monthRange = range(1, 12);
                                                                $monthRange = array_map(function ($month) {
                                                                    return sprintf('%02d', $month);
                                                                }, $monthRange);
                                                                $yearRange = range(date('Y') - 100, date('Y') - 18); // Assuming minimum age is 18

                                                                // Set the selected values
                                                                $selectedDay = old('day', null); 
                                                                $selectedMonth = old('month', null); 
                                                                $selectedYear = old('year', null);

                                                                // Adjust the selected month value to "01" format
                                                                if ($selectedMonth !== null) {
                                                                    $selectedMonth = sprintf('%02d', $selectedMonth);
                                                                }
                                                                if ($selectedDay !== null) {
                                                                    $selectedDay = sprintf('%02d', $selectedDay);
                                                                }
                                                            @endphp
                                                            <label for="dob" class="form-label">Date of Birth ( <div id="age" class="d-inline-block"></div> )</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::select('day', array_combine($dateRange, $dateRange), $selectedDay, ['class' => 'form-select bg-white', 'id' => 'day']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {!! Form::select('month', array_combine($monthRange, $monthRange), $selectedMonth, ['class' => 'form-select bg-white', 'id' => 'month']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!-- {!! Form::select('year', $yearRange, $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!} -->
                                                                    {!! Form::select('year', array_combine(array_map(function ($year) {
                                                                        return substr($year, -2);
                                                                    }, $yearRange), $yearRange), $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="firstName" class="form-label">Years of Support</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="occupation" class="form-label">Dependent Marital Status</label>
                                                            <select name="occupation" class="form-select bg-white @error('occupation') is-invalid @enderror" aria-label="Occupation" id="occupation" required>
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="New IC" @if(old('occupation') == 'New IC') selected @endif>New IC</option>
                                                                <option value="Passport" @if(old('occupation') == 'Passport') selected @endif>Passport</option>
                                                                <option value="Birth Certificate" @if(old('occupation') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                                                <option value="Police / Army" @if(old('occupation') == 'Police / Army') selected @endif>Police / Army</option>
                                                                <option value="Registration" @if(old('occupation') == 'Registration') selected @endif>Registration</option>
                                                            </select>
                                                            @error('occupation')
                                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                                            @enderror
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
                                                            <label for="firstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            <label for="lastName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            @php
                                                                // Generate arrays for the date, month, and year ranges
                                                                $dateRange = range(1, 31);
                                                                $dateRange = array_map(function ($day) {
                                                                    return sprintf('%02d', $day);
                                                                }, $dateRange);
                                                                $monthRange = range(1, 12);
                                                                $monthRange = array_map(function ($month) {
                                                                    return sprintf('%02d', $month);
                                                                }, $monthRange);
                                                                $yearRange = range(date('Y') - 100, date('Y') - 18); // Assuming minimum age is 18

                                                                // Set the selected values
                                                                $selectedDay = old('day', null); 
                                                                $selectedMonth = old('month', null); 
                                                                $selectedYear = old('year', null);

                                                                // Adjust the selected month value to "01" format
                                                                if ($selectedMonth !== null) {
                                                                    $selectedMonth = sprintf('%02d', $selectedMonth);
                                                                }
                                                                if ($selectedDay !== null) {
                                                                    $selectedDay = sprintf('%02d', $selectedDay);
                                                                }
                                                            @endphp
                                                            <label for="dob" class="form-label">Date of Birth ( <div id="age" class="d-inline-block"></div> )</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::select('day', array_combine($dateRange, $dateRange), $selectedDay, ['class' => 'form-select bg-white', 'id' => 'day']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {!! Form::select('month', array_combine($monthRange, $monthRange), $selectedMonth, ['class' => 'form-select bg-white', 'id' => 'month']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!-- {!! Form::select('year', $yearRange, $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!} -->
                                                                    {!! Form::select('year', array_combine(array_map(function ($year) {
                                                                        return substr($year, -2);
                                                                    }, $yearRange), $yearRange), $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="firstName" class="form-label">Years of Support</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="occupation" class="form-label">Dependent Marital Status</label>
                                                            <select name="occupation" class="form-select bg-white @error('occupation') is-invalid @enderror" aria-label="Occupation" id="occupation" required>
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="New IC" @if(old('occupation') == 'New IC') selected @endif>New IC</option>
                                                                <option value="Passport" @if(old('occupation') == 'Passport') selected @endif>Passport</option>
                                                                <option value="Birth Certificate" @if(old('occupation') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                                                <option value="Police / Army" @if(old('occupation') == 'Police / Army') selected @endif>Police / Army</option>
                                                                <option value="Registration" @if(old('occupation') == 'Registration') selected @endif>Registration</option>
                                                            </select>
                                                            @error('occupation')
                                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                                            @enderror
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
                                                            <label for="firstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="Your First Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            <label for="lastName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastNameInput" placeholder="Your Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-12 pt-4">
                                                            @php
                                                                // Generate arrays for the date, month, and year ranges
                                                                $dateRange = range(1, 31);
                                                                $dateRange = array_map(function ($day) {
                                                                    return sprintf('%02d', $day);
                                                                }, $dateRange);
                                                                $monthRange = range(1, 12);
                                                                $monthRange = array_map(function ($month) {
                                                                    return sprintf('%02d', $month);
                                                                }, $monthRange);
                                                                $yearRange = range(date('Y') - 100, date('Y') - 18); // Assuming minimum age is 18

                                                                // Set the selected values
                                                                $selectedDay = old('day', null); 
                                                                $selectedMonth = old('month', null); 
                                                                $selectedYear = old('year', null);

                                                                // Adjust the selected month value to "01" format
                                                                if ($selectedMonth !== null) {
                                                                    $selectedMonth = sprintf('%02d', $selectedMonth);
                                                                }
                                                                if ($selectedDay !== null) {
                                                                    $selectedDay = sprintf('%02d', $selectedDay);
                                                                }
                                                            @endphp
                                                            <label for="dob" class="form-label">Date of Birth ( <div id="age" class="d-inline-block"></div> )</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::select('day', array_combine($dateRange, $dateRange), $selectedDay, ['class' => 'form-select bg-white', 'id' => 'day']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {!! Form::select('month', array_combine($monthRange, $monthRange), $selectedMonth, ['class' => 'form-select bg-white', 'id' => 'month']) !!}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!-- {!! Form::select('year', $yearRange, $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!} -->
                                                                    {!! Form::select('year', array_combine(array_map(function ($year) {
                                                                        return substr($year, -2);
                                                                    }, $yearRange), $yearRange), $selectedYear, ['class' => 'form-select bg-white', 'id' => 'year']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="firstName" class="form-label">Years of Support</label>
                                                            <input type="text" class="form-control" id="firstNameInput" placeholder="00">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2">
                                                        <div class="col-8 pt-4">
                                                            <label for="occupation" class="form-label">Dependent Marital Status</label>
                                                            <select name="occupation" class="form-select bg-white @error('occupation') is-invalid @enderror" aria-label="Occupation" id="occupation" required>
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="New IC" @if(old('occupation') == 'New IC') selected @endif>New IC</option>
                                                                <option value="Passport" @if(old('occupation') == 'Passport') selected @endif>Passport</option>
                                                                <option value="Birth Certificate" @if(old('occupation') == 'Birth Certificate') selected @endif>Birth Certificate</option>
                                                                <option value="Police / Army" @if(old('occupation') == 'Police / Army') selected @endif>Police / Army</option>
                                                                <option value="Registration" @if(old('occupation') == 'Registration') selected @endif>Registration</option>
                                                            </select>
                                                            @error('occupation')
                                                                <div class="invalid-feedback text-white">{{ $message }}</div>
                                                            @enderror
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

@endsection