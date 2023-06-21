<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

    <title>test ipad</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <!-- <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>
    /* @media screen and (min-width: 320px) and (max-width: 767px) and (orientation: portrait) {
  html {
    transform: rotate(-90deg);
    transform-origin: left top;
    width: 100vh;
    height: 100vw;
    overflow-x: hidden;
    position: absolute;
    top: 100%;
    left: 0;
  }
} */
@font-face {
    /* font-family: 'Helvetica Neue'; */
    font-family: "HelveticaNeue", "Helvetica Neue", Helvetica; 

    src: url('/public/fonts/HelveticaNeueBoldCondensed.eot');
    src: local('Helvetica Neue Condensed Bold'),
        url('/public/fonts/HelveticaNeueBoldCondensed.eot?#iefix') format('embedded-opentype'),
        url('/public/fonts/HelveticaNeueBoldCondensed.woff2') format('woff2'),
        url('/public/fonts/HelveticaNeueBoldCondensed.woff') format('woff'),
        url('/public/fonts/HelveticaNeueBoldCondensed.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}

h4.headline2 {
    font-size:40px;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: 'Helvetica Neue', sans-serif;
    font-weight: bold;
}
#right-side {
    background-color: #C21B17;
}
#left-side {
    background-color: #F8F8F8;
}

</style>
</head>

<body class>
    <main>
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                <div id=left-side class="col-12 col-sm-7 col-xl-7 px-sm-2 px-0 d-flex sticky-top">
                    <div
                        class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
                        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto">
                            <img class="main-logo" src="{{ asset('images/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                </div>
                <div id=right-side class="col d-flex flex-column h-sm-100">
                    <main class="row overflow-auto">
                        <div class="col pt-4 py-2">
                            <h4 class="headline2 text-white">Right, let’s get an idea of your finances and loan.</h4>
                            <p class="text-white" style="font-size:22px">What type of loans do you have? (font-size
                                22px)</p>
                            <p class="text-white" style="font-size:18px">Click to add your assets next to your avatar.
                                (font-size 18px)</p>
                            <div class="bg-white pt-4 p-4">
                                <div id=custom-radio class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" style="font-size:22px" for="flexRadioDefault1">
                                        No
                                    </label>
                                </div>
                                <div id=custom-radio2 class="form-check form-check-inline">
                                    <input class="form-check-input " type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" style="font-size:22px" for="flexRadioDefault2">
                                        Yes
                                    </label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox
                                        input</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox
                                        input</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled"
                                        disabled>
                                    <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch
                                        checkbox input</label>
                                </div>

                            </div>
                        </div>
                    </main>
                    <footer class="row bg-white py-4 mt-auto">
                        <div class="col d-flex justify-content-end">
                            <a href="{{url('/')}}" class="btn btn-danger">BACK</a>
                            <a href="{{ url('/basic-details') }}" class="btn btn-danger mx-2">NEXT</a>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>