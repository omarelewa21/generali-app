<?php
 /**
 * Template Name: Retirement - Amount Needed
 */
?>

@extends('templates.master')

@section('title')
    <title>Retirement - Amount Needed</title>
@endsection

@section('content')

@php
    $retirement = session('customer_details.retirement_needs');
    $retirementMonthlySupport = session('customer_details.retirement_needs.monthlySupportAmount');
    $retirementSavings = session('customer_details.retirement_needs.retirementSavingsAmount');
    $supportingYears = session('customer_details.retirement_needs.supportingYears');
    $totalRetirementNeeded = session('customer_details.retirement_needs.totalRetirementNeeded', '0');
    $retirementFundPercentage = session('customer_details.retirement_needs.fundPercentage', '0');
@endphp

<div id="retirement-monthly-support" class="bg-half-content">
    <div class="container-fluid">
        <div class="row">
            <form novalidate action="{{route('validate.retirement.monthly.support')}}" method="POST">
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
                                                <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$retirementFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h3 id="TotalRetirementFund" class="text-light text-center m-1 f-family">RM{{ 
                                                $retirementSavings === null || $retirementSavings === '' && $supportingYears === null || $supportingYears === ''
                                                ? number_format(floatval($totalRetirementNeeded))
                                                : ($retirementSavings === null || $retirementSavings === ''
                                                    ? number_format(floatval($retirementMonthlySupport) * 12 * floatval($supportingYears))
                                                    : ($retirementSavings > (floatval($retirementMonthlySupport) * 12 * floatval($supportingYears))
                                                        ? '0'
                                                        : number_format(floatval($retirementMonthlySupport) * 12 * floatval($supportingYears) - floatval($retirementSavings))))
                                                }}
                                            </h3>
                                            <p class="text-light text-center">Total Retirement Fund Needed</p>
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
                                <div class="col-md-6 d-flex justify-content-md-start justify-content-sm-center">
                                    <div class="col-xxl-9 text-md-start text-sm-center text-center">
                                        <p class="f-40 f-family fw-bold lh-normal m-0">It would be great to have<br>
                                            <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="retirement_monthly_support" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('retirement_monthly_support') is-invalid @enderror" id="retirement_monthly_support" value="{{ $retirementMonthlySupport !== null ? number_format(floatval($retirementMonthlySupport)) : $retirementMonthlySupport }}" required></span>
                                            / month to support myself and my loved ones when I retire.
                                        </p>
                                        <input type="hidden" name="total_retirementNeeded" id="total_retirementNeeded" value="{{$totalRetirementNeeded}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                                    <img src="{{ asset('images/needs/retirement/retirement-monthly-avatar.png') }}" width="auto" height="500px" alt="Increment" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('retirement_monthly_support'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirement_monthly_support') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('retirement.ideal')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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