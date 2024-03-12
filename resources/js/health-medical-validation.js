// Array of specific folder names where the script should run
const specificPageURLs = [
    'health-medical',
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
        if (path === '/health-medical/medical-selection') {
            // Add event listener to each button with the 'data-required' attribute
            const dataButtons = document.querySelectorAll('[data-avatar]');
            const criticalIllness = document.getElementById('critical_illness');
            const medicalPlanning = document.getElementById('medical_planning');


            dataButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default behavior of the button click

                    // Check if the button is already selected
                    const isSelected = this.getAttribute('data-required') === 'selected';
                    const isDefault = this.classList.contains('selected');

                    // Toggle the 'data-required' attribute based on the current state

                    if (isDefault){
                        this.classList.remove('selected');
                    } else{
                        this.setAttribute('data-required', isSelected ? '' : 'selected');
                    }
                    if(document.querySelectorAll('[data-required="selected"]').length == 0){
                        document.getElementById('selectionHealthMedicalInput').value = '';
                    } else{
                        document.getElementById('selectionHealthMedicalInput').value = document.querySelectorAll('[data-required="selected"]').length;
                    }
                });
            });

            criticalIllness.addEventListener('click', function() {
                document.getElementById('selectionCriticalInput').value = "";
                if (this.getAttribute('data-required') === 'selected'){
                    document.getElementById('selectionCriticalInput').value = this.getAttribute('data-avatar');
                }
            });
            medicalPlanning.addEventListener('click', function() {
                document.getElementById('selectionMedicalInput').value = "";
                if (this.getAttribute('data-required') === 'selected'){
                    document.getElementById('selectionMedicalInput').value = this.getAttribute('data-avatar');
                }
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
        if (path === '/health-medical/critical-illness/coverage' || path === '/health-medical/medical-planning/coverage') {
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
                    window.location.href = '/health-medical/medical-selection';
                });

            } else{
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
        
                        // Remove 'selected' class from all elements
                        dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                        
                        // Add 'selected' attribute to the clicked button
                        this.setAttribute('data-required', 'selected');
        
                        dataButtons.forEach(btn => btn.classList.remove('selected'));
        
                        // Get the selected data-avatar value
                        const dataAvatar = this.getAttribute('data-avatar');
                        const dataAvatarDob = this.getAttribute('data-avatar-dob');
                        const dataRelation = this.getAttribute('data-relation');
        
                        // Update the hidden input field value with the selected avatar
                        relationshipInput.value = dataRelation;
                        selectedInsuredNameInput.value = '';
                        selectedCoverForDobInput.value = '';
                        othersCoverForNameInput.value = '';
                        othersCoverForDobInput.value = '';
                        if (dataRelation == 'Spouse'){
                            othersCoverForNameInput.value = dataAvatar;
                            othersCoverForDobInput.value = dataAvatarDob;
                        }
                        if(dataRelation == 'Child') {
                            selectedInsuredNameInput.value = dataAvatar;
                            selectedCoverForDobInput.value = dataAvatarDob;
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
        }
        if (path === '/health-medical/medical-planning/hospital-selection') {
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
                    window.location.href = '/health-medical/medical-planning/coverage';
                });

            } else{
                // Add event listener to each button with the 'data-required' attribute
                const dataButtons = document.querySelectorAll('[data-avatar]');
        
                dataButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior of the button click
        
                        // Remove 'selected' class from all elements
                        dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                        
                        // Add 'selected' attribute to the clicked button
                        this.setAttribute('data-required', 'selected');
        
                        dataButtons.forEach(btn => btn.classList.remove('selected'));
        
                        // Get the selected data-avatar value
                        const dataAvatar = this.getAttribute('data-avatar');
        
                        // Update the hidden input field value with the selected avatar
                        selectionInput.value = dataAvatar;
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
        if (path === '/health-medical/medical-planning/room-selection') {
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
                    window.location.href = '/health-medical/medical-planning/hospital-selection';
                });

            } else{
                // Add event listener to each button with the 'data-required' attribute
                const dataButtons = document.querySelectorAll('[data-avatar]');
                const dataSelected = document.querySelectorAll('.default');
                const roomSelection = document.querySelectorAll('.room-selection-content');
                // const singleRoom = document.querySelectorAll('.own-space');
                // const coupleRoom = document.querySelectorAll('.couple-room');
                // const moreRooms = document.querySelectorAll('.more-rooms');
        
                // Hide all option elements
                // singleRoom.forEach(el => el.style.display = 'block');
                // coupleRoom.forEach(el => el.style.display = 'none');
                // moreRooms.forEach(el => el.style.display = 'none');
        
                // dataSelected.forEach(btnSelected => {
                    // Hide all option elements
                    // singleRoom.forEach(el => el.style.display = 'none');
                    // coupleRoom.forEach(el => el.style.display = 'none');
                    // moreRooms.forEach(el => el.style.display = 'none');
        
                    // const defaultSelection = btnSelected.getAttribute('data-avatar');
                    // if (defaultSelection === 'my own space') {
                    //     singleRoom.forEach(el => el.style.display = 'block');
                    //     roomSelection.forEach(element => {
                    //         element.classList.add('single');
                    //         element.classList.remove('couple');
                    //     });
                    //     document.getElementById("room-first-col").classList.add('single-patient'); 
                    //     document.getElementById("room-first-col").classList.remove('patient-2', 'h-100'); 
                    //     document.getElementById("room-center-col").classList.add('z-99'); 
                    //     document.getElementById("room-center-col").classList.remove('h-100'); 
                    //     document.getElementById("room-last-col").classList.add('single-patient-2'); 
                    //     document.getElementById("room-last-col").classList.remove('patient-2', 'h-100'); 
        
                    // } else {
                        // roomSelection.forEach(element => {
                        //     element.classList.remove('single');
                        //     element.classList.add('couple');
                        // });
        
                        // document.getElementById("room-first-col").classList.remove('single-patient'); 
                        // document.getElementById("room-first-col").classList.add('patient-2', 'h-100'); 
                        // document.getElementById("room-center-col").classList.remove('z-99'); 
                        // document.getElementById("room-center-col").classList.add('h-100', 'z-1'); 
                        // document.getElementById("room-last-col").classList.remove('single-patient-2'); 
                        // document.getElementById("room-last-col").classList.add('patient-2', 'h-100'); 
                        // if (defaultSelection === 'a companion') {
                        //     coupleRoom.forEach(el => el.style.display = 'block');
                        // } else if (defaultSelection === 'more roommates') {
                        //     moreRooms.forEach(el => el.style.display = 'block');
                        //     coupleRoom.forEach(el => el.style.display = 'block');
                        // }
                    // }
                // });
        
                dataButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior of the button click
        
                        // Remove 'selected' class from all elements
                        dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                        dataButtons.forEach(btn2 => btn2.closest('.button-bg').classList.remove('selected'));
                        
                        // Add 'selected' attribute to the clicked button
                        this.setAttribute('data-required', 'selected');
                        this.closest('.button-bg').classList.add('selected');
        
                        dataButtons.forEach(btn => btn.classList.remove('selected'));
        
                        // Get the selected data-avatar value
                        const dataAvatar = this.getAttribute('data-avatar');
        
                        // Update the hidden input field value with the selected avatar
                        selectionInput.value = dataAvatar;
        
                        // roomSelection.forEach(element => {
        
                            // if (dataAvatar === 'my own space') {
                            //     element.classList.add('single');
                                // element.classList.remove('couple');
        
                                // document.getElementById("room-first-col").classList.add('single-patient'); 
                                // document.getElementById("room-first-col").classList.remove('patient-2', 'h-100'); 
                                // document.getElementById("room-center-col").classList.add('z-99'); 
                                // document.getElementById("room-center-col").classList.remove('h-100'); 
                                // document.getElementById("room-last-col").classList.add('single-patient-2'); 
                                // document.getElementById("room-last-col").classList.remove('patient-2', 'h-100'); 
        
                            // } else {
                            //     element.classList.remove('single');
                            //     element.classList.add('couple');
        
                            //     document.getElementById("room-first-col").classList.remove('single-patient'); 
                            //     document.getElementById("room-first-col").classList.add('patient-2', 'h-100'); 
                            //     document.getElementById("room-center-col").classList.remove('z-99'); 
                            //     document.getElementById("room-center-col").classList.add('h-100'); 
                            //     document.getElementById("room-last-col").classList.remove('single-patient-2'); 
                            //     document.getElementById("room-last-col").classList.add('patient-2', 'h-100'); 
                            // }
                        // });
        
                        // updateView(dataAvatar);
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
        
                // function updateView(selectedOption) {
        
                //     // Hide all option elements
                //     singleRoom.forEach(el => el.style.display = 'none');
                //     coupleRoom.forEach(el => el.style.display = 'none');
                //     moreRooms.forEach(el => el.style.display = 'none');
                
                //     // Show the option elements based on the selected option
                //     if (selectedOption === 'my own space') {
                //         singleRoom.forEach(el => el.style.display = 'block');
        
                //     } else if (selectedOption === 'a companion') {
                //         coupleRoom.forEach(el => el.style.display = 'block');
                //     } else if (selectedOption === 'more roommates') {
                //         moreRooms.forEach(el => el.style.display = 'block');
                //         coupleRoom.forEach(el => el.style.display = 'block');
                //     }
                // }
            }
        }
        if (path == '/health-medical/critical-illness/amount-needed' || path == '/health-medical/medical-planning/amount-needed') {
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
                    if (path == '/health-medical/critical-illness/amount-needed'){
                        window.location.href = '/health-medical/critical-illness/coverage';
                    } else{
                        window.location.href = '/health-medical/medical-planning/room-selection';
                    }
                });

            } else{
                var totalFundNeeded = document.getElementById("total_healthMedicalNeeded");
                var totalDisplayFund = document.getElementById("TotalHealthMedicalFund");
                var TotalHealthMedicalFundMob = document.getElementById("TotalHealthMedicalFundMob");
        
                // Get the input value
                amountNeeded.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var amountNeededValue = amountNeeded.value;
        
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(amountNeededValue.replace(/\D/g, ''));
                    const healthMedicalYears = parseInt(supportingYears.value);

                    if (path == '/health-medical/critical-illness/amount-needed'){
                        var amountPerYear = 12 * cleanedValue;
                        var totalHealthMedical = healthMedicalYears * 12 * cleanedValue;
                    } else{
                        var totalHealthMedical = healthMedicalYears * cleanedValue;
                        var amountPerYear = cleanedValue;
                    }
                    
                    // Check if the parsed value is a valid number
                    if (!isNaN(cleanedValue)) {
                        // If it's a valid number, format it with commas
                        const formattedValue = cleanedValue.toLocaleString('en-MY');
                        this.value = formattedValue;
                        var result = amountPerYear.toLocaleString();
                        totalDisplayFund.innerText = "RM" + result;
                        TotalHealthMedicalFundMob.innerText = "RM" + result;
                        if (!isNaN(healthMedicalYears)){
                            var result = totalHealthMedical.toLocaleString();
                            totalDisplayFund.innerText = "RM" + result;
                            TotalHealthMedicalFundMob.innerText = "RM" + result;
                        }
                        
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = amountNeededValue;
                        // Input is not a valid number
                        totalDisplayFund.innerText = "RM 0";
                        TotalHealthMedicalFundMob.innerText = "RM 0";
                        
                    }
                    // Set the value of the hidden input field
                    totalFundNeeded.value = totalHealthMedical;
                });
        
                supportingYears.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var supportingYearsValue = supportingYears.value;

                    if (path == '/health-medical/critical-illness/amount-needed'){
                        var healthMedicalAmountNeeded = parseFloat(amountNeeded.value.replace(/\D/g, '') * 12); 
                    } else{
                        var healthMedicalAmountNeeded = parseFloat(amountNeeded.value.replace(/\D/g, '')); 
                    }
                    
                    var Year = parseInt(supportingYearsValue);
        
                    // Calculate months
                    var totalAmount = Year * healthMedicalAmountNeeded;
        
                    if (!isNaN(Year)) {
                        var result = totalAmount.toLocaleString();
                        totalDisplayFund.innerText = "RM" + result;
                        TotalHealthMedicalFundMob.innerText = "RM" + result;
                    } else {
                        // Input is not a valid number
                        this.value = supportingYearsValue;
                        totalDisplayFund.innerText = "RM 0";
                        TotalHealthMedicalFundMob.innerText = "RM 0";
                    }
                    // Set the value of the hidden input field
                    totalFundNeeded.value =  totalAmount;
                });
        
                document.addEventListener("DOMContentLoaded", function() {
                    amountNeeded.addEventListener("blur", function() {
                        validateNumberField(amountNeeded);
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    supportingYears.addEventListener("blur", function() {
                        validateYearsNumberField(supportingYears);
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
        if (path == '/health-medical/critical-illness/existing-care' || path == '/health-medical/medical-planning/existing-care') {
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
                    if (path == '/health-medical/critical-illness/existing-care'){
                        window.location.href = '/health-medical/critical-illness/amount-needed';
                    } else{
                        window.location.href = '/health-medical/medical-planning/amount-needed';
                    }
                });

            } else{
                var existing_protection_amount = document.getElementById('existing_protection_amount');
                var yesRadio = document.getElementById('yes');
                var noRadio = document.getElementById('no');
                var totalAmountNeeded = document.getElementById("total_amountNeeded");
                var totalHealthMedicalPercentage = document.getElementById("percentage");
                var totalDisplayFund = document.getElementById("TotalHealthMedicalFund");
                var TotalHealthMedicalFundMob = document.getElementById("TotalHealthMedicalFundMob");
        
                existing_protection_amount.addEventListener("input", function() {
        
                    // Retrieve the current input value
                    var existingProtectionAmountValue = existing_protection_amount.value;
            
                    // Remove non-digit characters
                    const cleanedValue = parseFloat(existingProtectionAmountValue.replace(/\D/g, ''));
            
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
                            totalHealthMedicalPercentage.value = 100;
                            $('.calculation-progress-bar').css('width','100%');
                            totalDisplayFund.innerText = "RM 0";
                            TotalHealthMedicalFundMob.innerText = "RM 0";
                        }
                        else{
                            totalAmountNeeded.value = total;
                            totalHealthMedicalPercentage.value = totalPercentage;
                            $('.calculation-progress-bar').css('width', totalPercentage + '%');
                            totalDisplayFund.innerText = "RM" + result;
                            TotalHealthMedicalFundMob.innerText = "RM" + result;
                        }
        
                    } else {
                    // If it's not a valid number, display the cleaned value as is
                        this.value = existingProtectionAmountValue;
                        totalDisplayFund.innerText = "RM 0";
                        TotalHealthMedicalFundMob.innerText = "RM 0";
                    }
            
                });
                // Add event listeners to the radio buttons
                yesRadio.addEventListener('change', function () {
                    jQuery('.hide-content').css('opacity','1');
                });
            
                noRadio.addEventListener('change', function () {
                    jQuery('.hide-content').css('opacity','0');
                    existing_protection_amount.value = 0; // Clear the money input
                    totalAmountNeeded.value = oldTotalFund;
                    var totalPercentage = 0 / oldTotalFund * 100;
                    totalHealthMedicalPercentage.value = totalPercentage;
                });
            
                document.addEventListener('DOMContentLoaded', function() {
            
                    existing_protection_amount.addEventListener('blur', function() {
                        validateNumberField(existing_protection_amount);
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
                            document.getElementById("existing_protection_amount").classList.remove("is-invalid");
                        }
                    }
                });
                
                if (sessionExistingProtectionAmount !== '' || sessionExistingProtectionAmount !== 0) {
                    var newTotal = oldTotalFund - sessionExistingProtectionAmount;
                    var newTotalPercentage = sessionExistingProtectionAmount / oldTotalFund * 100;
                    if (newTotal <= 0){
                        totalAmountNeeded.value = 0;
                        totalHealthMedicalPercentage.value = 100;
                        $('.calculation-progress-bar').css('width','100%');
                    }
                    else{
                        totalAmountNeeded.value = newTotal;
                        totalHealthMedicalPercentage.value = newTotalPercentage;
                        $('.calculation-progress-bar').css('width', newTotalPercentage + '%');
                    }
                }
            }
        }
        if (path == '/health-medical/critical-illness/gap' || path == '/health-medical/medical-planning/gap') {
            if (!lastPageInput || !('existing_amount' in lastPageInput) || lastPageInput['existing_protection'] === '' ) {
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
                    if (path == '/health-medical/critical-illness/gap'){
                        window.location.href = '/health-medical/critical-illness/existing-care';
                    } else{
                        window.location.href = '/health-medical/medical-planning/existing-care';
                    }
                });

            } else{
                var Uncovered = (100 - Covered).toFixed(2);
                var Covered = (existingProtectionAmount / totalHealthMedicalNeeded * 100).toFixed(2);
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
                    
                    // Calculate the position for the dotCircle based on the end point of the graph
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
                        
                            if (index < xPositions.length) {
                                let duration = 1900 / xPositions.length;
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