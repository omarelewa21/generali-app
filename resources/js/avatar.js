// Array of specific page URLs where the script should run
const specificPageURLs = [
    'avatar'
];

if (specificPageURLs.some(url => window.location.href.includes(url))) {
    document.addEventListener('DOMContentLoaded', function() {
        var avatar = document.getElementById('avatar-clothes');
        var btnLeft = document.getElementById('avatar-left');
        var btnRight = document.getElementById('avatar-right');
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

                btnLeft.removeAttribute('disabled');
                btnRight.removeAttribute('disabled');

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
            const prefix = selectedGenderValue === 'Female' ? 'fe' : '';
            const newImageSrc = "/images/avatar-general/gender-" + prefix + svgFileNames[currentIndex] + ".svg";
            avatar.setAttribute('src', newImageSrc);

            // Update the hidden input field value with the selected avatar
            genderImage.value = avatar.getAttribute('src');
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

                const newImageSrc = "/images/avatar-general/skin-tone/gender-" + filePrefix + svgFileNames[currentIndex] + "-" + dataColor + ".svg";
                avatar.setAttribute('src', newImageSrc);

                // Update the hidden input field value with the selected avatar
                genderImage.value = avatar.getAttribute('src');
                document.getElementById('skinSelection').value = dataColor;
            });
        });

        btnLeft.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + svgFileNames.length) % svgFileNames.length;
            updateAvatarSource(currentIndex);
        });

        btnRight.addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % svgFileNames.length;
            updateAvatarSource(currentIndex);
        });
    });
}