import intlTelInput from 'intl-tel-input';

const specificPageURLs = [
    'basic-details'
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    
    // Add phone code library
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.querySelector("#mobileNumberInput");
        const input_house = document.querySelector("#houseNumberInput");
        const errorMsg = document.querySelector("#errorMsg");
        const errorMsgHouse = document.querySelector("#errorMsgHouse");
        
        const iti = intlTelInput(input, {
            nationalMode: false,
            separateDialCode: true,
            hiddenInput: "full_number",
            initialCountry: "my",
            placeholderNumberType: "MOBILE",
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
        });

        const iti_house = intlTelInput(input_house, {
            nationalMode: false,
            separateDialCode: true,
            hiddenInput: "full_number_house",
            initialCountry: "my",
            placeholderNumberType: "FIXED_LINE",
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
        });

        const isValidNumber = iti.isPossibleNumber();
        const isValidNumberHouse = iti_house.isPossibleNumber();

        if (!isValidNumber) {
            if (errorMsg) {
                errorMsg.style.display = 'block'; // Show the error message
            }
        }

        if (!isValidNumberHouse) {
            if (errorMsgHouse) {
                errorMsgHouse.style.display = 'block'; // Show the error message
            }
        }

        var mobileNumberInput = document.getElementById('mobileNumberInput');
        var housePhoneNumberInput = document.getElementById('houseNumberInput');

        mobileNumberInput.addEventListener('blur', function() {
            validateMobileNumberField(mobileNumberInput);
        });

        housePhoneNumberInput.addEventListener('blur', function() {
            validateHousePhoneNumberField(housePhoneNumberInput);
        });

        function validateMobileNumberField(field) {
            if (field.value && isValidMobileNumber(field.value)) {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            }
        }

        function validateHousePhoneNumberField(field) {
            if (field.value && isValidHousePhoneNumber(field.value)) {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            }
        }

        function isValidMobileNumber(mobileNumber) {
            // Parse the phone number and check if it is valid
            var isValid = iti.isValidNumber();

            return isValid;
        }

        function isValidHousePhoneNumber(phoneNumber) {
            // Parse the phone number and check if it is valid
            var isValid = iti_house.isValidNumber();

            return isValid;
        }
    });
}
