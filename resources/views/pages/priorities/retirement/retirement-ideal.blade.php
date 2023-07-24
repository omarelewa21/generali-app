{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Ideal</title>
@endsection

@section('content')

<div id="retirement_ideal" class="vh-100 overflow-auto container-fluid">

    <div class="container p-0">
        @include('templates.nav.nav-red-menu')
        @include ('templates.nav.nav-sidebar-needs')
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">
                    <section class="row d-flex justify-content-center py-2 text-center align-items-center">
                        <h5 class="my-2">My ideal retirement involves:</h5>
                    </section>
                    <section>
                        <div class="row my-5 ">
                        <div class="col-lg-3 justify-content-end d-flex flex-column align-items-center">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-1.svg') }}" class="img-fluid" style="max-width: 100%;" alt="spouse">
                            <h6 class="text-center mx-5 py-2"> Visiting destinations
                                on my bucket list</h6>
                        </div>
                        <div class="col-lg-3 justify-content-end d-flex flex-column align-items-center">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-2.svg') }}" class="img-fluid" style="max-width: 100%;" alt="spouse">
                            <h6 class="text-center mx-5 py-2">Maintaining a 
                                comfortable lifestyle</h6>
                        </div>
                        <div class="col-lg-3 justify-content-end d-flex flex-column align-items-center">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-3.svg') }}" class="img-fluid" style="max-width: 100%;" alt="spouse">
                            <h6 class="text-center mx-5 py-2">Retiring early with
                                secure finances</h6>
                        </div>
                        <div class="col-lg-3 justify-content-top pt-lg-3 pt-xl-5 d-flex flex-column align-items-center">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-4.svg') }}" class="img-fluid" style="max-width: 100%;" alt="spouse">
                        </div>
                        </div>
                    </section>
                    

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.home')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('retirement.age.to.retire') }}"
                                        class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </div>

    @endsection