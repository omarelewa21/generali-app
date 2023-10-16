<?php
 /**
 * Template Name: Retirement - Others
 */
?>
@extends('templates.master')

@section('title')
<title>Retirement - Others</title>

@section('content')

@php
    // Retrieving values from the session
    $retirement = session('customer_details.retirement_needs');
    $retirementSavings = session('customer_details.retirement_needs.retirementSavingsAmount');
    $otherIncomeResources = session('customer_details.retirement_needs.otherIncomeResources');
    $newTotalRetirementNeeded = session('customer_details.retirement_needs.newTotalRetirementNeeded');
    $retirementFundPercentage = session('customer_details.retirement_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.retirement_needs.totalAmountNeeded');
@endphp


<div id="retirement-others" class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-retire-age wrapper-needs-supporting-default">
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
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$retirementFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalRetirementFund" class="m-1 text-light text-center f-50">RM{{ $newTotalRetirementNeeded === null || $newTotalRetirementNeeded === '' ? number_format(floatval($newTotalRetirementNeeded)) : number_format(floatval($newTotalRetirementNeeded))}}</h3>
                                        <p class="text-light text-center">Total Retirement Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.others')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('retirement_savings') || $errors->has('other_income_sources')) pb-7 @endif h-100">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="needs-content">
                                    <div class="col-12 col-xl-6 align-items-end justify-content-center z-1 mh-100 second-order protection-monthly mt-auto">
                                        <img src="{{ asset('images/needs/retirement/other/avatar.png') }}" class="mt-auto mh-100 w-auto mw-100 mx-auto z-1">
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('retirement_savings') || $errors->has('other_income_sources') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 m-auto first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center">
                                            <div class="col-9">
                                                <p class="f-34"><strong>So far, I’ve put aside<br></strong>
                                                    <span class="currencyinput f-34">RM<input type="text" name="retirement_savings" class="form-control d-inline-block money text-start f-34 w-35" id="retirement_savings" value="{{ $retirementSavings !== null ? number_format(floatval($retirementSavings)) : $retirementSavings }}"></span><br>
                                                    <strong>for my retirement.<br>Other sources of income:<br></strong>
                                                    <span class="currencyinput f-34"><input type="text" name="other_income_sources" class="form-control d-inline-block money text-start f-34 w-45" id="other_income_sources" value="{{$otherIncomeResources}}" required></span>
                                                </p>
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$retirementFundPercentage}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('retirement.retire.age')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('retirement_savings') || $errors->has('other_income_sources'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirement_savings') }}{{ $errors->first('other_income_sources') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirement_savings') }}{{ $errors->first('other_income_sources') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('retirement_savings') || $errors->has('other_income_sources') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('retirement.retire.age')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var oldTotalFund = parseFloat({{ $newTotalRetirementNeeded }});
    var retirementFundPercentage = parseFloat({{ $retirementFundPercentage }});
    var sessionRetirementSavings = parseFloat({{$retirementSavings}});
</script>

@endsection