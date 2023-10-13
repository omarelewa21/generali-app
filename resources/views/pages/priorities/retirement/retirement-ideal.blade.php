<?php
 /**
 * Template Name: Retirement Ideal Page
 */
?>

@extends('templates.master')

@section('title')
<title>Retirement - Ideal</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
    $retirementIdeal = isset($arrayData['retirement']['retirementIdeal']) ? $arrayData['retirement']['retirementIdeal'] : '';
@endphp

<div id="retirement-ideal" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 vh-100 wrapper-needs-coverage-default">
                <section class="header-needs-default">
                    <div class="col-lg-6 col-md-12">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                </section>
                <form novalidate action="{{route('validate.retirement.ideal')}}" method="POST" class="content-needs-default m-0">
                    @csrf
                    <section class="overflow-auto overflow-hidden row content-block">
                        <div class="col-12 header-content-coverage">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <h4 class="f-34 f-family fw-700">My ideal retirement involves:</h4>
                            </div>
                        </div>
                        <div class="col-11 m-auto selection-content-coverage h-100 coverage_slick z-1">
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 w-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['retirement']['retirementIdeal']) && $arrayData['retirement']['retirementIdeal'] === 'retirement-travel') default @endif" id="retirement-travel" data-avatar="retirement-travel" data-required="">
                                    <img src="{{ asset('images/needs/retirement/ideal/Travel.png') }}" class="mh-100 m-auto coverage-image mw-100">
                                    <p class="py-2 my-0 mx-auto f-family fw-700 coverage-text w-75"><strong>Visiting destinations on my bucket list</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 w-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['retirement']['retirementIdeal']) && $arrayData['retirement']['retirementIdeal'] === 'retirement-lifestyle') default @endif" id="retirement-lifestyle" data-avatar="retirement-lifestyle" data-required="">
                                    <img src="{{ asset('images/needs/retirement/ideal/Lifestyle.png') }}" class="mh-100 m-auto coverage-image mw-100">
                                    <p class="py-2 my-0 mx-auto f-family fw-700 coverage-text w-75"><strong>Maintaining a comfortable lifestyle</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 w-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['retirement']['retirementIdeal']) && $arrayData['retirement']['retirementIdeal'] === 'retirement-savings') default @endif" id="retirement-savings" data-avatar="retirement-savings" data-required="">
                                    <img src="{{ asset('images/needs/retirement/ideal/Retire.png') }}" class="mh-100 m-auto coverage-image mw-100">
                                    <p class="py-2 my-0 mx-auto f-family fw-700 coverage-text w-75"><strong>Retiring early with secure finances</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 w-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayData['retirement']['retirementIdeal']) && $arrayData['retirement']['retirementIdeal'] === 'retirement-others') default @endif" id="retirement-others" data-avatar="retirement-others" data-required="">
                                    <img src="{{ asset('images/needs/retirement/ideal/Others.png') }}" class="mh-100 m-auto coverage-image mw-100">
                                </button>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('retirementIdealInput'))
                        <section class="row warning z-1">
                            <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('retirementIdealInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-white py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="retirementIdealInput" id="retirementIdealInput" value="{{$retirementIdeal}}">
                                    <a href="{{route('retirement.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection