<?php
 /**
 * Template Name: Investment Annual Return
 */
?>
@extends('templates.master')

@section('title')
<title>Investment - Annual Return</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $investmentMonthlyPayment = isset($arrayData['investment']['investmentMonthlyPayment']) ? $arrayData['investment']['investmentMonthlyPayment'] : '';
    $totalInvestmentNeeded = isset($arrayData['investment']['totalInvestmentNeeded']) ? $arrayData['investment']['totalInvestmentNeeded'] : '';
    $newTotalInvestmentNeeded = isset($arrayData['investment']['newTotalInvestmentNeeded']) ? $arrayData['investment']['newTotalInvestmentNeeded'] : '';
    $investmentFundPercentage = isset($arrayData['investment']['investmentFundPercentage']) ? $arrayData['investment']['investmentFundPercentage'] : 0;
    $investmentSupportingYears = isset($arrayData['investment']['investmentSupportingYears']) ? $arrayData['investment']['investmentSupportingYears'] : '';
    $investmentPA = isset($arrayData['investment']['investmentPA']) ? $arrayData['investment']['investmentPA'] : '';
    $totalAnnualReturn = isset($arrayData['investment']['totalAnnualReturn']) ? $arrayData['investment']['totalAnnualReturn'] : '';
@endphp


<div id="investment-annual-return" class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-needs-desktop bg-half wrapper-needs-supporting-default">
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
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$investmentFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalInvestmentFund" class="m-1 text-light text-center">RM {{ $newTotalInvestmentNeeded === null || $newTotalInvestmentNeeded === '' ? number_format(floatval($newTotalInvestmentNeeded)) : number_format(floatval($newTotalInvestmentNeeded))}}</h3>
                                        <p class="text-light text-center">Total Investment Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.investment.annual.return')}}" method="POST" class="m-0 content-supporting-default @if ($errors->has('investment_pa')) pb-7 @endif h-100">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="investment-monthly-content">
                                    <div class="col-12 col-xl-6 align-items-end justify-content-center z-1 mh-100 second-order investment-annual">
                                        <img src="{{ asset('images/needs/investment/money-tree.png') }}" class="mh-100 z-1 investment-tree">
                                        <img src="{{ asset('images/needs/investment/invesment-ar-avatar.png') }}" class="mh-90 z-1 avatar-investment-pa">
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('investment_pa') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 justify-content-center d-flex align-items-center first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center">
                                            <div class="col-10 col-md-8 col-xl-6 d-flex justify-content-center align-items-center">
                                                <p class="f-34"><strong>Of course, ideally I'd like to see</strong><br>
                                                    <span class="currencyinput f-34"><input type="text" name="investment_pa" class="form-control d-inline-block w-50 money f-34 @error('investment_pa') is-invalid @enderror" id="investment_pa" value="{{$investmentPA}}" required></span>
                                                    <strong>% p.a. in annual returns.</strong>
                                                </p>
                                                <input type="hidden" name="total_annualReturn" id="total_annualReturn" value="{{$totalAnnualReturn}}">
                                                <input type="hidden" name="newTotal_investmentNeeded" id="newTotal_investmentNeeded" value="{{$newTotalInvestmentNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$investmentFundPercentage}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('investment.supporting')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('investment_pa'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('investment_pa') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('investment_pa') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('investment_pa') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('investment.supporting')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var oldTotalFund = parseFloat({{ $newTotalInvestmentNeeded }});
    var investmentFundPercentage = parseFloat({{ $investmentFundPercentage }});
    var sessionInvestmentPA = parseFloat({{$investmentPA}});
</script>
@endsection