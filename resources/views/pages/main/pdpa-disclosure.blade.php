<?php
 /**
 * Template Name: PDPA Disclosure Page
 */
?>

@extends('templates.master')

@section('title')
<title>PDPA Disclosure</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $transactionId ??= request()->input('transaction_id');
@endphp

<div id="pdpa">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 bg-primary sidebanner">
                <div class="navbar-scroll fixed-top px-md-0 px-3">
                    @include('templates.nav.nav-white')
                    <div class="text-white px-4 px-xl-5 fixed-sm-top bg-primary">
                        <h2 class="display-5 fw-bold py-3 px-md-0 px-3">To begin, may we have permission to collect or use your personal details?</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 bg-accent-bg-grey px-0 vh-100 content-section">
                <section class="main-content">
                    <div class="container">
                        <div class="row pt-4 px-4 pb-2 pt-md-5 sticky-md-top bg-accent-bg-grey">
                            <div class="col-12">
                                <h1 class="display-5 text-uppercase">DATA PROTECTION STATEMENT</h1>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-12">
                                <p>Your privacy is important to us. The Company is committed to ensure that your personal data under our care is safe and secured. We will ensure that your information collected via this application and any other information that you may provide to the Company is used for the purposes of purchasing an insurance policy including but not limited to underwriting and administering your plan; processing service request; processing claims; complying with all applicable laws; conducting due diligence; performing our functions as an insurance company and such other purposes referred to in our Personal Data Policy. For further details on how we collect, process, share and retain your personal data, please refer to our website at <a href="https://www.generali.com.my/" target="_blank">www.generali.com.my</a></p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <a id="declineButton" href="{{ route('welcome') }}" class="btn btn-secondary flex-fill me-md-2">DECLINE</a>
                                <a id="acceptButton" href="{{ route('basic.details',['transaction_id' => $transactionId]) }}" class="btn btn-primary flex-fill">ACCEPT</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.getElementById("declineButton").addEventListener("click", function() {
        pdpa("Declined");
    });

    document.getElementById("acceptButton").addEventListener("click", function() {
        pdpa("Accepted");
    });

    function pdpa(decision, route) {
        $.ajax({
            type: "POST",
            url: "{{ route('pdpa.disclosure',['transaction_id' => $transactionId]) }}",
            data: { decision: decision, route: route },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Handle success, if needed
            },
            error: function(xhr, status, error) {
                // Handle error, if needed
            }
        });
    }
});
</script>

@endsection