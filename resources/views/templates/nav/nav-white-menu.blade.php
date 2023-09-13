<?php
/**
 * Navbar Section for Left Navigation
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

@php
    $needsPages = ['protection-home', 'retirement-home', 'education-home' , 'savings-home' , 'investment-home']; // Add your needs page slugs here
    
@endphp

@if(in_array(request()->path(), $needsPages))
    <div class="row">
        <div class="col-3 col-lg-6">
            <header id="wrapper-navbar">
                <nav class="navbar position-relative">
                    <div class="container px-4 px-xl-5 pt-4 pt-md-5 pb-0">
                        <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                            <img class="d-inline" src="{{ asset('images/general/menu-button.svg') }}" alt="Logo" width="32px" height="26px">
                        </a>
                    </div>
                </nav>
            </header>
        </div>
        <div class="col-9 col-lg-6">
            @include ('templates.nav.nav-sidebar-needs')
        </div>
    </div>
@else

<header id="wrapper-navbar">
    <nav class="navbar position-relative">
        <div class="container px-4 px-xl-5 pt-4 pt-md-5 pb-0">
            <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                <img class="d-inline" src="{{ asset('images/general/menu-button.svg') }}" alt="Logo" width="32px" height="26px">
            </a>
        </div>
    </nav>
</header>

@endif
