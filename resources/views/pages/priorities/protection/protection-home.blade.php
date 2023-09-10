{{-- Protection - Home --}} 
@extends('templates.master')

@section('title')
<title>Protection - Home</title>
@endsection

@section('content')

<div id="protection_home" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3 bg-primary sidebanner">
                @include('templates.nav.nav-white-menu')
                <div class="text-white px-4 px-md-5 py-md-5 py-3">
                    <h2 class="display-5 font-bold fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-md-9 px-0 bg-needs-main">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block" />
                
                <section class="needs-home">
                    <div class="content-needs">
                        <div class="needs-home-avatar col-12 text-center d-flex flex-column justify-content-start justify-content-md-center justify-content-lg-center align-items-center py-2 py-xl-4">
                            <img class="z-1" src="{{ asset('images/needs/protection/protection-home-avatar.png') }}" alt="Protection">
                            <h5 class="z-1 d-flex col-12 col-md-8 col-xl-4 justify-content-center needs-grey-bg-mobile">Let’s figure out what you need for Protection.</h5>
                        </div>
                        <div class="d-flex needs-grey-bg justify-content-center position-absolute w-100 bottom-0">
                            </div>
                        </div> 
                    </div>
                </section>

                <section class="footer bg-white py-4 fixed-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a href="{{route('priorities.to.discuss')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                <a href="{{route('protection.coverage') }}" class="btn btn-primary text-uppercase flex-fill">Next</a>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>
<style>
    /* .footer {
        display: none;
    } */
</style>
<script>

    //    $(document).on('touchmove', onScroll); // for mobile

    //    $(window).scroll(function(){
    //          onScroll();
    //    });
    //    function onScroll() {
    //     if ($(window).height() >= $(document).height() - 150) {
    //         $('.footer').fadeIn();
    //         console.log('go down');
    //     } else {
    //         console.log('go up');
    //         // Hide the footer when not at the bottom
    //         $('.footer').fadeOut();
    //     }
    // }

    // console.log('document height: ' + $(document).height());
    // //get windows height
    // console.log('window height: ' + $(window).height());

</script>
@endsection