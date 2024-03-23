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
    $priorities = session('customer_details.priorities');
    $prioritiesData = ['protectionDiscuss','retirementDiscuss','educationDiscuss','savingsDiscuss','debt-cancellationDiscuss','health-medicalDiscuss','investmentsDiscuss'];

    
    $prioritiesProtection = session('customer_details.priorities.protectionDiscuss');
    $prioritiesRetirement = session('customer_details.priorities.retirementDiscuss');
    $prioritiesEducation = session('customer_details.priorities.educationDiscuss');
    $prioritiesSavings = session('customer_details.priorities.savingsDiscuss');
    $prioritiesInvestment = session('customer_details.priorities.investmentsDiscuss');
    $prioritiesHealthMedical = session('customer_details.priorities.health-medicalDiscuss');
    $prioritiesDebtCancellation = session('customer_details.priorities.debt-cancellationDiscuss');
    $protection_needs = session('customer_details.protection_needs');
    $retirement_needs = session('customer_details.retirement_needs');
    $education_needs = session('customer_details.education_needs');
    $savings_needs = session('customer_details.savings_needs');
    $investments_needs = session('customer_details.investments_needs');
    $health_medical_needs = session('customer_details.health-medical_needs');
    $health_medical_planning_needs = session('customer_details.health-medical_needs.medical_planning');
    $health_medical_critical_needs = session('customer_details.health-medical_needs.critical_illness');
    $debt_cancellation_needs = session('customer_details.debt-cancellation_needs');
    $all_needs = session('customer_details');
@endphp

<div id="overview-new">
    <div class="container-fluid">
        <div class="row wrapper-overview">
            <div class="header col-12"><div class="row">@include('templates.nav.nav-red-menu')</div></div>
            <section class="content h-100 overflow-auto">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 px-xl-5">
                            <h2 class="display-5 fw-bold lh-base">Summary Overview</h2>
                        </div>
                    </div>
                    <div class="row chart">
                        <div class="col-md-6 ps-xl-5 py-4 py-xl-0">
                            <div class="row chart-wrapper">
                                <div class="svg-container overview-graph">
                                    <div class="card-gap" id="gap">
                                        <div class="card-gap__percent">
                                            @php
                                            $overview_averages_percentage = [];
                                            $total_chart = 0;
                                                if ($priorities){
                                                    $matchingPriorities = array_intersect_key($priorities, array_flip($prioritiesData));

                                                    if (!empty($matchingPriorities)) {
                                                        $total = 0;
                                                        
                                                        $overview_chart_percentage = [];
                                                        $overview_needs = 0;
                                                        foreach ($matchingPriorities as $key => $value) {
                                                            if ($value === 'true') {
                                                                $overview_needs++;
                                                                $needs = str_replace('Discuss', '', $key);
                                                                if(isset($all_needs[$needs.'_needs'])){
                                                                    if(isset($all_needs[$needs.'_needs']['fundPercentage']) || isset($all_needs[$needs.'_needs']['critical_illness']['fundPercentage']) || isset($all_needs[$needs.'_needs']['medical_planning']['fundPercentage'])) {
                                                                        if(isset($all_needs[$needs.'_needs']['critical_illness']['fundPercentage']) && isset($all_needs[$needs.'_needs']['medical_planning']['fundPercentage'])){
                                                                            $total_medical = floor(floatval($all_needs[$needs.'_needs']['critical_illness']['fundPercentage']) + floatval($all_needs[$needs.'_needs']['medical_planning']['fundPercentage'])) / 2;
                                                                            $total += $total_medical;

                                                                            // Calculate and store the average
                                                                            $overview_averages_percentage[$needs] = floor($total_medical);
                                                                            $overview_chart_percentage[$needs] = floor($total_medical / ($overview_needs * 100) * 100);
                                                                        }else if(isset($all_needs[$needs.'_needs']['critical_illness']['fundPercentage'])){
                                                                            $total_critical = floor(floatval($all_needs[$needs.'_needs']['critical_illness']['fundPercentage']));
                                                                            $total += $total_critical;

                                                                            // Calculate and store the average
                                                                            $overview_averages_percentage[$needs] = floor($total_critical);
                                                                            $overview_chart_percentage[$needs] = floor($total_critical / ($overview_needs * 100) * 100);
                                                                        } else if(isset($all_needs[$needs.'_needs']['medical_planning']['fundPercentage'])){
                                                                            $total_planning = floor(floatval($all_needs[$needs.'_needs']['medical_planning']['fundPercentage']));
                                                                            $total += $total_planning;

                                                                            // Calculate and store the average
                                                                            $overview_averages_percentage[$needs] = floor($total_planning);
                                                                            $overview_chart_percentage[$needs] = floor($total_planning / ($overview_needs * 100) * 100);
                                                                        }
                                                                        else {
                                                                            $total += floor(floatval($all_needs[$needs.'_needs']['fundPercentage']));
                                                                            $all_needs_percentage = floor(floatval($all_needs[$needs.'_needs']['fundPercentage']));

                                                                            // Calculate and store the average
                                                                            $overview_averages_percentage[$needs] = floor($all_needs_percentage);
                                                                            $overview_chart_percentage[$needs] = floor($all_needs_percentage / ($overview_needs * 100) * 100);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    foreach ($overview_chart_percentage as $need => $chart) {
                                                        $total_chart += $chart;
                                                        //this is for bar chart percentage value
                                                        // echo "$need : $chart"."<br>";
                                                    }
                                                }
                                            @endphp
                                            <svg>
                                                <defs>
                                                    @php
                                                    $counter = 0;
                                                    @endphp
                                                    @if ($overview_averages_percentage)
                                                        @foreach ($overview_averages_percentage as $need => $average)
                                                            @php
                                                            $stopColor = '';

                                                            switch ($need) {
                                                                case 'protection':
                                                                    $stopColor = '#C0232C';
                                                                    break;
                                                                case 'retirement':
                                                                    $stopColor = '#14A38B';
                                                                    break;
                                                                case 'education':
                                                                    $stopColor = '#F2AC57';
                                                                    break;
                                                                case 'savings':
                                                                    $stopColor = '#B3222A';
                                                                    break;
                                                                case 'investments':
                                                                    $stopColor = '#0880AE';
                                                                    break;
                                                                case 'debt-cancellation':
                                                                    $stopColor = '#CCCCCC';
                                                                    break;
                                                                case 'health-medical':
                                                                    $stopColor = '#FD5B5B';
                                                                    break;
                                                                default:

                                                                }

                                                                //this is for bar chart color value
                                                                //echo "$need : $overview_final_percentage";
                                                                $counter++;
                                                            @endphp
                                                            <linearGradient  id="gradient_{{$need}}" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                                                <stop offset="0%" stop-color="{{ $stopColor }}"/>
                                                                <stop offset="100%" stop-color="{{ $stopColor }}"/>
                                                            </linearGradient>
                                                        @endforeach
                                                    @endif
                                                </defs>
                                                <!-- <g id="circle">
                                                    <circle cx="90" cy="90" r="144" stroke="url(#gradient)"></circle>
                                                </g> -->
                                                <g fill="none" stroke-width="15" id="circle">
                                                    @php
                                                        $counter = 0; // Reset the counter for the next loop
                                                        $totalPercentage = 0; // Reset the totalPercentage for the next loop
                                                        $radius = 164; // Set the radius for the outer circle
                                                        $innerRadius = 130; // Set the radius for the inner circle (empty center)
                                                    @endphp

                                                    @if ($overview_averages_percentage)
                                                        @foreach ($overview_averages_percentage as $need => $average)
                                                            @php
                                                                $overview_final_percentage = ceil($average/$total * 100);
                                                                // Skip segments with 0 percentage
                                                                if ($overview_final_percentage <= 0) {
                                                                    continue;
                                                                }
                                                                // Calculate the path data for each segment based on the percentage
                                                                $startAngle = 90 - ($totalPercentage * 360 / 100); // Start angle in degrees
                                                                $endAngle = $startAngle - ($overview_final_percentage * 360 / 100); // End angle in degrees

                                                                // Update the total percentage for the next iteration
                                                                $totalPercentage += $overview_final_percentage;
                                                                $counter++;
                                                            @endphp

                                                            <path d="M 90,90
                                                            L {{ 90 + $radius * cos(deg2rad($startAngle)) }}, {{ 90 + $radius * sin(deg2rad($startAngle)) }}
                                                            A {{ $radius }},{{ $radius }} 0 {{ $overview_final_percentage > 50 ? 1 : 0 }},0
                                                            {{ 90 + $radius * cos(deg2rad($endAngle)) }}, {{ 90 + $radius * sin(deg2rad($endAngle)) }}
                                                            Z" fill="url(#gradient_{{$need}})"/>
                                                        @endforeach
                                                        <circle cx="90" cy="90" r="{{ $innerRadius }}" fill="#fff"/>
                                                    @endif
                                                </g>
                                            </svg>
                                            <div class="circle"></div>
                                            <div class="circle circle__medium"></div>
                                            <div class="circle circle__small"></div>
                                            <div class="card-gap__number text-primary text-center position-absolute" style="font-size:80px;line-height:90px;z-index:1000;">{{$total_chart}}%
                                                <h5 class="f-family text-black" style="font-size:25px;">covered</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pe-xl-5 my-auto">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <table id="overview-needs" class="mx-auto">
                                        <tbody>
                                            @if ($prioritiesProtection === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/protection-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Protection Color">Protection
                                                    </td>
                                                    <td>{{floor(floatval($protection_needs['fundPercentage']))}}%</td>
                                                </tr>
                                            @endif
                                            @if ($prioritiesRetirement === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/retirement-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Retirement Color">Retirement
                                                    </td>
                                                    <td>{{floor(floatval($retirement_needs['fundPercentage']))}}%</td>
                                                </tr>
                                            @endif
                                            @if ($prioritiesEducation === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/education-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Education Color">Education
                                                    </td>
                                                    <td>{{floor(floatval($education_needs['fundPercentage']))}}%</td>
                                                </tr>
                                            @endif
                                            @if ($prioritiesSavings === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/savings-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Regular Savings Color">Regular Savings
                                                    </td>
                                                    <td>{{floor(floatval($savings_needs['fundPercentage']))}}%</td>
                                                </tr>
                                            @endif
                                            @if ($prioritiesInvestment === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/investment-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Lump Sum Investment Color">Lump Sum Investment
                                                    </td>
                                                    <td>{{floor(floatval($investments_needs['fundPercentage']))}}%</td>
                                                </tr>
                                            @endif
                                            @if ($prioritiesHealthMedical === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/health-medical-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Health & Medical Color">Health & Medical
                                                    </td>
                                                    <td>
                                                    {{
                                                    isset($health_medical_needs['critical_illness']) && isset($health_medical_needs['medical_planning'])
                                                        ? (floor(floatval($health_medical_planning_needs['fundPercentage']) + floatval($health_medical_critical_needs['fundPercentage'])) / 2) 
                                                        : (
                                                            isset($health_medical_needs['medical_planning'])
                                                            ? floor(floatval($health_medical_planning_needs['fundPercentage']))
                                                            : floor(floatval($health_medical_critical_needs['fundPercentage']))
                                                        )
                                                    }}%
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($prioritiesDebtCancellation === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/color/debt-cancellation-color.svg') }}" height="100%" width="auto" class="me-4 pe-2" alt="Debt Cancellation Color">Debt Cancellation
                                                    </td>
                                                    <td>{{floor(floatval($debt_cancellation_needs['fundPercentage']))}}%</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 px-xl-5">
                            <hr style="color:#A0A0A0;">
                        </div>
                        <div class="col-12 px-xl-5">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h2 class="display-5 fw-bold lh-base">Summary of needs</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table id="overview-table" class="w-100">
                                        <thead>
                                            <tr>
                                                <th>Needs</th>
                                                <th>Coverage</th>
                                                <th>Coverage Duration</th>
                                                <th>Goal</th>
                                                <th>Coverage Plan</th>
                                                <th>Gap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($protection_needs && $prioritiesProtection === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-protection.webp') }}" height="100%" width="auto" class="me-3" alt="Protection Icon">Protection
                                                    </td>
                                                    <td>{{$protection_needs['coverFor'] === 'Spouse' ? $protection_needs['othersCoverForName'] : ($protection_needs['coverFor'] === 'Child' ? $protection_needs['selectedInsuredName'] : $protection_needs['coverFor']) }}</td>
                                                    <td>{{$protection_needs['supportingYears']}} years</td>
                                                    <td>RM{{$protection_needs['totalProtectionNeeded'] !== null || $protection_needs['totalProtectionNeeded'] !== '' ? number_format(floatval($protection_needs['totalProtectionNeeded'])) : '-'}}</td>
                                                    <td>RM{{$protection_needs['existingPolicyAmount'] !== null || $protection_needs['existingPolicyAmount'] !== '' ? number_format(floatval($protection_needs['existingPolicyAmount'])) : '-'}}</td>
                                                    <td>RM{{$protection_needs['totalAmountNeeded'] !== null || $protection_needs['totalAmountNeeded'] !== '' ? number_format(floatval($protection_needs['totalAmountNeeded']) + (floatval($protection_needs['totalAmountNeeded']) * (4 /100)) ) : '-'}}</td>
                                                </tr>
                                            @endif
                                            @if ($retirement_needs && $prioritiesRetirement === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-retirement.webp') }}" height="100%" width="auto" class="me-3" alt="Retirement Icon">Retirement
                                                    </td>
                                                    <td>{{$retirement_needs['coverFor'] === 'Spouse' ? $retirement_needs['othersCoverForName'] : ($retirement_needs['coverFor'] === 'Child' ? $retirement_needs['selectedInsuredName'] : $retirement_needs['coverFor']) }}</td>
                                                    <td>{{$retirement_needs['supportingYears']}} years</td>
                                                    <td>RM{{$retirement_needs['totalRetirementNeeded'] !== null || $retirement_needs['totalRetirementNeeded'] !== '' ? number_format(floatval($retirement_needs['totalRetirementNeeded'])) : '-'}}</td>
                                                    <td>RM{{$retirement_needs['retirementSavingsAmount'] !== null || $retirement_needs['retirementSavingsAmount'] !== '' ? number_format(floatval($retirement_needs['retirementSavingsAmount'])) : '-'}}</td>
                                                    <td>RM{{$retirement_needs['totalAmountNeeded'] !== null || $retirement_needs['totalAmountNeeded'] !== '' ? number_format(floatval($retirement_needs['totalAmountNeeded']) + (floatval($retirement_needs['totalAmountNeeded']) * (4 /100)) ) : '-'}}</td>
                                                </tr>
                                            @endif
                                            @if ($education_needs && $prioritiesEducation === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-education.webp') }}" height="100%" width="auto" class="me-3" alt="Education Icon">Education
                                                    </td>
                                                    <td>{{$education_needs['coverFor'] === 'Spouse' ? $education_needs['othersCoverForName'] : ($education_needs['coverFor'] === 'Child' ? $education_needs['selectedInsuredName'] : $education_needs['coverFor']) }}</td>
                                                    <td>{{$education_needs['tertiaryEducationYear']}} years</td>
                                                    <td>RM{{$education_needs['tertiaryEducationAmount'] !== null || $education_needs['tertiaryEducationAmount'] !== '' ? number_format(floatval($education_needs['tertiaryEducationAmount'])) : '-'}}</td>
                                                    <td>RM{{$education_needs['existingFundAmount'] !== null || $education_needs['existingFundAmount'] !== '' ? number_format(floatval($education_needs['existingFundAmount'])) : '-'}}</td>
                                                    <td>RM{{$education_needs['totalAmountNeeded'] !== null || $education_needs['totalAmountNeeded'] !== '' ? number_format(floatval($education_needs['totalAmountNeeded']) + (floatval($education_needs['totalAmountNeeded']) * (5 /100)) ) : '-'}}</td>
                                                </tr>
                                            @endif
                                            @if ($savings_needs && $prioritiesSavings === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-savings.webp') }}" height="100%" width="auto" class="me-3" alt="Savings Icon">Savings
                                                    </td>
                                                    <td>{{$savings_needs['coverFor'] === 'Spouse' ? $savings_needs['othersCoverForName'] : ($savings_needs['coverFor'] === 'Child' ? $savings_needs['selectedInsuredName'] : $savings_needs['coverFor']) }}</td>
                                                    <td>{{$savings_needs['investmentTimeFrame']}} years</td>
                                                    <td>RM{{$savings_needs['goalsAmount'] !== null || $savings_needs['goalsAmount'] !== '' ? number_format(floatval($savings_needs['goalsAmount'])) : '-'}}</td>
                                                    <td>RM{{$savings_needs['totalSavingsNeeded'] !== null || $savings_needs['totalSavingsNeeded'] !== '' ? number_format(floatval($savings_needs['totalSavingsNeeded'])) : '-'}}</td>
                                                    <td>RM{{$savings_needs['totalAmountNeeded'] !== null || $savings_needs['totalAmountNeeded'] !== '' ? number_format(floatval($savings_needs['totalAmountNeeded']) + (floatval($savings_needs['totalAmountNeeded']) * (4 /100)) ) : '-'}}</td>
                                                </tr>
                                            @endif
                                            @if ($health_medical_planning_needs && $prioritiesHealthMedical === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-medical.webp') }}" height="100%" width="auto" class="me-3" alt="Health & Medical Icon">Health & Medical - Medical Planning
                                                    </td>
                                                    <td>{{$health_medical_planning_needs['coverFor'] === 'Spouse' ? $health_medical_planning_needs['othersCoverForName'] : ($health_medical_planning_needs['coverFor'] === 'Child' ? $health_medical_planning_needs['selectedInsuredName'] : $health_medical_planning_needs['coverFor']) }}</td>
                                                    <td>{{$health_medical_planning_needs['year']}} years</td>
                                                    <td>RM{{$health_medical_planning_needs['neededAmount'] !== null || $health_medical_planning_needs['neededAmount'] !== '' ? number_format(floatval($health_medical_planning_needs['neededAmount']) * 12) : '-'}}</td>
                                                    <td>RM{{$health_medical_planning_needs['existingProtectionAmount'] !== null || $health_medical_planning_needs['existingProtectionAmount'] !== '' ? number_format(floatval($health_medical_planning_needs['existingProtectionAmount'])) : '-'}}</td>
                                                    <td>RM{{$health_medical_planning_needs['totalAmountNeeded'] !== null || $health_medical_planning_needs['totalAmountNeeded'] !== '' ? number_format(floatval($health_medical_planning_needs['totalAmountNeeded']) + (floatval($health_medical_planning_needs['totalAmountNeeded']) * (11 /100)) ) : '-'}}</td>
                                                </tr>
                                            @endif
                                            @if ($health_medical_critical_needs && $prioritiesHealthMedical === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-medical.webp') }}" height="100%" width="auto" class="me-3" alt="Health & Medical Icon">Health & Medical - Critical Illness
                                                    </td>
                                                    <td>{{$health_medical_critical_needs['coverFor'] === 'Spouse' ? $health_medical_critical_needs['othersCoverForName'] : ($health_medical_critical_needs['coverFor'] === 'Child' ? $health_medical_critical_needs['selectedInsuredName'] : $health_medical_critical_needs['coverFor']) }}</td>
                                                    <td>{{$health_medical_critical_needs['year']}} years</td>
                                                    <td>RM{{$health_medical_critical_needs['neededAmount'] !== null || $health_medical_critical_needs['neededAmount'] !== '' ? number_format(floatval($health_medical_critical_needs['neededAmount']) * 12) : '-'}}</td>
                                                    <td>RM{{$health_medical_critical_needs['existingProtectionAmount'] !== null || $health_medical_critical_needs['existingProtectionAmount'] !== '' ? number_format(floatval($health_medical_critical_needs['existingProtectionAmount'])) : '-'}}</td>
                                                    <td>RM{{$health_medical_critical_needs['totalAmountNeeded'] !== null || $health_medical_critical_needs['totalAmountNeeded'] !== '' ? number_format(floatval($health_medical_critical_needs['totalAmountNeeded']) + (floatval($health_medical_critical_needs['totalAmountNeeded']) * (4 /100)) ) : '-'}}</td>
                                                </tr>
                                            @endif
                                            @if ($investments_needs && $prioritiesInvestment === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-investment.webp') }}" height="100%" width="auto" class="me-3" alt="Lump Sum Investment Icon">Lump Sum Investment
                                                    </td>
                                                    <td>{{$investments_needs['coverFor'] === 'Spouse' ? $investments_needs['othersCoverForName'] : ($investments_needs['coverFor'] === 'Child' ? $investments_needs['selectedInsuredName'] : $investments_needs['coverFor']) }}</td>
                                                    <td>{{$investments_needs['investmentTimeFrame']}} years</td>
                                                    <td>-</td>
                                                    <td>RM{{$investments_needs['totalInvestmentNeeded'] !== null || $investments_needs['totalInvestmentNeeded'] !== '' ? number_format(floatval($investments_needs['totalInvestmentNeeded'])) : '-'}}</td>
                                                    <td>-</td>
                                                </tr>
                                            @endif
                                            @if ($debt_cancellation_needs && $prioritiesDebtCancellation === 'true')
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <img src="{{ asset('images/summary/overview/icon/icon-debt.webp') }}" height="100%" width="auto" class="me-3" alt="Debt Cancellation Icon">Debt Cancellation
                                                    </td>
                                                    <td>{{$debt_cancellation_needs['coverFor'] === 'Spouse' ? $debt_cancellation_needs['othersCoverForName'] : ($debt_cancellation_needs['coverFor'] === 'Child' ? $debt_cancellation_needs['selectedInsuredName'] : $debt_cancellation_needs['coverFor']) }}</td>
                                                    <td>{{$debt_cancellation_needs['remainingYearsOfSettlement']}} years</td>
                                                    <td>RM{{$debt_cancellation_needs['totalDebtCancellationFund'] !== null || $debt_cancellation_needs['totalDebtCancellationFund'] !== '' ? number_format(floatval($debt_cancellation_needs['totalDebtCancellationFund'])) : '-'}}</td>
                                                    <td>RM{{$debt_cancellation_needs['existingDebtAmount'] !== null || $debt_cancellation_needs['existingDebtAmount'] !== '' ? number_format(floatval($debt_cancellation_needs['existingDebtAmount'])) : '-'}}</td>
                                                    <td>RM{{$debt_cancellation_needs['totalAmountNeeded'] !== null || $debt_cancellation_needs['totalAmountNeeded'] !== '' ? number_format(floatval($debt_cancellation_needs['totalAmountNeeded'])) : '-'}}</td>
                                                </tr>
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
                            <a href="{{route('summary.monthly-goals')}}" class="btn btn-secondary ms-auto me-md-2 text-uppercase">Back</a>
                            <a href="#" class="btn btn-secondary me-md-2 text-uppercase" data-bs-toggle="modal" data-bs-target="#endSession">Submit</a>
                        </div>
                        <div class="col-12 d-sm-none mb-3 px-4"><a href="#" class="btn btn-primary w-100 text-uppercase" data-bs-toggle="modal" data-bs-target="#emailSummary">Email me</a></div>
                        <div class="col-12 d-flex gap-2 d-sm-none text-end px-4">
                            <a href="{{route('summary.monthly-goals')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase">Back</a>
                            <a href="{{route('summary.increment-amount')}}" class="btn btn-secondary flex-fill me-md-2 text-uppercase" data-bs-toggle="modal" data-bs-target="#endSession">Submit</a>
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

<script>
    var circle = document.getElementById("circle");

        circle.style.strokeDasharray = 904.896;
        let change = 904.896 - (904.896 * 100) / 100; 
        if (change < 0) {
            change = 0; // 0 represents 100% coverage
            circle.style.strokeDashoffset = change;
            console.log(change);
            // console.log('change', change);
        }
        else   {
            circle.style.strokeDashoffset = change; // 904.896 represents 0% coverage
        }
</script>

@endsection