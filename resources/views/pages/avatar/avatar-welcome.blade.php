@extends('templates.master')

@section('title')
    <title>Welcome</title>
@endsection

@section('content')
        @include('templates.nav.nav-red-menu')
                <div class="container">
                    <div class="bg-image vh-100"
                        style="background-image: url('{{ asset('images/avatar/Welcome.png') }}');">
                        <div class="row d-flex text-center justify-content-center">
                            <div class="col-xxl-7 col-xl-9 col-md-9 pt-5">
                                <div class="px-5 pt-5 mt-5 ">
                                    <div class="px-2 py-2 ">
                                        <h1 class="display-3 headline1 text-uppercase">Now, shall we build your signature look?</h1>
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
                                    <a href="{{ url('/#') }}" class="btn btn-outline-primary text-uppercase">Skip</a>
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

@endsection