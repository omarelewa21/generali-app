@extends('templates.master')

@section('title')
<title>Avatar Gender Selection</title>@endsection

@section('content')
@include('templates.nav.nav-red-menu')

<div class="container-fluid overflow-hidden">
    <div class="row">
        <div class="col-sm-7">
            <div class="bg-image vh-100 d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ asset('images/avatar/bg-background.png') }}');">

                <div class="row">
                    <div class="col-sm text-center">
                        <div class="m-4">
                            <img src="{{ asset('images/avatar/male-avatar.svg') }}" class="img-fluid img-avatar" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-5 bg-primary vh-100 overflow-auto ">
            <div class="row">
                <div class="col-sm">
                    <h4 class="display-4 text-white m-4 font-normal">May we know your relationship status?</h4>
                    <p class="text-white display-6 m-4">Click to select your marital status.</p>
                </div>
            </div>
            <div class="row text-center justify-content-center" style="height: 283px">
                <a href="#" class="col-sm-5 bg-white mx-2 d-flex align-items-center justify-content-center fade-effect" >
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/single-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Single</h6>
                    </div>

                </a>
                <a href="#" class="col-sm-5 bg-white mx-2 d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/married-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Married</h6>
                    </div>
                </a>
            </div>
            <div class="row text-center justify-content-center" style="height: 283px">
                <a href="#" class="col-sm-5 bg-white m-2 d-flex align-items-center justify-content-center fade-effect" >
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/divorced-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Divorced</h6>
                    </div>
                </a>
                <a href="#" class="col-sm-5 bg-white m-2 d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/widowed-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Widowed</h6>
                    </div>
                </a>
            </div>
            
            
            <div class="row" style="height: 89px">

            </div>
            <div class="row bg-accent-light-white py-4 align-items-end sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{url('/avatar-gender-selection')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{ url('/avatar-my-assets') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>

    </div>

</div>
    @endsection