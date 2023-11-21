<?php
 /**
 * Template Name: Investment Supporting Years
 */
?>
@extends('templates.master')

@section('title')
<title>Investment - Supporting Years</title>

@section('content')

@php
    // Retrieving values from the session
    $investment = session('customer_details.investments_needs');
    $investmentSupportingYears = session('customer_details.investments_needs.investmentTimeFrame');
    $totalInvestmentNeeded = session('customer_details.investments_needs.totalInvestmentNeeded', '0');
    $newTotalInvestmentNeeded = session('customer_details.investments_needs.newTotalInvestmentNeeded');
    $investmentFundPercentage = session('customer_details.investments_needs.fundPercentage', '0');
@endphp


<div id="investment-duration">
    <div class="container-fluid">
        <div class="row vh-100 scroll-content">
            <div class="col-12">
                <div class="row h-100 wrapper-needs-full-master-default bg-needs-master-full">
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
                                        <h3 id="TotalInvestmentFund" class="m-1 text-light text-center {{$investmentSupportingYears !== null && $totalInvestmentNeeded !== '' && number_format(floatval($totalInvestmentNeeded) * floatval($investmentSupportingYears)) >= '10000000000' ? 'f-40' : 'f-50' }}">RM{{ $investmentSupportingYears !== null && $totalInvestmentNeeded !== '' ? number_format(floatval($totalInvestmentNeeded) * floatval($investmentSupportingYears)) : number_format(floatval($totalInvestmentNeeded))}}
                                        </h3>
                                        <p class="text-light text-center">Total Investment Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.investment.supporting')}}" method="POST" class="m-0 content-full-master-default @if ($errors->has('investment_supporting_years')) pb-7 @endif">
                        @csrf
                        <section class="row full-content">
                            <div class="col-12">
                                <div class="row justify-content-center align-items-center h-100 tabung-wrapper">
                                    <div class="col-12 tabung-title align-items-center d-grid">
                                        <div class="col-md-12 d-flex justify-content-center text-center m-auto">
                                            <h4 class="f-34 fw-700 py-2 m-0">I expect to keep investment for the next:</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 tabung-content d-flex align-items-center mh-100 h-100 z-1 justify-content-center">
                                        <div class="mh-100 h-100 position-relative d-flex align-items-end">
                                            <!-- <img src="{{ asset('images/needs/savings/goal-amount/tabung.png') }}" class="m-auto mh-100 p-lg-3 mx-100 mw-100 saving-tabung"> -->
                                            <img src="{{ asset('images/needs/background/Calendar.png') }}" class="m-auto mh-100 p-lg-3 mx-100 mw-100">
                                            <div class="position-absolute center text-center">
                                                <input type="text" name="investment_supporting_years" class="form-control d-inline-block money text-center f-64" id="investment_supporting_years" value="{{$investmentSupportingYears}}" required>
                                                <h4 class="mt-4">years</h4>
                                            </div>
                                        </div>
                                        <input type="hidden" name="newTotal_investmentNeeded" id="newTotal_investmentNeeded" value="{{$newTotalInvestmentNeeded}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-block d-md-none footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('investment.monthly.payment')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('investment_supporting_years'))
                            <section class="row alert-support z-1 d-none d-md-block">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('investment_supporting_years') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 d-block d-md-none fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('investment_supporting_years') }}</div>
                                </div>
                            </section>
                        @endif
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default d-none d-md-block">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('investment.monthly.payment')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var supportingYearsSessionValue = parseFloat({{$investmentSupportingYears}});
    var oldTotalFund = parseFloat({{ $totalInvestmentNeeded }});
</script>
@endsection