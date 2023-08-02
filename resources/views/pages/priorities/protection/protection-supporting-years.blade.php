@extends('templates.master')

@section('title')
<title>Protection - Supporting Years</title>
@endsection

@section('content')
<div id="protection-supporting-years">
    <div class="container-fluid overflow-hidden">
        <div class="row vh-100">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-1">
                            <div class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
                            <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                    @include('templates.nav.nav-sidebar-needs')
                </div>
            </div>
            <form class="form-horizontal p-0" action="{{route('protection.existing.policy')}}" method="get">
                <section>
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden bg-needs-2">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-4 d-flex d-flex justify-content-end">
                                        <h5 class="m-0 mt-4 needs-text">I will need</h5>
                                    </div>  
                                    <div class="col-4">
                                        <div class="position-relative py-4 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('images/needs/investment/Calendar.png') }}" class="calendar-protection">
                                            <div class="position-absolute center w-100 text-center">
                                                <input type="number" name="fund_year1" class="form-control d-inline-block text-primary w-25 f-64 text-center" id="fund_year1">
                                                <h5 class="needs-text">years</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex justify-content-start">
                                            <h5 class="m-0 mt-4 needs-text">to achieve my goal.</h5>
                                    </div>
                                </div>
                        </div>
                    </div>
                </section>
    
                <section class="footer bg-white py-4 fixed-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-grid gap-2 d-md-block text-end">
                                <a href="{{route('protection.monthly.support')}}"
                                    class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

@endsection