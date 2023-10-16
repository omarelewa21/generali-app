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

<div id="education-content"  class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-education-others bg-education-others-mob wrapper-needs-supporting-default">
                    <section class="header-needs-default">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                                @include('templates.nav.nav-red-menu')
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0 mt-lg-0">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-md-2 px-lg-2">
                                        <div
                                            class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$educationFundPercentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h3 id="TotalEducationFund" class="m-1 text-light text-center">RM {{number_format(floatval($totalEducationNeeded)) }}</h3>
                                        <p class="text-light text-center">Total Education Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('validate.education.existing.fund')}}" method="POST" id="children_education" class="m-0 content-supporting-default @if ($errors->has('education_saving_amount')) pb-7 @endif">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="education-monthly-content">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{ asset('images/needs/education/other/education-other-avatar.png') }}" class="mt-auto mh-100 w-auto mw-100 avatar-img">
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('education_saving_amount') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-start first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-10 col-md-9 py-xl-5 my-xl-5">
                                                <h5 class="f-34 m-0 fw-700 f-family">Luckily, I do have funds saved up for my child’s education.<br>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio @error('education_saving_amount') checked-yes @enderror {{$edcationSaving === 'yes' ? 'checked-yes' : ''}}" id="yes" name="education_other_savings" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('display','block');jQuery('#education_saving_amount').attr('required',true);"
                                                        {{ ($edcationSaving === 'yes' || $errors->has('education_saving_amount') ? 'checked' : '')  }} >
                                                        <label for="yes" class="form-label fw-400">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('display','none');jQuery('#education_saving_amount').removeAttr('required',false);"
                                                        {{ ($edcationSaving === 'no' && !$errors->has('education_saving_amount') ? 'checked' : '') }} >
                                                        <label for="no" class="form-label">No</label>
                                                    </span>
                                                </h5>
                                                <p class="hide-content">Current savings amount:
                                                    <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-45 money f-34 @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" value="{{ $educationSavingAmount !== null ? number_format(floatval($educationSavingAmount)) : $educationSavingAmount }}" required></span>
                                                </p>
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                                <input type="hidden" name="percentage" id="percentage" value="{{$educationFundPercentage}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('education.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if ($errors->has('education_saving_amount') || $errors->has('education_other_savings'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('education_saving_amount') }}{{ $errors->first('education_other_savings') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('education_saving_amount') }}{{ $errors->first('education_other_savings') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('education_saving_amount') || $errors->has('education_other_savings') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('education.supporting.years')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                        <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
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