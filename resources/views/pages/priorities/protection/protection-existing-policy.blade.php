@extends('templates.master')

@section('title')
<title>Protection - Existing Policy</title>

@section('content')

<div id="investment-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-needs-desktop vh-100">
            <section class="col-12 d-flex needs-nav-mob">
                <div class="col-6 col-md-2 col-lg-2 col-xl-3">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-md-7 col-xl-6 hide-mobile">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 bg-primary container fund-nav-rad">
                            <div class="col-12 fund-progress mt-4 d-flex justify-content-enter align-items-center">
                                <div class="px-2 fund-progress-bar" style="width:25%;"></div>
                            </div>
                            <h3 class="font-color-white text-center">RM1,500,000</h3>
                            <p class="font-color-white text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div> 
            </section>
            <form class="form-horizontal p-0"action="{{route('protection.gap')}}" method="get" id="protection-existing-policy" name="protection-existing-policy">
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-12 show-mobile">
                                <div class="row d-flex justify-content-center align-items-center bg-primary">
                                    <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                    </div>
                                    <h3 class="font-color-white text-center">RM1,500,000</h3>
                                    <p class="font-color-white text-center">Total Protection Fund Needed</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 hide bg-half second-order position-relative">
                                <div class="row">
                                    <div class="show-desktop">
                                        <img src="{{ asset('images/needs/protection/protection-existing.png') }}" class="m-auto z-99 mh-100 mw-100 position-absolute center py-4">
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative hide-desktop">
                                        <img src="{{ asset('images/needs/protection/protection-existing.png') }}" class="m-auto z-99 mh-100 mw-100 py-4 position-relative d-flex justify-content-center">
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 show-mobile bg-btn_bar">
                                        <div class="py-4 px-2">
                                            <div class="col-12 d-grid gap-2 d-md-block text-end">
                                                <a href="{{route('investment.supporting')}}" class="btn btn-primary text-uppercase">Back</a>
                                                <!-- <a href="{{route('investment.expected.return')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                                                <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-12 position-relative first-order">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-center">
                                        <div class="">
                                            <div class="col-10 mt-4">
                                                <div class="">
                                                    <p class="f-34"><strong>Luckily, I do have an existing life insurance policy.</strong></p>
                                                    <span class="me-5">
                                                        <input type="radio" class="needs-radio" id="protection_yes" name="protection_existing_policy" value="Yes" onclick="jQuery('.hide-content').css('display','block');jQuery('#protection_policy_amount').attr('required',true);" required>
                                                        <label for="protection_yes" class="form-label">Yes</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" class="needs-radio" id="protection_no" name="protection_existing_policy" value="No" onclick="jQuery('.hide-content').css('display','none');jQuery('#protection_policy_amount').removeAttr('required',false);">
                                                        <label for="protection_no" class="form-label">No</label>
                                                    </span>
                                                </div>
                                                <p class="mt-5 hide-content">Existing policy amount:
                                                    <input type="text" name="protection_policy_amount" class="form-control d-inline-block w-25 money" id="protection_policy_amount" placeholder="RM">
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
                <section class="needs-master-footer footer bg-btn_bar">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('protection.supporting.years')}}" class="btn btn-primary text-uppercase">Back</a>
                            <!-- <a href="{{route('investment.expected.return')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                            <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

@endsection