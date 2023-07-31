@extends('templates.master')

@section('title')
<title>Investment - Monthly Returns</title>

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
                                <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                            </div>
                            <h3 class="font-color-white text-center">RM500,000</h3>
                            <p class="font-color-white text-center">Total Investment Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div> 
            </section>
            <form class="form-horizontal p-0"action="{{route('investment.gap')}}" method="get" id="investment" name="investment">
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-12 show-mobile">
                                <div class="row d-flex justify-content-center align-items-center bg-primary">
                                    <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                        <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                                    </div>
                                    <h3 class="font-color-white text-center">RM500,000</h3>
                                    <p class="font-color-white text-center">Total Investment Fund Needed</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 hide bg-half second-order position-relative h-auto">
                                <div class="row">
                                    <div class="show-desktop">
                                        <img src="{{ asset('images/needs/investment/investment-expected-return-avatar.png') }}" class="m-auto z-99 mh-100 mw-100 position-absolute bottom-0 p-4">
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative hide-desktop">
                                        <img src="{{ asset('images/needs/investment/investment-expected-return-avatar.png') }}" class="m-auto z-99 mh-100 mw-100 p-4 position-relative d-flex">
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
                            <div class="col-xl-6 col-12 position-relative hide first-order">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-start">
                                        <div class="row">
                                            <div class="col-12 mt-4">
                                                <p class="f-34"><strong>Right now, I can invest</strong></p>
                                                <p class="f-34"><input type="number" name="fund_year" class="form-control d-inline-block w-50 money" placeholder="RM" id="fund_year" required><strong>/month</strong></p>
                                                <p class="f-34"><strong>for my expected returns.</strong></p>
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
                    <div class="bg-btn_bar py-4 px-2 bg-white">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('investment.annual.return')}}" class="btn btn-primary text-uppercase">Back</a>
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