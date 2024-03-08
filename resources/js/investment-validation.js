// Array of specific folder names where the script should run
const specificPageURLs = [
    'investment',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    if (needs_priority && needs_priority === 'false' || needs_priority == '') {
            
    } else{
        if (path === '/investment/coverage') {
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
        if (path == '/investment/amount-needed') {
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
                    window.location.href = '/investment/coverage';
                });

            } else{
                // Get the input value
                var monthlyInput = document.getElementById("investment_monthly_payment");
                var supportYears = document.getElementById("investment_supporting_years");
                var totalInvestmentNeeded = document.getElementById("total_investmentNeeded");
        
                var totalInvestmentFund = document.getElementById("TotalInvestmentFund");
                var TotalInvestmentFundMob = document.getElementById("TotalInvestmentFundMob");
        
                monthlyInput.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var monthlyInputValue = monthlyInput.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(monthlyInputValue.replace(/\D/g, ''));
                    const investmentYears = parseInt(supportYears.value);
        
                    // Calculate months
                    var amountPerYear = cleanedValue * 12;
                    var totalInvestment = investmentYears * amountPerYear;
        
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                        // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = amountPerYear.toLocaleString();
                        totalInvestmentFund.innerText = "RM" + result;
                        TotalInvestmentFundMob.innerText = "RM" + result;
                        if (!isNaN(investmentYears)){
                            var totalResult = totalInvestment.toLocaleString();
                            totalInvestmentFund.innerText = "RM" + totalResult;
                            TotalInvestmentFundMob.innerText = "RM" + totalResult;
                        }
                    } else {
                        // If it's not a valid number, display the cleaned value as is
                        this.value = monthlyInputValue;
                        totalInvestmentFund.innerText = "RM 0";
                        TotalInvestmentFundMob.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalInvestmentNeeded.value =  totalInvestment;
                });
        
                supportYears.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var supportYearsValue = supportYears.value;
        
                    var amountNeeded = parseFloat(monthlyInput.value.replace(/\D/g, '')) * 12; 
                    var Year = parseInt(supportYearsValue);
        
                    // Calculate months
                    var totalAmount = Year * amountNeeded;
        
                    if (!isNaN(Year)) {
                        // Input is a valid number, perform the calculation
                        // Display the result
                        this.value = Year;
                        var result = totalAmount.toLocaleString();
                        totalInvestmentFund.innerText = "RM" + result;
                        TotalInvestmentFundMob.innerText = "RM" + result;
                    } else {
                        // Input is not a valid number
                        this.value = supportYearsValue;
                        totalInvestmentFund.innerText = "RM 0";
                        TotalInvestmentFundMob.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalInvestmentNeeded.value =  totalAmount;
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    monthlyInput.addEventListener("blur", function() {
                        validateAmountNumberField(monthlyInput);
                    });
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    supportYears.addEventListener("blur", function() {
                        validateYearsNumberField(supportYears);
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
        
        if (path == '/investment/annual-return') {
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
                    window.location.href = '/investment/amount-needed';
                });

            } else{
                // Get the input value
                var investmentPA = document.getElementById("investment_pa");
                var totalInvestmentPercentage = document.getElementById("percentage");
                // var totalAnnualReturn = document.getElementById("total_annualReturn");
        
                investmentPA.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var investmentPAValue = investmentPA.value;
        
                    var annualReturn = parseFloat(investmentPAValue);
        
                    // Calculate annual return
                    var total_AR_amount = oldTotalFund * annualReturn / 100;
                    var totalPercentage = total_AR_amount / oldTotalFund * 100;
                    if (!isNaN(investmentPAValue)) {
                        this.value = investmentPAValue;
                        // totalAnnualReturn.value = total_AR_amount;
                        if(totalPercentage > 100){
                            totalInvestmentPercentage.value = 100;
                            $('.calculation-progress-bar').css('width','100%');
                        }
                        else{
                            totalInvestmentPercentage.value = totalPercentage;
                            $('.calculation-progress-bar').css('width', totalPercentage + '%');
                        }
                    }
                    else{
                        this.value = investmentPAValue;
                    }
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    investmentPA.addEventListener("blur", function() {
                        validateNumberField(investmentPA);
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
        // if (path == '/investment/risk-profile') {

        //     if (lastPageInput == null || lastPageInput == undefined || lastPageInput == '') {
        //         var nameModal = document.getElementById('missingLastPageInputFields');
        //         nameModal.classList.add('show');
        //         nameModal.style.display = 'block';
        //         document.querySelector('body').style.paddingRight = '0px';
        //         document.querySelector('body').style.overflow = 'hidden';
        //         document.querySelector('body').classList.add('modal-open');

        //         var modalBackdrop = document.createElement('div');
        //         modalBackdrop.className = 'modal-backdrop fade show';
        //         document.querySelector('body.modal-open').append(modalBackdrop);

        //         // Close the modal
        //         var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
        //         closeButton.addEventListener('click', function() {
        //             nameModal.classList.remove('show');
        //             nameModal.style.display = 'none';
        //             document.querySelector('body').style.paddingRight = '';
        //             document.querySelector('body').style.overflow = '';
        //             document.querySelector('body').classList.remove('modal-open');
        //             var modalBackdrop = document.querySelector('.modal-backdrop');
        //             if (modalBackdrop) {
        //                 modalBackdrop.remove();
        //             }
        //             window.location.href = '/investment/annual-return';
        //         });

        //     } else {
        //         const dataButtons = document.querySelectorAll('[data-avatar]');
        //         const dataPotentialBtns = document.querySelectorAll('[data-risk]');
        //         var highRisk = document.getElementById("high-risk");
        //         var mediumRisk = document.getElementById("medium-risk");
        //         var lowRisk = document.getElementById("low-risk");
        //         var highRiskImg = document.getElementById("high-risk-img");
        //         var mediumRiskImg = document.getElementById("medium-risk-img");
        //         var lowRiskImg = document.getElementById("low-risk-img");
        //         var highPotentialReturn = document.getElementById("high-risk-potential-content");
        //         var mediumPotentialReturn = document.getElementById("medium-risk-potential-content");
        //         var lowPotentialReturn = document.getElementById("low-risk-potential-content");
        //         const dataSelected = document.querySelectorAll('.default');
        
        //         dataButtons.forEach(button => {
        //             button.addEventListener('click', function(event) {
        //                 event.preventDefault(); // Prevent the default behavior of the button click
        
        //                 // Remove 'data-required' from all elements with the class 'risk-profile-content'
        //                 dataPotentialBtns.forEach(btn => {
        //                     btn.removeAttribute('data-required');
        //                 });
        
        //                 dataButtons.forEach(btn => btn.removeAttribute('data-required'));
        //                 // Add 'selected' attribute to the clicked button
        //                 this.setAttribute('data-required', 'selected');
        
        //                 const selectedData = this.getAttribute('data-required');
        
        //                 dataButtons.forEach(btn => btn.classList.remove('selected'));
        
        //                 // Get the selected data-avatar value
        //                 const dataAvatar = this.getAttribute('data-avatar');
        
        //                 // Update the hidden input field value with the selected avatar
        //                 document.getElementById('investmentRiskProfileInput').value = dataAvatar;
        
        //                 const selectedPotential = document.getElementById('investmentPotentialReturnInput');
        
        //                 if(selectedData === 'selected'){
        //                     switch(dataAvatar) {
        //                         case 'High Risk':
        //                             const selectedHighPR = highPotentialReturn.querySelector('#high-potential-return');
        //                             selectedHighPR.setAttribute('data-required', 'selected');
        //                             selectedPotential.value = 'High';
        //                             break;
        //                         case 'Medium Risk':
        //                             const selectedMediumPR = mediumPotentialReturn.querySelector('#medium-potential-return');
        //                             selectedMediumPR.setAttribute('data-required', 'selected');
        //                             selectedPotential.value = 'Medium';
        //                             break;
        //                         case 'Low Risk':
        //                             const selectedLowPR = lowPotentialReturn.querySelector('#low-potential-return');
        //                             selectedLowPR.setAttribute('data-required', 'selected');
        //                             selectedPotential.value = 'Low';
        //                             break;
        //                         default:
        //                             break;
        //                     }
        //                 }
        //             });
        //         });
        
        //         dataPotentialBtns.forEach(button => {
        //             button.addEventListener('click', function(event) {
        //                 event.preventDefault(); // Prevent the default behavior of the button click
        
        //                 dataPotentialBtns.forEach(btn => btn.removeAttribute('data-required'));
        //                 // Add 'selected' attribute to the clicked button
        //                 this.setAttribute('data-required', 'selected');
        
        //                 dataPotentialBtns.forEach(btn => btn.classList.remove('selected'));
        
        //                 // Get the selected data-avatar value
        //                 const dataPotential = this.getAttribute('data-risk');
        
        //                 // Update the hidden input field value with the selected avatar
        //                 document.getElementById('investmentPotentialReturnInput').value = dataPotential;
        //             });
        //         });       
        
        //         // Preselect the button on page load
        //         window.addEventListener('DOMContentLoaded', function() {
        //             const defaultBtn = document.querySelectorAll('.default');
        
        //             defaultBtn.forEach(defaultBtn => {
        //                 defaultBtn.classList.add('selected');
        //             });
        //         });
        
        //         $(document).ready(function () {
        //             if ($('.risk-btn.selected')){
        //                 var selectedId = $('.risk-btn.selected').attr('id');
        //                 document.getElementById(selectedId + "-img").style.display = "block";
        //                 document.getElementById(selectedId + "-potential-content").style.display = "block";
        //             }
        //         });
        
        //         highRisk.onclick = function(){
        //             highRiskImg.style.display = "block";
        //             mediumRiskImg.style.display = "none";
        //             lowRiskImg.style.display = "none";
        //             highPotentialReturn.style.display ="block";
        //             mediumPotentialReturn.style.display = "none";
        //             lowPotentialReturn.style.display = "none";
        //         }
        //         mediumRisk.onclick = function(){
        //             mediumRiskImg.style.display = "block";
        //             highRiskImg.style.display = "none";
        //             lowRiskImg.style.display = "none";
        //             mediumPotentialReturn.style.display = "block";
        //             highPotentialReturn.style.display = "none";
        //             lowPotentialReturn.style.display = "none";
        //         }
        //         lowRisk.onclick = function(){
        //             lowRiskImg.style.display = "block";
        //             highRiskImg.style.display = "none";
        //             mediumRiskImg.style.display = "none";
        //             lowPotentialReturn.style.display = "block";
        //             highPotentialReturn.style.display = "none";
        //             mediumPotentialReturn.style.display = "none";
        //         }
        
        //         dataSelected.forEach(btnSelected => {
        //             highRiskImg.style.display = "none";
        //             mediumRiskImg.style.display = "none";
        //             lowRiskImg.style.display = "none";
        
        //             const defaultSelection = btnSelected.getAttribute('data-avatar');
        //             if (defaultSelection === 'High Risk') {
        //                 highPotentialReturn.style.display = "block";
        //             } else if (defaultSelected === 'Medium Risk'){
        //                 mediumPotentialReturn.style.display = "block";
        //             }
        //             else if (defaultSelected === 'Low Risk'){
        //                 lowRiskImg.style.display = "block";
        //             }
        //         });
        
        //         const oldRiskLevel = document.getElementById('investmentRiskProfileInput').value;
        //         if (oldRiskLevel === 'High Risk') {
        //             highPotentialReturn.style.display = "block";
        //         } else if (oldRiskLevel === 'Medium Risk'){
        //             mediumPotentialReturn.style.display = "block";
        //         }
        //         else if (oldRiskLevel === 'Low Risk'){
        //             lowPotentialReturn.style.display = "block";
        //         }
        //     }
        // }
        if (path == '/investment/gap') {
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
                    window.location.href = '/risk-profile';
                });

            } else {
                var Uncovered = (100 - Covered).toFixed(2);
                var Covered = (percentage).toFixed(2);
                // var Covered = (investmentAnnualReturn / newTotalInvestmentNeeded * 100).toFixed(2);
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