// Array of specific page URLs where the script should run
const specificPageURLs = [
    'family-dependant'
];

if (specificPageURLs.some(url => window.location.href.includes(url))) {

    // Add event listener to each button with the 'data-required' attribute
    const dataButtons = document.querySelectorAll('[data-avatar]');

    dataButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the button click
            
            // Add the 'selected' attribute to the clicked button
            this.setAttribute('data-required', 'selected');
            
            // Add the 'selected' class to the closest .button-bg div of the clicked button
            this.closest('.button-bg').classList.add('selected');
        });
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