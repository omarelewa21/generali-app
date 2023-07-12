import './bootstrap';

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
