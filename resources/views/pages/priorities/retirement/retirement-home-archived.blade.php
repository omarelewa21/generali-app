{{-- Retirement - Home --}}
@extends('templates.master')

@section('title')
<title>Retirement - Home</title>
@endsection

@section('content')

<div id="retirement_home" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3 bg-primary sidebanner">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-md-3 px-lg-3 px-xl-5 py-md-5 py-3">
                    <h2 class="display-5 font-bold fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-md-9 px-0 bg-needs-main vh-100 bg-retirement-home">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block" />

                <div class="needs-home">
                    <section class="content-needs">
                        <div class="needs-home-avatar col-12 text-center d-flex flex-column justify-content-start justify-content-md-center justify-content-lg-center align-items-center py-2 py-2 py-md-3 py-lg-5 py-xl-2 mt-4">
                            <img class="z-1 img-fluid" src="{{ asset('images/needs/retirement/retirement-character.svg') }}">
                            <h5 class="z-1 d-flex col-12 col-md-8 col-xl-5 col-xxl-5 py-3 py-md-3 py-lg-3 justify-content-center needs-grey-bg-mobile needs-text">Now let's talk about your plans for Retirement.</h5>
                        </div>

                        <div class="d-flex needs-grey-bg justify-content-center position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('protection.gap.archived')}}"
                                        class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                    <a href="{{route('retirement.coverage.archived') }}"
                                        class="btn btn-primary text-uppercase flex-fill">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection