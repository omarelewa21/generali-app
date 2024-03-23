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

    // dd($all_needs);

    $healthCare = isset($all_needs[5]['advanceDetails']['health_care']) ? json_decode($all_needs['5']['advanceDetails']['health_care'],true) : NULL;
    $healthCarePercentage = $healthCare['fund_percentage'] ?? NULL;

    $critical_illness = isset($all_needs['5']['advanceDetails']['critical_illness']) ? json_decode($all_needs['5']['advanceDetails']['critical_illness'],true) : NULL;
    $criticalIllnessPercentage = $critical_illness['fund_percentage'] ?? NULL;

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
                            @foreach($all_needs as $needKey => $needValue)
                                @php
                                    if(isset($needValue)){
                                        switch($needValue['advanceDetails']['type']) {
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
                                                $need_title = 'Others';
                                                $chart_color = '';
                                                break;
                                        }
                                        if ($needValue['advanceDetails']['type'] == 'N6'){
                                            if(isset($all_needs[$needKey]['number_of_selection']) && ($all_needs[$needKey]['number_of_selection'] == 2 && ($all_needs[$needKey]['advance_details']['critical_illness']['critical_illness_plan'] == 'Critical Illness' || $all_needs[$needKey]['advance_details']['health_care']['medical_care_plan'] ) == 'Health Planning' ) ){
                                                if (isset($all_needs[$needKey]['advance_details']['critical_illness']['fund_percentage']) && isset($all_needs[$needKey]['advance_details']['health_care']['fund_percentage']) ){
                                                    $chart_percent = ($all_needs[$needKey]['advance_details']['critical_illness']['fund_percentage'] + $all_needs[$needKey]['advance_details']['health_care']['fund_percentage']) / 2;
                                                }
                                                
                                            }
                                        } else{
                                            if (isset($all_needs[$needKey]['advanceDetails']['fund_percentage']) || isset($all_needs[$needKey]['advanceDetails']['fund_percentage'])){
                                                $chart_percent = $all_needs[$needKey]['advanceDetails']['fund_percentage'] ?? $all_needs[$needKey]['advanceDetails']['fund_percentage'] ?? 0;
                                            }
                                            elseif (is_null($all_needs[$needKey]['advanceDetails']['fund_percentage'])) {
                                                $chart_percent = 0;
                                            }
                                        }
                                    }
                                    $count++;
                                @endphp
                                @if ($all_needs[$needKey]['advanceDetails']['type'] == 'N8')
                                @else
                                    <div class="col-md-4 col-xl-3 col-6 ps-xl-5 py-2 my-2 d-flex align-items-center">
                                        <h4 class="display-6 fw-bold lh-base m-0">{{$count}}. {{ $need_title }}</h4>
                                    </div>
                                    <div class="col-md-8 col-xl-9 col-6 pe-xl-5 my-auto py-2 my-2">
                                        <div class="row justify-content-center">
                                            <div class="col-12 d-flex align-items-center">
                                            <style>
                                                @keyframes progressAnimation-{{$loop->index}} {
                                                    from { width: 0%; }
                                                    to { width: {{$chart_percent}}%; }
                                                }
                                                .animate-{{$loop->index}} {
                                                    width: 0%;
                                                    animation: progressAnimation-{{$loop->index}} 1s ease-out;
                                                }
                                                /*  */
                                            </style>
                                                <div class="bar_chart_value animate-{{$loop->index}}" role="progressbar" style="width:{{$chart_percent}}%; background:{{ $chart_color }};transition: width 1s ease-out;" aria-valuenow="{{$chart_percent}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                <p class="display-6 fw-bold lh-base m-0 px-3">{{round(floatval($chart_percent))}}%</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="row pt-3">
                        <div class="col-12 px-xl-5">+
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
                                                @foreach($all_needs as $needKey => $needValue)
                                                    @php
                                                    $icon = '';
                                                    $needs = '';
                                                    $coverage_person = '';
                                                    $supporting_years = '';
                                                    $goals = '';
                                                    $existing_plan = '';
                                                    $gap = '';
                                                    switch($needValue['advanceDetails']['type']) {
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
                                                            $needs = 'Health & Medical';
                                                            break;
                                                        case 'N7':
                                                            $icon = 'debt';
                                                            $needs = 'Debt Cancellation';
                                                            break;
                                                        case 'N8':
                                                            $icon = 'others';
                                                            $needs = 'Others';
                                                            break;
                                                        default:
                                                            $icon = '';
                                                            $needs = '';
                                                    }
                                                    if (isset($needValue['advanceDetails']['type'])){
                                                        if($needValue['advanceDetails']['type'] == 'N6'){
                                                            
                                                           
                                                            if ( isset($healthCare['relationship']) &&  isset($critical_illness['relationship']) )                                                  
                                                            {
                                                                $coverage_person = $healthCare['spouse_name'] ??  $healthCare['child_name'] ."--". $critical_illness['spouse_name'] ?? $critical_illness['spouse_name'];
                                                            }
                                                            elseif (isset($healthCare['relationship']))
                                                            {
                                                                $coverage_person = $healthCare['spouse_name'] ?? $healthCare['child_name'] ?? NULL;
                                                            }
                                                            elseif (isset($critical_illness['relationship'])) 
                                                            {
                                                                $coverage_person =  $critical_illness['spouse_name'] ?? $critical_illness['child_name'] ?? NULL;
                                                            }
                                                            else {
                                                                $coverage_person = "N/A";
                                                            }
                                                        }
                                                        else{
                                                            if(isset($all_needs[$needKey]['advanceDetails']['relationship']) && $all_needs[$needKey]['advanceDetails']['relationship'] == 'Spouse'){
                                                                $coverage_person = $all_needs[$needKey]['advanceDetails']['spouse_name'];
                                                            } else if(isset($all_needs[$needKey]['advanceDetails']['relationship']) && $all_needs[$needKey]['advanceDetails']['relationship'] == 'Child'){
                                                                $coverage_person = $all_needs[$needKey]['advanceDetails']['child_name'];
                                                            } else{
                                                                if (isset($all_needs[$needKey]['advanceDetails']['relationship'])){
                                                                    $coverage_person = $all_needs[$needKey]['advanceDetails']['relationship'];
                                                                }
                                                                else {
                                                                    $coverage_person = "N/A";
                                                                }
                                                            }
                                                            if(isset($all_needs[$needKey]['advanceDetails']['goals_amount']) || isset($all_needs[$needKey]['advanceDetails']['existing_amount']) || isset($all_needs[$needKey]['advanceDetails']['insurance_amount'])){
                                                                if($all_needs[$needKey]['advanceDetails']['type'] == 'N4' || $all_needs[$needKey]['advanceDetails']['type'] == 'N5'){
                                                                    $existing_plan = 'N/A';
                                                                } else{
                                                                    $existing_plan = $all_needs[$needKey]['advanceDetails']['existing_amount'];
                                                                }
                                                                $goals = $all_needs[$needKey]['advanceDetails']['goals_amount'];
                                                                $gap = $all_needs[$needKey]['advanceDetails']['insurance_amount'];
                                                            } else {
                                                                $goals = 'N/A';
                                                                $existing_plan = 'N/A';
                                                                $gap = 'N/A';
                                                            }
                                                        }
                                                    }
                                                    @endphp
                                                    @if ( isset($needValue['advanceDetails']['type']) && $needValue['advanceDetails']['type'] == 'N6')
                                                        @if(isset($critical_illness['critical_illness_plan']) && $critical_illness['critical_illness_plan'] == 'Critical Illness')
                                                            <tr>
                                                                <td class="d-flex align-items-center py-3">
                                                                    <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.webp') }}" height="100%" width="auto" class="me-3" alt="Health & Medical Icon">Health & Medical - Critical Illness Care
                                                                </td>
                                                                <td class="px-2">{{isset($critical_illness['relationship']) && $critical_illness['relationship'] == 'Spouse' ? 
                                                                        $critical_illness['spouse_name'] : 
                                                                    (isset($critical_illness['relationship']) && $critical_illness['relationship'] == 'Child' ? 
                                                                    $critical_illness['child_name'] : 
                                                                    $critical_illness['relationship']) }}
                                                                </td>
                                                                <td class="px-2">{{ isset($critical_illness['goals_amount']) ? 
                                                                    'RM' . number_format(floatval($critical_illness['goals_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="px-2">{{ isset($critical_illness['existing_amount']) ? 
                                                                    'RM' . number_format(floatval($critical_illness['existing_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="text-primary py-2">{{ isset($critical_illness['insurance_amount']) ? 
                                                                    'RM' . number_format(floatval($critical_illness['insurance_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if (isset($healthCare['medical_care_plan']) && $healthCare['medical_care_plan'] == 'Health Planning')
                                                            <tr>
                                                                <td class="d-flex align-items-center py-3">
                                                                    <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.webp') }}" height="100%" width="auto" class="me-3" alt="Health & Medical Icon">Health & Medical - Medical Plan Care
                                                                </td>
                                                                <td class="px-2">
                                                                    @if (isset($all_needs[$needKey]['advance_details']['health_care']['relationship']))
                                                                        {{ $all_needs[$needKey]['advance_details']['health_care']['relationship'] == 'Spouse' ? 
                                                                                $all_needs[$needKey]['advance_details']['health_care']['spouse_name'] : 
                                                                            ($all_needs[$needKey]['advance_details']['health_care']['relationship'] == 'Child' ? 
                                                                                $all_needs[$needKey]['advance_details']['health_care']['child_name'] : 
                                                                            $all_needs[$needKey]['advance_details']['health_care']['relationship']) }}
                                                                    @endif
                                                                </td>
                                                                <td class="px-2">{{ isset($healthCare['goals_amount']) ? 
                                                                    'RM' . number_format(floatval($healthCare['goals_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="px-2">{{ isset($healthCare['existing_amount']) ? 
                                                                    'RM' . number_format(floatval($healthCare['existing_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                                <td class="text-primary px-2">{{ isset($healthCare['insurance_amount']) ? 
                                                                    'RM' . number_format(floatval($healthCare['insurance_amount'])) :
                                                                    'N/A'}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @elseif(isset($needValue['advanceDetails']['type']) && $needValue['advanceDetails']['type'] == 'N8')   
                                                    <tr>
                                                        <td class="d-flex align-items-center py-3">
                                                            <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.png') }}" height="100%" width="auto" class="me-3" alt="{{$needs}} Icon">{{$needs}}
                                                        </td>
                                                        <td class="px-2">{{$coverage_person}}</td>
                                                        <td class="px-2">{{ $goals == 'N/A' ? $goals : 'RM' . number_format(floatval($goals))}}</td>
                                                        <td class="px-2">{{ $existing_plan == 'N/A' ? $existing_plan : 'RM' . number_format(floatval($existing_plan))}}</td>
                                                        <td class="text-primary px-2">{{ $gap == 'N/A' ? $gap : 'RM' . number_format(floatval($gap))}}</td>
                                                    </tr>
                                                    @else
                                                        <tr>
                                                            <td class="d-flex align-items-center py-3">
                                                                <img src="{{ asset('images/summary/overview/icon/icon-'.($icon).'.webp') }}" height="100%" width="auto" class="me-3" alt="{{$needs}} Icon">{{$needs}}
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
                <h3 class="display-5 modal-title f-family fw-bold f-34 text-center" id="emailSummaryLabel">Thank you for securing your future with us!</h3>
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
                <h3 class="display-5 modal-title f-family fw-bold f-34 text-center" id="endSessionLabel">Thank you for sharing your needs and priorities!</h3>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Our advisors are now ready to guide you on how you can best secure your future.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">End session</button> -->
                <a href="{{route('send_fes')}}" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" type="button" id="saveSession" data-clear-route="{{ route('overview')}}">End session</a>
            </div>
        </div>
    </div>
</div>


@if(session('refNumber'))
    <script>
        alert("Your reference number is: {{ session('refNumber') }}");
    </script>
@endif

{{-- <script>
    // Wait for the page to finish loading
    window.onload = function() {
        // Check if the reference number is available
        var refNumber = "{{ session('refNumber') }}";
        
        // Display alert if the reference number is available
        if (refNumber) {
            alert("Your reference number is: " + refNumber);
        }
    };
</script> --}}

@endsection