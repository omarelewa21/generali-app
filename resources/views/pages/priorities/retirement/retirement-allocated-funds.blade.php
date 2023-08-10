{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Allocated Funds</title>
@endsection

@section('content')

<div id="retirementAllocatedFundsPage" class="vh-100 overflow-auto container-fluid">

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
                        <h3 id="TotalRetirementValue" class="m-1 text-light text-center">{{
                            Session::get('TotalRetirementValue', 'RM0') }}</h3>
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
                    <form class="form-horizontal p-0 needs-validation" id="retirementAllocatedFundsForm" novalidate action="{{ route('form.retirement.allocated.funds') }}" method="POST">
                        @csrf
                    <section>
                        <div class="row">
                        <div class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative avatar-allocated-funds" src="{{ asset('images/needs/retirement/avatar-family.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 my-auto d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center align-items-lg-start mx-4 mx-lg-5 order-0 order-lg-1">
                            <h5 class="needs-text">It would be great to have</h5> 
                            <div class="d-flex">
                            <div class="input-group w-50">
                                <span class="input-group-text text-primary fw-bold bg-transparent pe-0">RM</span>
                                <input type="text" name="retirementAllocatedFunds" class="form-control text-primary @error('retirementAllocatedFunds') is-invalid @enderror" value="{{Session::get('retirementAllocatedFunds') }}" id="retirementAllocatedFunds" placeholder=" " required> 
                            </div>
                            <h5 class="needs-text">/ month to</h5>
                            </div>
                            <h5 class="needs-text ">support myself and my <br>loved ones when I retire.</h5>
                            @if ($errors->has('retirementAllocatedFunds'))
                            <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="retirementAllocatedFundsErrorMsg">{{ $errors->first('retirementAllocatedFunds') }}</div>
                            @endif
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
                                    <a href="{{route('retirement.age.to.retire')}}"
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
    
    const retirementAllocatedFunds = document.getElementById("retirementAllocatedFunds");
    const retirementAllocatedFundsErrorMsg = document.getElementById("retirementAllocatedFundsErrorMsg");

    retirementAllocatedFunds.addEventListener("blur", function() {
        validateNumberField(retirementAllocatedFunds);
    });

    retirementAllocatedFunds.addEventListener("input", function() {
        retirementAllocatedFundsErrorMsg.style.display = "none";
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
    function updateProgress(inputValue) {
                    // console.log($('#TotalRetirementValue').text());
                    var totalRetirementValueStr =  $('#TotalRetirementValue').text().replace('RM', '').replace(/,/g, '');
                    var totalRetirementValue = inputValue * parseFloat(totalRetirementValueStr); // Convert to decimal value
                    var progressTotalRetirementValue = {{ Session::get('ProgressTotalRetirementValue',0) }};
        
                    $('.retirement-progress-bar').css('width', progressTotalRetirementValue + '%');
                    $('#TotalRetirementValue').text('RM' + totalRetirementValue.toLocaleString('en-MY', { maximumFractionDigits: 2 }));
        
                }
        
                $('#retirementAllocatedFunds').on('input', function () {
                    var inputValue = $(this).val();
                    updateProgress(inputValue);
                });
});

</script>
    @endsection