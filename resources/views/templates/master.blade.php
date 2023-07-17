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
    @yield('title')
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom-ying.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <main>
        @yield('content')
    </main>
 
</body>

</html>