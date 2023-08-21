{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Protection - Monthly Support</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionFunds = isset($arrayDataProtection['protectionFunds']) ? $arrayDataProtection['protectionFunds'] : " ";
    $protectionSupportingYears = isset($arrayDataProtection['protectionSupportingYears']) ? $arrayDataProtection['protectionSupportingYears'] : 0;
    $formattedTotalProtectionValue = isset($arrayDataProtection['formattedTotalProtectionValue']) ? $arrayDataProtection['formattedTotalProtectionValue'] : 0;
    $TotalProtectionValue = isset($arrayDataProtection['TotalProtectionValue']) ? $arrayDataProtection['TotalProtectionValue'] : 0;
@endphp

<div id="Protection-monthly-support" class="vh-100 overflow-auto container-fluid">

    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0 mt-lg-0">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-lg-2">
                            <div
                                class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{ Session::get('ProgressTotalProtectionValue', 45) }}%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 id="TotalProtectionValueText" class="m-1 text-light text-center">RM {{ $formattedTotalProtectionValue }}</h3>

                            <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                    @include('templates.nav.nav-sidebar-needs')
                </div>
            </div>
        <form class="form-horizontal p-0 needs-validation" id="protectionAllocatedFundsForm" novalidate action="{{route('form.protection.monthly.support')}}" method="POST">
            @csrf           
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <section>
                        <div class="row">
                        <div class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative monthly-support-asset z-1" src="{{ asset('images/needs/protection/monthly-support-asset.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 d-flex flex-column justify-content-sm-center justify-content-lg-center mx-4 mx-lg-5 order-0 order-lg-1">
                            <h5 class="needs-text">If anything should</h5>
                            <h5 class="needs-text">happen to me, I'd like to</h5>
                            <h5 class="needs-text">support my family with</h5>
                            <div class="d-flex flex-wrap"> 
                                <div class="input-group w-50">
                                    <span id="RM" class="input-group-text text-primary fw-bold bg-transparent pe-0 py-0"><h5 class="needs-text m-0">RM</h5></span>
                                    <input type="text" name="protectionFunds" id="protectionFunds" value="{{$protectionFunds }}" class="input-text form-control text-primary py-0 @error('protectionFunds') is-invalid @enderror" placeholder=" " required>                                </div>
                                <h5 class="needs-text">/ month.</h5>    
                            </div>
                        </div>
                        <div class="d-flex needs-grey-bg-md justify-content-center position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                            </div>
                        </div>
                        </div>
                    </section>

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('protection.coverage')}}"
                                        class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                        <button type="submit" class="btn btn-primary text-uppercase flex-fill">Next</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>

</div>

    <div id="protectionFundsErrorMessage" class="d-flex justify-content-center align-items-end h-100">
        <div class="position-absolute mb-auto w-sm-100 posErrorMessage">
            @if ($errors->has('protectionFunds'))
            <div class="alert alert-danger d-flex position-absolute bottom-0 z-1 w-100 my-0 my-lg-3 py-5 py-lg-4 posErrorMessage"
                role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                    viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <p class="mx-2 my-0">{{ $errors->first('protectionFunds') }}</p>
            </div>
            @endif
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const protectionFunds = document.getElementById("protectionFunds");

    protectionFunds.addEventListener("blur", function() {
        validateNumberField(protectionFunds);
    });

    function validateNumberField(field) {
        const value = field.value.trim();

        if (value === "" || isNaN(value)) {
            field.classList.remove("is-valid");
            field.classList.add("is-invalid");
        } else {
            field.classList.add("is-valid");
            field.classList.remove("is-invalid");
            protectionFundsErrorMessage.classList.remove('d-flex');
            protectionFundsErrorMessage.classList.add('d-none');
        }
    }
      // Select the input field and the h3 element
  var inputField = document.getElementById("protectionFunds");
  var TotalProtectionValueText = document.getElementById("TotalProtectionValueText");

  // Listen for input changes on the input field
  inputField.addEventListener("input", function() {

    // Get the value from the input field
    var inputValue = inputField.value;
    if (inputValue == "") {
        inputValue = 0;
        TotalProtectionValueText.innerText = "RM " + inputValue;
        protectionFunds.value = inputValue;
    }
    else {
    TotalProtectionValueText.innerText = "RM " + inputValue;
    protectionFunds.value = inputValue;
    }
  });


});

</script>
<style>
    .was-validated .form-control:valid, .form-control.is-valid {
        background-image:none;
        border-color: #000000;
    }
    .was-validated .form-control:valid:focus, .form-control.is-valid:focus, .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
        border-color: #000000;
        box-shadow: none;
    }
@media only screen and (max-width: 767px) {

    .navbar-default.transparent {
    background: transparent !important;
  }
    .fixed-bottom {
        z-index: 10;
    }
}
@media only screen and (width:688px) and (height:1031px) and (orientation:portrait) {
    .monthly-support-asset {
    left: -5%;
    bottom: 17%;
    width: 32vh;
    }
}
@media only screen and (width:800px) and (height:1280px) and (orientation:portrait) {

.monthly-support-asset {
    left: 0;
    bottom: 0%;
    width: 40vh;
}
}
</style>

@endsection
