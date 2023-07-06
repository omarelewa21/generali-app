@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div class="container-fluid">
    <div class="row min-height-100">
        <div class="col-lg-3 col-xl-2 col-md-3 col-12 bg-primary">
            @include('templates.nav.nav-needs')
        </div>
        <div class="col-lg-9 col-xl-10 col-md-9 col-12 font-color-default">
            <div class="row bg-needs d-flex justify-content-center align-items-end h-100">
                <div class="col-12 bg-primary" style="height:19px;margin-bottom:auto;"></div>
                <div class="col-12 text-center" style="margin-top:auto;">
                    <div class="row py-4 bg-needs_text d-flex justify-content-center">
                        <div class="col-4 d-flex py-4">
                            <h5 class="py-4">Let's figure out what you need for Protection.</h5>
                        </div>
                    </div>
                    <div class="row py-4 bg-btn_bar d-flex">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('welcome')}}" class="btn btn-primary text-uppercase">back</a>
                            <a href="{{route('welcome')}}" class="btn btn-primary text-uppercase mx-2">next</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection