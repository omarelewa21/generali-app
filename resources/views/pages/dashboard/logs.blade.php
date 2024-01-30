<?php
 /**
 * Template Name: Agent Dashboard Page
 */
?>

@extends('templates.master')

@section('title')
<title>Agent Dashboard</title>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" /> --}}
  
{{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}

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
                                <div style="float: right;" id="user-button"></div>
                            </div>
                        </div>
                        <div class="row px-4 pt-5">
                            <div class="col-12">
                                <h3 class="avatar-text fw-bold pb-3">Transaction Logs</h3>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-12">
                                <div class="d-grid gap-2 col-2">
                                    <button class="btn btn-sm btn-secondary fw-bold btn-sm my-3 py-2" type="button" id="buttonAdvanced" data-bs-toggle="modal" data-bs-target="#advancedSearch"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="advancedSearch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="d-flex justify-content-end px-3 py-3">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-header px-4 py-0 justify-content-center">
                                                <h3 class="modal-title fs-4 text-center" id="missingFieldsLabel">Search</h2>
                                            </div>
                                            <div class="modal-body text-dark text-center px-5 pb-5 pt-4 d-flex justify-content-center">
                                                <div style="width:90%">
                                                    <div class="row py-2 align-items-center">
                                                        <div class="col-md-5 text-start">
                                                            <label for="searchTransaction" class="form-label m-0">Entry ID</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" id="searchTransaction" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 align-items-center">
                                                        <div class="col-md-5 text-start">
                                                            <label for="searchName" class="form-label m-0">Customer Name</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" id="searchName" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 align-items-center">
                                                        <div class="col-md-5 text-start">
                                                            <label for="searchID" class="form-label m-0">Customer ID</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" id="searchID" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 align-items-center">
                                                        <div class="col-md-5 text-start">
                                                            <label for="searchStatus" class="form-label m-0">Status</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select name="searchStatus" class="form-select" aria-label="Status" id="searchStatus">
                                                                <option value="">All</option>
                                                                <option value="completed">Completed</option>
                                                                <option value="draft">Draft</option>
                                                                <option value="cancelled">Cancelled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 align-items-center">
                                                        <div class="col-md-5 text-start">
                                                            <label for="min" class="form-label m-0">From Date</label>
                                                        </div>
                                                        <div class="col-md-7 position-relative">
                                                            <input type="text" id="min" name="min" class="form-control">
                                                            <i class="field-icon fa-solid fa-calendar-days"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 align-items-center">
                                                        <div class="col-md-5 text-start">
                                                            <label for="max" class="form-label m-0">To Date</label>
                                                        </div>
                                                        <div class="col-md-7 position-relative">
                                                            <input type="text" id="max" name="max" class="form-control">
                                                            <i class="field-icon fa-solid fa-calendar-days"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal" id="resetButton">Reset</button>
                                                <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal" id="submitButton" onclick="filterDataTable()">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="datatable" class="col-12 table-responsive">
                                    <div class="card-body">{!! $dataTable->table() !!}</div>
                                </div>
                                {{-- <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Entry ID</th>
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
                                            <td>2008-11-28</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>09584</td>
                                            <td>Customer Mat</td>
                                            <td>999999-14-5378</td>
                                            <td class="text-green">Completed</td>
                                            <td>2009-01-12</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>07392</td>
                                            <td>Customer Zee</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2008-12-16</td>
                                            <td>2023-10-29</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2008-12-19</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-green">Completed</td>
                                            <td>2008-12-13</td>
                                            <td>2023-10-30</td>
                                            <td><a href="http://127.0.0.1:8000/basic-details" class="btn btn-primary btn-sm w-100">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>02849</td>
                                            <td>Customer Phg</td>
                                            <td>999999-14-9999</td>
                                            <td class="text-primary">Cancelled</td>
                                            <td>2008-12-11</td>
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
                                </table> --}}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    
    <!-- Use CDN for jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    
    {!! $dataTable->scripts() !!}

    <script>
    function filterDataTable(withData = true)
    {
        if(!withData){
            return $("#transactionlogs-table").DataTable().ajax.url(window.location.href).load();
        }

        var data = $('#advancedSearch :input').map(function() {
            return {name: this.id, value: this.value};
        }).get();

        var url = window.location.href + '?' + $.param(data);

        return $("#transactionlogs-table").DataTable().ajax.url(url).load();
    }

    function initializeMinMax()
    {
        minDate = new DateTime('#min', {
                    format: 'YYYY-MM-DD'
        });

        maxDate = new DateTime('#max', {
            format: 'YYYY-MM-DD'
        });
    }

    $(document).ready(function () {
        initializeMinMax();
        $('#advancedSearch input.dt-datetime').on('change',function(){
            filterDataTable();
        });

        $('#resetButton').on('click', function(){
           // clear all input and select tag and load the table again
            $(":input").val('');  
            $("select").change();
            filterDataTable(false);
        });     
    });
    </script>
@endpush
