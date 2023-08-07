@extends('templates.master')

@section('title')
<title>Education - Gap</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education-gap vh-100">
            <section class="col-12 d-flex needs-coverage-nav">
                <div class="col-6">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-6">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>
            </section>
            <!-- <form class="form-horizontal p-0"action="{{route('education.gap')}}" method="get" id="children_education" name="children_education"> -->
            <form novalidate action="{{route('form.submit.education.gap')}}" method="POST" id="education-gap">
                @csrf
                <section class="needs-gap-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-xl-6 col-12 position-relative hide second-order bg-education-gap-mob">
                                <div class="row d-flex">
                                    <!-- <div class="container-fluid"> -->
                                        <div class="col-11 m-auto d-flex justify-content-center my-5">
                                            <!-- <div class="row"> -->
                                                <canvas id="totalEducationFund" class="d-flex m-auto object-fit-cover chart-canvas"></canvas>
                                            <!-- </div> -->
                                        </div>
                                    <!-- </div>  -->
                                </div>
                                <div class="row d-flex">
                                    <div class="col-12 show-mobile bg-btn_bar">
                                        <div class="py-4 px-2">
                                            <div class="col-12 d-grid gap-2 d-md-block text-end">
                                                <a href="{{route('education.other')}}" class="btn btn-primary text-uppercase">Back</a>
                                                <!-- <a href="{{route('investment.home')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                                                <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 position-relative first-order">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-center z-99">
                                        <div class="">
                                            <div class="col-10 m-auto">
                                                <div>
                                                    <p class="f-34 @error('education_years_times') is-invalid @enderror">
                                                        <strong>In</strong>
                                                        <span class="currencyinput"><input type="text" name="education_years_times" class="form-control d-inline-block w-30 f-34 @error('education_years_times') is-invalid @enderror" id="education_years_times" required></span>
                                                        <strong>years' time,</strong>
                                                        @if ($errors->has('education_years_times'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_years_times') }}</div>
                                                        @endif
                                                    </p>
                                                    <p class="f-34 @error('education_amount_per_year') is-invalid @enderror"><strong>I want to enjoy my golden years with</strong>
                                                        <span class="currencyinput">RM<input type="text" name="education_amount_per_year" class="form-control d-inline-block w-30 f-34 @error('education_amount_per_year') is-invalid @enderror" id="education_amount_per_year" required></span>
                                                        @if ($errors->has('education_amount_per_year'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_amount_per_year') }}</div>
                                                        @endif
                                                    </p>
                                                    <p class="f-34 @error('education_aside_amount') is-invalid @enderror"><strong>I have set aside</strong>
                                                        <span class="currencyinput">RM<input type="text" name="education_aside_amount" class="form-control d-inline-block w-30 f-34 @error('education_aside_amount') is-invalid @enderror" id="education_aside_amount" required></span>
                                                        @if ($errors->has('education_aside_amount'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_aside_amount') }}</div>
                                                        @endif
                                                    </p>
                                                    <p class="f-34 @error('education_plan_amount') is-invalid @enderror"><strong>So I need to plan for</strong>
                                                        <span class="currencyinput">RM<input type="text" name="education_plan_amount" class="form-control d-inline-block w-30 f-34 @error('education_plan_amount') is-invalid @enderror" id="education_plan_amount" required></span>
                                                        @if ($errors->has('education_plan_amount'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_plan_amount') }}</div>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar hide-mobile row">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('education.other')}}" class="btn btn-primary text-uppercase">Back</a>
                            <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                            <!-- <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button> -->
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var education_years_times = document.getElementById('education_years_times');
        var education_amount_per_year = document.getElementById('education_amount_per_year');
        var education_aside_amount = document.getElementById('education_aside_amount');
        var education_plan_amount = document.getElementById('education_plan_amount');

        education_amount_per_year.addEventListener('blur', function() {
            validateNumberField(education_amount_per_year);
        });
        education_aside_amount.addEventListener('blur', function() {
            validateNumberField(education_aside_amount);
        });
        education_plan_amount.addEventListener('blur', function() {
            validateNumberField(education_plan_amount);
        });

        function validateNumberField(field) {

            var value = field.value.trim();

            if (value === '' || isNaN(value)) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            } else {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            }
        }

        education_years_times.addEventListener('blur', function() {
            validateYearsNumberField(education_years_times);
        });

        function validateYearsNumberField(field) {
            var minYear = 1;
            var maxYears = 100;

            var value = parseInt(field.value);

            if (!isNaN(value) && value >= minYear && value <= maxYears) {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            }
        }
    });


    // Chart
    $(document).ready(function() {

        if (window.innerWidth < 596) {
            // Chart for Mobile
            var config = {
                type: 'doughnut',
                data: {
                    labels: ["Uncovered", "Covered"],
                    datasets: [{
                        data: [300, 300],
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
                                text: '70%',
                                color: '#14A38B', 
                                fontStyle: 'Helvetica Neue', // Font style for the first text
                                fontSize: 45, // Font size for the first text
                            },
                            // Second text style
                            text2: {
                                text: 'Total Education Fund',
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
                        data: [300, 700],
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
                                text: '70%',
                                color: '#14A38B', 
                                fontStyle: 'Helvetica Neue', // Font style for the first text
                                fontSize: 45, // Font size for the first text
                            },
                            // Second text style
                            text2: {
                                text: 'Total Education Fund',
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

        var ctx = document.getElementById("totalEducationFund").getContext("2d");
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

@endsection