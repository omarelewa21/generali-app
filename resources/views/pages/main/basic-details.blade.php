@extends('templates.master')

@section('title')
<title>Basic Details</title>

@section('content')

<div class="container-fluid p-0" style="color:#000;">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 bg-primary">
            <div class="d-flex">
                @include('templates.nav.nav-white')
            </div>
            <div class="d-flex text-white mx-5 mt-5">
                <h4 class="display-5 font-bold fw-bold">Hello! Let's get to know you better.</h4>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9 bg-white">
            <div class="d-flex mt-4">
                <h1 class="display-2 px-4 pt-4 text-uppercase">Do Introduce Yourself.</h1>
            </div>
            <div class="d-flex">
                <div class="col-11 overflow-auto vh-100 p-4">
                    <div class="row pt-5">
                        <div class="col-lg-3 col-12">
                            <label for="title" class="form-label">Title</label>
                            <select class="form-select" aria-label="Title">
                                <option selected>Select</option>
                                <option value="1">Mr</option>
                                <option value="2">Madam</option>
                                <option value="3">Miss</option>
                            </select>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-lg-6 col-12">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstNameInput" placeholder="First Name">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastNameInput" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-lg-6 col-12">
                            <label for="mobileNumber" class="form-label">Mobile Number:</label>
                            <input type="tel" class="form-control" id="mobileNumber" placeholder="+60 00-000 000">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="housePhoneNumber" class="form-label">House Phone Number:</label>
                            <input type="tel" class="form-control" id="housePhoneNumber" placeholder="+60 00-000 000">
                        </div>
                    </div>
                    <div class="row pt-5" style="padding-bottom:250px !important;">
                        <div class="col-lg-6 col-12">
                            <label for="email" class="form-label">Email Address:</label>
                            <input type="email" class="form-control" id="email" placeholder="yourname@email.com">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-accent-bg-grey py-4 position-fixed" style="width: -webkit-fill-available;z-index:9999; bottom:0;">
                <div class="container d-flex justify-content-end">
                    <a href="{{route('pdpa.disclosure')}}" class="btn btn-primary text-uppercase">Back</a>
                    <a href="{{route('basic.details') }}" class="btn btn-primary mx-2 text-uppercase">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* ===== Scrollbar CSS ===== */
  /* Firefox */
  * {
    scrollbar-width: auto;
    scrollbar-color: #ffffff;
  }

  /* Chrome, Edge, and Safari */
  *::-webkit-scrollbar {
    width: 7px;
	background-color: #F5F5F5;
  }

  *::-webkit-scrollbar-track {
    /* -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); */
	background-color: #A0A0A0;
    border-radius:0;
  }

  *::-webkit-scrollbar-thumb {
    background-color: #707070;
	/* border: 2px solid #707070; */
    border-radius:0;
  }
  .form-control{
    color:#000 !important;
  }
</style>
@endsection