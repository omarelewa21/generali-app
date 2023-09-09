// Array of specific page URLs where the script should run
const specificPageURLs = [
    'family-dependant',
    'assets'
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {

    // Add event listener to each button with the 'data-required' attribute
    const dataButtons = document.querySelectorAll('[data-avatar]');

    dataButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the button click

            // Check if the clicked button is the Child(ren) button or Parent button
            if (this.getAttribute('data-avatar') === 'children' || this.getAttribute('data-avatar') === 'parents') {
                return; // Exit the function
            }

            // For Spouse and Sibling(s) buttons, toggle the 'selected' class
            if (this.getAttribute('data-avatar') === 'spouse' || this.getAttribute('data-avatar') === 'siblings') {
                this.setAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.toggle('selected'); // Toggle the 'selected' class
            }
        });
    });

    // Add event listener to the Confirm button in the children modal
    const childrenConfirmButton = document.querySelector('.btn-exit-children');
    const parentConfirmButton = document.querySelector('.btn-exit-parent');

    childrenConfirmButton.addEventListener('click', function() {
        const selectedChildButton = document.querySelector('[data-avatar="children"][data-required]');
        if (selectedChildButton) {
            selectedChildButton.closest('.button-bg').classList.add('selected');
            selectedChildButton.setAttribute('data-required', 'selected');
        }
    });

    parentConfirmButton.addEventListener('click', function() {
        const selectedParentButton = document.querySelector('[data-avatar="parents"][data-required]');
        if (selectedParentButton) {
            selectedParentButton.closest('.button-bg').classList.add('selected');
            selectedParentButton.setAttribute('data-required', 'selected');
        }
    });

    // Preselect the button on page load
    window.addEventListener('DOMContentLoaded', function() {
        const defaultButtons = document.querySelectorAll('.default');

        defaultButtons.forEach(defaultButton => {
            // Add the 'selected' class to the closest .button-bg div of each default button
            defaultButton.closest('.button-bg').classList.add('selected');
        });
    });
}