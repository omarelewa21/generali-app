<?php
 /**
 * Template Name: Admin Dashboard Page
 */
?>

@extends('templates.master')

@section('title')
<title>Admin Dashboard</title>
@endsection

@section('content')

<div id="dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 px-0 bg-primary sidebanner">
                <div class="navbar-scroll fixed-top">
                    @include('templates.nav.nav-white')
                    <div class="text-white px-4 px-xl-5 fixed-sm-top bg-primary">
                    <div class="timeline">
                        <div class="timeline-item">
                            <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('basic-details') }}">
                                <p class="nav-text">Dashboard</p>
                            </a>
                        </div>
                        <div class="timeline-item">
                            <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('avatar') }}">
                                <p class="nav-text">Transaction Logs</p>
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey px-0 vh-100 content-section">
                <section class="main-content">
                    <div class="container">
                        <div class="row pt-4 px-4 pb-4 sticky-md-top bg-accent-bg-grey">
                            <div class="col-9">
                                <h2 class="display-5 fw-bold lh-sm text-primary">Hi, Agent Lee</h2>
                            </div>
                            <div class="col-3">
                                <p class="text-gray">Last login: 01/11/23 13:10</p>
                            </div>
                            <div class="col-12">
                                <p class="text-gray my-0">15428</p>
                            </div>
                        </div>
                        <div class="row px-4 pt-5">
                            <div class="col-12">
                                <h3 class="avatar-text fw-bold pb-3">Transaction Logs</h3>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer ID</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date of Completion</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Customer Abc</td>
                                            <td>ID 01234</td>
                                            <td class="text-green">Completed</td>
                                            <td>30/10/23</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Continue</a></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Customer Abc</td>
                                            <td>ID 01234</td>
                                            <td class="text-green">Completed</td>
                                            <td>30/10/23</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Continue</a></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Customer Abc</td>
                                            <td>ID 01234</td>
                                            <td class="text-green">Completed</td>
                                            <td>30/10/23</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Continue</a></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Customer Abc</td>
                                            <td>ID 01234</td>
                                            <td class="text-green">Completed</td>
                                            <td>30/10/23</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Continue</a></td>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Customer Abc</td>
                                            <td>ID 01234</td>
                                            <td class="text-green">Completed</td>
                                            <td>30/10/23</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Continue</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection