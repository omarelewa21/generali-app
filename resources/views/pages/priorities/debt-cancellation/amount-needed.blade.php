<?php
 /**
 * Template Name: Debt Cancellation - Amount Needed
 */
?>

@extends('templates.master')

@section('title')
    <title>Debt Cancellation - Amount Needed</title>
@endsection

@section('content')

@php
    $debtCancellation = session('customer_details.debt-cancellation_needs'); 
    $debtOutstandingLoan = session('customer_details.debt-cancellation_needs.outstandingLoan');
    $settlementYears = session('customer_details.debt-cancellation_needs.remainingYearsOfSettlement');
    $existingDebtAmount = session('customer_details.debt-cancellation_needs.existingDebtAmount');
    $totalDebtNeeded = session('customer_details.debt-cancellation_needs.totalDebtCancellationFund');
    $debtFundPercentage = session('customer_details.debt-cancellation_needs.fundPercentage', '0');
@endphp

<div id="debt-cancellation-amount-needed" class="bg-half-master">
    <div class="container-fluid">
        <div class="row">
            <form novalidate action="{{route('validate.debt.cancellation.amount.needed')}}" method="POST">
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
                                                <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$debtFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h3 id="TotalDebtCancellationFund" class="text-light text-center m-1 f-family">RM{{ 
                                                $existingDebtAmount === null || $existingDebtAmount === '' 
                                                    ? number_format(floatval($totalDebtNeeded)) 
                                                    : ($existingDebtAmount > floatval($totalDebtNeeded) 
                                                    ? '0' 
                                                    : number_format(floatval($totalDebtNeeded) - floatval($existingDebtAmount)))
                                                }}
                                            </h3>
                                            <p class="text-light text-center">Total Debt Cancellation</p>
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
                                        <p class="f-40 f-family fw-bold lh-normal m-0">I’d like to clear my outstanding loans of<br>
                                            <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="debt_outstanding_loan" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('debt_outstanding_loan') is-invalid @enderror" id="debt_outstanding_loan" value="{{ $debtOutstandingLoan !== null ? number_format(floatval($debtOutstandingLoan)) : $debtOutstandingLoan }}" required></span>
                                            . & be debt free in
                                            <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="text" name="debt_settlement_years" class="form-control f-40 f-family fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('debt_settlement_years') is-invalid @enderror" id="debt_settlement_years" value="{{$settlementYears}}" required></span>
                                            years.
                                        </p>
                                        <input type="hidden" name="total_debtFund" id="total_debtFund" value="{{$totalDebtNeeded}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                                    <img src="{{ asset('images/needs/debt-cancellation/outstanding-loan/avatar.png') }}" width="auto" height="450px" alt="Debt Cancellation Amount Needed Avatar" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('debt_outstanding_loan') || $errors->has('debt_settlement_years'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('debt_outstanding_loan') }} {{ $errors->first('debt_settlement_years') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('debt.cancellation.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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