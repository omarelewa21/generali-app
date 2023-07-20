<?php
/**
 * Off Canvas Section for Left Navigation
 */
?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header px-5 pt-5 pb-3">
        <div class="navbar-brand">
            <img class="white-logo" src="{{ asset('images/Logo-white-2x.png') }}" alt="Logo" width="100px;">
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="timeline">
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('basic-details') }}">
                    <h6 class="nav-text">About Me</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar-gender-selection') }}">
                    <h6 class="nav-text">My Avatar</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar-family-dependant') }}">
                    <h6 class="nav-text">My Family</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar-my-assets') }}">
                    <h6 class="nav-text">My Assets</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('identity-details') }}">
                    <h6 class="nav-text">My Details</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-priorities') }}">
                    <h6 class="nav-text">MY PRIORITIES</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('existing-policies') }}">
                    <h6 class="nav-text">Existing Policies</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('summary') }}">
                    <h6 class="nav-text">Summary</h6>
                </a>
            </div>
        </div>

    </div>
    <div class="footer-navigation col-12">
        <div class="col-10 px-5 py-4 inline-block">
            <a href="{{route('welcome')}}" class="btn btn-outline-secondary btn-exit text-uppercase pb-2">
            Save & Logout</a>
        </div>
    </div>
</div>