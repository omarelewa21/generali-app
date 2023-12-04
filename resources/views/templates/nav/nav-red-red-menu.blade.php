<?php
/**
 * Navbar Section for Left Navigation Transparent
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links-desktop')
@include('templates.nav.nav-links-mobile')
{{--end of nav links --}}

<header id="wrapper-navbar" class="desktop navbar-scroll d-none d-md-block">
    <nav class="navbar navbar-default transparent">
        <div class="container px-4 px-xl-5">
            <div class="navbar-brand py-3 py-md-5">
                <img class="red-logo img-fluid" src="{{ asset('images/general/main-logo.png') }}" width="220" alt="Logo">
                <div class="col-12 justify-content-start pt-3">
                    <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                        <img class="d-inline" src="{{ asset('images/general/menu-red-left-icon.png') }}" alt="Logo" width="32px" height="26px">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<header id="wrapper-navbar" class="mobile white fixed-top navbar-scroll d-block d-md-none">
    <nav class="navbar navbar-default transparent">
        <div class="container-fluid px-4 px-xl-5">
            <div class="navbar-brand py-3 py-md-5">
                <img class="red-logo img-fluid" src="{{ asset('images/general/main-logo.png') }}" width="220" alt="Logo">
            </div>
            <div class="py-3 py-md-5">
                <a data-bs-toggle="offcanvas" href="#offcanvasMenuMobile" role="button" aria-controls="offcanvasMenuMobile">
                    <img class="d-inline" src="{{ asset('images/general/menu-red-right-icon.png') }}" alt="Logo" width="32px" height="26px">
                </a>
            </div>
        </div>
    </nav>
</header>