@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education-home">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row needs-home-mobile">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner needs-mobile-nav">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-5 py-xxl-5 py-xl-5 py-lg-5 py-md-5 py-sm-3 py-3">
                    <h4 class="display-5 font-bold fw-bold">My Priorities</h4>
                </div>
            </div>
            <div class="col d-flex p-0 flex-column bg-investments-needs needs-mobile-content" id="needs-home">
                <hr class="py-2 m-0 bg-primary opacity-100 border-0 needs-home-line"/>
                <section class="needs-home-nav">
                    @include ('templates.nav.nav-sidebar-needs')
                </section>
                <section class="education-wrapper overflow-hidden position-relative needs-home-content needs-height">
                    <div class="col-12 h-100 needs-row overflow-auto">
                        <img src="{{ asset('images/needs/investment/investment-home.png') }}" class="position-relative m-auto avatar-height z-99">
                        <h5 class="d-flex justify-content-center text-center w-md-50 px-2 px-md-0 m-auto py-3 position-relative z-99">Now let's plan for your investments.</h5>
                    </div>
                    <div class="d-flex justify-content-center bg-needs_text pd-needs-home position-absolute w-100 bottom-0">
                        <div class="col-11 col-md-4 text-center">
                            
                        </div>
                    </div>
                </section>
                <section class="needs-home-footer footer bg-needs_text">
                    <div class="bg-btn_bar py-4 px-2 sticky-bottom">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('welcome')}}" class="btn btn-primary text-uppercase">Back</a>
                            <a href="{{route('investment.coverage')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection 