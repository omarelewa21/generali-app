@extends('templates.master')

@section('title')
<title>Investment - Supporting Years</title>

@section('content')

<div id="investment-supporting">
    <div class="container-fluid overflow-hidden font-color-default text-center">
        <div class="row bg-investment-supporting vh-100">
            <section class="col-12 d-flex needs-nav-mob">
                <div class="col-2 col-md-2 col-xl-3 sticky-top">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-md-7 col-xl-6 hide-mobile">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 bg-primary container fund-nav-rad">
                            <div class="col-12 fund-progress mt-4 d-flex justify-content-enter align-items-center">
                                <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                            </div>
                            <h3 class="font-color-white">RM500,000</h3>
                            <p class="font-color-white">Total Investment Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-3 col-xl-3 hide">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>
            </section>
            <form class="form-horizontal p-0"action="{{route('investment.annual.return')}}" method="get" id="investment" name="investment">
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-12 show-mobile">
                                <div class="row d-flex justify-content-center align-items-center bg-primary">
                                    <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                        <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                                    </div>
                                    <h3 class="font-color-white">RM500,000</h3>
                                    <p class="font-color-white">Total Investment Fund Needed</p>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="d-flex justify-content-center align-items-end">
                                        <h5 class="m-0 mt-4">I expect to keep investing for the next:</h5>
                                    </div>
                                    <!-- <div class="col-12 position-relative mt-4 h-100 calender"> -->
                                        <div class="position-relative py-4 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('images/needs/investment/Calendar.png') }}" class="m-auto calendar">
                                            <div class="position-absolute center w-100">
                                                <input type="number" name="fund_year1" class="form-control d-inline-block w-25 f-64 text-center" id="fund_year1" required>
                                                <p class="f-34" class="mt-4"><strong>years</strong></p>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-12 show-mobile bg-btn_bar">
                                <div class="py-4 px-2">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <a href="{{route('investment.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                                        <!-- <a href="{{route('investment.annual.return')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                                        <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar hide-mobile">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('investment.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                            <!-- <a href="{{route('investment.annual.return')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                            <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

@endsection