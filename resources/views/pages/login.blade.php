<?php
 /**
 * Template Name: Login Page
 */
?>

@extends('templates.master')

@section('title')
<title>Login</title>
@endsection

@section('content')

<div id="login">
    <div class="container-fluid h-100">
        <div class="row h-100 d-flex justify-content-center align-items-center">
            <div class="col-md-6 text-center order-md-1 order-sm-2 order-2">
                <img src="{{ asset('images/welcome-page/welcome-avatar.png') }}" alt="Avatar" width="100%" height="auto">
            </div>
            <div class="col-md-6 px-5 py-5 order-md-2 order-1 order-xs-1">
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                        <img class="mb-4" src="{{ asset('images/general/main-logo.png') }}" alt="" width="200" height="auto">
                        <p class="avatar-text fw-bold">Customer Fact Finding App Login</p>
                        <p class="mb-4 text-gray">Please sign in.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                        <form class="form-signin">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Agent ID">
                                <label for="floatingInput">Agent ID</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>

                            <button class="btn btn-primary text-uppercase w-100 mt-4" type="submit">Sign in</button>
                            <!-- <p class="text-center mt-5 mb-3 text-muted">&copy; 2017–2022</p> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection