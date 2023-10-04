// Array of specific folder names where the script should run
const specificPageURLs = [
    'retirement',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    if (path === '/retirement-coverage') {
        // Add event listener to each button with the 'data-required' attribute
        const dataButtons = document.querySelectorAll('[data-avatar]');

        dataButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click

                dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                // Add 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');

                // selectedAvatar = this.getAttribute('data-required');

                dataButtons.forEach(btn => btn.classList.remove('selected'));

                const nextButton = document.getElementById('nextButton');

                // Get the selected data-avatar value
                const dataAvatar = this.getAttribute('data-avatar');
                const dataAvatarImg = this.querySelector('img').getAttribute('src');

                // Update the hidden input field value with the selected avatar
                document.getElementById('retirementSelectedAvatarInput').value = dataAvatar;
                document.getElementById('retirementSelectedAvatarImage').value = dataAvatarImg;
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
    else if (path == '/retirement-ideal') {
        jQuery('#retirement-ideal .slick-slide').addClass("p-2");

        // Add event listener to each button with the 'data-required' attribute
        const dataButtons = document.querySelectorAll('[data-avatar]');

        dataButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click

                dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                // Add 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');

                dataButtons.forEach(btn => btn.classList.remove('selected'));

                const nextButton = document.getElementById('nextButton');

                // Get the selected data-avatar value
                const dataAvatar = this.getAttribute('data-avatar');

                // Update the hidden input field value with the selected avatar
                document.getElementById('retirementIdealInput').value = dataAvatar;
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
    else if (path == '/retirement-monthly-support') {
        // Get the input value
        var monthlyInput = document.getElementById("retirement_monthly_support");
        var totalRetirementNeeded = document.getElementById("total_retirementNeeded");

        var totalRetirementFund = document.getElementById("TotalRetirementFund");

        monthlyInput.addEventListener("input", function() {

            // Retrieve the current input value
            var monthlyInputValue = monthlyInput.value;

            // Remove non-digit characters
            const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));

            // Attempt to parse the cleaned value as a float
            const parsedValue = parseFloat(cleanedValue);

            // Check if the parsed value is a valid number
            if (!isNaN(parsedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = parsedValue.toLocaleString('en-MY');
                this.value = formattedValue;
            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = monthlyInputValue;
            }

            var monthlyAmount = parseInt(cleanedValue);

            // Calculate months
            var amountPerYear = monthlyAmount * 12;

            if (isNaN(monthlyAmount)) {
                // Input is not a valid number
                totalProtectionFund.innerText = "RM 0";
                displayAvatar.innerText = "RM 0";
            } else {
                // Input is a valid number, perform the calculation
                // Display the result
                var result = amountPerYear.toLocaleString();

                totalRetirementFund.innerText = "RM " + result;
            }

            // Set the value of the hidden input field
            totalRetirementNeeded.value = amountPerYear;
        });

        document.addEventListener("DOMContentLoaded", function() {
            monthlyInput.addEventListener("blur", function() {
                validateNumberField(monthlyInput);
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
    else if (path == '/retirement-retire-age') {
        // Get the input value

        var retirementAge = document.getElementById("retirement_age");
        var newTotalFund = document.getElementById("newTotal_retirementNeeded");
        
        var totalRetirementFund = document.getElementById("TotalRetirementFund");

        if (retirementAgeSessionValue !== '' || retirementAgeSessionValue !== 0 && oldTotalFund !== '') {
                newTotalFund.value = retirementAgeSessionValue * oldTotalFund;
        } 
        

        retirementAge.addEventListener("input", function() {

            // Retrieve the current input value
            var retirementAgeValue = retirementAge.value;

            var Year = parseInt(retirementAgeValue);

            // Calculate months
            var totalAmount = Year * oldTotalFund;

            if (isNaN(Year)) {
                // Input is not a valid number
                totalRetirementFund.innerText = "RM 0";
            } else {
                // Input is a valid number, perform the calculation
                // Display the result
                var result = totalAmount.toLocaleString();

                totalRetirementFund.innerText = "RM " + result;
            }
            
            newTotalFund.value = Year * oldTotalFund;
            
        });
    
        document.addEventListener("DOMContentLoaded", function() {
            retirementAge.addEventListener("blur", function() {
                validateNumberField(retirementAge);
            });
        });

        function validateNumberField(field) {
            const value = field.value.trim();

            if (value === "" || isNaN(value)) {
                field.classList.add("is-invalid");
            } else {
                field.classList.remove("is-invalid");
            }
        }
    }
    else if (path == '/protection-existing-policy') {
        var existing_policy_amount = document.getElementById('existing_policy_amount');
        var yesRadio = document.getElementById('yes');
        var noRadio = document.getElementById('no');
        var totalAmountNeeded = document.getElementById("total_amountNeeded");
        var totalProtectionPercentage = document.getElementById("percentage");

        existing_policy_amount.addEventListener("input", function() {

            // Retrieve the current input value
            var existingPolicyAmountValue = existing_policy_amount.value;
    
            // Remove non-digit characters
            const cleanedValue = parseFloat(existingPolicyAmountValue.replace(/\D/g, ''));
    
            // Check if the parsed value is a valid number
            if (!isNaN(cleanedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = cleanedValue.toLocaleString('en-MY');
                this.value = formattedValue;
            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = existingPolicyAmountValue;
            }
    
            var existingAmount = parseInt(cleanedValue);
    
            var total = oldTotalFund - existingAmount;
            var totalPercentage = existingAmount / oldTotalFund * 100;
            
            $('.retirement-progress-bar').css('width', totalPercentage + '%');
            if (total <= 0){
                totalAmountNeeded.value = 0;
                totalProtectionPercentage.value = 100;
                $('.retirement-progress-bar').css('width','100%');
            }
            else{
                totalAmountNeeded.value = total;
                totalProtectionPercentage.value = totalPercentage;
                $('.retirement-progress-bar').css('width', totalPercentage + '%');
            }
    
        });
        // Add event listeners to the radio buttons
        yesRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','block');
        });
    
        noRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','none');
            existing_policy_amount.value = 0; // Clear the money input
            totalAmountNeeded.value = oldTotalFund;
            var totalPercentage = 0 / oldTotalFund * 100;
            totalProtectionPercentage.value = totalPercentage;
        });
    
        document.addEventListener('DOMContentLoaded', function() {
    
            existing_policy_amount.addEventListener('blur', function() {
                validateNumberField(existing_policy_amount);
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
                    document.getElementById("existing_policy_amount").classList.remove("is-invalid");
                }
            }
        });
        
        if (sessionExistingPolicyAmount !== '' || sessionExistingPolicyAmount !== 0) {
            var newTotal = oldTotalFund - sessionExistingPolicyAmount;
            var newTotalPercentage = sessionExistingPolicyAmount / oldTotalFund * 100;
            if (newTotal <= 0){
                totalAmountNeeded.value = 0;
                totalProtectionPercentage.value = 100;
                $('.retirement-progress-bar').css('width','100%');
            }
            else{
                totalAmountNeeded.value = newTotal;
                totalProtectionPercentage.value = newTotalPercentage;
                $('.retirement-progress-bar').css('width', newTotalPercentage + '%');
            }
        }
    }
    else if (path == '/protection-gap') {
        var Uncovered = (100 - Covered).toFixed(2);
        var Covered = (existingPolicyAmount / newTotalProtectionNeeded * 100).toFixed(2);
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
            const percent = Math.round(percentage);
            var startX, startY;

            if (percent === 100 || percent === 0){
                dotCircle.style.display = "none";
            }
            else{
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