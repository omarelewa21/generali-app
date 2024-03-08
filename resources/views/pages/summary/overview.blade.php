<?php
 /**
 * Template Name: Financial Statement - Overview Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Financial Statement - Overview</title>
@endsection

@section('content')
@php
    // Retrieving values from the session
    $all_needs = session('customer_details.selected_needs');
@endphp

<div id="overview">
    <div class="container-fluid">
        <div class="row wrapper-overview">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red')</div></div>
            <section class="content h-100 overflow-auto">
                <div class="container">
                    <div class="row">
                        <div class="col-12 px-xl-5 pb-4">
                            <h2 class="display-5 fw-bold lh-base">Overview of Financial Needs & Priorities</h2>
                        </div>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-4 col-xl-3 col-6 ps-xl-5 py-4 py-xl-0 pb-2">
                            <h4 class="display-6 fw-bold lh-base">Rank</h4>
                        </div>
                        <div class="col-md-8 col-xl-9 col-6 pe-xl-5 py-4 py-xl-0 pb-2">
                            <h4 class="display-6 fw-bold lh-base">Coverage Completion %</h4>
                        </div>
                        @php
                            $count = 0; 
                            $need_title = '';
                            $chart_color = '';
                            $chart_percent = '';
                        @endphp
                        @if ($all_needs)
                            @foreach($all_needs as $need)
                                @php
                                    if(isset($need['need_no'])){
                                        switch($need) {
                                            case 'N1':
                                                $need_title = 'Protection';
                                                $chart_color = '#C0232C';
                                                break;
                                            case 'N2':
                                                $need_title = 'Retirement';
                                                $chart_color = '#14A38B';
                                                break;
                                            case 'N3':
                                                $need_title = 'Education';
                                                $chart_color = '#F2AC57';
                                                break;
                                            case 'N4':
                                                $need_title = 'Regular Savings';
                                                $chart_color = '#B3222A';
                                                break;
                                            case 'N5':
                                                $need_title = 'Lump Sum Investment';
                                                $chart_color = '#0880AE';
                                                break;
                                            case 'N6':
                                                $need_title = 'Health & Medical';
                                                $chart_color = '#FD5B5B';
                                                break;
                                            case 'N7':
                                                $need_title = 'Debt Cancellation';
                                                $chart_color = '#CCCCCC';
                                                break;
                                            default:
                                                $need_title = '';
                                                $chart_color = '';
                                        }
                                        if ($need['need_no'] == 'N6'){
                                            if(isset($need['number_of_selection']) && ($need['number_of_selection'] == 2 || ($need['advance_details']['critical_illness']['critical_illness_plan'] == 'Critical Illness' || $need['advance_details']['health_care']['medical_care_plan'] ) == 'Health Planning' ) ){
                                                if (isset($need['advance_details']['critical_illness']['fund_percentage']) || isset($need['advance_details']['health_care']['fund_percentage']) ){
                                                    $chart_percent = ($need['advance_details']['critical_illness']['fund_percentage'] + $need['advance_details']['health_care']['fund_percentage']) / 2;
                                                }
                                                
                                            }
                                        } else{
                                            if (isset($need['advance_details']['fund_percentage'])){
                                                $chart_percent = $need['advance_details']['fund_percentage'];
                                            }
                                        }
                                    }
                                    $count++;
                                @endphp
                                <div class="col-md-4 col-xl-3 col-6 ps-xl-5 py-2 my-2 d-flex align-items-center">
                                    <h4 class="display-6 fw-bold lh-base m-0">{{$count}}. {{ $need_title }}</h4>
                                </div>
                                <div class="col-md-8 col-xl-9 col-6 pe-xl-5 my-auto py-2 my-2">
                                    <div class="row justify-content-center">
                                        <div class="col-12 d-flex align-items-center">
                                            <!-- <div class="bar_chart_wrapper"> -->
                                                <div class="bar_chart_value" role="progressbar" style="width:{{$chart_percent}}%; background:{{ $chart_color }};" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            <!-- </div> -->
                                            <p class="display-6 fw-bold lh-base m-0 px-3">{{round(floatval($chart_percent))}}%</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row pt-3">
                        <div class="col-12 px-xl-5">
                            <hr style="color:#A0A0A0;">
                        </div>
                        <div class="col-12 px-xl-5 pt-4">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h2 class="display-5 fw-bold lh-base">Summary of needs</h2>
                                </div>
                            </div>
                            <div class="row pt-4 pb-md-5 pb-xl-0 table-wrapper">
                                <div class="col-12 overflow-x-auto">
                                    <table id="overview-table" class="w-100">
                                        <thead class="text-grey">
                                            <tr>
                                                <th>My Priorities</th>
                                                <th>For My</th>
                                                <th>Goals</th>
                                                <th>Existing Plans</th>
                                                <th>Coverage Needed</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold display-6 f-family">
                                            @if ($all_needs)
                                                @foreach($all_needs as $need)
                                                    @php
                                                    $icon = '';
                                                    $needs = '';
                                                    $coverage_person = '';
                                                    $supporting_years = '';
                                                    $goals = '';
                                                    $existing_plan = '';
                                                    $gap = '';
                                                    switch($need['need_no']) {
                                                        case 'N1':
                                                            $icon = 'protection';
                                                            $needs = 'Protection';
                                                            break;
                                                        case 'N2':
                                                            $icon = 'retirement';
                                                            $needs = 'Retirement';
                                                            break;
                                                        case 'N3':
                                                            $icon = 'education';
                                                            $needs = 'Education';
                                                            break;
                                                        case 'N4':
                                                            $icon = 'savings';
                                                            $needs = 'Regular Savings';
                                                            break;
                                                        case 'N5':
                                                            $icon = 'investment';
                                                            $needs = 'Lump Sum Investment';
                                                            break;
                                                        case 'N6':
                                                            $icon = 'medical';
                                                            break;
                                                        case 'N7':
                                                            $icon = 'debt';
                                                            $needs = 'Debt Cancellation';
                                                            break;
                                                        default:
                                                            $icon = '';
                                                            $needs = '';
                                                    }
                                                    if (isset($need)){
                                                        if($need['need_no'] == 'N6'){
                                                        }
                                                        else{
                                                            if(isset($need['advance_details']['relationship']) && $need['advance_details']['relationship'] == 'Spouse'){
                                                                $coverage_person = $need['advance_details']['spouse_name'];
                                                            } else if(isset($need['advance_details']['relationship']) && $need['advance_details']['relationship'] == 'Child'){
                                                                $coverage_person = $need['advance_details']['child_name'];
                                                            } else{
                                                                if (isset($need['advance_details']['relationship'])){
                                                                    $coverage_person = $need['advance_details']['relationship'];
                                                                }
                                                            }
                                                            if(isset($need['advance_details']['goals_amount']) || isset($need['advance_details']['existing_amount']) || isset($need['advance_details']['insurance_amount'])){
                                                                if($need['need_no'] == 'N4' || $need['need_no'] == 'N5'){
                                                                    $existing_plan = 'N/A';
                                                                } else{
                                                                    $existing_plan = $need['advance_details']['existing_amount'];
                                                                }
                                                                $goals = $need['advance_details']['goals_amount'];
                                                                $gap = $need['advance_details']['insurance_amount'];
                                                            } else {
                                                                $goals = 'N/A';
                                                                $existing_plan = 'N/A';
                                                                $gap = 'N/A';
                                                            }
                                                        }
                                                    }
                                                    @endphp
                                                    @if ( isset($need['need_no']) && $need['need_no'] == 'N6')
                                                        @if(isset($need['advance_details']['critical_illness']['critical_illness_plan']) && $need['advance_details']['critical_illness']['critical_illness_plan'] == 'Critical Illness')
                                                            <tr>
                                                                <td class="d-flex align-items-center py-3">
                                                                    <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.png') }}" height="100%" width="auto" class="me-3" alt="Health & Medical Icon">Health & Medical - Critical Illness Care
                                                                </td>
                                                                <td class="px-2">{{isset($need['advance_details']['critical_illness']['relationship']) && $need['advance_details']['critical_illness']['relationship'] == 'Spouse' ? 
                                                                        $need['advance_details']['critical_illness']['spouse_name'] : 
                                                                    (isset($need['advance_details']['critical_illness']['relationship']) && $need['advance_details']['critical_illness']['relationship'] == 'Child' ? 
                                                                        $need['advance_details']['critical_illness']['child_name'] : 
                                                                    $need['advance_details']['critical_illness']['relationship']) }}
                                                                </td>
                                                                <td class="px-2">{{ isset($need['advance_details']['critical_illness']['goals_amount']) ? 
                                                                    'RM' . number_format(floatval($need['advance_details']['critical_illness']['goals_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="px-2">{{ isset($need['advance_details']['critical_illness']['existing_amount']) ? 
                                                                    'RM' . number_format(floatval($need['advance_details']['critical_illness']['existing_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="text-primary py-2">{{ isset($need['advance_details']['critical_illness']['insurance_amount']) ? 
                                                                    'RM' . number_format(floatval($need['advance_details']['critical_illness']['insurance_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if (isset($need['advance_details']['health_care']['medical_care_plan']) && $need['advance_details']['health_care']['medical_care_plan'] == 'Health Planning')
                                                            <tr>
                                                                <td class="d-flex align-items-center py-3">
                                                                    <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.png') }}" height="100%" width="auto" class="me-3" alt="Health & Medical Icon">Health & Medical - Medical Plan Care
                                                                </td>
                                                                <td class="px-2">{{ isset($need['advance_details']['health_care']['relationship']) && $need['advance_details']['health_care']['relationship'] == 'Spouse' ? 
                                                                        $need['advance_details']['health_care']['spouse_name'] : 
                                                                    (isset($need['advance_details']['health_care']['relationship']) && $need['advance_details']['health_care']['relationship'] == 'Child' ? 
                                                                        $need['advance_details']['health_care']['child_name'] : 
                                                                    $need['advance_details']['health_care']['relationship']) }}
                                                                </td>
                                                                <td class="px-2">{{ isset($need['advance_details']['health_care']['goals_amount']) ? 
                                                                    'RM' . number_format(floatval($need['advance_details']['health_care']['goals_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="px-2">{{ isset($need['advance_details']['health_care']['existing_amount']) ? 
                                                                    'RM' . number_format(floatval($need['advance_details']['health_care']['existing_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="text-primary px-2">{{ isset($need['advance_details']['health_care']['insurance_amount']) ? 
                                                                    'RM' . number_format(floatval($need['advance_details']['health_care']['insurance_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @elseif(isset($need['need_no']) && $need['need_no'] == 'N8')   
                                                    @else
                                                        <tr>
                                                            <td class="d-flex align-items-center py-3">
                                                                <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.png') }}" height="100%" width="auto" class="me-3" alt="{{$needs}} Icon">{{$needs}}
                                                            </td>
                                                            <td class="px-2">{{$coverage_person}}</td>
                                                            <td class="px-2">{{ $goals == 'N/A' ? $goals : 'RM' . number_format(floatval($goals))}}</td>
                                                            <td class="px-2">{{ $existing_plan == 'N/A' ? $existing_plan : 'RM' . number_format(floatval($existing_plan))}}</td>
                                                            <td class="text-primary px-2">{{ $gap == 'N/A' ? $gap : 'RM' . number_format(floatval($gap))}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer bg-white py-4 fixed-bottom footer-scroll">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex px-4 d-none d-sm-flex">
                            <a href="#" class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#emailSummary">Email me</a>
                            <a href="{{route('summary')}}" class="btn btn-secondary ms-auto me-md-2 text-uppercase">Back</a>
                            <a href="#" class="btn btn-primary me-md-2 text-uppercase" data-bs-toggle="modal" data-bs-target="#endSession">Submit</a>
                        </div>
                        <div class="col-12 d-sm-none mb-3 px-4"><a href="#" class="btn btn-primary w-100 text-uppercase" data-bs-toggle="modal" data-bs-target="#emailSummary">Email me</a></div>
                        <div class="col-12 d-flex gap-2 d-sm-none text-end px-4">
                            <a href="{{route('summary')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                            <a href="#" class="btn btn-primary me-md-2 text-uppercase" data-bs-toggle="modal" data-bs-target="#endSession">Submit</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="emailSummary" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emailSummaryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4">
                <h3 class="modal-title f-family fw-bold f-34 text-center" id="emailSummaryLabel">Thank you for securing your future with us!</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>We’ve sent you an email summarising your priorities and the coverage needed for your journey ahead.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="endSession" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="endSessionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4">
                <h3 class="modal-title f-family fw-bold f-34 text-center" id="endSessionLabel">Thank you for sharing your needs and priorities!</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Our advisors are now ready to guide you on how you can best secure your future.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">End session</button> -->
                <a href="{{route('welcome')}}" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" type="button" id="saveSession" data-clear-route="{{ route('clear_session_data') }}">End session</a>
            </div>
        </div>
    </div>
</div>

@endsection