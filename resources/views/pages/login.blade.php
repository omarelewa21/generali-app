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
        <div class="row h-100 wrapper-login">
            <div class="col-12 d-block d-md-none py-4 text-center header">
                <img src="{{ asset('images/general/main-logo.png') }}" alt="" width="172" height="auto">
            </div>
            <div class="col-md-6 text-center d-flex justify-content-center align-items-center login-bg content">
                <img src="{{ asset('images/welcome-page/welcome-avatar.png') }}" alt="Avatar" width="100%" height="auto">
            </div>
            <div class="col-md-6 px-5 py-5 d-flex justify-content-center align-items-center bottom-content">
                <div class="row">
                    <div class="col-xxl-9 col-xl-9 col-lg-12 col-md-12">
                        <img class="pb-4 d-none d-md-block" src="{{ asset('images/general/main-logo.png') }}" alt="" width="300" height="auto">
                        <p class="avatar-text fw-bold text-center text-md-start">Customer Fact Finding App Login</p>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                        <form class="form-signin">
                            <div class="col-12 py-md-1 form-floating">
                                <input type="text" name="agent" class="form-control" id="agentID" placeholder="Agent ID" required>
                                <label for="agentID" class="fw-bold pb-2">Agent ID</label>
                                <i class="field-icon fa-solid fa-user"></i>
                            </div>
                            <div class="col-12 py-md-1 form-floating">
                                <input type="password" name="agentPassword" class="form-control" id="agentPassword" placeholder="Password" required>
                                <label for="agentPassword" class="fw-bold pb-2">Password</label>
                                <i class="field-icon fa-solid fa-unlock-keyhole"></i>
                            </div>
                            <div class="checkbox py-3">
                                <label class="d-flex align-items-center">
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <a href="{{route('dashboard')}}" class="btn btn-primary text-uppercase w-100 mt-4">Sign in</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection