<?php
 /**
 * Template Name: Debt Cancellation Homepage
 */
?>
@extends('templates.master')

@section('title')
<title>Debt Cancellation - Home</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $debtPriority = session('customer_details.priorities.debt-cancellationDiscuss');
    $protectionPriority = session('customer_details.priorities.protectionDiscuss');
    $retirementPriority = session('customer_details.priorities.retirementDiscuss');
    $educationPriority = session('customer_details.priorities.educationDiscuss');
    $savingsPriority = session('customer_details.priorities.savingsDiscuss');
    $investmentPriority = session('customer_details.priorities.investmentsDiscuss');
    $healthPriority = session('customer_details.priorities.health-medicalDiscuss');
    $selectedMedical = session('customer_details.health-medical_needs.medicalPlanningSelection');
@endphp

<div id="debt-cancellation_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner navbar-scroll">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-xl-5 py-3">
                    <h2 class="display-5 fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey content-section px-0">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block">
                <div class="wrapper-needs-grey main-default-bg">
                    <section class="header py-3 py-md-0">@include ('templates.nav.nav-sidebar-needs')</section>
                    <section class="content-needs">
                        <div class="col-12 d-flex justify-content-center align-items-center position-relative">
                            <img src="{{ asset('images/needs/debt-cancellation/home/avatar.png') }}" height="100%" width="auto" class="position-absolute" style="bottom:-40px" alt="Debt Cancellation Home">
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container h-100">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-xl-5 text-center">
                                    <h2 class="display-5 fw-bold lh-sm py-4">Let's set you up with Debt Cancellation plans.</h2>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        @php
                                            if ($healthPriority === 'true' || $healthPriority === true) {
                                                if($selectedMedical === 'Medical Planning Care'){
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
                                                $route = route('priorities.to.discuss');
                                            }
                                        @endphp
                                        <a href="{{ $route }}" class="btn btn-secondary text-uppercase flex-fill me-md-2">Back</a>
                                        <a href="{{route('debt.cancellation.coverage')}}" class="btn btn-primary flex-fill text-uppercase">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
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
<script>
    var debtPriority = '{{$debtPriority}}';
</script>
@endsection