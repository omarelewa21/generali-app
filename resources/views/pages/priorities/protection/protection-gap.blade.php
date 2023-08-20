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
                            <div class="row h-100 justify-content-center bg-needs-gap">
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
                                <object type="image/svg+xml" data="{{ asset('images/needs/background/PieChart.svg') }}" width="80%">
                                    Your browser does not support SVGs
                                </object>
                                
                            </div>
                                <div class="col-12 col-md-5 col-lg-6 my-0 my-lg-auto d-flex flex-column justify-content-sm-center justify-content-lg-end mx-5">
                                        <div class="d-flex">
                                            <div class="bg-white p-3 mb-3 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3" style="height:95px">
                                                <h5 class="gap-text my-auto">                                             
                                                    After the next
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    {{$protectionSupportingYears}} years
                                                </h5>
                                            </div>
                                            <span class="text-success align-self-center">&#10004;</span>
                                        </div>
                                        
                                        <div class="d-flex">
                                            <div class="bg-white p-3 mb-3 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3" style="height:95px">
                                                <h5 class="gap-text my-auto w-50">                                             
                                                    I want to protect my loved ones with
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    RM {{$TotalProtectionValue}} 
                                                </h5>
                                            </div>
                                            <span class="text-success align-self-center">&#10004;</span>
                                        </div>
                                        
                                        <div class="d-flex">
                                            <div class="bg-white p-3 mb-3 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3" style="height:95px">
                                                <h5 class="gap-text my-auto">                                             
                                                    I have set aside
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    RM {{$protectionPolicyAmount}}
                                                </h5>
                                            </div>
                                            <span class="text-success align-self-center">&#10004;</span>
                                        </div>
                                        
                                        <div class="d-flex">
                                            <div class="bg-white p-3 mb-3 border flex-grow-1 position-relative d-flex justify-content-between mx-3 rounded-3" style="height:95px">
                                                <h5 class="gap-text my-auto">                                             
                                                    So I need a plan for
                                                </h5>
                                                <h5 class="gap-value text-primary my-auto">                                             
                                                    RM {{$protectionGap}}
                                                </h5>
                                            </div>
                                            <span class="text-success align-self-center">&#10004;</span>
                                        </div>
                                    
                                </div>
                            </div>
    
                        </section>
    
                        <section class="footer bg-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.home')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
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
  // Calculate the progress percentage (0 to 100)
  const progressPercentage = 50; // Example: 50%

  // Calculate the stroke-dashoffset value based on the progress percentage
  const circumference = 2 * Math.PI * 240; // Circumference of the circle
  const currentOffset = circumference * (1 - progressPercentage / 100);

  // Get the circular progress bar element by its id
  const progressBar = document.getElementById("progress-gap");

  if (progressBar) {
    // Update the stroke-dashoffset property of the circular progress bar
    progressBar.setAttribute("stroke-dashoffset", currentOffset);
  } else {
    console.error("Circular progress bar element with id 'progress-gap' not found.");
  }
});


</script>
<style>
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