@extends('templates.master')

@section('title')
<title>Education - Other Savings</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayDataEducation = session('passingArrays');
    $educationSelectedImage = isset($arrayDataEducation['educationSelectedImage']) ? $arrayDataEducation['educationSelectedImage'] : '';
    $totalEducationFundNeeded = isset($arrayDataEducation['totalEducationFundNeeded']) ? $arrayDataEducation['totalEducationFundNeeded'] : '';
    $educationFundPercentage = isset($arrayDataEducation['educationFundPercentage']) ? $arrayDataEducation['educationFundPercentage'] : 0;
@endphp

<div id="education-content"  class="vh-100 scroll-content">
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-12">
                <div class="row h-100 bg-needs-desktop bg-half wrapper-needs-supporting-default">
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
                                        <h3 id="TotalEducationFund" class="m-1 text-light text-center">RM {{ $totalEducationFundNeeded !== null ? number_format(floatval($totalEducationFundNeeded)) : $totalEducationFundNeeded }}</h3>
                                        <p class="text-light text-center">Total Education Fund Needed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                                @include('templates.nav.nav-sidebar-needs')
                            </div>
                        </div>
                    </section>
                    <form novalidate action="{{route('form.submit.education.other')}}" method="POST" id="children_education">
                        @csrf
                        <section class="row edu-con align-items-end mh-100">
                            <div class="col-12 position-relative mh-100">
                                <div class="row h-100" id="education-monthly-content">
                                    <div class="col-12 col-xl-6 d-flex align-items-end justify-content-center z-1 mh-100 bg-education-supporting second-order">
                                        <div class="text-center education-support mh-100 z-1 h-100">
                                            <img src="{{$educationSelectedImage}}" class="mt-auto mh-100 mx-auto avatar-img">
                                            <p class="py-2 m-0 avatar-text" id="displayFund">RM {{ $totalEducationFundNeeded !== null ? number_format(floatval($totalEducationFundNeeded)) : $totalEducationFundNeeded }}</p>
                                        </div>
                                        <div class="col-12 position-absolute bottom-0 show-mobile">
                                            <div class="row">
                                                <div class="needs-stand-bg bg-btn_bar {{ $errors->has('educationMonthlyAmount') ? 'error-padding' : '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 d-flex align-items-center first-order pt-4 pt-lg-0 z-1">
                                        <div class="row justify-content-center">
                                            <div class="col-10 col-md-8 d-flex align-items-center">
                                                <p class="f-34"><strong>I’ve been saving up for my child’s education.</strong><br>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio @error('education_saving_amount') checked-yes @enderror" id="yes" name="education_other_savings" value="yes" onclick="jQuery('.hide-content').css('display','block');jQuery('#education_saving_amount').attr('required',true);" required @error('education_saving_amount') checked @enderror>
                                                        <label for="yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" onclick="jQuery('.hide-content').css('display','none');jQuery('#education_saving_amount').removeAttr('required',false);">
                                                        <label for="no" class="form-label">No</label>
                                                    </span>
                                                </p>
                                                <p class="mt-5 hide-content @error('education_saving_amount') is-invalid @enderror">Current savings amount:
                                                    <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-30 money f-34 @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" required></span>
                                                </p>
                                                <input type="hidden" name="total_educationFund" id="total_educationFund" value="{{$totalEducationFundNeeded}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 show-mobile footer bg-white py-4 z-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- <section class="needs-master-content hide">
                            <div class="col-12">
                                <div class="row h-100 overflow-y-auto overflow-x-hidden">
                                    <div class="col-12 show-mobile">
                                        <div class="row d-flex justify-content-center align-items-center bg-primary">
                                                <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                                    <div class="px-2 fund-progress-bar" style="width:45%;"></div>
                                                </div>
                                                <h3 class="font-color-white text-center">RM1,462,000</h3>
                                                <p class="font-color-white text-center">Total Education Fund Needed</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-12 position-relative bg-education-others-mob second-order d-flex justify-content-end align-items-end h-xxl-100">
                                        <div class="row bg-education-others-section">
                                            <div class="col-4 d-flex align-items-center h-100 py-3 position-relative">
                                                <div class="row d-flex h-100">
                                                    <img src="{{ asset('images/avatar/son.png') }}" class="w-100 z-99">
                                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                        <div class="col-11 col-md-4 text-center">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex align-items-center h-100 py-3 position-relative">
                                                <div class="row d-flex h-100">
                                                    <img src="{{ asset('images/avatar/daughter.png') }}" class="w-100 z-99">
                                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                        <div class="col-11 col-md-4 text-center">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex align-items-center h-100 py-3 position-relative">
                                                <div class="row h-100">
                                                    <img src="{{ asset('images/avatar/young-kid.png') }}" class="w-100 z-99">
                                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                        <div class="col-11 col-md-4 text-center">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile hide-tablet">
                                                <div class="col-11 col-md-4 text-center">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 show-mobile bg-btn_bar">
                                                <div class="py-4 px-2">
                                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                                        <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Back</a> -->
                                                        <!-- <a href="{{route('education.gap')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                                                        <!-- <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-12 position-relative first-order">
                                        <div class="row">
                                            <div class="col-12 d-flex mt-5 justify-content-center z-99">
                                                <div class="">
                                                    <div class="col-10 m-auto">
                                                        <div class="@error('education_other_savings') is-invalid @enderror">
                                                            <p class="f-34"><strong>I’ve been saving up for my child(ren)’s education.</strong></p>
                                                            <span class="me-5">
                                                                <input type="radio" class="needs-radio @error('education_saving_amount') checked-yes @enderror" id="yes" name="education_other_savings" value="yes" onclick="jQuery('.hide-content').css('display','block');jQuery('#education_saving_amount').attr('required',true);" required @error('education_saving_amount') checked @enderror>
                                                                <label for="yes" class="form-label">Yes</label>
                                                            </span>
                                                            <span>
                                                                <input type="radio" class="needs-radio" id="no" name="education_other_savings" value="no" onclick="jQuery('.hide-content').css('display','none');jQuery('#education_saving_amount').removeAttr('required',false);">
                                                                <label for="no" class="form-label">No</label>
                                                            </span>
                                                        </div>
                                                        @if ($errors->has('education_other_savings'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_other_savings') }}</div>
                                                        @endif
                                                        <p class="mt-5 hide-content @error('education_saving_amount') is-invalid @enderror">Current savings amount:
                                                            <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-30 money f-34 @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" required></span>
                                                            @if ($errors->has('education_saving_amount'))
                                                                <div class="invalid-feedback">{{ $errors->first('education_saving_amount') }}</div>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile hide-tablet">
                                                <div class="col-12">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </section>
                        @if ($errors->has('monthly_education_amount'))
                            <section class="row alert-support z-1 hide-mobile">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('monthly_education_amount') }}</div>
                                </div>
                            </section>
                            <section class="col-12 alert-support z-1 show-mobile fixed-bottom">
                                <div class="col-12 alert alert-danger d-flex align-items-center justify-content-center m-0 py-2 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('monthly_education_amount') }}</div>
                                </div>
                            </section>
                        @endif
                        <div class="col-12 hide-mobile">
                            <div class="row">
                                <div class="position-absolute bg-btn_bar bottom-0 needs-stand-bg {{ $errors->has('monthly_education_amount') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                        <section class="footer bg-white py-4 fixed-bottom footer-needs-default hide-mobile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('education.coverage.new')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
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
    document.addEventListener('DOMContentLoaded', function() {
        var education_saving = document.getElementById('education_saving_amount');
        var yesRadio = document.getElementById('yes');

        education_saving.addEventListener('blur', function() {
            validateNumberField(education_saving);
        });

        if (yesRadio.classList.contains('checked-yes')) {
            jQuery('.hide-content').css('display','block');
        }

        function validateNumberField(field) {

            var value = field.value.trim();

            if (value === '' || isNaN(value)) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            } else {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            }
        }
    });
</script>
@endsection