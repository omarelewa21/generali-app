@extends('templates.master')

@section('title')
<title>Education - Gap Summary</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
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
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('investment.home')}}" method="POST" class="m-0 content-supporting-default">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="education-monthly-content">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 bg-education-others-section second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{$educationSelectedImage}}" class="mt-auto mh-100 mx-auto avatar-img">
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-start first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-10 col-md-9 py-xl-5 my-xl-5">
                                                <p class="f-34 m-0"><strong>I’ve been saving up for my child’s education.</strong><br>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio" id="yes" name="education_other_savings" value="yes" autocomplete="off" onclick="jQuery('.hide-content').css('display','block');jQuery('#education_saving_amount').attr('required',true);">
                                                        <label for="yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" autocomplete="off" onclick="jQuery('.hide-content').css('display','none');jQuery('#education_saving_amount').removeAttr('required',false);">
                                                        <label for="no" class="form-label">No</label>
                                                    </span>
                                                </p>
                                                <p class="hide-content">Current savings amount:
                                                    <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-45 money f-34" id="education_saving_amount" value="{{ $educationSavingAmount !== null ? number_format(floatval($educationSavingAmount)) : $educationSavingAmount }}" required></span>
                                                </p>
                                                <input type="hidden" name="total_educationFund" id="total_educationFund" value="{{$totalEducationFundNeeded}}">
                                                <input type="hidden" name="total_amountNeeded" id="total_amountNeeded" value="{{$totalAmountNeeded}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('education.supporting.years')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('education.supporting.years')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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

@endsection