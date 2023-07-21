import './bootstrap';
import ('./delivery');

// Get the height of any devices, and set a padding bottom to prevent footer overlay over the main content
$(document).ready(function() {
  function setMainContentPadding() {
      const windowWidth = $(window).width();
      const footerHeight = $(".footer").outerHeight();
      const mainContentPadding = footerHeight + 50; // Adding 50 pixels
      $(".main-content").css("padding-bottom", mainContentPadding + "px");
  }

  setMainContentPadding();

  $(window).resize(function() {
      setMainContentPadding();
  });
});

$(document).ready(function () {
  // Get the current URL path
  var currentPath = window.location.pathname;
  
  // Find all the timeline items and iterate through them
  $('.timeline-item').each(function () {
      // Get the URL of the timeline item
      var itemURL = $(this).find('a').attr('href');

      // Create a URL object to parse the full URL
      var urlObject = new URL(itemURL);

      // Get only the path from the URL object
      var itemPath = urlObject.pathname;

      // Check if the current URL matches the timeline item URL
      if (itemPath === currentPath) {
          // Add the checkmark (you can use a class or a style here)
          $(this).addClass('active'); // Add your CSS class here
      }
  });
});

// Close the Offcanvas sidebar when the modal is opened.
// Get the "EXIT" button element
const exitButton = document.querySelector('.btn-exit');

// Add a click event listener to the "EXIT" button
exitButton.addEventListener('click', function() {
    // Find the offcanvas element and remove the 'show' class
    const offcanvasElement = document.querySelector('.offcanvas');
    const offcanvasElementBackdrop = document.querySelector('.offcanvas-backdrop');
    offcanvasElement.classList.remove('show');
    offcanvasElementBackdrop.classList.remove('show');
});


// Logics to choose avatar gender and skin color
document.addEventListener('DOMContentLoaded', function() {
    var genderMaleBtn = document.getElementById('gendermale');
    var genderFemaleBtn = document.getElementById('genderfemale');
    var genderColorBtns = document.querySelectorAll('.gendercolor');
    var changeImageElement = document.querySelector('.changeImage');

    genderMaleBtn.addEventListener('click', function() {
        changeImage('male', null);
    });

    genderFemaleBtn.addEventListener('click', function() {
        changeImage('female', null);
    });

    genderColorBtns.forEach(function(button) {
        button.addEventListener('click', function() {
            var color = button.getAttribute('data-color');
            console.log(color);
            changeImage(null, color);
        });
    });

    function changeImage(gender, color) {
        var formData = new FormData();
        if (gender !== null) {
            formData.append('gender', gender);
        }
        if (color !== null) {
            formData.append('color', color);
        }

        fetch(routeChangeImage, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            }
        })
        .then(response => response.json())
        .then(data => {
            changeImageElement.src = data.image;
        })
        .catch(error => {
            console.error('Error:', error);
        });
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

// Show the selected groups based on the dropdown selected
document.addEventListener('DOMContentLoaded', function() {
    var idTypeSelect = document.getElementById('idType');
    var newicgroup = document.getElementById('newicgroup');
    var passportgroup = document.getElementById('passportgroup');
    var birthcertgroup = document.getElementById('birthcertgroup');
    var policegroup = document.getElementById('policegroup');
    var registrationgroup = document.getElementById('registrationgroup');
  
    // Retrieve the selected option from local storage
    var selectedOption = localStorage.getItem('selectedOption');
    if (selectedOption) {
      idTypeSelect.value = selectedOption;
      showSelectedGroup(selectedOption);
    }
  
    // Add change event listener to the select element
    idTypeSelect.addEventListener('change', function() {
      var selectedOption = this.value;
      showSelectedGroup(selectedOption);
  
      // Store the selected option in local storage
      localStorage.setItem('selectedOption', selectedOption);
    });
  
    // Function to show the selected group
    function showSelectedGroup(selectedOption) {
      // Hide all groups
      newicgroup.style.display = 'none';
      passportgroup.style.display = 'none';
      passportgroup.removeAttribute('required');
      birthcertgroup.style.display = 'none';
      policegroup.style.display = 'none';
      registrationgroup.style.display = 'none';
  
      // Show the relevant group based on the selected option
      if (selectedOption === 'New IC') {
        newicgroup.style.display = 'block';
      } else if (selectedOption === 'Passport') {
        passportgroup.style.display = 'block';
        passportgroup.setAttribute('required', 'required');
      } else if (selectedOption === 'Birth Certificate') {
        birthcertgroup.style.display = 'block';
      } else if (selectedOption === 'Police / Army') {
        policegroup.style.display = 'block';
      } else if (selectedOption === 'Registration') {
        registrationgroup.style.display = 'block';
      }
    }
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
  const selectedYear = parseInt(yearFieldExtract.value);

  if (isNaN(selectedDay) || isNaN(selectedMonth) || isNaN(selectedYear)) {
    ageField.textContent = 'Invalid date';
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