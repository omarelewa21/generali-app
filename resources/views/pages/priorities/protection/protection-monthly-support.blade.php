{{-- Protection Coverage page --}}

@extends('templates.master')

@section('title')
<title>Protection - Monthly Support</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionFunds = isset($arrayDataProtection['protectionFunds']) ? $arrayDataProtection['protectionFunds'] : '';
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
                <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-lg-2">
                            <div
                                class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:{{ Session::get('ProgressTotalProtectionValue', 45) }}%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 id="TotalProtectionValue" class="m-1 text-light text-center">RM {{
                                $formattedTotalProtectionValue}}</h3>
                            {{-- <script>
                                console.log("Session Data:", {{ json_encode(Session::get('TotalProtectionValue')) }});
                            </script> --}}
                            <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                    @include('templates.nav.nav-sidebar-needs')
                </div>
            </div>
            @if ($errors->has('protectionFunds'))
            <div class="position-fixed top-0 end-0 m-2" style="z-index:1099">
                <div id="protectionFundsErrorMsg" class="toast align-items-center text-white bg-primary border-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body p-2">
                            {{ $errors->first('protectionFunds') }}
                        </div>
                        {{-- <button type="button" class="btn btn-primary me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> --}}
                    </div>
                </div>
            </div>
            @endif
        <form class="form-horizontal p-0 needs-validation" id="protectionAllocatedFundsForm" novalidate action="{{route('form.protection.monthly.support')}}" method="POST">
            @csrf           
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <section>
                        <div class="row">
                        <div class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative monthly-support-asset" src="{{ asset('images/needs/protection/monthly-support-asset.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 d-flex flex-column justify-content-sm-center justify-content-lg-center mx-4 mx-lg-5 order-0 order-lg-1">
                            <h5 class="needs-text">If anything should</h5>
                            <h5 class="needs-text">happen to me, I'd like to</h5>
                            <h5 class="needs-text">support my family with</h5>
                            <div class="d-flex flex-wrap"> 
                                <div class="input-group w-50">
                                    <span class="input-group-text text-primary fw-bold bg-transparent pe-0 py-0"><h5 class="needs-text m-0">RM</h5></span>
                                    <input type="number" name="protectionFunds" id="protectionFunds" value="{{ $protectionFunds }}" class="input-text form-control text-primary py-0 @error('protectionFunds') is-invalid @enderror" placeholder=" " required> 
                                </div>
                                {{-- @if ($errors->has('protectionFunds'))
                                <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="protectionFundsErrorMsg">{{ $errors->first('protectionFunds') }}</div>
                                @endif --}}
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
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('protection.coverage')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                        <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const protectionFunds = document.getElementById("protectionFunds");
    const protectionFundsErrorMsg = document.getElementById("protectionFundsErrorMsg");
    protectionFunds.addEventListener("blur", function() {
        validateNumberField(protectionFunds);
    });

    protectionFunds.addEventListener("input", function() {
        protectionFundsErrorMsg.style.display="none";
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
});
document.addEventListener("DOMContentLoaded", function() {
var TotalProtectionValue = {{$TotalProtectionValue}};
var protectionSupportingYears = {{$protectionSupportingYears}};

    function updateProgress(inputValue) {
        var month = 12;
        var protectionFunds = parseFloat($('#protectionFunds').val().replace(',', '')); // Parse and remove commas
        
        if (TotalProtectionValue !== 0 || TotalProtectionValue !== null) {
            TotalProtectionValue = inputValue * month * protectionSupportingYears;
            console.log(TotalProtectionValue);

        } else {
            TotalProtectionValue = inputValue * month;
        }
        
        // $('.retirement-progress-bar').css('width', progressTotalProtectionValue + '%');
        $('#TotalProtectionValue').text('RM ' + TotalProtectionValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));
    }
    
    $('#protectionFunds').on('input', function () {
        var inputValue = $(this).val().replace(',', ''); // Remove commas from input value
        if (inputValue !== "") {
            updateProgress(inputValue);
        } else {
            // updateProgress(0); // Or you can use any default value you want
        }
    });
    
    // Initial calculation when the page loads
    var initialValue = $('#protectionFunds').val().replace(',', '');
    if (initialValue !== "") {
        updateProgress(initialValue);
    } else {
        // updateProgress(0); // Or you can use any default value you want
    }
});

</script>
<style>
@media only screen and (max-width: 767px) {
    /* body,
    html {
      overflow-y: auto;
    } */
    body {
        min-height: 51.5rem;
    padding-top: 5.5rem;
    }
}
</style>


    @endsection
