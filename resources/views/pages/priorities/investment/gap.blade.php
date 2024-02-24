@extends('templates.master')

@section('title')
<title>Investment - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $investmentPriority = session('customer_details.priorities.investments_discuss');

    $investment = session('customer_details.selected_needs.need_5.advance_details');
    $investmentSupportingYears = session('customer_details.selected_needs.need_5.advance_details.supporting_years');
    $totalInvestmentNeeded = session('customer_details.selected_needs.need_5.advance_details.goals_amount', '0');
    $investmentFundPercentage = session('customer_details.selected_needs.need_5.advance_details.fund_percentage', '0');
    $investmentPA = session('customer_details.selected_needs.need_5.advance_details.annual_returns');

    $riskProfile = session('customer_details.risk_profile.selected_risk_profile');
    $potentialReturn = session('customer_details.risk_profile.selected_potential_return');

    $totalAnnualReturn = session('customer_details.selected_needs.need_5.advance_details.annual_return_amount');
    $investmentMonthlyPayment = session('customer_details.selected_needs.need_5.advance_details.covered_amount');
@endphp

<div id="investment-summary" class="secondary-default-bg summary-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('form.submit.investment.gap')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-4 text-center">Total Lump Sum Investment Fund</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-xl-5 col-md-12 h-100 d-flex justify-content-center align-items-end graph-col">
                                <div class="svg-container h-100 graph-size">
                                    <div class="card-gap h-100" id="gap">
                                        <div class="card-gap__percent h-100">
                                            <svg>
                                                <defs>
                                                    <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                        <stop offset="10%"   stop-color="{{ $investmentFundPercentage >= 100 ? 'rgba(100, 238, 215)' : '#FF7D7A' }}"/>
                                                        <stop offset="100%" stop-color="{{ $investmentFundPercentage >= 100 ? '#14A38B' : '#C1210D' }}"/>
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
                                            <div class="card-gap__number text-primary text-center">
                                                <img src="{{ asset('images/top-priorities/investments-icon.png') }}" style="width:85px;" class="mb-3"><br>
                                                <span>{{floor(floatval($investmentFundPercentage))}}%</span>
                                                <p class="avatar-text text-center fw-bold text-black">covered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-md-12 py-xxxl-5 gap-col pt-3">
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-tree.png') }}" alt="tree icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">I plan to invest a lump sum of</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end w-50">RM {{number_format(floatval($investmentMonthlyPayment))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-clock.png') }}" alt="clock icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">And let it grow for</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end w-50">{{$investmentSupportingYears}} years</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-umbrella.png') }}" alt="umbrella icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">With annual returns of</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end w-50">{{$investmentPA}}% p.a.</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-saving.png') }}" alt="saving icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">For a projected future investment value of</p>
                                            </div>
                                            <!-- <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end w-50">RM {{number_format(floatval($totalInvestmentNeeded) + (floatval($totalInvestmentNeeded) * (4 /100)) )}}</h4> -->
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end w-50">RM {{number_format(floatval($totalInvestmentNeeded))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center green-tick"></span>
                                </div>
                                <!-- <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <div class="d-flex bg-white rounded p-3 align-items-center border w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/needs/general/icon-summary.png') }}" alt="summary icon" width="54">
                                                <p class="avatar-text fw-bold text-black m-0 px-3">So I need a savings plan for</p>
                                            </div>
                                            <h4 class="display-5 fw-bold lh-sm m-0 text-primary text-end {{ $totalAnnualReturn === '0' ? 'text-correct' : '' }}">RM {{ number_format(floatval($totalAnnualReturn))}}</h4>
                                        </div>
                                    </div>
                                    <span class="align-self-center {{ $totalAnnualReturn === '0' ? 'green-tick' : 'red-tick' }}"></span>
                                </div> -->
                                <!-- <div class="row justify-content-center py-2">
                                    <div class="col-10 d-flex align-items-center">
                                        <p>*Calculated based on an average inflation rate of 4%.​</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('risk.profile')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

<div class="modal fade" id="missingInvestmentFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingInvestmentFieldsLabel">Investment Priority to discuss is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to enable investment priority to discuss in Priorities To Discuss page first.</p>
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
    var lastPageInput = '{{$riskProfile === "" || $riskProfile === null ? $riskProfile : $potentialReturn}}';
    var investmentAnnualReturn =  parseFloat({{$totalAnnualReturn}});
    var newTotalInvestmentNeeded = parseFloat({{$totalInvestmentNeeded}});
    var percentage = parseFloat({{$investmentFundPercentage}});
    var investmentPriority = '{{$investmentPriority}}';
</script>

@endsection