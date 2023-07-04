@extends('templates.master')

@section('title')
<title>Avatar Gender Selection</title>@endsection

@section('content')
@include('templates.nav.nav-red-menu')
<div class="container overflow-hidden">
    <div class="row">
        <div class="col-sm-7">
            <div class="bg-image-avatar vh-100 d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ asset('images/avatar/bg-background-avatar.png') }}');">
                <div class="row" style="margin-top:128px">
                    <div class="col-sm text-center">
                        <p class="display-6">Pick the skin colour that’s closest to yours.</p>
                    </div>
                </div>
                  <div class="row color-box-wrapper d-flex justify-content-center flex-column align-items-center justify-content-center">
                    <div class="col-2">
                      <div class="color-box" style="background-color: #F5DEB3;"></div>
                    </div>
                    <div class="col-2">
                      <div class="color-box" style="background-color: #F4A460;"></div>
                    </div>
                    <div class="col-2">
                      <div class="color-box" style="background-color: #D2B48C;"></div>
                    </div>
                    <div class="col-2">
                      <div class="color-box" style="background-color: #A0522D;"></div>
                    </div>
                    <div class="col-2">
                      <div class="color-box" style="background-color: #8B4513;"></div>
                    </div>
                    <div class="col-2">
                      <div class="color-box" style="background-color: #654321;"></div>
                </div>
                  </div>
                <div class="row">
                    <div class="col-sm-2 text-center">
                        <div class="m-4">
                        </div>
                    </div>
                    <div class="col-sm text-center">
                        <div class="m-4">
                            <img src="{{ asset('images/avatar/male-avatar.svg') }}" class="img-fluid" alt="...">
                        </div>
                    </div>
                    <div class="col-sm-2 text-center">
                        <div class="m-4">
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
                <a href="#" class="col-sm-5 bg-white mx-2 d-flex align-items-center justify-content-center fade-effect" >
                    <div class="m-4">                   
                        <img src="{{ asset('images/avatar/button-gender-male.png') }}" class="img-fluid" alt="...">
                    </div>
                </a>
                <a href="#" class="col-sm-5 bg-white mx-2 d-flex align-items-center justify-content-center fade-effect">
                    <div class="m-4">
                        <img src="{{ asset('images/avatar/button-gender-female.png') }}" class="img-fluid" alt="...">
                    </div>
                </a>
            </div>
            
            
            <div class="row" style="height: 89px">

            </div>
            <div class="row bg-accent-light-white py-4 align-items-end sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{route('avatar.welcome')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{ route('avatar.marital.status') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>

    </div>

</div>
    @endsection