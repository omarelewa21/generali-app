@extends('templates.master')

@section('title')
<title>Protection - Home</title>

@section('content')

<div class="container-fluid overflow-hidden">
    <div class="row vh-100 overflow-auto">
        <div class="col-12 col-sm-2 col-xl-2 px-sm-2 px-0 bg-primary d-flex sticky-top">
            @include('templates.nav.nav-white-menu')       
            <div class="nav-header text-white mx-4">
                <h4 class="display-5 font-bold fw-bold px-4 mt-4">My Priorities</h4>
            </div>
        </div>
        <div class="col d-flex p-0 flex-column h-sm-100">  
            <hr class="py-2 m-0 bg-primary opacity-100"/>       
            <main class="main-vh p-basic-details row overflow-auto bg-accent-bg-grey">
                <div class="float-text position-fixed">
                    <p class="display-6 d-flex justify-content-end text-dark">Protection</p>
                    <div class="progress blue">
                        <span class="progress-left">
                          <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">1</div>
                    </div>
                  </div>   

<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-6">

        </div>
</div>
            </main>
            <div class="row bg-white py-4 px-2 sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{route('pdpa.disclosure')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{route('avatar.welcome') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection