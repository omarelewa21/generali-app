// Array of specific page URLs where the script should run
const specificPageURLs = [
    'avatar',
    'identity-details',
    'marital-status',
    'family-dependent',
    'family-dependent/details',
    'assets'
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    if (path == '/avatar') {
        document.addEventListener('DOMContentLoaded', function() {
            var genderSelection = document.getElementById('genderSelection');
            var genderImage = document.getElementById('genderImage');
            const links = document.querySelectorAll('.skin-tone');
    
            // Declare variable
            let selectedGenderValue;
    
            const svgFileNames = ['male', 'male-semi-formal', 'male-formal', 'male-casual', 'male-semi-casual']; // Add more SVG file names as needed
            let currentIndex = 0;
            let currentIndexMale = 0;
            let currentIndexFemale = 0;
    
            const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
    
            dataAvatarButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default behavior of the button click
    
                    // Remove 'selected' attribute from all buttons
                    dataAvatarButtons.forEach(btn => btn.removeAttribute('data-required'));
    
                    // Add 'selected' attribute to the clicked button
                    this.setAttribute('data-required', 'selected');
    
                    // Store the selected data-avatar value
                    selectedGenderValue = this.getAttribute('data-avatar');
    
                    // Reset currentIndex based on selected gender
                    if (selectedGenderValue === 'Female') {
                        currentIndexFemale = 0;
                    } else {
                        currentIndexMale = 0;
                    }
    
                    // Set the correct index based on selected gender
                    currentIndex = selectedGenderValue === 'Female' ? currentIndexFemale : currentIndexMale;
                    updateAvatarSource(currentIndex);
                });
            });
    
            // Function to update the avatar image source based on index
            function updateAvatarSource(currentIndex) {
                // Get the data-color attribute value
                const dataColor = document.getElementById('skinSelection').value;
                const filePrefix = selectedGenderValue === 'Female' ? 'fe' : '';
    
                const newImage = "/images/avatar-general/skin-tone/gender-" + filePrefix + svgFileNames[currentIndex] + "-" + dataColor + ".json";
    
                var container = document.getElementById('lottie-animation');
    
                // Remove all child elements (including the SVG) from the container
                while (container.firstChild) {
                    container.removeChild(container.firstChild);
                }
    
                // Load the new Lottie animation
                const animationGender = lottie.loadAnimation({
                    container: document.getElementById('lottie-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: newImage
                });
    
                // Update the hidden input field value with the selected avatar
                genderImage.value = newImage;
                genderSelection.value = selectedGenderValue;
            }
    
            // Add Click Event Listeners to Links
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior
    
                    // Check the value of genderSelection on page load
                    if (genderSelection.value === 'Female') {
                        selectedGenderValue = 'Female';
                    } else if (genderSelection.value === 'Male') {
                        selectedGenderValue = 'Male';
                    } else {
                        selectedGenderValue = 'Male';
                    }
    
                    // Get the data-color attribute value
                    const dataColor = this.getAttribute('data-color');
                    const filePrefix = selectedGenderValue === 'Female' ? 'fe' : '';
    
                    const newImage = "/images/avatar-general/skin-tone/gender-" + filePrefix + svgFileNames[currentIndex] + "-" + dataColor + ".json";
    
                    var container = document.getElementById('lottie-animation');
    
                    // Remove all child elements (including the SVG) from the container
                    while (container.firstChild) {
                        container.removeChild(container.firstChild);
                    }
    
                    const animationGender = lottie.loadAnimation({
                        container: document.getElementById('lottie-animation'),
                        renderer: 'svg', 
                        loop: true,
                        autoplay: true,
                        path: newImage
                    });
    
                    // Update the hidden input field value with the selected avatar
                    genderImage.value = newImage;
                    document.getElementById('skinSelection').value = dataColor;
                });
            });
    
            // Gender Page
            if (gender_session) {
                const animationGender = lottie.loadAnimation({
                    container: document.getElementById('lottie-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: '/images/avatar-general/gender-' + gender_session + '.json'
                });
            }
            else {
                const animationGender = lottie.loadAnimation({
                    container: document.getElementById('lottie-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: '/images/avatar-general/gender-male.json'
                });
            }
        });
    }

    if (path == '/identity-details' || path == '/marital-status' || path == '/family-dependent' || path == '/family-dependent/details' || path == '/assets') {
        if (avatar_session) {
            var container = document.getElementById('lottie-animation');
    
            // Remove all child elements (including the SVG) from the container
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }

            const animationGender = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg', 
                loop: true,
                autoplay: true,
                path: avatar_session
            });
            
            if (gender_session) {
                if (gender_session == 'Male') {
                    container.classList.add('male');
                }
                else if (gender_session == 'Female') {
                    container.classList.add('female');
                }
            }
        }
    }
}

// Load the animation using Lottie
// General
const animationFemale = lottie.loadAnimation({
    container: document.getElementById('lottie-female-animation'),
    renderer: 'svg', 
    loop: true,
    autoplay: true,
    path: '/images/avatar-general/spouse-female.json'
});

// Main Homepage
const animationWelcomeFemale = lottie.loadAnimation({
    container: document.getElementById('lottie-welcome-female-animation'),
    renderer: 'svg', 
    loop: true,
    autoplay: true,
    path: '/images/welcome-page/female-avatar.json'
});

const animationContainersFemale = document.querySelectorAll('.lottie-welcome-female-animation');
animationContainersFemale.forEach(container => {
    lottie.loadAnimation({
        container: container,
        renderer: 'svg', 
        loop: true,
        autoplay: true,
        path: '/images/welcome-page/female-avatar.json'
    });
});

const animationWelcomeMale = lottie.loadAnimation({
    container: document.getElementById('lottie-welcome-male-animation'),
    renderer: 'svg', 
    loop: true,
    autoplay: true,
    path: '/images/welcome-page/male-avatar.json'
});

const animationContainersMale = document.querySelectorAll('.lottie-welcome-male-animation');
animationContainersMale.forEach(container => {
    lottie.loadAnimation({
        container: container,
        renderer: 'svg', 
        loop: true,
        autoplay: true,
        path: '/images/welcome-page/male-avatar.json'
    });
});

// Avatar Homepage
const animationAvatarMale = lottie.loadAnimation({
    container: document.getElementById('lottie-avatar-male-animation'),
    renderer: 'svg', 
    loop: true,
    autoplay: true,
    path: '/images/avatar-welcome/male-avatar.json'
});

const animationAvatarFemale = lottie.loadAnimation({
    container: document.getElementById('lottie-avatar-female-animation'),
    renderer: 'svg', 
    loop: true,
    autoplay: true,
    path: '/images/avatar-welcome/female-avatar.json'
});