@extends('templates.master')

@section('title')
<title>Welcome</title>
@endsection

@section('content')

@include('templates.nav.nav-red')

<div class="container-fluid p-0">
    <!-- <div class="container p-0"> -->
        <div class="row vh-100">
            <div class="col-md-6 px-5" style="margin:auto;color:#000;">
                <h1 class="text-uppercase">Welcome!</h1>
                <h2 class="text-uppercase">Your Future Awaits.</h2>
                <p class="welcome" style="margin:1.938rem 0;">We’re glad you’re looking to secure your future with us.<br>
                    Let’s begin by getting to know you
                    better.</p>
                <a href="{{ route('pdpa.disclosure') }}" class="btn btn-primary font-weight-light">START YOUR JOURNEY</a>

            </div>

            <div class="col-md-6 p-0">
                <img class="bg-welcome w-100 h-100" style="object-position: center; object-fit: cover;"
                    src="{{ asset('images/welcome-page/welcome-page-avatar.jpeg') }}" alt="avatar">
            </div>
            {{--
        </div>
        <div class="row">
            <div class="col-6">
                <img class="position-absolute top-100 end-20" src="{{ asset('images/welcome-page/background-left.png') }}"
                    alt="avatar">
            </div>
        </div> --}}
    <!-- </div> -->
</div>
@endsection