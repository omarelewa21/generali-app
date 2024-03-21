const specificPageURLs = [
    'marital-status',
    'family-dependent',
    '/family-dependent/details',
    'assets',
];

const currentURL = window.location.href;
const queryString = window.location.search;

if (specificPageURLs.some(url => currentURL.endsWith(url) || currentURL.endsWith(queryString))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    document.addEventListener('DOMContentLoaded', function() {
        
        // Set the avatar images in index
        var spouseMarriedImages = [
            {
                src: "/images/avatar-general/spouse-male.png",
                width: "auto",
                height: "100%",
                alt: "Spouse",
                class: "appended-image",
                style: ""
            },
            {
                src: "/images/avatar-general/spouse-female.png",
                width: "auto",
                height: "90%",
                alt: "Spouse",
                class: "position-absolute appended-image",
                style: "bottom: 10px;right: -80px;"
            },
        ];

        var spouseWidowedImages = [
            {
                src: "/images/avatar-general/spouse-male.png",
                width: "auto",
                height: "100%",
                alt: "Spouse",
                class: "",
                style: "opacity: 0.5;"
            },
            {
                src: "/images/avatar-general/spouse-female.png",
                width: "auto",
                height: "90%",
                alt: "Spouse",
                class: "position-absolute",
                style: "bottom: 10px;right: -80px; opacity: 0.5;"
            },
        ];

        var spouseImages = [
            {
                src: "/images/avatar-general/spouse-male.png",
                width: "auto",
                height: "100%",
                alt: "Spouse",
                class: "position-absolute appended-image",
                style: "bottom: 0;right: -120px;"
            },
            {
                src: "/images/avatar-general/spouse-female.png",
                width: "auto",
                height: "90%",
                alt: "Spouse",
                class: "position-absolute appended-image",
                style: "bottom: 10px;right: -80px;"
            },
        ];

        var childrenImages = [
            {
                src: "/images/avatar-general/son.png",
                width: "auto",
                height: "75%",
                alt: "Children",
                class: "position-absolute",
                style: "bottom:0"
            },
            {
                src: "/images/avatar-general/daughter.png",
                width: "auto",
                height: "60%",
                alt: "Children",
                class: "position-absolute end-0",
                style: "bottom:0;z-index: 1"
            }
        ];

        var parentImages = [
            {
                src: "/images/avatar-general/grandma.png",
                width: "auto",
                height: "90%",
                alt: "Grandmother",
                class: "position-absolute bottom-0",
                style: "right: -80px;z-index: 1"
            },
            {
                src: "/images/avatar-general/grandpa.png",
                width: "auto",
                height: "100%",
                alt: "Grandfather",
                class: "pb-4",
                style: ""
            }
        ];

        var carImages = [
            {
                src: "/images/assets/car-vector.png",
                width: "auto",
                height: "100%",
                alt: "Car",
                class: "position-absolute car",
                style: "bottom:150px;right:-200px;z-index:2"
            }
        ];

        var scooterImages = [
            {
                src: "/images/assets/scooter-vector.png",
                width: "auto",
                height: "100%",
                alt: "Scooter",
                class: "position-absolute scooter",
                style: "bottom:150px;left:0;z-index:2"
            }
        ];

        var houseImages = [
            {
                src: "/images/assets/house-vector.png",
                width: "auto",
                height: "100%",
                alt: "House",
                class: "house"
            }
        ];

        var bungalowImages = [
            {
                src: "/images/assets/bungalow-vector.png",
                width: "auto",
                height: "100%",
                alt: "Bungalow",
                class: "bungalow"
            }
        ];

        var condoImages = [
            {
                src: "/images/assets/condo-vector.png",
                width: "auto",
                height: "100%",
                alt: "Bungalow",
                class: "condo"
            }
        ];

        // Set the quantity of clicks allowed
        var spouseImageIndex = 0;
        var spouseWidowedImageIndex = 0;
        var carImageIndex = 0;
        var scooterImageIndex = 0;
        var houseImageIndex = 0;
        var bungalowImageIndex = 0;
        var condoImageIndex = 0;

        // Pre-select the options if sessions exist
        if (path == '/marital-status') {
            // Set the spouseImageIndex based on gender
            var gender;
            if (gender_session) {
                gender = gender_session;
            } else {
                gender = 'Male'; // Set your default gender here
            }
            
            var spouseImageIndex = 0; // Default to male avatar
            var spouseWidowedImageIndex = 0;
            
            if (gender === 'Male') {
                spouseImageIndex = 1; // Index for female avatar
                spouseWidowedImageIndex = 1;
            }

            var preselect = document.getElementById('maritalStatusButtonInput');
        
            if (preselect.value == 'Married') {
                var newImage = '<img src="' + spouseMarriedImages[spouseImageIndex].src + '" width="' + spouseMarriedImages[spouseImageIndex].width + '" height="' + spouseMarriedImages[spouseImageIndex].height + '" alt="' + spouseMarriedImages[spouseImageIndex].alt + '" class="' + spouseMarriedImages[spouseImageIndex].class + '" style="' + spouseMarriedImages[spouseImageIndex].style + '">';
                var newDiv = '<div id="lottie-female-animation"></div>';
                $(".imageContainerMarried").append(newDiv);
                var lottieAnimationPath = customer_details.avatar.image;
                const animationFemale = lottie.loadAnimation({
                    container: document.getElementById('lottie-female-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: lottieAnimationPath
                });
            }
            // else if (preselect.value == 'widowed') {
            //     var newImage = '<img src="' + spouseWidowedImages[spouseWidowedImageIndex].src + '" width="' + spouseWidowedImages[spouseWidowedImageIndex].width + '" height="' + spouseWidowedImages[spouseWidowedImageIndex].height + '" alt="' + spouseWidowedImages[spouseWidowedImageIndex].alt + '" class="' + spouseWidowedImages[spouseWidowedImageIndex].class + '" style="' + spouseWidowedImages[spouseWidowedImageIndex].style + '">';
            //     $(".imageContainerMarried").append(newImage);
            // }
            else {
                $(".imageContainerMarried").empty;
            }
        }
        else if (path == '/family-dependent' || path == '/family-dependent/details') {
            
            // Set the spouseImageIndex based on gender
            var gender;
            if (gender_session) {
                gender = gender_session;
            } else {
                gender = 'Male'; // Set your default gender here
            }
            
            var spouseImageIndex = 0; // Default to male avatar
            var spouseWidowedImageIndex = 0;
            
            if (gender === 'Male') {
                spouseImageIndex = 1; // Index for female avatar
                spouseWidowedImageIndex = 1;
            }

            var familyDependentInputValue = document.getElementById('familyDependentButtonInput').value;
            var $imageContainer = $(".imageContainerSpouse");

            if (familyDependentInputValue.trim() !== 'null') {
                
                var familyDependent = JSON.parse(familyDependentInputValue);
                if (spouse_session === true) {
                    var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
                    var newDiv = '<div id="lottie-female-animation"></div>';
                    $imageContainer.append(newDiv);

                    var lottieAnimationPath = customer_details.avatar.image;
                    const animationFemale = lottie.loadAnimation({
                        container: document.getElementById('lottie-female-animation'),
                        renderer: 'svg', 
                        loop: true,
                        autoplay: true,
                        path: lottieAnimationPath
                    });
                }

                if (familyDependent.children_data) {
                    
                    var childImages = []; // An array to store child image HTML

                    // Loop through familyDependent.children_data
                    var numberOfChildren = Object.keys(familyDependent.children_data).length;

                    for (var i = 0; i < numberOfChildren; i++) {
                        var childIndex = i % childrenImages.length; // Get the index within childrenImages
                        var childImage = '<img src="' + childrenImages[childIndex].src + '" width="' + childrenImages[childIndex].width + '" height="' + childrenImages[childIndex].height + '" alt="' + childrenImages[childIndex].alt + '" class="' + childrenImages[childIndex].class + '" style="' + childrenImages[childIndex].style + '">';
                        childImages.push(childImage);
                    }
                    
                    // Append child images to the container
                    $(".imageContainerChildren").append(childImages.join(''));

                    var newButton = '<div class="popover position-absolute py-1" style="top:10%;right:inherit"> x' + numberOfChildren + '</div>';
                    $(".imageContainerChildren").append(newButton);

                    // Move the avatar closer based on selections
                    var $imageContainerSpouse = document.querySelector('.imageContainerSpouse');
                    var $imageContainerSpouseDom = $('.imageContainerSpouse');
                    var $appended = $imageContainerSpouseDom.find('.appended-image');

                    if ($appended.length == '0') {
                        var $childrenContainer = document.querySelector('.imageContainerChildren');
                        var imageElement = $childrenContainer.querySelector('.end-0');
                        if (imageElement) {
                            imageElement.className = 'position-absolute start-0';
                        }
                        $imageContainerSpouse.append($childrenContainer);
                    }
                }

                if (familyDependent.parents_data) {

                    if (familyDependent.parents_data.hasOwnProperty("father") && familyDependent.parents_data.hasOwnProperty("mother")) {
                        var parentImage1 = '<img src="' + parentImages[0].src + '" width="' + parentImages[0].width + '" height="' + parentImages[0].height + '" alt="' + parentImages[0].alt + '" class="' + parentImages[0].class + '" style="' + parentImages[0].style + '">';
                        var parentImage2 = '<img src="' + parentImages[1].src + '" width="' + parentImages[1].width + '" height="' + parentImages[1].height + '" alt="' + parentImages[1].alt + '" class="' + parentImages[1].class + '" style="' + parentImages[1].style + '">';
                        
                        $(".imageContainerParents").append(parentImage1);
                        $(".imageContainerParents").append(parentImage2);

                    } else if (familyDependent.parents_data.hasOwnProperty("father")) {
                        if (!parentImages[1].class.includes('position-absolute')) {
                            parentImages[1].class = 'pb-4 position-absolute';
                        }
                        if (!parentImages[1].style.includes('right:-80px')) {
                            parentImages[1].style = 'right:-80px';
                        }
                        var parentImage = '<img src="' + parentImages[1].src + '" width="' + parentImages[1].width + '" height="' + parentImages[1].height + '" alt="' + parentImages[1].alt + '" class="' + parentImages[1].class + '" style="' + parentImages[1].style + '">';
                        
                        $(".imageContainerParents").append(parentImage);

                    } else if (familyDependent.parents_data.hasOwnProperty("mother")) {
                        var parentImage = '<img src="' + parentImages[0].src + '" width="' + parentImages[0].width + '" height="' + parentImages[0].height + '" alt="' + parentImages[0].alt + '" class="' + parentImages[0].class + '" style="' + parentImages[0].style + '">';
                        $(".imageContainerParents").append(parentImage);
                    }
                }
            } else {
                
            }
        }
        else if (path == '/assets') {
            var preselect = document.getElementById('assetsButtonInput').value;

            if (preselect.trim() !== "") {
                var assets = JSON.parse(preselect);

                if (assets && assets.car === true) {
                    var newImage = '<img src="' + carImages[carImageIndex].src + '" width="' + carImages[carImageIndex].width + '" height="' + carImages[carImageIndex].height + '" alt="' + carImages[carImageIndex].alt + '" class="' + carImages[carImageIndex].class + '" style="' + carImages[carImageIndex].style + '">';
                    $(".imageContainerCar").append(newImage);
                }

                if (assets && assets.scooter === true) {
                    var newImage = '<img src="' + scooterImages[scooterImageIndex].src + '" width="' + scooterImages[scooterImageIndex].width + '" height="' + scooterImages[scooterImageIndex].height + '" alt="' + scooterImages[scooterImageIndex].alt + '" class="' + scooterImages[scooterImageIndex].class + '" style="' + scooterImages[scooterImageIndex].style + '">';
                    $(".imageContainerCar").append(newImage);
                }

                if (assets && assets.house === true) {
                    var newImage = '<img src="' + houseImages[houseImageIndex].src + '" width="' + houseImages[houseImageIndex].width + '" height="' + houseImages[houseImageIndex].height + '" alt="' + houseImages[houseImageIndex].alt + '" class="' + houseImages[houseImageIndex].class + '" style="' + houseImages[houseImageIndex].style + '">';
                    $(".imageContainerHouse").append(newImage);
                }

                if (assets && assets.bungalow === true) {
                    var newImage = '<img src="' + bungalowImages[bungalowImageIndex].src + '" width="' + bungalowImages[bungalowImageIndex].width + '" height="' + bungalowImages[bungalowImageIndex].height + '" alt="' + bungalowImages[bungalowImageIndex].alt + '" class="' + bungalowImages[bungalowImageIndex].class + '" style="' + bungalowImages[bungalowImageIndex].style + '">';
                    $(".imageContainerHouse").append(newImage);
                }

                if (assets && assets.condo === true) {
                    var newImage = '<img src="' + condoImages[condoImageIndex].src + '" width="' + condoImages[condoImageIndex].width + '" height="' + condoImages[condoImageIndex].height + '" alt="' + condoImages[condoImageIndex].alt + '" class="' + condoImages[condoImageIndex].class + '" style="' + condoImages[condoImageIndex].style + '">';
                    $(".imageContainerHouse").append(newImage);
                }

                var $imageContainer = $(".imageContainerHouse");
                if ($imageContainer.find("img").length == 2) {
                    if ($imageContainer.find("img.condo").length == 1) {
                        $imageContainer.find("img.bungalow").css("position", "absolute");
                        $imageContainer.find("img.bungalow").css("bottom", "0");
                        $imageContainer.find("img.bungalow").css("left", "0");
                        $imageContainer.find("img.bungalow").css("width", "550px");
                        $imageContainer.find("img.bungalow").css("height", "auto");
                    }
                    else {
                        $imageContainer.find("img.house").css("position", "absolute");
                        $imageContainer.find("img.house").css("bottom", "0");
                        $imageContainer.find("img.house").css("right", "0");
                        $imageContainer.find("img.house").css("width", "450px");
                        $imageContainer.find("img.house").css("height", "auto");
                    }
                }
                else if ($imageContainer.find("img").length == 3) {
                    $imageContainer.find("img.house").css("position", "absolute");
                    $imageContainer.find("img.house").css("bottom", "0");
                    $imageContainer.find("img.house").css("right", "0");
                    $imageContainer.find("img.house").css("width", "450px");
                    $imageContainer.find("img.house").css("height", "auto");
                    $imageContainer.find("img.house").css("z-index", "2");
                    $imageContainer.find("img.bungalow").css("position", "absolute");
                    $imageContainer.find("img.bungalow").css("bottom", "0");
                    $imageContainer.find("img.bungalow").css("left", "0");
                    $imageContainer.find("img.bungalow").css("width", "550px");
                    $imageContainer.find("img.bungalow").css("height", "auto");
                    $imageContainer.find("img.bungalow").css("z-index", "1");
                }
            }

            function clearAvatar() {
                var $imageContainerCar = $(".imageContainerCar");
                var $imageContainerHouse = $(".imageContainerHouse");
                var buttonbgElements = document.querySelectorAll(".button-bg");

                $imageContainerCar.empty();
                $imageContainerHouse.empty();
    
                selectedAssets['car'] = false;
                selectedAssets['house'] = false;
                selectedAssets['scooter'] = false;
                selectedAssets['bungalow'] = false;
                selectedAssets['condo'] = false;

                buttonbgElements.forEach(function(element) {
                    element.classList.remove('selected');
                    element.removeAttribute('data-required');
                });
    
                if (assetsButtonInput.value == '') {
                    assetsButtonInput.value = JSON.stringify(selectedAssets);
                }
                else {
                    assetsButtonInput.value = JSON.stringify({
                        ...JSON.parse(assetsButtonInput.value),
                        car: selectedAssets.car,
                        house: selectedAssets.house,
                        scooter: selectedAssets.scooter,
                        bungalow: selectedAssets.bungalow,
                        condo: selectedAssets.condo
                    });
                }
            }
    
            document.getElementById('refresh').addEventListener('click', function(event) {
                event.preventDefault();
                clearAvatar();
            });

            var selectedAssets = { ...selectedAssets, ...sessionData };

            for (const key in selectedAssets) {
                if (selectedAssets.hasOwnProperty(key) && selectedAssets[key] !== true) {
                    selectedAssets[key] = false;
                }
            }
        }

        // Do the logics for button clicks
        // Married selection
        $("#marriedButton").on("click", function () {
            var $imageContainer = $(".imageContainerMarried");
            var $existingImage = $imageContainer.find("img");

            // If an existing image is found, update its attributes
            if ($existingImage.length) {
                $imageContainer.empty();
                var newImage = '<img src="' + spouseMarriedImages[spouseImageIndex].src + '" width="' + spouseMarriedImages[spouseImageIndex].width + '" height="' + spouseMarriedImages[spouseImageIndex].height + '" alt="' + spouseMarriedImages[spouseImageIndex].alt + '" class="' + spouseMarriedImages[spouseImageIndex].class + '" style="' + spouseMarriedImages[spouseImageIndex].style + '">';
                var newDiv = '<div id="lottie-female-animation"></div>';
                $imageContainer.append(newDiv);
                
                var lottieAnimationPath = customer_details.avatar.image;
                const animationFemale = lottie.loadAnimation({
                    container: document.getElementById('lottie-female-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: lottieAnimationPath
                });
            } else {
                // If no existing image, create a new one and append it
                var newImage = '<img src="' + spouseMarriedImages[spouseImageIndex].src + '" width="' + spouseMarriedImages[spouseImageIndex].width + '" height="' + spouseMarriedImages[spouseImageIndex].height + '" alt="' + spouseMarriedImages[spouseImageIndex].alt + '" class="' + spouseMarriedImages[spouseImageIndex].class + '" style="' + spouseMarriedImages[spouseImageIndex].style + '">';
                var newDiv = '<div id="lottie-female-animation"></div>';
                $imageContainer.append(newDiv);
                
                var lottieAnimationPath = customer_details.avatar.image;
                const animationFemale = lottie.loadAnimation({
                    container: document.getElementById('lottie-female-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: lottieAnimationPath
                });
            }
        });

        // Widowed selection
        $("#widowedButton").on("click", function () {
            var $imageContainer = $(".imageContainerMarried");
            $imageContainer.empty();
            // var $existingImage = $imageContainer.find("img");

            // // If an existing image is found, update its attributes
            // if ($existingImage.length) {
            //     $imageContainer.empty();
            //     var newImage = '<img src="' + spouseWidowedImages[spouseWidowedImageIndex].src + '" width="' + spouseWidowedImages[spouseWidowedImageIndex].width + '" height="' + spouseWidowedImages[spouseWidowedImageIndex].height + '" alt="' + spouseWidowedImages[spouseWidowedImageIndex].alt + '" class="' + spouseWidowedImages[spouseWidowedImageIndex].class + '" style="' + spouseWidowedImages[spouseWidowedImageIndex].style + '">';
            //     $imageContainer.append(newImage);
            // } else {
            //     // If no existing image, create a new one and append it
            //     var newImage = '<img src="' + spouseWidowedImages[spouseWidowedImageIndex].src + '" width="' + spouseWidowedImages[spouseWidowedImageIndex].width + '" height="' + spouseWidowedImages[spouseWidowedImageIndex].height + '" alt="' + spouseWidowedImages[spouseWidowedImageIndex].alt + '" class="' + spouseWidowedImages[spouseWidowedImageIndex].class + '" style="' + spouseWidowedImages[spouseWidowedImageIndex].style + '">';
            //     $imageContainer.append(newImage);
            // }
        });

        // Single selection
        $("#singleButton").on("click", function () {
            var $imageContainer = $(".imageContainerMarried");
            $imageContainer.empty();
        });

        // Divorced selection
        $("#divorcedButton").on("click", function () {
            var $imageContainer = $(".imageContainerMarried");
            $imageContainer.empty();
        });

        const clickedAvatars = {
            spouse: false,
            children: false,
            parents: false,
        };

        var familyDependentButtonInput = document.getElementById('familyDependentButtonInput');

        // Children selection
        $(".btn-exit-children").on("click", function () {
            // Get the selected value from the dropdown
            var selectedValue = parseInt($("#childrenSelect").val());
            
            // Clear the existing images
            $(".imageContainerChildren").empty();
        
            var selectedImages = [];
        
            if (selectedValue >= 1) {
                selectedImages.push(childrenImages[0]);
            }
        
            if (selectedValue >= 2) {
                selectedImages.push(childrenImages[1]);
            }
        
            selectedImages.forEach(function (image) {
                var newImage = '<img src="' + image.src + '" width="' + image.width + '" height="' + image.height + '" alt="' + image.alt + '" class="' + image.class + '" style="' + image.style + '">';
                $(".imageContainerChildren").append(newImage);
            });
            
            if (selectedValue) {
                var newButton = '<div class="popover position-absolute py-1" style="top:10%;right:inherit"> x' + selectedValue + '</div>';
                $(".imageContainerChildren").append(newButton);
            }

            // Move the avatar closer based on selections
            var $imageContainerSpouse = document.querySelector('.imageContainerSpouse');
            var $imageContainerSpouseDom = $('.imageContainerSpouse');
            var $appended = $imageContainerSpouseDom.find('.appended-image');
            
            if ($appended.length == '0') {
                var $childrenContainer = document.querySelector('.imageContainerChildren');
                var imageElement = $childrenContainer.querySelector('.end-0');
                if (imageElement) {
                    imageElement.className = 'position-absolute start-0';
                }
                $imageContainerSpouse.append($childrenContainer);
            }

            const childrenSelect = document.getElementById('childrenSelect');
            const selectedChildren = childrenSelect.value;
            
            if (selectedChildren > 0) {
                clickedAvatars['children'] = true;

                // Create a new array under 'children_data'
                clickedAvatars['children_data'] = {};

                for (let i = 1; i <= selectedChildren; i++) {
                    const childKey = `child_${i}`;
                    
                    const dataAvatarval = {
                        relation: `Child ${i}`
                    };
                    clickedAvatars['children_data'][childKey] = dataAvatarval;
                }
            }
            else if(selectedChildren == 'noChildren') {
                clickedAvatars['children'] = false;
                delete clickedAvatars['children_data'];
            }

            if (familyDependentButtonInput.value == '') {
                familyDependentButtonInput.value = JSON.stringify(clickedAvatars);
            }
            else {
                familyDependentButtonInput.value = JSON.stringify({
                    ...JSON.parse(familyDependentButtonInput.value),
                    children: clickedAvatars.children,
                    children_data: clickedAvatars.children_data
                });
            }

            // Customise the urlInput field according to selection
            var urlInput = document.getElementById('urlInput');
            var familyDependent = JSON.parse(familyDependentButtonInput.value);

            if (familyDependent.spouse === true) {
                urlInput.value = 'family.dependent.details';
                
            }
            else {
                if ((familyDependent.children === undefined || familyDependent.children === false) && (familyDependent.parents === undefined || familyDependent.parents === false) && (familyDependent.siblings === undefined || familyDependent.siblings === false)) {
                    urlInput.value = 'assets';
                }
                else {
                    urlInput.value = 'family.dependent.details';
                }
            }
        });

        // Parents selection
        $(".btn-exit-parent").on("click", function () {
            // Get the selected value from the dropdown
            var selectedValue = $("#parentsSelect").val();

            // Clear the existing images
            $(".imageContainerParents").empty();

            if (selectedValue === "father" || selectedValue === "mother" || selectedValue === "both") {
                clickedAvatars['parents'] = true;

                var selectedImages = [];

                // Create a new array under 'parents_data'
                clickedAvatars['parents_data'] = {};

                if (selectedValue === "father") {
                    selectedImages.push(parentImages[1]);
                    const parentKey = 'father';
                    const dataAvatarval = {
                        relation: 'Father'
                    };
                    clickedAvatars['parents_data'][parentKey] = dataAvatarval;
                }
                else if (selectedValue === "mother") {
                    selectedImages.push(parentImages[0]);
                    const parentKey = 'mother';
                    const dataAvatarval = {
                        relation: 'Mother'
                    };
                    clickedAvatars['parents_data'][parentKey] = dataAvatarval;
                }
                else if (selectedValue === "both") {
                    selectedImages.push(parentImages[1]);
                    selectedImages.push(parentImages[0]);
                    const parentKey1 = 'father';
                    const parentKey2 = 'mother';

                    const fatherdata = {
                        relation: 'Father'
                    };
                    const motherData = {
                        relation: 'Mother'
                    };

                    clickedAvatars['parents_data'][parentKey1] = fatherdata;
                    clickedAvatars['parents_data'][parentKey2] = motherData;
                }

                // Move the avatar closer based on selections
                if (selectedImages.length === 1 && selectedImages[0].alt === 'Grandfather') {
                    if (!selectedImages[0].class.includes('position-absolute')) {
                        selectedImages[0].class += ' position-absolute';
                    }
                    if (!selectedImages[0].style.includes('right:-80px')) {
                        selectedImages[0].style = 'right:-80px';
                    }
                }
                else if (selectedImages.length === 2) {
                    if (!selectedImages[0].class.includes('pb-4')) {
                        selectedImages[0].class += 'pb-4';
                    }
                    selectedImages[0].style = '';
                }
                
                selectedImages.forEach(function (image) {
                    var newImage = '<img src="' + image.src + '" width="' + image.width + '" height="' + image.height + '" alt="' + image.alt + '" class="' + image.class + '" style="' + image.style + '">';
                    $(".imageContainerParents").append(newImage);
                });
            }
            else if(selectedValue == 'noParents') {
                clickedAvatars['parents'] = false;
                delete clickedAvatars['parents_data'];
            }

            if (familyDependentButtonInput.value == '') {
                familyDependentButtonInput.value = JSON.stringify(clickedAvatars);
            }
            else {
                familyDependentButtonInput.value = JSON.stringify({
                    ...JSON.parse(familyDependentButtonInput.value),
                    parents: clickedAvatars.parents,
                    parents_data: clickedAvatars.parents_data
                });
            }

            // Customise the urlInput field according to selection
            var urlInput = document.getElementById('urlInput');
            var familyDependent = JSON.parse(familyDependentButtonInput.value);

            if (familyDependent.spouse === true) {
                urlInput.value = 'family.dependent.details';
                
            }
            else {
                if ((familyDependent.children === undefined || familyDependent.children === false) && (familyDependent.parents === undefined || familyDependent.parents === false) && (familyDependent.siblings === undefined || familyDependent.siblings === false)) {
                    urlInput.value = 'assets';
                }
                else {
                    urlInput.value = 'family.dependent.details';
                }
            }
        });

        // Siblings selection
        $("#siblingButton").on("click", function () {

            var isSelected = this.closest('.button-bg').classList.contains('selected');

            if (isSelected == true) {
                clickedAvatars['siblings'] = true;

                // Create a new array under 'children_data'
                clickedAvatars['siblings_data'] = {
                    relation: 'Sibling'
                };
            }
            else {
                clickedAvatars['siblings'] = false;
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');
            }

            if (familyDependentButtonInput.value === 'null') {
                familyDependentButtonInput.value = JSON.stringify(clickedAvatars);
            }
            else {
                familyDependentButtonInput.value = JSON.stringify({
                    ...JSON.parse(familyDependentButtonInput.value), 
                    siblings: clickedAvatars.siblings,
                    siblings_data: clickedAvatars.siblings_data
                });
            }

            // Customise the urlInput field according to selection
            var urlInput = document.getElementById('urlInput');
            var familyDependent = JSON.parse(familyDependentButtonInput.value);

            if (familyDependent.spouse === true) {
                urlInput.value = 'family.dependent.details';
                
            }
            else {
                if ((familyDependent.children === undefined || familyDependent.children === false) && (familyDependent.parents === undefined || familyDependent.parents === false) && (familyDependent.siblings === undefined || familyDependent.siblings === false)) {
                    urlInput.value = 'assets';
                }
                else {
                    urlInput.value = 'family.dependent.details';
                }
            }
        });

        // var selectedAssets = { ...selectedAssets, ...sessionData };

        // for (const key in selectedAssets) {
        //     if (selectedAssets.hasOwnProperty(key) && selectedAssets[key] !== true) {
        //         selectedAssets[key] = false;
        //     }
        // }

        // Car Selection
        $("#carButton").on("click", function () {
            var $imageContainer = $(".imageContainerCar");

            if ($imageContainer.find("img.car").length > 0) {
                // If an image exists, remove it
                $imageContainer.find("img.car").remove();
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');

                selectedAssets['car'] = false;
            } else {
                // If no image exists, create a new one and append it
                var newImage = '<img src="' + carImages[carImageIndex].src + '" width="' + carImages[carImageIndex].width + '" height="' + carImages[carImageIndex].height + '" alt="' + carImages[carImageIndex].alt + '" class="' + carImages[carImageIndex].class + '" style="' + carImages[carImageIndex].style + '">';
                $(".imageContainerCar").append(newImage);

                selectedAssets['car'] = true;
            }

            if (assetsButtonInput.value == '') {
                assetsButtonInput.value = JSON.stringify(selectedAssets);
            }
            else {
                assetsButtonInput.value = JSON.stringify({
                    ...JSON.parse(assetsButtonInput.value), 
                    car: selectedAssets.car 
                });
            }
            console.log(selectedAssets);
        });

        // Scooter Selection
        $("#scooterButton").on("click", function () {
            var $imageContainer = $(".imageContainerCar");

            if ($imageContainer.find("img.scooter").length > 0) {
                // If an image exists, remove it
                $imageContainer.find("img.scooter").remove();
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');

                selectedAssets['scooter'] = false;
            } else {
                // If no image exists, create a new one and append it
                var newImage = '<img src="' + scooterImages[scooterImageIndex].src + '" width="' + scooterImages[scooterImageIndex].width + '" height="' + scooterImages[scooterImageIndex].height + '" alt="' + scooterImages[scooterImageIndex].alt + '" class="' + scooterImages[scooterImageIndex].class + '" style="' + scooterImages[scooterImageIndex].style + '">';
                $(".imageContainerCar").append(newImage);

                selectedAssets['scooter'] = true;
            }

            if (assetsButtonInput.value == '') {
                assetsButtonInput.value = JSON.stringify(selectedAssets);
            }
            else {
                assetsButtonInput.value = JSON.stringify({
                    ...JSON.parse(assetsButtonInput.value), 
                    scooter: selectedAssets.scooter 
                });
            }
        });

        // House Selection
        $("#houseButton").on("click", function () {
            var $imageContainer = $(".imageContainerHouse");

            if ($imageContainer.find("img.house").length > 0) {
                // If an image exists, remove it
                $imageContainer.find("img.house").remove();
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');

                selectedAssets['house'] = false;
            } else {
                // If no image exists, create a new one and append it
                var newImage = '<img src="' + houseImages[houseImageIndex].src + '" width="' + houseImages[houseImageIndex].width + '" height="' + houseImages[houseImageIndex].height + '" alt="' + houseImages[houseImageIndex].alt + '" class="' + houseImages[houseImageIndex].class + '" style="' + houseImages[houseImageIndex].style + '">';
                $(".imageContainerHouse").append(newImage);

                if ($imageContainer.find("img").length > 1) {
                    $imageContainer.find("img.house").css("position", "absolute");
                    $imageContainer.find("img.house").css("bottom", "0");
                    $imageContainer.find("img.house").css("right", "0");
                    $imageContainer.find("img.house").css("width", "450px");
                    $imageContainer.find("img.house").css("height", "auto");
                    $imageContainer.find("img.house").css("z-index", "2");
                }

                if ($imageContainer.find("img.house").length > 0) {
                    selectedAssets['house'] = true;
                }

                if ($imageContainer.find("img.bungalow").length > 0) {
                    selectedAssets['bungalow'] = true;
                }

                if ($imageContainer.find("img.condo").length > 0) {
                    selectedAssets['condo'] = true;
                }
                
                // selectedAssets['bungalow'] = false;
                // selectedAssets['condo'] = false;

                // $("#bungalowButton").closest('.button-bg').removeClass('selected');
                // $("#condoButton").closest('.button-bg').removeClass('selected');
            }

            if (assetsButtonInput.value == '') {
                assetsButtonInput.value = JSON.stringify(selectedAssets);
            }
            else {
                assetsButtonInput.value = JSON.stringify({
                    ...JSON.parse(assetsButtonInput.value), 
                    house: selectedAssets.house,
                    bungalow: selectedAssets.bungalow,
                    condo: selectedAssets.condo
                });
            } console.log(selectedAssets);
        });

        // Bungalow Selection
        $("#bungalowButton").on("click", function () {
            var $imageContainer = $(".imageContainerHouse");

            if ($imageContainer.find("img.bungalow").length > 0) {
                // If an image exists, remove it
                $imageContainer.find("img.bungalow").remove();
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');

                selectedAssets['bungalow'] = false;

                if ($imageContainer.find("img").length == 1) {
                    $imageContainer.find("img.house").css("position", "relative");
                    $imageContainer.find("img.house").css("bottom", "inherit");
                    $imageContainer.find("img.house").css("right", "inherit");
                    $imageContainer.find("img.house").css("width", "inherit");
                    $imageContainer.find("img.house").css("height", "100%");
                }
            } else {
                // If no image exists, create a new one and append it
                var newImage = '<img src="' + bungalowImages[bungalowImageIndex].src + '" width="' + bungalowImages[bungalowImageIndex].width + '" height="' + bungalowImages[bungalowImageIndex].height + '" alt="' + bungalowImages[bungalowImageIndex].alt + '" class="' + bungalowImages[bungalowImageIndex].class + '" style="' + bungalowImages[bungalowImageIndex].style + '">';
                $(".imageContainerHouse").append(newImage);
                
                if ($imageContainer.find("img").length == 2) {
                    if ($imageContainer.find("img.condo").length == 1) {
                        $imageContainer.find("img.bungalow").css("position", "absolute");
                        $imageContainer.find("img.bungalow").css("bottom", "0");
                        $imageContainer.find("img.bungalow").css("left", "0");
                        $imageContainer.find("img.bungalow").css("width", "550px");
                        $imageContainer.find("img.bungalow").css("height", "auto");
                    }
                    else {
                        $imageContainer.find("img.house").css("position", "absolute");
                        $imageContainer.find("img.house").css("bottom", "0");
                        $imageContainer.find("img.house").css("right", "0");
                        $imageContainer.find("img.house").css("width", "450px");
                        $imageContainer.find("img.house").css("height", "auto");
                    }
                }
                else if ($imageContainer.find("img").length == 3) {
                    $imageContainer.find("img.house").css("position", "absolute");
                    $imageContainer.find("img.house").css("bottom", "0");
                    $imageContainer.find("img.house").css("right", "0");
                    $imageContainer.find("img.house").css("width", "450px");
                    $imageContainer.find("img.house").css("height", "auto");
                    $imageContainer.find("img.house").css("z-index", "2");
                    $imageContainer.find("img.bungalow").css("position", "absolute");
                    $imageContainer.find("img.bungalow").css("bottom", "0");
                    $imageContainer.find("img.bungalow").css("left", "0");
                    $imageContainer.find("img.bungalow").css("width", "550px");
                    $imageContainer.find("img.bungalow").css("height", "auto");
                    $imageContainer.find("img.bungalow").css("z-index", "1");
                }

                if ($imageContainer.find("img.house").length > 0) {
                    selectedAssets['house'] = true;
                }

                if ($imageContainer.find("img.bungalow").length > 0) {
                    selectedAssets['bungalow'] = true;
                }

                if ($imageContainer.find("img.condo").length > 0) {
                    selectedAssets['condo'] = true;
                }

                // selectedAssets['bungalow'] = true;
                // selectedAssets['house'] = false;
                // selectedAssets['condo'] = false;

                // $("#houseButton").closest('.button-bg').removeClass('selected');
                // $("#condoButton").closest('.button-bg').removeClass('selected');
            }

            if (assetsButtonInput.value == '') {
                assetsButtonInput.value = JSON.stringify(selectedAssets);
            }
            else {
                assetsButtonInput.value = JSON.stringify({
                    ...JSON.parse(assetsButtonInput.value), 
                    bungalow: selectedAssets.bungalow,
                    house: selectedAssets.house,
                    condo: selectedAssets.condo
                });
            } console.log(selectedAssets);
        });

        // Condo Selection
        $("#condoButton").on("click", function () {
            var $imageContainer = $(".imageContainerHouse");

            if ($imageContainer.find("img.condo").length > 0) {
                // If an image exists, remove it
                $imageContainer.find("img.condo").remove();
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');

                selectedAssets['condo'] = false;
                if ($imageContainer.find("img").length == 1) {
                    $imageContainer.find("img.house").css("position", "relative");
                    $imageContainer.find("img.house").css("bottom", "inherit");
                    $imageContainer.find("img.house").css("right", "inherit");
                    $imageContainer.find("img.house").css("width", "inherit");
                    $imageContainer.find("img.house").css("height", "100%");
                    $imageContainer.find("img.bungalow").css("position", "relative");
                    $imageContainer.find("img.bungalow").css("bottom", "inherit");
                    $imageContainer.find("img.bungalow").css("right", "inherit");
                    $imageContainer.find("img.bungalow").css("width", "inherit");
                    $imageContainer.find("img.bungalow").css("height", "100%");
                } else if ($imageContainer.find("img").length == 2) {
                    $imageContainer.find("img.bungalow").css("position", "relative");
                    $imageContainer.find("img.bungalow").css("bottom", "inherit");
                    $imageContainer.find("img.bungalow").css("right", "inherit");
                    $imageContainer.find("img.bungalow").css("width", "inherit");
                    $imageContainer.find("img.bungalow").css("height", "100%");
                }
            } else {
                // If no image exists, create a new one and append it
                var newImage = '<img src="' + condoImages[condoImageIndex].src + '" width="' + condoImages[condoImageIndex].width + '" height="' + condoImages[condoImageIndex].height + '" alt="' + condoImages[condoImageIndex].alt + '" class="' + condoImages[condoImageIndex].class + '" style="' + condoImages[condoImageIndex].style + '">';
                $(".imageContainerHouse").append(newImage);

                if ($imageContainer.find("img").length == 2) {
                    $imageContainer.find("img.house").css("position", "absolute");
                    $imageContainer.find("img.house").css("bottom", "0");
                    $imageContainer.find("img.house").css("right", "0");
                    $imageContainer.find("img.house").css("width", "450px");
                    $imageContainer.find("img.house").css("height", "auto");
                    $imageContainer.find("img.bungalow").css("position", "absolute");
                    $imageContainer.find("img.bungalow").css("bottom", "0");
                    $imageContainer.find("img.bungalow").css("left", "0");
                    $imageContainer.find("img.bungalow").css("width", "550px");
                    $imageContainer.find("img.bungalow").css("height", "auto");
                }
                else if ($imageContainer.find("img").length == 3) {
                    $imageContainer.find("img.house").css("position", "absolute");
                    $imageContainer.find("img.house").css("bottom", "0");
                    $imageContainer.find("img.house").css("right", "0");
                    $imageContainer.find("img.house").css("width", "450px");
                    $imageContainer.find("img.house").css("height", "auto");
                    $imageContainer.find("img.house").css("z-index", "2");
                    $imageContainer.find("img.bungalow").css("position", "absolute");
                    $imageContainer.find("img.bungalow").css("bottom", "0");
                    $imageContainer.find("img.bungalow").css("left", "0");
                    $imageContainer.find("img.bungalow").css("width", "550px");
                    $imageContainer.find("img.bungalow").css("height", "auto");
                    $imageContainer.find("img.bungalow").css("z-index", "1");
                }

                if ($imageContainer.find("img.house").length > 0) {
                    selectedAssets['house'] = true;
                }

                if ($imageContainer.find("img.bungalow").length > 0) {
                    selectedAssets['bungalow'] = true;
                }

                if ($imageContainer.find("img.condo").length > 0) {
                    selectedAssets['condo'] = true;
                }

                // selectedAssets['condo'] = true;
                // selectedAssets['house'] = false;
                // selectedAssets['bungalow'] = false;

                // $("#houseButton").closest('.button-bg').removeClass('selected');
                // $("#bungalowButton").closest('.button-bg').removeClass('selected');
            }

            if (assetsButtonInput.value == '') {
                assetsButtonInput.value = JSON.stringify(selectedAssets);
            }
            else {
                assetsButtonInput.value = JSON.stringify({
                    ...JSON.parse(assetsButtonInput.value),
                    bungalow: selectedAssets.bungalow,
                    condo: selectedAssets.condo,
                    house: selectedAssets.house
                });
            } console.log(selectedAssets);
        });

        // Others Selection
        $(".btn-exit-assetsOthers").on("click", function () {
            var selectedValue = $("#otherAssetsInput").val();

            // Create a new array under 'others_data'
            selectedAssets['others_data'] = {};

            selectedAssets['others'] = true;
            selectedAssets['others_data'] = selectedValue;

            if (assetsButtonInput.value == '') {
                assetsButtonInput.value = JSON.stringify(selectedAssets);
            }
            else {
                assetsButtonInput.value = JSON.stringify({
                    ...JSON.parse(assetsButtonInput.value),
                    others: selectedAssets.others,
                    others_data: selectedAssets.others_data,
                });
            }
        });
    });
}