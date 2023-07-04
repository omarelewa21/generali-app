@extends('templates.master')

@section('title')
<title>Welcome</title>
@endsection

@section('content')

@include('templates.nav.nav-red')

<section id="home">
    <div class="container px-5">
        <div class="row">
            <div class="col-xxl-6">
                <h1 class="text-uppercase text-dark">Welcome!</h1>
                <h2 class="text-uppercase text-dark">Your Future Awaits.</h2>
                <p class="text-dark py-4">We’re glad you’re looking to secure your future with us.<br>
                    Let’s begin by getting to know you
                    better.</p>
                <a href="{{ route('pdpa.disclosure') }}" class="btn btn-primary py-3">START YOUR JOURNEY</a>

            </div>

    </div>
</section>
@endsection