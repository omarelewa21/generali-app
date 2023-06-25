{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

<div class="vh-100 overflow-auto">
    <div class="col-12 col-sm-3 col-xl-3 px-sm-2 px-0 d-flex sticky-top">
        <nav class="navbar">
            <div class="container mx-4 mt-4">
                {{-- <a href="#" class="navbar-brand">
                    <img class="white-logo" src="{{ asset('images/logo.png') }}" alt="Logo" width="100px;">
                </a> --}}
                <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                    <img class="d-flex" src="{{ asset('images/menu-button-red.svg') }}" alt="Logo" width="32px"
                        height="26px">
                </a>
            </div>
        </nav>
    </div>