<?php
 /**
 * Template Name: Retirement - Allocated Funds Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Retirement - Allocated Funds</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $retirementPriority = session('customer_details.priorities.retirement_discuss');
    $retirementSavings = session('customer_details.selected_needs.need_2.advance_details.existing_amount');
    $supportingYears = session('customer_details.selected_needs.need_2.advance_details.supporting_years');
    $totalRetirementNeeded = session('customer_details.selected_needs.need_2.advance_details.goals_amount', '0');
    $retirementFundPercentage = session('customer_details.selected_needs.need_2.advance_details.fund_percentage', '0');
    $retirementAge = session('customer_details.selected_needs.need_2.advance_details.remaining_years');

    $customOtherIncomeSources = session('customer_details.selected_needs.need_2.advance_details.other_sources_custom');
    $otherIncomeSources = session('customer_details.selected_needs.need_2.advance_details.other_sources');
    $totalAmountNeeded = session('customer_details.selected_needs.need_2.advance_details.insurance_amount');
@endphp

<div id="retirement_allocated_funds" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12">
                <div class="row calculatorMenuMob">@include('templates.nav.nav-red-menu-needs')</div>
                <div class="bg-primary row d-md-none calculatorMob">
                    <div class="col-6">   
                        <h1 id="TotalRetirementFundMob" class="display-3 text-uppercase text-white overflow-hidden ps-4 text-nowrap my-2">RM{{ 
                            $retirementSavings === null || $retirementSavings === '' 
                                ? number_format(floatval($totalRetirementNeeded)) 
                                : ($retirementSavings > floatval($totalRetirementNeeded) 
                                ? '0' 
                                : number_format(floatval($totalRetirementNeeded) - floatval($retirementSavings)))
                            }}
                        </h1>
                    </div>
                    <div class="col-6 m-auto">
                        <p class="text-white display-6 lh-base text-end pe-4 m-0">Total Retirement Fund Needed</p>
                    </div>
                </div>
            </div>
            <form novalidate action="{{route('validate.retirement.allocated.funds')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu pt-md-0 py-3">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading d-none d-md-block">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$retirementFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalRetirementFund" class="text-center display-3 text-uppercase text-white overflow-hidden text-nowrap">RM{{ 
                                    $retirementSavings === null || $retirementSavings === '' 
                                        ? number_format(floatval($totalRetirementNeeded)) 
                                        : ($retirementSavings > floatval($totalRetirementNeeded) 
                                        ? '0' 
                                        : number_format(floatval($totalRetirementNeeded) - floatval($retirementSavings)))
                                    }}
                                </h1>
                                <p class="text-white display-6 lh-base text-center">Total Retirement Fund Needed</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-md-1">
                    <div class="container h-100 px-4 px-md-0">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/retirement/allocated-funds.png') }}" width="auto" height="100%" alt="Retirement Other Income Sources Avatar">
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-6 py-lg-5 pt-4 calculatorContent">
                                <div class="h-sm-100 row">
                                    <h2 class="display-5 fw-bold lh-sm">So far, I’ve put aside</h2>
                                    <p class="display-5 fw-bold currencyField">
                                        <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="retirement_savings" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('retirement_savings') is-invalid @enderror" id="retirement_savings" value="{{ $retirementSavings !== null ? number_format(floatval($retirementSavings)) : $retirementSavings }}"></span>
                                        <br>for my retirement,through these income sources:
                                        <!-- <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="text" name="other_income_sources" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('other_income_sources') is-invalid @enderror" id="other_income_sources" value="{{ $otherIncomeSources }}" required></span> -->
                                    </p>
                                    <p class="text-start"><input type="checkbox" class="needs-radio other-income-checkbox" name="other_income_sources_1" id="other_income_sources_1" {{strpos($otherIncomeSources, 'Unit Trust') !== false ? 'checked' : '' }} value="Unit Trust"><label for="other_income_sources_1" class="form-label display-6 lh-base">Unit Trust</label></p>
                                    <p class="text-start"><input type="checkbox" class="needs-radio other-income-checkbox" name="other_income_sources_2" id="other_income_sources_2" {{strpos($otherIncomeSources, 'Stock Trust') !== false ? 'checked' : '' }} value="Stock Trust"><label for="other_income_sources_2" class="form-label display-6 lh-base">Stock Trust</label></p>
                                    <p class="text-start"><input type="checkbox" class="needs-radio other-income-checkbox" name="other_income_sources_3" id="other_income_sources_3" {{strpos($otherIncomeSources, 'Fixed Deposit (FD)') !== false ? 'checked' : '' }} value="Fixed Deposit (FD)"><label for="other_income_sources_3" class="form-label display-6 lh-base">Fixed Deposit (FD)</label></p>
                                    <p class="text-start"><input type="checkbox" class="needs-radio other-income-checkbox" name="other_income_sources_4" id="other_income_sources_4" {{strpos($otherIncomeSources, 'Employee Provident Fund (EPF)') !== false ? 'checked' : '' }} value="Employee Provident Fund (EPF)"><label for="other_income_sources_4" class="form-label display-6 lh-base">Employee Provident Fund (EPF)</label></p>
                                    <p class="text-start">
                                        <input type="checkbox" class="needs-radio other-income-checkbox" name="other_income_sources_5" id="other_income_sources_5" {{strpos($otherIncomeSources, $customOtherIncomeSources) !== false && $customOtherIncomeSources != null  ? 'checked' : '' }} value="Others">
                                        <label for="other_income_sources_5" class="form-label display-6 lh-base">Others</label>
                                        <span>
                                            <input type="text" name="other_income_sources_5_text" class="form-control position-relative d-inline-block w-50 bg-transparent {{strpos($otherIncomeSources, $customOtherIncomeSources) !== false && $customOtherIncomeSources != null  ? '' : 'disabled-color' }} @error('other_income_sources_5_text') is-invalid @enderror" id="other_income_sources_5_text" {{strpos($otherIncomeSources, $customOtherIncomeSources) !== false && $customOtherIncomeSources != null  ? '' : 'disabled' }} value="{{ $customOtherIncomeSources }}">
                                        </span>
                                    </p>
                                    <p><input type="hidden" name="other_income_sources" id="other_income_sources" value="{{$otherIncomeSources}}"></p>
                                    <p><input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}"></p>
                                    <p><input type="hidden" name="percentage" id="percentage" value="{{$retirementFundPercentage}}"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('other_income_sources') || $errors->has('retirement_savings'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('other_income_sources') }} {{ $errors->first('retirement_savings') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
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
            </form>
            <div class="footer-avatar-grey d-none d-md-block"></div>
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
    var oldTotalFund = parseFloat({{ $totalRetirementNeeded }});
    var retirementFundPercentage = parseFloat({{ $retirementFundPercentage }});
    var sessionRetirementSavings = parseFloat({{$retirementSavings}});
    var priority = '{{$retirementPriority}}';
    var lastPageInput = '{{$supportingYears === "" || $supportingYears === null ? $supportingYears : $retirementAge}}';
</script>

@endsection