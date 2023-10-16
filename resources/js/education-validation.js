// Array of specific folder names where the script should run
const specificPageURLs = [
    'education',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    if (path === '/education-coverage') {
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
                // const dataAvatarImg = this.querySelector('img').getAttribute('src');

                // Update the hidden input field value with the selected avatar
                document.getElementById('educationSelectedAvatarInput').value = dataAvatar;
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
    else if (path == '/education-amount') {
        // Get the input value
        var education_amount = document.getElementById("tertiary_education_amount");
        var totalEducationFund = document.getElementById("TotalEducationFund");
        var totalEducationFundNeeded = document.getElementById("total_educationNeeded");

        education_amount.addEventListener("input", function() {

            // Retrieve the current input value
            var educationAmountValue = education_amount.value;

            // Remove non-digit characters
            const cleanedValue = parseFloat(educationAmountValue.replace(/\D/g, ''));

            // Attempt to parse the cleaned value as a float
            const parsedValue = parseFloat(cleanedValue);

            // Check if the parsed value is a valid number
            if (!isNaN(parsedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = parsedValue.toLocaleString('en-MY');
                this.value = formattedValue;
            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = educationAmountValue;
            }

            var monthlyAmount = parseInt(cleanedValue);

            if (isNaN(monthlyAmount)) {
                // Input is not a valid number
                totalEducationFund.innerText = "RM 0";
                // displayAvatar.innerText = "RM 0";
            } else {
                // Input is a valid number, perform the calculation
                // Display the result
                var result = monthlyAmount.toLocaleString();

                totalEducationFund.innerText = "RM" + result;
            }

            // Set the value of the hidden input field
            totalEducationFundNeeded.value = monthlyAmount;
        });

        document.addEventListener("DOMContentLoaded", function() {
            education_amount.addEventListener("blur", function() {
                validateNumberField(education_amount);
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
    else if (path == '/education-supporting-years') {

        // Get the input value
        var educationYear = document.getElementById("tertiary_education_years");
    
        document.addEventListener("DOMContentLoaded", function() {
            educationYear.addEventListener("blur", function() {
                validateNumberField(educationYear);
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
    else if (path == '/education-existing-fund') {
        var education_saving = document.getElementById('education_saving_amount');
        var yesRadio = document.getElementById('yes');
        var noRadio = document.getElementById('no');
        var totalAmountNeeded = document.getElementById("total_amountNeeded");
        var totalEducationPercentage = document.getElementById("percentage");

        education_saving.addEventListener("input", function() {

            // Retrieve the current input value
            var educationSavingValue = education_saving.value;
    
            // Remove non-digit characters
            const cleanedValue = parseFloat(educationSavingValue.replace(/\D/g, ''));
    
            // Attempt to parse the cleaned value as a float
            const parsedValue = parseFloat(cleanedValue);
    
            // Check if the parsed value is a valid number
            if (!isNaN(parsedValue)) {
            // If it's a valid number, format it with commas
                const formattedValue = parsedValue.toLocaleString('en-MY');
                this.value = formattedValue;
            } else {
            // If it's not a valid number, display the cleaned value as is
                this.value = educationSavingValue;
            }
    
            var savingAmount = parseInt(cleanedValue);
    
            var total = oldTotalFund - savingAmount;
            var totalPercentage = savingAmount / oldTotalFund * 100;
            
            $('.retirement-progress-bar').css('width', totalPercentage + '%');
            if (total <= 0){
                totalAmountNeeded.value = 0;
                totalEducationPercentage.value = 100;
                $('.retirement-progress-bar').css('width','100%');
            }
            else{
                totalAmountNeeded.value = total;
                totalEducationPercentage.value = totalPercentage;
                $('.retirement-progress-bar').css('width', totalPercentage + '%');
            }
    
        });
        // Add event listeners to the radio buttons
        yesRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','block');
        });
    
        noRadio.addEventListener('change', function () {
            jQuery('.hide-content').css('display','none');
            education_saving.value = 0; // Clear the money input
            totalAmountNeeded.value = oldTotalFund;
            var totalPercentage = 0 / oldTotalFund * 100;
            totalEducationPercentage.value = totalPercentage;
        });
    
        document.addEventListener('DOMContentLoaded', function() {
    
            education_saving.addEventListener('blur', function() {
                validateNumberField(education_saving);
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
                    document.getElementById("education_saving_amount").classList.remove("is-invalid");
                }
            }
        });
        
        if (sessionSavingAmount !== '' || sessionSavingAmount !== 0) {
            var newTotal = oldTotalFund - sessionSavingAmount;
            var newTotalPercentage = sessionSavingAmount / oldTotalFund * 100;
            if (newTotal <= 0){
                totalAmountNeeded.value = 0;
                totalEducationPercentage.value = 100;
                $('.retirement-progress-bar').css('width','100%');
            }
            else{
                totalAmountNeeded.value = newTotal;
                totalEducationPercentage.value = newTotalPercentage;
                $('.retirement-progress-bar').css('width', newTotalPercentage + '%');
            }
        }
    }
    else if (path == '/education-gap') {
        var Uncovered = (100 - Covered).toFixed(2);
        var Covered = (educationSavingAmount / newTotalEducationFundNeeded * 100).toFixed(2);
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
            var startX,startY;

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