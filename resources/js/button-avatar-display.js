const specificPageURLs = [
    'marital-status',
    'family-dependent',
    'family-dependent/details',
    'assets',
];

const currentURL = window.location.href;
const queryString = window.location.search;

if (specificPageURLs.some(url => currentURL.endsWith(url) || currentURL.endsWith(queryString))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    document.addEventListener('DOMContentLoaded', function() {
        var carImages = [
            {
                src: "/images/assets/car-vector.webp",
                width: "auto",
                height: "100%",
                alt: "Car",
                class: "position-absolute car",
                style: "bottom:150px;right:-200px;z-index:2"
            }
        ];

        var scooterImages = [
            {
                src: "/images/assets/scooter-vector.webp",
                width: "auto",
                height: "100%",
                alt: "Scooter",
                class: "position-absolute scooter",
                style: "bottom:150px;left:0;z-index:2"
            }
        ];

        var houseImages = [
            {
                src: "/images/assets/house-vector.webp",
                width: "auto",
                height: "100%",
                alt: "House",
                class: "house"
            }
        ];

        var bungalowImages = [
            {
                src: "/images/assets/bungalow-vector.webp",
                width: "auto",
                height: "100%",
                alt: "Bungalow",
                class: "bungalow"
            }
        ];

        var condoImages = [
            {
                src: "/images/assets/condo-vector.webp",
                width: "auto",
                height: "100%",
                alt: "Bungalow",
                class: "condo"
            }
        ];

        var carImageIndex = 0;
        var scooterImageIndex = 0;
        var houseImageIndex = 0;
        var bungalowImageIndex = 0;
        var condoImageIndex = 0;

        // Pre-select the options if sessions exist
        if (path == '/marital-status') {

            var preselect = document.getElementById('maritalStatusButtonInput');
        
            if (preselect.value == 'Married') {
                if (gender_session) {
                    if (gender_session == 'Male') {
                        var newDiv = '<div id="lottie-female-animation" class="appended-image"></div>';
                        $(".imageContainerMarried").append(newDiv);
                        
                        const animationFemale = lottie.loadAnimation({
                            container: document.getElementById('lottie-female-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/spouse-female.json'
                        });
                    }
                    else if (gender_session == 'Female') {
                        var newDiv = '<div id="lottie-male-animation" class="appended-image"></div>';
                        $(".imageContainerMarried").append(newDiv);
                        
                        const animationMale = lottie.loadAnimation({
                            container: document.getElementById('lottie-male-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/spouse-male.json'
                        });
                    }
                }
            }
            else {
                $(".imageContainerMarried").empty;
            }
        }
        else if (path == '/family-dependent' || path == '/family-dependent/details') {
            var familyDependentInputValue = document.getElementById('familyDependentButtonInput').value;
            var $imageContainer = $(".imageContainerSpouse");

            if (familyDependentInputValue.trim() !== 'null') {
                
                var familyDependent = JSON.parse(familyDependentInputValue);
                if (spouse_session === true) {
                    if (gender_session) {
                        if (gender_session == 'Male') {
                            var newDiv = '<div id="lottie-female-animation" class="appended-image"></div>';
                            $(".imageContainerMarried").append(newDiv);
                            
                            const animationFemale = lottie.loadAnimation({
                                container: document.getElementById('lottie-female-animation'),
                                renderer: 'svg', 
                                loop: true,
                                autoplay: true,
                                path: '/images/avatar-general/spouse-female.json'
                            });
                        }
                        else if (gender_session == 'Female') {
                            var newDiv = '<div id="lottie-male-animation" class="appended-image"></div>';
                            $(".imageContainerMarried").append(newDiv);
                            
                            const animationMale = lottie.loadAnimation({
                                container: document.getElementById('lottie-male-animation'),
                                renderer: 'svg', 
                                loop: true,
                                autoplay: true,
                                path: '/images/avatar-general/spouse-male.json'
                            });
                        }
                    }
                }

                if (familyDependent.children_data) {
                    // Loop through familyDependent.children_data
                    var numberOfChildren = Object.keys(familyDependent.children_data).length;

                    if (numberOfChildren >= 1) {
                        var newDiv = '<div id="lottie-son-animation"></div>';
                        $(".imageContainerChildren").append(newDiv);
                        
                        const animationSon = lottie.loadAnimation({
                            container: document.getElementById('lottie-son-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/son.json'
                        });
                    }
                
                    if (numberOfChildren >= 2) {
                        var newDiv = '<div id="lottie-daughter-animation"></div>';
                        $(".imageContainerChildren").append(newDiv);
                        
                        const animationSon = lottie.loadAnimation({
                            container: document.getElementById('lottie-daughter-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/daughter.json'
                        });
                    }

                    var newButton = '<div class="popover position-absolute py-1" style="top:10%;right:inherit"> x' + numberOfChildren + '</div>';
                    $(".imageContainerChildren").append(newButton);

                    // Move the avatar closer based on selections
                    var $imageContainerSpouseDom = $('.imageContainerSpouse');
                    var $appended = $imageContainerSpouseDom.find('.appended-image');

                    if ($appended.length == '0') {
                        var $sonContainer = document.querySelector('#lottie-son-animation');
                        var $daughterContainer = document.querySelector('#lottie-daughter-animation');

                        if ($sonContainer) {
                            $sonContainer.style.position = 'absolute';
                            $sonContainer.style.right = '59%';
                            $sonContainer.style.width = 'auto';
                            $sonContainer.style.height = '100%';
                        }

                        if ($daughterContainer) {
                            $daughterContainer.style.right = '29%';
                        }
                    }
                }

                if (familyDependent.parents_data) {
                    if (familyDependent.parents_data.hasOwnProperty("father") && familyDependent.parents_data.hasOwnProperty("mother")) {
                        var newDivFather = '<div id="lottie-father-animation"></div>';
                        var newDivMother = '<div id="lottie-mother-animation"></div>';
                        $(".imageContainerParents").append(newDivFather);
                        $(".imageContainerParents").append(newDivMother);
                        
                        const animationFather = lottie.loadAnimation({
                            container: document.getElementById('lottie-father-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/father.json'
                        });
                        
                        const animationMother = lottie.loadAnimation({
                            container: document.getElementById('lottie-mother-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/mother.json'
                        });

                    } else if (familyDependent.parents_data.hasOwnProperty("father")) {
                        var newDiv = '<div id="lottie-father-animation"></div>';
                        $(".imageContainerParents").append(newDiv);
                        
                        const animationFather = lottie.loadAnimation({
                            container: document.getElementById('lottie-father-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/father.json'
                        });

                        var $fatherContainer = document.querySelector('#lottie-father-animation');
                        $fatherContainer.style.left = '33%';
                    } else if (familyDependent.parents_data.hasOwnProperty("mother")) {
                        var newDiv = '<div id="lottie-mother-animation"></div>';
                        $(".imageContainerParents").append(newDiv);
                        
                        const animationMother = lottie.loadAnimation({
                            container: document.getElementById('lottie-mother-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/mother.json'
                        });
                    }
                }
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
        $(document).on("click", "#marriedButton", function () {
            var $imageContainer = $(".imageContainerMarried");
            var $existingImage = $imageContainer.find("div");

            // If an existing image is found, update its attributes
            if ($existingImage.length) {
                $imageContainer.empty();
                
                if (gender_session) {
                    if (gender_session == 'Male') {
                        var newDiv = '<div id="lottie-female-animation" class="appended-image"></div>';
                        $imageContainer.append(newDiv);
                        
                        const animationFemale = lottie.loadAnimation({
                            container: document.getElementById('lottie-female-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/spouse-female.json'
                        });
                    }
                    else if (gender_session == 'Female') {
                        var newDiv = '<div id="lottie-male-animation" class="appended-image"></div>';
                        $imageContainer.append(newDiv);
                        
                        const animationMale = lottie.loadAnimation({
                            container: document.getElementById('lottie-male-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/spouse-male.json'
                        });
                    }
                }
            } else {                
                if (gender_session) {
                    if (gender_session == 'Male') {
                        var newDiv = '<div id="lottie-female-animation" class="appended-image"></div>';
                        $imageContainer.append(newDiv);
                        
                        const animationFemale = lottie.loadAnimation({
                            container: document.getElementById('lottie-female-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/spouse-female.json'
                        });
                    }
                    else if (gender_session == 'Female') {
                        var newDiv = '<div id="lottie-male-animation" class="appended-image"></div>';
                        $imageContainer.append(newDiv);
                        
                        const animationMale = lottie.loadAnimation({
                            container: document.getElementById('lottie-male-animation'),
                            renderer: 'svg', 
                            loop: true,
                            autoplay: true,
                            path: '/images/avatar-general/spouse-male.json'
                        });
                    }
                }
            }
        });

        // Widowed selection
        $(document).on("click", "#widowedButton", function () {
            var $imageContainer = $(".imageContainerMarried");
            $imageContainer.empty();
        });

        // Single selection
        $(document).on("click", "#singleButton", function () {
            var $imageContainer = $(".imageContainerMarried");
            $imageContainer.empty();
        });

        // Divorced selection
        $(document).on("click", "#divorcedButton", function () {
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
        
            if (selectedValue >= 1) {
                var newDiv = '<div id="lottie-son-animation"></div>';
                $(".imageContainerChildren").append(newDiv);
                
                const animationSon = lottie.loadAnimation({
                    container: document.getElementById('lottie-son-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: '/images/avatar-general/son.json'
                });
            }
        
            if (selectedValue >= 2) {
                var newDiv = '<div id="lottie-daughter-animation"></div>';
                $(".imageContainerChildren").append(newDiv);
                
                const animationSon = lottie.loadAnimation({
                    container: document.getElementById('lottie-daughter-animation'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: '/images/avatar-general/daughter.json'
                });
            }
            
            if (selectedValue) {
                var newButton = '<div class="popover position-absolute py-1" style="top:10%;right:inherit"> x' + selectedValue + '</div>';
                $(".imageContainerChildren").append(newButton);
            }

            // Move the avatar closer based on selections
            var $imageContainerSpouseDom = $('.imageContainerSpouse');
            var $appended = $imageContainerSpouseDom.find('.appended-image');

            if ($appended.length == '0') {
                var $sonContainer = document.querySelector('#lottie-son-animation');
                var $daughterContainer = document.querySelector('#lottie-daughter-animation');

                if ($sonContainer) {
                    $sonContainer.style.position = 'absolute';
                    $sonContainer.style.right = '59%';
                    $sonContainer.style.width = 'auto';
                    $sonContainer.style.height = '100%';
                }
                if ($daughterContainer) {
                    $daughterContainer.style.right = '29%';
                }
            }

            if (selectedValue > 0) {
                clickedAvatars['children'] = true;

                // Create a new array under 'children_data'
                clickedAvatars['children_data'] = {};

                for (let i = 1; i <= selectedValue; i++) {
                    const childKey = `child_${i}`;
                    
                    const dataAvatarval = {
                        relation: `Child ${i}`
                    };
                    clickedAvatars['children_data'][childKey] = dataAvatarval;
                }
            }
            else if(selectedValue == 'noChildren') {
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
                    var newDiv = '<div id="lottie-father-animation"></div>';
                    $(".imageContainerParents").append(newDiv);
                    
                    const animationFather = lottie.loadAnimation({
                        container: document.getElementById('lottie-father-animation'),
                        renderer: 'svg', 
                        loop: true,
                        autoplay: true,
                        path: '/images/avatar-general/father.json'
                    });

                    const parentKey = 'father';
                    const dataAvatarval = {
                        relation: 'Father'
                    };

                    clickedAvatars['parents_data'][parentKey] = dataAvatarval;

                    var $fatherContainer = document.querySelector('#lottie-father-animation');
                    $fatherContainer.style.left = '33%';
                }
                else if (selectedValue === "mother") {
                    // selectedImages.push(parentImages[0]);
                    var newDiv = '<div id="lottie-mother-animation"></div>';
                    $(".imageContainerParents").append(newDiv);
                    
                    const animationMother = lottie.loadAnimation({
                        container: document.getElementById('lottie-mother-animation'),
                        renderer: 'svg', 
                        loop: true,
                        autoplay: true,
                        path: '/images/avatar-general/mother.json'
                    });
                    const parentKey = 'mother';
                    const dataAvatarval = {
                        relation: 'Mother'
                    };
                    clickedAvatars['parents_data'][parentKey] = dataAvatarval;
                }
                else if (selectedValue === "both") {
                    var newDivMother = '<div id="lottie-mother-animation"></div>';
                    var newDivFather = '<div id="lottie-father-animation"></div>';
                    $(".imageContainerParents").append(newDivFather);
                    $(".imageContainerParents").append(newDivMother);
                    
                    const animationMother = lottie.loadAnimation({
                        container: document.getElementById('lottie-mother-animation'),
                        renderer: 'svg', 
                        loop: true,
                        autoplay: true,
                        path: '/images/avatar-general/mother.json'
                    });

                    const animationFather = lottie.loadAnimation({
                        container: document.getElementById('lottie-father-animation'),
                        renderer: 'svg', 
                        loop: true,
                        autoplay: true,
                        path: '/images/avatar-general/father.json'
                    });

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
        
        // Car Selection
        $(document).on("click", "#carButton", function () {
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
        });

        // Scooter Selection
        $(document).on("click", "#scooterButton", function () {
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
        $(document).on("click", "#houseButton", function () {
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
            }
        });

        // Bungalow Selection
        $(document).on("click", "#bungalowButton", function () {
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
            }
        });

        // Condo Selection
        $(document).on("click", "#condoButton", function () {
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
            }
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