<?php
 /**
 * Template Name: Savings - Amount Needed
 */
?>

@extends('templates.master')

@section('title')
    <title>Savings - Amount Needed</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $savingsPriority = session('customer_details.priorities.savings_discuss');

    $goalsAmount = session('customer_details.selected_needs.need_4.advance_details.goal_amount');
    $savingsMonthlyPayment = session('customer_details.selected_needs.need_4.advance_details.covered_amount');
    $savingsGoalDuration = session('customer_details.selected_needs.need_4.advance_details.supporting_years');
    $totalSavingsNeeded = session('customer_details.selected_needs.need_4.advance_details.goals_amount', '0');
    $totalAmountNeeded = session('customer_details.selected_needs.need_4.advance_details.insurance_amount');
    $savingsFundPercentage = session('customer_details.selected_needs.need_4.advance_details.fund_percentage', '0');
@endphp

<div id="savings-amount-needed" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12">
                <div class="row calculatorMenuMob">@include('templates.nav.nav-red-menu-needs')</div>
                <div class="bg-primary row d-md-none calculatorMob">
                    <div class="col-6">   
                        <h1 id="TotalSavingsFundMob" class="display-3 text-uppercase text-white overflow-hidden ps-4 text-nowrap my-2">RM{{ 
                            $savingsMonthlyPayment === null  && $savingsGoalDuration === null
                                ? number_format(floatval($goalsAmount)) 
                                : number_format(floatval($totalAmountNeeded))
                            }}
                        </h1>
                    </div>
                    <div class="col-6 m-auto">
                        <p class="text-white display-6 lh-base text-end pe-4 m-0">Total Regular Savings Fund Needed</p>
                    </div>
                </div>
            </div>
            <form novalidate action="{{route('validate.savings.amount.needed')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu pt-md-0 py-3">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading d-none d-md-block">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$savingsFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalSavingsFund" class="text-center display-3 text-uppercase text-white overflow-hidden text-nowrap">RM{{ 
                                    $savingsMonthlyPayment === null  && $savingsGoalDuration === null
                                        ? number_format(floatval($goalsAmount)) 
                                        : number_format(floatval($totalAmountNeeded))
                                    }}
                                </h1>
                                <p class="text-white display-6 lh-base text-center">Total Regular Savings Fund Needed</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-md-1">
                    <div class="container h-100 px-4 px-md-0">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/savings/monthly-payment/avatar.png') }}" width="auto" height="100%" alt="Savings Amount Needed Avatar">
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 py-lg-5 pt-4 calculatorContent">
                                <div class="row h-sm-100">
                                    <h2 class="display-5 fw-bold lh-sm">I plan to save</h2>
                                    <p class="display-5 fw-bold currencyField">
                                        <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="savings_monthly_payment" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('savings_monthly_payment') is-invalid @enderror" id="savings_monthly_payment" value="{{ $savingsMonthlyPayment !== null ? number_format(floatval($savingsMonthlyPayment)) : $savingsMonthlyPayment }}" required></span>
                                    / month over the next
                                        <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="number" name="savings_goal_duration" class="form-control fw-bold position-relative border-0 d-inline-block w-25 text-center text-primary @error('savings_goal_duration') is-invalid @enderror" id="savings_goal_duration" value="{{$savingsGoalDuration}}" required></span>
                                    years to achieve my goals.</p>
                                    <input type="hidden" name="total_savingsNeeded" id="total_savingsNeeded" value="{{$totalSavingsNeeded}}">
                                    <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                    <input type="hidden" name="percentage" id="percentage" value="{{$savingsFundPercentage}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('savings_monthly_payment') || $errors->has('savings_goal_duration'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savings_monthly_payment') }} {{ $errors->first('savings_goal_duration') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('savings.goals')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="footer-avatar-grey d-none d-md-block"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="missingLastPageInputFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingLastPageInputFieldsLabel">You're required to enter previous value before you proceed to this page.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input the value in previous page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<script>
    var needs_priority = '{{$savingsPriority}}';
    var goalAmount = parseFloat({{ $goalsAmount }});
    var savingsPercentage = parseFloat({{ $savingsFundPercentage }});
    var lastPageInput = '{{$goalsAmount}}';
</script>
@endsection