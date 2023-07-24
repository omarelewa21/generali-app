{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Age to Retire</title>
@endsection

@section('content')

<div id="retirement_age_to_retire" class="vh-100 overflow-auto container-fluid">

    <div class="container p-0">
        @include('templates.nav.nav-red-menu')
        @include ('templates.nav.nav-sidebar-needs')
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <section>
                        <div class="row">
                        <div id="bg-ideal-age" class="col-lg-6 justify-content-end d-flex flex-column align-items-center">
                            <img class="position-relative avatar-age-to-retire" src="{{ asset('images/needs/retirement/avatar-age-to-retire.svg') }}" class="img-fluid" style="max-width: 60%;" alt="spouse">
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