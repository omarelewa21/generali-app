// Array of specific page URLs where the script should run
const specificPageURLs = [
    '/gender'
];

if (specificPageURLs.some(url => window.location.href.includes(url))) {
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
}