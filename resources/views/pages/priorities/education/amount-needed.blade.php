<?php
 /**
 * Template Name: Education - Amount Needed
 */
?>

@extends('templates.master')

@section('title')
    <title>Education - Amount Needed</title>
@endsection

@section('content')

@php
    $educationPriority = session('customer_details.priorities.education_discuss');
    $tertiaryEducationAmount = session('customer_details.selected_needs.need_3.advance_details.covered_amount');
    $totalEducationYear = session('customer_details.selected_needs.need_3.advance_details.remaining_years');
    $educationSavingAmount = session('customer_details.selected_needs.need_3.advance_details.existing_amount');
    $totalEducationNeeded = session('customer_details.selected_needs.need_3.advance_details.goals_amount','0');
    $educationFundPercentage = session('customer_details.selected_needs.need_3.advance_details.fund_percentage', '0');
    $relationship = session('customer_details.selected_needs.need_3.advance_details.relationship');

    $gender = session('customer_details.avatar.gender', 'Male');
    $skintone = session('customer_details.avatar.skin_tone', 'white');
@endphp

<div id="education-amount-needed" class="tertiary-default-bg calculator-page">
    <div class="container-fluid">
        <div class="row wrapper-bottom-grey">
            <div class="header col-12">
                <div class="row calculatorMenuMob">@include('templates.nav.nav-red-menu-needs')</div>
                <div class="bg-primary row d-md-none calculatorMob align-items-center">
                    <div class="col-6">   
                        <h1 id="TotalEducationFundMob" class="display-3 text-uppercase text-white overflow-hidden ps-4 text-nowrap my-2">RM{{ 
                            $educationSavingAmount === null || $educationSavingAmount === '' 
                                ? number_format(floatval($totalEducationNeeded)) 
                                : ($educationSavingAmount > floatval($totalEducationNeeded) 
                                ? '0' 
                                : number_format(floatval($totalEducationNeeded) - floatval($educationSavingAmount)))
                            }}
                        </h1>
                    </div>
                    <div class="col-6 m-auto">
                        <p class="text-white display-6 lh-base text-end pe-4 m-0">Total Education Fund Needed</p>
                    </div>
                </div>
            </div>
            <form novalidate action="{{route('validate.education.amount.needed')}}" method="POST" class="content-needs-grey">
                @csrf
                <div class="top-menu pt-md-0 py-3">@include ('templates.nav.nav-sidebar-needs')</div>
                <section class="heading d-none d-md-block">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4 bg-primary calculation-progress-bar-wrapper">
                                <div class="calculation-progress mt-3 d-flex align-items-center">
                                    <div class="px-2 calculation-progress-bar" role="progressbar" style="width:{{$educationFundPercentage}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h1 id="TotalEducationFund" class="text-center display-3 text-uppercase text-white overflow-hidden text-nowrap">RM{{ 
                                    $educationSavingAmount === null || $educationSavingAmount === '' 
                                        ? number_format(floatval($totalEducationNeeded)) 
                                        : ($educationSavingAmount > floatval($totalEducationNeeded) 
                                        ? '0' 
                                        : number_format(floatval($totalEducationNeeded) - floatval($educationSavingAmount)))
                                    }}
                                </h1>
                                <p class="text-white display-6 lh-base text-center">Total Education Fund Needed</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bottom-content z-md-1">
                    <div class="container h-100 px-4 px-md-0">
                        <div class="row h-100">
                            <div class="col-md-6 h-100 d-flex justify-content-center align-items-end tertiary-mobile-bg">
                                @if(isset($gender) || isset($skintone))
                                    <div id="lottie-animation" class="w-auto h-100"></div>
                                @else
                                    <img src="{{ asset('images/needs/education/amount-needed/avatar.png') }}" width="auto" height="100%" alt="Education Amount Needed Avatar">
                                @endif
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 py-lg-5 pt-4 calculatorContent">
                                <div class="row h-sm-100">
                                    <h2 class="display-5 fw-bold lh-sm">I plan to build an education fund of</h2>
                                    <p class="display-5 fw-bold currencyField">
                                        <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" name="tertiary_education_amount" class="form-control fw-bold position-relative border-0 d-inline-block w-50 text-primary @error('tertiary_education_amount') is-invalid @enderror" id="tertiary_education_amount" value="{{ $tertiaryEducationAmount !== null ? number_format(floatval($tertiaryEducationAmount)) : $tertiaryEducationAmount }}" required></span>
                                    over the next
                                        <span class="text-primary fw-bold border-bottom border-dark border-3"><input type="number" name="tertiary_education_years" class="form-control fw-bold position-relative border-0 d-inline-block w-25 text-center text-primary @error('tertiary_education_years') is-invalid @enderror" id="tertiary_education_years" value="{{$totalEducationYear}}" required></span>
                                    years.</p>
                                    <input type="hidden" name="total_educationNeeded" id="total_educationNeeded" value="{{$totalEducationNeeded}}">
                                    <a href="#" class="btn btn-primary text-uppercase mt-4 w-auto" data-bs-toggle="modal" data-bs-target="#tuitionFees">View Tuition Cost Guide</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="footer fixed-bottom">
                    @if ($errors->has('tertiary_education_amount') || $errors->has('tertiary_education_years'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 alert alert-danger d-flex justify-content-center align-items-center py-2 m-0 rounded-0" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="text">{{ $errors->first('tertiary_education_amount') }} {{ $errors->first('tertiary_education_years') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white py-4 footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('education.coverage')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="footer-avatar-grey d-none d-md-block"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="missingLastPageInputFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingLastPageInputFieldsLabel">You're required to enter previous value before you proceed to this page.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input the value in previous page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tuitionFees" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4">
                <h3 class="modal-title fs-4 text-uppercase" id="tuitionFeesLabel">University Tuition Cost Guide</h2>
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar border-0" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                        <g clip-path="url(#clip0_7018_11324)">
                            <path d="M30.9995 6.06306e-05L-0.000472034 31.752" stroke="#C21B17" stroke-width="3"/>
                            <path d="M0 0L31 31.7519" stroke="#C21B17" stroke-width="3"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_7018_11324">
                            <rect width="31" height="30.7597" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
            <!-- <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input the value in previous page first.</p>
            </div> -->
            <div class="modal-footer text-white justify-content-start">
                <div class="container px-5 py-4">
                    <table class="table table-bordered mb-4" id="costingTable">
                        <thead>
                            <tr>
                                <th scope="col">Country</th>
                                <th scope="col">Accounting</th>
                                <th scope="col">Computer Science</th>
                                <th scope="col">Engineering</th>
                                <th scope="col">Medical & Surgery</th>
                                <th scope="col">Biotechnology</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Malaysia</th>
                                <td>RM101,000</td>
                                <td>RM95,000</td>
                                <td>RM124,000</td>
                                <td>RM500,000</td>
                                <td>RM102,500</td>
                            </tr>
                            <tr>
                                <th scope="row">Singapore</th>
                                <td>RM220,000</td>
                                <td>RM190,000</td>
                                <td>RM200,000</td>
                                <td>RM1,200,000</td>
                                <td>RM250,000</td>
                            </tr>
                            <tr>
                                <th scope="row">Australia</th>
                                <td>RM460,000</td>
                                <td>RM670,000</td>
                                <td>RM670,000</td>
                                <td>RM1,180,000</td>
                                <td>RM504,000</td>
                            </tr>
                            <tr>
                                <th scope="row">US</th>
                                <tD>RM560,000</td>
                                <td>RM600,000</td>
                                <td>RM580,000</td>
                                <td>RM1,500,000</td>
                                <td>RM560,000</td>
                            </tr>
                            <tr>
                                <th scope="row">UK</th>
                                <td>RM380,000</td>
                                <td>RM460,000</td>
                                <td>RM470,000</td>
                                <td>RM1,200,000</td>
                                <td>RM470,000</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Remark:-</p>
                    <p>This Degree education cost is based on average cost of few selected Foreign Universities.</p>
                    <p>Cost based on Exchange rate of 1 USD = RM 4.65.</p>
                    <p>The information is extracted from publicly available sources and is considered to be true and correct at the date of publication 2023.</p>
                    <p>Changes in circumstances after the time of publication may impact the accuracy of the information.</p>
                </div>
                <!-- <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    var needs_priority = '{{json_encode($educationPriority)}}';
    var lastPageInput = '{{$relationship}}';
    var genderSet = '{{$gender}}';
    var skintone = '{{$skintone}}';
    var gender = genderSet.toLowerCase();
</script>
@endsection