@extends('templates.master')

@section('title')
<title>Protection - Existing Policy</title>

@section('content')

@php
    // Retrieving values from the session
    $protection = session('customer_details.protection_needs');
    $existingPolicy = session('customer_details.protection_needs.existingPolicy');
    $existingPolicyAmount = session('customer_details.protection_needs.existingPolicyAmount');
    $totalProtectionNeeded = session('customer_details.protection_needs.totalProtectionNeeded');
    $protectionFundPercentage = session('customer_details.protection_needs.fundPercentage', '0');
    $totalAmountNeeded = session('customer_details.protection_needs.totalAmountNeeded');
@endphp

<div id="protection-existing-policy">
    <div class="container-fluid">
        <div class="row mh-100">
            <form novalidate action="{{route('validate.protection.existing.policy')}}" method="POST">
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
                                                <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$protectionFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h3 id="TotalProtectionFund" class="text-light text-center m-1 f-family">RM{{ $existingPolicyAmount === null || $existingPolicyAmount === '' ? number_format(floatval($totalProtectionNeeded)) : ($totalProtectionNeeded > $existingPolicyAmount ? number_format(floatval($totalProtectionNeeded - $existingPolicyAmount)) : '0') }}</h3>
                                            <p class="text-light text-center">Total Protection Needed</p>
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
                                        <p class="f-40 f-family fw-bold lh-normal m-0 mb-md-5 mb-4">Luckily, I do have an existing life insurance policy.</p>
                                        <p class="f-40 f-family fw-bold lh-normal m-0 d-flex">
                                            <span class="me-5 d-flex">
                                                <input type="radio" class="needs-radio @error('existing_policy_amount') checked-yes @enderror {{$existingPolicy === 'yes' ? 'checked-yes' : ''}}" id="yes" name="protection_existing_policy" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','1');jQuery('#existing_policy_amount').attr('required',true);"
                                                {{ ($existingPolicy && $existingPolicy === 'yes' || $errors->has('existing_policy_amount') ? 'checked' : '')  }} >
                                                <label for="yes" class="form-label">Yes</label>
                                            </span>
                                            <span class="d-flex me-5">
                                                <input type="radio" class="needs-radio" id="no" name="protection_existing_policy" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('opacity','0');jQuery('#existing_policy_amount').removeAttr('required',false);"
                                                {{ ($existingPolicy && $existingPolicy === 'no' && !$errors->has('existing_policy_amount') ? 'checked' : '') }} >
                                                <label for="no" class="form-label">No</label>
                                            </span>
                                        </p>
                                        <p class="hide-content">Existing policy amount:
                                            <span class="currencyinput f-34">RM<input type="text" name="existing_policy_amount" class="form-control d-inline-block w-45 money f-34 @error('existing_policy_amount') is-invalid @enderror" id="existing_policy_amount" value="{{ $existingPolicyAmount !== null ? number_format(floatval($existingPolicyAmount)) : $existingPolicyAmount }}" required></span>
                                        </p>
                                        <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                        <input type="hidden" name="percentage" id="percentage" value="{{$protectionFundPercentage}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer footer-avatar-grey">
                        <div class="container">
                            <div class="row position-relative">
                                <div class="col-md-6 text-center position-absolute justify-content-center align-items-center d-flex" style="bottom: -150px">
                                    <img src="{{ asset('images/needs/protection/protection-existing.png') }}" width="auto" height="500px" alt="Increment" class="mobileImg">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('existing_policy_amount') || $errors->has('protection_existing_policy'))
                            <div class="row position-absolute alert-position w-100 z-1">
                                <div class="col-12 alert alert-danger py-2 rounded-0 d-flex justify-content-center align-items-center alert-height m-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('existing_policy_amount') }}{{ $errors->first('protection_existing_policy') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white py-4 fixed-bottom footer-scroll">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.amount.needed')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
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
    var oldTotalFund = parseFloat({{ $totalProtectionNeeded }});
    var protectionFundPercentage = parseFloat({{ $protectionFundPercentage }});
    var sessionExistingPolicyAmount = parseFloat({{$existingPolicyAmount}});
</script>
@endsection