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
        <div class="container-fluid px-4 px-xl-5">
            <div class="navbar-brand py-2 py-md-5">
                <img class="red-logo img-fluid" src="{{ asset('images/general/main-logo.png') }}" width="220" alt="Logo">
                <div class="col-12 justify-content-start pt-0 pt-md-3">
                    <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                        <img class="d-inline" src="{{ asset('images/general/menu-button-red.svg') }}" alt="Logo" width="32px" height="26px">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>