@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default bg-education" style="max-height:100vh;">
        <div class="row">
            <section class="col-12 d-flex">
                <div class="col-2 col-md-3 col-lg-3 sticky-top">
                    @include('templates.nav.nav-needs-red')
                </div>
                <div class="col-10 col-md-9 col-lg-9">
                    <div class="row d-flex justify-content-end align-items-center pt-3">
                        <div class="col-3 col-xs-3 col-sm-2 col-md-2 col-xl-1">
                            <div class="row d-flex">
                                <p class="display-6 m-0">Education</p>
                            </div>
                        </div>
                        <div class="col-3 col-md-2 col-xl-1 py-2">
                            <div class="row d-flex">
                                <div class="progress blue m-auto">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <span class="progress-text">3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="col-12">
                    <div class="row overflow-auto">
                        
                    </div>
                </div>
            </section>
            <section class="footer bg-needs_text py-4 fixed-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('education.home')}}" class="btn btn-primary me-md-2 text-uppercase">Back</a>
                            <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase">Next</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection