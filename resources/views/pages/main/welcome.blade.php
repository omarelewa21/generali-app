@extends('templates.master')

@section('title')
<title>Welcome</title>
@endsection

@section('content')

@include('templates.nav.nav-red')

<main class="container-fluid">
<div class="ms-5 container">
    <div class="row">
        <div class="col-xxl-6">
            <h1 class="text-uppercase text-dark" style="margin-top:18.25rem;">Welcome!</h1>
            <h2 class="text-uppercase text-dark">Your Future Awaits.</h2>
            <p class="text-dark" style="margin-top:1.938rem;">We’re glad you’re looking to secure your future with us.<br>
                Let’s begin by getting to know you
                better.</p>
            <a href="{{ route('pdpa.disclosure') }}" class="btn btn-primary">START YOUR JOURNEY</a>

        </div>

        <div class="col-xxl-6">
            <img class="bg-welcome position-absolute top-0 end-0 vh-100"
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
</div>
</main>
@endsection