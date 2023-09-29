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
    $protectionPercentage = isset($arrayDataProtection['protectionPercentage']) ? $arrayDataProtection['protectionPercentage'] : 0;
@endphp

<div id="protection-content">
    <div class="p-0 container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    @include('templates.nav.nav-red-menu-needs')
                </div>
                <div class="col-lg-6 col-md-12">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>
            </div>
            <form class="form-horizontal p-0" action="{{route('retirement.home')}}" method="get">
                <div class="col-12 text-dark px-0 my-4 d-flex justify-content-center">
                    <div class="my-4">  
                        <section>
                            <div class="mt-4 container-fluid mx-auto row justify-content-center bg-needs-gap">
                            <div class="col-lg-5 d-flex flex-column justify-content-md-center justify-content-center align-items-center">
                                <div class="svg-container" style="transform:scale(1.3)">
                                <div class="card-gap" id="gap">
                                    <div class="card-gap__percent">
                                      <svg>
                                        <defs>
                                          <linearGradient  id="gradient" cx="50%" cy="50%" r="10%" fx="50%" fy="50%">
                                            <stop offset="10%"   stop-color="#FF7D7A"/>
                                            <stop offset="100%" stop-color="#C1210D"/>
                                          </linearGradient >
                                        </defs>
                                        <circle cx="90" cy="90" r="144" stroke="url(#gradient)" id="circle"></circle>
                                        <circle cx="-55" cy="90" r="10" style="fill:white" id="dotCircle"></circle>
                                      </svg>
                                      <div class="circle"></div>
                                      <div class="circle circle__medium"></div>
                                      <div class="circle circle__small"></div>
                                      <div class="card-gap__number text-primary needs-text">{{$protectionPercentage}}%</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-10 col-lg-6 my-2 my-md-5 my-md-auto my-lg-auto d-flex flex-column justify-content-sm-center justify-content-lg-end mx-2 mx-md-5 mx-lg-0">
                                        <div class="d-flex">
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-0 mx-md-2 mx-lg-2 rounded-3" style="height:95px">
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
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-0 mx-md-2 mx-lg-2 rounded-3" style="height:95px">
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
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mx-0 mx-md-2 mx-lg-2 rounded-3" style="height:95px">
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
                                            <div class="bg-white p-3 m-2 border flex-grow-1 position-relative d-flex justify-content-between mb-md-0 mx-0 mx-md-2 mx-lg-2 rounded-3" style="height:95px">
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
                                <div class="d-flex row">
                                    <h5 id="textProtectionFund" class="text-center col-5 col-md-6 gap-text">
                                        Total Protection Fund
                                    </h5>
                                </div>
                            </div>

    
                        </section>
    
                        <section class="footer bg-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                        <a href="{{route('protection.existing.policy.archived')}}" class="btn btn-primary text-uppercase flex-fill me-md-2">Back</a>
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
        var Covered = (protectionPolicyAmount / TotalProtectionValue * 100).toFixed(2)
        var Uncovered = (100 - Covered).toFixed(2);
        var circle = document.getElementById("circle");
//    var change = 879.65 - (879.65 * Covered) / 100;
//    circle.style.strokeDashoffset = change;
circle.style.strokeDasharray = 904.896;
let change = 904.896 - (904.896 * Covered) / 100; 
if (change < 0) {
    change = 0; // 0 represents 100% coverage
    circle.style.strokeDashoffset = change;
    // console.log('change', change);
}
else   {
    circle.style.strokeDashoffset = change; // 904.896 represents 0% coverage
}
    });
  
</script>

<style>

/* #textProtectionFund {
    top:18%;
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
    #chart-gap {
        transform: scale(1) !important;
    }
    #textProtectionFund {
        top:6%;
    }
    .gap-text {
        font-size: 1.2rem !important;
    }
    .gap-value {
        font-size: 1.3rem !important;
    }
    .green-tick,.red-tick {
display:none;

    }
}
@media only screen and (min-width:768px) and (max-height: 1112px) and (orientation:portrait) {
    #chart-gap {
        margin-top: 130px !important;
        transform: scale(1.3) !important;
    }
}
@media only screen and (max-width: 767px) {

.navbar-default.transparent {
background: transparent !important;
}
.fixed-bottom {
    z-index: 10;
}
.navbar {
    right:0;
}
}
    </style>
@endsection