<?php
 /**
 * Template Name: Savings Goal Duration
 */
?>
@extends('templates.master')

@section('title')
<title>Savings - Goal Duration</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $savingsMonthlyPayment = isset($arrayData['savings']['savingsMonthlyPayment']) ? $arrayData['savings']['savingsMonthlyPayment'] : '';
    $totalSavingsNeeded = isset($arrayData['savings']['totalSavingsNeeded']) ? $arrayData['savings']['totalSavingsNeeded'] : '';
    $newTotalSavingsNeeded = isset($arrayData['savings']['newTotalSavingsNeeded']) ? $arrayData['savings']['newTotalSavingsNeeded'] : '';
    $savingsFundPercentage = isset($arrayData['savings']['savingsFundPercentage']) ? $arrayData['savings']['savingsFundPercentage'] : 0;
    $savingsGoalDuration = isset($arrayData['savings']['savingsGoalDuration']) ? $arrayData['savings']['savingsGoalDuration'] : '';
@endphp


<div id="savings-duration" class="vh-100 scroll-content bg-master-mob">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 wrapper-needs-supporting-default">
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
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$savingsFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalSavingsFund" class="m-1 text-light text-center">RM 
                                            {{$savingsGoalDuration !== '' && $totalSavingsNeeded !== '' ? 
                                            number_format(floatval($totalSavingsNeeded) * floatval($savingsGoalDuration)) : 
                                            number_format(floatval($totalSavingsNeeded)) }}
                                        </h3>
                                        <p class="text-light text-center">Total Savings Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.goal.duration')}}" method="POST" class="m-0 bg-education-gap content-supporting-default @if ($errors->has('savings_goal_duration')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con">
                            <div class="col-12">
                                <div class="row justify-content-center align-items-center h-100 calendar-wrapper">
                                    <div class="col-12 col-lg-2 col-xl-3 d-flex align-items-center justify-content-end calendar-text">
                                        <h4 class="">I plan to save for</h4>
                                    </div>
                                    <div class="col-12 col-xl-5 col-lg-6 d-flex align-items-center mh-100 h-100 calendar-content position-relative" id="calendar">
                                        <img src="{{ asset('images/needs/background/Calendar.png') }}" class="m-auto mh-100 p-lg-3 mx-100">
                                        <div class="position-absolute center text-center">
                                            <input type="text" name="savings_goal_duration" class="form-control d-inline-block money text-center f-64 w-75" id="savings_goal_duration" value="{{$savingsGoalDuration}}" required>
                                            <h4 class="mt-4">years</h4>
                                        </div>
                                        <input type="hidden" name="total_savingsNeeded" id="total_savingsNeeded" value="{{$totalSavingsNeeded}}">
                                        <input type="hidden" name="newTotal_savingsNeeded" id="newTotal_savingsNeeded" value="{{$newTotalSavingsNeeded}}">
                                    </div>
                                    <div class="col-12 col-xl-3 col-lg-2 d-flex align-items-center calendar-text2">
                                        <h4 class="">to achieve my goals.</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('savings.monthly.payment')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('savings_goal_duration'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savings_goal_duration') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savings_goal_duration') }}</div>
                                </div>
                            </section>
                        @endif
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('savings.monthly.payment')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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
    // Get the input value
    var goalDuration = document.getElementById("savings_goal_duration");
    var goalDurationSessionValue = parseFloat({{$savingsGoalDuration}});
    var oldTotalFund = parseFloat({{ $totalSavingsNeeded }});
    var newTotalFund = document.getElementById("newTotal_savingsNeeded");
    
    var totalSavingsFund = document.getElementById("TotalSavingsFund");

    if (goalDurationSessionValue !== '' || goalDurationSessionValue !== 0 && oldTotalFund !== '') {
            newTotalFund.value = goalDurationSessionValue * oldTotalFund;
    } 
    

    goalDuration.addEventListener("input", function() {

        // Retrieve the current input value
        var goalDurationValue = goalDuration.value;

        var Year = parseInt(goalDurationValue);

        // Calculate months
        var totalAmount = Year * oldTotalFund;

        if (isNaN(Year)) {
            // Input is not a valid number
            totalSavingsFund.innerText = "RM 0";
        } else {
            // Input is a valid number, perform the calculation
            // Display the result
            var result = totalAmount.toLocaleString();

            totalSavingsFund.innerText = "RM " + result;
        }
        
        newTotalFund.value = Year * oldTotalFund;
        
    });
   
    document.addEventListener("DOMContentLoaded", function() {
        goalDuration.addEventListener("blur", function() {
            validateNumberField(goalDuration);
        });
    });

    function validateNumberField(field) {
        const value = field.value.trim();

        if (value === "" || isNaN(value)) {
            field.classList.add("is-invalid");
        } else {
            field.classList.remove("is-invalid");
        }
    }
    
</script>
@endsection