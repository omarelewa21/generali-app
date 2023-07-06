<?php
 /**
 * Template Name: Avatar - Family Dependant Page
 */
?>

@extends('templates.master')

@section('title')
<title>Avatar - Family Dependant</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div class="container-fluid overflow-hidden">
    <div class="row">
        <div class="col-sm-7">
            <div class="bg-image-avatar vh-100 d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ asset('images/avatar/bg-background.png') }}');">

                <div class="row">
                    <div class="col-sm text-center mt-5 d-flex">
                        <div class="position-absolute parent-father">
                            <img src="{{ asset('images/avatar/parent-father.svg') }}" class="m-auto img-fluid avatar-svg" alt="...">
                        </div>
                        <div class="position-absolute parent-mother">
                            <img src="{{ asset('images/avatar/parent-mother.svg') }}" class="m-auto img-fluid avatar-svg" alt="...">
                        </div>
                        <div class="position-absolute spouse">
                            <img src="{{ asset('images/avatar/spouse.svg') }}" class="m-auto img-fluid avatar-svg" alt="...">
                        </div>
                        <div class="position-absolute male-avatar-character">
                            <img src="{{ asset('images/avatar/male-avatar.svg') }}" class="m-auto img-fluid avatar-svg" alt="...">
                        </div>
                        <div class="position-absolute children-boy">
                            <img src="{{ asset('images/avatar/children-boy.svg') }}" class="m-auto img-fluid avatar-svg" alt="...">
                        </div>
                        <div class="position-absolute children-girl">
                            <img src="{{ asset('images/avatar/children-girl.svg') }}" class="m-auto img-fluid avatar-svg" alt="...">
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="col-sm-5 bg-primary vh-100 overflow-auto ">
            <div class="row">
                <div class="col-sm">
                    <h4 class="display-4 text-white mx-4 my-2 font-normal">Great, now let’s get to know your family. </h4>
                    <p class="text-white display-6 m-4">Click to select your family details.</p>
                </div>
            </div>
            <div class="row text-center justify-content-center my-2" style="height: 283px">
                <button class="btn-avatar col-sm-5 bg-white shadow-none me-2 d-flex align-items-center justify-content-center fade-effect" >
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/spouse-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Spouse</h6>
                    </div>
                </button>
                <button class="col-sm-5 btn-avatar bg-white d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/children-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Child(ren)</h6>
                    </div>
                </button>
            </div>
            <div class="row text-center justify-content-center my-2" style="height: 283px">
                <button class="col-sm-5 btn-avatar bg-white me-2 d-flex align-items-center justify-content-center fade-effect" >
                    <div>                   
                        <img src="{{ asset('images/avatar/parents-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Parent(s)</h6>
                    </div>
                </button>
                <button class="col-sm-5 btn-avatar bg-white d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/siblings-icon.svg') }}" class="img-fluid" alt="...">
                        <h6 class="mt-4 avatar-text">Sibling(s)</h6>
                    </div>
                </button>
            </div>
            
            
            <div class="row" style="height: 89px">

            </div>
            <div class="row bg-accent-light-white py-4 align-items-end sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{route('avatar.marital.status')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{route('avatar.my.assets') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>

    </div>

</div>
    @endsection