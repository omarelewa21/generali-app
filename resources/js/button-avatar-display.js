$(function() {

    // Set the avatar according to button clicks
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

    var spouseImages = [
        {
            src: "/images/avatar-general/spouse-no-shadow.svg",
            width: "auto",
            height: "90%",
            alt: "Spouse",
            class: "changeImage position-absolute",
            style: "bottom: 10px;right: -80px;"
        },
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
    var carImageIndex = 0;
    var scooterImageIndex = 0;
    var houseImageIndex = 0;
    var bungalowImageIndex = 0;
    var condoImageIndex = 0;

    // Set initial background to none
    $(".imageContainerParents").css("background-image", "none");
    $(".imageContainerChildren").css("background-image", "none");

    // Do the logics for button clicks
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

    // Spouse selection
    $("#spouseButton").on("click", function () {
        if (spouseImageIndex < spouseImages.length) {
            var newImage = '<img src="' + spouseImages[spouseImageIndex].src + '" width="' + spouseImages[spouseImageIndex].width + '" height="' + spouseImages[spouseImageIndex].height + '" alt="' + spouseImages[spouseImageIndex].alt + '" class="' + spouseImages[spouseImageIndex].class + '" style="' + spouseImages[spouseImageIndex].style + '">';
            $(".imageContainerSpouse").append(newImage);
            spouseImageIndex++;
            
            // Display the background image
            $(".imageContainerSpouse").css("background-image", 'url("/images/avatar-general/Shadow.png")');

            if (spouseImageIndex >= spouseImages.length) {
                $("#spouseButton").parent().removeClass("hover");
            }
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