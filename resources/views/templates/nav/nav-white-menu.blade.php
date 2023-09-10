<?php
/**
 * Navbar Section for Left Navigation
 */
?>

{{--start of nav links --}}
@include('templates.nav.nav-links')
{{--end of nav links --}}

@php
    $needsPages = ['protection-home', 'retirement-home', 'education-home']; // Add your needs page slugs here
    
@endphp

@if(in_array(request()->path(), $needsPages))
    <div class="row" id="main-menu">
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

<style>
.sidebanner{
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 1030!important;
}
.scrolled-up {
  /* transform: translateY(0); */
  transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}

.scrolled-down {
  transform: translateY(-100%);
  transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}
</style>

<script>
    // function menu_scroll() {
        var last_scroll_top = 0;
    
        jQuery(window).on('scroll', function() {
            scroll_top = jQuery(this).scrollTop();
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                if(scroll_top < last_scroll_top) {
                    jQuery('.sidebanner').removeClass('scrolled-down').addClass('scrolled-up');
                } else {
                    jQuery('.sidebanner').removeClass('scrolled-up').addClass('scrolled-down');
                }
            } else {
                jQuery('.sidebanner').removeClass('scrolled-down').addClass('scrolled-up');
            }
            last_scroll_top = scroll_top;
    
        });
    // }
</script>

@endif
