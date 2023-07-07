<div class="row d-flex align-items-center justify-content-center">
    <div class="col-12 col-md-8 mx-md-0 px-md-0 py-md-5 py-3">
        {{--start of nav links --}}
            @include('templates.nav.nav-links')
        {{--end of nav links --}}
        <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
            <img class="d-inline" src="{{ asset('images/menu-button-red.svg') }}" alt="Logo" width="32px" height="26px">
        </a>
    </div>
</div>