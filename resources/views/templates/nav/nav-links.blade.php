<?php
/**
 * Off Canvas Section for Left Navigation
 */
?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header px-5 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-3">
        <div class="navbar-brand">
            <img class="white-logo" src="{{ asset('images/Logo-white-2x.png') }}" alt="Logo" width="100px;">
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="timeline">
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('about-me') }}">
                    <h6 class="display-6 nav-text">About Me</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-avatar') }}">
                    <h6 class="display-6 nav-text">My Avatar</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-family') }}">
                    <h6 class="display-6 nav-text">My Family</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-assets') }}">
                    <h6 class="display-6 nav-text">My Assets</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-details') }}">
                    <h6 class="display-6 nav-text">My Details</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-priorities') }}">
                    <h6 class="display-6 nav-text">MY PRIORITIES</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('existing-policies') }}">
                    <h6 class="display-6 nav-text">Existing Policies</h6>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('summary') }}">
                    <h6 class="display-6 nav-text">Summary</h6>
                </a>
            </div>
        </div>

    </div>
    <div class="footer-navigation col-12">
        <div class="col-10 px-5 my-3 inline-block">
            <a href="{{route('welcome')}}" class="btn btn-exit btn-outline-primary d-flex text-uppercase"><img src="{{ asset('images/Logout.svg') }}" alt="logout" class="logout-svg">Save & Logout</a>
        </div>
    </div>
</div>