<?php
/**
 * Navbar Section for Left Navigation Transparent
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

<header id="wrapper-navbar" class="fixed-top navbar-scroll">
    <nav class="navbar navbar-default transparent">
        <div class="container-fluid px-4 px-md-5 pt-2 pt-md-5 pb-3">
            <div class="col-12 pb-0 pb-md-3">
                <img class="red-logo img-fluid py-3" src="{{ asset('images/general/main-logo.png') }}" width="220" alt="Logo">
            </div>
            <div>
                <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                    <img class="d-flex" src="{{ asset('images/general/menu-button-red.svg') }}" alt="Logo" width="32px" height="26px">
                </a>
            </div>
        </div>
    </nav>
</header>