@extends('templates.master')

@section('title')
<title>My Assets</title>@endsection

@section('content')
@include('templates.nav.nav-red-menu')

<div class="container-fluid overflow-hidden">
    <div class="row">
        <div class="col-sm-7">
            <div class="bg-image-avatar vh-100 d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ asset('images/avatar/bg-background.png') }}');">

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
                    <h4 class="display-4 text-white m-4 font-normal">Right, let’s get an idea of your finances and loans.</h4>
                    <p class="text-white display-6 m-4">Click to add your assets next to your avatar.</p>
                </div>
            </div>
            <div class="row text-center justify-content-center my-2">
                <button class="col-sm-5 btn-avatar bg-white d-flex me-2 align-items-center justify-content-center fade-effect">
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/car-icon.png') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Car</h6>
                    </div>

                </button>
                <button class="col-sm-5 btn-avatar bg-white d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/motorcycle-icon.png') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Motorcycle</h6>
                    </div>
                </button>
            </div>
            <div class="row text-center justify-content-center my-2">
                <button class="col-sm-5 btn-avatar bg-white d-flex me-2 align-items-center justify-content-center fade-effect">
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/house-icon.png') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">House</h6>
                    </div>
                </button>
                <button class="col-sm-5 btn-avatar bg-white d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/bungalow-icon.png') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Bungalow</h6>
                    </div>
                </button>
            </div>
            <div class="row text-center justify-content-center my-2">
                <button class="col-sm-5 btn-avatar bg-white d-flex me-2 align-items-center justify-content-center fade-effect">
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/apartment-icon.png') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Apartment</h6>
                    </div>
                </button>
                <button class="col-sm-5 btn-avatar bg-white d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/others-icon.png') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Others</h6>
                    </div>
                </button>
            </div>           
            
            <div class="row" style="height: 89px">

            </div>
            <div class="row bg-accent-light-white py-4 align-items-end sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{route('avatar.family.dependant')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{route('protection.home') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>

    </div>

</div>
    @endsection