<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

    <title>Welcome</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <!-- <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script> -->
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    --}}

</head>

<body>
    <div class="container overflow-hidden">
        <div class="vh-100 overflow-auto">
            <div class="col-12 col-sm-3 col-xl-3 px-sm-2 px-0 d-flex sticky-top">
                <nav class="navbar">
                    <div class="container mx-4 mt-4">
                        <a href="#" class="navbar-brand">
                            <img class="white-logo" src="{{ asset('images/logo.png') }}" alt="Logo" width="100px;">
                        </a>
                        <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                            <img class="d-inline" src="{{ asset('images/menu-button.svg') }}" alt="Logo" width="60px;">
                        </a>
                    </div>
                </nav>
            </div>
            <main>

                <div class="container">
                    <div class="bg-image vh-100"
                        style="background-image: url('{{ asset('images/avatar/Welcome.png') }}');">
                        <div class="row d-flex text-center justify-content-center">
                            <div class="col-xxl-7 col-xl-9 col-md-9 pt-5">
                                <div class="px-5 pt-5 mt-5 ">
                                    <div class="px-2 py-2 ">
                                        <h1 class="display-3 headline1 text-uppercase">Now let's put a face to that
                                            name, shall we?</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex text-center justify-content-center">
                            <div class="col justify-content-end position-relative">
                                <div class="px-2 py-2">
                                    <img class="male-avatar position-absolute" src="{{ asset('images/avatar/male.png') }}"
                                        class="img-fluid" alt="...">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="px-2 py-2">
                                    <a href="{{ url('/avatar-gender-selection') }}" class="btn btn-primary text-uppercase">Create</a>
                                </div>
                                <div class="px-2 py-2">
                                    <a href="{{ url('/avatar-gender-selection') }}" class="btn btn-outline-primary text-uppercase">Skip</a>
                                </div>
                            </div>
                            <div class="col justify-content-end">
                                <div class="px-2 py-2">
                                    <img src="{{ asset('images/avatar/female.png') }}"
                                        class="img-fluid" alt="...">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </main>
</body>

</div>
</div>


</html>