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
            <section class="needs-master-content">
            <div class="col-12">
                    <div class="row h-100 overflow-y-auto overflow-x-hidden">
                        <div class="col-xl-6 col-12 position-relative hide bg-education-supporting">
                           <div class="row">
                                <div class="col-4 d-flex align-items-center h-100">
                                    <div class="row d-flex h-100">
                                        <img src="{{ asset('images/avatar/son.png') }}" class="w-100" style="z-index:99;">
                                        <p class="text-center py-2" style="z-index:99;"><strong>RM231,682</strong></p>
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center h-100">
                                    <div class="row d-flex h-100">
                                        <img src="{{ asset('images/avatar/daughter.png') }}" class="w-100" style="z-index:99;">
                                        <p class="text-center py-2" style="z-index:99;"><strong>RM540,000</strong></p>
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center h-100">
                                    <div class="row h-100">
                                        <img src="{{ asset('images/avatar/young-kid.png') }}" class="w-100" style="z-index:99;">
                                        <p class="text-center py-2" style="z-index:99;"><strong>RM135,545</strong></p>
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
                        <div class="col-xl-6 col-12 position-relative hide">
                            <div class="row">
                                <div class="col-12 d-flex mt-5 justify-content-center">
                                    <div class="">
                                        <div class="col-10 mt-4">
                                            <div class="" style="height:fit-content;">
                                                <p style="font-size:34px;"><strong>1st Child:</strong>
                                                    <input type="number" name="fund_year" class="form-control d-inline-block w-25" id="fund_year" required>
                                                    <strong>year(s) old</strong>
                                                </p>
                                                <p style="font-size:34px;"><strong>2nd Child:</strong>
                                                    <input type="number" name="fund_year1" class="form-control d-inline-block w-25" id="fund_year1" required>
                                                    <strong>year(s) old</strong>
                                                </p>
                                                <p style="font-size:34px;"><strong>3rd Child:</strong>
                                                    <input type="number" name="fund_year2" class="form-control d-inline-block w-25" id="fund_year2" required>
                                                    <strong>year(s) old</strong>
                                                </p>
                                            </div>
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
                        <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                        <a href="{{route('education.other')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection