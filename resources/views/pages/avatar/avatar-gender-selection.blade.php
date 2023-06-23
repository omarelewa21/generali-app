@extends('templates.master')

@section('title')
<title>Avatar Gender Selection</title>@endsection

@section('content')
@include('templates.nav-red-menu')

<div class="container-fluid overflow-hidden">
    <div class="row">
        <div class="col-sm-7">
            <div class="bg-image vh-100 d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ asset('images/avatar/bg-background.png') }}');">
                <div class="row">
                    <div class="col-sm text-center">
                        <p class="display-6">Pick the skin colour that’s closest to yours.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm text-center">
                        <p class="display-6">Pick the skin colour that’s closest to yours.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm text-center">
                        <div class="m-4">
                            <img src="{{ asset('images/avatar/male-avatar.svg') }}" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-5 bg-primary vh-100 overflow-auto ">
            <div class="row">
                <div class="col-sm">
                    <h4 class="display-4 text-white m-4 font-normal">Nice to meet you, __</h4>
                    <p class="text-white display-6 m-4">Please click to select your gender.</p>
                </div>
            </div>
            <div class="row text-center justify-content-center" style="height: 579px">
                <a href="#" @click="toggleActive('male-column', 'female-column')" class="col-sm-5 bg-white mx-2 d-flex align-items-center justify-content-center fade-effect" >
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/button-gender-male.png') }}" class="img-fluid" alt="...">
                    </div>
                </a>
                <a href="#" @click="toggleActive('female-column', 'male-column')" class="col-sm-5 bg-white mx-2 d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/button-gender-female.png') }}" class="img-fluid" alt="...">
                    </div>
                </a>
            </div>
            
            
            <div class="row" style="height: 89px">

            </div>
            <div class="row bg-accent-light-white py-4 align-items-end sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{url('/pdpa-disclosure')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{ url('/avatar-welcome') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>

    </div>


    @endsection