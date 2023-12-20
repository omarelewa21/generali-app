<?php
 /**
 * Template Name: Agent Dashboard Page
 */
?>

@extends('templates.master')

@section('title')
<title>Agent Dashboard</title>
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
                            <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('agent') }}">
                                <p class="nav-text">Dashboard</p>
                            </a>
                        </div>
                        <div class="timeline-item">
                            <a class="nav-item text-light text-decoration-none text-uppercase" href="{{ url('agent/logs') }}">
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
                            <div class="col-8">
                                <h2 class="display-5 fw-bold lh-sm text-primary">Hi, Agent Lee</h2>
                            </div>
                            <div class="col-4 text-end">
                                <p class="text-gray">Last login: 2023-11-01 20:01:00</p>
                            </div>
                            <div class="col-12">
                                <p class="text-gray my-0">15428</p>
                            </div>
                        </div>
                        <div class="row px-4 pt-5">
                            <div class="col-12">
                                <a href="http://127.0.0.1:8000" class="btn btn-secondary btn-create fw-bold">Create New Transaction</a>
                            </div>
                        </div>
                        <div class="row px-4 pt-5">
                            <div class="col-12">
                                <h3 class="avatar-text fw-bold pb-3">Overview</h3>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-12 col-lg-4 pb-2">
                                <div class="col-12 btn-tick">
                                    <a href="" class="btn w-100">
                                        <div class="row align-items-center">
                                            <div class="col-8 text-green text-start btn-text avatar-text fw-bold d-flex align-items-center">Completed</div>
                                            <div class="col-4 fw-bold text-green display-4 text-end">3</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 pb-2">
                                <div class="col-12 btn-draft">
                                    <a href="" class="btn w-100">
                                        <div class="row align-items-center">
                                            <div class="col-8 text-yellow text-start btn-text avatar-text fw-bold d-flex align-items-center">Draft</div>
                                            <div class="col-4 fw-bold text-yellow display-4 text-end">2</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 pb-2">
                                <div class="col-12 btn-cancelled">
                                    <a href="" class="btn w-100">
                                        <div class="row align-items-center">
                                            <div class="col-8 text-primary text-start btn-text avatar-text fw-bold d-flex align-items-center">Cancelled</div>
                                            <div class="col-4 fw-bold text-primary display-4 text-end">1</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5 px-4">
                            <div class="col-12">
                                <h4 class="display-6 lh-base fw-bold pb-3">Saved Sessions</h4>
                            </div>
                            <div id="datatable" class="col-12 table-responsive">
                                <table class="table table-striped" id="agentTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Transaction ID</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer ID</th>
                                            <th scope="col">Last Saved</th>
                                            <th scope="col">Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>01234</td>
                                            <td>Customer Abc</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Restore</a></td>
                                            <td><a href="" class="btn btn-sm"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>09584</td>
                                            <td>Customer M</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Restore</a></td>
                                            <td><a href="" class="btn btn-sm"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>07392</td>
                                            <td>Customer Zee</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Restore</a></td>
                                            <td><a href="" class="btn btn-sm"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Restore</a></td>
                                            <td><a href="" class="btn btn-sm"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a></td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>03654</td>
                                            <td>Customer Az</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Restore</a></td>
                                            <td><a href="" class="btn btn-sm"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a></td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>05673</td>
                                            <td>Customer Lum</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm">Restore</a></td>
                                            <td><a href="" class="btn btn-sm"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row py-5 px-4">
                            <div class="col-12">
                                <h4 class="display-6 lh-base fw-bold pb-3">Tutorials</h4>
                            </div>
                            <div class="col-4">
                                <div class="col-12">
                                    <img src="{{ asset('images/dashboard/home-screenshot.jpg') }}" width="100%" height="auto" alt="Home" class="tutorial">
                                </div>
                                <div class="col-12 py-3">
                                    <h4 class="display-6 lh-base fw-bold">Introduction of Generali App</h4>
                                    <p class="text-gray">01 March 2024</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12">
                                    <img src="{{ asset('images/dashboard/instructions-screenshot.jpg') }}" width="100%" height="auto" alt="Home" class="tutorial">
                                </div>
                                <div class="col-12 py-3">
                                    <h4 class="display-6 lh-base fw-bold">How to use Generali App</h4>
                                    <p class="text-gray">01 March 2024</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12">
                                    <img src="{{ asset('images/dashboard/customer-screenshot.jpg') }}" width="100%" height="auto" alt="Home" class="tutorial">
                                </div>
                                <div class="col-12 py-3">
                                    <h4 class="display-6 lh-base fw-bold">Get to know your customer</h4>
                                    <p class="text-gray">01 March 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection