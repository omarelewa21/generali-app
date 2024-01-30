<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the default <head> section and <body> content.
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('title')
    @vite(['resources/js/jquery.min.js','resources/js/app.js', 'resources/css/app.scss'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js" integrity="sha512-jEnuDt6jfecCjthQAJ+ed0MTVA++5ZKmlUcmDGBv2vUI/REn6FuIdixLNnQT+vKusE2hhTk2is3cFvv5wA+Sgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
    <link href="{{ asset('css/skin-tone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom-ying.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/netis-styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/slick.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/slick-theme.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
</head>

<body class="overflow">
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4">
                <h3 class="modal-title fs-4 text-center" id="staticBackdropLabel">Are you sure you want to leave this section?</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Any changes made will be lost unless you save them.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">EXIT</button>
                <a href="{{route('clear_session_storage')}}" class="btn btn-secondary text-uppercase" type="button" id="saveSession" data-clear-route="{{ route('clear_session_data') }}">SAVE</a>
            </div>
        </div>
    </div>
</div>

</html>