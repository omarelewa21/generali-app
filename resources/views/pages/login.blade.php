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
        <div class="row h-100">
            <div class="col-md-6 text-center order-md-1 order-sm-2 order-2 d-flex justify-content-center align-items-center login-bg">
                <img src="{{ asset('images/welcome-page/welcome-avatar.png') }}" alt="Avatar" width="100%" height="auto">
            </div>
            <div class="col-md-6 px-5 py-5 order-md-2 order-1 order-xs-1 d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                        <img class="mb-4" src="{{ asset('images/general/main-logo.png') }}" alt="" width="400" height="auto">
                        <p class="avatar-text fw-bold">Customer Fact Finding App Login</p>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                        <form class="form-signin">
                            <div class="col-12 py-3">
                                <label for="agentID" class="fw-bold pb-2">Agent ID</label>
                                <input type="text" name="agent" class="form-control" id="agentID" placeholder="Agent ID" required>
                            </div>
                            <div class="col-12 py-3">
                                <label for="agentPassword" class="fw-bold pb-2">Password</label>
                                <input type="password" name="agentPassword" class="form-control" id="agentPassword" placeholder="Password" required>
                            </div>
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <a href="{{route('dashboard')}}" class="btn btn-primary text-uppercase w-100 mt-4">Sign in</a>
                            <!-- <p class="text-center mt-5 mb-3 text-muted">&copy; 2017–2022</p> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection