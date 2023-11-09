// Array of specific folder names where the script should run
const specificPageURLs = [
    'debt-cancellation',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    if (path === '/debt-cancellation-coverage') {
        // Add event listener to each button with the 'data-required' attribute
        const dataButtons = document.querySelectorAll('[data-avatar]');

        dataButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click

                dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                // Add 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');

                dataButtons.forEach(btn => btn.classList.remove('selected'));

                // Get the selected data-avatar value
                const dataAvatar = this.getAttribute('data-avatar');

                // Update the hidden input field value with the selected avatar
                document.getElementById('debtSelectedAvatarInput').value = dataAvatar;
            });
        });

        // Preselect the button on page load
        window.addEventListener('DOMContentLoaded', function() {
            const defaultBtn = document.querySelectorAll('.default');

            defaultBtn.forEach(defaultBtn => {
                // Add the 'selected' class to the closest .button-bg div of each default button
                defaultBtn.classList.add('selected');
            });
        });
    } 
    else if (path == '/debt-cancellation-outstanding-loan') {
        // Get the input value
        var outstandingLoan = document.getElementById("debt_outstanding_loan");
        var totalDebtNeeded = document.getElementById("total_debtFund");
        var totalDebtFund = document.getElementById("TotalDebtCancellationFund");

        outstandingLoan.addEventListener("input", function() {

            // Retrieve the current input value
            var outstandingLoanValue = outstandingLoan.value;

            // Remove non-digit characters
            const cleanedValue = parseFloat(outstandingLoanValue.replace(/\D/g, ''));

            // Attempt to parse the cleaned value as a float
            const parsedValue = parseFloat(cleanedValue);

            // Check if the parsed value is a valid number
            if (!isNaN(parsedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = parsedValue.toLocaleString('en-MY');
                this.value = formattedValue;
                // Display the result
                totalDebtFund.innerText = "RM" + formattedValue;
            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = outstandingLoanValue;
                totalDebtFund.innerText = "RM 0";
            }

            // Set the value of the hidden input field
            totalDebtNeeded.value = parsedValue;
        });

        document.addEventListener("DOMContentLoaded", function() {
            outstandingLoan.addEventListener("blur", function() {
                validateNumberField(outstandingLoan);
            });
        });

        function validateNumberField(field) {
            var value = field.value.replace(/,/g, ''); // Remove commas
            var numericValue = parseFloat(value);

            if (isNaN(numericValue)) {
                field.classList.add("is-invalid");

            } else {
                field.classList.remove("is-invalid");
            }
        }
    }
    else if (path == '/debt-cancellation-settlement-years') {

        // Get the input value
        var debtSettlementYears = document.getElementById("debt_settlement_years");
    
        document.addEventListener("DOMContentLoaded", function() {
            debtSettlementYears.addEventListener("blur", function() {
                validateNumberField(debtSettlementYears);
            });
        });

        function validateNumberField(field) {
            const value = field.value.trim();

            if (value === "" || isNaN(value)) {
                field.classList.add("is-invalid");
            } else {
                var Year = parseInt(value);
                if(Year > 99 || Year < 1){
                    field.classList.add("is-invalid");
                }
                else{
                    field.classList.remove("is-invalid");
                }
            }
        }
    }
    else if (path == '/debt-cancellation-existing-debt') {
        var existing_debt_amount = document.getElementById('existing_debt_amount');
        var yesRadio = document.getElementById('yes');
        var noRadio = document.getElementById('no');
        var totalAmountNeeded = document.getElementById("total_amountNeeded");
        var totalDebtPercentage = document.getElementById("percentage");
        var totalDisplayFund = document.getElementById("TotalDebtCancellationFund");

        existing_debt_amount.addEventListener("input", function() {

            // Retrieve the current input value
            var existingDebtAmountValue = existing_debt_amount.value;
    
            // Remove non-digit characters
            const cleanedValue = parseFloat(existingDebtAmountValue.replace(/\D/g, ''));

            var existingAmount = parseInt(cleanedValue);
    
            var total = oldTotalFund - existingAmount;
            var totalPercentage = existingAmount / oldTotalFund * 100;
    
            // Check if the parsed value is a valid number
            if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = cleanedValue.toLocaleString('en-MY');
                this.value = formattedValue;
                var result = total.toLocaleString();
                if (total <= 0){
                    totalAmountNeeded.value = 0;
                    totalDebtPercentage.value = 100;
                    $('.retirement-progress-bar').css('width','100%');
                    totalDisplayFund.innerText = "RM 0";
                }
                else{
                    totalAmountNeeded.value = total;
                    totalDebtPercentage.value = totalPercentage;
                    $('.retirement-progress-bar').css('width', totalPercentage + '%');
                    totalDisplayFund.innerText = "RM" + result;
                }

            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = existingDebtAmountValue;
                totalDisplayFund.innerText = "RM 0";
            }
    
        });
        // Add event listeners to the radio buttons
        yesRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','block');
        });
    
        noRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','none');
            existing_debt_amount.value = 0; // Clear the money input
            totalAmountNeeded.value = oldTotalFund;
            var totalPercentage = 0 / oldTotalFund * 100;
            totalDebtPercentage.value = totalPercentage;
        });
    
        document.addEventListener('DOMContentLoaded', function() {
    
            existing_debt_amount.addEventListener('blur', function() {
                validateNumberField(existing_debt_amount);
            });
    
            if (yesRadio.classList.contains('checked-yes')) {
                jQuery('.hide-content').css('display','block');
            }
            
            function validateNumberField(field) {
    
                const value = field.value.trim();
                var pattern = /^[0-9,]+$/;
    
                if (value === '' || isNaN(value)) {
                    // field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                } else {
                    // field.classList.add('is-valid');
                    field.classList.remove('is-invalid');
                }
                if (pattern.test(value)){
                    document.getElementById("existing_debt_amount").classList.remove("is-invalid");
                }
            }
        });
        
        if (sessionExistingDebtAmount !== '' || sessionExistingDebtAmount !== 0) {
            var newTotal = oldTotalFund - sessionExistingDebtAmount;
            var newTotalPercentage = sessionExistingDebtAmount / oldTotalFund * 100;
            if (newTotal <= 0){
                totalAmountNeeded.value = 0;
                totalDebtPercentage.value = 100;
                $('.retirement-progress-bar').css('width','100%');
            }
            else{
                totalAmountNeeded.value = newTotal;
                totalDebtPercentage.value = newTotalPercentage;
                $('.retirement-progress-bar').css('width', newTotalPercentage + '%');
            }
        }
    }
    else if (path == '/debt-cancellation-critical-illness') {
        var critical_coverage_amount = document.getElementById('critical_coverage_amount');
        var yesRadio = document.getElementById('yes');
        var noRadio = document.getElementById('no');

        critical_coverage_amount.addEventListener("input", function() {

            // Retrieve the current input value
            var criticalCoverageAmountValue = critical_coverage_amount.value;
    
            // Remove non-digit characters
            const cleanedValue = parseFloat(criticalCoverageAmountValue.replace(/\D/g, ''));
    
            // Check if the parsed value is a valid number
            if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = cleanedValue.toLocaleString('en-MY');
                this.value = formattedValue;

            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = criticalCoverageAmountValue;
            }
    
        });

        // Add event listeners to the radio buttons
        yesRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','block');
        });
    
        noRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','none');
            critical_coverage_amount.value = 0; // Clear the money input
        });
    
        document.addEventListener('DOMContentLoaded', function() {
    
            critical_coverage_amount.addEventListener('blur', function() {
                validateNumberField(critical_coverage_amount);
            });
    
            if (yesRadio.classList.contains('checked-yes')) {
                jQuery('.hide-content').css('display','block');
            }
            
            function validateNumberField(field) {
    
                const value = field.value.trim();
                var pattern = /^[0-9,]+$/;
    
                if (value === '' || isNaN(value)) {
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
                if (pattern.test(value)){
                    document.getElementById("critical_coverage_amount").classList.remove("is-invalid");
                }
            }
        });
    }
    else if (path == '/debt-cancellation-gap') {
        var Uncovered = (100 - Covered).toFixed(2);
        var Covered = (existingDebtAmount / totalDebtFundNeeded * 100).toFixed(2);
        var circle = document.getElementById("circle");
        var dotCircle = document.getElementById("dotCircle");
        
        circle.style.strokeDasharray = 904.896;
        let change = 904.896 - (904.896 * Covered) / 100; 
        if (change < 0) {
            change = 0; // 0 represents 100% coverage
            circle.style.strokeDashoffset = change;
            // console.log('change', change);
        }
        else   {
            circle.style.strokeDashoffset = change; // 904.896 represents 0% coverage
            
            // // Calculate the position for the dotCircle based on the end point of the graph
            const percent = Math.floor(percentage);
            var startX, startY;

            if ( percent === 0 || percent >= 100){
            }
            else{
                dotCircle.style.display = "block";
                if (percent === 1 || percent === 2){
                    startX = 234;
                    startY = 90;
                    var x = startX - percent;
                    var y = startY += 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 3 && percent <= 6){
                    startX = 238;
                    startY = 94;
                    var x = startX -= 2 * percent;
                    var y = startY += 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 7 && percent <= 10){
                    startX = 250;
                    startY = 92;
                    var x = startX -= 4 * percent;
                    var y = startY += 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 11 && percent <= 15){
                    startX = 260;
                    startY = 110;
                    var x = startX -= 5 * percent;
                    var y = startY += 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 16 && percent <= 21){
                    startX = 300;
                    startY = 145;
                    var x = startX -= 8 * percent;
                    var y = startY += 4 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 22 && percent <= 26){
                    startX = 340;
                    startY = 209;
                    var x = startX -= 10 * percent;
                    var y = startY + percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 27 && percent <= 28){
                    startX = 289;
                    startY = 205;
                    var x = startX -= 8 * percent;
                    var y = startY + percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if(percent === 29){
                    dotCircle.setAttribute("cx", "50");
                    dotCircle.setAttribute("cy", "229");
                }
                else if (percent === 30 ){
                    dotCircle.setAttribute("cx", "44");
                    dotCircle.setAttribute("cy", "226");
                }
                else if (percent >= 31 && percent <= 35){
                    startX = 355;
                    startY = 384;
                    var x = startX -= 10 * percent;
                    var y = startY -= 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 36 && percent <= 42){
                    startX = 180;
                    startY = 385;
                    var x = startX -= 5 * percent;
                    var y = startY -= 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 43 && percent <= 47){
                    startX = 90;
                    startY = 500;
                    var x = startX -= 3 * percent;
                    var y = startY -= 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 48 && percent <= 49){
                    startX = 93;
                    startY = 492;
                    var x = startX -= 3 * percent;
                    var y = startY -= 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent === 50 ){
                    dotCircle.setAttribute("cx", "-55");
                    dotCircle.setAttribute("cy", "90");
                }
                else if (percent >= 51 && percent <= 58){
                    startX = -157;
                    startY = 492;
                    var x = startX += 2 * percent;
                    var y = startY -= 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 59 && percent <= 61){
                    startX = -207;
                    startY = 364;
                    var x = startX += 3 * percent;
                    var y = startY -= 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 62 && percent <= 64){
                    startX = -325;
                    startY = 364;
                    var x = startX += 5 * percent;
                    var y = startY -= 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 65 && percent <= 67){
                    startX = -386;
                    startY = 300;
                    var x = startX += 6 * percent;
                    var y = startY -= 5 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 68 && percent <= 69){
                    startX = -318;
                    startY = 166;
                    var x = startX += 5 * percent;
                    var y = startY -= 3 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y); -38
                }
                else if (percent === 70 ){
                    dotCircle.setAttribute("cx", "46");
                    dotCircle.setAttribute("cy", "-47");
                }
                else if (percent >= 71 && percent <= 77){
                    startX = -518;
                    startY = 22;
                    var x = startX += 8 * percent; 
                    var y = startY - percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 78 && percent <= 80){
                    startX = -670;
                    startY = -209;
                    var x = startX += 10 * percent; 
                    var y = startY += 2 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 81 && percent <= 85){
                    startX = -508;
                    startY = -370;
                    var x = startX += 8 * percent; 
                    var y = startY += 4 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 86 && percent <= 90){
                    startX = -336;
                    startY = -539;
                    var x = startX += 6 * percent; 
                    var y = startY += 6 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 91 && percent <= 93){
                    startX = -245;
                    startY = -718;
                    var x = startX += 5 * percent; 
                    var y = startY += 8 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent >= 94 && percent <= 97){
                    startX = 37;
                    startY = -620;
                    var x = startX += 2 * percent; 
                    var y = startY += 7 * percent;
                    dotCircle.setAttribute("cx", x);
                    dotCircle.setAttribute("cy", y);
                }
                else if (percent === 98){
                    dotCircle.setAttribute("cx", "231");
                    dotCircle.setAttribute("cy", "59");
                }
                else if (percent === 99){
                    dotCircle.setAttribute("cx", "235");
                    dotCircle.setAttribute("cy", "90");
                }
            }
        }
    }
}