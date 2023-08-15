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
                            <div class="row vh-100 justify-content-center">
                            <div class="col-lg-6 bg-needs-3 d-flex flex-column justify-content-sm-start justify-content-lg-center justify-content-center align-items-center">
                                <canvas id="totalProtectionFund" class="d-flex object-fit-cover chart-canvas"></canvas>
                            </div>
                                <div class="col-10 col-md-5 col-lg-5 my-0 my-lg-auto d-flex flex-column justify-content-sm-center justify-content-lg-end mx-5">
                                    <div class="d-flex">
                                        <h5 class="needs-text d-inline-flex">In</h5>
                                        <input type="number" name="protectionSupportingYears" value="{{ $protectionSupportingYears}}" class="form-control text-primary w-25" id="years" placeholder=" " required> 
                                        <h5 class="needs-text d-inline-flex">years' time,</h5> 
                                    </div>
                                    <br>
                                    <h5 class="needs-text">I want to protect my</h5>
                                    <div class="d-flex">
                                        <h5 class="needs-text d-inline-flex">loved ones with</h5>
                                        <div class="input-group w-25">
                                            <span class="input-group-text text-primary fw-bold bg-transparent pe-0">RM</span>
                                            <input type="number" name="TotalProtectionValue" value="{{ $TotalProtectionValue }}" class="form-control text-primary" id="TotalProtectionValue" placeholder=" "required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex">
                                        <h5 class="needs-text d-inline-flex">I have set aside</h5>
                                        <div class="input-group w-25">
                                            <span class="input-group-text text-primary fw-bold bg-transparent pe-0">RM</span>
                                            <input type="number" name="protectionFunds" value="{{ $protectionPolicyAmount }}" class="form-control text-primary" id="protectionFunds" placeholder=" " required><br><br>
                                        </div>
                                    </div>
                                    <br>
                                    <h5 class="needs-text d-inline-flex">So I need a plan for</h5>
                                        <div class="input-group w-25 d-flex">
                                            <span class="input-group-text text-primary fw-bold bg-transparent pe-0">RM</span>
                                            <input type="number" name="protectionGap" value="{{ $protectionGap }}" class="form-control text-primary" id="years" placeholder=" " required>
                                        </div>
                                </div>
                            </div>
    
                        </section>
    
                        <section class="footer bg-white py-4 fixed-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <a href="{{route('protection.existing.policy')}}"
                                            class="btn btn-primary text-uppercase me-md-2">Back</a>
                                            <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
      var protectionPolicyAmount =  {{$protectionPolicyAmount}};
        var TotalProtectionValue = {{$TotalProtectionValue}};
        var protectionGap = {{$protectionGap}};
        var Covered = (protectionPolicyAmount / (protectionPolicyAmount + TotalProtectionValue) * 100).toFixed(2)
        var Uncovered = (100 - Covered).toFixed(2);

        if (window.innerWidth < 596) {
            // Chart for Mobile
            var config = {
                type: 'doughnut',
                data: {
                    labels: ["Uncovered", "Covered"],
                    datasets: [{
                        data: [Uncovered, Covered],
                        backgroundColor: ["#C21B17", "#30DF8B"],
                        hoverBackgroundColor: [
                            "#C21B17",
                            "#30DF8B"
                        ]
                    }]
                },
                options: {
                    legend: {
                                display: false, // This will hide the label data above the doughnut chart
                            },
                    responsive: true, // Enable responsiveness
                    maintainAspectRatio: true, // Keep the aspect ratio (important for responsiveness)
                    elements: {
                        center: {
                            // First text style
                            text1: {
                                text: Covered + '%',
                                color: '#14A38B', 
                                fontStyle: 'Helvetica Neue', // Font style for the first text
                                fontSize: 45, // Font size for the first text
                            },
                            // Second text style
                            text2: {
                                text: 'Total Protection Fund',
                                color: '#000', // Blue color
                                fontStyle: 'Helvetica Neue', // Font style for the second text
                                fontSize: 14, // Font size for the second text
                            },
                            sidePadding: 20,
                            minFontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
                            // lineHeight: 25 // Default is 25 (in px), used for when text wraps
                        }
                    }
                }
            };
        }
        else{
            // Chart for Desktop
            var config = {
                type: 'doughnut',
                data: {
                    labels: ["Uncovered", "Covered"],
                    datasets: [{
                        data: [Uncovered, Covered],
                        backgroundColor: ["#C21B17", "#30DF8B"],
                        hoverBackgroundColor: [
                            "#C21B17",
                            "#30DF8B"
                        ]
                    }]
                },
                options: {
                    legend: {
                                display: false, // This will hide the label data above the doughnut chart
                            },
                    responsive: true, // Enable responsiveness
                    maintainAspectRatio: true, // Keep the aspect ratio (important for responsiveness)
                    elements: {
                        center: {
                            // First text style
                            text1: {
                                text: Covered + '%',
                                color: '#14A38B', 
                                fontStyle: 'Helvetica Neue', // Font style for the first text
                                fontSize: 45, // Font size for the first text
                            },
                            // Second text style
                            text2: {
                                text: 'Total Protection Fund',
                                color: '#000', // Blue color
                                fontStyle: 'Helvetica Neue', // Font style for the second text
                                fontSize: 15, // Font size for the second text
                            },
                            sidePadding: 20,
                            minFontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
                            // lineHeight: 25 // Default is 25 (in px), used for when text wraps
                        }
                    }
                }
            };
        }
        Chart.pluginService.register({
            beforeDraw: function(chart) {
                if (chart.config.options.elements.center) {
                    var ctx = chart.chart.ctx;
                    var centerConfig = chart.config.options.elements.center;
                    var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                    var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                    var maxTextWidth = (chart.innerRadius * 2) - (centerConfig.sidePadding || 20) * 2;

                    // Draw the first text (text1)
                    if (window.innerWidth < 768) {
                        ctx.font = getResponsiveFontSize(centerConfig.text1.fontSize) + "px " + centerConfig.text1.fontStyle;
                    } else {
                        ctx.font = centerConfig.text1.fontSize + "px " + centerConfig.text1.fontStyle;
                    }
                    // ctx.font = getResponsiveFontSize(centerConfig.text1.fontSize) + "px " + centerConfig.text1.fontStyle;
                    ctx.fillStyle = centerConfig.text1.color;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    // ctx.fillText(centerConfig.text1.text, centerX, centerY - 10); // Adjust the position as needed
                    // Wrap text if necessary
                    var lines1 = wrapText(centerConfig.text1.text, ctx.font, maxTextWidth);
                    var lineHeight1 = centerConfig.text1.fontSize + (centerConfig.lineHeight || 20);
                    var totalHeight1 = lineHeight1 * lines1.length;
                    if (window.innerWidth < 596) {
                        var startY1 = centerY - totalHeight1 / 4;
                    }
                    else{
                        var startY1 = centerY - totalHeight1 / 4;
                    }
                    

                    for (var i = 0; i < lines1.length; i++) {
                        ctx.fillText(lines1[i], centerX, startY1 + i * lineHeight1);
                    }


                    // Set spacing between texts
                    var spacing = 8;

                    // Draw the second text (text2)
                    if (window.innerWidth < 768) {
                        ctx.font = getResponsiveFontSize(centerConfig.text2.fontSize) + "px " + centerConfig.text2.fontStyle;
                    } else {
                        ctx.font = centerConfig.text2.fontSize + "px " + centerConfig.text2.fontStyle;
                    }
                    // ctx.font = centerConfig.text2.fontSize + "px " + centerConfig.text2.fontStyle;
                    ctx.fillStyle = centerConfig.text2.color;
                    // ctx.fillText(centerConfig.text2.text, centerX, centerY + centerConfig.text1.fontSize / 2 + spacing); // Adjust the position as needed

                    // Wrap text if necessary
                    var lines2 = wrapText(centerConfig.text2.text, ctx.font, maxTextWidth);
                     
                    if (window.innerWidth < 596) {
                        var lineHeight2 = centerConfig.text2.fontSize + (centerConfig.lineHeight || 0);
                    }
                    else{
                        var lineHeight2 = centerConfig.text2.fontSize + (centerConfig.lineHeight || 5);
                    }
                    var totalHeight2 = lineHeight2 * lines2.length;
                    // var startY2 = centerY + totalHeight2 / 4; // Adjust starting position
                    
                    if (window.innerWidth < 596) {
                        var startY2 = centerY - totalHeight2 / 8;
                    }
                    else{
                        var startY2 = centerY + totalHeight2 / 4; // Adjust starting position
                    }

                    for (var j = 0; j < lines2.length; j++) {
                        ctx.fillText(lines2[j], centerX, startY2 + j * lineHeight2 + spacing);
                    }
                }
            }
        });

        var ctx = document.getElementById("totalProtectionFund").getContext("2d");
        var desktopChart = new Chart(ctx, config);

        // Helper function to wrap text into multiple lines based on the available width
        function wrapText(text, font, maxWidth) {
            var words = text.split(' ');
            var lines = [];
            var currentLine = words[0];

            for (var i = 1; i < words.length; i++) {
                var word = words[i];
                var testLine = currentLine + ' ' + word;
                var metrics = ctx.measureText(testLine);
                var testWidth = metrics.width;

                if (testWidth > maxWidth) {
                    lines.push(currentLine);
                    currentLine = word;
                } else {
                    currentLine = testLine;
                }
            }
            lines.push(currentLine);
            return lines;
        }

        // Helper function to get the font size for responsive scaling
        function getResponsiveFontSize(originalFontSize) {
            // Adjust the scaling factor as needed
            var scalingFactor = 0.6;
            return Math.max(originalFontSize * scalingFactor, 10);
        }
        
    });
</script>
<style>
    .navbar {
        right:50%;
    }
    @media only screen and (max-width: 767px) {
    
        body {
        min-height: 51.5rem;
        padding-top: 5.5rem;
        }
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