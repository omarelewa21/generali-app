{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Age to Retire</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataRetirement = session('passingArraysRetirement');
    $retirementAgeToRetire = isset($arrayDataRetirement['retirementAgeToRetire']) ? $arrayDataRetirement['retirementAgeToRetire'] : '';
    $formattedTotalRetirementValue = isset($arrayDataRetirement['formattedTotalRetirementValue']) ? $arrayDataRetirement['formattedTotalRetirementValue'] : 0;
@endphp
<div id="retirementAgeToRetirePage" class="vh-100 overflow-auto container-fluid">

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
                    <form class="form-horizontal p-0 needs-validation" id="retirementAgeToRetireForm" novalidate action="{{ route('form.age.to.retire') }}" method="POST">
                        @csrf
                    <section>
                        <div class="row">
                        <div id="bg-ideal-age" class="col-lg-6 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative avatar-age-to-retire" src="{{ asset('images/needs/retirement/avatar-age-to-retire.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 my-auto d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center align-items-lg-start mx-4 mx-lg-5 order-0 order-lg-1">
                            <h5 class="needs-text">I’d like to retire </h5> 
                            <div class="d-flex flex-wrap"> 
                            <h5 class="needs-text">at the age of</h5>
                            <input type="text" name="retirementAgeToRetire" value="{{ $retirementAgeToRetire }}"            
class="w-25 form-control d-inline text-primary @error('retirementAgeToRetire') is-invalid @enderror" id="retirementAgeToRetireInput" placeholder=" ">
                            @if ($errors->has('retirementAgeToRetire'))
                            <div class="position-fixed mt-4 top-0 start-50 translate-middle w-100" style="z-index:1099">
                                <div id="retirementAgeToRetireErrorMsg" class="align-items-center alert alert-warning border-0 fade" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                                    <div class="d-flex justify-content-center">
                                        <i class="bi bi-exclamation-circle p-2"></i>
                                        <div class="p-2">
                                            {{ $errors->first('retirementAgeToRetire') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            </div>
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
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.ideal')}}"
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
    const retirementAgeToRetire = document.getElementById("retirementAgeToRetire");
    retirementAgeToRetire.addEventListener("blur", function() {
        validateNumberField(retirementAgeToRetire);
    });

    retirementAgeToRetire.addEventListener("input", function() {
        retirementAgeToRetireErrorMsg.style.display = "none";
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
            console.log($('#TotalRetirementValue').text());
            var totalRetirementValueStr =  $('#TotalRetirementValue').text().replace('RM', '').replace(/,/g, '');
            var totalRetirementValue = inputValue * parseFloat(totalRetirementValueStr); // Convert to decimal value
            var progressTotalRetirementValue = {{ Session::get('ProgressTotalRetirementValue',0) }};

            $('.retirement-progress-bar').css('width', progressTotalRetirementValue + '%');
            $('#TotalRetirementValue').text('RM' + totalRetirementValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));

        }

        $('#retirementAgeToRetire').on('input', function () {
            var inputValue = $(this).val();
            updateProgress(inputValue);
        });
        
    });
        // Get the toast element
        const retirementAgeToRetireErrorMsg = document.getElementById('retirementAgeToRetireErrorMsg');

// Show the toast and apply the animation
function showToast() {
    retirementAgeToRetireErrorMsg.classList.add('show');

    // Auto-hide the toast after a delay
    setTimeout(() => {
        retirementAgeToRetireErrorMsg.classList.remove('show');
    }, 2500);
}

// Trigger the toast animation on page load or when error condition is met
document.addEventListener('DOMContentLoaded', showToast);
</script>

    @endsection