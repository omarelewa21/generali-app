// Array of specific page URLs where the script should run
const specificPageURLs = [
    'gender'
];

if (specificPageURLs.some(url => window.location.href.includes(url))) {
    // Add event listener to each button with the 'data-required' attribute
    const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
    dataAvatarButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the button click

            // Remove 'selected' attribute from all buttons
            dataAvatarButtons.forEach(btn => btn.removeAttribute('data-required'));
                
            // Add the 'selected' attribute to the clicked button
            this.setAttribute('data-required', 'selected');
            
            // Remove 'selected' class from all button-bg divs
            const buttonBgs = document.querySelectorAll('.button-bg');
            buttonBgs.forEach(bg => bg.classList.remove('selected'));

            // Add the 'selected' class to the closest button-bg div of the clicked button
            this.closest('.button-bg').classList.add('selected');
        });
    });

    // Preselect the 'Male' button on page load
    window.addEventListener('DOMContentLoaded', function() {
        const defaultButton = document.querySelector('.default'); 
        defaultButton.setAttribute('data-required', 'selected');
        defaultButton.closest('.button-bg').classList.add('selected');
    });
}