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
<<<<<<< HEAD
                <div class="text-white px-4 px-md-5 py-md-5 py-3">
=======
                <div class="text-white px-4 px-md-3 px-lg-3 px-xl-5 py-md-5 py-3">
>>>>>>> staging
                    <h2 class="display-5 font-bold fw-bold">My Priorities</h2>
                </div>
            </div>
            <div class="col-12 col-md-9 px-0 bg-needs-main vh-100">
                <hr class="py-1 m-0 bg-primary opacity-100 border-0 d-none d-md-block" />
<<<<<<< HEAD
                
                <section class="needs-home">
                    <div class="content-needs">
                        <div class="needs-home-avatar col-12 text-center d-flex flex-column justify-content-start justify-content-md-center justify-content-lg-center align-items-center py-2">
                            <img class="z-1" src="{{ asset('images/needs/protection/protection-home-avatar.png') }}" alt="Protection">
                            <h5 class="z-1 d-flex col-12 col-md-8 justify-content-center needs-grey-bg-mobile">Let’s figure out what you need for Protection.</h5>
=======

                <div class="needs-home">
                    <section class="content-needs">
                        <div
                            class="needs-home-avatar col-12 text-center d-flex flex-column justify-content-start justify-content-md-center justify-content-lg-center align-items-center py-2 py-2 py-md-3 py-lg-5 py-xl-2">
                            <img class="z-1 img-fluid" src="{{ asset('images/needs/protection/protection-home-avatar.png') }}"
                                alt="Protection">
                            <h5 class="z-1 d-flex col-12 col-md-8 col-xl-5 col-xxl-4 py-3 py-md-3 py-lg-3 justify-content-center needs-grey-bg-mobile">Let’s
                                figure out what you need for Protection.</h5>
>>>>>>> staging
                        </div>
                        <div class="d-flex needs-grey-bg justify-content-center position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                            </div>
<<<<<<< HEAD
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
=======
                        </div>
                    </section>
                </div>

                <section class="footer bg-white py-4 fixed-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a href="{{route('priorities.to.discuss')}}"
                                    class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                <a href="{{route('protection.coverage') }}"
                                    class="btn btn-primary text-uppercase flex-fill">Next</a>
                            </div>
                        </div>
                    </div>
                </section>
>>>>>>> staging
            </div>
        </div>
    </div>
</div>

<style>
    /* @media only screen and (width: 414px) and (height: 896px) {
    .needs-home {
    grid-template-rows: 14vh 26vh 30vh;
}
}
@media only screen and (width:688px) and (height:1031px) and (orientation:portrait) {
    .needs-home-avatar img {
    height: 52vh;
}
}
@media only screen and (width:1024px) and (height:1366px) and (orientation:portrait) {
    .needs-home {
    grid-template-rows: 23vh 45vh 30vh;
}
}
@media only screen and (width:800px) and (height:1280px) and (orientation:portrait) {
    .needs-home {
    grid-template-rows: 22vh 38vh 31vh;
}
}
@media only screen and (width: 1031px) and (height: 688px) and (orientation: landscape) {
    .needs-home-avatar img {
    height: 54vh;
}
}
@media only screen and (width: 1366px) and (height: 1024px) and (orientation: landscape) {
    .needs-grey-bg {
    padding-top: 300px;
    }
}
@media only screen and (width:1024px) and (max-height:778px) and (orientation:landscape) {
    .needs-home-avatar img {
    height: 58vh;
}
}
@media only screen and (max-width:896px) and (max-height:414px) and (orientation:landscape) {
    .needs-home-avatar img {
    height: 44vh;
}
.needs-grey-bg {
    padding-top: 170px;
}
} */
</style>
@endsection