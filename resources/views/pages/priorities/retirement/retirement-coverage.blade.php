{{-- Retirement - Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Coverage</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataRetirement = session('passingArraysRetirement');
    $retirementSelectedAvatar= isset($arrayDataRetirement['retirementSelectedAvatar']) ? $arrayDataRetirement['retirementSelectedAvatar'] : '';
@endphp
<div id="retirement_coverage" class="vh-100">

    <div class="p-0 vh-100 container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-lg-6 col-md-12">
                @include ('templates.nav.nav-sidebar-needs')
            </div>
        </div>
        @if ($errors->has('retirementSelectedAvatar'))
        <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block"
            id="retirementSelectedAvatar">{{ $errors->first('retirementSelectedAvatar') }}</div>
        @endif

        <section>
            <form class="form-horizontal p-0 needs-validation" novalidate
                action="{{ route('form.retirement.coverage') }}" method="POST">
                @csrf

                <div class="col-12 text-dark px-0 my-4 bg-needs-main">
                    <div class="my-4 second-cloud" style="padding-top:5.5rem;">
                        <div class="row d-flex justify-content-center py-2 text-center align-items-center">
                            <h5 class="my-2">I'd like to provide coverage for my:</h5>
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
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <button class="btn border-0 bg-transparent box-shadow avatar-button  {{ $retirementSelectedAvatar  === 'self' ? 'selected-box-shadow' : '' }}" data-type="self"
                                    id="button-self-avatar" onclick="avatarSelect(this)">
                                    <img src="{{ asset('images/needs/avatar/self.svg') }}" class="self-avatar"
                                        alt="self-character">
                                    <h6 class="text-center py-2">Self</h6>
                                </button>
                            </div>
                            <div class="col-sm-3 justify-content-end d-flex flex-column align-items-center">
                                <button class="btn border-0 bg-transparent box-shadow avatar-button {{ $retirementSelectedAvatar  === 'spouse' ? 'selected-box-shadow' : '' }}" data-type="spouse"
                                    id="button-spouse-avatar" onclick="avatarSelect(this)">
                                    <img src="{{ asset('images/needs/avatar/spouse.svg') }}" class="spouse-avatar"
                                        alt="spouse">
                                    <h6 class="text-center py-2">Spouse</h6>
                                </button>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <button class="btn border-0 bg-transparent box-shadow avatar-button {{ $retirementSelectedAvatar  === 'children' ? 'selected-box-shadow' : '' }}" data-type="children"
                                    id="button-kid-avatar" onclick="avatarSelect(this)">
                                    <img src="{{ asset('images/needs/avatar/kid.svg') }}" class="kid-avatar" alt="kid">
                                    <h6 class="text-center py-2">Child(ren)</h6>
                                </button>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end d-flex flex-column align-items-center">
                                <button class="btn border-0 bg-transparent box-shadow avatar-button  {{ $retirementSelectedAvatar  === 'parent' ? 'selected-box-shadow' : '' }}" data-type="parent"
                                    id="button-parent-avatar" onclick="avatarSelect(this)">
                                    <img src="{{ asset('images/needs/avatar/parent.svg') }}" class="parent-avatar"
                                        alt="parent">
                                    <h6 class="text-center py-2">Parent</h6>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="retirementSelectedAvatar" id="retirementSelectedAvatarInput"
                        value="{{ $retirementSelectedAvatar}}">

                        <div class="d-flex needs-grey-bg-md justify-content-center position-absolute w-100 bottom-0">
                            <div class="col-12 col-md-4 text-center">
                            </div>
                        </div>
        </section>
        <section class="footer bg-white py-4 fixed-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                        <a href="{{route('retirement.home')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                        <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                    </div>
                </div>
            </div>
        </section>
        </form>
    </div>
</div>
</div>

@endsection


<script>
       // javascript code for button click effect on avatar selection
       function avatarSelect(button) {
    event.preventDefault();
    const avatarType = button.getAttribute('data-type');
    const buttons = document.querySelectorAll('.avatar-button');
    const selectedAvatarInput = document.getElementById('retirementSelectedAvatarInput');

    if (selectedAvatarInput.value === avatarType) {
        selectedAvatarInput.value = '';
        buttons.forEach((btn) => {
            btn.classList.remove('selected-box-shadow');
            btn.classList.add('box-shadow');
        });
    } else {
        selectedAvatarInput.value = avatarType;
        buttons.forEach((btn) => {
            // Only add the class to the clicked button and remove from others
            if (btn.getAttribute('data-type') === avatarType) {
                if (btn.classList.contains('selected-box-shadow')) {
                    btn.classList.remove('selected-box-shadow');
                } else {
                    // Remove class from all buttons before adding to the clicked button
                    buttons.forEach((otherBtn) => {
                        otherBtn.classList.remove('selected-box-shadow');
                    });
                    btn.classList.add('selected-box-shadow');
                    btn.classList.remove('box-shadow');
                    retirementSelectedAvatarErrorMsg.classList.remove('d-block');
                }
            } else {
                btn.classList.remove('selected-box-shadow');
            }
        });
    }
}

</script>