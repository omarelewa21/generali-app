@extends('templates.master')

@section('title')
<title>Protection - Existing Policy</title>

@section('content')

<div id="protection-existing-policy">
    <div class="container-fluid p-0 container-fluid overflow-hidden d-flex h-100 flex-column">
        <section>
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-md-2 px-lg-2">
                        <div
                        class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                        <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h3 id="TotalProtectionValue" class="m-1 text-light text-center">{{
                        Session::get('TotalProtectionValue', 'RM0') }}</h3>
                    <p class="text-light text-center">Total Protection Fund Needed</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                @include('templates.nav.nav-sidebar-needs')
            </div>
        </div>
    </section>
            <form class="form-horizontal p-0 needs-validation" id="protectionExistingPolicyForm" action="{{route('form.protection.existing.policy')}}"  novalidate method="POST">
            @csrf
            @if ($errors->has('protectionExistingPolicy'))
            <div class="position-fixed top-0 end-0 m-2" style="z-index:1099">
                <div id="protectionExistingPolicyErrorMsg" class="toast align-items-center text-white bg-primary border-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body p-2">
                            {{ $errors->first('protectionExistingPolicy') }}
                        </div>
                        {{-- <button type="button" class="btn-close btn-close-white me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> --}}
                    </div>
                </div>
            </div>
            @endif
            {{-- @if ($errors->has('protectionExistingPolicy'))
            <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="protectionExistingPolicyErrorMsg">{{ $errors->first('protectionExistingPolicy') }}</div>
        @endif --}}
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
                                        {{-- <div> --}}

                                    <span class="me-3 me-md-5 me-lg-5">
                                        <input type="radio" class="needs-radio" id="protection_yes" name="protectionExistingPolicy" value="yes" {{Session::get('protectionExistingPolicy') === 'yes' ? 'checked' : ''}} required>
                                        <label for="protection_yes" class="form-label">Yes</label>
                                    </span>
                                    <span>
                                        <input type="radio" class="needs-radio" id="protection_no" name="protectionExistingPolicy" value="no" {{Session::get('protectionExistingPolicy') === 'no' ? 'checked' : ''}} required>
                                        <label for="protection_no" class="form-label">No</label>
                                    </span>

                                </div>
                                <div id="existingPolicyAmount" style="display:none">
                                    <div class="input-group w-75 pb-4 pb-lg-0">
                                        <p class="d-flex flex-column justify-content-end pe-2 mb-0 w-sm-100">Existing policy amount: </p>
                                        <span class="input-group-text text-primary fw-bold bg-transparent pe-0"><h5 class="needs-text m-0">RM</h5></span>
                                    <input type="number" name="protectionPolicyAmount" value="{{Session::get('protectionPolicyAmount')}}" class="input-text form-control text-primary @error('protectionPolicyAmount') is-invalid @enderror" id="protectionPolicyAmount" placeholder=" " required>                                
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
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <a href="{{route('protection.supporting.years')}}"
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
            $('#TotalProtectionValue').text('RM' + totalProtectionValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));
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

</script>

<style>
@media only screen and (max-width: 767px) {

    body {
    min-height: 51.5rem;
    padding-top: 5.5rem;
    }
}

</style>
@endsection