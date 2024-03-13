<?php
 /**
 * Template Name: Family Dependent Details Page
 */
?>

@extends('templates.master')

@section('title')
<title>Family Dependent Details</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $familyDependent = session('customer_details.family_details');
    $maritalStatus = session('customer_details.identity_details');
    $spouseData = session('customer_details.family_details.spouse_data');
    $childrenData = session('customer_details.family_details.children_data');
    $parentsData = session('customer_details.family_details.parents_data');
    $siblingsData = session('customer_details.family_details.siblings_data');
    $childKeys = is_array($childrenData) ? array_keys($childrenData) : [];
    $parentKeys = is_array($parentsData) ? array_keys($parentsData) : [];
    $selectedCountry = session('passingArrays.Country', '');
@endphp

<div id="avatar_family_dependent_details">
    <div class="container-fluid">
        <div class="row parallax-section">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 main-default-bg wrapper-avatar-default px-0 parallax-inner parallax-top">
                <div class="header"><div class="row">@include('templates.nav.nav-red-red-menu')</div></div>
                <section class="avatar-design-placeholder content-avatar-default overflow-hidden">
                    <div class="position-relative imageContainerParents"></div>
                    <div class="position-relative d-flex justify-content-center imageContainerSpouse">
                        <img src="{{ asset($image) }}" width="auto" height="100%" alt="Avatar" class="changePosition">
                    </div>
                    <div class="position-relative d-flex justify-content-center imageContainerChildren"></div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 parallax-inner parallax-bottom z-index-1">
                <div class="scrollable-content">
                    <form novalidate action="{{ route('form.family.dependent.details') }}" method="POST" id="familyDetailsForm">
                        @csrf
                        <section class="main-content">
                            <div class="container">
                                <div class="row px-4 pt-4 pb-2 px-md-5 pt-md-5 right-sidebar">
                                    <div class="col-12">
                                        <h1 class="display-4 text-white pb-md-3 fw-bold">Thanks for introducing your family!</h1>
                                        <p class="text-white display-6">Tell us more about each of them.</p>
                                    </div>
                                </div>
                                <div class="form-container pb-0 pb-md-5">
                                    @if ($errors->any())
                                        <div class="row px-4 pb-3 px-md-5">
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
                                    <div class="row px-4 pb-2 px-md-5">
                                        <div class="col-12">
                                            <div class="accordion accordion-flush" id="accordionDependentDetails">
                                                @php
                                                    // Get the current year, month, and day
                                                    $currentYear = date('Y');

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

                                                    $yearRange = range($currentYear - 100, $currentYear);

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
                                                @if(isset($familyDependent['spouse']) && $familyDependent['spouse'] === true)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Spouse
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionDependentDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12 col-lg-7 col-md-12 col-sm-12">
                                                                        <label for="spouseTitleSelect" class="form-label">Title <span class="text-danger">*</span></label>
                                                                        <select name="spouseTitle" class="form-select @error('spouseTitle') is-invalid @enderror" aria-label="Title" id="spouseTitleSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($titles as $title)
                                                                                <option value="{{ $title->titles }}" {{ old('spouseTitle', $spouseData['title'] ?? '') === $title->titles ? 'selected' : '' }}>{{ $title->titles }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('spouseTitle')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="spouseFullNameInput" class="form-label">Full Name (as per I.C) <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseFullName" class="form-control @error('spouseFullName') is-invalid @enderror" id="spouseFullNameInput" placeholder="Your Full Name" value="{{ old('spouseFullName', $spouseData['full_name'] ?? '') }}" required>
                                                                        @error('spouseFullName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="spouseLastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseLastName" class="form-control @error('spouseLastName') is-invalid @enderror" id="spouseLastNameInput" placeholder="Your Last Name" value="{{ old('spouseLastName', $spouseData['last_name'] ?? '') }}" required>
                                                                        @error('spouseLastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div> -->
                                                                <div class="row py-2">
                                                                    <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4">
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
                                                                    <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error('spouseIdType') is-invalid @enderror">
                                                                        <label for="spouseIdSelect" class="form-label">ID Type <span class="text-danger">*</span></label>
                                                                        <select name="spouseIdType" class="form-select" aria-label="ID Type" id="spouseIdSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($idtypes as $idtype)
                                                                                <option value="{{ $idtype->idtypes }}" {{ old('spouseIdType', $spouseData['id_type'] ?? '') === $idtype->idtypes ? 'selected' : '' }}>{{ $idtype->idtypes }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @error('spouseIdType')
                                                                        <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="row py-2" id="groups">
                                                                    <div class="col-12 pt-4" id="newicgroup" style="display: none;">
                                                                        <label for="spouseIdNumber" class="form-label">ID Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseIdNumber" class="form-control @error('spouseIdNumber') is-invalid @enderror" id="spouseIdNumber" placeholder="xxxxxx-xx-xxxx" value="{{ old('spouseIdNumber', $spouseData['id_number'] ?? '') }}">
                                                                        @error('spouseIdNumber')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="passportgroup" style="display: none;">
                                                                        <label for="spousePassportNumber" class="form-label">Passport Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spousePassportNumber" class="form-control @error('spousePassportNumber') is-invalid @enderror" id="spousePassportNumber" placeholder="A122345" value="{{ old('spousePassportNumber', $spouseData['passport_number'] ?? '') }}">
                                                                        @error('spousePassportNumber')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="birthcertgroup" style="display: none;">
                                                                        <label for="spouseBirthCert" class="form-label">Birth Certificate Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseBirthCert" class="form-control @error('spouseBirthCert') is-invalid @enderror" id="spouseBirthCert" placeholder="T122345" value="{{ old('spouseBirthCert', $spouseData['birth_cert'] ?? '') }}">
                                                                        @error('spouseBirthCert')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="policegroup" style="display: none;">
                                                                        <label for="spousePoliceNumber" class="form-label">Police / Army Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spousePoliceNumber" class="form-control @error('spousePoliceNumber') is-invalid @enderror" id="spousePoliceNumber" placeholder="Enter Police / Army Number" value="{{ old('spousePoliceNumber', $spouseData['police_number'] ?? '') }}">
                                                                        @error('spousePoliceNumber')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12 pt-4" id="registrationgroup" style="display: none;">
                                                                        <label for="spouseRegistrationNumber" class="form-label">Registration Number <span class="text-danger">*</span></label>
                                                                        <input type="text" name="spouseRegistrationNumber" class="form-control @error('spouseRegistrationNumber') is-invalid @enderror" id="spouseRegistrationNumber" placeholder="Enter Registration Number" value="{{ old('spouseRegistrationNumber', $spouseData['registration_number'] ?? '') }}">
                                                                        @error('spouseRegistrationNumber')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">                                                                        
                                                                        <label for="spouseday" class="form-label">Date of Birth <span class="text-danger">*</span> <span id="spouseAgeDiv">( <div id="spouseAge" class="d-inline-block"></div> )</span></label>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                @if(isset($spouseData['dob']))
                                                                                    {!! Form::select('day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('day', substr($spouseData['dob'], -2)), ['class' => 'form-select' . ($errors->has('day') ? ' is-invalid' : ''), 'id' => 'spouseday']) !!}
                                                                                @else
                                                                                    {!! Form::select('day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('day'), ['class' => 'form-select' . ($errors->has('day') ? ' is-invalid' : ''), 'id' => 'spouseday']) !!}
                                                                                @endif
                                                                                </div>
                                                                            <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                @if(isset($spouseData['dob']))
                                                                                    {!! Form::select('month', ['' => 'Select'] + $monthNames, old('month', substr($spouseData['dob'], 5, 2)), ['class' => 'form-select' . ($errors->has('month') ? ' is-invalid' : ''), 'id' => 'spousemonth']) !!}
                                                                                @else
                                                                                    {!! Form::select('month', ['' => 'Select'] + $monthNames, old('month'), ['class' => 'form-select' . ($errors->has('month') ? ' is-invalid' : ''), 'id' => 'spousemonth']) !!}
                                                                                @endif
                                                                                </div>
                                                                            <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                @if(isset($spouseData['dob']))
                                                                                    {!! Form::select('year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                        return substr($year, 0, 4);
                                                                                    }, $yearRange), $yearRange), old('year', substr($spouseData['dob'], 0, 4)), ['class' => 'form-select' . ($errors->has('year') ? ' is-invalid' : ''), 'id' => 'spouseyear']) !!}
                                                                                @else
                                                                                    {!! Form::select('year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                        return substr($year, 0, 4);
                                                                                    }, $yearRange), $yearRange), old('year'), ['class' => 'form-select' . ($errors->has('year') ? ' is-invalid' : ''), 'id' => 'spouseyear']) !!}
                                                                                @endif
                                                                                </div>
                                                                            @if ($errors->has('day') || $errors->has('month') || $errors->has('year'))
                                                                                <div class="col-md-12">
                                                                                    @if ($errors->has('year'))
                                                                                        <div class="invalid-feedback text-red" style="display:block">{{ $errors->first('year') }}</div>
                                                                                    @elseif ($errors->has('month'))
                                                                                        <div class="invalid-feedback text-red" style="display:block">{{ $errors->first('month') }}</div>
                                                                                    @elseif ($errors->has('day'))
                                                                                        <div class="invalid-feedback text-red" style="display:block">{{ $errors->first('day') }}</div>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="spouseMaleInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                        <div class="d-flex btn-group @error('gender') is-invalid @enderror" role="group">
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="gender" id="spouseMaleInput" autocomplete="off" value="Male"
                                                                                {{ (old('gender') === 'Male' || (isset($spouseData['gender']) && $spouseData['gender'] === 'Male')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                            </label>
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="gender" id="spouseFemaleInput" autocomplete="off" value="Female"
                                                                                {{ (old('gender') === 'Female' || (isset($spouseData['gender']) && $spouseData['gender'] === 'Female')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                            </label>
                                                                        </div>
                                                                        @error('gender')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror  
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="smoker" class="form-label">Your Habits <span class="text-danger">*</span></label>
                                                                        <div class="d-flex btn-group @error('habits') is-invalid @enderror" role="group">
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="habits" id="smoker" autocomplete="off" value="Smoker"
                                                                                {{ (old('habits') === 'Smoker' || (isset($spouseData['habits']) && $spouseData['habits'] === 'Smoker')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Smoker</span>
                                                                            </label>
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="habits" id="nonSmoker" autocomplete="off" value="Non-Smoker"
                                                                                {{ (old('habits') === 'Non-Smoker' || (isset($spouseData['habits']) && $spouseData['habits'] === 'Non-Smoker')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Non-Smoker</span>
                                                                            </label>
                                                                        </div>
                                                                        @error('habits')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror  
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error('spouseOccupation') is-invalid @enderror">
                                                                        <label for="spouseOccupationSelect" class="form-label">Occupation <span class="text-danger">*</span></label>
                                                                        <select name="spouseOccupation" class="form-select" aria-label="Countries" id="spouseOccupationSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($occupations as $occupation)
                                                                                <option value="{{ $occupation->name }}" {{ old('spouseOccupation', $spouseData['occupation'] ?? '') === $occupation->name ? 'selected' : '' }}>{{ $occupation->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @error('spouseOccupation')
                                                                        <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($familyDependent['children']) && $familyDependent['children'] === true)
                                                    @foreach ($childrenData as $key => $value)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{$key}}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$key}}" aria-expanded="true" aria-controls="flush-collapse{{$key}}">
                                                                {{$value['relation']}}
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$key}}" data-bs-parent="#accordionDependentDetails">
                                                                <div class="accordion-body">
                                                                    <div class="row py-2">
                                                                        <div class="col-12">
                                                                            <label for="{{$key}}FullNameInput" class="form-label">Full Name (as per I.C) <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$key}}FullName" class="form-control @error($key . 'FullName') is-invalid @enderror" id="{{$key}}FullNameInput" placeholder="Your Full Name" value="{{ old($key . 'FullName', $childrenData[$key]['full_name'] ?? '') }}" required>
                                                                            @error($key . 'FullName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$key}}LastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$key}}LastName" class="form-control @error($key . 'LastName') is-invalid @enderror" id="{{$key}}LastNameInput" placeholder="Your Last Name" value="{{ old($key . 'LastName', $childrenData[$key]['last_name'] ?? '') }}" required>
                                                                            @error($key . 'LastName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$key}}GenderMaleInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                            <div class="d-flex btn-group @error($key . 'Gender') is-invalid @enderror" role="group">
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$key}}Gender" id="{{$key}}GenderMaleInput" autocomplete="off" value="Male"
                                                                                    {{ (old($key . 'Gender') === 'Male' || (isset($childrenData[$key]['gender']) && $childrenData[$key]['gender'] === 'Male')) ? 'checked' : '' }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                                </label>
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$key}}Gender" id="{{$key}}GenderFemaleInput" autocomplete="off" value="Female"
                                                                                    {{ (old($key . 'Gender') === 'Female' || (isset($childrenData[$key]['gender']) && $childrenData[$key]['gender'] === 'Female')) ? 'checked' : '' }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                                </label>
                                                                            </div>
                                                                            @error($key .'Gender')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$key}}day" class="form-label">Date of Birth <span class="text-danger">*</span> <span id="{{$key}}AgeDiv">( <div id="{{$key}}Age" class="d-inline-block"></div> )</span></label>
                                                                            <div class="row">
                                                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                    @if(isset($childrenData[$key]['dob']))
                                                                                        {{ Form::select($key . 'day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old($key . 'day', substr($childrenData[$key]['dob'], -2)), ['class' => 'form-select' . ($errors->has($key . 'day') ? ' is-invalid' : ''), 'id' => $key . 'day']) }}
                                                                                    @else
                                                                                        {{ Form::select($key . 'day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old($key . 'day'), ['class' => 'form-select' . ($errors->has($key . 'day') ? ' is-invalid' : ''), 'id' => $key . 'day']) }}
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                    @if(isset($childrenData[$key]['dob']))
                                                                                        {{ Form::select($key .'month', ['' => 'Select'] + $monthNames, old($key .'month', substr($childrenData[$key]['dob'], 5, 2)), ['class' => 'form-select' . ($errors->has($key .'month') ? ' is-invalid' : ''), 'id' => $key . 'month']) }}
                                                                                    @else
                                                                                        {{ Form::select($key .'month', ['' => 'Select'] + $monthNames, old($key .'month'), ['class' => 'form-select' . ($errors->has($key .'month') ? ' is-invalid' : ''), 'id' => $key . 'month']) }}
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                    @if(isset($childrenData[$key]['dob']))
                                                                                        {{ Form::select($key . 'year', ['' => 'Select'] + array_combine(array_map(function ($year) { return substr($year, 0, 4); }, $yearRange), $yearRange), old($key . 'year', substr($childrenData[$key]['dob'], 0, 4)), ['class' => 'form-select' . ($errors->has($key . 'year') ? ' is-invalid' : ''), 'id' => $key . 'year']) }}
                                                                                    @else
                                                                                    {{ Form::select($key . 'year', ['' => 'Select'] + array_combine(array_map(function ($year) { return substr($year, 0, 4); }, $yearRange), $yearRange), old($key . 'year'), ['class' => 'form-select' . ($errors->has($key . 'year') ? ' is-invalid' : ''), 'id' => $key . 'year']) }}
                                                                                    @endif
                                                                                </div>
                                                                                @if ($errors->has($key . 'day') || $errors->has($key . 'month') || $errors->has($key . 'year'))
                                                                                    <div class="col-md-12">
                                                                                        @if ($errors->has($key . 'year'))
                                                                                            <div class="invalid-feedback text-red" style="display:block">{{ $errors->first($key . 'year') }}</div>
                                                                                        @elseif ($errors->has($key . 'month'))
                                                                                            <div class="invalid-feedback text-red" style="display:block">{{ $errors->first($key . 'month') }}</div>
                                                                                        @elseif ($errors->has($key . 'day'))
                                                                                            <div class="invalid-feedback text-red" style="display:block">{{ $errors->first($key . 'day') }}</div>
                                                                                        @endif
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error($key .'YearsOfSupport') is-invalid @enderror">
                                                                            <label for="{{$key}}YearsOfSupportInput" class="form-label">No. of Years of Support Needed <span class="text-danger">*</span></label>
                                                                            <input type="number" name="{{$key}}YearsOfSupport" class="form-control" id="{{$key}}YearsOfSupportInput" placeholder="Number of Years" value="{{ old($key . 'YearsOfSupport', $childrenData[$key]['years_support'] ?? '') }}" required>
                                                                        </div>
                                                                        @error($key . 'YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error($key . 'MaritalStatus') is-invalid @enderror">
                                                                            <label for="{{$key}}MaritalStatusSelect" class="form-label">Dependent's Marital Status​ <span class="text-danger">*</span></label>
                                                                            <select name="{{$key}}MaritalStatus" class="form-select" aria-label="Child Marital Status" id="{{$key}}MaritalStatusSelect" required>
                                                                                <option value="" selected disabled>Please Select</option>
                                                                                @foreach ($maritalstatuses as $status)
                                                                                    <option value="{{ $status->maritalStatus }}" {{ old($key .'MaritalStatus', $childrenData[$key]['marital_status'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error($key . 'MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(isset($familyDependent['parents']) && $familyDependent['parents'] === true)
                                                    @foreach ($parentsData as $key => $value)
                                                    <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{$key}}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$key}}" aria-expanded="true" aria-controls="flush-collapse{{$key}}">
                                                                    Parent ({{ $key }})
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$key}}" data-bs-parent="#accordionDependentDetails">
                                                                <div class="accordion-body">
                                                                    <div class="row py-2">
                                                                        <div class="col-12">
                                                                            <label for="{{$key}}FullNameInput" class="form-label">Full Name (as per I.C) <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$key}}FullName" class="form-control @error($key . 'FullName') is-invalid @enderror" id="{{$key}}FullNameInput" placeholder="Your Full Name" value="{{ old($key . 'FullName', $parentsData[$key]['full_name'] ?? '') }}" required>
                                                                            @error($key . 'FullName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$key}}LastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="{{$key}}LastName" class="form-control @error($key . 'LastName') is-invalid @enderror" id="{{$key}}LastNameInput" placeholder="Your Last Name" value="{{ old($key . 'LastName', $parentsData[$key]['last_name'] ?? '') }}" required>
                                                                            @error($key . 'LastName')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$key}}GenderMaleInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                            <div class="d-flex btn-group @error($key . 'Gender') is-invalid @enderror" role="group">
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$key}}Gender" id="{{$key}}GenderMaleInput" autocomplete="off" value="Male"
                                                                                    {{ (old($key . 'Gender') === 'Male' || (isset($parentsData[$key]['gender']) && $parentsData[$key]['gender'] === 'Male')) ? 'checked' : ($key == 'father' ? 'checked' : '') }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                                </label>
                                                                                <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                    <input type="radio" class="btn-check" name="{{$key}}Gender" id="{{$key}}GenderFemaleInput" autocomplete="off" value="Female"
                                                                                    {{ (old($key . 'Gender') === 'Female' || (isset($parentsData[$key]['gender']) && $parentsData[$key]['gender'] === 'Female')) ? 'checked' : ($key == 'mother' ? 'checked' : '') }}>
                                                                                    <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                                </label>
                                                                            </div>
                                                                            @error($key .'Gender')
                                                                                <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                            @enderror  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 pt-4">
                                                                            <label for="{{$key}}day" class="form-label">Date of Birth <span class="text-danger">*</span> <span id="{{$key}}AgeDiv">( <div id="{{$key}}Age" class="d-inline-block"></div> )</span></label>
                                                                            <div class="row">
                                                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                    @if(isset($parentsData[$key]['dob']))
                                                                                        {!! Form::select($key . 'day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old($key . 'day', substr($parentsData[$key]['dob'], -2)), ['class' => 'form-select' . ($errors->has($key . 'day') ? ' is-invalid' : ''), 'id' => $key . 'day']) !!}
                                                                                    @else
                                                                                        {!! Form::select($key . 'day', ['' => 'Select'] + array_combine($dateRange, $dateRange), old($key . 'day'), ['class' => 'form-select' . ($errors->has($key . 'day') ? ' is-invalid' : ''), 'id' => $key . 'day']) !!}
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                    @if(isset($parentsData[$key]['dob']))
                                                                                        {!! Form::select($key . 'month', ['' => 'Select'] + $monthNames, old($key . 'month', substr($parentsData[$key]['dob'], 5, 2)), ['class' => 'form-select' . ($errors->has($key . 'month') ? ' is-invalid' : ''), 'id' => $key . 'month']) !!}
                                                                                    @else
                                                                                        {!! Form::select($key . 'month', ['' => 'Select'] + $monthNames, old($key . 'month'), ['class' => 'form-select' . ($errors->has($key . 'month') ? ' is-invalid' : ''), 'id' => $key . 'month']) !!}
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                    @if(isset($parentsData[$key]['dob']))
                                                                                        {!! Form::select($key . 'year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                            return substr($year, 0, 4);
                                                                                        }, $yearRange), $yearRange), old($key . 'year', substr($parentsData[$key]['dob'], 0, 4)), ['class' => 'form-select' . ($errors->has($key . 'year') ? ' is-invalid' : ''), 'id' => $key . 'year']) !!}
                                                                                    @else
                                                                                        {!! Form::select($key . 'year', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                            return substr($year, 0, 4);
                                                                                        }, $yearRange), $yearRange), old($key . 'year'), ['class' => 'form-select' . ($errors->has($key . 'year') ? ' is-invalid' : ''), 'id' => $key . 'year']) !!}
                                                                                    @endif
                                                                                </div>
                                                                                @if ($errors->has($key . 'day') || $errors->has($key . 'month') || $errors->has($key . 'year'))
                                                                                    <div class="col-md-12">
                                                                                        @if ($errors->has($key . 'year'))
                                                                                            <div class="invalid-feedback text-red" style="display:block">{{ $errors->first($key . 'year') }}</div>
                                                                                        @elseif ($errors->has($key . 'month'))
                                                                                            <div class="invalid-feedback text-red" style="display:block">{{ $errors->first($key . 'month') }}</div>
                                                                                        @elseif ($errors->has($key . 'day'))
                                                                                            <div class="invalid-feedback text-red" style="display:block">{{ $errors->first($key . 'day') }}</div>
                                                                                        @endif
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error($key . 'YearsOfSupport') is-invalid @enderror">
                                                                            <label for="{{$key}}YearsOfSupportInput" class="form-label">No. of Years of Support Needed <span class="text-danger">*</span></label>
                                                                            <input type="number" name="{{$key}}YearsOfSupport" class="form-control" id="{{$key}}YearsOfSupportInput" placeholder="Number of Years" value="{{ old($key . 'YearsOfSupport', $parentsData[$key]['years_support'] ?? '') }}" required>
                                                                        </div>
                                                                        @error($key . 'YearsOfSupport')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="row py-2">
                                                                        <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error($key . 'MaritalStatus') is-invalid @enderror">
                                                                            <label for="{{$key}}MaritalStatusSelect" class="form-label">Dependent's Marital Status <span class="text-danger">*</span></label>
                                                                            <select name="{{$key}}MaritalStatus" class="form-select" aria-label="Parents Marital Status" id="{{$key}}MaritalStatusSelect" required>
                                                                                <option value="" selected disabled>Please Select</option>
                                                                                @foreach ($maritalstatuses as $status)
                                                                                    <option value="{{ $status->maritalStatus }}" {{ old($key . 'MaritalStatus', $parentsData[$key]['marital_status'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error($key . 'MaritalStatus')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(isset($familyDependent['siblings']) && $familyDependent['siblings'] === true)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingSibling">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSibling" aria-expanded="true" aria-controls="flush-collapseSibling">
                                                                Sibling
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseSibling" class="accordion-collapse collapse" aria-labelledby="flush-headingSibling" data-bs-parent="#accordionDependentDetails">
                                                            <div class="accordion-body">
                                                                <div class="row py-2">
                                                                    <div class="col-12">
                                                                        <label for="siblingFullNameInput" class="form-label">Full Name (as per I.C) <span class="text-danger">*</span></label>
                                                                        <input type="text" name="siblingFullName" class="form-control @error('siblingFullName') is-invalid @enderror" id="siblingFullNameInput" placeholder="Your Full Name" value="{{ old('siblingFullName', $siblingsData['full_name'] ?? '') }}" required>
                                                                        @error('siblingFullName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="siblingLastNameInput" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="siblingLastName" class="form-control @error('siblingLastName') is-invalid @enderror" id="siblingLastNameInput" placeholder="Your Last Name" value="{{ old('siblingLastName', $siblingsData['last_name'] ?? '') }}" required>
                                                                        @error('siblingLastName')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div> -->
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="siblingGenderMaleInput" class="form-label">Gender <span class="text-danger">*</span></label>
                                                                        <div class="d-flex btn-group @error('siblingGender') is-invalid @enderror" role="group">
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="siblingGender" id="siblingGenderMaleInput" autocomplete="off" value="Male"
                                                                                {{ (old('siblingGender') === 'Male' || (isset($siblingsData['gender']) && $siblingsData['gender'] === 'Male')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Male</span>
                                                                            </label>
                                                                            <label class="radio-container d-flex justify-content-center align-items-center flex-1">
                                                                                <input type="radio" class="btn-check" name="siblingGender" id="siblingGenderFemaleInput" autocomplete="off" value="Female"
                                                                                {{ (old('siblingGender') === 'Female' || (isset($siblingsData['gender']) && $siblingsData['gender'] === 'Female')) ? 'checked' : '' }}>
                                                                                <span class="btn btn-outline-primary d-flex justify-content-center align-items-center h-100">Female</span>
                                                                            </label>
                                                                        </div>
                                                                        @error('siblingGender')
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror  
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 pt-4">
                                                                        <label for="siblingday" class="form-label">Date of Birth <span class="text-danger">*</span> <span id="siblingAgeDiv">( <div id="siblingAge" class="d-inline-block"></div> )</span></label>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                @if(isset($siblingsData['dob']))
                                                                                    {!! Form::select('siblingday', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('siblingday', substr($siblingsData['dob'], -2)), ['class' => 'form-select' . ($errors->has('siblingday') ? ' is-invalid' : ''), 'id' => 'siblingday']) !!}
                                                                                @else
                                                                                    {!! Form::select('siblingday', ['' => 'Select'] + array_combine($dateRange, $dateRange), old('siblingday'), ['class' => 'form-select' . ($errors->has('siblingday') ? ' is-invalid' : ''), 'id' => 'siblingday']) !!}
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                @if(isset($siblingsData['dob']))
                                                                                    {!! Form::select('siblingmonth', ['' => 'Select'] + $monthNames, old('siblingmonth', substr($siblingsData['dob'], 5, 2)), ['class' => 'form-select' . ($errors->has('siblingmonth') ? ' is-invalid' : ''), 'id' => 'siblingmonth']) !!}
                                                                                @else
                                                                                    {!! Form::select('siblingmonth', ['' => 'Select'] + $monthNames, old('siblingmonth'), ['class' => 'form-select' . ($errors->has('siblingmonth') ? ' is-invalid' : ''), 'id' => 'siblingmonth']) !!}
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-12 col-sm-4 pb-2 pb-lg-0">
                                                                                @if(isset($siblingsData['dob']))
                                                                                    {!! Form::select('siblingyear', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                        return substr($year, 0, 4);
                                                                                    }, $yearRange), $yearRange), old('siblingyear', substr($siblingsData['dob'], 0, 4)), ['class' => 'form-select' . ($errors->has('siblingyear') ? ' is-invalid' : ''), 'id' => 'siblingyear']) !!}
                                                                                @else
                                                                                    {!! Form::select('siblingyear', ['' => 'Select'] + array_combine(array_map(function ($year) {
                                                                                        return substr($year, 0, 4);
                                                                                    }, $yearRange), $yearRange), old('siblingyear'), ['class' => 'form-select' . ($errors->has('siblingyear') ? ' is-invalid' : ''), 'id' => 'siblingyear']) !!}
                                                                                @endif
                                                                            </div>
                                                                            @if ($errors->has('siblingday') || $errors->has('siblingmonth') || $errors->has('siblingyear'))
                                                                                <div class="col-md-12">
                                                                                    @if ($errors->has('siblingyear'))
                                                                                        <div class="invalid-feedback text-red" style="display:block">{{ $errors->first('siblingyear') }}</div>
                                                                                    @elseif ($errors->has('siblingmonth'))
                                                                                        <div class="invalid-feedback text-red" style="display:block">{{ $errors->first('siblingmonth') }}</div>
                                                                                    @elseif ($errors->has('siblingday'))
                                                                                        <div class="invalid-feedback text-red" style="display:block">{{ $errors->first('siblingday') }}</div>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error('siblingYearsOfSupport') is-invalid @enderror">
                                                                        <label for="siblingYearsOfSupportInput" class="form-label">No. of Years of Support Needed <span class="text-danger">*</span></label>
                                                                        <input type="number" name="siblingYearsOfSupport" class="form-control" id="siblingYearsOfSupportInput" placeholder="Number of Years" value="{{ old('siblingYearsOfSupport', $siblingsData['years_support'] ?? '') }}" required>
                                                                    </div>
                                                                    @error('siblingYearsOfSupport')
                                                                        <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="row py-2">
                                                                    <div class="col-12 col-lg-7 col-md-12 col-sm-12 pt-4 @error('siblingMaritalStatus') is-invalid @enderror">
                                                                        <label for="siblingMaritalStatusSelect" class="form-label">Dependent's Marital Status <span class="text-danger">*</span></label>
                                                                        <select name="siblingMaritalStatus" class="form-select" aria-label="Siblings Marital Status" id="siblingMaritalStatusSelect" required>
                                                                            <option value="" selected disabled>Please Select</option>
                                                                            @foreach ($maritalstatuses as $status)
                                                                                <option value="{{ $status->maritalStatus }}" {{ old('siblingMaritalStatus', $siblingsData['marital_status'] ?? '') === $status->maritalStatus ? 'selected' : '' }}>{{ $status->maritalStatus }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @error('siblingMaritalStatus')
                                                                        <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                    @enderror
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
                        <div class="bottomObeserver"></div>
                        <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <!-- Add a hidden input field to store the selected button -->
                                        <input type="hidden" name="familyDependentButtonInput" id="familyDependentButtonInput" value="{{ json_encode($familyDependent) }}">
                                        <a href="{{route('family.dependent')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
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

@if (empty($maritalStatus))
    @php
        $missingPage = 'Marital Status';
    @endphp
@elseif((!isset($familyDependent['spouse']) || $familyDependent['spouse'] === false) && (!isset($familyDependent['children']) || $familyDependent['children'] === false) && (!isset($familyDependent['parents']) || $familyDependent['parents'] === false) && (!isset($familyDependent['siblings']) || $familyDependent['siblings'] === false))
    @php
        $missingPage = 'Family Dependent';
    @endphp
@else
    @php
        $missingPage = '';
    @endphp
@endif

<!-- Modal -->
<div class="modal fade" id="missingFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingFieldsLabel">{{$missingPage}} is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to fill up the form in {{$missingPage}} page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
var spouse_session = {!! json_encode(session('customer_details.family_details.spouse')) !!};
var siblings_session = {!! json_encode(session('customer_details.family_details.siblings')) !!};
var gender_session = {!! json_encode(session('customer_details.avatar.gender')) !!};
var family_details = {!! json_encode(session('customer_details.family_details')) !!};
var marital_status = {!! json_encode(session('customer_details.identity_details.marital_status')) !!};

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
    setupFieldValidation('spouseFullNameInput');
    // setupFieldValidation('spouseLastNameInput');
    setupSelectFieldValidation('spouseCountrySelect');
    setupSelectFieldValidation('spouseIdSelect');
    setupIDFieldValidation('spouseIdNumber');
    setupSelectFieldValidation('spouseday');
    setupSelectFieldValidation('spousemonth');
    setupSelectFieldValidation('spouseyear');
    setupSelectFieldValidation('spouseOccupationSelect');

    setupFieldValidation('siblingFullNameInput');
    setupSelectFieldValidation('siblingday');
    setupSelectFieldValidation('siblingmonth');
    setupSelectFieldValidation('siblingyear');
    setupNumberFieldValidation('siblingYearsOfSupportInput');
    setupSelectFieldValidation('siblingMaritalStatusSelect');

    var childNames = <?php echo json_encode($childKeys); ?>;
    var parentNames = <?php echo json_encode($parentKeys); ?>;

    childNames.forEach(function(childName) {
        var FullNameInput = childName + 'FullNameInput';
        // var LastNameInput = childName + 'LastNameInput';
        var DayInput = childName + 'day';
        var MonthInput = childName + 'month';
        var YearInput = childName + 'year';
        var YearsOfSupportInput = childName + 'YearsOfSupportInput';
        var MaritalStatusSelect = childName + 'MaritalStatusSelect';

        setupFieldValidation(FullNameInput);
        // setupFieldValidation(LastNameInput);
        setupSelectFieldValidation(DayInput);
        setupSelectFieldValidation(MonthInput);
        setupSelectFieldValidation(YearInput);
        setupNumberFieldValidation(YearsOfSupportInput);
        setupSelectFieldValidation(MaritalStatusSelect);
    });

    parentNames.forEach(function(parentName) {
        var FullNameInput = parentName + 'FullNameInput';
        // var LastNameInput = parentName + 'LastNameInput';
        var DayInput = parentName + 'day';
        var MonthInput = parentName + 'month';
        var YearInput = parentName + 'year';
        var YearsOfSupportInput = parentName + 'YearsOfSupportInput';
        var MaritalStatusSelect = parentName + 'MaritalStatusSelect';

        setupFieldValidation(FullNameInput);
        // setupFieldValidation(LastNameInput);
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
        if (field.value && isValidName(field.value)) {
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

    function isValidName(name) {
        // Return true if the email is valid, false otherwise
        var nameRegex = /^[A-Za-z,\s\/]{1,100}$/;

        var isValid = nameRegex.test(name);

        return isValid;
    }

    function isValidIdNumber(spouseIdNumber) {
        var idNumberRegex = /^[0-9]{6}-[0-9]{2}-[0-9]{4}$/;  // Regular expression to match only digits

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
    }

    if (parentNames) {
        parentNames.forEach(function(parentName) {
            setupAgeCalculation(parentName);
        });
    }

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
        
        var ageField = document.getElementById(entity + 'Age');
        var ageDiv = document.getElementById(entity + 'AgeDiv');
        
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
                
                if (!isNaN(age)) {
                    ageField.textContent = 'Age: ' + age;
                    ageDiv.style.display = 'inline-block';
                }
                
            } else {
                ageDiv.style.display = 'none';
                ageField.textContent = 'Age:';
            }
        } else {
            ageDiv.style.display = 'none';
            ageField.textContent = 'Age:';
        }
    }
});
</script>
@endsection