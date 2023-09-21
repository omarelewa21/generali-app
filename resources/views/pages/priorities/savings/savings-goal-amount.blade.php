<?php
 /**
 * Template Name: Savings Goal Amount
 */
?>
@extends('templates.master')

@section('title')
<title>Savings - Goal Amount</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $savingsMonthlyPayment = isset($arrayData['savings']['savingsMonthlyPayment']) ? $arrayData['savings']['savingsMonthlyPayment'] : '';
    $totalSavingsNeeded = isset($arrayData['savings']['totalSavingsNeeded']) ? $arrayData['savings']['totalSavingsNeeded'] : '';
    $newTotalSavingsNeeded = isset($arrayData['savings']['newTotalSavingsNeeded']) ? $arrayData['savings']['newTotalSavingsNeeded'] : '';
    $savingsFundPercentage = isset($arrayData['savings']['savingsFundPercentage']) ? $arrayData['savings']['savingsFundPercentage'] : 0;
    $savingsGoalDuration = isset($arrayData['savings']['savingsGoalDuration']) ? $arrayData['savings']['savingsGoalDuration'] : '';
    $savingsGoalPA = isset($arrayData['savings']['savingsGoalPA']) ? $arrayData['savings']['savingsGoalPA'] : '';
    $totalAmountNeeded = isset($arrayData['savings']['totalAmountNeeded']) ? $arrayData['savings']['totalAmountNeeded'] : '';
    $totalAnnualReturn = isset($arrayData['savings']['totalAnnualReturn']) ? $arrayData['savings']['totalAnnualReturn'] : '';
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
                                            {{ $newTotalSavingsNeeded === null || $newTotalSavingsNeeded === '' ? number_format(floatval($newTotalSavingsNeeded)) : number_format(floatval($newTotalSavingsNeeded))}}
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
                    <form novalidate action="{{route('validate.goal.amount')}}" method="POST" class="m-0 bg-education-gap content-supporting-default @if ($errors->has('savings_goal_pa')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con">
                            <div class="col-12">
                                <div class="row justify-content-center align-items-center tabung-wrapper h-100">
                                    <div class="col-12 tabung-title align-items-center d-grid">
                                        <div class="col-md-4 d-flex justify-content-center text-center m-auto">
                                            <h4 class="f-34 fw-700 py-2 m-0">Ultimately, I’m expecting annual returns of:</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 tabung-content d-flex align-items-center mh-100 h-100 z-1 justify-content-center">
                                        <div class="mh-100 h-100 position-relative">
                                            <img src="{{ asset('images/needs/savings/goal-amount/tabung.png') }}" class="m-auto mh-100 p-lg-3 mx-100">
                                            <div class="position-absolute center col-12 text-center">
                                                <p class="f-45">
                                                    <input type="text" name="savings_goal_pa" class="form-control d-inline-block money text-center f-64 w-35" id="savings_goal_pa" value="{{$savingsGoalPA}}" required>
                                                    % p.a.
                                                </p>
                                            </div>
                                        </div>
                                        <input type="hidden" name="total_annualReturn" id="total_annualReturn" value="{{$totalAnnualReturn}}">
                                        <input type="hidden" name="newTotal_savingsNeeded" id="newTotal_savingsNeeded" value="{{$newTotalSavingsNeeded}}">
                                        <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                        <input type="hidden" name="percentage" id="percentage" value="{{$savingsFundPercentage}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('savings.goal.duration')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('savings_goal_pa') ? 'error-padding' : '' }}"></div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('savings_goal_pa'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savings_goal_pa') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savings_goal_pa') }}</div>
                                </div>
                            </section>
                        @endif
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('savings.goal.duration')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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
    var savingsGoalPA = document.getElementById('savings_goal_pa');
    var totalAmountNeeded = document.getElementById("total_amountNeeded");
    var totalsavingsPercentage = document.getElementById("percentage");
    var oldTotalFund = parseFloat({{ $newTotalSavingsNeeded }});
    var savingsPercentage = parseFloat({{ $savingsFundPercentage }});
    var sessionTotalAmount = parseFloat({{ $totalAmountNeeded }});
    var sessionGoalPA = parseFloat({{$savingsGoalPA}});
    var totalAnnualReturn = document.getElementById("total_annualReturn");

    if (sessionGoalPA !== '' || sessionGoalPA !== 0) {
        var newTotalPA = sessionGoalPA / 100 * oldTotalFund;
        var newTotal = oldTotalFund - newTotalPA;
        var newTotalPercentage = newTotalPA / oldTotalFund * 100;
        totalAnnualReturn.value = newTotalPA;
        if (newTotal <= 0){
            totalAmountNeeded.value = 0;
            totalsavingsPercentage.value = 100;
            $('.retirement-progress-bar').css('width','100%');
        }
        else{
            totalAmountNeeded.value = newTotal;
            totalsavingsPercentage.value = newTotalPercentage;
            $('.retirement-progress-bar').css('width', newTotalPercentage + '%');
        }
    }

    savingsGoalPA.addEventListener("input", function() {

        // Retrieve the current input value
        var savingsGoalPAValue = savingsGoalPA.value;

        var annualReturn = parseInt(savingsGoalPAValue);

        // Calculate annual return
        var totalPA = annualReturn / 100 * oldTotalFund;
        var totalPercentage = totalPA / oldTotalFund * 100;
        var total = oldTotalFund - totalPA;

        $('.retirement-progress-bar').css('width', totalPercentage + '%');
        if (total <= 0){
            totalAnnualReturn.value = totalPA;
            totalAmountNeeded.value = 0;
            totalsavingsPercentage.value = 100;
            $('.retirement-progress-bar').css('width','100%');
        }
        else{
            totalAnnualReturn.value = totalPA;
            totalAmountNeeded.value = total;
            totalsavingsPercentage.value = totalPercentage;
            $('.retirement-progress-bar').css('width', totalPercentage + '%');
        }
        
    });
   
    document.addEventListener("DOMContentLoaded", function() {
        savingsGoalPA.addEventListener("blur", function() {
            validateNumberField(savingsGoalPA);
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