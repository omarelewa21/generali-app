{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Protection - Monthly Support</title>
@endsection

@section('content')

@php
    $arrayData = session('passingArrays');
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
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
                            <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                    @include('templates.nav.nav-sidebar-needs')
                </div>
            </div>
            {{-- <div class="invalid-feedback text-center alert alert-danger position-absolute" id="avatar-validation-msg">
                Please enter amount for the fund
            </div> --}}
        <form class="form-horizontal p-0 needs-validation" id="protectionAllocatedFundsForm" novalidate action="{{route('form.protection.monthly.support')}}" method="POST">
            @csrf           
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <section>
                        <div class="row">
                        <div class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative monthly-support-asset" src="{{ asset('images/needs/protection/monthly-support-asset.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 my-auto d-flex flex-column justify-content-sm-center justify-content-lg-end mx-4 mx-lg-5 order-0 order-lg-1">
                            <h5 class="needs-text">If anything should</h5>
                            <h5 class="needs-text">happen to me, I'd like to</h5>
                            <h5 class="needs-text">support my family with</h5>
                            <div class="d-flex flex-wrap"> 
                                <input disabled readonly class="text-primary form-control fw-bold form-input-needs-xs pe-0 text-primary" value="RM">
                                <input type="number" name="protectionFunds" value="{{ old('protectionFunds') }}" class="form-control form-input-needs-md text-primary  @error('protectionFunds') is-invalid @enderror" id="protectionFunds" placeholder=" " required> 
                                <h5 class="needs-text">/ month.</h5>    
                                @if ($errors->has('protectionFunds'))
                                <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage" id="protectionFundsErrorMsg">{{ $errors->first('protectionFunds') }}</div>
                            @endif
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
    protectionFunds.addEventListener("blur", function() {
        validateNumberField(protectionFunds);
    });

    protectionFunds.addEventListener("input", function() {
        protectionFundsErrorMsg.style.display = "none";
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

    // const protectionFundsErrorMsg = document.getElementById("protectionFundsErrorMsg");

    // form.addEventListener("submit", function(event) {
    //     event.preventDefault();
    //     event.stopPropagation();
        
    //     validateNumberField(protectionFunds);

    //     if (form.checkValidity() === false) {
    //         form.classList.add("was-validated");
    //         protectionFundsErrorMsg.style.display = "block";
    //     } else {
    //         protectionFundsErrorMsg.style.display = "none";
    //         form.submit();
    //     }
    // });
</script>


    @endsection
