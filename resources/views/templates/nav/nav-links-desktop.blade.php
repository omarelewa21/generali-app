<?php
/**
 * Off Canvas Section for Left Navigation
 */
?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header px-4 px-md-5 pt-4 pt-md-5 pb-3 justify-content-end">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="timeline">
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('basic-details') }}">
                    <p class="nav-text">About Me</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar') }}">
                    <p class="nav-text">My Avatar</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('identity-details') }}">
                    <p class="nav-text">My Details</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('family-dependent') }}">
                    <p class="nav-text">My Family</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('assets') }}">
                    <p class="nav-text">My Assets</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('financial-priorities') }}">
                    <p class="nav-text">MY PRIORITIES</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('existing-policy') }}">
                    <p class="nav-text">Existing Policies</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('summary') }}">
                    <p class="nav-text">Summary</p>
                </a>
            </div>
        </div>

    </div>
    <div class="footer-navigation col-12">
        <div class="col-12 px-5 py-4 inline-block">
            <!-- Button trigger modal -->
            <a href="{{route('welcome')}}" class="btn btn-outline-secondary btn-exit text-uppercase pb-2" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Save & Logout</a>
            <a href="{{route('clear_session_storage')}}" class="btn btn-outline-secondary btn-exit text-uppercase pb-2" id="clearSession" data-clear-route="{{ route('clear_session_data') }}" type="button">
                Clear Session</a>
        </div>
    </div>
</div>