{{-- Protection - Coverage page --}}

@extends('templates.master')

@section('title')
<title>Protection - Coverage</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionSelectedAvatar= isset($arrayDataProtection['protectionSelectedAvatar']) ? $arrayDataProtection['protectionSelectedAvatar'] : '';
@endphp
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
        {{-- @if ($errors->has('protectionSelectedAvatar'))
        <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="protectionSelectedAvatarErrorMsg">{{ $errors->first('protectionSelectedAvatar') }}</div>
    @endif --}}
    @if ($errors->has('protectionSelectedAvatar'))
<div class="position-fixed mt-4 top-0 start-50 translate-middle w-100" style="z-index:1099">
    <div id="protectionSelectedAvatarErrorMsg" class="align-items-center alert alert-warning border-0 fade" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <div class="d-flex justify-content-center">
            <i class="bi bi-exclamation-circle p-2"></i>
            <div class="p-2">
                {{ $errors->first('protectionSelectedAvatar') }}
            </div>
        </div>
    </div>
</div>
@endif

    <form class="form-horizontal p-0 needs-validation" id="protectionCoverage" novalidate action="{{route('form.protection.coverage')}}"  method="POST">
        @csrf
        <section>         
            <div class="col-12 text-dark px-0 my-4 bg-needs-main">
                <div class="my-0 my-lg-4 p-4 p-md-5 p-lg-5 second-cloud" style="padding-top:5.5rem;">
                    <div class="row d-flex justify-content-center py-4 py-md-5 text-center align-items-center">
                        <h5>I'd like to provide coverage for my:</h5>
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
                    
                    <div class="container row d-flex m-auto btn-group coverage-avatar" data-carousel="true">
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button {{ $protectionSelectedAvatar === 'self' ? 'selected-box-shadow' : '' }}" 
                            data-type="self"
                            id="button-self-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/self.svg') }}" class="self-avatar"
                                    alt="self-character">
                                <h6 class="text-center py-2">Self</h6>
                            </button>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button {{ $protectionSelectedAvatar === 'spouse' ? 'selected-box-shadow' : '' }}" 
                            data-type="spouse"
                                id="button-spouse-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/spouse.svg') }}" class="spouse-avatar"
                                    alt="spouse">
                                <h6 class="text-center py-2">Spouse</h6>
                            </button>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center children-avatar-mobile">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button {{ $protectionSelectedAvatar === 'children' ? 'selected-box-shadow' : '' }}" 
                             data-type="children"
                                id="button-kid-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/kid.svg') }}" class="kid-avatar" alt="children">
                                <h6 class="text-center py-2">Child(ren)</h6>
                            </button>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end flex-column align-items-center">
                            <button class="btn border-0 bg-transparent box-shadow avatar-button {{ $protectionSelectedAvatar === 'parent' ? 'selected-box-shadow' : '' }}" 
                            data-type="parent"
                                id="button-parent-avatar" onclick="avatarSelect(this)">
                                <img src="{{ asset('images/needs/avatar/parent.svg') }}" class="parent-avatar"
                                    alt="parent">
                                <h6 class="text-center py-2">Parent</h6>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="protectionSelectedAvatar" id="protectionSelectedAvatarInput" value="{{$protectionSelectedAvatar}}">
                
                    <div class="d-flex needs-grey-bg-md justify-content-center position-absolute w-100 bottom-0">
                        <div class="col-12 col-md-4 text-center">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer bg-white py-4 fixed-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                        <a href="{{route('protection.home')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                        {{-- <a href="{{route('protection.monthly.support')}}" class="btn btn-primary text-uppercase me-md-2"
                            onclick="validateSelection()">Next</a> --}}
                            <button type="submit" class="btn btn-primary text-uppercase">Next</button>

                    </div>
                </div>
            </div>
        </section>
    </form>
    </div>
</div>

<script>

    // javascript code for button click effect on avatar selection
    function avatarSelect(button) {
    event.preventDefault();
    const avatarType = button.getAttribute('data-type');
    const buttons = document.querySelectorAll('.avatar-button');
    const selectedAvatarInput = document.getElementById('protectionSelectedAvatarInput');

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
                }
            } else {
                btn.classList.remove('selected-box-shadow');
            }
        });
    }
    
}
    // Get the toast element
    const protectionSelectedAvatarErrorMsg = document.getElementById('protectionSelectedAvatarErrorMsg');

    // Show the toast and apply the animation
    function showToast() {
        protectionSelectedAvatarErrorMsg.classList.add('show');

        // Auto-hide the toast after a delay
        setTimeout(() => {
            protectionSelectedAvatarErrorMsg.classList.remove('show');
        }, 2500);
    }

    // Trigger the toast animation on page load or when error condition is met
    document.addEventListener('DOMContentLoaded', showToast);


</script>
<style>
    .navbar {
        right:50%;
    }
@media only screen and (max-width: 767px) {
.progress-value p{
    color:inherit !important;
}
.fixed-bottom {
    z-index: 1;
}
.navbar {
        right:0;
    }
}
@media only screen and (width: 414px) and (height: 896px) {
.coverage-avatar img.self-avatar {
  width: 20vh;
}
.coverage-avatar img.spouse-avatar {
  width: 18vh;
}
}

.monthly-support-asset {
    left: -5%;
    bottom: 8%;
    z-index: 10;
    width: 40vh;
}

</style>
@endsection

