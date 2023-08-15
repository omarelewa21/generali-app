@extends('templates.master')

@section('title')
<title>Protection - Supporting Years</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionSupportingYears = isset($arrayDataProtection['protectionSupportingYears']) ? $arrayDataProtection['protectionSupportingYears'] : '';
    $formattedTotalProtectionValue = isset($arrayDataProtection['formattedTotalProtectionValue']) ? $arrayDataProtection['formattedTotalProtectionValue'] : 0;
@endphp
<div id="protection-supporting-years">
    <div class="container-fluid overflow-hidden d-flex h-100 flex-column">
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
        
        <section>
            <div class="row flex-grow-1">
                <form class="form-horizontal p-0  m-0 m-md-4 m-lg-0 needs-validation" id="protectionSupportingYearsForm"
                    novalidate action="{{route('form.protection.supporting.years')}}" method="POST">
                    @csrf
                    {{-- @if ($errors->has('protectionSupportingYears'))
                    <div class="position-fixed top-0 end-0 m-2" style="z-index:1099">
                        <div id="protectionSupportingYearsErrorMsg" class="toast align-items-center text-white bg-primary border-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                            <div class="d-flex">
                                <div class="toast-body p-2">
                                    {{ $errors->first('protectionSupportingYears') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif --}}
                    {{-- @if ($errors->has('protectionSupportingYears'))
                    <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block">
                        {{ $errors->first('protectionSupportingYears') }}</div>
                    @endif --}}
                    @if ($errors->has('protectionSupportingYears'))
<div class="position-fixed top-0 end-0 start-50 translate-middle mt-4 w-100" style="z-index: 1099">
    <div id="protectionSupportingYearsErrorMsg" class="align-items-center alert alert-warning border-0 fade" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex justify-content-center">
            <i class="bi bi-exclamation-circle p-2"></i>
            <div class="p-2">
                {{ $errors->first('protectionSupportingYears') }}
            </div>
            {{-- <button type="button" class="btn-close btn-close-white me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> --}}
        </div>
    </div>
</div>
@endif
                    <div class="col-12 ">
                        <div class="row overflow-y-auto overflow-x-hidden bg-needs-2 vh-100 justify-content-center">
                            <div
                                class="row d-flex flex-column flex-lg-row justify-content-start align-items-start align-items-md-start align-items-lg-center h-75">
                                <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-end z-1">
                                    <h5 class="m-0 mt-4 needs-text">I will need</h5>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div
                                        class="position-relative pt-4 pb-4 pt-lg-0 pb-lg-4 m-2 m-lg-4 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('images/needs/protection/Calendar.png') }}"
                                            class="calendar-protection">
                                        <div class="position-absolute center w-100 text-center px-5 px-lg-0">
                                            <input type="number" name="protectionSupportingYears"
                                                value="{{$protectionSupportingYears}}"
                                                class="form-control d-inline-flex text-primary w-50 fs-64 text-center @error('protectionSupportingYears') is-invalid @enderror"
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
// document.addEventListener("DOMContentLoaded", function() {
//         function updateProgress(inputValue) {
//             console.log($('#TotalProtectionValue').text());
//             var totalProtectionValueStr =  $('#TotalProtectionValue').text().replace('RM', '').replace(/,/g, '');
//             var totalProtectionValue = inputValue * parseFloat(totalProtectionValueStr); // Convert to decimal value
//             var progressTotalProtectionValue = {{ Session::get('ProgressTotalProtectionValue',0) }};

//             $('.retirement-progress-bar').css('width', progressTotalProtectionValue + '%');
//             $('#TotalProtectionValue').text('RM' + totalProtectionValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));

//         }
//         // var inputValue = $('#protectionSupportingYears').val();
//         // if (inputValue !== "") {
//         //     updateProgress(inputValue);
//         // } else {
//         //     // updateProgress(0); // Or you can use any default value you want
//         // }

//         $('#protectionSupportingYears').on('input', function () {
//             var inputValue = $(this).val();
//             updateProgress(inputValue);
//         });
        
//     });
    // Get the toast element
    const protectionSupportingYearsErrorMsg = document.getElementById('protectionSupportingYearsErrorMsg');

    // Show the toast and apply the animation
    function showToast() {
        protectionSupportingYearsErrorMsg.classList.add('show');

        // Auto-hide the toast after a delay
        setTimeout(() => {
            protectionSupportingYearsErrorMsg.classList.remove('show');
        }, 2500);
    }

    // Trigger the toast animation on page load or when error condition is met
    document.addEventListener('DOMContentLoaded', showToast);
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

</style>


@endsection