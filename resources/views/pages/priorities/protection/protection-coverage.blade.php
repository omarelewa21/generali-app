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
                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                        <a href="{{route('protection.home')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                            <button type="submit" class="btn btn-primary flex-fill text-uppercase">Next</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
    </div>
</div>
<div class="d-flex justify-content-center align-items-end vh-100">
    <div class="position-relative mb-auto w-50">
        @if ($errors->has('protectionSelectedAvatar'))
        <div class="alert alert-danger d-flex align-items-center text-center position-absolute bottom-0 z-1 w-100 my-3" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            {{ $errors->first('protectionSelectedAvatar') }}
        </div>
        @endif
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
    // // Get the toast element
    // const protectionSelectedAvatarErrorMsg = document.getElementById('protectionSelectedAvatarErrorMsg');

    // // Show the toast and apply the animation
    // function showToast() {
    //     protectionSelectedAvatarErrorMsg.classList.add('show');

        
    // }

    // // Trigger the toast animation on page load or when error condition is met
    // document.addEventListener('DOMContentLoaded', showToast);


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
    z-index: 10;
}
.navbar {
        right:0;
    }
    .slick-track {
    height: 57vh;
}
.navbar-default.transparent {
    background: transparent !important;
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
@media only screen and (min-width:768px) and (max-height:1280px) and (orientation:portrait) {
    .needs-grey-bg-md {
        padding-top: 300px;
    }
    .slick-track {
        height:63vh;
    }
    .coverage-avatar img.parent-avatar {
        width:36vh;
    }
    .bg-needs-main {
    background-position: center center;
    height: 110vh;
    width: 100%;
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

