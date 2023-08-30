{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Allocated Funds Aside</title>
@endsection

@section('content')
@php
// Retrieving values from the session
$arrayDataRetirement = session('passingArraysRetirement');
$retirementAllocatedFundsAside = isset($arrayDataRetirement['retirementAllocatedFundsAside']) ?
$arrayDataRetirement['retirementAllocatedFundsAside'] : '';
$retirementOtherSourceOfIncome = isset($arrayDataRetirement['retirementOtherSourceOfIncome']) ?
$arrayDataRetirement['retirementOtherSourceOfIncome'] : '';
$formattedTotalRetirementValue = isset($arrayDataRetirement['formattedTotalRetirementValue']) ?
$arrayDataRetirement['formattedTotalRetirementValue'] : 0;
@endphp
<div id="retirementAllocatedFundsAsidePage" class="vh-100 overflow-auto container-fluid">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-lg-2">
                        <div class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h3 id="TotalRetirementValue" class="m-1 text-light text-center">RM {{
                            $formattedTotalRetirementValue }}</h3>
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
                <form class="form-horizontal p-0 needs-validation" id="retirementAllocatedFundsAsideForm" novalidate
                    action="{{ route('form.retirement.allocated.funds.aside') }}" method="POST">
                    @csrf
                    {{-- error message notifications --}}
                    @if ($errors->has('retirementAllocatedFundsAside'))
                    <div id="retirementAllocatedFundsAsideErrorMessage"
                        class="toast slide-in-from-bottom position-absolute pos-bottom-error w-100" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-animation="true" data-bs-autohide="false">
                        <div class="alert alert-danger d-flex align-items-center mb-0 py-2">
                            <div class="flex-grow-1 d-flex justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2" viewBox="0 0 16 16"
                                    role="img" aria-label="Warning:" width="25">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span class="mx-2 fs-18">{{ $errors->first('retirementAllocatedFundsAside') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- end of error message notifications --}}
                    <section>
                        <div class="row">
                            <div
                                class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                                <img class="position-relative avatar-allocated-funds-aside"
                                    src="{{ asset('images/needs/retirement/allocated-funds-aside.svg') }}" alt="avatar">
                            </div>
                            <div
                                class="col-lg-5 my-auto d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center align-items-lg-start mx-4 mx-lg-5 order-0 order-lg-1">
                                <h5 class="needs-text">So far, I’ve put aside</h5>
                                <div class="input-group w-50">
                                    <span class="input-group-text text-primary fw-bold bg-transparent pe-0">RM</span>
                                    <input type="text" name="retirementAllocatedFundsAside"
                                        value="{{$retirementAllocatedFundsAside}}"
                                        class="form-control d-inline text-primary @error('retirementAllocatedFundsAside') is-invalid @enderror"
                                        id="retirementAllocatedFundsAside" placeholder=" " required>
                                </div>
                                <h5 class="needs-text">for my retirement.</h5>
                                <h5 class="needs-text">Other sources of income:</h5>
                                <div class="input-group w-50">
                                    <span class="input-group-text text-primary fw-bold bg-transparent pe-0">RM</span>
                                    <input type="text" name="retirementOtherSourceOfIncome"
                                        value="{{ $retirementOtherSourceOfIncome }}"
                                        class="form-control d-inline text-primary @error('retirementOtherSourceOfIncome') is-invalid @enderror"
                                        id="retirementOtherSourceOfIncome" placeholder=" " required>
                                </div>

                                @if ($errors->has('retirementOtherSourceOfIncome' ))
                                <div class="position-fixed mt-4 top-0 start-50 translate-middle w-100"
                                    style="z-index:1099">
                                    <div id="retirementOtherSourceOfIncomeErrorMsg"
                                        class="align-items-center alert alert-warning border-0 fade d-block"
                                        role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                                        <div class="d-flex justify-content-center">
                                            <i class="bi bi-exclamation-circle p-2"></i>
                                            <div class="p-2">
                                                {{ $errors->first('retirementOtherSourceOfIncome') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($errors->has('retirementallocatedfundsaside'))
                                <div class="position-fixed mt-4 top-0 start-50 translate-middle w-100"
                                    style="z-index:1099">
                                    <div id="retirementallocatedfundsasideErrorMsg"
                                        class="align-items-center alert alert-warning border-0 fade d-block"
                                        role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                                        <div class="d-flex justify-content-center">
                                            <i class="bi bi-exclamation-circle p-2"></i>
                                            <div class="p-2">
                                                {{ $errors->first('retirementallocatedfundsaside') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div
                            class="d-flex needs-grey-bg-md justify-content-center bg-accent-bg-grey position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.years.till.retire')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <button class="btn btn-primary text-uppercase" type="submit">Next</button>
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
    const retirementAllocatedFundsAside = document.getElementById("retirementAllocatedFundsAside");
    const retirementOtherSourceOfIncome = document.getElementById("retirementOtherSourceOfIncome");
    const retirementAllocatedFundsAsideErrorMsg = document.getElementById("retirementAllocatedFundsAsideErrorMsg");
    const retirementOtherSourceOfIncomeErrorMsg = document.getElementById("retirementOtherSourceOfIncomeErrorMsg");

    retirementAllocatedFundsAside.addEventListener("blur", function() {
        validateNumberField(retirementAllocatedFundsAside);
    });

    retirementAllocatedFundsAside.addEventListener("input", function() {
        retirementAllocatedFundsErrorMsg.style.display = "none";
    });

    retirementOtherSourceOfIncome.addEventListener("blur", function() {
        validateNumberField(retirementOtherSourceOfIncome);
    });

    retirementOtherSourceOfIncome.addEventListener("input", function() {
        retirementOtherSourceOfIncomeErrorMsg.style.display = "none";
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

// document.addEventListener("DOMContentLoaded", function() {
//                 function updateProgress(inputValue,inputValue2) {
//                     // console.log($('#TotalRetirementValue').text());
//                     var totalRetirementValueStr =  $('#TotalRetirementValue').text().replace('RM', '').replace(/,/g, '');
//                     var totalRetirementValue = inputValue + inputValue2 - parseFloat(totalRetirementValueStr); // Convert to decimal value
//                     var progressTotalRetirementValue = {{ Session::get('ProgressTotalRetirementValue',0) }};
        
//                     $('.retirement-progress-bar').css('width', progressTotalRetirementValue + '%');
//                     $('#TotalRetirementValue').text('RM' + totalRetirementValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));
        
//                 }
        
//                 $('#retirementAllocatedFundsAside').on('input', function () {
//                     var inputValue = $(this).val();
//                     updateProgress(inputValue);
//                 });
//                 $('#retirementOtherSourceOfIncome').on('input', function () {
//                     var inputValue2 = $(this).val();
//                     updateProgress(inputValue2);
//                 });
                
//             });
        // Show the toast and apply the animation
        function showToast() {
    retirementOtherSourceOfIncomeErrorMsg.classList.add('show');
    retirementAllocatedFundsAsideErrorMsg.classList.add('show');

    // Auto-hide the toast after a delay
    setTimeout(() => {
        retirementOtherSourceOfIncomeErrorMsg.classList.remove('show');
        retirementAllocatedFundsAsideErrorMsg.classList.remove('show');
    }, 2500);
    
}

    </script>
    @endsection