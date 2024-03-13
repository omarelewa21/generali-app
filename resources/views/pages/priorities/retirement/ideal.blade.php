<?php
 /**
 * Template Name: Retirement - Ideal Page
 */
?>

@extends('templates.master')

@section('title')
<title>Retirement - Ideal</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $retirementPriority = session('customer_details.priorities.retirement_discuss');

    $retirementIdeal = session('customer_details.selected_needs.need_2.advance_details.ideal_retirement');
    $relationship = session('customer_details.selected_needs.need_2.advance_details.relationship');
@endphp

<div id="retirement_ideal" class="ideal">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.retirement.ideal')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-xxl-6 col-xl-6 py-3 pt-md-0">
                                <h2 class="display-5 fw-bold text-center">My ideal retirement involves:</h2>
                                <p class="d-md-none d-block m-0 text-center">Please select one below:</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content">
                    <div class="container h-100">
                        <div class="row h-100 ideal_carousel justify-content-center align-items-center d-flex">
                            <div class="col-md-4 h-100 d-flex justify-content-center align-items-center py-3">
                                <button class="border-0 bg-transparent position-relative choice h-100 @if($retirementIdeal === 'retirement-travel') default @endif" id="retirement-travel" data-avatar="retirement-travel" data-required="">
                                    <!-- <div class="d-flex justify-content-end" style="flex-direction: column;"> -->
                                        <img src="{{ asset('images/needs/retirement/ideal-bucketlist.png') }}" height="auto" width="100%" class="pb-3 m-auto">
                                        <p class="avatar-text text-center fw-bold py-2 mb-0">Visiting destinations on my bucket list</p>
                                    <!-- </div> -->
                                </button>
                            </div>
                            <div class="col-md-4 h-100 d-flex justify-content-center align-items-center py-3">
                                <button class="border-0 bg-transparent position-relative choice h-100 @if($retirementIdeal === 'retirement-lifestyle') default @endif" id="retirement-lifestyle" data-avatar="retirement-lifestyle" data-required="">
                                    <img src="{{ asset('images/needs/retirement/ideal-lifestyle.png') }}" height="auto" width="100%" class="pb-3 m-auto">
                                    <p class="avatar-text text-center fw-bold py-2 mb-0">Maintaining a comfortable lifestyle</p>
                                </button>
                            </div>
                            <div class="col-md-4 h-100 d-flex justify-content-center align-items-center py-3">
                                <button class="border-0 bg-transparent position-relative choice h-100 @if($retirementIdeal === 'retirement-savings') default @endif" id="retirement-savings" data-avatar="retirement-savings" data-required="">
                                    <img src="{{ asset('images/needs/retirement/ideal-retire.png') }}" height="auto" width="100%" class="pb-3 m-auto">
                                    <p class="avatar-text text-center fw-bold py-2 mb-0">Retiring early with secure finances</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('retirementIdealInput'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('retirementIdealInput') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-accent-light-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="retirementIdealInput" id="retirementIdealInput" value="{{$retirementIdeal}}">
                                    <a href="{{route('retirement.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var needs_priority = '{{json_encode($retirementPriority)}}';
    var lastPageInput = '{{$relationship}}';
</script>
@endsection