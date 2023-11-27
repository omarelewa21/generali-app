<?php
 /**
 * Template Name: Savings Annual Return
 */
?>
@extends('templates.master')

@section('title')
<title>Savings - Annual Return</title>

@section('content')

@php
    // Retrieving values from the session
    $savings = session('customer_details.savings_needs');
    $savingsGoalPA = session('customer_details.savings_needs.annualReturn', '5');
    $totalSavingsNeeded = session('customer_details.savings_needs.totalSavingsNeeded', '0');
    $savingsFundPercentage = session('customer_details.savings_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.savings_needs.totalAmountNeeded');
@endphp


<div id="savings-annual-return">
    <div class="container-fluid">
        <div class="row mh-100">
            <form novalidate action="{{route('validate.savings.annual.return')}}" method="POST">
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
                                                <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$savingsFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h3 id="TotalSavingsFund" class="text-light text-center m-1 f-family">RM{{ number_format(floatval($totalAmountNeeded)) }}</h3>
                                            <p class="text-light text-center">Total Savings Needed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                    @include('templates.nav.nav-sidebar-needs')
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="content d-flex justify-content-center align-items-md-start">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row justify-content-center align-items-start text-center">
                                        <div class="col-md-4">
                                            <h4 class="f-34 fw-700 f-family">Ultimately, I’m expecting annual returns of:</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-12 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -125px">
                                    <div class="position-relative">
                                        <img src="{{ asset('images/needs/savings/goal-amount/tabung.png') }}" width="auto" height="405px" alt="Increment" class="mobileImg">
                                        <p class="f-45 fw-700 position-absolute center w-100">
                                            <input type="text" name="savings_goal_pa" class="form-control d-inline-block money text-center f-64 w-45" id="savings_goal_pa" value="{{$savingsGoalPA}}" required>
                                            % p.a.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('savings_goal_pa'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('savings_goal_pa') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('savings.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
@endsection