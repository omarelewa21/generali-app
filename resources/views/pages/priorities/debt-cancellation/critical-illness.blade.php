@extends('templates.master')

@section('title')
<title>Debt Cancellation - Critical Illness Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $debtCancellation = session('customer_details.debt-cancellation_needs');
    $criticalIllnessCoverage = session('customer_details.debt-cancellation_needs.criticalIllnessCoverage');
    $coverageAmount = session('customer_details.debt-cancellation_needs.criticalIllnessCoverageAmount');
    $totalDebtNeeded = session('customer_details.debt-cancellation_needs.totalDebtCancellationFund');
    $debtFundPercentage = session('customer_details.debt-cancellation_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.debt-cancellation_needs.totalAmountNeeded');
@endphp

<div id="debt-critical-illness" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.debt.critical.illness')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$debtFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalDebtCancellationFund" class="text-center display-3 text-uppercase text-white">RM{{number_format(floatval($totalAmountNeeded))}}</h1>
                                <p class="text-white display-6 lh-base text-center">Total Debt Cancellation</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/debt-cancellation/critical-illness-coverage/avatar.png') }}" width="auto" height="100%" alt="Existing Policy">
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-6 py-5 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm">Should I include Critical Illness Protection?</h2>
                                <p class="d-flex pt-5">
                                    <span class="me-5 d-flex">
                                        <input type="radio" class="needs-radio @error('critical_coverage_amount') checked-yes @enderror {{$criticalIllnessCoverage === 'yes' ? 'checked-yes' : ''}}" id="yes" name="critical_coverage" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','1');jQuery('#critical_coverage_amount').attr('required',true);"
                                        {{ ($criticalIllnessCoverage && $criticalIllnessCoverage === 'yes' || $errors->has('critical_coverage_amount') ? 'checked' : '')  }} >
                                        <label for="yes" class="form-label display-6 lh-base">Yes</label>
                                    </span>
                                    <span class="d-flex me-5">
                                        <input type="radio" class="needs-radio" id="no" name="critical_coverage" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','0');jQuery('#critical_coverage_amount').removeAttr('required',false);"
                                        {{ ($criticalIllnessCoverage && $criticalIllnessCoverage === 'no' && !$errors->has('critical_coverage_amount') ? 'checked' : '') }} >
                                        <label for="no" class="form-label display-6 lh-base">No</label>
                                    </span>
                                </p>
                                <div class="hide-content">
                                    <p class="display-6">Existing policy amount: <span class="text-primary fw-bold border-bottom border-dark border-3 currencyField display-5 d-inline-block">RM<input type="text" name="critical_coverage_amount" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('critical_coverage_amount') is-invalid @enderror" id="critical_coverage_amount" value="{{ $coverageAmount !== null ? number_format(floatval($coverageAmount)) : $coverageAmount }}" required></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('critical_coverage_amount') || $errors->has('critical_coverage'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('critical_coverage_amount') }} {{ $errors->first('critical_coverage') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('health.medical.planning.existing.protection')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var sessionCriticalIllnessCoverageAmount = parseFloat({{$coverageAmount}});
</script>
@endsection