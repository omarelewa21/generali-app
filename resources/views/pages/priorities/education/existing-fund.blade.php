@extends('templates.master')

@section('title')
<title>Education - Other Savings</title>

@section('content')

@php
    // Retrieving values from the session
    $educationPriority = session('customer_details.priorities.education_discuss');
    $education = session('customer_details.education_needs');
    $edcationSaving = session('customer_details.education_needs.existingFund');
    $educationSavingAmount = session('customer_details.education_needs.existingFundAmount');
    $totalEducationNeeded = session('customer_details.education_needs.totalEducationNeeded','0');
    $educationFundPercentage = session('customer_details.education_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.education_needs.totalAmountNeeded');
    $tertiaryEducationAmount = session('customer_details.education_needs.tertiaryEducationAmount');
    $totalEducationYear = session('customer_details.education_needs.tertiaryEducationYear');
@endphp

<div id="education-existing-fund" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu-needs')</div></div>
            <form novalidate action="{{route('validate.education.existing.fund')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$educationFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalEducationFund" class="text-center display-3 text-uppercase text-white overflow-hidden text-nowrap">RM{{ $educationSavingAmount === null || $educationSavingAmount === '' ? number_format(floatval($totalEducationNeeded)) : ($totalEducationNeeded > $educationSavingAmount ? number_format(floatval($totalEducationNeeded - $educationSavingAmount)) : '0') }}</h1>
                                <p class="text-white display-6 lh-base text-center">Total Education Fund Needed</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-1">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                <img src="{{ asset('images/needs/education/other/education-other-avatar.png') }}" width="auto" height="100%" alt="Existing Policy">
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-6 py-5 order-md-2 order-1 order-sm-1">
                                <h2 class="display-5 fw-bold lh-sm">Luckily, I do have funds saved up for my child’s education.</h2>
                                <p class="d-flex pt-5">
                                    <span class="me-5 d-flex">
                                        <input type="radio" class="needs-radio @error('education_saving_amount') checked-yes @enderror {{$edcationSaving === 'yes' ? 'checked-yes' : ''}}" id="yes" name="education_other_savings" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','1');jQuery('#education_saving_amount').attr('required',true);"
                                        {{ ($edcationSaving && $edcationSaving === 'yes' || $errors->has('education_saving_amount') ? 'checked' : '')  }} >
                                        <label for="yes" class="form-label display-6 lh-base">Yes</label>
                                    </span>
                                    <span class="d-flex me-5">
                                        <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','0');jQuery('#education_saving_amount').removeAttr('required',false);"
                                        {{ ($edcationSaving && $edcationSaving === 'no' && !$errors->has('education_saving_amount') ? 'checked' : '') }} >
                                        <label for="no" class="form-label display-6 lh-base">No</label>
                                    </span>
                                </p>
                                <div class="hide-content">
                                    <p class="display-6">Current savings amount: <span class="text-primary fw-bold border-bottom border-dark border-3 currencyField display-5 d-inline-block">RM<input type="text" name="education_saving_amount" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" value="{{ $educationSavingAmount !== null ? number_format(floatval($educationSavingAmount)) : $educationSavingAmount }}" required></span></p>
                                </div>
                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                <input type="hidden" name="percentage" id="percentage" value="{{$educationFundPercentage}}">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('education_saving_amount') || $errors->has('education_other_savings'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('education_saving_amount') }} {{ $errors->first('education_other_savings') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('education.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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

<div class="modal fade" id="missingEducationFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingEducationFieldsLabel">Education Priority to discuss is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to enable education priority to discuss in Priorities To Discuss page first.</p>
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
    var oldTotalFund = parseFloat({{ $totalEducationNeeded }});
    var educationFundPercentage = parseFloat({{ $educationFundPercentage }});
    var sessionTotalAmount = parseFloat({{ $totalAmountNeeded }});
    var sessionSavingAmount = parseFloat({{$educationSavingAmount}}); 
    var educationPriority = '{{$educationPriority}}';
    var sessionExistingFund = '{{$edcationSaving}}';
    var lastPageInput = '{{$tertiaryEducationAmount === "" || $tertiaryEducationAmount === null ? $tertiaryEducationAmount : $totalEducationYear}}';
</script>
@endsection