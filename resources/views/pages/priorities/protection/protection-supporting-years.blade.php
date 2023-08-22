@extends('templates.master')

@section('title')
<title>Protection - Supporting Years</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionFunds = isset($arrayDataProtection['protectionFunds']) ? $arrayDataProtection['protectionFunds'] : " ";
    $protectionSupportingYears = isset($arrayDataProtection['protectionSupportingYears']) ? $arrayDataProtection['protectionSupportingYears'] : '';
    $formattedTotalProtectionValue = isset($arrayDataProtection['formattedTotalProtectionValue']) ? $arrayDataProtection['formattedTotalProtectionValue'] : 0;
    $TotalProtectionValue = isset($arrayDataProtection['TotalProtectionValue']) ? $arrayDataProtection['TotalProtectionValue'] : 0;
    $protectionPercentage = isset($arrayDataProtection['protectionPercentage']) ? $arrayDataProtection['protectionPercentage'] : 0;


@endphp
<div id="protection-supporting-years">
    <div class="overflow-hidden d-flex flex-column">
        <section>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2 mt-3 mt-md-0 mt-lg-0">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-md-2 px-lg-2">
                            <div
                                class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{$protectionPercentage}}%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
        <div id="protectionSupportingYearsErrorMessage" class="d-flex justify-content-center align-items-end h-100">
            <div class="position-absolute mb-auto w-sm-100 posErrorMessage">
                @if ($errors->has('protectionSupportingYears'))
                <div class="alert alert-danger d-flex position-absolute bottom-0 z-1 w-100 my-0 my-lg-3 py-4 py-lg-4 posErrorMessage"
                    role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                        viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <p class="mx-2 my-0">{{ $errors->first('protectionSupportingYears') }}</p>
                </div>
                @endif
            </div>
        </div>
        <section>
            <div class="row flex-grow-1">
                <form class="form-horizontal p-0  m-0 m-md-4 m-lg-0 needs-validation" id="protectionSupportingYearsForm"
                    novalidate action="{{route('form.protection.supporting.years')}}" method="POST">
                    @csrf
                    <div class="col-12 ">
                        <div class="row overflow-y-auto overflow-x-hidden bg-needs-2 vh-100 justify-content-center">
                            <div
                                class="row d-flex flex-column flex-lg-row justify-content-start align-items-start align-items-md-start align-items-lg-center h-75">
                                <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-end z-1">
                                    <h5 class="m-0 mt-4 needs-text">I will need</h5>
                                </div>
                                <div class="col-12 col-lg-4">
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
                                
                                <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
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
//     document.addEventListener("DOMContentLoaded", function() {
//     const protectionSupportingYearsErrorMsg = document.getElementById("protectionSupportingYearsErrorMsg");
//     var protectionSupportingYears = document.getElementById('protectionSupportingYears');

//     protectionSupportingYears.addEventListener('blur', function() {
//             validateYearsNumberField(protectionSupportingYears);
//         });

// function validateYearsNumberField(field) {
//     var minAge = 1;
//     var maxAge = 100;

//     var value = parseInt(field.value);

//     if (!isNaN(value) && value >= minAge && value <= maxAge) {
//         field.classList.add('is-valid');
//         field.classList.remove('is-invalid');
//     } else {
//         field.classList.remove('is-valid');
//         field.classList.add('is-invalid');
//     }
// }
// });
document.addEventListener("DOMContentLoaded", function() {
    var inputField = document.getElementById("protectionSupportingYears");
    var TotalProtectionValueText = document.getElementById("TotalProtectionValueText");
    //get session array protection protectionFunds
    var protectionFunds = {{$protectionFunds}};
    console.log(protectionFunds);

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
.was-validated .form-control:valid, .form-control.is-valid {
    padding-right: calc(0.6em + 0.75rem);
    background-position: right;
    background-size: 3rem;

}
.was-validated .form-control:invalid, .form-control.is-invalid {
    padding-right: calc(0.5em + 0.75rem);
    background-position: right;
    background-size: 3rem;
}
.form-control:focus {
        border-color: #000000;
        box-shadow: none;
}
.was-validated .form-control:valid, .form-control.is-valid {
        background-image:none;
        border-color: #000000;
    }
    .was-validated .form-control:valid:focus, .form-control.is-valid:focus, .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
        border-color: #000000;
        box-shadow: none;
    }
    /* Apply the initial state for the toast */
    .protectionSupportingYearsErrorMsg {
        transform: translateY(-100%);
        opacity: 0;
        transition: transform 0.5s ease-out, opacity 0.5s ease-out;
    }

    /* Apply the animation when the "show" class is added */
    .protectionSupportingYearsErrorMsg.show {
        transform: translateY(0);
        opacity: 1;
    }
    .navbar {
        right:50%;
    }
@media only screen and (max-width: 767px) {

    .was-validated .form-control:valid, .form-control.is-valid, .was-validated .form-control:invalid, .form-control.is-invalid {
    background-size: 1.5rem;

}
.fixed-bottom {
    z-index: 1000;
}
.navbar {
        right:0;
    }
}
@media only screen and (min-width:1024px) and (max-width:1112px) and (orientation:landscape) {
    .calendar-protection {
        width: 100% !important;
    }
}
</style>


@endsection