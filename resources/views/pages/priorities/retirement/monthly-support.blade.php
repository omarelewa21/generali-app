<?php
 /**
 * Template Name: Retirement - Monthly Support Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Retirement - Monthly Support</title>
@endsection

@section('content')

@php
    $retirementMonthlySupport = session('customer_details.retirement_needs.monthlySupportAmount');
    $retirementSavings = session('customer_details.retirement_needs.retirementSavingsAmount');
    $supportingYears = session('customer_details.retirement_needs.supportingYears');
    $totalRetirementNeeded = session('customer_details.retirement_needs.totalRetirementNeeded', '0');
    $retirementFundPercentage = session('customer_details.retirement_needs.fundPercentage', '0');
@endphp

<div id="retirement_monthly_support" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.retirement.monthly.support')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$retirementFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalRetirementFund" class="text-center display-3 text-uppercase text-white">RM{{ 
                                    $retirementSavings === null || $retirementSavings === '' && $supportingYears === null || $supportingYears === ''
                                    ? number_format(floatval($totalRetirementNeeded))
                                    : ($retirementSavings === null || $retirementSavings === ''
                                        ? number_format(floatval($retirementMonthlySupport) * 12 * floatval($supportingYears))
                                        : ($retirementSavings > (floatval($retirementMonthlySupport) * 12 * floatval($supportingYears))
                                            ? '0'
                                            : number_format(floatval($retirementMonthlySupport) * 12 * floatval($supportingYears) - floatval($retirementSavings))))
                                    }}
                                </h1>
                                <p class="text-white display-6 lh-base text-center">Total Retirement Fund Needed</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/retirement/monthly-support.png') }}" width="auto" height="100%" alt="Increment">
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 py-5 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm">It would be great to have</h2>
                                <p class="display-5 fw-bold currencyField">
                                    <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="retirement_monthly_support" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('retirement_monthly_support') is-invalid @enderror" id="retirement_monthly_support" value="{{ $retirementMonthlySupport !== null ? number_format(floatval($retirementMonthlySupport)) : $retirementMonthlySupport }}" required></span>
                                    / month to support myself and my loved ones when I retire.
                                </p>
                                <input type="hidden" name="total_retirementNeeded" id="total_retirementNeeded" value="{{$totalRetirementNeeded}}">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('retirement_monthly_support'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirement_monthly_support') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
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
            </form>
            <div class="footer-avatar-grey d-none d-md-block"></div>
        </div>
    </div>
</div>

@endsection