import $ from 'jquery';

const specificPageURLs = [
    'marital-status',
    'family-dependant',
    'family-dependant-details',
    'assets',
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    $(function() {
        
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
                style: "bottom:0"
            }
        ];

        var parentImages = [
            {
                src: "/images/avatar-general/grandma.png",
                width: "auto",
                height: "90%",
                alt: "Parent",
                class: "position-absolute bottom-0 pb-2",
                style: "right: -80px;z-index: 1"
            },
            {
                src: "/images/avatar-general/grandpa.png",
                width: "auto",
                height: "100%",
                alt: "Parent",
                class: "pb-2",
                style: ""
            }
        ];

        var carImages = [
            {
                src: "/images/avatar-my-assets/car-vector.png",
                width: "auto",
                height: "100%",
                alt: "Car",
                class: "position-absolute",
                style: "bottom:150px;right:-200px"
            }
        ];

        var scooterImages = [
            {
                src: "/images/avatar-my-assets/scooter-vector.png",
                width: "auto",
                height: "100%",
                alt: "Scooter",
                class: "position-absolute",
                style: "bottom:150px;left:0"
            }
        ];

        var houseImages = [
            {
                src: "/images/avatar-my-assets/house-vector.png",
                width: "auto",
                height: "100%",
                alt: "House"
            }
        ];

        var bungalowImages = [
            {
                src: "/images/avatar-my-assets/bunglow-vector.png",
                width: "auto",
                height: "100%",
                alt: "Bungalow"
            }
        ];

        var condoImages = [
            {
                src: "/images/avatar-my-assets/condo-vector.png",
                width: "auto",
                height: "100%",
                alt: "Bungalow"
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
            var spouseGender = document.getElementById('spouseGenderInput');
            var spouseImageIndex = 0; // Default to male avatar
            var spouseWidowedImageIndex = 0;
            
            if (spouseGender.value === 'Female') {
                spouseImageIndex = 1; // Index for female avatar
                spouseWidowedImageIndex = 1;
            }

            var preselect = document.getElementById('maritalStatusButtonInput');

            if (preselect.value == 'married') {
                var newImage = '<img src="' + spouseMarriedImages[spouseImageIndex].src + '" width="' + spouseMarriedImages[spouseImageIndex].width + '" height="' + spouseMarriedImages[spouseImageIndex].height + '" alt="' + spouseMarriedImages[spouseImageIndex].alt + '" class="' + spouseMarriedImages[spouseImageIndex].class + '" style="' + spouseMarriedImages[spouseImageIndex].style + '">';
                $(".imageContainerMarried").append(newImage);
            }
            else if (preselect.value == 'widowed') {
                var newImage = '<img src="' + spouseWidowedImages[spouseWidowedImageIndex].src + '" width="' + spouseWidowedImages[spouseWidowedImageIndex].width + '" height="' + spouseWidowedImages[spouseWidowedImageIndex].height + '" alt="' + spouseWidowedImages[spouseWidowedImageIndex].alt + '" class="' + spouseWidowedImages[spouseWidowedImageIndex].class + '" style="' + spouseWidowedImages[spouseWidowedImageIndex].style + '">';
                $(".imageContainerMarried").append(newImage);
            }
            else {
                $(".imageContainerMarried").empty;
            }
        }
        else if (path == '/family-dependant' || path == '/family-dependant-details') {
            // Set the spouseImageIndex based on gender
            var spouseGender = document.getElementById('spouseGenderInput');
            var spouseImageIndex = 0; // Default to male avatar
            var spouseWidowedImageIndex = 0;
            
            if (spouseGender.value === 'Female') {
                spouseImageIndex = 1; // Index for female avatar
                spouseWidowedImageIndex = 1;
            }

            var familyDependantInputValue = document.getElementById('familyDependantButtonInput').value;
            var $imageContainer = $(".imageContainerSpouse");
            var $existingImage = $imageContainer.find("img.appended-image");

            if (familyDependantInputValue.trim() !== "") {
                var familyDependant = JSON.parse(familyDependantInputValue);

                if (familyDependant.spouse && familyDependant.spouse.status.includes("yes")) {
                    var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
                    $(".imageContainerSpouse").append(newImage);
                } else {
                    $existingImage.remove();
                }

                if (familyDependant.children && familyDependant.children.length > 0) {
                    var childImages = []; // An array to store child image HTML

                    // Loop through familyDependant.children
                    for (var i = 0; i < familyDependant.children.length; i++) {
                        var childIndex = i % childrenImages.length; // Get the index within childrenImages
                        var childImage = '<img src="' + childrenImages[childIndex].src + '" width="' + childrenImages[childIndex].width + '" height="' + childrenImages[childIndex].height + '" alt="' + childrenImages[childIndex].alt + '" class="' + childrenImages[childIndex].class + '" style="' + childrenImages[childIndex].style + '">';
                        childImages.push(childImage);
                    }
                    
                    // Append child images to the container
                    $(".imageContainerChildren").append(childImages.join(''));

                    var newButton = '<div class="popover position-absolute py-1" style="top:10%;right:20%"> x' + familyDependant.children.length + '</div>';
                    $(".imageContainerChildren").append(newButton);
                }

                if (familyDependant.parents && familyDependant.parents.length > 0) {

                    if (familyDependant.parents.includes("grandfather")) {
                        var parentImage = '<img src="' + parentImages[1].src + '" width="' + parentImages[1].width + '" height="' + parentImages[1].height + '" alt="' + parentImages[1].alt + '" class="' + parentImages[1].class + '" style="' + parentImages[1].style + '">';
                        $(".imageContainerParents").append(parentImage);
                    }

                    if (familyDependant.parents.includes("grandmother")) {
                        var parentImage = '<img src="' + parentImages[0].src + '" width="' + parentImages[0].width + '" height="' + parentImages[0].height + '" alt="' + parentImages[0].alt + '" class="' + parentImages[0].class + '" style="' + parentImages[0].style + '">';
                        $(".imageContainerParents").append(parentImage);
                    }
                }
            } else {
                
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
                $imageContainer.append(newImage);           
            } else {
                // If no existing image, create a new one and append it
                var newImage = '<img src="' + spouseMarriedImages[spouseImageIndex].src + '" width="' + spouseMarriedImages[spouseImageIndex].width + '" height="' + spouseMarriedImages[spouseImageIndex].height + '" alt="' + spouseMarriedImages[spouseImageIndex].alt + '" class="' + spouseMarriedImages[spouseImageIndex].class + '" style="' + spouseMarriedImages[spouseImageIndex].style + '">';
                $imageContainer.append(newImage);
            }
        });

        // Widowed selection
        $("#widowedButton").on("click", function () {
            var $imageContainer = $(".imageContainerMarried");
            var $existingImage = $imageContainer.find("img");

            // If an existing image is found, update its attributes
            if ($existingImage.length) {
                $imageContainer.empty();
                var newImage = '<img src="' + spouseWidowedImages[spouseWidowedImageIndex].src + '" width="' + spouseWidowedImages[spouseWidowedImageIndex].width + '" height="' + spouseWidowedImages[spouseWidowedImageIndex].height + '" alt="' + spouseWidowedImages[spouseWidowedImageIndex].alt + '" class="' + spouseWidowedImages[spouseWidowedImageIndex].class + '" style="' + spouseWidowedImages[spouseWidowedImageIndex].style + '">';
                $imageContainer.append(newImage);
            } else {
                // If no existing image, create a new one and append it
                var newImage = '<img src="' + spouseWidowedImages[spouseWidowedImageIndex].src + '" width="' + spouseWidowedImages[spouseWidowedImageIndex].width + '" height="' + spouseWidowedImages[spouseWidowedImageIndex].height + '" alt="' + spouseWidowedImages[spouseWidowedImageIndex].alt + '" class="' + spouseWidowedImages[spouseWidowedImageIndex].class + '" style="' + spouseWidowedImages[spouseWidowedImageIndex].style + '">';
                $imageContainer.append(newImage);
            }
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
            spouse: null,
            children: [],
            children_details: [],
            parents: [],
            parents_details: [],
        };

        var familyDependantButtonInput = document.getElementById('familyDependantButtonInput');

        // Spouse selection
        $("#spouseButton").on("click", function () {
            var $imageContainer = $(".imageContainerSpouse");

            // Check if an image already exists
            if ($imageContainer.find("img.appended-image").length > 0) {
                // If an image exists, remove it
                $imageContainer.find("img.appended-image").remove();
                this.removeAttribute('data-required', 'selected');
                this.closest('.button-bg').classList.remove('selected');
            } else {
                // If no image exists, create a new one and append it
                var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
                $imageContainer.append(newImage);
            }

            var isSelected = this.closest('.button-bg').classList.contains('selected');
            
            if (isSelected == true) {
                clickedAvatars['spouse'] = {
                    'status': 'yes',
                };
            }
            else if (isSelected == false){
                clickedAvatars['spouse'] = {
                    'status': 'no',
                };
            }
            
            if (familyDependantButtonInput.value == '') {
                familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
            }
            else {
                familyDependantButtonInput.value = JSON.stringify({
                    ...JSON.parse(familyDependantButtonInput.value), 
                    spouse: clickedAvatars.spouse 
                });
            }
        });

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
                var newButton = '<div class="popover position-absolute py-1" style="top:10%;right:20%"> x' + selectedValue + '</div>';
                $(".imageContainerChildren").append(newButton);
            }

            const childrenSelect = document.getElementById('childrenSelect');
            const selectedChildren = childrenSelect.value;

            // Clear the children array to start fresh
            clickedAvatars['children'] = [];

            if (selectedChildren > 0) {
                for (let i = 1; i <= selectedChildren; i++) {
                    const dataAvatarval = `child_${i}`;
                    clickedAvatars['children'].push(dataAvatarval);
                }
            }
            else if(selectedChildren == 'noChildren') {
                // Clear the children array
                clickedAvatars['children'] = [];
            }

            if (familyDependantButtonInput.value == '') {
                familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
            }
            else {
                familyDependantButtonInput.value = JSON.stringify({
                    ...JSON.parse(familyDependantButtonInput.value),
                    children: clickedAvatars.children
                });
            }
        });

        // Parents selection
        $(".btn-exit-parent").on("click", function () {
            // Get the selected value from the dropdown
            var selectedValue = $("#parentsSelect").val();

            // Clear the existing images
            $(".imageContainerParents").empty();

            if (selectedValue === "father" || selectedValue === "mother" || selectedValue === "both") {
                var selectedImages = [];
                clickedAvatars['parents'] = [];

                // if (selectedValue === "father" || selectedValue === "both") {
                //     selectedImages.push(parentImages[1]);
                // }

                // if (selectedValue === "mother" || selectedValue === "both") {
                //     selectedImages.push(parentImages[0]);
                // }

                if (selectedValue === "father") {
                    selectedImages.push(parentImages[1]);
                    clickedAvatars['parents'].push("grandfather");
                }
                else if (selectedValue === "mother") {
                    selectedImages.push(parentImages[0]);
                    clickedAvatars['parents'].push("grandmother");
                }
                else if (selectedValue === "both") {
                    selectedImages.push(parentImages[1]);
                    selectedImages.push(parentImages[0]);
                    clickedAvatars['parents'].push("grandfather", "grandmother");
                }

                selectedImages.forEach(function (image) {
                    var newImage = '<img src="' + image.src + '" width="' + image.width + '" height="' + image.height + '" alt="' + image.alt + '" class="' + image.class + '" style="' + image.style + '">';
                    $(".imageContainerParents").append(newImage);
                });
            }
            else if(selectedValue == 'noParents') {
                // Clear the parents array
                clickedAvatars['parents'] = [];
            }

            if (familyDependantButtonInput.value == '') {
                familyDependantButtonInput.value = JSON.stringify(clickedAvatars);
            }
            else {
                familyDependantButtonInput.value = JSON.stringify({
                    ...JSON.parse(familyDependantButtonInput.value),
                    parents: clickedAvatars.parents
                });
            }
        });

        // Car Selection
        $("#carButton").on("click", function () {
            if (carImageIndex < carImages.length) {
                var newImage = '<img src="' + carImages[carImageIndex].src + '" width="' + carImages[carImageIndex].width + '" height="' + carImages[carImageIndex].height + '" alt="' + carImages[carImageIndex].alt + '" class="' + carImages[carImageIndex].class + '" style="' + carImages[carImageIndex].style + '">';
                $(".imageContainerCar").append(newImage);
                carImageIndex++;

                if (carImageIndex >= carImages.length) {
                    $("#carButton").parent().removeClass("hover");
                }
            }
        });

        $("#scooterButton").on("click", function () {
            if (scooterImageIndex < scooterImages.length) {
                
                var newImage = '<img src="' + scooterImages[scooterImageIndex].src + '" width="' + scooterImages[scooterImageIndex].width + '" height="' + scooterImages[scooterImageIndex].height + '" alt="' + scooterImages[scooterImageIndex].alt + '" class="' + scooterImages[scooterImageIndex].class + '" style="' + scooterImages[scooterImageIndex].style + '">';
                $(".imageContainerCar").append(newImage);
                scooterImageIndex++;

                if (scooterImageIndex >= scooterImages.length) {
                    $("#scooterButton").parent().removeClass("hover");
                }
            }
        });

        $("#houseButton").on("click", function () {
            if (houseImageIndex < houseImages.length) {
                var newImage = '<img src="' + houseImages[houseImageIndex].src + '" width="' + houseImages[houseImageIndex].width + '" height="' + houseImages[houseImageIndex].height + '" alt="' + houseImages[houseImageIndex].alt + '" class="' + houseImages[houseImageIndex].class + '" style="' + houseImages[houseImageIndex].style + '">';
                $(".imageContainerHouse").html(newImage);
                houseImageIndex++;

                if (houseImageIndex >= houseImages.length) {
                    $("#houseButton").parent().removeClass("hover");
                }
            }
        });

        $("#bungalowButton").on("click", function () {
            if (bungalowImageIndex < bungalowImages.length) {
                var newImage = '<img src="' + bungalowImages[bungalowImageIndex].src + '" width="' + bungalowImages[bungalowImageIndex].width + '" height="' + bungalowImages[bungalowImageIndex].height + '" alt="' + bungalowImages[bungalowImageIndex].alt + '" class="' + bungalowImages[bungalowImageIndex].class + '" style="' + bungalowImages[bungalowImageIndex].style + '">';
                $(".imageContainerHouse").html(newImage);
                bungalowImageIndex++;

                if (bungalowImageIndex >= bungalowImages.length) {
                    $("#bungalowButton").parent().removeClass("hover");
                }
            }
        });

        $("#condoButton").on("click", function () {
            if (condoImageIndex < condoImages.length) {
                var newImage = '<img src="' + condoImages[condoImageIndex].src + '" width="' + condoImages[condoImageIndex].width + '" height="' + condoImages[condoImageIndex].height + '" alt="' + condoImages[condoImageIndex].alt + '" class="' + condoImages[condoImageIndex].class + '" style="' + condoImages[condoImageIndex].style + '">';
                $(".imageContainerHouse").html(newImage);
                condoImageIndex++;

                if (condoImageIndex >= condoImages.length) {
                    $("#condoButton").parent().removeClass("hover");
                }
            }
        });
    });
}