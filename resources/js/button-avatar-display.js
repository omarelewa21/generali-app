$(document).ready(function () {

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
    var parentImageIndex = 0;
    var spouseImageIndex = 0;
    var childImageIndex = 0;
    var carImageIndex = 0;
    var scooterImageIndex = 0;
    var houseImageIndex = 0;
    var bungalowImageIndex = 0;
    var condoImageIndex = 0;

    // Set initial background to none
    $(".imageContainerParents").css("background-image", "none");
    $(".imageContainerChildren").css("background-image", "none");

    // Do the logics for button clicks
    // $("#parentButton").on("click", function () {
    //     if (parentImageIndex < parentImages.length) {
    //         var newImage = '<img src="' + parentImages[parentImageIndex].src + '" width="' + parentImages[parentImageIndex].width + '" height="' + parentImages[parentImageIndex].height + '" alt="' + parentImages[parentImageIndex].alt + '" class="' + parentImages[parentImageIndex].class + '" style="' + parentImages[parentImageIndex].style + '">';
    //         $(".imageContainerParents").append(newImage);
    //         parentImageIndex++;
            
    //         // Display the background image
    //         $(".imageContainerParents").css("background-image", 'url("/images/avatar-general/Shadow.png")');

    //         if (parentImageIndex >= parentImages.length) {
    //             $("#parentButton").parent().removeClass("hover");
    //         }
    //     }
    // });

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

    $("#childButton").on("click", function () {
        if (childImageIndex < childrenImages.length) {
            var newImage = '<img src="' + childrenImages[childImageIndex].src + '" width="' + childrenImages[childImageIndex].width + '" height="' + childrenImages[childImageIndex].height + '" alt="' + childrenImages[childImageIndex].alt + '" class="' + childrenImages[childImageIndex].class + '" style="' + childrenImages[childImageIndex].style + '">';
            $(".imageContainerChildren").append(newImage);
            childImageIndex++;
            
            // Display the background image
            $(".imageContainerChildren").css("background-image", 'url("/images/avatar-general/Shadow.png")');

            if (childImageIndex >= childrenImages.length) {
                $("#childButton").parent().removeClass("hover");
            }
        }
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