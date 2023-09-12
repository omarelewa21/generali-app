@extends('templates.master')

@section('title')
<title>Protection - Supporting Years</title>
@endsection

@section('content')
@php
// Retrieving values from the session
$arrayDataProtection = session('passingArraysProtection');
$protectionFunds = isset($arrayDataProtection['protectionFunds']) ? $arrayDataProtection['protectionFunds'] : " ";
$protectionSupportingYears = isset($arrayDataProtection['protectionSupportingYears']) ?
$arrayDataProtection['protectionSupportingYears'] : " ";
$formattedTotalProtectionValue = isset($arrayDataProtection['formattedTotalProtectionValue']) ?
$arrayDataProtection['formattedTotalProtectionValue'] : 0;
$TotalProtectionValue = isset($arrayDataProtection['TotalProtectionValue']) ?
$arrayDataProtection['TotalProtectionValue'] : 0;
$protectionPercentage = isset($arrayDataProtection['protectionPercentage']) ?
$arrayDataProtection['protectionPercentage'] : 0;


@endphp
<div id="protection-supporting-years">
    <div class="overflow-hidden d-flex flex-column container-fluid p-0">
        <section>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                    @include('templates.nav.nav-red-menu-needs')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0 mt-lg-0">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-md-2 px-lg-2">
                            <div
                                class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar"
                                    style="width:{{$protectionPercentage}}%;" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <h3 id="TotalProtectionValueText" class="m-1 text-light text-center">RM {{
                                $formattedTotalProtectionValue}}</h3>
                            <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                    @include('templates.nav.nav-sidebar-needs')
                </div>
            </div>
        </section>

        {{-- error message notifications --}}
        @if ($errors->has('protectionSupportingYears'))
        <div id="protectionSupportingYearsErrorMessageErrorMessage"
            class="toast slide-in-from-bottom position-absolute pos-bottom-error w-100 rounded-0" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-animation="true" data-bs-autohide="false">
            <div class="alert alert-danger d-flex align-items-center mb-0 py-2 rounded-0">
                <div class="flex-grow-1 d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                        viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <span class="mx-2 fs-18">{{ $errors->first('protectionSupportingYears') }}</span>
                </div>
            </div>
        </div>
        @endif
        {{-- end of error message notifications --}}
        
        <section>
            <div class="row flex-grow-1">
                <form class="form-horizontal p-0 m-0 m-lg-0 needs-validation" id="protectionSupportingYearsForm"
                    novalidate action="{{route('form.protection.supporting.years')}}" method="POST">
                    @csrf
                    <div class="col-12 ">
                        <div class="row overflow-y-auto overflow-x-hidden bg-needs-2 vh-100 justify-content-center">
                            <div
                                class="row d-flex flex-column flex-lg-row justify-content-start justify-content-md-center align-items-start align-items-md-start align-items-lg-center h-75">
                                <div class="col-12 col-lg-4 col-xl-4 d-flex justify-content-center justify-content-xl-end z-1">
                                    <h5 class="m-0 mt-4 needs-text">I will need</h5>
                                </div>
                                <div class="col-12 col-lg-4 col-xl-4">
                                    <div
                                        class="position-relative pt-0 pb-0 pt-lg-0 pb-lg-4 m-2 m-lg-4 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('images/needs/protection/Calendar.png') }}"
                                            class="calendar-protection">
                                        <div class="position-absolute center w-100 text-center px-5 px-lg-0">
                                            <input type="text" name="protectionSupportingYears"
                                                value="{{$protectionSupportingYears}}"
                                                class="form-control input-text d-inline-flex text-primary w-50 fs-64 text-center @error('protectionSupportingYears') is-invalid @enderror"
                                                id="protectionSupportingYears" required>
                                            <h5 class="needs-text">years</h5>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 col-xl-4 d-flex justify-content-center justify-content-xl-start">
                                    <h5 class="m-0 mt-4 needs-text">to achieve my goal.</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('protection.monthly.support')}}"
                                        class="btn btn-primary text-uppercase me-md-2 flex-fill">Back</a>
                                    <button type="submit" class="btn btn-primary text-uppercase flex-fill">Next</button>
                                </div>
                            </div>
                        </div>
            </div>
            </form>
    </div>
    </section>
</div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
    var inputField = document.getElementById("protectionSupportingYears");
    var TotalProtectionValueText = document.getElementById("TotalProtectionValueText");
    //get session array protection protectionFunds
    var protectionFunds = {{$protectionFunds}};
    // console.log(protectionFunds);

    inputField.addEventListener("blur", function() {
        validateNumberField(inputField);
    });
    function validateNumberField(field) {
        const numericValue = parseFloat(field.value); // Convert input value to a float

        if (isNaN(numericValue)) {
            field.classList.remove("is-valid");
            field.classList.add("is-invalid");
        } else {
            field.classList.add("is-valid");
            field.classList.remove("is-invalid");
        }
    }


  // Listen for input changes on the input field
  inputField.addEventListener("input", function() {

    // Get the value from the input field
    var inputValue = inputField.value;
    if (inputValue == "" || protectionFunds == "") {
        TotalProtectionValueText.innerText = "RM 0";
        protectionSupportingYears.value = inputValue;
    }
    else {
        //change inputValue to comma separated value
    var protectionSupportingYears = inputValue;
    var inputValue = protectionFunds * 12 * protectionSupportingYears;
    console.log(inputValue);
    TotalProtectionValueText.innerText = parseFloat(inputValue).toLocaleString("en-MY", {
                style: "currency",
                currency: "MYR",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
    }

    });
});

</script>

<style>
        .was-validated .form-control:valid,
    .form-control.is-valid {
        padding-right: calc(0.6em + 0.75rem);
        background-position: right;
        background-size: 3rem;

    }

    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        padding-right: calc(0.5em + 0.75rem);
        background-position: right;
        background-size: 3rem;
    }

    .form-control:focus {
        border-color: #000000;
        box-shadow: none;
    }

    .was-validated .form-control:valid,
    .form-control.is-valid {
        background-image: none;
        border-color: #000000;
    }

    .was-validated .form-control:valid:focus,
    .form-control.is-valid:focus,
    .was-validated .form-control:invalid:focus,
    .form-control.is-invalid:focus {
        border-color: #000000;
        box-shadow: none;
    }

    @media only screen and (max-width: 767px) {
    .was-validated .form-control:valid,
    .form-control.is-valid,
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        background-size: 1.5rem;

    }
}

</style>







@endsection