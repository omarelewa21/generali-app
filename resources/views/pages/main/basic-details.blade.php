@extends('templates.master')

@section('title')
<title>Basic Details</title>

@section('content')

<div class="container-fluid overflow-hidden">
    <div class="row vh-100 overflow-auto">
        <div class="col-12 col-sm-3 col-xl-3 px-sm-2 px-0 bg-primary d-flex sticky-top">
            @include('templates.nav-white-menu')       
            <div class="nav-header text-white mx-4">
                <h4 class="display-5 font-bold fw-bold px-4 mt-4">Hello! Let's get to know you better.</h4>
            </div>
        </div>
        <div class="col d-flex flex-column h-sm-100">
            <main class="main-vh p-basic-details row overflow-auto bg-accent-bg-grey">
                <div class="col pt-4 py-2">
                    <h1 class="display-3 pt-4 text-uppercase">Do introduce yourself.</h1>
                    <div class="pt-4 row pr-4">
                        <div class="col-3">
                            <div class="my-3">
                                <label for="title" class="form-label">Title</label>
                                <select class="form-select" aria-label="Title">
                                    <option selected>Select</option>
                                    <option value="1">Mr</option>
                                    <option value="2">Madam</option>
                                    <option value="3">Miss</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="my-3">
                                <label for="firstName" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="firstNameInput" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="my-3">
                                <label for="lastName" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lastNameInput" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="my-3">
                                <label for="mobileNumber" class="form-label">Mobile Number:</label>
                                <input type="text" class="form-control" id="mobileNumber" placeholder="+60 00-000 000">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="my-3">
                                <label for=housePhoneNumber" class="form-label">House Phone Number:</label>
                                <input type="text" class="form-control" id="housePhoneNumber"
                                    placeholder="+60 00-000 000">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="my-3">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="text" class="form-control" id="email" placeholder="yourname@email.com">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div class="row bg-white py-4 sticky-bottom">
                <div class="col d-flex justify-content-end">
                    <a href="{{url('/pdpa-disclosure')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{ url('/avatar-welcome') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection