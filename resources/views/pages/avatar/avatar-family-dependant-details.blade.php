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
    $familyDependant = isset($arrayData['FamilyDependant']) ? json_encode($arrayData['FamilyDependant']) : '';
    $gender = isset($arrayData['Gender']) ? ($arrayData['Gender'] === 'Male' ? 'Female' : 'Male') : '';
    $selectedCountry = session('passingArrays.Country', '');
@endphp

<div id="avatar_family_dependant_details" class="vh-100 overflow-y-auto overflow-x-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg vh-100 wrapper-avatar-default">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                <section class="avatar-design-placeholder content-avatar-default overflow-auto overflow-hidden">
                    <div class="position-relative imageContainerParents"></div>
                    <div class="position-relative d-flex justify-content-center imageContainerSpouse">
                        <img src="{{ isset($arrayData['AvatarImage']) ? $arrayData['AvatarImage'] : 'gender-male' }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                    <div class="position-relative d-flex justify-content-center imageContainerChildren"></div>
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
                                                @if(isset($arrayData['FamilyDependant']['spouse']['status']) && $arrayData['FamilyDependant']['spouse']['status'] === 'yes')
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Spouse
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionDependantDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-8">
                                                                        <label for="spouseTitleSelect" class="form-label">Title <span class="text-danger">*</span></label>
                                                                        <select name="spouseTitle" class="form-select @error('spouseTitle') is-invalid @enderror" aria-label="Title" id="spouseTitleSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($titles as $title)
                                                                                <option value="{{ $title->titles }}" {{ old('spouseTitle', $arrayData['FamilyDependant']['spouse']['title'] ?? '') === $title->titles ? 'selected' : '' }}>{{ $title->titles }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('spouseTitle')
                                                                            <div class="invalid-feedback text-red">The spouse's title field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="spouseFirstNameInput" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseFirstName" class="form-control @error('spouseFirstName') is-invalid @enderror" id="spouseFirstNameInput" placeholder="Your First Name" value="{{ old('spouseFirstName', $arrayData['FamilyDependant']['spouse']['firstName'] ?? '') }}" required>
                                                                        @error('spouseFirstName')
                                                                            <div class="invalid-feedback text-red">The spouse's first name field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="spouseLastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseLastName" class="form-control @error('spouseLastName') is-invalid @enderror" id="spouseLastNameInput" placeholder="Your Last Name" value="{{ old('spouseLastName', $arrayData['FamilyDependant']['spouse']['lastName'] ?? '') }}" required>
                                                                        @error('spouseLastName')
                                                                            <div class="invalid-feedback text-red">The spouse's last name field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="spouseCountrySelect" class="form-label">Citizenship <span class="text-danger">*</span></label>
                                                                        <select name="spouseCountry" class="form-select @error('spouseCountry') is-invalid @enderror" aria-label="Countries" id="spouseCountrySelect" autocomplete="country" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($countries as $country)
                                                                                <option value="{{ $country->countries }}" {{ ($selectedCountry === $country->countries || (!$selectedCountry && $country->countries === 'Malaysia')) ? 'selected' : '' }}>
                                                                                    {{ $country->countries }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('spouseCountry')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4 @error('spouseIdType') is-invalid @enderror">
                                                                        <label for="spouseIdSelect" class="form-label">ID Type <span class="text-danger">*</span></label>
                                                                        <select name="spouseIdType" class="form-select" aria-label="ID Type" id="spouseIdSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($idtypes as $idtype)
                                                                                <option value="{{ $idtype->idtypes }}" {{ old('spouseIdType', $arrayData['FamilyDependant']['spouse']['idType'] ?? '') === $idtype->idtypes ? 'selected' : '' }}>{{ $idtype->idtypes }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @error('spouseIdType')
                                                                        <div class="invalid-feedback text-red">The spouse's id type field is required.</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="row py-2" id="groups">
                                                                    <div class="col-12 pt-4" id="newicgroup" style="display: none;">
                                                                        <label for="spouseIdNumber" class="form-label">ID Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseIdNumber" class="form-control @error('spouseIdNumber') is-invalid @enderror" id="spouseIdNumber" placeholder="xxxxxx-xx-xxxx" value="{{ old('spouseIdNumber', $arrayData['FamilyDependant']['spouse']['idNumber'] ?? '') }}">
                                                                        @error('spouseIdNumber')
                                                                            <div class="invalid-feedback text-red">The spouse's id number field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="passportgroup" style="display: none;">
                                                                        <label for="spousePassportNumber" class="form-label">Passport Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spousePassportNumber" class="form-control @error('spousePassportNumber') is-invalid @enderror" id="spousePassportNumber" placeholder="A122345" value="{{ old('spousePassportNumber', $arrayData['FamilyDependant']['spouse']['passportNumber'] ?? '') }}">
                                                                        @error('spousePassportNumber')
                                                                            <div class="invalid-feedback text-red">The spouse's passport number field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="birthcertgroup" style="display: none;">
                                                                        <label for="spouseBirthCert" class="form-label">Birth Certificate Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseBirthCert" class="form-control @error('spouseBirthCert') is-invalid @enderror" id="spouseBirthCert" placeholder="T122345" value="{{ old('spouseBirthCert', $arrayData['FamilyDependant']['spouse']['birthCert'] ?? '') }}">
                                                                        @error('spouseBirthCert')
                                                                            <div class="invalid-feedback text-red">The spouse's birth certificate field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="policegroup" style="display: none;">
                                                                        <label for="spousePoliceNumber" class="form-label">Police / Army Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spousePoliceNumber" class="form-control @error('spousePoliceNumber') is-invalid @enderror" id="spousePoliceNumber" placeholder="Enter Police / Army Number" value="{{ old('spousePoliceNumber', $arrayData['FamilyDependant']['spouse']['policeNumber'] ?? '') }}">
                                                                        @error('spousePoliceNumber')
                                                                            <div class="invalid-feedback text-red">The spouse's police number field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="registrationgroup" style="display: none;">
                                                                        <label for="spouseRegistrationNumber" class="form-label">Registration Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseRegistrationNumber" class="form-control @error('spouseRegistrationNumber') is-invalid @enderror" id="spouseRegistrationNumber" placeholder="Enter Registration Number" value="{{ old('spouseRegistrationNumber', $arrayData['spouseRegistrationNumber'] ?? '') }}">
                                                                        @error('spouseRegistrationNumber')
                                                                            <div class="invalid-feedback text-red">The spouse's registration number field is required.</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">                                                                        
                                                                        <label for="spouseday" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="spouseAge" class="d-inline-block"></span> )</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('spouseday', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('spouseday', $arrayData['FamilyDependant']['spouse']['day'] ?? ''), ['class' => 'form-select' . ($errors->has('spouseday') ? ' is-invalid' : ''), 'id' => 'spouseday']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('spousemonth', ['' => 'Select'] + $monthNames, old('spousemonth', $arrayData['FamilyDependant']['spouse']['month'] ?? ''), ['class' => 'form-select' . ($errors->has('spousemonth') ? ' is-invalid' : ''), 'id' => 'spousemonth']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('spouseyear', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                    return substr($year, -2);
                                                                                }, $yearRange), $yearRange), old('spouseyear', $arrayData['FamilyDependant']['spouse']['year'] ?? ''), ['class' => 'form-select' . ($errors->has('spouseyear') ? ' is-invalid' : ''), 'id' => 'spouseyear']) !!}
                                                                            </div>
                                                                            @if ($errors->has('spouseday') || $errors->has('spousemonth') || $errors->has('spouseyear'))
                                                                                <div class="col-md-12">
                                                                                    <div class="invalid-feedback text-red" style="display:block">The spouse's date of birth field is required.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="genderInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                        <div class="d-flex btn-group @error('genderBtnradio') is-invalid @enderror" role="group">
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="genderBtnradio" id="genderInput" autocomplete="off" value="male"
                                                                                {{ (old('genderBtnradio') === 'male' || (isset($arrayData['FamilyDependant']['spouse']['gender']) && $arrayData['FamilyDependant']['spouse']['gender'] === 'male')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                            </label>
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="genderBtnradio" id="genderFemaleInput" autocomplete="off" value="female"
                                                                                {{ (old('genderBtnradio') === 'female' || (isset($arrayData['FamilyDependant']['spouse']['gender']) && $arrayData['FamilyDependant']['spouse']['gender'] === 'female')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                            </label>
                                                                        </div>
                                                                        @error('genderBtnradio')
                                                                            <div class="invalid-feedback text-red">The spouse's gender field is required.</div>
                                                                        @enderror  
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="smoker" class="form-label">Your Habits <span class="text-danger">*</span></label>
                                                                        <div class="d-flex btn-group @error('smokingBtnradio') is-invalid @enderror" role="group">
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="smokingBtnradio" id="smoker" autocomplete="off" value="smoker"
                                                                                {{ (old('smokingBtnradio') === 'smoker' || (isset($arrayData['FamilyDependant']['spouse']['habits']) && $arrayData['FamilyDependant']['spouse']['habits'] === 'smoker')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Smoker</span>
                                                                            </label>
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="smokingBtnradio" id="nonSmoker" autocomplete="off" value="nonSmoker"
                                                                                {{ (old('smokingBtnradio') === 'nonSmoker' || (isset($arrayData['FamilyDependant']['spouse']['habits']) && $arrayData['FamilyDependant']['spouse']['habits'] === 'nonSmoker')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Non-Smoker</span>
                                                                            </label>
                                                                        </div>
                                                                        @error('smokingBtnradio')
                                                                            <div class="invalid-feedback text-red">The spouse's habits field is required.</div>
                                                                        @enderror  
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4 @error('spouseOccupation') is-invalid @enderror">
                                                                        <label for="spouseOccupationSelect" class="form-label">Occupation <span class="text-danger">*</span></label>
                                                                        <select name="spouseOccupation" class="form-select" aria-label="Countries" id="spouseOccupationSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($occupations as $occupation)
                                                                                <option value="{{ $occupation->name }}" {{ old('spouseOccupation', $arrayData['FamilyDependant']['spouse']['occupation'] ?? '') === $occupation->name ? 'selected' : '' }}>{{ $occupation->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @error('spouseOccupation')
                                                                        <div class="invalid-feedback text-red">The spouse's occupation field is required.</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($arrayData['FamilyDependant']['children']))
                                                    @foreach ($arrayData['FamilyDependant']['children'] as $key => $childName)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{$childName}}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$childName}}" aria-expanded="true" aria-controls="flush-collapse{{$childName}}">
                                                                    Child {{ $key + 1 }}
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{$childName}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$childName}}" data-bs-parent="#accordionDependantDetails">
                                                                <div class="accordion-body">
                                                                    <div class="row py-2">
                                                                        <div class="col-12">
                                                                            <label for="{{$childName}}FirstNameInput" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$childName}}FirstName" class="form-control @error($childName . 'FirstName') is-invalid @enderror" id="{{$childName}}FirstNameInput" placeholder="Your First Name" value="{{ old($childName . 'FirstName', $arrayData['FamilyDependant']['children_details'][$childName]['firstName'] ?? '') }}" required>
                                                                            @error($childName . 'FirstName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$childName}}LastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$childName}}LastName" class="form-control @error($childName . 'LastName') is-invalid @enderror" id="{{$childName}}LastNameInput" placeholder="Your Last Name" value="{{ old($childName . 'LastName', $arrayData['FamilyDependant']['children_details'][$childName]['lastName'] ?? '') }}" required>
                                                                            @error($childName . 'LastName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$childName}}GenderInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                            <div class="d-flex btn-group @error($childName . 'GenderBtnradio') is-invalid @enderror" role="group">
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$childName}}GenderBtnradio" id="{{$childName}}GenderInput" autocomplete="off" value="male"
                                                                                    {{ (old($childName . 'GenderBtnradio') === 'male' || (isset($arrayData['FamilyDependant']['children_details'][$childName]['gender']) && $arrayData['FamilyDependant']['children_details'][$childName]['gender'] === 'male')) ? 'checked' : '' }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                                </label>
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$childName}}GenderBtnradio" id="{{$childName}}GenderFemaleInput" autocomplete="off" value="female"
                                                                                    {{ (old($childName . 'GenderBtnradio') === 'female' || (isset($arrayData['FamilyDependant']['children_details'][$childName]['gender']) && $arrayData['FamilyDependant']['children_details'][$childName]['gender'] === 'female')) ? 'checked' : '' }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                                </label>
                                                                            </div>
                                                                            @error($childName .'GenderBtnradio')
                                                                                <div class="invalid-feedback text-red">The child's gender field is required.</div>
                                                                            @enderror  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$childName}}day" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="{{$childName}}Age" class="d-inline-block"></span> )</label>
                                                                            <div class="row">
                                                                                <div class="col-md-4 pb-2 pb-md-0">
                                                                                    {{ Form::select($childName . 'day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old($childName . 'day', $arrayData['FamilyDependant']['children_details'][$childName]['day'] ?? ''), ['class' => 'form-select' . ($errors->has($childName . 'day') ? ' is-invalid' : ''), 'id' => $childName . 'day']) }}
                                                                                </div>
                                                                                <div class="col-md-4 pb-2 pb-md-0">
                                                                                    {{ Form::select($childName .'month', ['' => 'Select'] + $monthNames, old($childName .'month', $arrayData['FamilyDependant']['children_details'][$childName]['month'] ?? ''), ['class' => 'form-select' . ($errors->has($childName .'month') ? ' is-invalid' : ''), 'id' => $childName . 'month']) }}
                                                                                </div>
                                                                                <div class="col-md-4 pb-2 pb-md-0">
                                                                                    {{ Form::select($childName . 'year', ['' => 'Select'] + array_combine(array_map(function ($year) { return substr($year, -2); }, $yearRange), $yearRange), old($childName . 'year', $arrayData['FamilyDependant']['children_details'][$childName]['year'] ?? ''), ['class' => 'form-select' . ($errors->has($childName . 'year') ? ' is-invalid' : ''), 'id' => $childName . 'year']) }}
                                                                                </div>
                                                                                @if ($errors->has($childName . 'day') || $errors->has($childName . 'month') || $errors->has($childName . 'year'))
                                                                                    <div class="col-md-12">
                                                                                        <div class="invalid-feedback text-red" style="display:block">The child's date of birth field is required.</div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-8 pt-4 @error($childName .'YearsOfSupport') is-invalid @enderror">
                                                                            <label for="{{$childName}}YearsOfSupportInput" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                            <input type="number" name="{{$childName}}YearsOfSupport" class="form-control" id="{{$childName}}YearsOfSupportInput" placeholder="Number of Years" value="{{ old($childName . 'YearsOfSupport', $arrayData['FamilyDependant']['children_details'][$childName]['yearsOfSupport'] ?? '') }}" required>
                                                                        </div>
                                                                        @error($childName . 'YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-8 pt-4 @error($childName . 'MaritalStatus') is-invalid @enderror">
                                                                            <label for="{{$childName}}MaritalStatusSelect" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                            <select name="{{$childName}}MaritalStatus" class="form-select" aria-label="Child Marital Status" id="{{$childName}}MaritalStatusSelect" required>
                                                                                <option value="" selected disabled>Please Select</option>
                                                                                @foreach ($maritalstatuses as $status)
                                                                                    <option value="{{ $status->maritalStatus }}" {{ old($childName .'MaritalStatus', $arrayData['FamilyDependant']['children_details'][$childName]['maritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error($childName . 'MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(isset($arrayData['FamilyDependant']['parents']))
                                                    @foreach ($arrayData['FamilyDependant']['parents'] as $key => $parentsName)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{$parentsName}}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$parentsName}}" aria-expanded="true" aria-controls="flush-collapse{{$parentsName}}">
                                                                    Parent ({{ $parentsName }})
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{$parentsName}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$parentsName}}" data-bs-parent="#accordionDependantDetails">
                                                                <div class="accordion-body">
                                                                    <div class="row py-2">
                                                                        <div class="col-12">
                                                                            <label for="{{$parentsName}}FirstNameInput" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$parentsName}}FirstName" class="form-control @error($parentsName . 'FirstName') is-invalid @enderror" id="{{$parentsName}}FirstNameInput" placeholder="Your First Name" value="{{ old($parentsName . 'FirstName', $arrayData['FamilyDependant']['parents_details'][$parentsName]['firstName'] ?? '') }}" required>
                                                                            @error($parentsName . 'FirstName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$parentsName}}LastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$parentsName}}LastName" class="form-control @error($parentsName . 'LastName') is-invalid @enderror" id="{{$parentsName}}LastNameInput" placeholder="Your Last Name" value="{{ old($parentsName . 'LastName', $arrayData['FamilyDependant']['parents_details'][$parentsName]['lastName'] ?? '') }}" required>
                                                                            @error($parentsName . 'LastName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$parentsName}}GenderInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                            <div class="d-flex btn-group @error($parentsName . 'GenderBtnradio') is-invalid @enderror" role="group">
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$parentsName}}GenderBtnradio" id="{{$parentsName}}GenderInput" autocomplete="off" value="male"
                                                                                    {{ (old($parentsName . 'GenderBtnradio') === 'male' || (isset($arrayData['FamilyDependant']['parents_details'][$parentsName]['gender']) && $arrayData['FamilyDependant']['parents_details'][$parentsName]['gender'] === 'male')) ? 'checked' : '' }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                                </label>
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$parentsName}}GenderBtnradio" id="{{$parentsName}}GenderFemaleInput" autocomplete="off" value="female"
                                                                                    {{ (old($parentsName . 'GenderBtnradio') === 'female' || (isset($arrayData['FamilyDependant']['parents_details'][$parentsName]['gender']) && $arrayData['FamilyDependant']['parents_details'][$parentsName]['gender'] === 'female')) ? 'checked' : '' }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                                </label>
                                                                            </div>
                                                                            @error($parentsName .'GenderBtnradio')
                                                                                <div class="invalid-feedback text-red">The parents's gender field is required.</div>
                                                                            @enderror  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$parentsName}}day" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="{{$parentsName}}Age" class="d-inline-block"></span> )</label>
                                                                            <div class="row">
                                                                                <div class="col-md-4 pb-2 pb-md-0">
                                                                                    {!! Form::select($parentsName . 'day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old($parentsName . 'day', $arrayData['FamilyDependant']['parents_details'][$parentsName]['day'] ?? ''), ['class' => 'form-select' . ($errors->has($parentsName . 'day') ? ' is-invalid' : ''), 'id' => $parentsName . 'day']) !!}
                                                                                </div>
                                                                                <div class="col-md-4 pb-2 pb-md-0">
                                                                                    {!! Form::select($parentsName . 'month', ['' => 'Select'] + $monthNames, old($parentsName . 'month', $arrayData['FamilyDependant']['parents_details'][$parentsName]['month'] ?? ''), ['class' => 'form-select' . ($errors->has($parentsName . 'month') ? ' is-invalid' : ''), 'id' => $parentsName . 'month']) !!}
                                                                                </div>
                                                                                <div class="col-md-4 pb-2 pb-md-0">
                                                                                    {!! Form::select($parentsName . 'year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                        return substr($year, -2);
                                                                                    }, $yearRange), $yearRange), old($parentsName . 'year', $arrayData['FamilyDependant']['parents_details'][$parentsName]['year'] ?? ''), ['class' => 'form-select' . ($errors->has($parentsName . 'year') ? ' is-invalid' : ''), 'id' => $parentsName . 'year']) !!}
                                                                                </div>
                                                                                @if ($errors->has($parentsName . 'day') || $errors->has($parentsName . 'month') || $errors->has($parentsName . 'year'))
                                                                                    <div class="col-md-12">
                                                                                        <div class="invalid-feedback text-red" style="display:block">Please select a day, month, and year.</div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-8 pt-4 @error($parentsName . 'YearsOfSupport') is-invalid @enderror">
                                                                            <label for="{{$parentsName}}YearsOfSupportInput" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                            <input type="number" name="{{$parentsName}}YearsOfSupport" class="form-control" id="{{$parentsName}}YearsOfSupportInput" placeholder="Number of Years" value="{{ old($parentsName . 'YearsOfSupport', $arrayData['FamilyDependant']['parents_details'][$parentsName]['yearsOfSupport'] ?? '') }}" required>
                                                                        </div>
                                                                        @error($parentsName . 'YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-8 pt-4 @error($parentsName . 'MaritalStatus') is-invalid @enderror">
                                                                            <label for="{{$parentsName}}MaritalStatusSelect" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                            <select name="{{$parentsName}}MaritalStatus" class="form-select" aria-label="Parents Marital Status" id="{{$parentsName}}MaritalStatusSelect" required>
                                                                                <option value="" selected disabled>Please Select</option>
                                                                                @foreach ($maritalstatuses as $status)
                                                                                    <option value="{{ $status->maritalStatus }}" {{ old($parentsName . 'MaritalStatus', $arrayData['FamilyDependant']['parents_details'][$parentsName]['maritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error($parentsName . 'MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(isset($arrayData['FamilyDependant']['siblings']['status']) && $arrayData['FamilyDependant']['siblings']['status'] === 'yes')
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingSix">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="true" aria-controls="flush-collapseSix">
                                                                Sibling
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionDependantDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12">
                                                                        <label for="siblingFirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="siblingFirstName" class="form-control @error('siblingFirstName') is-invalid @enderror" id="siblingFirstNameInput" placeholder="Your First Name" value="{{ old('siblingFirstName', $arrayData['FamilyDependant']['siblings']['firstName'] ?? '') }}" required>
                                                                        @error('siblingFirstName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="siblingLastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="siblingLastName" class="form-control @error('siblingLastName') is-invalid @enderror" id="siblingLastNameInput" placeholder="Your Last Name" value="{{ old('siblingLastName', $arrayData['FamilyDependant']['siblings']['lastName'] ?? '') }}" required>
                                                                        @error('siblingLastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="siblingDob" class="form-label">Date of Birth <span class="text-danger">*</span> ( <span id="siblingAge" class="d-inline-block"></span> )</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('siblingday', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('siblingday', $arrayData['FamilyDependant']['siblings']['day'] ?? ''), ['class' => 'form-select' . ($errors->has('siblingday') ? ' is-invalid' : ''), 'id' => 'siblingday']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('siblingmonth', ['' => 'Select'] + $monthNames, old('siblingmonth', $arrayData['FamilyDependant']['siblings']['month'] ?? ''), ['class' => 'form-select' . ($errors->has('siblingmonth') ? ' is-invalid' : ''), 'id' => 'siblingmonth']) !!}
                                                                            </div>
                                                                            <div class="col-md-4 pb-2 pb-md-0">
                                                                                {!! Form::select('siblingyear', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                    return substr($year, -2);
                                                                                }, $yearRange), $yearRange), old('siblingyear', $arrayData['FamilyDependant']['siblings']['year'] ?? ''), ['class' => 'form-select' . ($errors->has('siblingyear') ? ' is-invalid' : ''), 'id' => 'siblingyear']) !!}
                                                                            </div>
                                                                            @if ($errors->has('siblingday') || $errors->has('siblingmonth') || $errors->has('siblingyear'))
                                                                                <div class="col-md-12">
                                                                                    <div class="invalid-feedback text-red" style="display:block">Please select a day, month, and year.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="siblingYearsOfSupport" class="form-label">Years of Support <span class="text-danger">*</span></label>
                                                                        <input type="number" name="siblingYearsOfSupport" class="form-control @error('siblingYearsOfSupport') is-invalid @enderror" id="siblingYearsOfSupportInput" placeholder="Number of Years" value="{{ old('siblingYearsOfSupport', $arrayData['FamilyDependant']['siblings']['yearsOfSupport'] ?? '') }}" required>
                                                                        @error('siblingYearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-8 pt-4">
                                                                        <label for="siblingMaritalStatus" class="form-label">Dependent Marital Status <span class="text-danger">*</span></label>
                                                                        <select name="siblingMaritalStatus" class="form-select @error('siblingMaritalStatus') is-invalid @enderror" aria-label="Siblings Marital Status" id="siblingMaritalStatusSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($maritalstatuses as $status)
                                                                                <option value="{{ $status->maritalStatus }}" {{ old('siblingMaritalStatus', $arrayData['FamilyDependant']['siblings']['maritalStatus'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('siblingMaritalStatus')
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
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="familyDependantButtonInput" id="familyDependantButtonInput" value="{{$familyDependant}}">
                                        <input type="hidden" name="spouseGenderInput" id="spouseGenderInput" value="{{$gender}}">
                                        <a href="{{route('avatar.family.dependant')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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

    setupSelectFieldValidation('spouseTitleSelect');
    setupFieldValidation('spouseFirstNameInput');
    setupFieldValidation('spouseLastNameInput');
    setupSelectFieldValidation('spouseCountrySelect');
    setupSelectFieldValidation('spouseIdSelect');
    setupIDFieldValidation('spouseIdNumber');
    setupSelectFieldValidation('spouseday');
    setupSelectFieldValidation('spousemonth');
    setupSelectFieldValidation('spouseyear');
    setupSelectFieldValidation('spouseOccupationSelect');

    // setupFieldValidation('siblingFirstNameInput');
    // setupFieldValidation('siblingLastNameInput');
    // setupNumberFieldValidation('spouseYearsOfSupportInput');
    // setupNumberFieldValidation('siblingYearsOfSupportInput');
    // setupSelectFieldValidation('spouseMaritalStatusSelect');
    // setupSelectFieldValidation('siblingMaritalStatusSelect');

    var childNames = <?php echo json_encode($arrayData['FamilyDependant']['children']); ?>;
    var parentNames = <?php echo json_encode($arrayData['FamilyDependant']['parents']); ?>;

    childNames.forEach(function(childName) {
        var FirstNameInput = childName + 'FirstNameInput';
        var LastNameInput = childName + 'LastNameInput';
        var DayInput = childName + 'day';
        var MonthInput = childName + 'month';
        var YearInput = childName + 'year';
        var YearsOfSupportInput = childName + 'YearsOfSupportInput';
        var MaritalStatusSelect = childName + 'MaritalStatusSelect';

        setupFieldValidation(FirstNameInput);
        setupFieldValidation(LastNameInput);
        setupSelectFieldValidation(DayInput);
        setupSelectFieldValidation(MonthInput);
        setupSelectFieldValidation(YearInput);
        setupNumberFieldValidation(YearsOfSupportInput);
        setupSelectFieldValidation(MaritalStatusSelect);
    });

    parentNames.forEach(function(parentName) {
        var FirstNameInput = parentName + 'FirstNameInput';
        var LastNameInput = parentName + 'LastNameInput';
        var DayInput = parentName + 'day';
        var MonthInput = parentName + 'month';
        var YearInput = parentName + 'year';
        var YearsOfSupportInput = parentName + 'YearsOfSupportInput';
        var MaritalStatusSelect = parentName + 'MaritalStatusSelect';

        setupFieldValidation(FirstNameInput);
        setupFieldValidation(LastNameInput);
        setupSelectFieldValidation(DayInput);
        setupSelectFieldValidation(MonthInput);
        setupSelectFieldValidation(YearInput);
        setupNumberFieldValidation(YearsOfSupportInput);
        setupSelectFieldValidation(MaritalStatusSelect);
    });

    function setupFieldValidation(inputId) {
        var field = document.getElementById(inputId);
        if (field) {
            field.addEventListener('blur', function() {
                validateInputField(field);
            });
        }
    }

    function setupIDFieldValidation(inputId) {
        var field = document.getElementById(inputId);
        if (field) {
            field.addEventListener('blur', function() {
                validateIDField(field);
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

    function validateIDField(field) {
        if (field.value && isValidIdNumber(field.value)) {
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

    function isValidIdNumber(spouseIdNumber) {
        var idNumberRegex = /^\d{6}-\d{2}-\d{4}$/;  // Regular expression to match only digits

        // Test the mobile number against the regex pattern
        var isValid = idNumberRegex.test(spouseIdNumber);

        return isValid;
    }

    function isValidSupportYears(spouseYearsOfSupport) {
        var supportYearsRegex = /^\d+$/;  // Regular expression to match only digits

        if (!supportYearsRegex.test(spouseYearsOfSupport)) {
            return false;
        }

        var isValid = parseInt(spouseYearsOfSupport, 10);
        return isValid <= 100;
    }


    // Add event listeners to detect changes in the selected values for each entity
    if (childNames) {
        childNames.forEach(function(childName) {
            setupAgeCalculation(childName);
        });

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
                    ageDiv.textContent = 'Age:';
                }
            } else {
                ageDiv.textContent = 'Age:';
            }
        }
    }

    if (parentNames) {
        parentNames.forEach(function(parentName) {
            setupAgeCalculation(parentName);
        });

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
                    ageDiv.textContent = 'Age:';
                }
            } else {
                ageDiv.textContent = 'Age:';
            }
        }
    }
});
</script>
@endsection