{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Allocated Funds</title>
@endsection

@section('content')

<div id="retirementAgeToRetire" class="vh-100 overflow-auto container-fluid">

    <div class="container p-0">
        <div class="row">
            <div class="col-3 col-md-3 col-lg-3">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-6 col-sm-12 bg-primary rounded-bottom px-1">
                        <!-- <div class="row d-flex"> -->
                            <div class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
                            <p class="text-light text-center">Total Retirement Fund Needed</p>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="col-3 col-md-3 col-lg-3">
                @include ('templates.nav.nav-sidebar-needs')
            </div>  
        </div>
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <section>
                        <div class="row">
                        <div id="bg-ideal-age" class="col-lg-6 justify-content-end d-flex flex-column align-items-center">
                            <img class="position-relative avatar-age-to-retire" src="{{ asset('images/needs/retirement/avatar-age-to-retire.svg') }}" class="img-fluid" style="max-width: 60%;" alt="avatar">
                        </div>
                        <div class="col-lg-6 my-auto">
                            <h6 class="d-inline py-2 ms-5">I’d like to retire at the age of</h6> 
                            <input type="text" name="ageToRetire" class="form-control form-input-needs-sm d-inline text-primary" id="ageToRetireInput" placeholder=" " required>
                        </div>
                        </div>
                        <div class="row bg-accent-bg-grey">
                            <div class="col-auto py-lg-5 py-xxl-5 mb-xxl-4 py-md-0">
                            </div>
                        </div>
                    </section>
                    

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.home')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('retirement.home') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </div>

    @endsection