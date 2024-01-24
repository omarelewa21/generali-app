<?php
 /**
 * Template Name: Savings Risk Profile Page
 */
?>

@extends('templates.master')

@section('title')
<title>Savings - Risk Profile</title>

@section('content')

@php
    // Retrieving values from the session
    $protectionPriority = session('customer_details.priorities.protectionDiscuss');
    $retirementPriority = session('customer_details.priorities.retirementDiscuss');
    $educationPriority = session('customer_details.priorities.educationDiscuss');
    $savingsPriority = session('customer_details.priorities.savingsDiscuss');

    // Set the default value for $need_sequence
    $need_sequence = 0;
    $protectionDiscuss = isset($protectionPriority) && ($protectionPriority == true || $protectionPriority == 'true');
    $retirementDiscuss = isset($retirementPriority) && ($retirementPriority == true || $retirementPriority == 'true');
    $educationDiscuss = isset($educationPriority) && ($educationPriority == true || $educationPriority == 'true');

    $need_sequence = ($protectionDiscuss ? ($retirementDiscuss ? ($educationDiscuss ? 4 : 3) : ($educationDiscuss ? 3 : 2)) : ($retirementDiscuss ? ($educationDiscuss ? 3 : 2) : ($educationDiscuss ? 2 : 1)));
    $need = 'need_' . $need_sequence;

    $savingsRiskProfile = session('customer_details.selected_needs.'. $need .'.advance_details.risk_profile','High Risk');
    $savingsPotentialReturn = session('customer_details.selected_needs.'. $need .'.advance_details.potential_return','High Potential Return');
    $savingsGoalPA = session('customer_details.selected_needs.'. $need .'.advance_details.annual_returns');
@endphp

<div id="savings-risk-profile" class="tertiary-default-bg">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.savings.risk.profile')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/risk-profile/high-risk.png') }}" id="high-risk-img" width="auto" height="100%" alt="High Risk Avatar" style="display:block;">
                                <img src="{{ asset('images/needs/risk-profile/medium-risk.png') }}" id="medium-risk-img" width="auto" height="100%" alt="Medium Risk Avatar" style="display:none;">
                                <img src="{{ asset('images/needs/risk-profile/low-risk.png') }}" id="low-risk-img" width="auto" height="100%" alt="Low Risk Avatar" style="display:none;">
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm mb-4">I am a</h2>
                                <div class="col-12 mb-3 z-1">
                                    <button class="risk-btn f-family @if($savingsRiskProfile === 'High Risk') default @endif" id="high-risk" data-avatar="High Risk" data-required="{{old('savingsRiskProfileInput') === 'High Risk' ? 'selected' : ''}}">High Risk Taker</button>
                                </div>
                                <div class="col-12 mb-3 z-1" id="high-risk-potential-content" style="display:none;">
                                    <p class="risk-potential-title fw-bold">and expect</p>
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex">
                                            <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'High Risk' && $savingsPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                            <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($savingsRiskProfile === 'High Risk' && $savingsPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                            <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'High Risk' && $savingsPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                        </div>
                                    </div>
                                    <p class="risk-potential-title fw-bold">potential returns.</p>
                                </div>
                                <div class="col-12 mb-3 z-1">
                                    <button class="risk-btn f-family @if($savingsRiskProfile === 'Medium Risk') default @endif" id="medium-risk" data-avatar="Medium Risk" data-required="{{old('savingsRiskProfileInput') === 'Medium Risk' ? 'selected' : ''}}">Medium Risk Taker</button>
                                </div>
                                <div class="col-12 mb-3 z-1" id="medium-risk-potential-content" style="display:none;">
                                    <p class="risk-potential-title fw-bold">and expect</p>
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex">
                                            <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Medium Risk' && $savingsPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                            <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($savingsRiskProfile === 'Medium Risk' && $savingsPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                            <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Medium Risk' && $savingsPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                        </div>
                                    </div>
                                    <p class="risk-potential-title fw-bold">potential returns.</p>
                                </div>
                                <div class="col-12 mb-3 z-1">
                                    <button class="risk-btn f-family @if($savingsRiskProfile === 'Low Risk') default @endif" id="low-risk" data-avatar="Low Risk" data-required="{{old('savingsRiskProfileInput') === 'Low Risk' ? 'selected' : ''}}">Low Risk Taker</button>
                                </div>
                                <div class="col-12 mb-3 risk-potential-content" id="low-risk-potential-content" style="display:none;">
                                    <p class="risk-potential-title fw-bold">and expect</p>
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex">
                                            <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Low Risk' && $savingsPotentialReturn === 'High Potential Return') default @endif" id="high-potential-return" data-risk="High Potential Return" data-required="">High</button>
                                            <button class="potential-btn risk-potential-content border-start-0 border-end-0 f-family @if($savingsRiskProfile === 'Low Risk' && $savingsPotentialReturn === 'Medium Potential Return') default @endif" id="medium-potential-return" data-risk="Medium Potential Return" data-required="">Medium</button>
                                            <button class="potential-btn risk-potential-content f-family @if($savingsRiskProfile === 'Low Risk' && $savingsPotentialReturn === 'Low Potential Return') default @endif" id="low-potential-return" data-risk="Low Potential Return" data-required="">Low</button>
                                        </div>
                                    </div>
                                    <p class="risk-potential-title fw-bold">potential returns.</p>
                                </div>
                                <input type="hidden" name="savingsRiskProfileInput" id="savingsRiskProfileInput" value="{{old('savingsRiskProfileInput', $savingsRiskProfile)}}">
                                <input type="hidden" name="savingsPotentialReturnInput" id="savingsPotentialReturnInput" value="{{$savingsPotentialReturn}}">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('savingsRiskProfileInput') || $errors->has('savingsPotentialReturnInput'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->has('savingsRiskProfileInput') && $errors->has('savingsPotentialReturnInput') ? $errors->first('savingsRiskProfileInput') : $errors->first('savingsPotentialReturnInput') }} {{$errors->first('savingsRiskProfileInput')}}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('savings.annual.return')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

<div class="modal fade" id="missingSavingsFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingSavingsFieldsLabel">Savings Priority to discuss is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to enable savings priority to discuss in Priorities To Discuss page first.</p>
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
    var savingsPriority = '{{$savingsPriority}}';
    var lastPageInput = '{{$savingsGoalPA}}';
</script>
@endsection