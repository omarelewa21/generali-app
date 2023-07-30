<?php
 /**
 * Template Name: Top Priorities Page
 */
?>

@extends('templates.master')

@section('title')
<title>Top Priorities</title>
@endsection

@section('content')

@include('templates.nav.nav-red-menu')

<div id="top_priorities" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default pt-4 overflow-auto">
                    <div class="col-12 text-center">
                        <h4 class="fw-bold">Here's how I see my priorities:</h4>

                        <div class="d-flex">
                            <ul id="sortable-list-1">
                                <li><span class="drag-handle">Drag me</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="108" height="167" viewBox="0 0 152 167" fill="none">
                                        <path d="M151.489 147.333C118.661 147.333 87.4099 154.078 59.0512 166.266L0.950684 30.6854C47.1751 10.9411 98.0516 0 151.477 0V147.333H151.489Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="60%" y="50%" text-anchor="middle" dominant-baseline="middle" font-size="64" fill="#707070" font-family="Helvetica Neue" font-weight="bold" opacity="0.5">4</text>
                                    </svg>
                                </li>
                                <li><span class="drag-handle">Drag me</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="134" height="191" viewBox="0 0 187 191" fill="none">
                                        <path d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="55%" y="55%" text-anchor="middle" dominant-baseline="middle" font-size="64" fill="#707070" font-family="Helvetica Neue" font-weight="bold" opacity="0.5">3</text>
                                    </svg>
                                </li>
                                <li><span class="drag-handle">Drag me</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="138" height="180" viewBox="0 0 190 180" fill="none">
                                        <path d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" text-anchor="middle" dominant-baseline="middle" font-size="64" fill="#707070" font-family="Helvetica Neue" font-weight="bold" opacity="0.5">2</text>
                                    </svg>
                                </li>
                                <li><span class="drag-handle">Drag me</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="138" viewBox="0 0 166 138" fill="none">
                                        <path d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" text-anchor="middle" dominant-baseline="middle" font-size="64" fill="#707070" font-family="Helvetica Neue" font-weight="bold" opacity="0.5">1</text>
                                    </svg>
                                </li>
                            </ul>
                        </div>

                        <ul id="sortable-list-2">
                            <li><span class="drag-handle">Drag me</span>Item 1</li>
                            <li><span class="drag-handle">Drag me</span>Item 2</li>
                            <li><span class="drag-handle">Drag me</span>Item 3</li>
                        </ul>

                        


                        
                        <img src="{{ asset('/images/top-priorities/priorities-grid.png') }}" width="500px" class="mx-auto d-block pt-4" alt="">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white fw-bold pb-3">What are your top financial priorities?</h1>
                                    <p class="text-white display-6">Select your priorities by first to last.</p>
                                </div>
                            </div>
                            <div class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="protection" data-required="">
                                            <img src="{{ asset('images/top-priorities/protection-icon.png') }}" width="auto" height="100px" alt="Protection">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Protection</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="retirement" data-required="">
                                            <img src="{{ asset('images/top-priorities/retirement-icon.png') }}" width="auto" height="100px" alt="Retirement">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Retirement</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="education" data-required="">
                                            <img src="{{ asset('images/top-priorities/education-icon.png') }}" width="auto" height="100px" alt="Education">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Education</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="savings" data-required="">
                                            <img src="{{ asset('images/top-priorities/savings-icon.png') }}" width="auto" height="100px" alt="Savings">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Savings</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="debt-cancellation" data-required="">
                                            <img src="{{ asset('images/top-priorities/debt-cancellation-icon.png') }}" width="auto" height="100px" alt="Debt Cancellation">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Debt Cancellation</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="health-medical" data-required="">
                                            <img src="{{ asset('images/top-priorities/health-medical-icon.png') }}" width="auto" height="100px" alt="Health & Medical">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Health & Medical</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="investments" data-required="">
                                            <img src="{{ asset('images/top-priorities/investments-icon.png') }}" width="auto" height="100px" alt="Investments">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Investments</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="others" data-required="">
                                            <img src="{{ asset('images/top-priorities/others-icon.png') }}" width="auto" height="100px" alt="Others">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                    <a href="{{route('avatar.my.assets')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('priorities.to.discuss') }}" class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
        /* Custom CSS to style the list items with the SVG background */
        /* ol {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #A0A0A0;
            border-radius: 5px;
            margin-bottom: 10px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        .shape-1 {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='166' height='138' viewBox='0 0 166 138' fill='none'%3E%3Cpath d='M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z' fill='%23F2F2F2' stroke='%23A0A0A0' stroke-dasharray='8 6'/%3E%3C/svg%3E");
        }

        .shape-2 {
            background-image: url("data:image/svg+xml;charset=utf-8,...");
        } */

#sortable-list-1 {
    list-style: none;
}

#sortable-list-1 li:nth-child(1) {
  transform: translate(163px, 357px);
}
#sortable-list-1 li:nth-child(2) {
  transform: translate(85px, 209px);
}
#sortable-list-1 li:nth-child(3) {
  transform: translate(27px, 83px);
}


</style>
@endsection