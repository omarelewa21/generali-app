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
    if (educationPriority === 'false' || educationPriority === undefined || educationPriority === '' || educationPriority === null || educationPriority === false){
        var missingModal = document.getElementById('missingEducationFields');
        missingModal.classList.add('show');
        missingModal.style.display = 'block';
        document.querySelector('body').style.paddingRight = '0px';
        document.querySelector('body').style.overflow = 'hidden';
        document.querySelector('body').classList.add('modal-open');

        var modalBackdrop = document.createElement('div');
        modalBackdrop.className = 'modal-backdrop fade show';
        document.querySelector('body.modal-open').append(modalBackdrop);

        // Close the modal
        var closeButton = document.querySelector('#missingEducationFields .btn-exit-sidebar');
        closeButton.addEventListener('click', function() {
            missingModal.classList.remove('show');
            missingModal.style.display = 'none';
            document.querySelector('body').style.paddingRight = '';
            document.querySelector('body').style.overflow = '';
            document.querySelector('body').classList.remove('modal-open');
            var modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
            window.location.href = '/financial-priorities/discuss';
        });

    } else{
        if (path === '/education/coverage') {
            if (childData === null || childData === undefined) {
                var nameModal = document.getElementById('missingChildFields');
                nameModal.classList.add('show');
                nameModal.style.display = 'block';
                document.querySelector('body').style.paddingRight = '0px';
                document.querySelector('body').style.overflow = 'hidden';
                document.querySelector('body').classList.add('modal-open');

                var modalBackdrop = document.createElement('div');
                modalBackdrop.className = 'modal-backdrop fade show';
                document.querySelector('body.modal-open').append(modalBackdrop);

                // Close the modal
                var closeButton = document.querySelector('#missingChildFields .btn-exit-sidebar');
                closeButton.addEventListener('click', function() {
                    nameModal.classList.remove('show');
                    nameModal.style.display = 'none';
                    document.querySelector('body').style.paddingRight = '';
                    document.querySelector('body').style.overflow = '';
                    document.querySelector('body').classList.remove('modal-open');
                    var modalBackdrop = document.querySelector('.modal-backdrop');
                    if (modalBackdrop) {
                        modalBackdrop.remove();
                    }
                    window.location.href = '/family-dependent/details';
                });
            } else{
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
        
                        // Get the selected data-avatar value
                        const dataAvatar = this.getAttribute('data-avatar');
                        const dataAvatarDob = this.getAttribute('data-avatar-dob');
                        const dataRelation = this.getAttribute('data-relation');
        
                        // Update the hidden input field value with the selected avatar
                        document.getElementById('relationshipInput').value = dataRelation;
                        document.getElementById('selectedInsuredNameInput').value = dataAvatar;
                        document.getElementById('selectedCoverForDobInput').value = dataAvatarDob;
                        document.getElementById('othersCoverForNameInput').value = '';
                        document.getElementById('othersCoverForDobInput').value = '';
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
        }
        if (path == '/education/amount-needed') {
            if (lastPageInput == null || lastPageInput == undefined || lastPageInput == '') {
                var nameModal = document.getElementById('missingLastPageInputFields');
                nameModal.classList.add('show');
                nameModal.style.display = 'block';
                document.querySelector('body').style.paddingRight = '0px';
                document.querySelector('body').style.overflow = 'hidden';
                document.querySelector('body').classList.add('modal-open');

                var modalBackdrop = document.createElement('div');
                modalBackdrop.className = 'modal-backdrop fade show';
                document.querySelector('body.modal-open').append(modalBackdrop);

                // Close the modal
                var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
                closeButton.addEventListener('click', function() {
                    nameModal.classList.remove('show');
                    nameModal.style.display = 'none';
                    document.querySelector('body').style.paddingRight = '';
                    document.querySelector('body').style.overflow = '';
                    document.querySelector('body').classList.remove('modal-open');
                    var modalBackdrop = document.querySelector('.modal-backdrop');
                    if (modalBackdrop) {
                        modalBackdrop.remove();
                    }
                    window.location.href = '/education/coverage';
                });

            } else{
                // Get the input value
                var educationAmountNeeded = document.getElementById("tertiary_education_amount");
                var supportingYears = document.getElementById("tertiary_education_years");
                var totalEducationFundNeeded = document.getElementById("total_educationNeeded");
        
                var totalEducationFund = document.getElementById("TotalEducationFund");
                var TotalEducationFundMob = document.getElementById("TotalEducationFundMob");
        
                educationAmountNeeded.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var educationAmountNeededValue = educationAmountNeeded.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(educationAmountNeededValue.replace(/\D/g, ''));
                    const educationYear = parseInt(supportingYears.value);
        
                    // Calculate months
                    // var totalEducationAmount = cleanedValue / educationYear;
        
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                        // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        totalEducationFund.innerText = "RM" + formattedValue;
                        TotalEducationFundMob.innerText = "RM" + formattedValue;
                        if (!isNaN(educationYear)){
                            // var result = totalEducationAmount.toLocaleString();
                            totalEducationFund.innerText = "RM" + formattedValue;
                            TotalEducationFundMob.innerText = "RM" + formattedValue;
                        }
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = educationAmountNeededValue;
                        totalEducationFund.innerText = "RM 0";
                        TotalEducationFundMob.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalEducationFundNeeded.value =  cleanedValue;
                });
        
                supportingYears.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var supportingYearsValue = supportingYears.value;
        
                    // var amountNeeded = parseFloat(educationAmountNeeded.value.replace(/\D/g, '')); 
                    var Year = parseInt(supportingYearsValue);
        
                    // Calculate months
                    // var totalAmount =  amountNeeded / Year;
        
                    if (!isNaN(Year)) {
                        // Input is a valid number, perform the calculation
                        // Display the result
                        // var result = totalAmount.toLocaleString();
                        // totalEducationFund.innerText = "RM" + result;
                    } else {
                        // Input is not a valid number
                        this.value = supportingYearsValue;
                        // totalEducationFund.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    // totalEducationFundNeeded.value =  totalAmount;
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    educationAmountNeeded.addEventListener("blur", function() {
                        validateAmountNumberField(educationAmountNeeded);
                    });
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    supportingYears.addEventListener("blur", function() {
                        validateYearsNumberField(supportingYears);
                    });
                });
        
                function validateAmountNumberField(field) {
                    var value = field.value.replace(/,/g, ''); // Remove commas
                    var numericValue = parseFloat(value);
        
                    if (isNaN(numericValue)) {
                        field.classList.add("is-invalid");
        
                    } else {
                        field.classList.remove("is-invalid");
                    }
                }
        
                function validateYearsNumberField(field) {
                    const value = field.value.trim();
        
                    if (value === "" || isNaN(value)) {
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                }
            }
        }
        if (path == '/education/existing-fund') {
            if (lastPageInput == null || lastPageInput == undefined || lastPageInput == '') {
                var nameModal = document.getElementById('missingLastPageInputFields');
                nameModal.classList.add('show');
                nameModal.style.display = 'block';
                document.querySelector('body').style.paddingRight = '0px';
                document.querySelector('body').style.overflow = 'hidden';
                document.querySelector('body').classList.add('modal-open');

                var modalBackdrop = document.createElement('div');
                modalBackdrop.className = 'modal-backdrop fade show';
                document.querySelector('body.modal-open').append(modalBackdrop);

                // Close the modal
                var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
                closeButton.addEventListener('click', function() {
                    nameModal.classList.remove('show');
                    nameModal.style.display = 'none';
                    document.querySelector('body').style.paddingRight = '';
                    document.querySelector('body').style.overflow = '';
                    document.querySelector('body').classList.remove('modal-open');
                    var modalBackdrop = document.querySelector('.modal-backdrop');
                    if (modalBackdrop) {
                        modalBackdrop.remove();
                    }
                    window.location.href = '/education/amount-needed';
                });

            } else{
                var education_saving = document.getElementById('education_saving_amount');
                var yesRadio = document.getElementById('yes');
                var noRadio = document.getElementById('no');
                var totalAmountNeeded = document.getElementById("total_amountNeeded");
                var totalEducationPercentage = document.getElementById("percentage");
                var totalDisplayFund = document.getElementById("TotalEducationFund");
                var TotalEducationFundMob = document.getElementById("TotalEducationFundMob");
        
                education_saving.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var educationSavingValue = education_saving.value;
            
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(educationSavingValue.replace(/\D/g, ''));
        
                    var total = oldTotalFund - cleanedValue;
                    var totalPercentage = cleanedValue / oldTotalFund * 100;
            
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                        // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = total.toLocaleString();
                        if (total <= 0){
                            totalAmountNeeded.value = 0;
                            totalEducationPercentage.value = 100;
                            $('.calculation-progress-bar').css('width','100%');
                            totalDisplayFund.innerText = "RM 0";
                            TotalEducationFundMob.innerText = "RM 0";
                        }
                        else{
                            totalAmountNeeded.value = total;
                            totalEducationPercentage.value = totalPercentage;
                            $('.calculation-progress-bar').css('width', totalPercentage + '%');
                            totalDisplayFund.innerText = "RM" + result;
                            TotalEducationFundMob.innerText = "RM" + result;
                        }
                    } else {
                        // If it's not a valid number, display the cleaned value as is
                        this.value = educationSavingValue;
                        totalDisplayFund.innerText = "RM 0";
                        TotalEducationFundMob.innerText = "RM 0";
                    }
            
                });
                // Add event listeners to the radio buttons
                yesRadio.addEventListener('change', function () {
                    jQuery('.hide-content').css('opacity','1');
                });
            
                noRadio.addEventListener('change', function () {
                    jQuery('.hide-content').css('opacity','0');
                    education_saving.value = ''; // Clear the money input
                    totalAmountNeeded.value = oldTotalFund;
                    var totalPercentage = 0 / oldTotalFund * 100;
                    totalEducationPercentage.value = totalPercentage;
                });
            
                document.addEventListener('DOMContentLoaded', function() {
            
                    education_saving.addEventListener('blur', function() {
                        validateNumberField(education_saving);
                    });
            
                    if (yesRadio.classList.contains('checked-yes')) {
                        jQuery('.hide-content').css('opacity','1');
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
                        $('.calculation-progress-bar').css('width','100%');
                    }
                    else{
                        totalAmountNeeded.value = newTotal;
                        totalEducationPercentage.value = newTotalPercentage;
                        $('.calculation-progress-bar').css('width', newTotalPercentage + '%');
                    }
                }
                if (sessionExistingFund === 'no'){
                    education_saving.value = ''; // Clear the money input
                }
            }
        }
        if (path == '/education/gap') {
            if (!lastPageInput || !('existing_amount' in lastPageInput)) {
                var nameModal = document.getElementById('missingLastPageInputFields');
                nameModal.classList.add('show');
                nameModal.style.display = 'block';
                document.querySelector('body').style.paddingRight = '0px';
                document.querySelector('body').style.overflow = 'hidden';
                document.querySelector('body').classList.add('modal-open');

                var modalBackdrop = document.createElement('div');
                modalBackdrop.className = 'modal-backdrop fade show';
                document.querySelector('body.modal-open').append(modalBackdrop);

                // Close the modal
                var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
                closeButton.addEventListener('click', function() {
                    nameModal.classList.remove('show');
                    nameModal.style.display = 'none';
                    document.querySelector('body').style.paddingRight = '';
                    document.querySelector('body').style.overflow = '';
                    document.querySelector('body').classList.remove('modal-open');
                    var modalBackdrop = document.querySelector('.modal-backdrop');
                    if (modalBackdrop) {
                        modalBackdrop.remove();
                    }
                    window.location.href = '/education/existing-fund';
                });

            } else{
                var Uncovered = (100 - Covered).toFixed(2);
                var Covered = (educationSavingAmount / newTotalEducationFundNeeded * 100).toFixed(2);
                var circle = document.getElementById("circle");
                var dotCircle = document.getElementById("dotCircle");
        
                circle.style.strokeDasharray = 904.896;
                let change = 904.896 - (904.896 * Covered) / 100; 
                if (change < 0) {
                    change = 0; // 0 represents 100% coverage
                    circle.style.strokeDashoffset = change;
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
    }
}