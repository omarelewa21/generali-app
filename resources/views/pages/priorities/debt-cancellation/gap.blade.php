@extends('templates.master')

@section('title')
<title>Debt Cancellation - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $debtCancellation = session('customer_details.debt-cancellation_needs');
    $settlementYears = session('customer_details.debt-cancellation_needs.remainingYearsOfSettlement');
    $debtOutstandingLoan = session('customer_details.debt-cancellation_needs.outstandingLoan');
    $existingDebtAmount = session('customer_details.debt-cancellation_needs.existingDebtAmount');
    $totalAmountNeeded = session('customer_details.debt-cancellation_needs.totalAmountNeeded');
    $debtFundPercentage = session('customer_details.debt-cancellation_needs.fundPercentage', '0');
    $totalDebtNeeded = session('customer_details.debt-cancellation_needs.totalDebtCancellationFund');
@endphp

<div id="debt-cancellation-summary" class="summary-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('form.submit.debt.cancellation.gap')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-4 text-center">Total Protection Fund</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-xl-5 col-lg-5 col-md-12 h-100 d-flex justify-content-center align-items-end">
                                <div class="svg-container h-100" style="transform:scale(1.3)">
                                    <div class="card-gap h-100" id="gap">
                                        <div class="card-gap__percent h-100">
                                            <svg>
                                                <defs>
                                                    <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                        <stop offset="10%"   stop-color="{{ $debtFundPercentage >= 100 ? 'rgba(100, 238, 215)' : '#FF7D7A' }}"/>
                                                        <stop offset="100%" stop-color="{{ $debtFundPercentage >= 100 ? '#14A38B' : '#C1210D' }}"/>
                                                    </linearGradient >
                                                </defs>
                                                <g id="circle">
                                                    <circle cx="90" cy="90" r="144" stroke="url(#gradient)"></circle>
                                                    <circle r="15" style="fill:white;display:none;" id="dotCircle"></circle>
                                                </g>
                                            </svg>
                                            <div class="circle"></div>
                                            <div class="circle circle__medium"></div>
                                            <div class="circle circle__small"></div>
                                            <div class="card-gap__number text-primary text-center">{{ $totalAmountNeeded > $totalDebtNeeded ? '100' : floor(floatval($debtFundPercentage))}}%
                                                <p class="avatar-text text-center fw-bold text-black">covered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-12 py-5">
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-clock.png') }}" alt="clock icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">Within the next</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">{{$settlementYears}} years</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-umbrella.png') }}" alt="umbrella icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">I'd like to clear my debt of</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">RM {{number_format(floatval($debtOutstandingLoan))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-saving.png') }}" alt="saving icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">I have put aside</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end">RM {{number_format(floatval($existingDebtAmount))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-summary.png') }}" alt="summary icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">So I need a debt cancellation plan for</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end {{ $totalAmountNeeded === '0' ? 'text-correct' : '' }}">RM {{number_format(floatval($totalAmountNeeded))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center {{ $totalAmountNeeded === '0' ? 'green-tick' : 'red-tick' }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('debt.cancellation.critical.illness')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<script>
    var existingDebtAmount =  {{$existingDebtAmount}};
    var percentage = {{$debtFundPercentage}};
    var totalDebtFund = {{$totalDebtNeeded}}
</script>

@endsection