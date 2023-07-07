@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-y-scroll vh-100">
        <div class="row bg-education">
            <div class="col-lg-3 col-xl-2 col-md-3 col-12 needs-nav">
                @include('templates.nav.nav-needs-red')
            </div>
            <div class="col-12 font-color-default">
                <section class="row h-100">  
                    <div style="height: fit-content;">
                        <div class="row d-flex justify-content-center py-2 text-center">
                            <div class="col-12">
                                <h5>I'd like to provide coverage for my:</h5>
                            </div>
                        </div>
                    </div>
                    <div style="height: fit-content;">
                        <div class="row d-flex justify-content-center py-2 text-center">
                            <div class="col-12">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 col-md-3">
                                        <div class="row d-flex m-auto">
                                            <img src="{{ asset('images/avatar/button-gender-male.png') }}">
                                            <p class="py-2"><strong>Self</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="row d-flex m-auto">
                                            <img src="{{ asset('images/avatar/daughter.png') }}">
                                            <p class="py-2"><strong>Child</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer height-mobile" style="height: fit-content;">
                        <div class="row py-4 bg-btn_bar d-flex">
                            <div class="d-flex justify-content-end">
                                <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">back</a>
                                <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase mx-2">next</a>
                            </div>
                        </div>
                    </div>
                </section>  
            </div>
        </div>
    </div>
</div>

@endsection