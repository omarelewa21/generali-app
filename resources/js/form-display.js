// Array of specific page URLs where the script should run
const specificPageURLs = [
    'identity-details',
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
                } else if (selectedOption === 'Passport') {
                    passportgroup.style.display = 'block';
                } else if (selectedOption === 'Birth Certificate') {
                    birthcertgroup.style.display = 'block';
                } else if (selectedOption === 'Police / Army') {
                    policegroup.style.display = 'block';
                } else if (selectedOption === 'Registration') {
                    registrationgroup.style.display = 'block';
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
            yearField.value = yearDigits;

            // Trigger the change event on the year field to recalculate the age
            const event = new Event('change');
            yearField.dispatchEvent(event);
        });

        // Extract the first 6 numbers from ID Number and auto-select the date of birth dropdown
        const idNumberFieldExtract = document.getElementById('idNumber');
        const dayFieldExtract = document.getElementById('day');
        const monthFieldExtract = document.getElementById('month');
        const yearFieldExtract = document.getElementById('year');

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