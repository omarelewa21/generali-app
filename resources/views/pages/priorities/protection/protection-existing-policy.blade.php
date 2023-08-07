@extends('templates.master')

@section('title')
<title>5.Protection - Existing Policy</title>

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
                        <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
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
            <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block">{{ $errors->first('protectionExistingPolicy') }}</div>
        @endif
                <div class="col-12 text-dark px-0 my-4">
                    <div class="my-4">  
                        <section>
                            <div class="row">
                            <div class="col-lg-6 bg-needs-1 d-flex flex-column justify-content-start justify-content-md-center justify-content-lg-end align-items-center order-1 order-lg-0">
                                <img class="position-relative protection-existing-policy-asset" src="{{ asset('images/needs/protection/protection-existing.png') }}" alt="avatar">
                            </div>
                            <div class="col-11 col-md-10 col-lg-5 d-flex flex-column justify-content-center justify-content-md-center justify-content-lg-end my-auto mx-auto mx-md-auto mx-lg-5 order-0 order-lg-1">
                                    <h5 class="needs-text mt-0 mt-md-5">Luckily, I do have an existing life insurance policy.</h5>
                                    <div class="py-3 py-md-4 py-lg-5 mb-4 mb-md-0 mb-lg-0">
                                    <span class="me-3 me-md-5 me-lg-5">
                                        <input type="radio" class="needs-radio" id="protection_yes" name="protectionExistingPolicy" value="yes" required>
                                        <label for="protection_yes" class="form-label">Yes</label>
                                    </span>
                                    <span>
                                        <input type="radio" class="needs-radio" id="protection_no" name="protectionExistingPolicy" value="no" required>
                                        <label for="protection_no" class="form-label">No</label>
                                    </span>

                                </div>
                                {{-- <p class="mt-5 hide-content">Existing policy amount:
                                    <input disabled readonly class="text-primary form-control fw-bold form-input-needs-xs px-0 d-inline text-primary" value="RM">
                                    <input type="text" name="protection-policy-amount" class="form-control form-input-needs-md neg-left d-inline text-primary" id="protection-policy-amount" placeholder=" " required> 
        
                                </p> --}}
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
    const protectionExistingPolicy = document.getElementById("protectionExistingPolicy");
    protectionExistingPolicy.addEventListener("blur", function() {
        validateNumberField(protectionExistingPolicy);
    });

    protectionExistingPolicy.addEventListener("input", function() {
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

</script>
@endsection