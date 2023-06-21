<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

    <title>Welcome</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <!-- <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script> -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}

</head>

<body>
   {{-- <div class="container position-absolute" style="max-width: 1440px; max-height: 1024px;">  --}}
 {{-- <div class="position-absolute w-100 h-100" style="background: url('{{ asset('images/screens/home.jpeg') }}') no-repeat center center / cover; opacity: 0.3;"></div>  --}}

    <nav class="navbar navbar-default ms-5">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img class="main-logo" src="{{ asset('images/logo.png') }}" alt="Logo" style="margin-top:4.563rem;">
                </a>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="ms-5">
            <div class="row">
                <div class="col-6">
                    <h1 class="display-1 text-uppercase" style="margin-top:18.25rem;">Welcome!</h1>
                    <h2 class="display-3 text-uppercase">Your Future Awaits.</h2>
                    <p class="welcome" style="margin-top:1.938rem;">We’re glad you’re looking to secure your future with us.<br> Let’s begin by getting to know you
                        better.</p>
                    <a href="{{ url('/pdpa-disclosure') }}" class="btn btn-primary font-weight-light">START YOUR JOURNEY</a>

                </div>

                <div class="col-6">
                    <img class="bg-welcome position-absolute top-0 end-0 vh-100" src="{{ asset('images/welcome-page/bg-right.png') }}" alt="avatar">
                </div>
            {{-- </div>
            <div class="row">
                <div class="col-6">
                <img class="position-absolute top-100 end-20" src="{{ asset('images/welcome-page/background-left.png') }}" alt="avatar">
                </div>
            </div> --}}
        </div>
    </main>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> --}}

</body>

</html>