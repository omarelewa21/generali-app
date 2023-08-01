@extends('templates.master')

@section('title')
<title>Protection - Supporting Years</title>
@endsection

@section('content')
<div id="investment-supporting">
    <div class="container-fluid overflow-hidden font-color-default text-center">
        <div class="row bg-investment-supporting vh-100">
            <div class="row">
                <div class="col-3 col-md-3 col-lg-3">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-6 col-sm-12 bg-primary summary-progress-bar px-1">
                                <div class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                    <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
                                <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-lg-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>  
            </div>
            <form class="form-horizontal p-0" action="{{route('protection.existing.policy')}}" method="get" id="investment" name="investment">
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-4 d-flex d-flex justify-content-end">
                                        <h5 class="m-0 mt-4 needs-text">I will need</h5>
                                    </div>  
                                    <div class="col-4">
                                        <div class="position-relative py-4 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('images/needs/investment/Calendar.png') }}" class="calendar-protection">
                                            <div class="position-absolute center w-100">
                                                <input type="number" name="fund_year1" class="form-control d-inline-block w-25 f-64 text-center" id="fund_year1" required>
                                                <p class="f-34" class="mt-4"><strong>years</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex justify-content-start">
                                            <h5 class="m-0 mt-4 needs-text">to achieve my goal.</h5>
                                    </div>
                                </div>
                            <div class="col-12 show-mobile bg-btn_bar">
                                <div class="py-4 px-2">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <a href="{{route('investment.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                                        <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-white hide-mobile">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('protection.monthly.support')}}" class="btn btn-primary text-uppercase">Back</a>
                            <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

@endsection