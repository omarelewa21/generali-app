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
                                                                            <div class="invalid-feedback text-red">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($arrayData['familyDependant']) && in_array('child_1', $arrayData['familyDependant']))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                Child 1
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
    var spouseFirstNameInput = document.getElementById('spouseFirstNameInput');
    var spouseLastNameInput = document.getElementById('spouseLastNameInput');
    var spouseYearsOfSupportInput = document.getElementById('spouseYearsOfSupportInput');
    var spouseMaritalStatusSelect = document.getElementById('spouseMaritalStatusSelect');

    spouseFirstNameInput.addEventListener('blur', function() {
        validateInputField(spouseFirstNameInput);
    });

    spouseLastNameInput.addEventListener('blur', function() {
        validateInputField(spouseLastNameInput);
    });

    spouseYearsOfSupportInput.addEventListener('blur', function() {
        validateNumberField(spouseYearsOfSupportInput);
    });

    spouseMaritalStatusSelect.addEventListener('blur', function() {
        validateSelectField(spouseMaritalStatusSelect);
    });

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

// Age Logics
// Get references to the day, month, and year select elements
var daySelect = document.getElementById('spouseday');
var monthSelect = document.getElementById('spousemonth');
var yearSelect = document.getElementById('spouseyear');

// Add event listeners to detect changes in the selected values
daySelect.addEventListener('change', calculateAge);
monthSelect.addEventListener('change', calculateAge);
yearSelect.addEventListener('change', calculateAge);

// Calculate age based on selected date of birth
function calculateAge() {
    var selectedDay = daySelect.value;
    var selectedMonth = monthSelect.value;
    const selectedYearOption = yearSelect.options[yearSelect.selectedIndex];
    const selectedYear = selectedYearOption.textContent;

    var spouseAgeDiv = document.getElementById('spouseAge');

    if (selectedYear) {
        if (selectedDay && selectedMonth) {
            var dob = new Date(selectedYear, selectedMonth - 1, selectedDay);
            var currentDate = new Date();

            var age = currentDate.getFullYear() - dob.getFullYear();
            if (currentDate.getMonth() < dob.getMonth() ||
                (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
                age--;
            }

            spouseAgeDiv.textContent = 'Age: ' + age;
        } else {
            spouseAgeDiv.textContent = 'Age: Please select a year';
        }
    } else {
        spouseAgeDiv.textContent = 'Age: Please select a year';
    }
}

// Calculate age on initial load
calculateAge();

</script>
@endsection