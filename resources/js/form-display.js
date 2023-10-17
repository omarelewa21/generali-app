// Array of specific page URLs where the script should run
const specificPageURLs = [
    'identity-details',
    'family-dependant-details'
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

                    const yearField = document.getElementById('year');
                    const idNumberField = document.getElementById('idNumber');
                    const hiddenField = document.getElementById('dateOfBirth');
                    
                    if (sessionData && sessionData.identity_details && sessionData.identity_details.dob !== '') {
                        hiddenField.value = sessionData.identity_details.dob;
                    }
                    else {
                        hiddenField.value = '';
                    }

                    idNumberField.addEventListener('input', function() {
                        const idNumber = idNumberField.value;
            
                        // Extract the first 6 digits as the date, month, and year
                        const yearDigits = idNumber.substring(0, 2);
                        const monthDigits = idNumber.substring(2, 4);
                        const dateDigits = idNumber.substring(4, 6);
                        
                        // Find the matching option in the year dropdown based on the last 2 digits of ID
                        const matchingOption = Array.from(yearField.options).find(option => {
                            return option.value.substring(2, 4) === yearDigits;
                        });

                        // Set the selected option in the year dropdown
                        if (matchingOption) {
                            matchingOption.selected = true;
                        }

                        // Set the extracted values in the date of birth fields
                        hiddenField.value = dateDigits + '-' + monthDigits + '-' + matchingOption.value;
                    });

                    // Disable day, month, and year select options
                    document.getElementById('day').disabled = true;
                    document.getElementById('month').disabled = true;
                    document.getElementById('year').disabled = true;

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
        
        // Listen for changes in the ID Number field
        idNumberField.addEventListener('input', function() {
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

    if (path == '/family-dependant-details') {
        var spouse = customer_details.family_details.dependant.spouse;
        if (spouse === true) {
            // Show the selected groups based on the dropdown selected
            document.addEventListener('DOMContentLoaded', function() {
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
                    } else if (selectedOption === 'Passport') {
                        passportgroup.style.display = 'block';
                        spouseIdNumber.value = '';
                        spouseBirthCert.value = '';
                        spousePoliceNumber.value = '';
                        spouseRegistrationNumber.value = '';
                    } else if (selectedOption === 'Birth Certificate') {
                        birthcertgroup.style.display = 'block';
                        spouseIdNumber.value = '';
                        spousePassportNumber.value = '';
                        spousePoliceNumber.value = '';
                        spouseRegistrationNumber.value = '';
                    } else if (selectedOption === 'Police / Army') {
                        policegroup.style.display = 'block';
                        spouseIdNumber.value = '';
                        spousePassportNumber.value = '';
                        spouseBirthCert.value = '';
                        spouseRegistrationNumber.value = '';
                    } else if (selectedOption === 'Registration') {
                        registrationgroup.style.display = 'block';
                        spouseIdNumber.value = '';
                        spousePassportNumber.value = '';
                        spouseBirthCert.value = '';
                        spousePoliceNumber.value = '';
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

            // Listen for changes in the ID Number field
            idNumberField.addEventListener('input', function() {
                const idNumber = idNumberField.value;

                // Extract the first 6 digits as the date, month, and year
                const yearDigits = idNumber.substring(0, 2);
                const monthDigits = idNumber.substring(2, 4);
                const dateDigits = idNumber.substring(4, 6);

                // Set the extracted values in the date of birth fields
                dayField.value = dateDigits;
                monthField.value = monthDigits;
                yearField.value = yearDigits;

                // Trigger the change event on the year field to recalculate the age
                const event = new Event('change');
                yearField.dispatchEvent(event);
            });

            // Extract the first 6 numbers from ID Number and auto-select the date of birth dropdown
            const idNumberFieldExtract = document.getElementById('spouseIdNumber');
            const dayFieldExtract = document.getElementById('spouseday');
            const monthFieldExtract = document.getElementById('spousemonth');
            const yearFieldExtract = document.getElementById('spouseyear');

            // Listen for changes in the ID Number field
            idNumberFieldExtract.addEventListener('input', function() {
                const idNumber = idNumberFieldExtract.value;

                // Extract the first 6 digits as the date, month, and year
                const yearDigits = idNumber.substring(0, 2);
                const monthDigits = idNumber.substring(2, 4);
                const dateDigits = idNumber.substring(4, 6);

                // Set the extracted values in the date of birth fields
                dayFieldExtract.value = dateDigits;
                monthFieldExtract.value = monthDigits;
                yearFieldExtract.value = yearDigits;
            });

            // Function to calculate age
            function calculateAge() {
                const selectedDay = parseInt(dayFieldExtract.value);
                const selectedMonth = parseInt(monthFieldExtract.value);
                const selectedYearOption = yearFieldExtract.options[yearFieldExtract.selectedIndex];
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
            dayFieldExtract.addEventListener('change', calculateAge);
            monthFieldExtract.addEventListener('change', calculateAge);
            yearFieldExtract.addEventListener('change', calculateAge);
        }
    }
}