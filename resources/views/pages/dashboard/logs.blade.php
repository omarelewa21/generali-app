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

<div id="dashboard_logs">
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
                                <h3 class="avatar-text fw-bold pb-3">Transaction Logs</h3>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-12">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Transaction ID</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer ID</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Modified</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01234</td>
                                            <td>Customer Abc</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>09584</td>
                                            <td>Customer M</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>07392</td>
                                            <td>Customer Zee</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2023-10-30</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
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