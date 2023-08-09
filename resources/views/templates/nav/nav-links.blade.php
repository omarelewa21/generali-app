<?php
/**
 * Off Canvas Section for Left Navigation
 */
?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header px-4 px-md-5 pt-4 pt-md-5 pb-3">
        <div class="navbar-brand">
            <img class="white-logo" src="{{ asset('images/general/Logo-white-2x.png') }}" alt="Logo" width="100px;">
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
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('gender') }}">
                    <p class="nav-text">My Avatar</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('identity-details') }}">
                    <p class="nav-text">My Details</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('family-dependant') }}">
                    <p class="nav-text">My Family</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('assets') }}">
                    <p class="nav-text">My Assets</p>
                </a>
            </div>
            <div class="timeline-item">
                <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('top-priorities') }}">
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
        </div>
    </div>
</div>

<script>

    // $(document).ready(function () {
    //     // Get the current URL path
    //     var currentPath = window.location.pathname;

    //     // Find all the timeline items and iterate through them
    //     $('.timeline-item').each(function (index) {
    //         // Get the URL of the timeline item
    //         var itemURL = $(this).find('a').attr('href');

    //         // Create a URL object to parse the full URL
    //         var urlObject = new URL(itemURL);

    //         // Get only the path from the URL object
    //         var itemPath = urlObject.pathname;

    //         // Check if the current URL matches the timeline item URL
    //         // if (itemPath === currentPath) {
    //         if (itemPath === currentPath || (currentPath === '/welcome' && index < $('.timeline-item').length - 1)) {
    //             // Add the checkmark (you can use a class or a style here)
    //             $(this).addClass('active'); // Add your CSS class here

    //             // Also mark all previous steps as active
    //             for (var i = 0; i < index; i++) {
    //                 $('.timeline-item:eq(' + i + ')').addClass('active');
    //             }
    //         }
    //     });
    // });

    

</script>