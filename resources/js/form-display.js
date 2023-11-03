// Array of specific page URLs where the script should run
const specificPageURLs = [
    'identity-details',
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

    if (path == '/family-dependant/details') {
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

    if (path == '/existing-policy') {
        document.addEventListener('DOMContentLoaded', function() {
            // Add more form
            let i = 2;
            var formContainer = document.getElementById('formContainer');
            var existingpolicy = document.getElementById('existing_policy');
            var formTemplate = document.getElementById('form');
            var modalTemplate = document.getElementById('addBenefits');

            document.getElementById('addFormsBtn').addEventListener('click', function() {
                if (i <= 4) {
                    // Clone the form template
                    var clonedForm = formTemplate.cloneNode(true);
                    var clonedModal = modalTemplate.cloneNode(true);

                    // Generate unique IDs for input fields within the cloned form
                    const originalForm = clonedForm.getAttribute('id');
                    const newForm = originalForm + i;
                    clonedForm.setAttribute('id', newForm);

                    // Get the title
                    const oriTitle = clonedForm.querySelector('h4');
                    const newTitle = 'Policy ' + i;
                    oriTitle.innerHTML = newTitle;

                    clonedForm.querySelectorAll('input').forEach(input => {
                        const originalId = input.getAttribute('id');
                        const newId = originalId + i;
                        input.setAttribute('name', newId);
                        input.value = '';
                    });

                    clonedForm.querySelectorAll('*').forEach(elementForm => {
                        if (elementForm.id) {
                            elementForm.id = elementForm.id + i;
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

                    // clonedModal.querySelectorAll('*').forEach(element => {
                    //     if (element.id) {
                    //         element.id = element.id + i;
                    //     }
                    // });
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
                }
            });

            // Add more fields
            var fieldCount = 0;
            $(document).on('click', '.btn-exit-benefits', function(event) {
                event.preventDefault();

                var addBenefitsInput;
                var addFields;
                var dataIndex = $(this).data('index');
                
                if (dataIndex == '1') {
                    addBenefitsInput = 'addBenefitsInput';
                    addFields = '#addFields';
                }
                else {
                    addBenefitsInput = 'addBenefitsInput' + dataIndex;
                    addFields = '#addFields' + dataIndex;
                }
                const title = document.getElementById(addBenefitsInput);
                var capitalizedTitle = title.value.charAt(0).toUpperCase() + title.value.slice(1);
                var formattedTitle = title.value.replace(/\s+/g, '').toLowerCase();

                // Create a new label element
                var div = $("<div class='mt-5 col-xxl-6 col-xl-6 col-lg-6 col-md-12 remove-div'>");
                var label = '<label for="benefitsInput" class="form-label">' + capitalizedTitle + '</label>';
                var alert = '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg><div class="text">There was a problem with your submission. You can only add up to 4 benefits.</div>';
    
                // Create a new text input element
                var input = '<div class="input-group"><span class="input-group-text">RM</span><input type="number" name="' + formattedTitle + '" class="form-control @error("' + formattedTitle + '") is-invalid @enderror" id="benefitsInput" value="{{ old("' + formattedTitle + '", $basicDetails["house_phone_number"] ?? "") }}"><a class="remove-field"><i class="bi bi-trash3-fill" style="color:#C21B17"></i></a></div>';

                // Append the label and text input to the container div
                if (fieldCount < 4) {
                    div.append(label, input);
                    $(addFields).append(div);
                    fieldCount++;

                    // if (fieldCount === 4) {
                    //     $('#addFieldsBtn').hide();
                    // }
                }
                else {
                    var alertDiv = $('.custom-alert');
                    alertDiv.append(alert);
                }

                // Add event listener to the trash icon for removal
                div.find('.remove-field').on('click', function() {
                    $(this).closest('.remove-div').remove();
                    fieldCount--;
                    $('#addFieldsBtn').show();
                });
            });
        });
    }
}