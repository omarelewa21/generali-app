@extends('templates.master')

@section('title')
<title>Protection - Gap</title>

@section('content')
@php
    // Retrieving values from the session
    $arrayDataProtection = session('passingArraysProtection');
    $protectionSupportingYears = isset($arrayDataProtection['protectionSupportingYears']) ? $arrayDataProtection['protectionSupportingYears'] : '';
    $protectionPolicyAmount = isset($arrayDataProtection['protectionPolicyAmount']) ? $arrayDataProtection['protectionPolicyAmount'] : 0;
    $TotalProtectionValue = isset($arrayDataProtection['TotalProtectionValue']) ? $arrayDataProtection['TotalProtectionValue'] : 0;
    $protectionGap = isset($arrayDataProtection['protectionGap']) ? $arrayDataProtection['protectionGap'] : 0;
@endphp

<div id="protection-content">
    <div class="p-0 vh-100 container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-lg-6 col-md-12">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>
            </div>
            <form class="form-horizontal p-0" action="{{route('retirement.home')}}" method="get">
                <div class="col-12 text-dark px-0 my-4">
                    <div class="my-4">  
                        <section>
                            <div class="container mx-auto h-100 row justify-content-center bg-needs-gap">
                            <div class="col-lg-5 d-flex flex-column justify-content-sm-start justify-content-lg-center justify-content-center align-items-center">
                                {{-- <div class="svg-container">
                                <div class="card-gap" id="gap">
                                    <div class="card-gap__percent">
                                      <svg>
                                        <defs>
                                          <radialGradient id="gradient" cx="50%" cy="50%" r="60%" fx="50%" fy="50%">
                                            <stop offset="30%"   stop-color="var(--primary-dark)"/>
                                            <stop offset="100%" stop-color="var(--primary-light)"/>
                                          </radialGradient>
                                        </defs>
                                        <circle cx="90" cy="90" r="90" stroke="url(#gradient)" id="circle"></circle>
                                      </svg>
                                      <div class="circle"></div>
                                      <div class="circle circle__medium"></div>
                                      <div class="circle circle__small"></div>
                                      <div class="card-gap__number">50%</div>
                                    </div>
                                </div>
                                </div> --}}
                                {{-- <object type="image/svg+xml" data="{{ asset('images/needs/background/PieChart.svg') }}" width="85%">
                                    Your browser does not support SVGs
                                </object> --}}
                                <div class="ell1" id="chart-gap" style="transform: scale(1.3);">
                                    <div class="ell2">
                                      <div class="ellP">
                                        <svg>
                                          <linearGradient id="test">
                                  <stop offset="0%" stop-color="#FF7D7A"/>
                                  <stop offset="100%" stop-color="#C1210D"/>
                                  </linearGradient>
                                          <circle sx="70" cy="70" r="120"></circle> 
                                          <circle sx="70" cy="70" r="120" id="CircleProgressBar"  stroke="url(#test)"></circle>   
                                              </svg>
                                      </div>
                                      <div class="ell3">
                                        <div class="ell4">
                                          <div class="ellText">
                                            <h1 class="text-primary"><span id="covered">70</span>%</h1>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <h5 class="gap-text mb-4">
                                    Total Protection Fund
                                </h5>
                                
                            </div>
                                <div class="col-12 col-md-5 col-lg-6 my-0 my-lg-auto d-flex flex-column justify-content-sm-center justify-content-lg-end mx-5">
                                        <div class="d-flex">
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3 glow-box" style="height:95px">
                                                <h5 class="gap-text my-auto">                                             
                                                    After the next
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    {{$protectionSupportingYears}} years
                                                </h5>
                                            </div>
                                            <span class="align-self-center green-tick"></span>
                                        </div>
                                        
                                        <div class="d-flex">
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3 glow-box" style="height:95px">
                                                <h5 class="gap-text my-auto w-50">                                             
                                                    I want to protect my loved ones with
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    RM {{number_format($TotalProtectionValue)}} 
                                                </h5>
                                            </div>
                                            <span class="align-self-center green-tick"></span>
                                        </div>
                                        
                                        <div class="d-flex">
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3 glow-box" style="height:95px">
                                                <h5 class="gap-text my-auto">                                             
                                                    I have set aside
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    RM {{number_format($protectionPolicyAmount)}}
                                                </h5>
                                            </div>
                                            <span class="align-self-center green-tick"></span>
                                        </div>
                                        
                                        <div class="d-flex">
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3 glow-box" style="height:95px">
                                                <h5 class="gap-text my-auto">                                             
                                                    So I need a plan for
                                                </h5>
                                                <h5 class="gap-value my-auto {{ $protectionGap === 0 ? 'text-dark' : 'text-primary ' }}">                                             
                                                    RM {{number_format($protectionGap)}}
                                                </h5>
                                            </div>
                                            <span class="align-self-center {{ $protectionGap === 0 ? 'green-tick' : 'red-tick' }}"></span>
                                        </div>
                                </div>
                            </div>
    
                        </section>
    
                        <section class="footer bg-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.existing.policy')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase">Next</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
      var protectionPolicyAmount =  {{$protectionPolicyAmount}};
        var TotalProtectionValue = {{$TotalProtectionValue}};
        var protectionGap = {{$protectionGap}};
        var Covered = (protectionPolicyAmount / (protectionPolicyAmount + TotalProtectionValue) * 100).toFixed(2)
        var Uncovered = (100 - Covered).toFixed(2);
    });
    document.addEventListener("DOMContentLoaded", function () {
  
var covered = parseInt(document.getElementById("covered").innerHTML);
var percent = covered/100;
var dasharaay = 800*percent;
var CPB = document.getElementById("CircleProgressBar");
CPB.style.strokeDasharray = dasharaay;
console.log(covered);
console.log(percent);
console.log(dasharaay);
console.log(dasharaay);
    });
</script>
<style>

    /* html {
        font-size: 62.5%; // 1rem = 10px    100% = 16px

    } */

    .navbar {
        right:50%;
    }
    @media only screen and (max-width: 767px) {
    
        .navbar {
        right:0;
    }
    .fixed-bottom {
        z-index: 1000;
    }
    .bg-needs-3 {
        height:auto;
    }
    }
    </style>
@endsection