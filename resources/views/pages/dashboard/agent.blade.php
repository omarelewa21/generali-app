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
            @include('templates.nav.nav-white')
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey px-0 content-section-agent">
                <section class="main-content pb-5">
                    <div class="container">
                        <div class="row pt-4 px-4 pb-4 sticky-md-top bg-accent-bg-grey">
                            <div class="col-8">
                                <h2 class="display-5 fw-bold lh-sm text-primary">Hi, Agent Lee</h2>
                                <p class="text-gray my-0">15428</p>
                            </div>
                            <div class="col-4 text-end">
                                <p class="text-gray">Last login: 2023-11-01 20:01:00</p>
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
                                            <td>01234</td>
                                            <td>Customer Abc</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">Restore</a></td>
                                            <td class="text-center">
                                                <div type="button" class="dropdown-options btn-group dropstart">
                                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>09584</td>
                                            <td>Customer M</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">Restore</a></td>
                                            <td class="text-center">
                                                <div type="button" class="dropdown-options btn-group dropstart">
                                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>07392</td>
                                            <td>Customer Zee</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">Restore</a></td>
                                            <td class="text-center">
                                                <div type="button" class="dropdown-options btn-group dropstart">
                                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">Restore</a></td>
                                            <td class="text-center">
                                                <div type="button" class="dropdown-options btn-group dropstart">
                                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03654</td>
                                            <td>Customer Az</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">Restore</a></td>
                                            <td class="text-center">
                                                <div type="button" class="dropdown-options btn-group dropstart">
                                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>05673</td>
                                            <td>Customer Lum</td>
                                            <td>999999-14-9999</td>
                                            <td>2023-11-01 20:01:00</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">Restore</a></td>
                                            <td class="text-center">
                                                <div type="button" class="dropdown-options btn-group dropstart">
                                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('images/general/icon-more.png') }}" width="auto" height="20px" alt="More Options"></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row py-5 px-4">
                            <div class="col-12">
                                <h4 class="display-6 lh-base fw-bold pb-3">Tutorials</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="col-12 position-relative d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('images/dashboard/play-icon.png') }}" width="50" height="auto" alt="Play Icon" class="position-absolute">
                                    <img src="{{ asset('images/dashboard/home-screenshot.jpg') }}" width="100%" height="auto" alt="Home" class="tutorial">
                                </div>
                                <div class="col-12 py-3">
                                    <h4 class="display-6 lh-base fw-bold">Introduction of Generali App</h4>
                                    <p class="text-gray">01 March 2024</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="col-12 position-relative d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('images/dashboard/play-icon.png') }}" width="50" height="auto" alt="Play Icon" class="position-absolute">
                                    <img src="{{ asset('images/dashboard/instructions-screenshot.jpg') }}" width="100%" height="auto" alt="Home" class="tutorial">
                                </div>
                                <div class="col-12 py-3">
                                    <h4 class="display-6 lh-base fw-bold">How to use Generali App</h4>
                                    <p class="text-gray">01 March 2024</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="col-12 position-relative d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('images/dashboard/play-icon.png') }}" width="50" height="auto" alt="Play Icon" class="position-absolute">
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