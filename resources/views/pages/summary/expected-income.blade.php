<?php
 /**
 * Template Name: Financial Statement - Expected Income Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Expected Income</title>
@endsection

@section('content')

@php
    $selectedExpectingInput = session('customer_details.financialStatement.isChangeinAmount');
@endphp

<div id="expected_income" class="secondary-default-bg">
    <div class="container-fluid">
        <form novalidate action="{{route('validate.summary.expected.income')}}" method="POST">
             @csrf
            <div class="row wrapper-avatar">
                <div class="header-avatar col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
                <section class="top-avatar">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-6 pb-5">
                                <h2 class="display-5 fw-bold lh-base text-center">To be perfectly honest, I am expecting my income to change.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-12 d-flex justify-content-end">
                                    <!-- <a href="http://127.0.0.1:8000/gender" class="btn btn-primary text-uppercase btn-lg" style="z-index:1">Yes</a> -->
                                    <button class="btn btn-primary text-uppercase btn-summary d-flex justify-content-center align-items-center z-1 @if($selectedExpectingInput === 'Yes') default @endif" id="yesExpecting" data-avatar="Yes" data-required="">Yes</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Just keep this empty -->
                            </div>
                            <div class="col-md-4">
                                <div class="col-12 d-flex justify-content-start">
                                    <!-- <a href="http://127.0.0.1:8000/gender" class="btn btn-primary text-uppercase btn-lg" style="z-index:1">No</a> -->
                                    <button class="btn btm-no text-uppercase btn-summary d-flex justify-content-center align-items-center z-1 @if($selectedExpectingInput === 'No') default @endif" id="noExpecting" data-avatar="No" data-required="">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-avatar">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ asset('images/summary/avatar-open-hands.png') }}" height="100%" width="auto" alt="Expected Income">
                    </div>
                </section>
                <section class="footer fixed-bottom footer-scroll p-0">
                    @if ($errors->has('selectedExpectingInput'))
                        <div class="container-fluid warning">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('selectedExpectingInput') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="container-fluid cta bg-white py-4">
                        <div class="row">
                            <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                <input type="hidden" name="selectedExpectingInput" id="selectedExpectingInput" value="{{$selectedExpectingInput}}">
                                <a href="{{route('summary.monthly-goals')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                <!-- <a href="{{route('summary.increment-amount')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Next</a> -->
                                <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>

@endsection