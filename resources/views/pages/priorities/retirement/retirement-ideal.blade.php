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
<div id="retirement_ideal" class="vh-100">

    <div class="p-0 vh-100 container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-lg-6 col-md-12">
                @include ('templates.nav.nav-sidebar-needs')
            </div>
        </div>
        {{-- error message notifications --}}
        @if ($errors->has('retirementIdeal'))
        <div id="retirementIdealErrorMessage"
            class="toast slide-in-from-bottom position-absolute pos-bottom-error w-100" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-animation="true" data-bs-autohide="false">
            <div class="alert alert-danger d-flex align-items-center mb-0 py-2">
                <div class="flex-grow-1 d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 mx-2"
                        viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <span class="mx-2 fs-18">{{ $errors->first('retirementIdeal') }}</span>
                </div>
            </div>
        </div>
        @endif
        {{-- end of error message notifications --}}

        <form class="form-horizontal p-0 needs-validation" id="retirementIdealForm" novalidate action="{{route('form.retirement.ideal')}}"  method="POST">
            @csrf
    
        <div class="col-12 text-dark px-0 my-4">
            <div class="my-4 y-lg-4 p-4 p-md-5 p-lg-5">
                <div class="row d-flex justify-content-center py-4 py-md-5 py-xl-4 text-center align-items-center">
                    <h5 class="my-2">My ideal retirement involves:</h5>
                </div>
                <div class="container">
                            {{-- hidden by default on desktop using JS js/coverage-carousel.js --}}
                            <div class="prev-arrow position-absolute top-50 start-0 translate-middle-y px-4 px-md-5">
                                <i class="bi bi-arrow-left-circle text-primary"></i>
                            </div>

                            {{-- hidden by default on desktop using JS js/coverage-carousel.js --}}
                            <div class="next-arrow position-absolute top-50 end-0 translate-middle-y px-4 px-md-5">
                                <i class="bi bi-arrow-right-circle text-primary"></i>
                            </div>
                </div>
                <div class="row d-flex m-auto btn-group row retirement-ideal-avatar" id="optionsForIdeal" data-carousel="true">
                    <div class="col-sm-3 col-lg-3 justify-content-start justify-content-md-start d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 1' ? 'selected-box-shadow' : '' }}" data-type="option 1"
                            id="button-option-1" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-1.svg') }}"
                                alt="option 1">
                            <h6 class="text-center py-2 ideal-text"> Visiting destinations <br>
                                on my bucket list</h6>
                        </button>
                    </div>
                    <div class="col-lg-3 justify-content-center d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 2' ? 'selected-box-shadow' : '' }}" data-type="option 2"
                            id="button-option-2" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-2.svg') }}"
                                alt="option 2">
                            <h6 class="text-center py-2 ideal-text">Maintaining a<br>
                                comfortable lifestyle</h6>
                        </button>
                    </div>
                    <div class="col-lg-3 justify-content-center d-flex flex-column align-items-center">
                        <button class="btn border-0 bg-transparent box-shadow retire-ideal-button {{ $retirementIdeal === 'option 3' ? 'selected-box-shadow' : '' }}" data-type="option 3"
                            id="button-option-3" onclick="retireIdeal(this)">
                            <img class="p-4" src="{{ asset('images/needs/retirement/ideal-option-3.svg') }}"
                                alt="option 3">
                            <h6 class="text-center py-2 ideal-text">Retiring early with<br>
                                secure finances</h6>
                        </button>
                    </div>
                    <div class="col-lg-3 justify-content-center pt-lg-3 pt-xl-5 d-flex flex-column align-items-center">
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
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a href="{{route('retirement.coverage')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                <button type="submit" class="btn btn-primary flex-fill text-uppercase">Next</button>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
    </div>
</div>


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

<style>
@media only screen and (max-width: 767px) {
    .progress-value p {
        color: inherit !important;
    }

    .fixed-bottom {
        z-index: 10;
    }

    .slick-track {
        height: 57vh;
    }

    .navbar-default.transparent {
        background: transparent !important;
    }
}

@media only screen and (width: 414px) and (height: 896px) {

    .slick-slide {
        height: 110%;
    }

}

@media only screen and (min-width:768px) and (max-height:1280px) and (orientation:portrait) {

.title-ideal {
    margin-top: 10vh !important;
}
    .slick-track {
        height: 63vh;
    }
    .bg-needs-main {
        background-position: center center;
        height: 110vh;
        width: 100%;
    }
    #optionsForIdeal img {
max-width: 360px;
}
}

@media only screen and (min-width:834px) and (max-height:1112px) and (orientation:portrait) {
    .slick-track {
        height: 69vh;
    }

}
@media only screen and (min-width:768px) and (max-height:1024px) and (orientation:portrait) {
    .slick-track {
        height: 67vh;
    }
}


</style>

@endsection

