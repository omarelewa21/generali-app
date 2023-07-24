@extends('templates.master')

@section('title')
<title>Education - Other Savings</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education-others" style="max-height:100vh;height:100vh;">
            <section class="col-12 d-flex needs-master-nav">
                <div class="col-2 col-md-2 col-xl-3 sticky-top">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-md-7 col-xl-6 hide-mobile">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 bg-primary container" style="border-radius: 0px 0px 20px 20px;">
                            <div class="col-12 fund-progress mt-4 d-flex justify-content-enter align-items-center">
                                <div class="px-2 fund-progress-bar" style="width:45%;"></div>
                            </div>
                            <h3 class="font-color-white text-center">RM1,462,000</h3>
                            <p class="font-color-white text-center">Total Education Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-3 col-xl-3 hide">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>
            </section>
            <form class="form-horizontal" method="get" id="children_education" name="children_education">
                <section class="needs-master-content hide">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-xl-6 col-12 position-relative bg-education-others-section">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center h-100">
                                        <div class="row d-flex h-100">
                                            <img src="{{ asset('images/avatar/son.png') }}" class="w-100" style="z-index:99;">
                                            <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                <div class="col-11 col-md-4 text-center">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center h-100">
                                        <div class="row d-flex h-100">
                                            <img src="{{ asset('images/avatar/daughter.png') }}" class="w-100" style="z-index:99;">
                                            <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                <div class="col-11 col-md-4 text-center">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center h-100">
                                        <div class="row h-100">
                                            <img src="{{ asset('images/avatar/young-kid.png') }}" class="w-100" style="z-index:99;">
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
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 position-relative">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-center">
                                        <div class="">
                                            <div class="col-10 mt-4">
                                                <div class="" style="height:fit-content;">
                                                    <p style="font-size:34px;"><strong>I’ve been saving up for my child(ren)’s education.</strong></p>
                                                    <span class="me-5">
                                                        <input type="radio" id="education_yes" name="education_other_savings" value="Yes" onclick="jQuery('.hide-content').css('display','block');jQuery('#education_saving_amount').attr('required',true);" required>
                                                        <label for="education_yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" id="education_no" name="education_other_savings" value="No" onclick="jQuery('.hide-content').css('display','none');jQuery('#education_saving_amount').removeAttr('required',false);">
                                                        <label for="education_no" class="form-label">No</label>
                                                    </span>
                                                </div>
                                                <p class="mt-5 hide-content">Current savings amount:
                                                    <input type="text" name="education_saving_amount" class="form-control d-inline-block w-25" id="education_saving_amount">
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
                <section class="needs-master-footer footer bg-white">
                    <div class="bg-btn_bar py-4 px-2 bg-white">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            {{-- <a href="{{route('education.supporting.years')}}" class="btn btn-primary text-uppercase">Back</a>
                            <!-- <a href="{{route('education.gap')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                            <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button> --}}
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

@endsection