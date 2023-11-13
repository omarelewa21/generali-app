// Array of specific page URLs where the script should run
const specificPageURLs = [
    'identity-details',
    '/family-dependant',
    '/family-dependant/details',
    'existing-policy'
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    if (path == '/identity-details') {

        // Show the selected groups based on the dropdown selected
        document.addEventListener('DOMContentLoaded', function() {
            var idTypeSelect = document.getElementById('idType');
            var newicgroup = document.getElementById('newicgroup');
            var passportgroup = document.getElementById('passportgroup');
            var birthcertgroup = document.getElementById('birthcertgroup');
            var policegroup = document.getElementById('policegroup');
            var registrationgroup = document.getElementById('registrationgroup');

            var selectedOption;

            idTypeSelect.addEventListener('change', function() {
                selectedOption = this.value;
                showSelectedGroup(selectedOption);
            });
        
            // Function to show the selected group
            function showSelectedGroup(selectedOption) {

                // Hide all groups and remove the required attribute from all of them
                newicgroup.style.display = 'none';
                idNumber.removeAttribute('required');
                passportgroup.style.display = 'none';
                passportNumber.removeAttribute('required');
                birthcertgroup.style.display = 'none';
                birthCert.removeAttribute('required');
                policegroup.style.display = 'none';
                policeNumber.removeAttribute('required');
                registrationgroup.style.display = 'none';
                registrationNumber.removeAttribute('required');

                // Show the relevant group based on the selected option and add the required attribute
                if (selectedOption === 'New IC') {
                    newicgroup.style.display = 'block';
                    passportNumber.value = '';
                    birthCert.value ='';
                    policeNumber.value = '';
                    registrationNumber.value = '';

                    const form = document.getElementById("identityForm");

                    form.addEventListener("submit", function(event) {
                        // Enable the inputs before form submission
                        genderRadioMaleInput.disabled = false;
                        genderRadioFemaleInput.disabled = false;
                        document.getElementById('day').disabled = false;
                        document.getElementById('month').disabled = false;
                        document.getElementById('year').disabled = false;
                    });
                    
                    // Disable day, month, and year select options
                    document.getElementById('day').disabled = true;
                    document.getElementById('month').disabled = true;
                    document.getElementById('year').disabled = true;
                    document.getElementById('identityrMaleInput').disabled = true;
                    document.getElementById('identityFemaleInput').disabled = true;

                } else if (selectedOption === 'Passport') {
                    passportgroup.style.display = 'block';
                    idNumber.value = '';
                    birthCert.value ='';
                    policeNumber.value = '';
                    registrationNumber.value = '';

                    // Enable day, month, and year select options for other options
                    document.getElementById('day').disabled = false;
                    document.getElementById('month').disabled = false;
                    document.getElementById('year').disabled = false;
                    document.getElementById('identityrMaleInput').disabled = false;
                    document.getElementById('identityFemaleInput').disabled = false;

                } else if (selectedOption === 'Birth Certificate') {
                    birthcertgroup.style.display = 'block';
                    idNumber.value = '';
                    passportNumber.value = '';
                    policeNumber.value = '';
                    registrationNumber.value = '';

                    // Enable day, month, and year select options for other options
                    document.getElementById('day').disabled = false;
                    document.getElementById('month').disabled = false;
                    document.getElementById('year').disabled = false;
                    document.getElementById('identityrMaleInput').disabled = false;
                    document.getElementById('identityFemaleInput').disabled = false;

                } else if (selectedOption === 'Police / Army') {
                    policegroup.style.display = 'block';
                    idNumber.value = '';
                    passportNumber.value = '';
                    birthCert.value ='';
                    registrationNumber.value = '';

                    // Enable day, month, and year select options for other options
                    document.getElementById('day').disabled = false;
                    document.getElementById('month').disabled = false;
                    document.getElementById('year').disabled = false;
                    document.getElementById('identityrMaleInput').disabled = false;
                    document.getElementById('identityFemaleInput').disabled = false;

                } else if (selectedOption === 'Registration') {
                    registrationgroup.style.display = 'block';
                    idNumber.value = '';
                    passportNumber.value = '';
                    birthCert.value ='';
                    policeNumber.value = '';

                    // Enable day, month, and year select options for other options
                    document.getElementById('day').disabled = false;
                    document.getElementById('month').disabled = false;
                    document.getElementById('year').disabled = false;
                    document.getElementById('identityrMaleInput').disabled = false;
                    document.getElementById('identityFemaleInput').disabled = false;
                }

                // Store the selected option in local storage
                localStorage.setItem('selectedOption', selectedOption);
            }

            // Get the stored selected option from local storage
            var storedOption = localStorage.getItem('selectedOption');

            if (storedOption) {
                selectedOption = storedOption;
                idTypeSelect.value = selectedOption;
                showSelectedGroup(selectedOption);
            }
        });

        // Logics to validate idNumber
        // Add event listener to the input field
        document.getElementById('idNumber').addEventListener('input', function (e) {
            // Get the input value and remove any non-numeric characters
            var inputValue = this.value.replace(/\D/g, '');

            // Truncate the input value to a maximum length of 12 characters
            inputValue = inputValue.slice(0, 12);

            // Format the value with dashes
            var formattedValue = inputValue.replace(/^(\d{6})(\d{2})(\d{4})$/, '$1-$2-$3');

            // Set the formatted value back to the input field
            this.value = formattedValue;
        });

        // Logics to calculate age
        // Get the ID Number field and the date of birth fields
        const idNumberField = document.getElementById('idNumber');
        const dayField = document.getElementById('day');
        const monthField = document.getElementById('month');
        const yearField = document.getElementById('year');
        const ageField = document.getElementById('age');
        const genderRegex = /[13579]/;
        const genderRadioMaleInput = document.getElementById("identityrMaleInput");
        const genderRadioFemaleInput = document.getElementById("identityFemaleInput");

        // Listen for changes in the ID Number field
        idNumberField.addEventListener('input', function() {

            // Logics for gender field
            const lastDigit = idNumberField.value.substring(13, 14);

            if(idNumberField.value === '') {
                genderRadioMaleInput.checked = false;
                genderRadioFemaleInput.checked = false;
            }
            else if (genderRegex.test(lastDigit.toString())){
                genderRadioMaleInput.checked = true;
                genderRadioFemaleInput.checked = false;
            }
            else {
                genderRadioFemaleInput.checked = true;
                genderRadioMaleInput.checked = false;
            }

            const idNumber = idNumberField.value;

            // Extract the first 6 digits as the date, month, and year
            const yearDigits = idNumber.substring(0, 2);
            const monthDigits = idNumber.substring(2, 4);
            const dateDigits = idNumber.substring(4, 6);

            // Set the extracted values in the date of birth fields
            dayField.value = dateDigits;
            monthField.value = monthDigits;

            // Find the matching option in the year dropdown based on the last 2 digits of ID
            const matchingOption = Array.from(yearField.options).find(option => {
                return option.value.substring(2, 4) === yearDigits;
            });

            // Set the selected option in the year dropdown
            if (matchingOption) {
                matchingOption.selected = true;
            }

            // Trigger the change event on the year field to recalculate the age
            const event = new Event('change');
            yearField.dispatchEvent(event);
        });        

        // Function to calculate age
        function calculateAge() {
            const selectedDay = parseInt(dayField.value);
            const selectedMonth = parseInt(monthField.value);
            const selectedYearOption = yearField.options[yearField.selectedIndex];
            const selectedYear = selectedYearOption.textContent;
            
            if (isNaN(selectedDay) || isNaN(selectedMonth) || isNaN(selectedYear)) {
                ageField.textContent = 'Invalid ID number entered';
                return;
            }

            const currentDate = new Date();
            const selectedDate = new Date(selectedYear, selectedMonth - 1, selectedDay);

            if (isNaN(selectedDate.getTime())) {
                ageField.textContent = 'Invalid date';
                return;
            }

            let age = currentDate.getFullYear() - selectedDate.getFullYear();
            const monthDiff = currentDate.getMonth() - selectedDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < selectedDate.getDate())) {
            age--;
            }

            ageField.textContent = 'Age: ' + age;
        }

        // Calculate age on initial load
        calculateAge();

        // Calculate age whenever the date fields are changed
        dayField.addEventListener('change', calculateAge);
        monthField.addEventListener('change', calculateAge);
        yearField.addEventListener('change', calculateAge);
    }

    if (path == '/family-dependant') {
        document.addEventListener('DOMContentLoaded', function() {
            if (marital_status) {
                var maritalStatus = marital_status;

                // Disable the 'Spouse' button if maritalStatus is 'single'
                if (maritalStatus === 'single') {
                    const spouseButton = document.getElementById('spouseButton');
                    const childButton = document.getElementById('childButton');
                    spouseButton.disabled = true;
                    childButton.disabled = true;
        
                    // Remove hover effect if it is disabled
                    const spouseParentDiv = spouseButton.parentElement;
                    const childParentDiv = childButton.parentElement;
                    spouseParentDiv.classList.remove('hover');
                    childParentDiv.classList.remove('hover');
        
                    const spouseImg = spouseButton.querySelector('img');
                    const childImg = childButton.querySelector('img');
                    spouseImg.style.opacity = '0.5'; 
                    childImg.style.opacity = '0.5'; 
        
                } else if (maritalStatus === 'divorced' || maritalStatus === 'widowed') {
                    const spouseButton = document.getElementById('spouseButton');
                    spouseButton.disabled = true;
        
                    // Remove hover effect if it is disabled
                    const spouseParentDiv = spouseButton.parentElement;
                    spouseParentDiv.classList.remove('hover');
        
                    const spouseImg = spouseButton.querySelector('img');
                    spouseImg.style.opacity = '0.5'; 
                }
            }
            else {
                if (maritalStatus == null || maritalStatus == undefined || maritalStatus == '') {
                    var myModal = document.getElementById('missingFields');
                    myModal.classList.add('show');
                    myModal.style.display = 'block';
                    document.querySelector('body').style.paddingRight = '0px';
                    document.querySelector('body').style.overflow = 'hidden';
                    document.querySelector('body').classList.add('modal-open');

                    var modalBackdrop = document.createElement('div');
                    modalBackdrop.className = 'modal-backdrop fade show';
                    document.querySelector('body.modal-open').append(modalBackdrop);

                    // Close the modal
                    var closeButton = document.querySelector('#missingFields .btn-exit-sidebar');
                    closeButton.addEventListener('click', function() {
                        myModal.classList.remove('show');
                        myModal.style.display = 'none';
                        document.querySelector('body').style.paddingRight = '';
                        document.querySelector('body').style.overflow = '';
                        document.querySelector('body').classList.remove('modal-open');
                        var modalBackdrop = document.querySelector('.modal-backdrop');
                        if (modalBackdrop) {
                            modalBackdrop.remove();
                        }
                        window.location.href = '/marital-status';
                    });
                }
            }
        });
    }

    if (path == '/family-dependant/details') {
        document.addEventListener('DOMContentLoaded', function() {
            if (family_details) {
                var dependant = family_details;
                var spouse = spouse_session;
                
                if (spouse === true) {
                    // Show the selected groups based on the dropdown selected
                    var idTypeSelect = document.getElementById('spouseIdSelect');
                    var newicgroup = document.getElementById('newicgroup');
                    var passportgroup = document.getElementById('passportgroup');
                    var birthcertgroup = document.getElementById('birthcertgroup');
                    var policegroup = document.getElementById('policegroup');
                    var registrationgroup = document.getElementById('registrationgroup');
    
                    var selectedOption;
    
                    idTypeSelect.addEventListener('change', function() {
                        selectedOption = this.value;
                        showSelectedGroup(selectedOption);
                    });
                
                    // Function to show the selected group
                    function showSelectedGroup(selectedOption) {
    
                        // Hide all groups and remove the required attribute from all of them
                        newicgroup.style.display = 'none';
                        spouseIdNumber.removeAttribute('required');
                        passportgroup.style.display = 'none';
                        spousePassportNumber.removeAttribute('required');
                        birthcertgroup.style.display = 'none';
                        spouseBirthCert.removeAttribute('required');
                        policegroup.style.display = 'none';
                        spousePoliceNumber.removeAttribute('required');
                        registrationgroup.style.display = 'none';
                        spouseRegistrationNumber.removeAttribute('required');
    
                        // Show the relevant group based on the selected option and add the required attribute
                        if (selectedOption === 'New IC') {
                            newicgroup.style.display = 'block';
                            spousePassportNumber.value = '';
                            spouseBirthCert.value = '';
                            spousePoliceNumber.value = '';
                            spouseRegistrationNumber.value = '';
    
                            const form = document.getElementById("familyDetailsForm");
    
                            form.addEventListener("submit", function(event) {
                                // Enable the inputs before form submission
                                document.getElementById('spouseMaleInput').disabled = false;
                                document.getElementById('spouseFemaleInput').disabled = false;
                                document.getElementById('spouseday').disabled = false;
                                document.getElementById('spousemonth').disabled = false;
                                document.getElementById('spouseyear').disabled = false;
                            });
    
                            // Disable day, month, and year select options
                            document.getElementById('spouseday').disabled = true;
                            document.getElementById('spousemonth').disabled = true;
                            document.getElementById('spouseyear').disabled = true;
                            document.getElementById('spouseMaleInput').disabled = true;
                            document.getElementById('spouseFemaleInput').disabled = true;
    
                        } else if (selectedOption === 'Passport') {
                            passportgroup.style.display = 'block';
                            spouseIdNumber.value = '';
                            spouseBirthCert.value = '';
                            spousePoliceNumber.value = '';
                            spouseRegistrationNumber.value = '';
    
                            // Enable day, month, and year select options for other options
                            document.getElementById('spouseday').disabled = false;
                            document.getElementById('spousemonth').disabled = false;
                            document.getElementById('spouseyear').disabled = false;
                            document.getElementById('spouseMaleInput').disabled = false;
                            document.getElementById('spouseFemaleInput').disabled = false;
    
                        } else if (selectedOption === 'Birth Certificate') {
                            birthcertgroup.style.display = 'block';
                            spouseIdNumber.value = '';
                            spousePassportNumber.value = '';
                            spousePoliceNumber.value = '';
                            spouseRegistrationNumber.value = '';
    
                            // Enable day, month, and year select options for other options
                            document.getElementById('spouseday').disabled = false;
                            document.getElementById('spousemonth').disabled = false;
                            document.getElementById('spouseyear').disabled = false;
                            document.getElementById('spouseMaleInput').disabled = false;
                            document.getElementById('spouseFemaleInput').disabled = false;
    
                        } else if (selectedOption === 'Police / Army') {
                            policegroup.style.display = 'block';
                            spouseIdNumber.value = '';
                            spousePassportNumber.value = '';
                            spouseBirthCert.value = '';
                            spouseRegistrationNumber.value = '';
    
                            // Enable day, month, and year select options for other options
                            document.getElementById('spouseday').disabled = false;
                            document.getElementById('spousemonth').disabled = false;
                            document.getElementById('spouseyear').disabled = false;
                            document.getElementById('spouseMaleInput').disabled = false;
                            document.getElementById('spouseFemaleInput').disabled = false;
    
                        } else if (selectedOption === 'Registration') {
                            registrationgroup.style.display = 'block';
                            spouseIdNumber.value = '';
                            spousePassportNumber.value = '';
                            spouseBirthCert.value = '';
                            spousePoliceNumber.value = '';
    
                            // Enable day, month, and year select options for other options
                            document.getElementById('spouseday').disabled = false;
                            document.getElementById('spousemonth').disabled = false;
                            document.getElementById('spouseyear').disabled = false;
                            document.getElementById('spouseMaleInput').disabled = false;
                            document.getElementById('spouseFemaleInput').disabled = false;
                        }
    
                        // Store the selected option in local storage
                        localStorage.setItem('selectedOption', selectedOption);
                    }
    
                    // Get the stored selected option from local storage
                    var storedOption = localStorage.getItem('selectedOption');
                    if (storedOption) {
                        selectedOption = storedOption;
                        idTypeSelect.value = selectedOption;
                        showSelectedGroup(selectedOption);
                    }
        
                    // Logics to validate idNumber
                    // Add event listener to the input field
                    document.getElementById('spouseIdNumber').addEventListener('input', function (e) {
                        // Get the input value and remove any non-numeric characters
                        var inputValue = this.value.replace(/\D/g, '');
            
                        // Truncate the input value to a maximum length of 12 characters
                        inputValue = inputValue.slice(0, 12);
            
                        // Format the value with dashes
                        var formattedValue = inputValue.replace(/^(\d{6})(\d{2})(\d{4})$/, '$1-$2-$3');
            
                        // Set the formatted value back to the input field
                        this.value = formattedValue;
                    });
        
                    // Logics to calculate age
                    // Get the ID Number field and the date of birth fields
                    const idNumberField = document.getElementById('spouseIdNumber');
                    const dayField = document.getElementById('spouseday');
                    const monthField = document.getElementById('spousemonth');
                    const yearField = document.getElementById('spouseyear');
                    const ageField = document.getElementById('spouseAge');
                    const genderRegex = /[13579]/;
                    const genderRadioMaleInput = document.getElementById("spouseMaleInput");
                    const genderRadioFemaleInput = document.getElementById("spouseFemaleInput");
        
                    // Listen for changes in the ID Number field
                    idNumberField.addEventListener('input', function() {
                        
                        // Logics for gender field
                        const lastDigit = idNumberField.value.substring(13, 14);
                        
                        if(idNumberField.value === '') {
                            genderRadioMaleInput.checked = false;
                            genderRadioFemaleInput.checked = false;
                        }
                        else if (genderRegex.test(lastDigit.toString())){
                            genderRadioMaleInput.checked = true;
                            genderRadioFemaleInput.checked = false;
                        }
                        else {
                            genderRadioFemaleInput.checked = true;
                            genderRadioMaleInput.checked = false;
                        }
        
                        const idNumber = idNumberField.value;
        
                        // Extract the first 6 digits as the date, month, and year
                        const yearDigits = idNumber.substring(0, 2);
                        const monthDigits = idNumber.substring(2, 4);
                        const dateDigits = idNumber.substring(4, 6);
        
                        // Set the extracted values in the date of birth fields
                        dayField.value = dateDigits;
                        monthField.value = monthDigits;
        
                        // Find the matching option in the year dropdown based on the last 2 digits of ID
                        const matchingOption = Array.from(yearField.options).find(option => {
                            return option.value.substring(2, 4) === yearDigits;
                        });
        
                        // Set the selected option in the year dropdown
                        if (matchingOption) {
                            matchingOption.selected = true;
                        }
        
                        // Trigger the change event on the year field to recalculate the age
                        const event = new Event('change');
                        yearField.dispatchEvent(event);
                    });
        
                    // Function to calculate age
                    function calculateAge() {
                        const selectedDay = parseInt(dayField.value);
                        const selectedMonth = parseInt(monthField.value);
                        const selectedYearOption = yearField.options[yearField.selectedIndex];
                        const selectedYear = selectedYearOption.textContent;
                        
                        if (isNaN(selectedDay) || isNaN(selectedMonth) || isNaN(selectedYear)) {
                            ageField.textContent = 'Invalid ID number entered';
                            return;
                        }
        
                        const currentDate = new Date();
                        const selectedDate = new Date(selectedYear, selectedMonth - 1, selectedDay);
        
                        if (isNaN(selectedDate.getTime())) {
                            ageField.textContent = 'Invalid date';
                            return;
                        }
        
                        let age = currentDate.getFullYear() - selectedDate.getFullYear();
                        const monthDiff = currentDate.getMonth() - selectedDate.getMonth();
        
                        if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < selectedDate.getDate())) {
                        age--;
                        }
        
                        ageField.textContent = 'Age: ' + age;
                    }
        
                    // // Calculate age on initial load
                    calculateAge();
        
                    // Calculate age whenever the date fields are changed
                    dayField.addEventListener('change', calculateAge);
                    monthField.addEventListener('change', calculateAge);
                    yearField.addEventListener('change', calculateAge);
                }
            }
            else {
                if (dependant == null || dependant == undefined || dependant == '') {
                    var myModal = document.getElementById('missingFields');
                    myModal.classList.add('show');
                    myModal.style.display = 'block';
                    document.querySelector('body').style.paddingRight = '0px';
                    document.querySelector('body').style.overflow = 'hidden';
                    document.querySelector('body').classList.add('modal-open');
        
                    var modalBackdrop = document.createElement('div');
                    modalBackdrop.className = 'modal-backdrop fade show';
                    document.querySelector('body.modal-open').append(modalBackdrop);
        
                    // Close the modal
                    var closeButton = document.querySelector('#missingFields .btn-exit-sidebar');
                    closeButton.addEventListener('click', function() {
                        myModal.classList.remove('show');
                        myModal.style.display = 'none';
                        document.querySelector('body').style.paddingRight = '';
                        document.querySelector('body').style.overflow = '';
                        document.querySelector('body').classList.remove('modal-open');
                        var modalBackdrop = document.querySelector('.modal-backdrop');
                        if (modalBackdrop) {
                            modalBackdrop.remove();
                        }
                        window.location.href = '/family-dependant';
                    });
                }
            }
        });
    }

    if (path == '/existing-policy') {
        document.addEventListener('DOMContentLoaded', function() {
            // Show dropdown based on selected radio buttons
            var ownerRadioButton = document.querySelector('input[name="policyRole"][value="owner"]');
            var dependantRadioButton = document.querySelector('input[name="policyRole"][value="life insured"]');
            var bothRadioButton = document.querySelector('input[name="policyRole"][value="both"]');
            var first_name_dropdown = document.getElementById('policyFirstNameSelect');
            var last_name_dropdown = document.getElementById('policyLastNameSelect');

            // Pre-select the options
            if (existingPolicy && existingPolicy['policy_1']) {
                var sessionRole = existingPolicy['policy_1']['role'];
                var sessionFirstName = existingPolicy['policy_1']['first_name'];
                var sessionLastName = existingPolicy['policy_1']['last_name'];
            }

            if (sessionRole === 'owner') {
                var first_name_option = document.createElement('option');
                first_name_option.value = first_name;
                first_name_option.text = first_name;
                var last_name_option = document.createElement('option');
                last_name_option.value = last_name;
                last_name_option.text = last_name;

                first_name_dropdown.add(first_name_option);
                last_name_dropdown.add(last_name_option);
                first_name_dropdown.value = sessionFirstName;
                last_name_dropdown.value = sessionLastName;
            }
            else if (sessionRole === 'life insured') {
                for (var key in family_details) {
                    if (family_details.hasOwnProperty(key)) {
                        var first_name_option = document.createElement('option');
                        first_name_option.value = family_details[key]['first_name'];
                        first_name_option.text = family_details[key]['first_name'];

                        if (family_details[key]['first_name'] === sessionFirstName) {
                            var last_name_option = document.createElement('option');
                            last_name_option.value = family_details[key]['last_name'];
                            last_name_option.text = family_details[key]['last_name'];
                            last_name_dropdown.add(last_name_option);
                        }
                        
                        first_name_dropdown.add(first_name_option);
                        first_name_dropdown.value = sessionFirstName;
                        last_name_dropdown.value = sessionLastName;

                        last_name_auto_dropdown();
                    }
                }
            }
            else if (sessionRole === 'both') {
                var first_name_option_self = document.createElement('option');
                first_name_option_self.value = first_name;
                first_name_option_self.text = first_name;

                first_name_dropdown.add(first_name_option_self);

                for (var key in family_details) {
                    if (family_details.hasOwnProperty(key)) {
                        var first_name_option = document.createElement('option');
                        first_name_option.value = family_details[key]['first_name'];
                        first_name_option.text = family_details[key]['first_name'];

                        if (family_details[key]['first_name'] === sessionFirstName) {
                            var last_name_option = document.createElement('option');
                            last_name_option.value = family_details[key]['last_name'];
                            last_name_option.text = family_details[key]['last_name'];
                            last_name_dropdown.add(last_name_option);
                        }
                        else {
                            var last_name_option = document.createElement('option');
                            last_name_option.value = last_name;
                            last_name_option.text = last_name;
                            last_name_dropdown.add(last_name_option);
                        }
                        
                        first_name_dropdown.add(first_name_option);
                        first_name_dropdown.value = sessionFirstName;
                        last_name_dropdown.value = sessionLastName;

                        last_name_auto_dropdown_both();
                    }
                }
            }
            else {
                var defaultOption = document.createElement('option');
                defaultOption.text = 'Please Select';
                defaultOption.value = '';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                last_name_dropdown.add(defaultOption);
            }

            // Show options based on selected radio button
            ownerRadioButton.addEventListener('click', function() {
                first_name_dropdown.innerHTML = '';
                last_name_dropdown.innerHTML = '';

                var defaultOption = document.createElement('option');
                defaultOption.text = 'Please Select';
                defaultOption.value = '';
                defaultOption.disabled = true;

                // first_name_dropdown.add(defaultOption.cloneNode(true));
                first_name_dropdown.add(defaultOption);

                var first_name_option = document.createElement('option');
                first_name_option.value = first_name;
                first_name_option.text = first_name;
                var last_name_option = document.createElement('option');
                last_name_option.value = last_name;
                last_name_option.text = last_name;

                first_name_dropdown.add(first_name_option);
                last_name_dropdown.add(last_name_option);
            });

            dependantRadioButton.addEventListener('click', function() {
                first_name_dropdown.innerHTML = '';
                last_name_dropdown.innerHTML = '';

                var defaultOption = document.createElement('option');
                defaultOption.text = 'Please Select';
                defaultOption.value = '';
                defaultOption.disabled = true;

                first_name_dropdown.add(defaultOption);

                for (var key in family_details) {
                    if (family_details.hasOwnProperty(key)) {
                        var first_name_option = document.createElement('option');
                        first_name_option.value = family_details[key]['first_name'];
                        first_name_option.text = family_details[key]['first_name'];
                        
                        first_name_dropdown.add(first_name_option);
                    }
                }
                
                last_name_auto_dropdown();

                var changeEvent = new Event('change');
                first_name_dropdown.dispatchEvent(changeEvent);
            });

            function last_name_auto_dropdown() {
                first_name_dropdown.addEventListener('change', function() {
                    var selectedFirstName = first_name_dropdown.value;

                    if (selectedFirstName) {
                        var selectedLastName = '';
                        for (var key in family_details) {
                            if (family_details.hasOwnProperty(key)) {
                                if (family_details[key]['first_name'] === selectedFirstName) {
                                    selectedLastName = family_details[key]['last_name'];
                                    break;
                                }
                            }
                        }
    
                        var last_name_option = document.createElement('option');
                        last_name_option.value = selectedLastName;
                        last_name_option.text = selectedLastName;
                        last_name_dropdown.innerHTML = '';
                        last_name_dropdown.add(last_name_option);
                    }
                    else {
                        last_name_dropdown.innerHTML = '';
                    }
                });
            }
            
            bothRadioButton.addEventListener('click', function() {
                first_name_dropdown.innerHTML = '';
                last_name_dropdown.innerHTML = '';

                var defaultOption = document.createElement('option');
                defaultOption.text = 'Please Select';
                defaultOption.value = '';
                defaultOption.disabled = true;

                first_name_dropdown.add(defaultOption);

                var first_name_option_self = document.createElement('option');
                first_name_option_self.value = first_name;
                first_name_option_self.text = first_name;

                first_name_dropdown.add(first_name_option_self);

                for (var key in family_details) {
                    if (family_details.hasOwnProperty(key)) {
                        var first_name_option = document.createElement('option');
                        first_name_option.value = family_details[key]['first_name'];
                        first_name_option.text = family_details[key]['first_name'];
                        
                        first_name_dropdown.add(first_name_option);
                    }
                }

                last_name_auto_dropdown_both();

                var changeEvent = new Event('change');
                first_name_dropdown.dispatchEvent(changeEvent);
            });

            function last_name_auto_dropdown_both() {
                first_name_dropdown.addEventListener('change', function() {
                    var selectedFirstName = first_name_dropdown.value;
                    last_name_dropdown.innerHTML = '';

                    if (selectedFirstName) {
                        var selectedLastName = '';
                        var foundMatch = false;

                        for (var key in family_details) {
                            if (family_details.hasOwnProperty(key)) {
                                if (family_details[key]['first_name'] === selectedFirstName) {
                                    selectedLastName = family_details[key]['last_name'];
                                    foundMatch = true;
                                    break;
                                }
                            }
                        }
                        if (foundMatch) {
                            var last_name_option = document.createElement('option');
                            last_name_option.value = selectedLastName;
                            last_name_option.text = selectedLastName;
                            last_name_dropdown.innerHTML = '';
                            last_name_dropdown.add(last_name_option);
                        }
                        else {
                            var last_name_option_self = document.createElement('option');
                            last_name_option_self.value = last_name;
                            last_name_option_self.text = last_name;
                            last_name_dropdown.add(last_name_option_self);
                        }
                    }
                    else {
                        last_name_dropdown.innerHTML = '';
                    }
                });
            }
            
            let i = 2;

            // Function to add a new form
            function addForm() {
                var formContainer = document.getElementById('formContainer');
                var existingpolicy = document.getElementById('existing_policy');
                var formTemplate = document.getElementById('form');
                var modalTemplate = document.getElementById('addBenefits');

                // Clone the form template
                var clonedForm = formTemplate.cloneNode(true);
                var clonedModal = modalTemplate.cloneNode(true);

                // Generate unique IDs for cloned form
                const originalForm = clonedForm.getAttribute('id');
                const newForm = originalForm + i;
                clonedForm.setAttribute('id', newForm);

                // Generate unique title for cloned form
                const oriTitle = clonedForm.querySelector('h4');
                const newTitle = 'Policy ' + i;
                oriTitle.innerHTML = newTitle;

                // Generate unique labels for cloned form
                clonedForm.querySelectorAll('label.form-label').forEach(input => {
                    const originalLabel = input.getAttribute('for');
                    const newLabel = originalLabel + i;
                    input.setAttribute('for', newLabel);
                });

                // Generate unique IDs for inputs within cloned form
                clonedForm.querySelectorAll('input:not(.policy):not(.role)').forEach(input => {
                    const originalName = input.getAttribute('name');
                    const newName = originalName + i;
                    input.setAttribute('name', newName);
                    if (existingPolicy && existingPolicy['policy_' + i] && existingPolicy['policy_' + i]['name'] && input.getAttribute('name') == 'policyFirstName' + i) {
                        input.value = existingPolicy['policy_' + i]['name'] || '';
                    }
                    // const oldInputValue = `{{ old('companyOthers', $existingPolicy['policy_1']['company_others'] ?? '') }}`;
                    // if (oldInputValue !== '') {
                    //     input.value = oldInputValue;
                    // }
                    else {
                        input.value = '';
                        input.classList.remove('is-valid');
                        input.classList.remove('is-invalid');
                    }
                });

                clonedForm.querySelectorAll('input.role').forEach(input => {
                    const originalName = input.getAttribute('name');
                    const newName = originalName + i;
                    input.setAttribute('name', newName);
                });

                // Generate unique inputs for cloned form
                clonedForm.querySelectorAll('input.policy').forEach(input => {
                    const originalHidden = input.getAttribute('id');
                    const newHidden = originalHidden + i;
                    input.setAttribute('name', newHidden);
                    input.value = newHidden;
                });

                // Generate unique IDs for all elements within cloned form
                clonedForm.querySelectorAll('*').forEach(elementForm => {
                    if (elementForm.id) {
                        elementForm.id = elementForm.id + i;
                    }

                    if (elementForm.tagName.toLowerCase() === 'select') {
                        elementForm.classList.remove('is-valid');
                        elementForm.classList.remove('is-invalid');
                        if (elementForm.name) {
                            elementForm.name = elementForm.name + i;
                        }
                        if (existingPolicy && existingPolicy['policy_' + i] && existingPolicy['policy_' + i]['first_name']) {
                            console.log(elementForm);
                            elementForm.selected = true;
                        }
                    }
                });

                // Empty all radio button fields when cloned.
                var clonedRadioButtons = clonedForm.querySelectorAll('input[type="radio"]');
                clonedRadioButtons.forEach(function(radioButton) {
                    radioButton.checked = false;
                    if (existingPolicy && existingPolicy['policy_' + i] && existingPolicy['policy_' + i]['role']) {
                        radioButton.checked = true;
                    }
                });

                var modalLink = clonedForm.querySelector('#addFieldsBtn' + i);
                var modalTarget = modalLink.getAttribute('data-bs-target');
                const newModalTarget = modalTarget + i;
                modalLink.setAttribute('data-bs-target', newModalTarget);
                clonedForm.setAttribute('data-index', i);

                const modalId = clonedModal.getAttribute('id');
                const newModalId = modalId + i;
                clonedModal.setAttribute('id', newModalId);
                var modalButton = clonedModal.querySelector('.btn-exit-benefits');
                modalButton.setAttribute('data-index', i);

                clonedModal.querySelectorAll('input').forEach(input => {
                    const originalInput = input.getAttribute('id');
                    const newInput = originalInput + i;
                    input.setAttribute('id', newInput);
                    input.setAttribute('name', newInput);
                    input.value = '';
                });

                var removeField = clonedForm.querySelectorAll('.remove-div');
                removeField.forEach(function(removeFields) {
                    removeFields.remove();
                });

                // Append the cloned form to the container
                formContainer.appendChild(clonedForm);
                existingpolicy.appendChild(clonedModal);

                if (i === 4) {
                    $('.customAddBtn').hide();
                }
                i++;

                var ownerRadioButton2 = document.querySelector('input[name="policyRole2"][value="owner"]');
                var dependantRadioButton2 = document.querySelector('input[name="policyRole2"][value="life insured"]');
                var bothRadioButton2 = document.querySelector('input[name="policyRole2"][value="both"]');
                var first_name_dropdown2 = document.getElementById('policyFirstNameSelect2');
                var last_name_dropdown2 = document.getElementById('policyLastNameSelect2');
            
                ownerRadioButton2.addEventListener('click', function() {
                    first_name_dropdown2.innerHTML = '';
                    last_name_dropdown2.innerHTML = '';
    
                    var defaultOption = document.createElement('option');
                    defaultOption.text = 'Please Select';
                    defaultOption.value = '';
                    defaultOption.disabled = true;
    
                    first_name_dropdown2.add(defaultOption);
    
                    var first_name_option = document.createElement('option');
                    first_name_option.value = first_name;
                    first_name_option.text = first_name;
                    var last_name_option = document.createElement('option');
                    last_name_option.value = last_name;
                    last_name_option.text = last_name;
    
                    first_name_dropdown2.add(first_name_option);
                    last_name_dropdown2.add(last_name_option);
                });

                dependantRadioButton2.addEventListener('click', function() {
                    first_name_dropdown2.innerHTML = '';
                    last_name_dropdown2.innerHTML = '';
    
                    var defaultOption = document.createElement('option');
                    defaultOption.text = 'Please Select';
                    defaultOption.value = '';
                    defaultOption.disabled = true;
    
                    first_name_dropdown2.add(defaultOption);
    
                    for (var key in family_details) {
                        if (family_details.hasOwnProperty(key)) {
                            var first_name_option = document.createElement('option');
                            first_name_option.value = family_details[key]['first_name'];
                            first_name_option.text = family_details[key]['first_name'];
                            
                            first_name_dropdown2.add(first_name_option);
                        }
                    }
                    
                    last_name_auto_dropdown_cloned();
    
                    var changeEvent = new Event('change');
                    first_name_dropdown2.dispatchEvent(changeEvent);
                });

                bothRadioButton2.addEventListener('click', function() {
                    first_name_dropdown2.innerHTML = '';
                    last_name_dropdown2.innerHTML = '';
    
                    var defaultOption = document.createElement('option');
                    defaultOption.text = 'Please Select';
                    defaultOption.value = '';
                    defaultOption.disabled = true;
    
                    first_name_dropdown2.add(defaultOption);
    
                    var first_name_option_self = document.createElement('option');
                    first_name_option_self.value = first_name;
                    first_name_option_self.text = first_name;
    
                    first_name_dropdown2.add(first_name_option_self);
    
                    for (var key in family_details) {
                        if (family_details.hasOwnProperty(key)) {
                            var first_name_option = document.createElement('option');
                            first_name_option.value = family_details[key]['first_name'];
                            first_name_option.text = family_details[key]['first_name'];
                            
                            first_name_dropdown2.add(first_name_option);
                        }
                    }
    
                    last_name_auto_dropdown_both_cloned();
    
                    var changeEvent = new Event('change');
                    first_name_dropdown2.dispatchEvent(changeEvent);
                });

                clientValidations();

                function last_name_auto_dropdown_cloned() {
                    first_name_dropdown2.addEventListener('change', function() {
                        var selectedFirstName = first_name_dropdown2.value;
    
                        if (selectedFirstName) {
                            var selectedLastName = '';
                            for (var key in family_details) {
                                if (family_details.hasOwnProperty(key)) {
                                    if (family_details[key]['first_name'] === selectedFirstName) {
                                        selectedLastName = family_details[key]['last_name'];
                                        break;
                                    }
                                }
                            }
        
                            var last_name_option = document.createElement('option');
                            last_name_option.value = selectedLastName;
                            last_name_option.text = selectedLastName;
                            last_name_dropdown2.innerHTML = '';
                            last_name_dropdown2.add(last_name_option);
                        }
                        else {
                            last_name_dropdown2.innerHTML = '';
                        }
                    });
                }

                function last_name_auto_dropdown_both_cloned() {
                    first_name_dropdown2.addEventListener('change', function() {
                        var selectedFirstName = first_name_dropdown2.value;
                        last_name_dropdown2.innerHTML = '';
    
                        if (selectedFirstName) {
                            var selectedLastName = '';
                            var foundMatch = false;
    
                            for (var key in family_details) {
                                if (family_details.hasOwnProperty(key)) {
                                    if (family_details[key]['first_name'] === selectedFirstName) {
                                        selectedLastName = family_details[key]['last_name'];
                                        foundMatch = true;
                                        break;
                                    }
                                }
                            }
                            if (foundMatch) {
                                var last_name_option = document.createElement('option');
                                last_name_option.value = selectedLastName;
                                last_name_option.text = selectedLastName;
                                last_name_dropdown2.innerHTML = '';
                                last_name_dropdown2.add(last_name_option);
                            }
                            else {
                                var last_name_option_self = document.createElement('option');
                                last_name_option_self.value = last_name;
                                last_name_option_self.text = last_name;
                                last_name_dropdown2.add(last_name_option_self);
                            }
                        }
                        else {
                            last_name_dropdown2.innerHTML = '';
                        }
                    });
                }

                function clientValidations() {
                    var policyFirstNameSelect2 = document.getElementById('policyFirstNameSelect2');
                    var policyLastNameSelect2 = document.getElementById('policyLastNameSelect2');
                    var companySelect2 = document.getElementById('companySelect2');
                    var companyOthersText2 = document.getElementById('companyOthersText2');
                    var inceptionYearInput2 = document.getElementById('inceptionYearInput2');
                    var policyPlanSelect2 = document.getElementById('policyPlanSelect2');
                    var maturityYearInput2 = document.getElementById('maturityYearInput2');
                    var premiumModeSelect2 = document.getElementById('premiumModeSelect2');
                    var premiumContributionInput2 = document.getElementById('premiumContributionInput2');
                    var lifeCoverageInput2 = document.getElementById('lifeCoverageInput2');
                    var criticalIllnessInput2 = document.getElementById('criticalIllnessInput2');

                    companySelect2.addEventListener('blur', function() {
                        validateSelectField(companySelect2);
                    });

                    policyFirstNameSelect2.addEventListener('blur', function() {
                        validateSelectField(policyFirstNameSelect2);
                    });

                    policyLastNameSelect2.addEventListener('blur', function() {
                        validateSelectField(policyLastNameSelect2);
                    });

                    companyOthersText2.addEventListener('blur', function() {
                        validateInputFieldOthers(companyOthersText2);
                    });

                    inceptionYearInput2.addEventListener('blur', function() {
                        validateNumberField(inceptionYearInput2);
                    });

                    policyPlanSelect2.addEventListener('blur', function() {
                        validateSelectField(policyPlanSelect2);
                    });

                    maturityYearInput2.addEventListener('blur', function() {
                        validateNumberFieldMaturity(maturityYearInput2);
                    });

                    premiumModeSelect2.addEventListener('blur', function() {
                        validateSelectField(premiumModeSelect2);
                    });

                    premiumContributionInput2.addEventListener('blur', function() {
                        validateCurrencyField(premiumContributionInput2);
                    });

                    lifeCoverageInput2.addEventListener('blur', function() {
                        validateCurrencyField(lifeCoverageInput2);
                    });

                    criticalIllnessInput2.addEventListener('blur', function() {
                        validateCurrencyField(criticalIllnessInput2);
                    });

                    function validateSelectField(field) {
                        if (field.value) {
                            field.classList.add('is-valid');
                            field.classList.remove('is-invalid');
                        } else {
                            field.classList.remove('is-valid');
                            field.classList.add('is-invalid');
                        }
                    }

                    function validateInputFieldOthers(field) {
                        if (field.value) {
                            field.classList.add('is-valid');
                            field.classList.remove('is-invalid');
                        } else {
                            field.classList.remove('is-valid');
                            field.classList.add('is-invalid');
                        }
                    }

                    function validateNumberField(field) {
                        if (field.value && isValidYear(field.value)) {
                            field.classList.add('is-valid');
                            field.classList.remove('is-invalid');
                        } else {
                            field.classList.remove('is-valid');
                            field.classList.add('is-invalid');
                        }
                    }

                    function validateNumberFieldMaturity(field) {
                        if (field.value && isValidYearMaturity(field.value)) {
                            field.classList.add('is-valid');
                            field.classList.remove('is-invalid');
                        } else {
                            field.classList.remove('is-valid');
                            field.classList.add('is-invalid');
                        }
                    }

                    function validateCurrencyField(field) {
                        if (field.value && isValidCurrency(field.value)) {
                            field.classList.add('is-valid');
                            field.classList.remove('is-invalid');
                        } else {
                            field.classList.remove('is-valid');
                            field.classList.add('is-invalid');
                        }
                    }

                    function isValidYear(year) {
                        // Return true if the year is valid (1900 to current year), false otherwise
                        var yearRegex = /^(19\d{2}|20\d{2})$/;
                        var currentYear = new Date().getFullYear();

                        if (yearRegex.test(year) && parseInt(year) >= 1900 && parseInt(year) <= currentYear) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function isValidYearMaturity(year) {
                        var currentYear = new Date().getFullYear();
                        var customerAge = currentYear - dobYear;
                        var maturityYear = 100 - customerAge;
                        var allowedYear = currentYear + maturityYear;

                        if (parseInt(year) >= currentYear && parseInt(year) <= allowedYear) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function isValidCurrency(currency) {
                        // Return true if the currency is valid, false otherwise
                        var currencyRegex = /^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/;

                        var isValid = currencyRegex.test(currency);
                        return isValid;
                    }
                }

            }

            var fieldCount = 0;
            function addFields() {
                // Add more fields
                var modal = document.getElementById('addBenefits');
                var input = modal.querySelector('input#addBenefitsInput');
                
                $(document).off('click', '.btn-exit-benefits').on('click', '.btn-exit-benefits', function(event) {
                    event.preventDefault();
                    
                    if (fieldCount < 5) {
                        var dataIndex = $(this).data('index');
    
                        if(dataIndex == 1) {
                            var dataIndexPass = 'addBenefitsInput';
                            var addFields = '#addFields';
                        }
                        else {
                            var dataIndexPass = 'addBenefitsInput' + dataIndex;
                            var addFields = '#addFields' + dataIndex;
                        }

                        fieldTemplate(dataIndex, dataIndexPass, addFields);

                        fieldCount++;
                    }
                    else {
                        alert('yes');
                    }                    
                });
        
                function fieldTemplate(dataIndex, dataIndexPass, addFields) {
                    const title = document.getElementById(dataIndexPass);
                    var capitalizedTitle = title.value.charAt(0).toUpperCase() + title.value.slice(1);
                    var formattedTitle = title.value.replace(/\s+/g, '').toLowerCase();
                    
                    var div = $("<div class='mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12 remove-div'>");
                    var label = '<label for="label'+ formattedTitle + '" class="form-label">' + capitalizedTitle + '</label>';
                    var input = '<div class="input-group"><span class="input-group-text">RM</span><input type="number" name="input' + formattedTitle + '" class="form-control @error("input' + formattedTitle + '") is-invalid @enderror" id="label'+ formattedTitle + '" value="{{ old("input' + formattedTitle + '", $basicDetails["house_phone_number"] ?? "") }}"><a class="remove-field"><i class="bi bi-trash3-fill" style="color:#C21B17"></i></a></div>';
                    
                    div.append(label, input);
                    $(addFields).append(div);

                   // Add event listener to the trash icon for removal
                    div.find('.remove-field').on('click', function() {
                        $(this).closest('.remove-div').remove();
                        fieldCount--;
                        $('#addFieldsBtn').show();
                    });
                }
            }
            
            document.getElementById('addFormsBtn').addEventListener('click', function() {
                if (i <= 4) {
                    addForm();
                }
            });
            
            document.getElementById('addFieldsBtn').addEventListener('click', function() {
                addFields();
            });

            if(existingPolicy) {
                let existingPoliciesCount = Object.keys(existingPolicy).length;

                // Add forms based on the existing policies count on page load
                for (let count = 1; count < existingPoliciesCount; count++) {
                    addForm();
                }
            }

            // Show companyOthers when 'Others' is selected from dropdown
            var companySelect = document.getElementById('companySelect');

            if(existingPolicy && existingPolicy['policy_1'] && existingPolicy['policy_1']['company_others'] != null || companySelect.value === 'Others') {
                companyOthers.style.display = 'block';
            }

            companySelect.addEventListener('change', function() {
                var selectedOption = this.value;
                var companyOthers = document.getElementById('companyOthers');
                var input = document.getElementById('companyOthersText');
                // var storedCompanyValue = companyValueInput.value;
                if (selectedOption === 'Others') {
                    companyOthers.style.display = 'block';
                }
                else {
                    companyOthers.style.display = 'none';
                    input.value = '';
                }
            });
        });
    }
}