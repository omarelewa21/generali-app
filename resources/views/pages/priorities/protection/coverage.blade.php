<?php
 /**
 * Template Name: Protection - Coverage Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Protection - Coverage</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $protectionPriority = session('customer_details.priorities.protectionDiscuss');
    $selfData = session('customer_details.basic_details');
    $selfDataDob = session('customer_details.identity_details.dob');
    $selfDataName = session('customer_details.basic_details.full_name');
    $selfGender = session('customer_details.identity_details.gender');
    $familyDependent = session('customer_details.family_details.dependant');
    $childData = session('customer_details.family_details.dependant.children_data');

    $spouseData = session('customer_details.family_details.dependant.spouse_data');
    $spouseDataName = session('customer_details.family_details.dependant.spouse_data.full_name');

    $relationship = session('customer_details.protection_needs.coverFor');
    $selectedInsuredName = session('customer_details.protection_needs.selectedInsuredName');
    $othersCoverForName = session('customer_details.protection_needs.othersCoverForName');
    $selectedCoverForDob = session('customer_details.protection_needs.selectedCoverForDob');
    $othersCoverForDob = session('customer_details.protection_needs.othersCoverForDob');
@endphp

<div id="protection_coverage" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row navbar-scroll">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.protection.coverage.selection')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h2 class="display-5 fw-bold lh-sm text-center">I plan to provide financial protection for my:</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content">
                    <div class="container h-100">
                        <div class="row justify-content-center h-100 coverage_slick">
                            @if ($selfData)
                                <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                    <button class="border-0 bg-transparent position-relative choice d-flex justify-content-center h-100 @if($relationship === 'Myself') default @endif" id="{{ $selfData['full_name'] }}" data-avatar="{{ $selfData['full_name'] }}" data-avatar-dob="{{$selfDataDob}}" data-relation="Myself" data-required="">
                                        <div class="d-flex justify-content-end" style="flex-direction: column;">
                                            <img src="{{ asset('images/avatar-general/coverage/avatar-coverage-' .($selfGender === 'Female' ? 'female' : 'male').'.png') }}" height="75%" width="auto" class="mx-auto pb-2 px-3">
                                            <p class="avatar-text py-2 text-center mb-0 fw-bold">Self</p>
                                        </div>
                                    </button>
                                </div>
                            @endif
                            @if ($spouseDataName)
                                <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                    <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($relationship === 'Spouse') default @endif" id="{{ $spouseData['full_name'] }}" data-avatar="{{ $spouseData['full_name'] }}" data-avatar-dob="{{ $spouseData['dob'] }}" data-relation="Spouse" data-required="">
                                        <div class="d-flex justify-content-end" style="flex-direction: column;">
                                            <img src="{{ asset('images/avatar-general/coverage/avatar-coverage-spouse-'.($selfGender === 'Female' ? 'male' : 'female').'.png') }}" height="75%" width="auto" class="mx-auto pb-2 px-3">
                                            <p class="avatar-text py-2 text-center mb-0 fw-bold">{{ $spouseData['full_name'] }}</p>
                                        </div>
                                    </button>
                                </div>
                            @endif
                            @if ($childData)
                                @foreach($childData as $child)
                                    @if (isset($child['full_name']))
                                        <div class="h-100 d-flex justify-content-center align-items-center col-3">
                                            <button class="border-0 bg-transparent choice h-100 position-relative d-flex justify-content-center @if($relationship === 'Child' && $selectedInsuredName === $child['full_name']) default @endif" id="{{ $child['full_name'] }}" data-avatar="{{ $child['full_name'] }}" data-avatar-dob="{{ $child['dob'] }}" data-relation="Child" data-required="">
                                                <div class="d-flex justify-content-end" style="flex-direction: column;">
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
                                    <a href="{{route('protection.home')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
<div class="modal fade" id="missingProtectionFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingProtectionFieldsLabel">Protection Priority to discuss is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to enable protection priority to discuss in Priorities To Discuss page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="missingSelfFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingSelfFieldssLabel">Your Name is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input your name in Basic Details page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="missingSpouseFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingSpouseFieldsLabel">Your Spouse Name is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input your name in Family Depandent Details page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="missingChildFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingChildFieldsLabel">Your Child Name is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input your child name in Family dependant page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<script>
    var protectionPriority = '{{$protectionPriority}}';
    var selfData = '{{$selfDataName}}';
    var familyDependent = {!! json_encode($familyDependent) !!};

    if (familyDependent){
        var spouseDatas = {!! json_encode($spouseData) !!};
        var childDatas = {!! json_encode($childData) !!};
        if('spouse_data' in familyDependent && spouseDatas){
            if('full_name' in spouseDatas){
                var spouseData = '{{$spouseDataName}}';
            } else{
                var spouseData = null;
            }
        }
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
</script>
@endsection