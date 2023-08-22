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
                <div class="col-12 text-dark px-0">
                        <section>
                            <div class="h-100 row justify-content-center bg-needs-gap2">
                                <div class="row justify-content-center" id="row1">
                                    <div class="col-7">
                                        <div class="border border-white p-3 bg-primary rounded-3 border-5">
                                            <p class="mb-2 text-light">Total Protection Fund</p>
                                            <div class="d-flex justify-content-between mb-2">
                                                <h3 class="text-light">70% to complete</h3>
                                                <p class="text-light"><span class="align-self-center clock-icon"></span>
                                                    20yrs</p>
                                            </div>
                                            <div
                                            class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center" id="row2">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="col-2">
                                            <div class="border border-white p-3 bg-white rounded-3 border-5">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="icon-class"></span> <!-- Replace 'icon-class' with your actual icon class -->
                                                </div>
                                                <p class="mb-2 text-dark">After the next year</p>
                                                <p class="text-dark">20 years</p>
                                            </div>
                                        </div>
                                    @endfor
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