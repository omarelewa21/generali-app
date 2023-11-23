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

<div id="debt-critical-illness" class="bg-half-master">
<div class="container-fluid">
        <div class="row mh-100">
            <form novalidate action="{{route('validate.debt.critical.illness')}}" method="POST">
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
                                            <h3 id="TotalDebtCancellationFund" class="text-light text-center m-1 f-family">RM{{number_format(floatval($totalAmountNeeded))}}</h3>
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
                                    <div class="col-xxl-10 text-md-start text-sm-center text-center">
                                        <p class="f-40 f-family fw-bold lh-normal m-0 mb-md-5 mb-4">I already have Debt Cancellation coverage.</p>
                                        <p class="f-40 f-family fw-bold lh-normal m-0 d-flex">
                                            <span class="me-5 d-flex">
                                                <input type="radio" class="needs-radio @error('critical_coverage_amount') checked-yes @enderror {{$criticalIllnessCoverage === 'yes' ? 'checked-yes' : ''}}" id="yes" name="critical_coverage" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','1');jQuery('#critical_coverage_amount').attr('required',true);"
                                                {{ ($criticalIllnessCoverage && $criticalIllnessCoverage === 'yes' || $errors->has('critical_coverage_amount') ? 'checked' : '')  }} >
                                                <label for="yes" class="form-label">Yes</label>
                                            </span>
                                            <span class="d-flex me-5">
                                                <input type="radio" class="needs-radio" id="no" name="critical_coverage" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','0');jQuery('#critical_coverage_amount').removeAttr('required',false);"
                                                {{ ($criticalIllnessCoverage && $criticalIllnessCoverage === 'no' && !$errors->has('critical_coverage_amount') ? 'checked' : '') }} >
                                                <label for="no" class="form-label">No</label>
                                            </span>
                                        </p>
                                        <p class="hide-content">Current covered amount:
                                            <span class="currencyinput f-34">RM<input type="text" name="critical_coverage_amount" class="form-control d-inline-block w-45 money f-34 @error('critical_coverage_amount') is-invalid @enderror" id="critical_coverage_amount" value="{{ $coverageAmount !== null ? number_format(floatval($coverageAmount)) : $coverageAmount }}" required></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -130px">
                                    <img src="{{ asset('images/needs/debt-cancellation/existing-debt/avatar.png') }}" width="auto" height="480px" alt="Increment" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('critical_coverage_amount') || $errors->has('critical_coverage'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('critical_coverage_amount') }} {{ $errors->first('critical_coverage') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('debt.cancellation.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var sessionCriticalIllnessCoverageAmount = parseFloat({{$coverageAmount}});
</script>
@endsection