{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Protection - Monthly Support</title>
@endsection

@section('content')


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
                            <h3 id="TotalProtectionValue" class="m-1 text-light text-center">{{ Session::get('TotalProtectionValue', 'RM0') }}</h3>
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
                                    <input type="number" name="protectionFunds" id="protectionFunds" value="{{ Session::get('protectionFunds') }}" class="input-text form-control text-primary py-0 @error('protectionFunds') is-invalid @enderror" placeholder=" " required> 
                                </div>
                                @if ($errors->has('protectionFunds'))
                                <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="protectionFundsErrorMsg">{{ $errors->first('protectionFunds') }}</div>
                                @endif
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
        function updateProgress(inputValue) {
            var month = 12;
            var totalProtectionValue = inputValue * month;
            // var progressTotalProtectionValue = totalProtectionValue * 100;
            var progressTotalProtectionValue = {{ Session::get('ProgressTotalProtectionValue', 0) }};


            $('.retirement-progress-bar').css('width', progressTotalProtectionValue + '%');
            $('#TotalProtectionValue').text('RM' + totalProtectionValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));
        }
        var inputValue = $('#protectionFunds').val();
        if (inputValue !== "") {
            updateProgress(inputValue);
        } else {
            // updateProgress(0); // Or you can use any default value you want
        }
        $('#protectionFunds').on('input', function () {
            var inputValue = $(this).val();
            updateProgress(inputValue);
        });
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
