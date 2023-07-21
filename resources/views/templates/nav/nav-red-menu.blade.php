<?php
/**
 * Navbar Section for Left Navigation Transparent
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

<header id="wrapper-navbar">
    <nav class="navbar navbar-default transparent">
        <div class="container px-5 pt-5 pb-3">
            {{-- <a href="#" class="navbar-brand">
                    <img class="white-logo" src="{{ asset('images/logo.png') }}" alt="Logo" width="100px;">
            </a> --}}
            <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu" onclick="jQuery('.hide').css('z-index','-1');">
                <img class="d-flex" src="{{ asset('images/menu-button-red.svg') }}" alt="Logo" width="32px"
                    height="26px">
            </a>
        </div>
    </nav>
</header>