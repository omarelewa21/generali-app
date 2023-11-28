<?php
/**
 * Navbar Section for Left Navigation
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

@php
    $needsPages = ['protection-home', 'protection', 'retirement-home', 'education-home' , 'savings-home' , 'investment-home', 'health-medical-home', 'debt-cancellation-home']; // Add your needs page slugs here
@endphp

<header id="wrapper-navbar">
    <nav class="navbar position-relative">
        <div class="container px-4 px-xl-5">
            <div class="navbar-brand pt-3 py-md-5">
                <img class="white-logo" src="{{ asset('images/general/main-logo-white.png') }}" alt="Logo" width="220">
                <div class="col-12 justify-content-start pt-3">
                    <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                        <img class="d-inline" src="{{ asset('images/general/menu-button.svg') }}" alt="Logo" width="32px" height="26px">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

