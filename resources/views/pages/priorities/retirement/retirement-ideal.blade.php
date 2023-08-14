{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Ideal</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataRetirement = session('passingArraysRetirement');
    $retirementIdeal = isset($arrayDataRetirement['retirementIdeal']) ? $arrayDataRetirement['retirementIdeal'] : '';
@endphp
<div id="retirement_ideal" class="vh-100 overflow-auto container-fluid">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-6">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-6">
                @include ('templates.nav.nav-sidebar-needs')
            </div>
        </div>
        @if ($errors->has('retirementIdeal'))
        <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block"
            id="retirementIdealErrorMsg">{{ $errors->first('retirementIdeal') }}</div>
        @endif
        <form class="form-horizontal p-0 needs-validation" id="retirementIdealForm" novalidate action="{{route('form.retirement.ideal')}}"  method="POST">
            @csrf
    
        <div class="col-12 text-dark px-0 my-4">
            <div class="my-4" style="padding-top:4.5rem;">
                <div class="row d-flex justify-content-center py-4 text-center align-items-center">
                    <h5 class="my-2">My ideal retirement involves:</h5>
                </div>
                <div class="container">
                    {{-- hidden by default on desktop using JS script js/coverage-carousel.js --}}
                    <div class="prev-arrow position-absolute top-50 start-0 translate-middle-y px-2">
                        <i class="bi bi-arrow-left-circle text-primary"></i>
                    </div>

                    {{-- hidden by default on desktop using JS script js/coverage-carousel.js --}}
                    <div class="next-arrow position-absolute top-50 end-0 translate-middle-y px-2">
                        <i class="bi bi-arrow-right-circle text-primary"></i>
                    </div>
                </div>
                <div class="container row d-flex m-auto btn-group row h-75" id="optionsForIdeal" data-carousel="true">
                    <div class="col-sm-3 col-lg-3 justify-content-start d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 1' ? 'selected-box-shadow' : '' }}" data-type="option 1"
                            id="button-option-1" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-1.svg') }}"
                                alt="option 1">
                            <h6 class="text-center py-2"> Visiting destinations
                                on my bucket list</h6>
                        </button>
                    </div>
                    <div class="col-lg-3 justify-content-start d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 2' ? 'selected-box-shadow' : '' }}" data-type="option 2"
                            id="button-option-2" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-2.svg') }}"
                                alt="option 2">
                            <h6 class="text-center py-2">Maintaining a
                                comfortable lifestyle</h6>
                        </button>
                    </div>
                    <div class="col-lg-3 justify-content-start d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 3' ? 'selected-box-shadow' : '' }}" data-type="option 3"
                            id="button-option-3" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-3.svg') }}"
                                alt="option 3">
                            <h6 class="text-center py-2">Retiring early with
                                secure finances</h6>
                        </button>
                    </div>
                    <div class="col-lg-3 justify-content-start pt-lg-3 pt-xl-5 d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 4' ? 'selected-box-shadow' : '' }}" data-type="option 4"
                            id="button-option-4" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-4.svg') }}"
                                alt="option 4">
                        </button>
                    </div>
                </div>
                <input type="hidden" name="retirementIdeal" id="retirementIdealInput"
                    value="{{$retirementIdeal}}">

            </div>
        </div>
                <section class="footer bg-white py-4 fixed-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-grid gap-2 d-md-block text-end">
                                <a href="{{route('retirement.coverage')}}"
                                    class="btn btn-primary text-uppercase me-md-2">Back</a>
                                <button type="submit" class="btn btn-primary text-uppercase">Next</button>

                            </div>
                        </div>
                    </div>
                </section>
            </form>
    </div>
</div>

    @endsection

    <script>
    function retireIdeal(button) {
    event.preventDefault();
    const optionType = button.getAttribute('data-type');
    console.log(optionType + ' clicked');
    const buttons = document.querySelectorAll('.retire-ideal-button');
    const retirementIdealErrorMsg = document.getElementById("retirementIdealErrorMsg");
    const retirementIdealInput = document.getElementById('retirementIdealInput');

    if (retirementIdealInput.value === optionType) {
        retirementIdealInput.value = '';
        buttons.forEach((btn) => {
            btn.classList.remove('selected-box-shadow');
            btn.classList.add('box-shadow');
        });
    } else {
        retirementIdealInput.value = optionType;
        buttons.forEach((btn) => {
            // Only add the class to the clicked button and remove from others
            if (btn.getAttribute('data-type') === optionType) {
                if (btn.classList.contains('selected-box-shadow')) {
                    btn.classList.remove('selected-box-shadow');
                } else {
                    // Remove class from all buttons before adding to the clicked button
                    buttons.forEach((otherBtn) => {
                        otherBtn.classList.remove('selected-box-shadow');
                    });
                    btn.classList.add('selected-box-shadow');
                    btn.classList.remove('box-shadow');
                    retirementIdealErrorMsg.classList.remove('d-block');
                }
            } else {
                btn.classList.remove('selected-box-shadow');
            }
        });
    }
}
    </script>