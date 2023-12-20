// Array of specific folder names where the script should run
const specificPageURLs = [
    'protection',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    if (protectionPriority === 'false' || protectionPriority === undefined || protectionPriority === '' || protectionPriority === null || protectionPriority === false){
        var missingModal = document.getElementById('missingProtectionFields');
        missingModal.classList.add('show');
        missingModal.style.display = 'block';
        document.querySelector('body').style.paddingRight = '0px';
        document.querySelector('body').style.overflow = 'hidden';
        document.querySelector('body').classList.add('modal-open');

        var modalBackdrop = document.createElement('div');
        modalBackdrop.className = 'modal-backdrop fade show';
        document.querySelector('body.modal-open').append(modalBackdrop);

        // Close the modal
        var closeButton = document.querySelector('#missingProtectionFields .btn-exit-sidebar');
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
        if (path === '/protection/coverage') {
            if (selfData == null || selfData == undefined || selfData == '') {
                var nameModal = document.getElementById('missingSelfFields');
                nameModal.classList.add('show');
                nameModal.style.display = 'block';
                document.querySelector('body').style.paddingRight = '0px';
                document.querySelector('body').style.overflow = 'hidden';
                document.querySelector('body').classList.add('modal-open');

                var modalBackdrop = document.createElement('div');
                modalBackdrop.className = 'modal-backdrop fade show';
                document.querySelector('body.modal-open').append(modalBackdrop);

                // Close the modal
                var closeButton = document.querySelector('#missingSelfFields .btn-exit-sidebar');
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
                    window.location.href = '/basic-details';
                });

            } else if(familyDependent){
                if(spouseDatas){
                    if (spouseData == null || spouseData == undefined || spouseData == '') {
                        var nameModal = document.getElementById('missingSpouseFields');
                        nameModal.classList.add('show');
                        nameModal.style.display = 'block';
                        document.querySelector('body').style.paddingRight = '0px';
                        document.querySelector('body').style.overflow = 'hidden';
                        document.querySelector('body').classList.add('modal-open');
    
                        var modalBackdrop = document.createElement('div');
                        modalBackdrop.className = 'modal-backdrop fade show';
                        document.querySelector('body.modal-open').append(modalBackdrop);
    
                        // Close the modal
                        var closeButton = document.querySelector('#missingSpouseFields .btn-exit-sidebar');
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
                            window.location.href = '/family-dependant/details';
                        });
                    }  
                }
                if(childDatas){
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
                            window.location.href = '/family-dependant/details';
                        });
                    } 
                }
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
                        // const dataAvatarImg = this.querySelector('img').getAttribute('src');
        
                        // Update the hidden input field value with the selected avatar
                        document.getElementById('relationshipInput').value = dataRelation;
                        document.getElementById('selectedInsuredNameInput').value = '';
                        document.getElementById('selectedCoverForDobInput').value = '';
                        document.getElementById('othersCoverForNameInput').value = '';
                        document.getElementById('othersCoverForDobInput').value = '';
                        if (dataRelation == 'Spouse'){
                            document.getElementById('othersCoverForNameInput').value = dataAvatar;
                            document.getElementById('othersCoverForDobInput').value = dataAvatarDob;
                        }
                        if(dataRelation == 'Child') {
                            document.getElementById('selectedInsuredNameInput').value = dataAvatar;
                            document.getElementById('selectedCoverForDobInput').value = dataAvatarDob;
                        }
                        // document.getElementById('protectionSelectedAvatarImage').value = dataAvatarImg;
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
        if (path == '/protection/amount-needed') {

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
                    window.location.href = '/protection/coverage';
                });

            } else{
                // Get the input value
                var monthlyInput = document.getElementById("protection_monthly_support");
                var supportingYears = document.getElementById("protection_supporting_years");
                var totalProtectionNeeded = document.getElementById("total_protectionNeeded");
        
                var totalProtectionFund = document.getElementById("TotalProtectionFund");
        
                monthlyInput.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var monthlyInputValue = monthlyInput.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));
                    const protectionYears = parseInt(supportingYears.value);
        
                    // Calculate months
                    var amountPerYear = cleanedValue * 12;
                    var totalProtection = protectionYears * amountPerYear;
        
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                        // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = amountPerYear.toLocaleString();
                        totalProtectionFund.innerText = "RM" + result;
                        if (!isNaN(protectionYears)){
                            var result = totalProtection.toLocaleString();
                            totalProtectionFund.innerText = "RM" + result;
                        }
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = monthlyInputValue;
                        totalProtectionFund.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalProtectionNeeded.value =  totalProtection;
                });
        
                supportingYears.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var supportingYearsValue = supportingYears.value;
        
                    var amountNeeded = parseFloat(monthlyInput.value.replace(/\D/g, '')) * 12; 
                    var Year = parseInt(supportingYearsValue);
        
                    // Calculate months
                    var totalAmount = Year * amountNeeded;
        
                    if (!isNaN(Year)) {
                        // Input is a valid number, perform the calculation
                        // Display the result
                        var result = totalAmount.toLocaleString();
                        totalProtectionFund.innerText = "RM" + result;
                    } else {
                        // Input is not a valid number
                        this.value = supportingYearsValue;
                        totalProtectionFund.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalProtectionNeeded.value =  totalAmount;
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    monthlyInput.addEventListener("blur", function() {
                        validateAmountNumberField(monthlyInput);
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
        // else if (path == '/protection-monthly-support') {
        //     // Get the input value
        //     var monthlyInput = document.getElementById("protection_monthly_support");
        //     var totalProtectionNeeded = document.getElementById("total_protectionNeeded");
    
        //     var totalProtectionFund = document.getElementById("TotalProtectionFund");
    
        //     monthlyInput.addEventListener("input", function() {
    
        //         // Retrieve the current input value
        //         var monthlyInputValue = monthlyInput.value;
    
        //         // Remove non-digit characters
        //         const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));
    
        //         // Attempt to parse the cleaned value as a float
        //         const parsedValue = parseFloat(cleanedValue);
    
        //         // Check if the parsed value is a valid number
        //         if (!isNaN(parsedValue)) {
        //         // If it's a valid number, format it with commas
        //             const formattedValue = parsedValue.toLocaleString('en-MY');
        //             this.value = formattedValue;
        //         } else {
        //         // If it's not a valid number, display the cleaned value as is
        //             this.value = monthlyInputValue;
        //         }
    
        //         var monthlyAmount = parseInt(cleanedValue);
    
        //         // Calculate months
        //         var amountPerYear = monthlyAmount * 12;
    
        //         if (isNaN(monthlyAmount)) {
        //             // Input is not a valid number
        //             totalProtectionFund.innerText = "RM 0";
        //         } else {
        //             // Input is a valid number, perform the calculation
        //             // Display the result
        //             var result = amountPerYear.toLocaleString();
    
        //             totalProtectionFund.innerText = "RM" + result;
        //         }
    
        //         // Set the value of the hidden input field
        //         totalProtectionNeeded.value = amountPerYear;
        //     });
    
        //     document.addEventListener("DOMContentLoaded", function() {
        //         monthlyInput.addEventListener("blur", function() {
        //             validateNumberField(monthlyInput);
        //         });
        //     });
    
        //     function validateNumberField(field) {
        //         var value = field.value.replace(/,/g, ''); // Remove commas
        //         var numericValue = parseFloat(value);
    
        //         if (isNaN(numericValue)) {
        //             field.classList.add("is-invalid");
    
        //         } else {
        //             field.classList.remove("is-invalid");
        //         }
        //     }
        // }
        // else if (path == '/protection-supporting-years') {
        //     // Get the input value
    
        //     var supportingYears = document.getElementById("protection_supporting_years");
        //     var newTotalFund = document.getElementById("newTotal_protectionNeeded");
            
        //     var totalProtectionFund = document.getElementById("TotalProtectionFund");
    
        //     if (supportingYearsSessionValue !== '' || supportingYearsSessionValue !== 0 && oldTotalFund !== '') {
        //             newTotalFund.value = supportingYearsSessionValue * oldTotalFund;
        //     } 
            
    
        //     supportingYears.addEventListener("input", function() {
    
        //         // Retrieve the current input value
        //         var supportingYearsValue = supportingYears.value;
    
        //         var Year = parseInt(supportingYearsValue);
    
        //         // Calculate months
        //         var totalAmount = Year * oldTotalFund;
    
        //         if (isNaN(Year)) {
        //             // Input is not a valid number
        //             totalProtectionFund.innerText = "RM 0";
        //         } else {
        //             // Input is a valid number, perform the calculation
        //             // Display the result
        //             var result = totalAmount.toLocaleString();
    
        //             totalProtectionFund.innerText = "RM" + result;
        //         }
                
        //         newTotalFund.value = Year * oldTotalFund;
                
        //     });
        
        //     document.addEventListener("DOMContentLoaded", function() {
        //         supportingYears.addEventListener("blur", function() {
        //             validateNumberField(supportingYears);
        //         });
        //     });
    
        //     function validateNumberField(field) {
        //         const value = field.value.trim();
    
        //         if (value === "" || isNaN(value)) {
        //             field.classList.add("is-invalid");
        //         } else {
        //             field.classList.remove("is-invalid");
        //         }
        //     }
        // }
        if (path == '/protection/existing-policy') {
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
                    window.location.href = '/protection/amount-needed';
                });

            } else{
                var existing_policy_amount = document.getElementById('existing_policy_amount');
                var yesRadio = document.getElementById('yes');
                var noRadio = document.getElementById('no');
                var totalAmountNeeded = document.getElementById("total_amountNeeded");
                var totalProtectionPercentage = document.getElementById("percentage");
                var totalDisplayFund = document.getElementById("TotalProtectionFund");
        
                existing_policy_amount.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var existingPolicyAmountValue = existing_policy_amount.value;
            
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(existingPolicyAmountValue.replace(/\D/g, ''));
        
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
                            totalProtectionPercentage.value = 100;
                            $('.calculation-progress-bar').css('width','100%');
                            totalDisplayFund.innerText = "RM 0";
                        }
                        else{
                            totalAmountNeeded.value = total;
                            totalProtectionPercentage.value = totalPercentage;
                            $('.calculation-progress-bar').css('width', totalPercentage + '%');
                            totalDisplayFund.innerText = "RM" + result;
                        }
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = existingPolicyAmountValue;
                        totalDisplayFund.innerText = "RM 0";
                    }
            
                });
                // Add event listeners to the radio buttons
                yesRadio.addEventListener('change', function () {
                    jQuery('.hide-content').css('opacity','1');
                });
            
                noRadio.addEventListener('change', function () {
                    jQuery('.hide-content').css('opacity','0');
                    existing_policy_amount.value = ''; // Clear the money input
                    totalAmountNeeded.value = oldTotalFund;
                    var totalPercentage = 0 / oldTotalFund * 100;
                    totalProtectionPercentage.value = totalPercentage;
                });
            
                document.addEventListener('DOMContentLoaded', function() {
            
                    existing_policy_amount.addEventListener('blur', function() {
                        validateNumberField(existing_policy_amount);
                    });
            
                    if (yesRadio.classList.contains('checked-yes')) {
                        jQuery('.hide-content').css('opacity','1');
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
                        $('.calculation-progress-bar').css('width','100%');
                    }
                    else{
                        totalAmountNeeded.value = newTotal;
                        totalProtectionPercentage.value = newTotalPercentage;
                        $('.calculation-progress-bar').css('width', newTotalPercentage + '%');
                    }
                }
                if (sessionExistingPolicy === 'no'){
                    existing_policy_amount.value = ''; // Clear the money input
                }
            }
        }
        if (path == '/protection/gap') {
            if (!lastPageInput || !('existingPolicyAmount' in lastPageInput)) {
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
                    window.location.href = '/protection/existing-policy';
                });

            } else{
                var Uncovered = (100 - Covered).toFixed(2);
                var Covered = (existingPolicyAmount / newTotalProtectionNeeded * 100).toFixed(2);
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

    }
}