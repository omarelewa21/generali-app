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
    if (needs_priority && needs_priority === 'false' || needs_priority == '') {
            
    } else {
        if (path === '/retirement') {
            const newImage = "/images/needs/retirement/home/gender-" + gender + "-" + skintone + ".json";
            var container = document.getElementById('lottie-animation');
            const animationAvatar = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImage
            });
        }
        if (path === '/retirement/coverage') {
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
                            window.location.href = '/family-dependent/details';
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
    
                    // selectedAvatar = this.getAttribute('data-required');
    
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

            var containerSelf = document.getElementById('lottie-animation-self');
            var containerSpouse = document.getElementById('lottie-animation-spouse');

            const newImageSelf = "/images/needs/coverage/gender-" + selfGender + "-" + skintone + ".json";
            const newImageSpouse = "/images/needs/coverage/spouse-gender-" + spouseGender + "-" + skintone + ".json";

            const animationAvatarSelf = lottie.loadAnimation({
                container: document.getElementById('lottie-animation-self'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImageSelf
            });
            const animationAvatarSpouse = lottie.loadAnimation({
                container: document.getElementById('lottie-animation-spouse'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImageSpouse
            });
        } 
        if (path == '/retirement/ideal') {
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
                    window.location.href = '/retirement/coverage';
                });

            } else{
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
            var containerTravel = document.getElementById('lottie-animation-travel');
            var containerLifestyle = document.getElementById('lottie-animation-lifestyle');
            var containerSavings = document.getElementById('lottie-animation-savings');

            const newImageTravel = "/images/needs/retirement/ideal/travel-gender-" + gender + "-" + skintone + ".json";
            const newImageLifestyle = "/images/needs/retirement/ideal/lifestyle-gender-" + gender + "-" + skintone + ".json";
            const newImageSavings = "/images/needs/retirement/ideal/savings-gender-" + gender + "-" + skintone + ".json";

            const animationAvatarTravel = lottie.loadAnimation({
                container: document.getElementById('lottie-animation-travel'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImageTravel
            });
            const animationAvatarLifestyle = lottie.loadAnimation({
                container: document.getElementById('lottie-animation-lifestyle'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImageLifestyle
            });
            const animationAvatarSavings = lottie.loadAnimation({
                container: document.getElementById('lottie-animation-savings'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImageSavings
            });
        }
        if (path == '/retirement/monthly-support') {
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
                    window.location.href = '/retirement/ideal';
                });

            } else{
                // Get the input value
                var monthlyInput = document.getElementById("retirement_monthly_support");
                var totalRetirementNeeded = document.getElementById("total_retirementNeeded");
        
                var totalRetirementFund = document.getElementById("TotalRetirementFund");
                var TotalRetirementFundMob = document.getElementById("TotalRetirementFundMob");
        
                monthlyInput.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var monthlyInputValue = monthlyInput.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));
        
                    // Calculate months
                    var amountPerYear = cleanedValue * 12;
        
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                    // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = amountPerYear.toLocaleString();
                        totalRetirementFund.innerText = "RM" + result;
                        TotalRetirementFundMob.innerText = "RM" + result;
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = monthlyInputValue;
                        totalRetirementFund.innerText = "RM 0";
                        TotalRetirementFundMob.innerText = "RM 0";
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
            const newImage = "/images/needs/retirement/monthly-support/gender-" + gender + "-" + skintone + ".json";
            var container = document.getElementById('lottie-animation');
            const animationAvatar = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImage
            });
        }
        if (path == '/retirement/period') {
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
                    window.location.href = '/retirement/monthly-support';
                });

            } else{
            
                // Get the input value
                var supportingYears = document.getElementById("supporting_years");
                var retirementAge = document.getElementById("retirement_age");
                var totalRetirementNeeded = document.getElementById("total_retirementNeeded");
        
                var totalRetirementFund = document.getElementById("TotalRetirementFund");
                var TotalRetirementFundMob = document.getElementById("TotalRetirementFundMob");
        
                supportingYears.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var supportingYearsValue = supportingYears.value;
        
                    var Year = parseInt(supportingYearsValue);
        
                    // Calculate months
                    var totalAmount = Year * oldTotalFund;
        
                    if (!isNaN(Year)) {
                        // Input is a valid number, perform the calculation
                        // Display the result
                        var result = totalAmount.toLocaleString();
                        totalRetirementFund.innerText = "RM" + result;
                        TotalRetirementFundMob.innerText = "RM" + result;
                    } else {
                        // Input is not a valid number
                        this.value = supportingYearsValue;
                        totalRetirementFund.innerText = "RM 0";
                        TotalRetirementFundMob.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalRetirementNeeded.value =  totalAmount;
                });
                retirementAge.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var retirementAgeValue = retirementAge.value;
        
                    var age = parseInt(retirementAgeValue);
        
                    if (!isNaN(age)) {
        
                    } else {
                        this.value = retirementAgeValue;
                    }
                    
                });
            
                document.addEventListener("DOMContentLoaded", function() {
                    retirementAge.addEventListener("blur", function() {
                        validateAgeNumberField(retirementAge);
                    });
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    supportingYears.addEventListener("blur", function() {
                        validateYearsNumberField(supportingYears);
                    });
                });
        
                function validateYearsNumberField(field) {
                    const value = field.value.trim();
        
                    if (value === "" || isNaN(value)) {
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                }
        
                function validateAgeNumberField(field) {
                    const value = field.value.trim();
        
                    if (value === "" || isNaN(value)) {
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                }
            }
            const newImage = "/images/needs/retirement/period/gender-" + gender + "-" + skintone + ".json";
            var container = document.getElementById('lottie-animation');
            const animationAvatar = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImage
            });
        }

        if (path == '/retirement/allocated-funds') {
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
                    window.location.href = '/retirement/period';
                });

            } else{
                var retirement_savings = document.getElementById('retirement_savings');
                var other_income_sources = document.getElementById('other_income_sources');
                var incomeSourcesCheckboxes = document.querySelectorAll('.other-income-checkbox');
                var other_income_sources_5_text = document.getElementById('other_income_sources_5_text');
                var totalAmountNeeded = document.getElementById("total_amountNeeded");
                var totalRetirementPercentage = document.getElementById("percentage");
                var totalRetirementFund = document.getElementById("TotalRetirementFund");
                var TotalRetirementFundMob = document.getElementById("TotalRetirementFundMob");
        
                other_income_sources_5_text.addEventListener('blur', function() {
                    validateInputField(other_income_sources_5_text);
                });
        
                function validateInputField(field) {
                    if (field.value) {
                        field.classList.remove('is-invalid');
                    } else {
                        field.classList.add('is-invalid');
                    }
                }

                // Add click event listeners to each checkbox
                incomeSourcesCheckboxes.forEach(function (checkbox) {
                    checkbox.addEventListener('change', updateHiddenInput);
                });
                
                other_income_sources_5_text.addEventListener('input', updateHiddenInput);

                function updateHiddenInput() {
                    var selectedResources = [];
            
                    // Loop through the checkboxes and add checked ones to the array
                    incomeSourcesCheckboxes.forEach(function (checkbox) {
                        if (checkbox.checked) {
                            if (checkbox.value === 'Others') {
                                selectedResources.push(other_income_sources_5_text.value);
                                jQuery('#other_income_sources_5_text').removeClass('disabled-color');
                                jQuery('#other_income_sources_5_text').attr('required',true);
                                jQuery('#other_income_sources_5_text').removeAttr('disabled');
                            }
                            else{
                                selectedResources.push(checkbox.value);
                            }
                        } else{
                            if (checkbox.value === 'Others') {
                                other_income_sources_5_text.value = '';
                                jQuery('#other_income_sources_5_text').prop('disabled', true);
                                jQuery('#other_income_sources_5_text').addClass('disabled-color');
                            }
                        }
                    });

                    // Update the hidden input value with the selected resources
                    other_income_sources.value = selectedResources.join(', ');
                    
                }

                retirement_savings.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var retirementSavingsValue = retirement_savings.value;
            
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(retirementSavingsValue.replace(/\D/g, ''));
        
                    var total = oldTotalFund - cleanedValue;
                    var totalPercentage = cleanedValue / oldTotalFund * 100;
            
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                    // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = total.toLocaleString();
                        if(total < 0){
                            totalRetirementFund.innerText = "RM 0";
                            TotalRetirementFundMob.innerText = "RM 0";
                        } else{
                            totalRetirementFund.innerText = "RM" + result;
                            TotalRetirementFundMob.innerText = "RM" + result;
                        }
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = retirementSavingsValue;
                    }
                    
                    $('.calculation-progress-bar').css('width', totalPercentage + '%');
                    if (total <= 0){
                        totalAmountNeeded.value = 0;
                        totalRetirementPercentage.value = 100;
                        $('.calculation-progress-bar').css('width','100%');
                    }
                    else{
                        totalAmountNeeded.value = total;
                        totalRetirementPercentage.value = totalPercentage;
                        $('.calculation-progress-bar').css('width', totalPercentage + '%');
                    }
            
                });
            
                document.addEventListener('DOMContentLoaded', function() {
            
                    retirement_savings.addEventListener('blur', function() {
                        validateNumberField(retirement_savings);
                    });
                    
                    function validateNumberField(field) {
            
                        const value = field.value.trim();
                        var pattern = /^[0-9,]+$/;
            
                        if (value === '' || isNaN(value)) {
                            field.classList.add('is-invalid');
                        } else {
                            field.classList.remove('is-invalid');
                        }
                        if (pattern.test(value)){
                            document.getElementById("retirement_savings").classList.remove("is-invalid");
                        }
                    }
                });
                
                if (sessionRetirementSavings !== '' || sessionRetirementSavings !== 0) {
                    var newTotal = oldTotalFund - sessionRetirementSavings;
                    var newTotalPercentage = sessionRetirementSavings / oldTotalFund * 100;
                    if (newTotal <= 0){
                        totalAmountNeeded.value = 0;
                        totalRetirementPercentage.value = 100;
                        $('.calculation-progress-bar').css('width','100%');
                    }
                    else{
                        totalAmountNeeded.value = newTotal;
                        totalRetirementPercentage.value = newTotalPercentage;
                        $('.calculation-progress-bar').css('width', newTotalPercentage + '%');
                    }
                }
            }
            const newImage = "/images/needs/retirement/allocated-fund/gender-" + gender + "-" + skintone + ".json";
            var container = document.getElementById('lottie-animation');
            const animationAvatar = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: newImage
            });
        }
        if (path == '/retirement/gap') {
            if (!lastPageInput || !('other_sources' in lastPageInput)) {
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
                    window.location.href = '/retirement/allocated-funds';
                });

            } else{
                var Uncovered = (100 - Covered).toFixed(2);
                var Covered = (retirementSavings / newTotalRetirementNeeded * 100).toFixed(2);
                var circle = document.getElementById("circle");
                var dotCircle = document.getElementById("dotCircle");
        
                circle.style.strokeDasharray = 904.896;
                let change = 904.896 - (904.896 * Covered) / 100; 
        
                if (change < 0) {
                    change = 0; // 0 represents 100% coverage
                    circle.style.strokeDashoffset = change;
                    circle.style.transition = 'all 1.5s ease';
                }
                else   {
                    // // Calculate the position for the dotCircle based on the end point of the graph
                    const percent = Math.floor(percentage);
                    let angle = (360 * percent) / 100;
                    let xPositions = [];
                    let yPositions = [];
                    for (let i = 0; i <= angle; i++) {
                        let x = 90 + 144 * Math.cos(i * Math.PI / 180);
                        let y = 90 + 144 * Math.sin(i * Math.PI / 180);
                        xPositions.push(x);
                        yPositions.push(y);
                    }
        
                    if ( percent === 0 || percent >= 100){
                    }
                    else{
                        dotCircle.style.display = "block";

                        let index = 0;
                        function animatePointer() {
                            dotCircle.setAttribute('cx', xPositions[index]);
                            dotCircle.setAttribute('cy', yPositions[index]);
                            index++;

                            let change = 904.896 - (904.896 * Covered * (index + 1) / xPositions.length) / 100;
                            circle.style.strokeDashoffset = change;
                        
                            if (index < xPositions.length) {
                                let duration = 500 / xPositions.length; // Calculate duration for each step
                                setTimeout(animatePointer, duration);
                            }
                        }
                        
                        animatePointer();
                    }
                }
            }
        }
    }
}