{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Coverage</title>
@endsection

@section('content')

<div id="retirement_coverage" class="vh-100">


    <div class="p-0 vh-100 container-fluid">
        <div class="row">
            <div class="col-6">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-6">
                @include ('templates.nav.nav-sidebar-needs')            
            </div>
        </div>

            <div class="col-12 text-dark px-0 retirement-coverage my-4">
                <div class="my-4">
                    <div class="row d-flex justify-content-center py-2 text-center align-items-center">
                        <h5 class="my-2">I'd like to provide coverage for my:</h5>
                    </div>
                        <div class="container row position-absolute justify-content-end" id="coverage-avatar">
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/self.svg') }}" class="self-avatar" alt="self-character">
                                <h6 class="text-center py-2">Self</h6>
                            </div>
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/spouse.svg') }}" class="spouse-avatar" alt="spouse">
                                <h6 class="text-center py-2">Spouse</h6>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/kid.svg') }}" class="kid-avatar"  alt="kid">
                                <h6 class="text-center py-2">Child(ren)</h6>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <img src="{{ asset('images/needs/retirement/parent.svg') }}" class="parent-avatar" alt="parent">
                                <h6 class="text-center py-2">Parent</h6>
                            </div>
                        </div>
                        <div class="d-flex needs-grey-bg-md justify-content-center bg-accent-bg-grey position-absolute w-100 bottom-0">
                            <div class="col-12 col-md-4 text-center">
                            </div>
                        </div>
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