<?php
 /**
 * Template Name: Education - Coverage Page
 */
?>

@extends('templates.master')

@section('title')
<title>Education - Coverage</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $educationPriority = session('customer_details.priorities.education_discuss');
    $familyDependent = session('customer_details.family_details');
    $childData = session('customer_details.family_details.children_data');

    $relationship = session('customer_details.selected_needs.need_3.advance_details.relationship');
    $selectedInsuredName = session('customer_details.selected_needs.need_3.advance_details.child_name');
    $othersCoverForName = session('customer_details.selected_needs.need_3.advance_details.spouse_name');
    $selectedCoverForDob = session('customer_details.selected_needs.need_3.advance_details.child_dob');
    $othersCoverForDob = session('customer_details.selected_needs.need_3.advance_details.spouse_dob');
@endphp

<div id="education_coverage" class="secondary-default-bg coverage">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.education.coverage.selection')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-4 col-xl-6">
                                <h2 class="display-5 fw-bold text-center m-0">I want to prepare a tertiary education fund for:</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content">
                    <div class="container h-100">
                        <div class="row justify-content-center h-100 coverage_slick">
                            @if ($childData)
                                @foreach($childData as $child)
                                    @if (isset($child['full_name']))
                                        <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                            <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($relationship === 'Child' && $selectedInsuredName === $child['full_name']) default @endif" id="{{ $child['full_name'] }}" data-avatar="{{ $child['full_name'] }}" data-avatar-dob="{{ $child['dob'] }}" data-relation="Child" data-required="">
                                                @php
                                                    $birthdate = $child['dob'];

                                                    // Convert DOB to DateTime object
                                                    $dobDate = \DateTime::createFromFormat('Y-m-d', $birthdate);

                                                    //Get current Date
                                                    $currentDate = new \DateTime();

                                                    // Calculate the difference between the two dates
                                                    $ageInterval = $currentDate->diff($dobDate);
                                                    $age = $ageInterval->y; // Access the years property of the interval
                                                @endphp
                                                <div class="d-flex justify-content-center" style="flex-direction: column;">
                                                    <p class="py-2 m-auto mt-3 f-family mb-0 coverage-age text-white d-flex justify-content-center align-items-center">Age: {{$age}}</p>
                                                    <img src="{{ asset('images/avatar-general/coverage/avatar-coverage-child-'.str_replace(' ', '_', $child['gender']).'.png') }}" height="75%" width="auto" class="mx-auto pb-2 px-3">
                                                    <p class="avatar-text text-center py-2 mb-0 fw-bold">{{ $child['full_name'] }}</p>
                                                </div>
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('relationshipInput'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('relationshipInput') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="relationshipInput" id="relationshipInput" value="{{$relationship}}">
                                    <input type="hidden" name="selectedInsuredNameInput" id="selectedInsuredNameInput" value="{{$selectedInsuredName}}">
                                    <input type="hidden" name="othersCoverForNameInput" id="othersCoverForNameInput" value="{{$othersCoverForName}}">
                                    <input type="hidden" name="selectedCoverForDobInput" id="selectedCoverForDobInput" value="{{$selectedCoverForDob}}">
                                    <input type="hidden" name="othersCoverForDobInput" id="othersCoverForDobInput" value="{{$othersCoverForDob}}">
                                    <a href="{{route('education.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="footer-avatar-grey"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="missingChildFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingChildFieldsLabel">Your Child Name is required.</h3>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input your child name in Family dependent page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
    var needs_priority = '{{$educationPriority}}';
    var childDatas = {!! json_encode($childData) !!};
    var familyDependent = {!! json_encode($familyDependent) !!};
    if(childDatas){
        if (familyDependent){
            if('children_data' in familyDependent){
                for (let key in childDatas) {
                    if (childDatas.hasOwnProperty(key)) {
                        let child = childDatas[key];
                        if (child.hasOwnProperty('full_name')) {
                            var childData = 'not empty';
                        }
                        else{
                            var childData = null;
                        }
                    }
                }
            }
        }
    } else{
        var childData = null;
    }
    
</script>
@endsection