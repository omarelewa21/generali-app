<?php
/**
 * Navbar Section for Left Navigation
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links-desktop')
@include('templates.nav.nav-links-mobile')
{{--end of nav links --}}

<header id="wrapper-navbar" class="desktop">
    <nav class="navbar position-relative">
        <div class="container px-4 px-xl-5">
            <div class="navbar-brand py-3 py-md-5">
                <img class="white-logo" src="{{ asset('images/general/main-logo-white.webp') }}" alt="Logo" width="100%">
                <div class="col-12 justify-content-start pt-3">
                    <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                        <img class="d-inline" src="{{ asset('images/general/menu-white-left-icon.webp') }}" alt="Logo" width="32px" height="26px">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<header id="wrapper-navbar" class="mobile z-2 position-relative">
    <nav class="navbar position-relative">
        <div class="container px-4 px-xl-5">
            <div class="navbar-brand py-3 py-xl-5">
                <img class="white-logo" src="{{ asset('images/general/main-logo-white.webp') }}" alt="Logo" width="100%">
            </div>
            <div class="py-3 py-xl-5">
                <a data-bs-toggle="offcanvas" href="#offcanvasMenuMobile" role="button" aria-controls="offcanvasMenuMobile">
                    <img class="d-inline" src="{{ asset('images/general/menu-white-right-icon.png') }}" alt="Logo" width="32px" height="26px">
                </a>
            </div>
        </div>
    </nav>
</header>
