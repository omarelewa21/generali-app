@extends('templates.master')

@section('title')
<title>Education - Other Savings</title>

@section('content')

@php
    // Retrieving values from the session
    $education = session('customer_details.education_needs');
    $edcationSaving = session('customer_details.education_needs.existingFund');
    $educationSavingAmount = session('customer_details.education_needs.existingFundAmount');
    $totalEducationNeeded = session('customer_details.education_needs.totalEducationNeeded','0');
    $educationFundPercentage = session('customer_details.education_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.education_needs.totalAmountNeeded');
@endphp

<div id="education-existing-fund" class="bg-education-others">
    <div class="container-fluid">
        <div class="row mh-100">
            <form novalidate action="{{route('validate.education.existing.fund')}}" method="POST">
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
                                                <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$educationFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h3 id="TotalEducationFund" class="text-light text-center m-1 f-family">RM{{ $educationSavingAmount === null || $educationSavingAmount === '' ? number_format(floatval($totalEducationNeeded)) : ($totalEducationNeeded > $educationSavingAmount ? number_format(floatval($totalEducationNeeded - $educationSavingAmount)) : '0') }}</h3>
                                            <p class="text-light text-center">Total Education Fund Needed</p>
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
                                        <p class="f-40 f-family fw-bold lh-normal m-0 mb-md-5 mb-4">Luckily, I do have funds saved up for my child’s education.</p>
                                        <p class="f-40 f-family fw-bold lh-normal m-0 d-flex">
                                            <span class="me-5 d-flex">
                                                <input type="radio" class="needs-radio @error('education_saving_amount') checked-yes @enderror {{$edcationSaving === 'yes' ? 'checked-yes' : ''}}" id="yes" name="education_other_savings" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','1');jQuery('#education_saving_amount').attr('required',true);"
                                                {{ ($edcationSaving && $edcationSaving === 'yes' || $errors->has('education_saving_amount') ? 'checked' : '')  }} >
                                                <label for="yes" class="form-label">Yes</label>
                                            </span>
                                            <span class="d-flex me-5">
                                                <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','0');jQuery('#education_saving_amount').removeAttr('required',false);"
                                                {{ ($edcationSaving && $edcationSaving === 'no' && !$errors->has('education_saving_amount') ? 'checked' : '') }} >
                                                <label for="no" class="form-label">No</label>
                                            </span>
                                        </p>
                                        <p class="hide-content">Current savings amount:
                                            <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-45 money f-34 @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" value="{{ $educationSavingAmount !== null ? number_format(floatval($educationSavingAmount)) : $educationSavingAmount }}" required></span>
                                        </p>
                                        <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                        <input type="hidden" name="percentage" id="percentage" value="{{$educationFundPercentage}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                                    <img src="{{ asset('images/needs/education/other/education-other-avatar.png') }}" width="auto" height="450px" alt="Increment" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('education_saving_amount') || $errors->has('education_other_savings'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('education_saving_amount') }} {{ $errors->first('education_other_savings') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
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
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var oldTotalFund = parseFloat({{ $totalEducationNeeded }});
    var educationFundPercentage = parseFloat({{ $educationFundPercentage }});
    var sessionTotalAmount = parseFloat({{ $totalAmountNeeded }});
    var sessionSavingAmount = parseFloat({{$educationSavingAmount}}); 
</script>
@endsection