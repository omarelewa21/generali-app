<?php
 /**
 * Template Name: Family Dependant Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant Details</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $familyDependant = isset($arrayData['familyDependant']) ? json_encode($arrayData['familyDependant']) : '';
    $familyDependant = $arrayData['familyDependant']['spouse']['YearsOfSupport'] ?? '';
@endphp

<div id="avatar_family_dependant_details" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default px-0">
            <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
            <section class="avatar-design-placeholder content-avatar-default overflow-auto overflow-hidden">
                    <div class="avatar-bg position-relative">
                        <img src="{{ asset('/images/avatar-general/parent-father-no-shadow.svg') }}" width="auto" height="100%" alt="Parent" class="changeImage pb-2">
                        <img src="{{ asset('/images/avatar-general/parent-mother.svg') }}" width="auto" height="90%" alt="Parent" class="changeImage position-absolute bottom-0 pb-2" style="right:-80px">
                    </div>
                    <div class="avatar-bg position-relative">
                        <img src="{{ asset('/images/avatar-general/spouse-no-shadow.svg') }}" width="auto" height="90%" alt="Spouse" class="changeImage position-absolute" style="bottom: 10px;right: -80px;">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male-no-shadow.svg') }}" width="auto" height="98%" alt="Main character" class="changeImage position-absolute" style="left:40px">
                    </div>
                    <div class="avatar-bg position-relative">
                        <img src="{{ asset('/images/avatar-general/children-boy.svg') }}" width="auto" height="80%" alt="Children" class="changeImage position-absolute end-0" style="bottom:10px">
                        <img src="{{ asset('/images/avatar-general/children-girl.svg') }}" width="auto" height="50%" alt="Children" class="changeImage position-absolute" style="bottom:10px">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <form novalidate action="{{ route('avatar.family.dependant.details') }}" method="POST">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-3 fw-bold">Thanks for introducing your family!</h1>
                                        <p class="text-white display-6 lh-base">Tell us more about each of them.</p>
                                    </div>
                                </div>
                                <div class="form-container pb-5">
                                    @if ($errors->any())
                                        <div class="row px-4 px-sm-5">
                                            <div class="col-12">
                                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    <div class="text">There was a problem with your submission. Errors are marked below.</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row px-4 pb-2 px-sm-5">
                                        <div class="col-12">
                                            <div class="accordion accordion-flush" id="accordionDependantDetails">
                                                @php
                                                    // Generate arrays for the date, month, and year ranges
                                                    $dateRange = range(1, 31);
                                                    $dateRange = array_map(function ($day) {
                                                        return sprintf('%02d', $day);
                                                    }, $dateRange);

                                                    $monthNames = [
                                                        '01' => 'January',
                                                        '02' => 'February',
                                                        '03' => 'March',
                                                        '04' => 'April',
                                                        '05' => 'May',
                                                        '06' => 'June',
                                                        '07' => 'July',
                                                        '08' => 'August',
                                                        '09' => 'September',
                                                        '10' => 'October',
                                                        '11' => 'November',
                                                        '12' => 'December',
                                                    ];

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
                                                @if(isset($arrayData['familyDependant']) && in_array('spouse', $arrayData['familyDependant']))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Spouse
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionDependantDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12">
                                                                        <label for="spouseFirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseFirstName" class="form-control @error('spouseFirstName') is-invalid @enderror" id="spouseFirstNameInput" placeholder="Your First Name" value="{{ old('spouseFirstName', $arrayData['familyDependant']['spouse']['FirstName'] ?? '') }}" required>
                                                                        @error('spouseFirstName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="spouseLastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseLastName" class="form-control @error('spouseLastName') is-invalid @enderror" id="spouseLastNameInput" placeholder="Your Last Name" value="{{ old('spouseLastName', $arrayData['familyDependant']['spouse']['LastName'] ?? '') }}" required>
                                                                        @error('spouseLastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        
                                                                        <label for="spouseDob" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="spouseAge" class="d-inline-block"></span> )</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('spouseday', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('spouseday', $arrayData['familyDependant']['spouse']['Day'] ?? ''), ['class' => 'form-select' . ($errors->has('spouseday') ? ' is-invalid' : ''), 'id' => 'spouseday']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('spousemonth', ['' => 'Select'] + $monthNames, old('spousemonth', $arrayData['familyDependant']['spouse']['Month'] ?? ''), ['class' => 'form-select' . ($errors->has('spousemonth') ? ' is-invalid' : ''), 'id' => 'spousemonth']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('spouseyear', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                    return substr($year, -2);
                                                                                }, $yearRange), $yearRange), old('spouseyear', $arrayData['familyDependant']['spouse']['Year'] ?? ''), ['class' => 'form-select' . ($errors->has('spouseyear') ? ' is-invalid' : ''), 'id' => 'spouseyear']) !!}
                                                                            </div>
                                                                            @if ($errors->has('spouseday') || $errors->has('spousemonth') || $errors->has('spouseyear'))
                                                                                <div class="col-md-12">
                                                                                    <div class="invalid-feedback text-red" style="display:block">Please select a day, month, and year.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="spouseYearsOfSupport" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                        <input type="number" name="spouseYearsOfSupport" class="form-control @error('spouseYearsOfSupport') is-invalid @enderror" id="spouseYearsOfSupportInput" placeholder="Number of Years" value="{{ old('spouseYearsOfSupport', $arrayData['familyDependant']['spouse']['YearsOfSupport'] ?? '') }}" required>
                                                                        @error('spouseYearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="spouseMaritalStatus" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                        <select name="spouseMaritalStatus" class="form-select @error('spouseMaritalStatus') is-invalid @enderror" aria-label="Spouse Marital Status" id="spouseMaritalStatusSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($maritalstatuses as $status)
                                                                                <option value="{{ $status->maritalStatus }}" {{ old('spouseMaritalStatus', $arrayData['familyDependant']['spouse']['MaritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('spouseMaritalStatus')
                                                                            <div class="invalid-feedback text-red">Please select a marital status</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($arrayData['familyDependant']) && in_array('child_1', $arrayData['familyDependant']))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingTwo">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Child 1
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionDependantDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12">
                                                                        <label for="child_1FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="child_1FirstName" class="form-control @error('child_1FirstName') is-invalid @enderror" id="child_1FirstNameInput" placeholder="Your First Name" value="{{ old('child_1FirstName', $arrayData['familyDependant']['child_1']['FirstName'] ?? '') }}" required>
                                                                        @error('child_1FirstName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="child_1LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="child_1LastName" class="form-control @error('child_1LastName') is-invalid @enderror" id="child_1LastNameInput" placeholder="Your Last Name" value="{{ old('child_1LastName', $arrayData['familyDependant']['child_1']['LastName'] ?? '') }}" required>
                                                                        @error('child_1LastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        
                                                                        <label for="child_1Dob" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="child_1Age" class="d-inline-block"></span> )</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('child_1day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('child_1day', $arrayData['familyDependant']['child_1']['Day'] ?? ''), ['class' => 'form-select' . ($errors->has('child_1day') ? ' is-invalid' : ''), 'id' => 'child_1day']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('child_1month', ['' => 'Select'] + $monthNames, old('child_1month', $arrayData['familyDependant']['child_1']['Month'] ?? ''), ['class' => 'form-select' . ($errors->has('child_1month') ? ' is-invalid' : ''), 'id' => 'child_1month']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('child_1year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                    return substr($year, -2);
                                                                                }, $yearRange), $yearRange), old('child_1year', $arrayData['familyDependant']['child_1']['Year'] ?? ''), ['class' => 'form-select' . ($errors->has('child_1year') ? ' is-invalid' : ''), 'id' => 'child_1year']) !!}
                                                                            </div>
                                                                            @if ($errors->has('child_1day') || $errors->has('child_1month') || $errors->has('child_1year'))
                                                                                <div class="col-md-12">
                                                                                    <div class="invalid-feedback text-red" style="display:block">Please select a day, month, and year.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="child_1YearsOfSupport" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                        <input type="number" name="child_1YearsOfSupport" class="form-control @error('child_1YearsOfSupport') is-invalid @enderror" id="child_1YearsOfSupportInput" placeholder="Number of Years" value="{{ old('child_1YearsOfSupport', $arrayData['familyDependant']['child_1']['YearsOfSupport'] ?? '') }}" required>
                                                                        @error('child_1YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="child_1MaritalStatus" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                        <select name="child_1MaritalStatus" class="form-select @error('child_1MaritalStatus') is-invalid @enderror" aria-label="Child Marital Status" id="child_1MaritalStatusSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($maritalstatuses as $status)
                                                                                <option value="{{ $status->maritalStatus }}" {{ old('child_1MaritalStatus', $arrayData['familyDependant']['child_1']['MaritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('child_1MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($arrayData['familyDependant']) && in_array('child_2', $arrayData['familyDependant']))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingThree">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Child 2
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionDependantDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12">
                                                                        <label for="child_2FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="child_2FirstName" class="form-control @error('child_2FirstName') is-invalid @enderror" id="child_2FirstNameInput" placeholder="Your First Name" value="{{ old('child_2FirstName', $arrayData['familyDependant']['child_2']['FirstName'] ?? '') }}" required>
                                                                        @error('child_2FirstName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="child_2LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="child_2LastName" class="form-control @error('child_2LastName') is-invalid @enderror" id="child_2LastNameInput" placeholder="Your Last Name" value="{{ old('child_2LastName', $arrayData['familyDependant']['child_2']['LastName'] ?? '') }}" required>
                                                                        @error('child_2LastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="child_2Dob" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="child_2Age" class="d-inline-block"></span> )</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('child_2day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('child_2day', $arrayData['familyDependant']['child_2']['Day'] ?? ''), ['class' => 'form-select' . ($errors->has('child_2day') ? ' is-invalid' : ''), 'id' => 'child_2day']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('child_2month', ['' => 'Select'] + $monthNames, old('child_2month', $arrayData['familyDependant']['child_2']['Month'] ?? ''), ['class' => 'form-select' . ($errors->has('child_2month') ? ' is-invalid' : ''), 'id' => 'child_2month']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('child_2year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                    return substr($year, -2);
                                                                                }, $yearRange), $yearRange), old('child_2year', $arrayData['familyDependant']['child_2']['Year'] ?? ''), ['class' => 'form-select' . ($errors->has('child_2year') ? ' is-invalid' : ''), 'id' => 'child_2year']) !!}
                                                                            </div>
                                                                            @if ($errors->has('child_2day') || $errors->has('child_2month') || $errors->has('child_2year'))
                                                                                <div class="col-md-12">
                                                                                    <div class="invalid-feedback text-red" style="display:block">Please select a day, month, and year.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="child_2YearsOfSupport" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                        <input type="number" name="child_2YearsOfSupport" class="form-control @error('child_2YearsOfSupport') is-invalid @enderror" id="child_2YearsOfSupportInput" placeholder="Number of Years" value="{{ old('child_2YearsOfSupport', $arrayData['familyDependant']['child_2']['YearsOfSupport'] ?? '') }}" required>
                                                                        @error('child_2YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="child_2MaritalStatus" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                        <select name="child_2MaritalStatus" class="form-select @error('child_2MaritalStatus') is-invalid @enderror" aria-label="Child Marital Status" id="child_2MaritalStatusSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($maritalstatuses as $status)
                                                                                <option value="{{ $status->maritalStatus }}" {{ old('child_2MaritalStatus', $arrayData['familyDependant']['child_2']['MaritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('child_2MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($arrayData['familyDependant']) && in_array('parent_1', $arrayData['familyDependant']))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingFour">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Parent 1
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionDependantDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12">
                                                                        <label for="parent_1FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="parent_1FirstName" class="form-control @error('parent_1FirstName') is-invalid @enderror" id="parent_1FirstNameInput" placeholder="Your First Name" value="{{ old('parent_1FirstName', $arrayData['familyDependant']['parent_1']['FirstName'] ?? '') }}" required>
                                                                        @error('parent_1FirstName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="parent_1LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="parent_1LastName" class="form-control @error('parent_1LastName') is-invalid @enderror" id="parent_1LastNameInput" placeholder="Your Last Name" value="{{ old('parent_1LastName', $arrayData['familyDependant']['parent_1']['LastName'] ?? '') }}" required>
                                                                        @error('parent_1LastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="parent_1Dob" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="parent_1Age" class="d-inline-block"></span> )</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('parent_1day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('parent_1day', $arrayData['familyDependant']['parent_1']['Day'] ?? ''), ['class' => 'form-select' . ($errors->has('parent_1day') ? ' is-invalid' : ''), 'id' => 'parent_1day']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('parent_1month', ['' => 'Select'] + $monthNames, old('parent_1month', $arrayData['familyDependant']['parent_1']['Month'] ?? ''), ['class' => 'form-select' . ($errors->has('parent_1month') ? ' is-invalid' : ''), 'id' => 'parent_1month']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('parent_1year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                    return substr($year, -2);
                                                                                }, $yearRange), $yearRange), old('parent_1year', $arrayData['familyDependant']['parent_1']['Year'] ?? ''), ['class' => 'form-select' . ($errors->has('parent_1year') ? ' is-invalid' : ''), 'id' => 'parent_1year']) !!}
                                                                            </div>
                                                                            @if ($errors->has('parent_1day') || $errors->has('parent_1month') || $errors->has('parent_1year'))
                                                                                <div class="col-md-12">
                                                                                    <div class="invalid-feedback text-red" style="display:block">Please select a day, month, and year.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="parent_1YearsOfSupport" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                        <input type="number" name="parent_1YearsOfSupport" class="form-control @error('parent_1YearsOfSupport') is-invalid @enderror" id="parent_1YearsOfSupportInput" placeholder="Number of Years" value="{{ old('parent_1YearsOfSupport', $arrayData['familyDependant']['parent_1']['YearsOfSupport'] ?? '') }}" required>
                                                                        @error('parent_1YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="parent_1MaritalStatus" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                        <select name="parent_1MaritalStatus" class="form-select @error('parent_1MaritalStatus') is-invalid @enderror" aria-label="Child Marital Status" id="parent_1MaritalStatusSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($maritalstatuses as $status)
                                                                                <option value="{{ $status->maritalStatus }}" {{ old('parent_1MaritalStatus', $arrayData['familyDependant']['parent_1']['MaritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('parent_1MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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
                                        <a href="{{route('avatar.family.dependant')}}" class="btn btn-primary flex-fill text-uppercase me-md-2">Back</a>
                                        <button class="btn btn-primary flex-fill text-uppercase" type="submit" id="submitButton">Next</button>
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
// Ensure the first accordion item is always open
document.addEventListener('DOMContentLoaded', function() {
    const firstAccordionItem = document.querySelector('.accordion-item:first-of-type');

    if (firstAccordionItem) {
        const firstCollapse = firstAccordionItem.querySelector('.accordion-collapse');
        firstCollapse.classList.add('show');
    }
});

// Client Validation
document.addEventListener('DOMContentLoaded', function() {

    setupFieldValidation('spouseFirstNameInput');
    setupFieldValidation('child_1FirstNameInput');
    setupFieldValidation('child_2FirstNameInput');
    setupFieldValidation('parent_1FirstNameInput');
    setupFieldValidation('spouseLastNameInput');
    setupFieldValidation('child_1LastNameInput');
    setupFieldValidation('child_2LastNameInput');
    setupFieldValidation('parent_1LastNameInput');

    setupNumberFieldValidation('spouseYearsOfSupportInput');
    setupNumberFieldValidation('child_1YearsOfSupportInput');
    setupNumberFieldValidation('child_2YearsOfSupportInput');
    setupNumberFieldValidation('parent_1YearsOfSupportInput');

    setupSelectFieldValidation('spouseMaritalStatusSelect');
    setupSelectFieldValidation('child_1MaritalStatusSelect');
    setupSelectFieldValidation('child_2MaritalStatusSelect');
    setupSelectFieldValidation('parent_1MaritalStatusSelect');

    function setupFieldValidation(inputId) {
        var field = document.getElementById(inputId);
        if (field) {
            field.addEventListener('blur', function() {
                validateInputField(field);
            });
        }
    }

    function setupNumberFieldValidation(inputId) {
        var field = document.getElementById(inputId);
        if (field) {
            field.addEventListener('blur', function() {
                validateNumberField(field);
            });
        }
    }

    function setupSelectFieldValidation(inputId) {
        var field = document.getElementById(inputId);
        if (field) {
            field.addEventListener('blur', function() {
                validateSelectField(field);
            });
        }
    }

    function validateInputField(field) {
        if (field.value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateNumberField(field) {
        if (field.value && isValidSupportYears(field.value)) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function validateSelectField(field) {
        if (field.value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    function isValidSupportYears(spouseYearsOfSupport) {
        var supportYearsRegex = /^\d+$/;  // Regular expression to match only digits

        if (!supportYearsRegex.test(spouseYearsOfSupport)) {
            return false;
        }

        var isValid = parseInt(spouseYearsOfSupport, 10);
        return isValid <= 100;
    }
});

// Add event listeners to detect changes in the selected values for each entity
setupAgeCalculation('spouse');
setupAgeCalculation('child_1');
setupAgeCalculation('child_2');
setupAgeCalculation('parent_1');

function setupAgeCalculation(entity) {
    var daySelect = document.getElementById(entity + 'day');
    var monthSelect = document.getElementById(entity + 'month');
    var yearSelect = document.getElementById(entity + 'year');
    
    daySelect.addEventListener('change', calculateAge.bind(null, entity));
    monthSelect.addEventListener('change', calculateAge.bind(null, entity));
    yearSelect.addEventListener('change', calculateAge.bind(null, entity));
    
    // Calculate age on initial load
    calculateAge(entity);
}

function calculateAge(entity) {
    var daySelect = document.getElementById(entity + 'day');
    var monthSelect = document.getElementById(entity + 'month');
    var yearSelect = document.getElementById(entity + 'year');
    
    var ageDiv = document.getElementById(entity + 'Age');
    
    var selectedDay = daySelect.value;
    var selectedMonth = monthSelect.value;
    var selectedYearOption = yearSelect.options[yearSelect.selectedIndex];
    var selectedYear = selectedYearOption.textContent;
    
    if (selectedYear) {
        if (selectedDay && selectedMonth) {
            var dob = new Date(selectedYear, selectedMonth - 1, selectedDay);
            var currentDate = new Date();
            
            var age = currentDate.getFullYear() - dob.getFullYear();
            if (currentDate.getMonth() < dob.getMonth() ||
                (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
                age--;
            }
            
            ageDiv.textContent = 'Age: ' + age;
        } else {
            ageDiv.textContent = 'Age: Please select a valid year';
        }
    } else {
        ageDiv.textContent = 'Age: Please select a valid year';
    }
}


// // Age Logics
// // Get references to the day, month, and year select elements
// var spousedaySelect = document.getElementById('spouseday');
// var spousemonthSelect = document.getElementById('spousemonth');
// var spouseyearSelect = document.getElementById('spouseyear');

// var child_1daySelect = document.getElementById('spouseday');
// var child_1monthSelect = document.getElementById('spousemonth');
// var child_1yearSelect = document.getElementById('spouseyear');

// // Add event listeners to detect changes in the selected values
// spousedaySelect.addEventListener('change', calculateAge);
// spousemonthSelect.addEventListener('change', calculateAge);
// spouseyearSelect.addEventListener('change', calculateAge);

// child_1daySelect.addEventListener('change', calculateAge);
// child_1monthSelect.addEventListener('change', calculateAge);
// child_1yearSelect.addEventListener('change', calculateAge);

// // Calculate age based on selected date of birth
// function calculateAge() {
//     var spouseselectedDay = spousedaySelect.value;
//     var spouseselectedMonth = spousemonthSelect.value;
//     const spouseselectedYearOption = spouseyearSelect.options[spouseyearSelect.selectedIndex];
//     const spouseselectedYear = selectedYearOption.textContent;

//     var selectedDay = spousedaySelect.value;
//     var selectedMonth = spousemonthSelect.value;
//     const selectedYearOption = spouseyearSelect.options[spouseyearSelect.selectedIndex];
//     const selectedYear = selectedYearOption.textContent;

//     var spouseAgeDiv = document.getElementById('spouseAge');

//     if (spouseselectedYear) {
//         if (selectedDay && selectedMonth) {
//             var dob = new Date(spouseselectedYear, spouseselectedMonth - 1, spouseselectedDay);
//             var currentDate = new Date();

//             var age = currentDate.getFullYear() - dob.getFullYear();
//             if (currentDate.getMonth() < dob.getMonth() ||
//                 (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
//                 age--;
//             }

//             spouseAgeDiv.textContent = 'Age: ' + age;
//         } else {
//             spouseAgeDiv.textContent = 'Age: Please select a year';
//         }
//     } else {
//         spouseAgeDiv.textContent = 'Age: Please select a year';
//     }
// }

// // Calculate age on initial load
// calculateAge();

</script>
@endsection