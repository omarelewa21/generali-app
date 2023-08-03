@extends('templates.master')

@section('title')
<title>Education - Other Savings</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education-others vh-100">
            <section class="col-12 d-flex needs-nav-mob">
                <div class="col-6 col-md-2 col-lg-2 col-xl-3">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-md-7 col-xl-6 hide-mobile">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 bg-primary container fund-nav-rad">
                            <div class="col-12 fund-progress mt-4 d-flex justify-content-enter align-items-center">
                                <div class="px-2 fund-progress-bar" style="width:45%;"></div>
                            </div>
                            <h3 class="font-color-white text-center">RM1,462,000</h3>
                            <p class="font-color-white text-center">Total Education Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div> 
            </section>
            <!-- <form class="form-horizontal"action="{{route('education.gap')}}" method="get" id="children_education" name="children_education"> -->
            <form novalidate action="{{route('form.submit.education.other')}}" method="POST" id="children_education">
                @csrf
                <section class="needs-master-content hide">
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
                                                <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Back</a>
                                                <!-- <a href="{{route('education.gap')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                                                <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 position-relative first-order">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-center">
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
                                                    <span class="currencyinput f-34">RM<input type="text" name="education_saving_amount" class="form-control d-inline-block w-25 money f-34 @error('education_saving_amount') is-invalid @enderror" id="education_saving_amount" required></span>
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
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar hide-mobile row">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Back</a>
                            <!-- <a href="{{route('education.gap')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                            <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                        </div>
                    </div>
                </section>
            </form>
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