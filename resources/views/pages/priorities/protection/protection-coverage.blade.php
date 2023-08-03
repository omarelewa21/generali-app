{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Protection - Coverage</title>
@endsection

@section('content')

<div id="protection_coverage" class="vh-100">

    <div class="p-0 vh-100 container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-lg-6 col-md-12">
                @include ('templates.nav.nav-sidebar-needs')
            </div>
        </div>
        <div class="text-danger mt-2 text-center" id="avatar-validation-msg" style="display: none;">
            Please select an avatar before proceeding.
        </div>
        <section>
            <div class="col-12 text-dark px-0 my-4 bg-needs-main">
                <div class="my-4 second-cloud">
                    <div class="row d-flex justify-content-center py-4 text-center align-items-center">
                        <h5>I'd like to provide coverage for my:</h5>
                    </div>
                    <div class="container">
                        {{-- hidden by default on desktop using JS js/coverage-carousel.js --}}
                        <div class="prev-arrow position-absolute top-50 start-0 translate-middle-y px-2">
                            <i class="bi bi-arrow-left-circle text-primary"></i>
                        </div>

                        {{-- hidden by default on desktop using JS js/coverage-carousel.js --}}
                        <div class="next-arrow position-absolute top-50 end-0 translate-middle-y px-2">
                            <i class="bi bi-arrow-right-circle text-primary"></i>
                        </div>
                    </div>
                    <div class="container row d-flex m-auto btn-group coverage-avatar" data-carousel="true">
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button" data-type="self"
                                id="button-self-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/self.svg') }}" class="self-avatar"
                                    alt="self-character">
                                <h6 class="text-center py-2">Self</h6>
                            </button>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button" data-type="spouse"
                                id="button-spouse-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/spouse.svg') }}" class="spouse-avatar"
                                    alt="spouse">
                                <h6 class="text-center py-2">Spouse</h6>
                            </button>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button" data-type="kid"
                                id="button-kid-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/kid.svg') }}" class="kid-avatar" alt="kid">
                                <h6 class="text-center py-2">Child(ren)</h6>
                            </button>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button" data-type="parent"
                                id="button-parent-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/parent.svg') }}" class="parent-avatar"
                                    alt="parent">
                                <h6 class="text-center py-2">Parent</h6>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex needs-grey-bg-md justify-content-center position-absolute w-100 bottom-0">
                        <div class="col-12 col-md-4 text-center">
                        </div>
                    </div>
                </div>
        </section>
        <section class="footer bg-white py-4 fixed-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                        <a href="{{route('protection.home')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                        <a href="{{route('protection.monthly.support')}}" class="btn btn-primary text-uppercase me-md-2"
                            onclick="validateSelection()">Next</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

<script>
    // javascript code for button click effect on avatar selection
        function avatarSelect(button) {
        const avatarValidationMsg = document.getElementById('avatar-validation-msg');
      const buttonType = button.getAttribute('data-type');
      const buttons = document.querySelectorAll('.avatar-button');

  
      buttons.forEach((btn) => {
        if (btn.getAttribute('data-type') !== buttonType) {
            if (btn.classList.contains('greyed-out')) {
                btn.classList.remove('greyed-out');
            } else {
                btn.classList.add('greyed-out');
            }
        } else {
          btn.classList.remove('greyed-out');

        }
      });
    }

    
</script>