{{--start of nav links --}}
@include('templates.nav-links') 
{{--end of nav links --}}

<nav class="navbar">
    <div class="container mx-4 mt-4 px-4">
        {{-- <a href="#" class="navbar-brand">
            <img class="white-logo" src="{{ asset('images/Logo-white-2x.png') }}" alt="Logo" width="100px;">
        </a> --}}

        <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button"
        aria-controls="offcanvasMenu">
        <img class="d-inline" src="{{ asset('images/menu-button.svg') }}" alt="Logo" width="60px;">
    </a>
    </div>
</nav>