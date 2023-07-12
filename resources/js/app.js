import './bootstrap';

// Validate the form if valid, show a success mark
const titleSelect = document.getElementById('titleSelect');
const firstNameInput = document.getElementById('firstNameInput');
const lastNameInput = document.getElementById('lastNameInput');

titleSelect.addEventListener('change', function () {
    titleSelect.classList.add('is-valid');
});

firstNameInput.addEventListener('change', function () {
    firstNameInput.classList.add('is-valid');
});

lastNameInput.addEventListener('change', function () {
    lastNameInput.classList.add('is-valid');
});

// Change the image of the avatar according to the gender selected
const maleButton = document.getElementById('gendermale');
const femaleButton = document.getElementById('genderfemale');
const image = document.querySelector('.changeImage');

// Add click event listeners to the buttons
maleButton.addEventListener('click', function() {
    image.src = "{{ asset('images/avatar/gender-male.svg') }}";
});

femaleButton.addEventListener('click', function() {
    image.src = "{{ asset('images/avatar/gender-female.svg') }}";
});
