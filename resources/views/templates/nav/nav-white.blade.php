<?php
/**
 * Navbar Section for PDPA Disclosure Page
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links-mobile')
{{--end of nav links --}}

<?php 
$current_url = $_SERVER['REQUEST_URI'];

if (rtrim($current_url, '/') === '/agent' || rtrim($current_url, '/') === '/agent/logs') { ?>
    <div class="col-12 col-md-4 col-lg-3 px-0 bg-primary sidebanner desktop d-none d-md-block">
        <div class="navbar-scroll fixed-top">
            <nav class="navbar position-relative z-1">
                <div class="container px-4 px-xl-5">
                    <div class="navbar-brand py-3 py-md-5">
                        <img class="white-logo" src="{{ asset('images/general/main-logo-white.png') }}" alt="Logo" width="220;">
                    </div>
                </div>
            </nav>
            <div class="text-white px-4 px-xl-5 fixed-sm-top bg-primary">
                <div class="timeline">
                    <div class="timeline-item">
                        <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('agent') }}">
                            <p class="nav-text">Dashboard</p>
                        </a>
                    </div>
                    <div class="timeline-item">
                        <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('agent/logs') }}">
                            <p class="nav-text">Transaction Logs</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3 px-0 mobile red d-block d-md-none" id="wrapper-navbar-agent">
        <div class="navbar-scroll fixed-top bg-primary">
            <nav class="navbar navbar-default transparent">
                <div class="container-fluid px-4 px-xl-5">
                    <div class="navbar-brand py-3 py-md-5">
                        <img class="white-logo" src="{{ asset('images/general/main-logo-white.png') }}" alt="Logo" width="172">
                    </div>
                    <div class="py-3 py-md-5">
                        <a data-bs-toggle="offcanvas" href="#offcanvasMenuMobileAgent" role="button" aria-controls="offcanvasMenuMobileAgent">
                            <img class="d-inline" src="{{ asset('images/general/menu-white-right-icon.png') }}" alt="Logo" width="32px" height="26px">
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<?php } else { ?>
    <nav class="navbar position-relative z-1">
        <div class="container px-4 px-xl-5">
            <div class="navbar-brand py-3 py-md-5">
                <img class="white-logo" src="{{ asset('images/general/main-logo-white.png') }}" alt="Logo" width="220;">
            </div>
        </div>
    </nav>
<?php } ?>
