<?php
 /**
 * Template Name: PDPA Disclosure Page
 */
?>

@extends('templates.master')

@section('title')
<title>PDPA Disclosure</title>
@endsection

@section('content')

<div id="pdpa" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner">
                @include('templates.nav.nav-white')
                <div class="text-white px-4 px-xl-5 py-3 py-md-5">
                    <h4 class="display-5 fw-bold text-white">To begin, may we have permission to share or use your personal details?</h4>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey text-dark px-0">
                <div class="vh-100 overflow-y-auto overflow-x-hidden">
                    <section class="main-content extra-padding">
                        <div class="container">
                            <div class="row pt-4 px-4 pb-4 pt-md-5 sticky-md-top bg-accent-bg-grey">
                                <div class="col-12">
                                    <h1 class="display-2 text-uppercase">Your Agreement</h1>
                                </div>
                            </div>
                            <div class="row px-4">
                                <div class="col-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tincidunt, velit sodales
                                    congue ornare, orci purus semper tortor, at vehicula eros lorem ac elit. Morbi erat turpis,
                                    tristique quis euismod et, varius id eros. Pellentesque ultricies, neque vitae elementum
                                    sodales, nisi dolor ornare tellus, eget feugiat est risus sed magna. Duis dictum placerat
                                    nunc, et ullamcorper ex euismod at. Nunc sit amet fermentum elit. Donec convallis blandit
                                    arcu, id pretium mi euismod nec. Morbi suscipit massa at interdum consectetur. Pellentesque
                                    volutpat sagittis diam non sodales. Sed non risus in turpis pellentesque suscipit. Nam at
                                    eleifend nulla, at ultricies lectus. Nunc consequat ullamcorper malesuada.</p>

                                    <p>Donec id ipsum volutpat, pharetra ante ut, dictum tortor. Aenean pharetra ornare tellus, non
                                    luctus leo lobortis quis. Proin venenatis augue sit amet lacus finibus ultricies. In hac
                                    habitasse platea dictumst. In ante eros, auctor vitae lacus non, venenatis hendrerit justo.
                                    In sed lorem orci. Vivamus sit amet lacus ultricies, tempus metus vitae, ultricies elit.
                                    Vivamus ultrices consequat imperdiet. Nullam at dolor in nunc finibus vehicula quis non
                                    odio. Aenean imperdiet tincidunt dui sit amet posuere.</p>

                                    <p>Mauris venenatis sagittis vehicula. Interdum et malesuada fames ac ante ipsum primis in
                                    faucibus. In cursus sollicitudin efficitur. Duis sed iaculis erat, non pellentesque libero.
                                    Curabitur purus lacus, ullamcorper non risus non, lobortis vehicula sem. Praesent lobortis
                                    rutrum risus finibus mattis. Nulla lorem leo, rutrum vitae ante et, vulputate dictum quam.
                                    Proin sagittis facilisis nulla quis feugiat. Fusce quis mi magna.</p>

                                    <p>Pellentesque sed lorem eget risus pulvinar ullamcorper id aliquam nunc. Proin ut suscipit
                                    leo, id fringilla nulla. Etiam ac euismod elit. Vestibulum leo mi, suscipit vel iaculis ut,
                                    pellentesque aliquam orci. Praesent urna nunc, sagittis sed tellus non, fermentum convallis
                                    dolor. In hac habitasse platea dictumst. Nulla ultricies est lacus, et vulputate velit
                                    semper quis. Etiam eu ligula vitae odio facilisis varius vel a lacus. Aliquam eu ligula
                                    congue, aliquet dui et, convallis ipsum.</p>

                                    <p>Aliquam vehicula augue eu felis euismod porttitor. Vestibulum id enim luctus, scelerisque
                                    ante eu, venenatis orci. Curabitur dignissim ligula et eros bibendum, non aliquet urna
                                    ultricies. Integer fringilla metus vitae lectus vulputate consectetur. Vestibulum ante ipsum
                                    primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras aliquam sapien eu
                                    magna gravida venenatis. Aliquam vulputate vel quam eget lobortis. Suspendisse in erat
                                    commodo, sollicitudin felis id, rhoncus nulla. Ut semper, leo semper egestas interdum, dolor
                                    tortor pellentesque orci, vel molestie tellus leo commodo nisi. Aenean non metus purus.
                                    Morbi semper, dui ac aliquam eleifend, sem quam blandit diam, sed auctor felis massa at
                                    nisi.</p>

                                    <p>Nulla facilisi. In vestibulum iaculis sagittis. Cras id erat quis dui egestas tincidunt sit
                                    amet sit amet libero. Mauris feugiat risus ut metus fermentum, sit amet ultrices diam
                                    fermentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                                    turpis egestas. Nunc hendrerit felis vitae aliquet congue. Cras lacinia mollis tristique. Ut
                                    fermentum eu lectus vitae tempor. Sed congue dignissim dui quis ultricies. Sed ac magna
                                    tincidunt, malesuada tellus vitae, mattis tortor. Quisque a imperdiet libero, non ultrices
                                    sapien. Ut dictum elementum varius. Morbi vestibulum metus arcu, vel venenatis ex gravida
                                    at. Aenean condimentum, ipsum pellentesque facilisis scelerisque, purus eros vulputate ex,
                                    sit amet aliquet leo felis ac ipsum.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a id="declineButton" href="{{ route('welcome') }}" class="btn btn-primary flex-fill me-md-2">DECLINE</a>
                                    <a id="acceptButton" href="{{ route('basic.details') }}" class="btn btn-primary flex-fill">ACCEPT</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.getElementById("declineButton").addEventListener("click", function() {
        pdpa("Declined");
    });

    document.getElementById("acceptButton").addEventListener("click", function() {
        pdpa("Accepted");
    });

    function pdpa(decision, route) {
        $.ajax({
            type: "POST",
            url: "{{ route('save.button.click') }}",
            data: { decision: decision, route: route },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Handle success, if needed
            },
            error: function(xhr, status, error) {
                // Handle error, if needed
            }
        });
    }
});

</script>

@endsection