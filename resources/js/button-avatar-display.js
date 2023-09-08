const specificPageURLs = [
    'marital-status',
    'family-dependant'
];

if (specificPageURLs.some(url => window.location.href.includes(url))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

    $(function() {
        
        // Set the avatar according to button clicks
        var spouseImages = [
            {
                src: "/images/avatar-general/spouse.png",
                width: "auto",
                height: "90%",
                alt: "Spouse",
                class: "changeImage position-absolute appended-image",
                style: "bottom: 10px;right: -80px;"
            },
        ];

        var spouseWidowedImages = [
            {
                src: "/images/avatar-general/spouse.png",
                width: "auto",
                height: "90%",
                alt: "Spouse",
                class: "changeImage position-absolute",
                style: "bottom: 10px;right: -80px; opacity: 0.5;"
            },
        ];

        var parentImages = [
            {
                src: "/images/avatar-general/parent-mother.svg",
                width: "auto",
                height: "90%",
                alt: "Parent",
                class: "changeImage position-absolute bottom-0 pb-2",
                style: "right: -80px;"
            },
            {
                src: "/images/avatar-general/parent-father-no-shadow.svg",
                width: "auto",
                height: "100%",
                alt: "Parent",
                class: "changeImage pb-2"
            }
        ];

        var childrenImages = [
            {
                src: "/images/avatar-general/children-boy.svg",
                width: "auto",
                height: "80%",
                alt: "Children",
                class: "changeImage position-absolute end-0",
                style: "bottom:10px"
            },
            {
                src: "/images/avatar-general/children-girl.svg",
                width: "auto",
                height: "50%",
                alt: "Children",
                class: "changeImage position-absolute",
                style: "bottom:10px"
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

        // Set initial background to none
        $(".imageContainerParents").css("background-image", "none");
        $(".imageContainerChildren").css("background-image", "none");

        if (path == '/marital-status') {
            var preselect = document.getElementById('maritalStatusButtonInput');

            if (preselect.value == 'married') {
                var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
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
        else if (path == '/family-dependant') {
            var preselect = document.getElementById('familyDependantButtonInput');

            if (preselect.value == '["spouse"]') {
                var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
                $(".imageContainerSpouse").append(newImage);
            }
            else {
                $(".imageContainerSpouse").empty;
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
                var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
                $imageContainer.append(newImage);              
            } else {
                // If no existing image, create a new one and append it
                var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
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
        });

        // Parents selection
        $(".btn-exit-parent").on("click", function () {
            // Get the selected value from the dropdown
            var selectedValue = $("#parentsSelect").val();

            if (selectedValue === "father" || selectedValue === "mother" || selectedValue === "both") {
                // Clear the existing images
                $(".imageContainerParents").empty();

                var selectedImages = [];

                if (selectedValue === "father" || selectedValue === "both") {
                    selectedImages.push(parentImages[1]);
                }

                if (selectedValue === "mother" || selectedValue === "both") {
                    selectedImages.push(parentImages[0]);
                }

                selectedImages.forEach(function (image) {
                    var newImage = '<img src="' + image.src + '" width="' + image.width + '" height="' + image.height + '" alt="' + image.alt + '" class="' + image.class + '" style="' + image.style + '">';
                    $(".imageContainerParents").append(newImage);
                });

                // Display the background image
                $(".imageContainerParents").css("background-image", 'url("/images/avatar-general/Shadow.png")');
                
                // Close the modal
                $("#parentAvatars").modal("hide");
            }
        });

        

        // $("#spouseButton").on("click", function () {
        //     const $button = $(this);
        //     const $buttonBg = $button.closest('.button-bg');
        //     const $imageContainerSpouse = $(".imageContainerSpouse");
            
        //     if ($buttonBg.hasClass("selected")) {
        //         if (spouseImageIndex < spouseImages.length) {
        //             var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
        //             $imageContainerSpouse.append(newImage);
        //             spouseImageIndex++;
                    
        //             // Display the background image
        //             $imageContainerSpouse.css("background-image", 'url("/images/avatar-general/Shadow.png")');
        
        //             if (spouseImageIndex >= spouseImages.length) {
        //                 $button.parent().removeClass("hover");
        //             }
        //         }
        //     } else {
        //         // If the button is not selected, remove the appended images
        //         $imageContainerSpouse.find('.appended-image').remove();
        //         spouseImageIndex = 0;
        
        //         // Restore the background image
        //         $imageContainerSpouse.css("background-image", 'url("/images/avatar-general/Shadow.png")');
        //     }
        
        //     // Toggle the 'selected' class
        //     $buttonBg.classList.toggle('selected');
        // });
        
        
        

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
        
            // Display the background image
            $(".imageContainerChildren").css("background-image", 'url("/images/avatar-general/Shadow.png")');
        
            // Close the modal
            $("#childrenAvatars").modal("hide");
        });
        
        

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