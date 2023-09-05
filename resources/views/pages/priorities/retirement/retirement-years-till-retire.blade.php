{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Years till Retire</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataRetirement = session('passingArraysRetirement');
    $retirementAllocatedFunds = isset($arrayDataRetirement['retirementAllocatedFunds']) ? $arrayDataRetirement['retirementAllocatedFunds'] : '';
    $retirementAgeToRetire = isset($arrayDataRetirement['retirementAgeToRetire']) ? $arrayDataRetirement['retirementAgeToRetire'] : '';
    $retirementYearsTillRetire = isset($arrayDataRetirement['retirementYearsTillRetire']) ? $arrayDataRetirement['retirementYearsTillRetire'] : '';
    $formattedTotalRetirementValue = isset($arrayDataRetirement['formattedTotalRetirementValue']) ? $arrayDataRetirement['formattedTotalRetirementValue'] : 0;
@endphp
<div id="retirementYearsTillRetirePage" class="vh-100 overflow-auto container-fluid">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-lg-2">
                        <div
                            class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h3 id="TotalRetirementValueText" class="m-1 text-light text-center">RM {{
                            $formattedTotalRetirementValue}}</h3>
                        <p class="text-light text-center">Total Retirement Fund Needed</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                @include('templates.nav.nav-sidebar-needs')
            </div>
        </div>
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <form class="form-horizontal p-0 needs-validation" id="retirementYearsTillRetireForm" novalidate action="{{ route('form.retirement.years.till.retire') }}" method="POST">
                        @csrf
                                {{-- error message notifications --}}
        @if ($errors->has('retirementYearsTillRetire'))
        <div id="retirementYearsTillRetireErrorMessage"
            class="toast slide-in-from-bottom position-absolute pos-bottom-error w-100" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-animation="true" data-bs-autohide="false">
            <div class="alert alert-danger d-flex align-items-center mb-0 py-2">
                <div class="flex-grow-1 d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                        viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <span class="mx-2 fs-18">{{ $errors->first('retirementYearsTillRetire') }}</span>
                </div>
            </div>
        </div>
        @endif
        {{-- end of error message notifications --}}
                    <section>
                        <div class="row">
                        <div class="bg-needs-1 col-lg-6 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative avatar-years-till-retire" src="{{ asset('images/needs/retirement/years-to-retire-avatar.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 d-flex flex-column justify-content-center justify-content-sm-center justify-content-lg-center mx-0 mx-lg-auto order-0 order-lg-1">
                            <h5 class="needs-text">I plan to have</h5>
                            <div class="d-flex flex-wrap justify-content-center justify-content-lg-start"> 
                            <div class="input-group w-50">
                                <input type="text" name="retirementYearsTillRetire" value="{{$retirementYearsTillRetire}}" class="input-text form-control text-primary py-0 @error('retirementYearsTillRetire') is-invalid @enderror" id="retirementYearsTillRetire" placeholder=" " required> 
                                <h5 class="needs-text">golden years</h5>
                            </div>
                        </div>
                        <h5 class="needs-text">to enjoy my retirement.</h5>

                        </div>


                        </div>
                        <div class="d-flex needs-grey-bg-md justify-content-center bg-accent-bg-grey position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                            </div>
                        </div>
                    </section>
                    
                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('retirement.allocated.funds')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase">Next</button>
                                </div>
                            </div>
                        </div>
                    </section>
                    </form>
                </div>
            </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const retirementYearsTillRetire = document.getElementById("retirementYearsTillRetire");
            const retirementYearsTillRetireErrorMsg = document.getElementById("retirementYearsTillRetireErrorMsg");
            var inputField = document.getElementById("retirementYearsTillRetire");
            var TotalRetirementValueText = document.getElementById("TotalRetirementValueText");
            var retirementAgeToRetire = {{$retirementAgeToRetire}};
            var retirementAllocatedFunds = {{$retirementAllocatedFunds}};

            retirementYearsTillRetire.addEventListener("blur", function() {
                validateNumberField(retirementYearsTillRetire);
            });
        
            retirementYearsTillRetire.addEventListener("input", function() {
                // retirementYearsTillRetireErrorMsg.style.display = "none";
            });
        
            function validateNumberField(field) {
                const value = field.value.trim();
        
                if (value === "" || isNaN(value)) {
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
    if (inputValue == "") {
        TotalRetirementValueText.innerText = "RM 0";
        retirementYearsTillRetire.value = inputValue;
    }
    else {
        //change inputValue to comma separated value
    var retirementYearsTillRetire = inputValue;
    var inputValue = retirementAllocatedFunds * 12 * retirementYearsTillRetire;


    TotalRetirementValueText.innerText = parseFloat(inputValue).toLocaleString("en-MY", {
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
                <style>
              .was-validated .form-control:valid, .form-control.is-valid {
        background-image:none;
        border-color: #000000;
        padding-right:0;
    }
        .navbar {
        right:50%;
    }
    .was-validated .form-control:valid, .form-control.is-valid {
        background-image:none;
        border-color: #000000;
    }
    .was-validated .form-control:valid:focus, .form-control.is-valid:focus, .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
        border-color: #000000;
        box-shadow: none;
    }
    .form-control:focus {
        border-color: #000000;
        box-shadow: none;
    }
    <style>
              .was-validated .form-control:valid, .form-control.is-valid {
        background-image:none;
        border-color: #000000;
        padding-right:0;
    }
        .navbar {
        right:50%;
    }
    .was-validated .form-control:valid, .form-control.is-valid {
        background-image:none;
        border-color: #000000;
    }
    .was-validated .form-control:valid:focus, .form-control.is-valid:focus, .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
        border-color: #000000;
        box-shadow: none;
    }
    .form-control:focus {
        border-color: #000000;
        box-shadow: none;
    }
    .form-control {
    line-height: 1.2 !important;
}
@media only screen and (max-width: 767px) {

.navbar-default.transparent {
background: transparent !important;
}
.fixed-bottom {
    z-index: 10;
}
.navbar {
    right:0;
}
.avatar-years-till-retire {
    top:2%;
}
input#retirementYearsTillRetire {
    width: 50%;
    text-align: center; 
}
}
    </style>
    
    @endsection