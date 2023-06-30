@extends('templates.master')

@section('title')
    <title>Welcome</title>
@endsection

@section('content')

        @include('templates.nav.nav-red-menu')
                <div class="container overflow-hidden">
                    <div class="bg-image vh-100"
                        style="background-image: url('{{ asset('images/avatar/Welcome.png') }}');">
                        <div class="row d-flex text-center justify-content-center">
                            <div class="col-xxl-7 col-xl-9 col-md-9 pt-5">
                                <div class="px-5 pt-5 mt-5 ">
                                    <div class="px-2 py-2 ">
                                        <h1 class="display-3 headline1 text-uppercase text-dark">Now, shall we build your signature look?</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex text-center justify-content-center">
                            <div class="col justify-content-end">
                                <div class="px-2 py-2">
                                    <img src="{{ asset('images/avatar/male.png') }}"
                                        class="img-fluid male-avatar position-absolute" alt="...">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="px-2 my-2">
                                    <a href="{{ route('avatar.gender.selection') }}" class="btn btn-primary text-uppercase">Create</a>
                                </div>
                                <div class="px-2 py-2">
                                    <a href="{{ route('welcome') }}" class="btn but-skip btn-outline-primary text-uppercase">Skip</a>
                                </div>
                            </div>
                            <div class="col justify-content-end">
                                <div class="px-2 py-2">
                                    <img src="{{ asset('images/avatar/female.png') }}"
                                        class="img-fluid female-avatar position-absolute" alt="...">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

@endsection