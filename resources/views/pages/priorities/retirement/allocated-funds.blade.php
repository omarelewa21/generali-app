<?php
 /**
 * Template Name: Retirement - Allocated Funds Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Retirement - Allocated Funds</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $retirementSavings = session('customer_details.retirement_needs.retirementSavingsAmount');
    $otherIncomeResources = session('customer_details.retirement_needs.otherIncomeResources');
    $totalRetirementNeeded = session('customer_details.retirement_needs.totalRetirementNeeded', '0');
    $retirementFundPercentage = session('customer_details.retirement_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.retirement_needs.totalAmountNeeded');
@endphp

<div id="retirement_allocated_funds" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.retirement.allocated.funds')}}" method="POST" class="content-needs-grey">
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
                                    $retirementSavings === null || $retirementSavings === '' 
                                        ? number_format(floatval($totalRetirementNeeded)) 
                                        : ($retirementSavings > floatval($totalRetirementNeeded) 
                                        ? '0' 
                                        : number_format(floatval($totalRetirementNeeded) - floatval($retirementSavings)))
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
                                <img src="{{ asset('images/needs/retirement/allocated-funds.png') }}" width="auto" height="100%" alt="Increment">
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 py-5 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm">So far, I’ve put aside</h2>
                                <p class="display-5 fw-bold currencyField">
                                    <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="retirement_savings" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('retirement_savings') is-invalid @enderror" id="retirement_savings" value="{{ $retirementSavings !== null ? number_format(floatval($retirementSavings)) : $retirementSavings }}"></span>
                                    for my retirement. Other sources of income:
                                    <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="text" name="other_income_sources" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('other_income_sources') is-invalid @enderror" id="other_income_sources" value="{{ $otherIncomeResources }}" required></span>
                                </p>
                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                <input type="hidden" name="percentage" id="percentage" value="{{$retirementFundPercentage}}">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('other_income_sources') || $errors->has('retirement_savings'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('other_income_sources') }} {{ $errors->first('retirement_savings') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('retirement.period')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

<script>
    var oldTotalFund = parseFloat({{ $totalRetirementNeeded }});
    var retirementFundPercentage = parseFloat({{ $retirementFundPercentage }});
    var sessionRetirementSavings = parseFloat({{$retirementSavings}});
</script>

@endsection