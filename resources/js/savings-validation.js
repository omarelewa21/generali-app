// Array of specific folder names where the script should run
const specificPageURLs = [
    'savings',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    if (savingsPriority === 'false' || savingsPriority === undefined || savingsPriority === '' || savingsPriority === null || savingsPriority === false){
        var missingModal = document.getElementById('missingSavingsFields');
        missingModal.classList.add('show');
        missingModal.style.display = 'block';
        document.querySelector('body').style.paddingRight = '0px';
        document.querySelector('body').style.overflow = 'hidden';
        document.querySelector('body').classList.add('modal-open');

        var modalBackdrop = document.createElement('div');
        modalBackdrop.className = 'modal-backdrop fade show';
        document.querySelector('body.modal-open').append(modalBackdrop);

        // Close the modal
        var closeButton = document.querySelector('#missingSavingsFields .btn-exit-sidebar');
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
        
        if (path === '/savings/coverage') {
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
                
            }
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
                    const dataAvatarDob = this.getAttribute('data-avatar-dob');
                    const dataRelation = this.getAttribute('data-relation');
    
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
        if (path === '/savings/goals') {
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
                    window.location.href = '/savings/coverage';
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
        
                        dataButtons.forEach(btn => btn.classList.remove('selected'));
        
                        // Get the selected data-avatar value
                        const dataRelation = this.getAttribute('data-relation');
        
                        // Update the hidden input field value with the selected avatar
                        document.getElementById('relationshipInput').value = dataRelation;
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

                var goalsAmount = document.getElementById("savings_goals_amount");
        
                goalsAmount.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var goalsAmountValue = goalsAmount.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(goalsAmountValue.replace(/\D/g, ''));
        
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                    // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = goalsAmountValue;
                    }
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    goalsAmount.addEventListener("blur", function() {
                        validateNumberField(goalsAmount);
                    });
                });
        
                function validateNumberField(field) {
                    var value = field.value.replace(/,/g, ''); // Remove commas
                    var numericValue = parseFloat(value);
        
                    if (isNaN(numericValue)) {
                        // field.classList.remove("is-valid");
                        field.classList.add("is-invalid");
        
                    } else {
                        // field.classList.add("is-valid");
                        field.classList.remove("is-invalid");
                    }
                }
                function updateHiddenInputValue() {
                    var savingsGoalsButtonInput = document.getElementById('savingsGoalsButtonInput');
                    savingsGoalsButtonInput.value = JSON.stringify(addedNeedsImages);
                }
            }
        }
        if (path == '/savings/amount-needed') {
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
                    window.location.href = '/savings/goals';
                });

            } else{
                // Get the input value
                var monthlyInput = document.getElementById("savings_monthly_payment");
                var goalDuration = document.getElementById("savings_goal_duration");
                var totalSavingsNeeded = document.getElementById("total_savingsNeeded");
                var totalAmountNeeded = document.getElementById("total_amountNeeded");
                var totalsavingsPercentage = document.getElementById("percentage");
        
                var totalSavingsFund = document.getElementById("TotalSavingsFund");
        
                monthlyInput.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var monthlyInputValue = monthlyInput.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));
                    const savingsYears = parseInt(goalDuration.value);
        
                    // Calculate months
                    var amountPerYear = cleanedValue * 12;
                    var totalSavings = savingsYears * amountPerYear;
                    var total = goalAmount - totalSavings;
                    var totalPerYear = goalAmount - amountPerYear;
                    var totalPercentage = totalSavings / goalAmount * 100;
        
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                        // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = totalPerYear.toLocaleString();
                        totalSavingsFund.innerText = "RM" + result;
                        if (!isNaN(savingsYears)){
                            // var result = totalSavings.toLocaleString();
                            // totalSavingsFund.innerText = "RM" + result;
                            if (total <= 0){
                                totalAmountNeeded.value = 0;
                                totalsavingsPercentage.value = 100;
                                $('.calculation-progress-bar').css('width','100%');
                                totalSavingsFund.innerText = "RM 0";
                            }
                            else{
                                totalAmountNeeded.value = total;
                                totalsavingsPercentage.value = totalPercentage;
                                $('.calculation-progress-bar').css('width', totalPercentage + '%');
                                var totalResult = total.toLocaleString();
                                totalSavingsFund.innerText = "RM" + totalResult;
                            }
                        }
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = monthlyInputValue;
                        totalSavingsFund.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalSavingsNeeded.value =  totalSavings;
                    // totalAmountNeeded.value = ;
                });
        
                goalDuration.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var goalDurationValue = goalDuration.value;
        
                    var amountNeeded = parseFloat(monthlyInput.value.replace(/\D/g, '')) * 12; 
                    var Year = parseInt(goalDurationValue);
        
                    // Calculate months
                    var totalAmount = Year * amountNeeded;
                    var total = goalAmount - totalAmount;
                    var totalPercentage = totalAmount / goalAmount * 100;
        
                    if (!isNaN(Year)) {
                        // Input is a valid number, perform the calculation
                        // Display the result
                        this.value = Year;
                        var result = total.toLocaleString();
                        totalSavingsFund.innerText = "RM" + result;
                        if (total <= 0){
                            totalAmountNeeded.value = 0;
                            totalsavingsPercentage.value = 100;
                            $('.calculation-progress-bar').css('width','100%');
                            totalSavingsFund.innerText = "RM 0";
                        }
                        else{
                            totalAmountNeeded.value = total;
                            totalsavingsPercentage.value = totalPercentage;
                            $('.calculation-progress-bar').css('width', totalPercentage + '%');
                            var totalResult = total.toLocaleString();
                            totalSavingsFund.innerText = "RM" + totalResult;
                        }
                    } else {
                        // Input is not a valid number
                        this.value = goalDurationValue;
                        totalSavingsFund.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalSavingsNeeded.value =  totalAmount;
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    monthlyInput.addEventListener("blur", function() {
                        validateAmountNumberField(monthlyInput);
                    });
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    goalDuration.addEventListener("blur", function() {
                        validateYearsNumberField(goalDuration);
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
        // else if (path == '/savings-monthly-payment') {
        //     // Get the input value
        //     var monthlyInput = document.getElementById("savings_monthly_payment");
        //     var totalSavingsNeeded = document.getElementById("total_savingsNeeded");
    
        //     var totalSavingsFund = document.getElementById("TotalSavingsFund");
    
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
        //             totalSavingsFund.innerText = "RM 0";
        //         } else {
        //             // Input is a valid number, perform the calculation
        //             // Display the result
        //             var result = amountPerYear.toLocaleString();
    
        //             totalSavingsFund.innerText = "RM" + result;
        //         }
    
        //         // Set the value of the hidden input field
        //         totalSavingsNeeded.value = amountPerYear;
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
        //             // field.classList.remove("is-valid");
        //             field.classList.add("is-invalid");
    
        //         } else {
        //             // field.classList.add("is-valid");
        //             field.classList.remove("is-invalid");
        //         }
        //     }
        // }
        // else if (path == '/savings-goal-duration') {
        //     // Get the input value
        //     var goalDuration = document.getElementById("savings_goal_duration");
        //     var newTotalFund = document.getElementById("newTotal_savingsNeeded");
        //     var totalSavingsFund = document.getElementById("TotalSavingsFund");
    
        //     if (goalDurationSessionValue !== '' || goalDurationSessionValue !== 0 && oldTotalFund !== '') {
        //             newTotalFund.value = goalDurationSessionValue * oldTotalFund;
        //     } 
            
    
        //     goalDuration.addEventListener("input", function() {
    
        //         // Retrieve the current input value
        //         var goalDurationValue = goalDuration.value;
    
        //         var Year = parseInt(goalDurationValue);
    
        //         // Calculate months
        //         var totalAmount = Year * oldTotalFund;
    
        //         if (isNaN(Year)) {
        //             // Input is not a valid number
        //             totalSavingsFund.innerText = "RM 0";
        //         } else {
        //             // Input is a valid number, perform the calculation
        //             // Display the result
        //             var result = totalAmount.toLocaleString();
    
        //             totalSavingsFund.innerText = "RM" + result;
        //         }
        //         if(totalAmount >= 10000000000){
        //             totalSavingsFund.classList.add('f-40');
        //             totalSavingsFund.classList.remove('f-50');
        //         }
        //         else{
        //             totalSavingsFund.classList.add('f-50');
        //             totalSavingsFund.classList.remove('f-40');
        //         }
                
        //         newTotalFund.value = Year * oldTotalFund;
                
        //     });
        
        //     document.addEventListener("DOMContentLoaded", function() {
        //         goalDuration.addEventListener("blur", function() {
        //             validateNumberField(goalDuration);
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
        if (path == '/savings/annual-return') {
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
                    window.location.href = '/savings/amount-needed';
                });

            } else{
                // Get the input value
                var savingsGoalPA = document.getElementById('savings_goal_pa');
                var totalsavingsPercentage = document.getElementById("percentage");
        
                savingsGoalPA.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var savingsGoalPAValue = savingsGoalPA.value;
        
                    var annualReturn = parseInt(savingsGoalPAValue);
        
                    if (!isNaN(annualReturn)) {
                        this.value = annualReturn;
                    }
                    else{
                        this.value = savingsGoalPAValue;
                    }
                    
                });
            
                document.addEventListener("DOMContentLoaded", function() {
                    savingsGoalPA.addEventListener("blur", function() {
                        validateNumberField(savingsGoalPA);
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
        }
        if (path == '/savings/risk-profile') {
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
                    window.location.href = '/savings/annual-return';
                });

            } else{
    
                // Add event listener to each button with the 'data-required' attribute
                const dataButtons = document.querySelectorAll('[data-avatar]');
                const dataPotentialBtns = document.querySelectorAll('[data-risk]');
                var highRisk = document.getElementById("high-risk");
                var mediumRisk = document.getElementById("medium-risk");
                var lowRisk = document.getElementById("low-risk");
                var highRiskImg = document.getElementById("high-risk-img");
                var mediumRiskImg = document.getElementById("medium-risk-img");
                var lowRiskImg = document.getElementById("low-risk-img");
                var highPotentialReturn = document.getElementById("high-risk-potential-content");
                var mediumPotentialReturn = document.getElementById("medium-risk-potential-content");
                var lowPotentialReturn = document.getElementById("low-risk-potential-content");
                const dataSelected = document.querySelectorAll('.default');
        
                dataButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior of the button click
        
                        // Remove 'data-required' from all elements with the class 'risk-profile-content'
                        dataPotentialBtns.forEach(btn => {
                            btn.removeAttribute('data-required');
                        });
        
                        dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                        // Add 'selected' attribute to the clicked button
                        this.setAttribute('data-required', 'selected');
        
                        const selectedData = this.getAttribute('data-required');
        
                        dataButtons.forEach(btn => btn.classList.remove('selected'));
        
                        // Get the selected data-avatar value
                        const dataAvatar = this.getAttribute('data-avatar');
        
                        // Update the hidden input field value with the selected avatar
                        document.getElementById('savingsRiskProfileInput').value = dataAvatar;
        
                        const selectedPotential = document.getElementById('savingsPotentialReturnInput');
        
                        if(selectedData === 'selected'){
                            switch(dataAvatar) {
                                case 'High Risk':
                                    const selectedHighPR = highPotentialReturn.querySelector('#high-potential-return');
                                    selectedHighPR.setAttribute('data-required', 'selected');
                                    selectedPotential.value = 'High Potential Return';
                                    break;
                                case 'Medium Risk':
                                    const selectedMediumPR = mediumPotentialReturn.querySelector('#medium-potential-return');
                                    selectedMediumPR.setAttribute('data-required', 'selected');
                                    selectedPotential.value = 'Medium Potential Return';
                                    break;
                                case 'Low Risk':
                                    const selectedLowPR = lowPotentialReturn.querySelector('#low-potential-return');
                                    selectedLowPR.setAttribute('data-required', 'selected');
                                    selectedPotential.value = 'Low Potential Return';
                                    break;
                                default:
                                    break;
                            }
                        }
                        
                        // Check if the user selected a risk and remove the potential value if not
                        // selectedPotential.value = '';
                    });
                });
        
                dataPotentialBtns.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior of the button click
        
                        dataPotentialBtns.forEach(btn => btn.removeAttribute('data-required'));
                        // Add 'selected' attribute to the clicked button
                        this.setAttribute('data-required', 'selected');
        
                        dataPotentialBtns.forEach(btn => btn.classList.remove('selected'));
        
                        // Get the selected data-avatar value
                        const dataPotential = this.getAttribute('data-risk');
        
                        // Update the hidden input field value with the selected avatar
                        document.getElementById('savingsPotentialReturnInput').value = dataPotential;
                    });
                });       
        
                // Preselect the button on page load
                window.addEventListener('DOMContentLoaded', function() {
                    const defaultBtn = document.querySelectorAll('.default');
        
                    defaultBtn.forEach(defaultBtn => {
                        defaultBtn.classList.add('selected');
                    });
                });
        
                $(document).ready(function () {
                    if ($('.risk-btn.selected')){
                        var selectedId = $('.risk-btn.selected').attr('id');
                        document.getElementById(selectedId + "-img").style.display = "block";
                        document.getElementById(selectedId + "-potential-content").style.display = "block";
                    }
                });
        
                highRisk.onclick = function(){
                    highRiskImg.style.display = "block";
                    mediumRiskImg.style.display = "none";
                    lowRiskImg.style.display = "none";
                    highPotentialReturn.style.display ="block";
                    mediumPotentialReturn.style.display = "none";
                    lowPotentialReturn.style.display = "none";
                }
                mediumRisk.onclick = function(){
                    mediumRiskImg.style.display = "block";
                    highRiskImg.style.display = "none";
                    lowRiskImg.style.display = "none";
                    mediumPotentialReturn.style.display = "block";
                    highPotentialReturn.style.display = "none";
                    lowPotentialReturn.style.display = "none";
                }
                lowRisk.onclick = function(){
                    lowRiskImg.style.display = "block";
                    highRiskImg.style.display = "none";
                    mediumRiskImg.style.display = "none";
                    lowPotentialReturn.style.display = "block";
                    highPotentialReturn.style.display = "none";
                    mediumPotentialReturn.style.display = "none";
                }
        
                dataSelected.forEach(btnSelected => {
                    highRiskImg.style.display = "none";
                    mediumRiskImg.style.display = "none";
                    lowRiskImg.style.display = "none";
        
                    const defaultSelection = btnSelected.getAttribute('data-avatar');
                    if (defaultSelection === 'High Risk') {
                        highPotentialReturn.style.display = "block";
                    } else if (defaultSelected === 'Medium Risk'){
                        mediumPotentialReturn.style.display = "block";
                    }
                    else if (defaultSelected === 'Low Risk'){
                        lowRiskImg.style.display = "block";
                    }
                });
        
                const oldRiskLevel = document.getElementById('savingsRiskProfileInput').value;
                if (oldRiskLevel === 'High Risk') {
                    highPotentialReturn.style.display = "block";
                } else if (oldRiskLevel === 'Medium Risk'){
                    mediumPotentialReturn.style.display = "block";
                }
                else if (oldRiskLevel === 'Low Risk'){
                    lowPotentialReturn.style.display = "block";
                }
            }
        }
        if (path == '/savings/gap') {
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
                    window.location.href = '/savings/risk-profile';
                });

            } else{
                var Uncovered = (100 - Covered).toFixed(2);
                var Covered = (savingsTotal / goals * 100).toFixed(2);
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