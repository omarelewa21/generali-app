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
                                {{-- <a href="{{ route('forms.create', ['new' => true]) }}">Create New Form</a> --}}
                                <a href="{{ route('welcome',['new' => true]) }}" class="btn btn-secondary btn-create fw-bold">Create New Transaction</a>
                            </div>
                        </div>
                        <div class="row px-4 pt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="avatar-text fw-bold pb-3">Overview</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="status-btn btn btn-danger btn-sm" onclick="updateText('ALL')" data-url="{{ route('agent.index', ['status' => 'all']) }}">Reset</button>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-12 col-lg-4 pb-2">
                                <div class="col-12 btn-tick">
                                    <a id="completedBtn"  class="btn w-100 status-btn" onclick="updateText('Completed')" data-url='{{ route('agent.index', ['status' => 'completed']) }}'>
                                        <div class="row align-items-center">
                                            <div class="col-8 text-green text-start btn-text avatar-text fw-bold d-flex align-items-center">Completed</div>
                                            <div class="col-4 fw-bold text-green display-4 text-end">{{ $completedCount }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 pb-2">
                                <div class="col-12 btn-draft">
                                    <a id="draftBtn"  class="btn w-100 status-btn" onclick="updateText('Draft')" data-url='{{ route('agent.index', ['status' => 'draft']) }}'>
                                        <div class="row align-items-center">
                                            <div class="col-8 text-yellow text-start btn-text avatar-text fw-bold d-flex align-items-center">Draft</div>
                                            <div class="col-4 fw-bold text-yellow display-4 text-end">{{ $draftCount }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 pb-2">
                                <div class="col-12 btn-cancelled">
                                    <a id="cancelledBtn" class="btn w-100 status-btn" onclick="updateText('Cancelled')" data-url='{{ route('agent.index', ['status' => 'cancelled']) }}'>
                                        <div class="row align-items-center">
                                            <div class="col-8 text-primary text-start btn-text avatar-text fw-bold d-flex align-items-center">Cancelled</div>
                                            <div class="col-4 fw-bold text-primary display-4 text-end">{{ $cancelledCount }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="display-6 lh-base fw-bold pb-3">Saved Sessions</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-end">
                                        <p id="statusText" class="text-justify">Current View: ALL</p>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div id="datatable" class="col-12 table-responsive">
                                <div class="card-body">{!! $dataTable->table() !!}</div>
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

@push('scripts')
     {!! $dataTable->scripts() !!}

     <script>

        $('.status-btn').on('click', function () {
            var url = $(this).data('url'); // Assuming you use a data attribute to store the status
            // console.log('Button clicked with status:', status);
            // $(this).prop('disabled', true);
            filterData(url);
        });
    
    
        function filterData(url) {
            $("#sessions-table").DataTable().ajax.url(url).load();
        }

        // let viewName = 'Default'; // Set the default value


        function updateText(viewName) {
            $('#statusText').text('Current View: ' + viewName);
        }
     </script>
@endpush