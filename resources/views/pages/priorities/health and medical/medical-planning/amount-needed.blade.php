<?php
 /**
 * Template Name: Health Medical - Medical Planning Amount Needed
 */
?>
@extends('templates.master')

@section('title')
<title>Health Medical - Medical Planning Amount Needed</title>

@section('content')

@php
    // Retrieving values from the session
    $healthMedical = session('customer_details.health-medical_needs');
    $medicalAmountNeeded = session('customer_details.health-medical_needs.medical_planning.neededAmount');
    $medicalYear = session('customer_details.health-medical_needs.medical_planning.year');
    $existingProtectionAmount = session('customer_details.health-medical_needs.medical_planning.existingProtectionAmount');
    $totalHealthMedicalNeeded = session('customer_details.health-medical_needs.medical_planning.totalHealthMedicalNeeded', '0');
    $healthMedicalFundPercentage = session('customer_details.health-medical_needs.medical_planning.fundPercentage', '0');
    
@endphp


<div id="medical-amount-needed" class="bg-hnm">
    <div class="container-fluid">
        <div class="row mh-100">
            <form novalidate action="{{route('validate.medical.planning.amount.needed')}}" method="POST">
                @csrf
                <div class="row wrapper-grey">
                    <div class="header">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                                    <div class="row navbar-scroll">@include('templates.nav.nav-red-menu')</div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 col-xl-6 bg-primary calculation-progress-bar-wrapper px-4 px-md-2">
                                            <div class="calculation-progress mt-3 d-flex align-items-center">
                                                <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$healthMedicalFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h3 id="TotalHealthMedicalFund" class="text-light text-center m-1 f-family">RM{{ 
                                                $existingProtectionAmount === null || $existingProtectionAmount === '' 
                                                    ? number_format(floatval($totalHealthMedicalNeeded)) 
                                                    : ($existingProtectionAmount > floatval($totalHealthMedicalNeeded) 
                                                    ? '0' 
                                                    : number_format(floatval($totalHealthMedicalNeeded) - floatval($existingProtectionAmount)))
                                                }}
                                            </h3>
                                            <p class="text-light text-center">Total Health & Medical Fund Needed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                    @include('templates.nav.nav-sidebar-needs')
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="content d-flex justify-content-center align-items-md-center">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-6">
                                    <!-- Just keep this empty -->
                                </div>
                                <div class="col-md-6 d-flex justify-content-md-start justify-content-sm-center z-1 mt-5">
                                    <div class="col-xxl-11 text-md-start text-sm-center text-center">
                                        <p class="f-40 f-family fw-bold lh-normal m-0">In the event of any Medical/Hospitalisation needs, I would require<br>
                                            <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="medical_amount_needed" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('medical_amount_needed') is-invalid @enderror" id="medical_amount_needed" value="{{ $medicalAmountNeeded !== null ? number_format(floatval($medicalAmountNeeded)) : $medicalAmountNeeded }}" required></span>
                                            /month to take care of myself and my family with
                                            <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="text" name="medical_year" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-35 text-primary @error('medical_year') is-invalid @enderror" id="medical_year" value="{{$medicalYear}}" required></span>
                                            years to build this fund.
                                        </p>
                                        <input type="hidden" name="total_healthMedicalNeeded" id="total_healthMedicalNeeded" value="{{$totalHealthMedicalNeeded}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                                    <img src="{{ asset('images/needs/health-medical/medical-planning/amount-needed/avatar.png') }}" width="auto" height="450px" alt="Education Amount Needed Avatar" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('medical_amount_needed') || $errors->has('medical_year'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('medical_amount_needed') }} {{ $errors->first('medical_year') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('health.medical.planning.room.selection')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var amountNeeded = document.getElementById("medical_amount_needed");
    var supportingYears = document.getElementById("medical_year");
</script>
@endsection