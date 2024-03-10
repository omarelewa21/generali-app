<?php
 /**
 * Template Name: Financial Statement - Monthly Goals Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Monthly Goals</title>
@endsection

@section('content')

@php
    $financialStatementMonthlySupport = session('customer_details.financialStatement.amountAvailable');
    $protectionCovered = session('customer_details.priorities.protection');
    $retirementCovered = session('customer_details.priorities.retirement');
    $educationCovered = session('customer_details.priorities.education');
    $savingsCovered = session('customer_details.priorities.savings');
    $investmentCovered = session('customer_details.priorities.investments');
    $healthCovered = session('customer_details.priorities.health-medical');
    $debtCovered = session('customer_details.priorities.debt-cancellation');
    $protectionPriority = session('customer_details.priorities.protection_discuss');
    $retirementPriority = session('customer_details.priorities.retirement_discuss');
    $educationPriority = session('customer_details.priorities.education_discuss');
    $savingsPriority = session('customer_details.priorities.savings_discuss');
    $investmentPriority = session('customer_details.priorities.investments_discuss');
    $healthPriority = session('customer_details.priorities.health-medical_discuss');
    $debtPriority = session('customer_details.priorities.debt-cancellation_discuss');
@endphp

<div id="monthly_goals" class="secondary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
            <form novalidate action="{{route('validate.summary.monthly.goals')}}" method="POST" class="content-needs-grey">
                @csrf
                <section class="top-menu"></section>
                <section class="heading"></section>
                <section class="bottom-content z-1 d-flex justify-content-center align-items-center pt-0 m-auto h-100">
                    <div class="container h-100">
                        <div class="row justify-content-center align-items-center position-relative h-100">
                            <div class="col-md-3 col-xl-4 d-flex justify-content-end col-12 pt-3">
                                <div class="col-xxl-6">
                                    <h2 class="display-5 fw-bold text-end lh-base">I’m willing to set aside</h2>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 col-12 h-100 h-sm-auto">
                                <div class="row justify-content-center position-relative h-100 h-sm-auto">
                                    <img src="{{ asset('images/summary/tabung.png') }}" height="auto" width="90%" alt="Monthly Goals" class="m-auto mh-100">
                                    <div class="col-12 position-absolute center px-5">
                                        <p class="display-3 currencyField d-flex justify-content-center">
                                            <span class="text-black fw-bold border-bottom border-dark border-3">RM<input type="text" name="financial_statement_monthly_support" class="form-control display-3 position-relative border-0 d-inline-block w-75 w-md-50 fw-bold text-primary @error('financial_statement_monthly_support') is-invalid @enderror" id="financial_statement_monthly_support" value="{{ $financialStatementMonthlySupport !== null ? number_format(floatval($financialStatementMonthlySupport)) : $financialStatementMonthlySupport }}" required></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-4 d-flex justify-content-start col-12 last-content">
                                <div class="col-xxl-7">
                                    <h2 class="display-5 fw-bold text-start lh-base">per month to fulfill my goals.</h2>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="container"> -->
                        <!-- <div class="row justify-content-center position-relative">
                            <div class="col-md-6 col-xl-4 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -90px">
                                <img src="{{ asset('images/summary/bank-container.png') }}" width="90%" alt="Monthly Goals" class="d-md-block d-none">
                                
                            </div>
                        </div> -->
                        <!-- </div> -->
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('financial_statement_monthly_support'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('financial_statement_monthly_support') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    @php
                                        if($debtCovered === 'true' || $debtCovered === true || $healthCovered === 'true' || $healthCovered === true || $investmentCovered === 'true' || $investmentCovered === true || $savingsCovered === 'true' || $savingsCovered === true || $educationCovered === 'true' || $educationCovered === true || $retirementCovered === 'true' || $retirementCovered === true || $protectionCovered === 'true' || $protectionCovered === true){
                                            $route = route('existing.policy');
                                        }
                                        else {
                                            if($debtPriority === 'true' || $debtPriority === true){
                                                $route = route('debt.cancellation.gap');
                                            } elseif ($healthPriority === 'true' || $healthPriority === true) {
                                                if($selectedMedical === 'Yes'){
                                                    $route = route('health.medical.planning.gap');
                                                } else{ 
                                                    $route = route('health.medical.critical.gap');
                                                }
                                            } elseif ($investmentPriority === 'true' || $investmentPriority === true) {
                                                $route = route('investment.gap');
                                            } elseif ($savingsPriority === 'true' || $savingsPriority === true) {
                                                $route = route('savings.gap');
                                            } elseif ($educationPriority === 'true' || $educationPriority === true) {
                                                $route = route('education.gap');
                                            } elseif ($retirementPriority === 'true' || $retirementPriority === true) {
                                                $route = route('retirement.gap');
                                            } elseif ($protectionPriority === 'true' || $protectionPriority === true) {
                                                $route = route('protection.gap');
                                            }
                                            else {
                                                $route = route('financial.priorities.discuss');
                                            }
                                        }
                                    @endphp
                                    <a href="{{ $route }}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

@endsection