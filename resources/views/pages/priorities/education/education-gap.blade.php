@extends('templates.master')

@section('title')
<title>Education - Gap</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-education-gap" style="max-height:100vh;height:100vh;">
            <section class="col-12 d-flex needs-master-nav">
                <div class="col-2 col-md-3 col-lg-3 sticky-top">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-10 col-md-9 col-lg-9 hide">
                    @include ('templates.nav.nav-sidebar-needs')
                </div>
            </section>
            <section class="needs-master-content">
            <div class="col-12">
                    <div class="row h-100 overflow-y-auto overflow-x-hidden">
                        <div class="col-xl-6 col-12 position-relative hide second-order bg-education-gap-mob">
                           <div class="row h-100 d-flex justify-content-center align-items-center">
                                <!-- <div class="container-fluid">
                                    <div class="col-11 m-auto"> -->
                                        <canvas id="totalEducationFund" class="h-88 w-100 d-flex m-auto" style="object-fit:cover;"></canvas>
                                    <!-- </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 position-relative first-order">
                            <div class="row">
                                <div class="col-12 d-flex mt-5 justify-content-center">
                                    <div class="">
                                        <div class="col-10 mt-4">
                                            <div class="" style="height:fit-content;">
                                                <p style="font-size:34px;"><strong>In</strong>
                                                    <input type="number" name="fund_year3" class="form-control d-inline-block w-25" id="fund_year3" required>
                                                    <strong>years' time,</strong>
                                                </p>
                                                <p style="font-size:34px;"><strong>I want to enjoy my golden years with</strong>
                                                    <input type="number" name="fund_money" class="form-control d-inline-block w-25" id="fund_money" placeholder="RM" required>
                                                </p>
                                                <p style="font-size:34px;"><strong>I have set aside</strong>
                                                    <input type="number" name="fund_money1" class="form-control d-inline-block w-25" id="fund_money1" placeholder="RM" required>
                                                </p>
                                                <p style="font-size:34px;"><strong>So I need to plan for</strong>
                                                    <input type="number" name="fund_money2" class="form-control d-inline-block w-25" id="fund_money2" placeholder="RM" required>
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
            <section class="needs-master-footer footer bg-white">
                <div class="bg-btn_bar py-4 px-2 bg-white">
                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                        <a href="{{route('education.other')}}" class="btn btn-primary text-uppercase">Back</a>
                        <a href="{{route('investment.home')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script>
    $(document).ready(function() {
       
        // Chart.pluginService.register({
        //     beforeDraw: function(chart) {
        //         if (chart.config.options.elements.center) {
        //             // Get ctx from string
        //             var ctx = chart.chart.ctx;

        //             // Get options from the center object in options
        //             var centerConfig = chart.config.options.elements.center;
        //             var fontStyle = centerConfig.fontStyle || 'Arial';
        //             var txt = centerConfig.text;
        //             var color = centerConfig.color || '#000';
        //             var maxFontSize = centerConfig.maxFontSize || 75;
        //             var sidePadding = centerConfig.sidePadding || 20;
        //             var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
        //             // Start with a base font of 30px
        //             ctx.font = "30px " + fontStyle;

        //             // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
        //             var stringWidth = ctx.measureText(txt).width;
        //             var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

        //             // Find out how much the font can grow in width.
        //             var widthRatio = elementWidth / stringWidth;
        //             var newFontSize = Math.floor(30 * widthRatio);
        //             var elementHeight = (chart.innerRadius * 2);

        //             // Pick a new font size so it will not be larger than the height of label.
        //             var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
        //             var minFontSize = centerConfig.minFontSize;
        //             var lineHeight = centerConfig.lineHeight || 25;
        //             var wrapText = false;

        //             if (minFontSize === undefined) {
        //                 minFontSize = 20;
        //             }

        //             if (minFontSize && fontSizeToUse < minFontSize) {
        //                 fontSizeToUse = minFontSize;
        //                 wrapText = true;
        //             }

        //             // Set font settings to draw it correctly.
        //             ctx.textAlign = 'center';
        //             ctx.textBaseline = 'middle';
        //             var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
        //             var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
        //             ctx.font = fontSizeToUse + "px " + fontStyle;
        //             ctx.fillStyle = color;

        //             if (!wrapText) {
        //                 ctx.fillText(txt, centerX, centerY);
        //                 return;
        //             }

        //             var words = txt.split(' ');
        //             var line = '';
        //             var lines = [];

        //             // Break words up into multiple lines if necessary
        //             for (var n = 0; n < words.length; n++) {
        //                 var testLine = line + words[n] + ' ';
        //                 var metrics = ctx.measureText(testLine);
        //                 var testWidth = metrics.width;
        //                 if (testWidth > elementWidth && n > 0) {
        //                     lines.push(line);
        //                     line = words[n] + ' ';
        //                 } else {
        //                     line = testLine;
        //                 }
        //             }

        //             // Move the center up depending on line height and number of lines
        //             centerY -= (lines.length / 2) * lineHeight;

        //             for (var n = 0; n < lines.length; n++) {
        //                 ctx.fillText(lines[n], centerX, centerY);
        //                 centerY += lineHeight;
        //             }
        //             //Draw text in center
        //             ctx.fillText(line, centerX, centerY);
        //         }
        //     }
        // });


        // var config = {
        //     type: 'doughnut',
        //     data: {
        //         labels: ["Uncovered", "Covered"],
        //         datasets: [{
        //             data: [300, 700],
        //             backgroundColor: ["#C21B17", "#30DF8B"],
        //             hoverBackgroundColor: [
        //                 "#C21B17",
        //                 "#30DF8B"
        //             ]
        //         }]
        //     },
        //     options: {
        //         legend: {
        //             display: false // This will hide the label data above the doughnut chart
        //         },
        //         elements: {
        //             center: {
        //                 // text1:{
        //                 //     text: '70%',
        //                 //     color: '#14A38B',
        //                 // }
        //                 text: '70%',
        //                 color: '#14A38B', // Default is #000000
        //                 fontStyle: 'Helvetica Neue', // Default is Arial
        //                 sidePadding: 20, // Default is 20 (as a percentage)
        //                 minFontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
        //                 lineHeight: 25 // Default is 25 (in px), used for when text wraps
        //             }
        //         }
        //     }
        // };

        // var ctx = document.getElementById("totalEducationFund").getContext("2d");
        // var myChart = new Chart(ctx, config);
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
                                display: false // This will hide the label data above the doughnut chart
                            },
                    elements: {
                        center: {
                            // First text style
                            text1: {
                                text: '70%',
                                color: '#14A38B', 
                                fontStyle: 'Helvetica Neue', // Font style for the first text
                                fontSize: 45, // Font size for the first text
                                lineHeight: 40
                            },
                            // Second text style
                            text2: {
                                text: 'Total Education Fund',
                                color: '#000', // Blue color
                                fontStyle: 'Helvetica Neue', // Font style for the second text
                                fontSize: 16, // Font size for the second text
                                lineHeight: 30
                            },
                            sidePadding: 20,
                            minFontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
                            // lineHeight: 25 // Default is 25 (in px), used for when text wraps
                        }
                    }
                }
            };
        Chart.pluginService.register({
            beforeDraw: function(chart) {
                if (chart.config.options.elements.center) {
                    var ctx = chart.chart.ctx;
                    var centerConfig = chart.config.options.elements.center;
                    var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                    var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                    var maxTextWidth = (chart.innerRadius * 2) - (centerConfig.sidePadding || 20) * 2;

                    // Draw the first text (text1)
                    ctx.font = centerConfig.text1.fontSize + "px " + centerConfig.text1.fontStyle;
                    ctx.fillStyle = centerConfig.text1.color;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    // ctx.fillText(centerConfig.text1.text, centerX, centerY - 10); // Adjust the position as needed
                    // Wrap text if necessary
                    var lines1 = wrapText(centerConfig.text1.text, ctx.font, maxTextWidth);
                    var lineHeight1 = centerConfig.text1.fontSize + (centerConfig.lineHeight || 35);
                    var totalHeight1 = lineHeight1 * lines1.length;
                    var startY1 = centerY - totalHeight1 / 2;

                    for (var i = 0; i < lines1.length; i++) {
                        ctx.fillText(lines1[i], centerX, startY1 + i * lineHeight1);
                    }


                    // Set spacing between texts
                    // var spacing = 10;

                    // Draw the second text (text2)
                    ctx.font = centerConfig.text2.fontSize + "px " + centerConfig.text2.fontStyle;
                    ctx.fillStyle = centerConfig.text2.color;
                    // ctx.fillText(centerConfig.text2.text, centerX, centerY + centerConfig.text1.fontSize / 2 + spacing); // Adjust the position as needed

                    // Wrap text if necessary
                    var lines2 = wrapText(centerConfig.text2.text, ctx.font, maxTextWidth);
                    var lineHeight2 = centerConfig.text2.fontSize + (centerConfig.lineHeight || 10);
                    var totalHeight2 = lineHeight2 * lines2.length;
                    var startY2 = centerY + totalHeight2 / 2 - lineHeight2; // Adjust starting position

                    for (var j = 0; j < lines2.length; j++) {
                        ctx.fillText(lines2[j], centerX, startY2 + j * lineHeight2);
                    }
                }
            }
        });
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

        var ctx = document.getElementById("totalEducationFund").getContext("2d");
        var myChart = new Chart(ctx, config);
        
    });
</script>

@endsection