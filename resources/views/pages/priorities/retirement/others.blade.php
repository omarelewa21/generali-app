<?php
 /**
 * Template Name: Retirement - Others
 */
?>

@extends('templates.master')

@section('title')
    <title>Retirement - Amount Needed</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $retirement = session('customer_details.retirement_needs');
    $retirementSavings = session('customer_details.retirement_needs.retirementSavingsAmount');
    $otherIncomeResources = session('customer_details.retirement_needs.otherIncomeResources');
    $totalRetirementNeeded = session('customer_details.retirement_needs.totalRetirementNeeded', '0');
    $retirementFundPercentage = session('customer_details.retirement_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.retirement_needs.totalAmountNeeded');
@endphp

<div id="retirement-others" class="bg-half-content">
    <div class="container-fluid">
        <div class="row">
            <form novalidate action="{{route('validate.retirement.others')}}" method="POST">
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
                                                $retirementSavings === null || $retirementSavings === '' 
                                                    ? number_format(floatval($totalRetirementNeeded)) 
                                                    : ($retirementSavings > floatval($totalRetirementNeeded) 
                                                    ? '0' 
                                                    : number_format(floatval($totalRetirementNeeded) - floatval($retirementSavings)))
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
                                        <p class="f-40 f-family fw-bold lh-normal m-0">So far, I've put aside<br>
                                            <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="retirement_savings" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('retirement_savings') is-invalid @enderror" id="retirement_savings" value="{{ $retirementSavings !== null ? number_format(floatval($retirementSavings)) : $retirementSavings }}"></span>
                                            for my retirement.<br>Other sources of income:
                                            <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="text" name="other_income_sources" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('other_income_sources') is-invalid @enderror" id="other_income_sources" value="{{ $otherIncomeResources }}" required></span>
                                        </p>
                                        <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                        <input type="hidden" name="percentage" id="percentage" value="{{$retirementFundPercentage}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                                    <img src="{{ asset('images/needs/retirement/other/avatar.png') }}" width="auto" height="500px" alt="Increment" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('other_income_sources') || $errors->has('retirement_savings'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('other_income_sources') }} {{ $errors->first('retirement_savings') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
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
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var oldTotalFund = parseFloat({{ $totalRetirementNeeded }});
    var retirementFundPercentage = parseFloat({{ $retirementFundPercentage }});
    var sessionRetirementSavings = parseFloat({{$retirementSavings}});
</script>

@endsection