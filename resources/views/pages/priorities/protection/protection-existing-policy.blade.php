@extends('templates.master')

@section('title')
<title>Protection - Existing Policy</title>

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionExistingPolicy = isset($arrayDataProtection['protectionExistingPolicy']) ? $arrayDataProtection['protectionExistingPolicy'] : '';
    $protectionPolicyAmount = isset($arrayDataProtection['protectionPolicyAmount']) ? $arrayDataProtection['protectionPolicyAmount'] : '';
    $formattedTotalProtectionValue = isset($arrayDataProtection['formattedTotalProtectionValue']) ? $arrayDataProtection['formattedTotalProtectionValue'] : 0;
@endphp
<div id="protection-existing-policy">
    <div class="container-fluid p-0 container-fluid overflow-hidden d-flex h-100 flex-column">
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
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 id="TotalProtectionValue" class="m-1 text-light text-center">RM {{
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
    <div id="protectionExistingPolicyErrorMessage" class="d-flex position-absolute w-100 justify-content-center align-items-end h-100">
        <div class="position-absolute mb-auto w-sm-100 posErrorMessage">
            @if ($errors->has('protectionExistingPolicy'))
            <div class="alert alert-danger d-flex position-absolute bottom-0 z-1 w-100 my-0 my-lg-3 py-4 py-lg-4 posErrorMessage"
                role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                    viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <p class="mx-2 my-0">{{ $errors->first('protectionExistingPolicy') }}</p>
            </div>
            @endif
        </div>
    </div>
            <form class="form-horizontal p-0 needs-validation" id="protectionExistingPolicyForm" action="{{route('form.protection.existing.policy')}}"  novalidate method="POST">
            @csrf
                <div class="col-12 text-dark px-0 my-4">
                    <div class="my-4">  
                        <section>
                            <div class="row">
                            <div class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-start justify-content-md-center justify-content-lg-center align-items-center order-1 order-lg-0">
                                <img class="position-relative protection-existing-policy-asset" src="{{ asset('images/needs/protection/protection-existing.png') }}" alt="avatar">
                            </div>
                            <div class="col-11 col-md-10 col-lg-5 d-flex flex-column justify-content-start justify-content-md-start justify-content-lg-start mx-auto mx-md-auto mx-lg-5 order-0 order-lg-1">
                                    <h5 class="needs-text my-0 my-md-5">Luckily, I do have an existing life insurance policy.</h5>
                                    <div class="py-3 py-md-2 py-lg-1 mb-4 mb-md-0 mb-lg-0">

                                    <span class="me-3 me-md-5 me-lg-5">
                                        <input type="radio" class="needs-radio" id="protection_yes" name="protectionExistingPolicy" value="yes" {{$protectionExistingPolicy === 'yes' ? 'checked' : ''}} required>
                                        <label for="protection_yes" class="form-label">Yes</label>
                                    </span>
                                    <span>
                                        <input type="radio" class="needs-radio" id="protection_no" name="protectionExistingPolicy" value="no" {{$protectionExistingPolicy === 'no' ? 'checked' : ''}} required>
                                        <label for="protection_no" class="form-label">No</label>
                                    </span>

                                </div>
                                <div id="existingPolicyAmount" style="display:none">
                                    <div class="input-group w-75 pb-4 pb-lg-0">
                                        <p class="d-flex flex-column justify-content-end pe-2 mb-0 w-sm-100">Existing policy amount: </p>
                                        <span class="input-group-text text-primary fw-bold bg-transparent pe-0"><h5 class="needs-text m-0">RM</h5></span>
                                    <input type="text" name="protectionPolicyAmount" value="{{ $protectionPolicyAmount }}" class="input-text form-control text-primary @error('protectionPolicyAmount') is-invalid @enderror" id="protectionPolicyAmount" placeholder=" " required>                                
                                    </div>
                                    {{-- @error('protectionPolicyAmount')
                                    <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="protectionPolicyAmountErrorMsg">{{ $message }}</div>
                                    @enderror --}}
                            </div>
                                </div>

                            </div>
    
                            <div class="d-flex needs-grey-bg-md justify-content-center position-absolute w-100 bottom-0">
                                <div class="col-11 col-md-4 text-center">
                                </div>
                            </div>
                        </section>
    
                        <section class="footer bg-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.supporting.years')}}"
                                            class="btn btn-primary text-uppercase me-md-2 flex-fill">Back</a>
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

<script>

document.addEventListener("DOMContentLoaded", function() {
    const protectionPolicyAmount = document.getElementById("protectionPolicyAmount");
    const protectionYes = document.getElementById('protection_yes');

    if (protectionYes.checked) {
            existingPolicyAmount.style.display = 'block';
        } else {
            existingPolicyAmount.style.display = 'none';
        }
        
    protectionPolicyAmount.addEventListener('blur', function() {
        validateNumberField(protectionPolicyAmount);
    });

    protectionPolicyAmount.addEventListener('input', function() {
        protectionExistingPolicyErrorMsg.style.display = "none";
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
    const protectionYes = document.getElementById('protection_yes');
    const protectionNo = document.getElementById('protection_no');
    const existingPolicyAmount = document.getElementById('existingPolicyAmount');

    protectionYes.addEventListener('change', toggleExistingPolicy);
    protectionNo.addEventListener('change', toggleExistingPolicy);

    function toggleExistingPolicy() {
        if (protectionYes.checked) {
            existingPolicyAmount.style.display = 'block';
        } else {
            existingPolicyAmount.style.display = 'none';
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        function updateProgress(inputValue) {
            var totalProtectionValueStr =  $('#TotalProtectionValue').text().replace('RM', '').replace(/,/g, '');
            var totalProtectionValue = (parseFloat(totalProtectionValueStr));
            var progressTotalProtectionValue = {{ Session::get('ProgressTotalProtectionValue', 0) }};


            $('.retirement-progress-bar').css('width', progressTotalProtectionValue + '%');
            $('#TotalProtectionValue').text('RM ' + totalProtectionValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));
        }
        // var inputValue = $('#protectionPolicyAmount').val();
        // if (inputValue !== "") {
        //     updateProgress(inputValue);
        // } else {
        //     // updateProgress(0); // Or you can use any default value you want
        // }
        $('#protectionPolicyAmount').on('input', function () {
            var inputValue = $(this).val();
            updateProgress(inputValue);
        });
    });
        // Get the toast element
        const protectionExistingPolicyErrorMsg = document.getElementById('protectionExistingPolicyErrorMsg');


</script>

<style>
        .navbar {
        right:50%;
    }
    .was-validated .form-control:valid, .form-control.is-valid {
        background-image :none;
    }
@media only screen and (max-width: 767px) {
    .navbar {
        right:0;
    }
    .fixed-bottom {
        z-index: 1000;
    }
}
</style>
@endsection