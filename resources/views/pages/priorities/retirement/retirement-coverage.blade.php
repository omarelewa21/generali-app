{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Coverage</title>
@endsection

@section('content')

<div id="retirement_coverage" class="vh-100 overflow-auto container-fluid">

    <div class="container p-0">
        @include('templates.nav.nav-red-menu')
        @include ('templates.nav.nav-sidebar-needs')
            <div class="col-12 text-dark px-0 retirement-coverage my-4">
                <div class="my-4">
                    <section class="row d-flex justify-content-center py-2 text-center align-items-center">
                        <h5 class="my-2">I'd like to provide coverage for my:</h5>
                    </section>
                    <section>
                        <div class="row position-relative" id="coverage-avatar">
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/self.svg') }}" class="img-fluid" style="max-width: 50%;" alt="self-character">
                                <h6 class="text-center py-2">Self</h6>
                            </div>
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/spouse.svg') }}" class="img-fluid" style="max-width: 45%;" alt="spouse">
                                <h6 class="text-center py-2">Spouse</h6>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/kid.svg') }}" class="img-fluid" style="max-width: 45%;" alt="kid">
                                <h6 class="text-center py-2">Child(ren)</h6>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/parent.svg') }}" class="img-fluid" style="max-width: 100%;" alt="parent">
                                <h6 class="text-center py-2">Parent</h6>
                            </div>
                        </div>
                        <div class="row bg-accent-bg-grey">
                            <div class="col-auto py-lg-5 py-xxl-4 mb-xxl-4 py-md-0">
                            </div>
                        </div>
                    </section>
                    

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.home')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('retirement.ideal') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </div>

    @endsection