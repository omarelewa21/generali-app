<?php
/**
 * Navbar Section for Left Navigation Transparent
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

<header id="wrapper-navbar">
    <nav class="navbar navbar-default">
        <div class="container px-5 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-5 pt-5">
            {{-- <a href="#" class="navbar-brand">
                    <img class="white-logo" src="{{ asset('images/logo.png') }}" alt="Logo" width="100px;">
            </a> --}}
            <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                <img class="d-flex" src="{{ asset('images/menu-button-red.svg') }}" alt="Logo" width="32px"
                    height="26px">
            </a>
        </div>
    </nav>
</header>