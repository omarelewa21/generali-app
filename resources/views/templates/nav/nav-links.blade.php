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
                    <p class="nav-text">About Me</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar-gender-selection') }}">
                    <p class="nav-text">My Avatar</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar-family-dependant') }}">
                    <p class="nav-text">My Family</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar-my-assets') }}">
                    <p class="nav-text">My Assets</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('identity-details') }}">
                    <p class="nav-text">My Details</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('my-priorities') }}">
                    <p class="nav-text">MY PRIORITIES</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('existing-policies') }}">
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
        <div class="col-10 px-5 py-4 inline-block">
            <!-- Button trigger modal -->
            <a href="{{route('welcome')}}" class="btn btn-outline-secondary btn-exit text-uppercase pb-2" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Save & Logout</a>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header px-5 pt-4">
                            <h2 class="modal-title fs-4 text-center" id="staticBackdropLabel">Are you sure you want to leave this section?</h2>
                        </div>
                        <div class="modal-body text-dark text-center px-5 pb-4">
                            <p>Any changes made will be lost unless you save them.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">EXIT</button>
                            <a href="{{route('welcome')}}" class="btn btn-secondary text-uppercase" type="button">SAVE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>