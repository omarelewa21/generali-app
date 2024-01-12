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
    $debtPriority = session('customer_details.priorities.debt-cancellationDiscuss');
    $debtCancellation = session('customer_details.debt-cancellation_needs'); 
    $debtOutstandingLoan = session('customer_details.debt-cancellation_needs.outstandingLoan');
    $settlementYears = session('customer_details.debt-cancellation_needs.remainingYearsOfSettlement');
    $existingDebtAmount = session('customer_details.debt-cancellation_needs.existingDebtAmount');
    $totalDebtNeeded = session('customer_details.debt-cancellation_needs.totalDebtCancellationFund');
    $debtFundPercentage = session('customer_details.debt-cancellation_needs.fundPercentage', '0');
    $relationship = session('customer_details.debt-cancellation_needs.coverFor');
@endphp

<div id="debt-cancellation-amount-needed" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.debt.cancellation.amount.needed')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$debtFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalDebtCancellationFund" class="text-center display-3 text-uppercase text-white overflow-hidden text-nowrap">RM{{ 
                                    $existingDebtAmount === null || $existingDebtAmount === '' 
                                        ? number_format(floatval($totalDebtNeeded)) 
                                        : ($existingDebtAmount > floatval($totalDebtNeeded) 
                                        ? '0' 
                                        : number_format(floatval($totalDebtNeeded) - floatval($existingDebtAmount)))
                                    }}
                                </h1>
                                <p class="text-white display-6 lh-base text-center">Total Debt Cancellation</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/debt-cancellation/outstanding-loan/avatar.png') }}" width="auto" height="100%" alt="Increment">
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 py-5 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm">I'd like to clear my outstanding loans of</h2>
                                <p class="display-5 fw-bold currencyField">
                                    <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="debt_outstanding_loan" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('debt_outstanding_loan') is-invalid @enderror" id="debt_outstanding_loan" value="{{ $debtOutstandingLoan !== null ? number_format(floatval($debtOutstandingLoan)) : $debtOutstandingLoan }}" required></span>
                                to be debt-free in
                                    <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="number" name="debt_settlement_years" class="form-control fw-bold position-relative border-0 d-inline-block w-25 text-center text-primary @error('debt_settlement_years') is-invalid @enderror" id="debt_settlement_years" value="{{$settlementYears}}" required></span>
                                years' time.</p>
                                <input type="hidden" name="total_debtFund" id="total_debtFund" value="{{$totalDebtNeeded}}">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('debt_outstanding_loan') || $errors->has('debt_settlement_years'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('debt_outstanding_loan') }} {{ $errors->first('debt_settlement_years') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
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
            </form>
            <div class="footer-avatar-grey d-none d-md-block"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="missingDebtFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingDebtFieldsLabel">Debt Cancellation Priority to discuss is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to enable debt cancellation priority to discuss in Priorities To Discuss page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
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
    var debtPriority = '{{$debtPriority}}';
    var lastPageInput = '{{$relationship}}';
</script>
@endsection