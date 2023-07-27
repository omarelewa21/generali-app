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
        <div class="container-fluid px-5 pt-4 pt-sm-4 pt-md-5 pb-4 pb-sm-4 pb-md-3">
            <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                <img class="d-flex" src="{{ asset('images/general/menu-button-red.svg') }}" alt="Logo" width="32px" height="26px">
            </a>
        </div>
    </nav>
</header>

