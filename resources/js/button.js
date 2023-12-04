// Array of specific page URLs where the script should run
const specificPageURLs = [
    'avatar',
    'marital-status'
];

if (specificPageURLs.some(url => window.location.href.includes(url))) {

    // Add event listener to each button with the 'data-required' attribute
    const dataButtons = document.querySelectorAll('[data-avatar]');
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    if (path == '/avatar') {
        dataButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click
    
                // Remove 'selected' attribute from all buttons
                dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                    
                // Add the 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');
                
                // Remove 'selected' class from all button-bg divs
                const buttonBgs = document.querySelectorAll('.button-bg');
                buttonBgs.forEach(bg => bg.classList.remove('selected'));
    
                // Add the 'selected' class to the closest button-bg div of the clicked button
                this.closest('.button-bg').classList.add('selected');
            });
        });
    }
    else if (path == '/marital-status') {
        dataButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click
        
                // Remove 'selected' attribute from all buttons
                dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                    
                // Add the 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');
                
                // Remove 'selected' class from all button-bg divs
                const buttonBgs = document.querySelectorAll('.button-bg');
                buttonBgs.forEach(bg => bg.classList.remove('selected'));
    
                // Add the 'selected' class to the closest button-bg div of the clicked button
                this.closest('.button-bg').classList.add('selected');
        
                // Get the selected data-avatar value
                const dataAvatar = this.getAttribute('data-avatar');
        
                // Update the hidden input field value with the selected avatar
                document.getElementById('maritalStatusButtonInput').value = dataAvatar;
            });
        });
    }

    // Preselect the button on page load
    window.addEventListener('DOMContentLoaded', function() {
        const defaultButton = document.querySelector('.default');
        if (defaultButton) {
            defaultButton.setAttribute('data-required', 'selected');
            defaultButton.closest('.button-bg').classList.add('selected');
        }
    });
}