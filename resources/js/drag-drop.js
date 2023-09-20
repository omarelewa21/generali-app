document.addEventListener('DOMContentLoaded', function() {
    var $needs = $("#needs"),
    $sortable = $("#sortable");

    var addedNeedsImages = []; // Array to keep track of added needs images

    function createSortingDiv() {
        var sortingDiv = $("<div class='sorting-div'></div>");
        $sortable.append(sortingDiv);
        return sortingDiv;
    }

    // Function to click to drop
    function addImageToSortable(imageName) {
        var droppedContainer = $sortable.find(".dropped:empty:first");
        if (droppedContainer.length > 0) {
            
            if (addedNeedsImages.indexOf(imageName) === -1) {
                addedNeedsImages.push(imageName);
                var img = new Image();
                img.src = imageName;
                img.onload = function() {
                    var droppedItem = $("<img class='inner-dropped'>").attr("src", imageName);
                    droppedContainer.append(droppedItem);
                    var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
                    droppedItem.animate({ width: "100px" }, function() {
                        droppedItem.animate({ height: "auto" });
                    });
                    
                    var parentSvgContainer = droppedContainer.closest(".svg-container");
                    var pathClass = parentSvgContainer.attr("data-svg-class");

                    parentSvgContainer.addClass("item-dropped");
                    droppedContainer.append(removeButton);

                    // Check if an item has been dropped into the SVG container
                    if (pathClass) {
                        // Find the path elements with the specified class
                        var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                        // Add the "item-dropped" class to the matching path elements
                        paths.forEach(function(path) {
                            path.classList.add("item-dropped");
                        });
                    }

                    removeButton.click(function() {
                        parentSvgContainer.removeClass("item-dropped");
                        if (pathClass) {
                            // Find the path elements with the specified class
                            var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                            // Add the "item-dropped" class to the matching path elements
                            paths.forEach(function(path) {
                                path.classList.remove("item-dropped");
                            });
                        }
                        droppedItem.remove();
                        removeButton.remove();
                        var index = addedNeedsImages.indexOf(imageName);

                        if (index !== -1) {
                            addedNeedsImages.splice(index, 1);
                        }
                    });
                };
            }
        }
    }

    // Function to update the addedNeedsImages array based on the current order of images
    function updateAddedNeedsImages() {
        addedNeedsImages = [];

        $(".dropped .sorting-div img.inner-dropped").each(function() {
            addedNeedsImages.push($(this).attr("src"));
        });
    }

    // $( ".example-class" ).sortable();
    // Function to sort
    // $(".dropped").sortable({
    //     connectWith: ".dropped",
    //     items: "img.inner-dropped",
    //     revert: true,
    //     stop: function(event, ui) {
    //         updateAddedNeedsImages();
    //     }
    // }).disableSelection();

    // $sortable.sortable({
    //     placeholder: "sortable-placeholder",
    //     cursor: "move",
    //     start: function(event, ui) {
    //         // Code to handle sorting start event
    //     },
    //     stop: function(event, ui) {
    //         // Code to handle sorting stop event
    //         updateAddedNeedsImages(); // Update the addedNeedsImages array after sorting
    //     }
    // });

    // $(".dropped", $sortable).sortable({
    //     cursor: "move",
    //     connectWith: ".dropped", // Allow sorting between all .dropped elements
    //     // start: function(event, ui) {
    //     //     // Code to handle sorting start event
    //     // },
    //     receive: function(event, ui) {
    //         // Check if there is already an image inside the container
    //         var $container = $(this);
    //         var $existingImage = $container.find("img");
    //         console.log($existingImage);
    //         // Swap positions with the dragged image
    //         var $draggedImage = ui.item.find("img");
    //         // $existingImage.insertBefore($draggedImage);
    //         ui.item.append($draggedImage);
            
    //         // Trigger the stop event to update any necessary data
    //         $container.sortable("option", "stop").call($container[0], event, ui);
    //         // if ($existingImage.length > 0) {
                
    //         // }
    //     },
    //     stop: function(event, ui) {
    //         // Code to handle sorting stop event
    //         updateAddedNeedsImages(); // Update the addedNeedsImages array after sorting
    //     }
    // });

    // $(".dropped").sortable({
    //     cursor: "move",
    //     connectWith: ".dropped", // Allow sorting between all .dropped elements
    //     start: function(event, ui) {
    //         // Code to handle sorting start event
    //     },
    //     stop: function(event, ui) {
    //         // Code to handle sorting stop event
    //         updateAddedNeedsImages(); // Update the addedNeedsImages array after sorting
    //     }
    // });
    
    $sortable.find(".svg-button").sortable({
        // items: ".dropped", // Only allow sorting of images
        connectWith: ".svg-button",
        placeholder: "ui-state-highlight",
        start: function(event, ui) {
            // Store the original image source before sorting
            // $(ui.item.find("img")).data("original-src", $(ui.item.find("img")).attr("src"));
        },
        stop: function(event, ui) {
            // Update the addedNeedsImages array to reflect the new order
            addedNeedsImages = $sortable.find(".svg-button").map(function() {
                return $(this).attr("src");
            }).get();
        }
    });  
    // $(".dropped").on("receive", function(event, ui) {
    //     var $draggedItem = ui.item;
    //     var $targetContainer = $(this);
    
    //     // Check if the target container already contains an image
    //     var $existingImage = $targetContainer.find(".inner-dropped img");
    
    //     if ($existingImage.length === 0) {
    //         // If the target container is empty, simply append the dragged item
    //         $targetContainer.append($draggedItem);
    //     } else {
    //         // If the target container already has an image, swap their src attributes
    //         var draggedSrc = $draggedItem.find("img").attr("src");
    //         var existingSrc = $existingImage.attr("src");
    
    //         $draggedItem.find("img").attr("src", existingSrc);
    //         $existingImage.attr("src", draggedSrc);
    //     }
    
    //     // Trigger the stop event to update any necessary data
    //     $targetContainer.sortable("option", "stop").call($targetContainer[0], event, ui);
    // });
    
    

    // Function to drag and drop
    $("button img", $needs).draggable({
        cancel: "a.ui-icon",
        revert: "invalid",
        containment: "document",
        helper: "clone",
        cursor: "move",
        start: function(event, ui) {
            if ($(this).hasClass("item-dropped")) {
                ui.helper.addClass("item-dropped");
            }
        }
    });

    $sortable.droppable({
        accept: "#needs button img:not(.item-dropped)",
        classes: {
            "ui-droppable-active": "ui-state-highlight"
        },

        drop: function(event, ui) {
            var droppedItem = ui.draggable.clone();
            var droppedContainer = $(this).find(".dropped:empty:first");
            
            if (droppedContainer.length > 0) {
                // Check if the needs image has already been added
                var imageName = droppedItem.attr("src");
                if (addedNeedsImages.indexOf(imageName) === -1) {
                    addedNeedsImages.push(imageName);
                    droppedContainer.append(droppedItem);
                    var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");

                    droppedItem.animate({ width: "100px" }, function() {
                        droppedItem.find("img").animate({ height: "auto" });
                    });
                    
                    var parentSvgContainer = droppedContainer.closest(".svg-container");
                    var pathClass = parentSvgContainer.attr("data-svg-class");

                    parentSvgContainer.addClass("item-dropped");
                    parentSvgContainer.append(removeButton);

                    // Check if an item has been dropped into the SVG container
                    if (pathClass) {
                        // Find the path elements with the specified class
                        var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                        // Add the "item-dropped" class to the matching path elements
                        paths.forEach(function(path) {
                            path.classList.add("item-dropped");
                        });
                    }

                    removeButton.click(function() {
                        parentSvgContainer.removeClass("item-dropped");

                        if (pathClass) {
                            // Find the path elements with the specified class
                            var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                            // Add the "item-dropped" class to the matching path elements
                            paths.forEach(function(path) {
                                path.classList.remove("item-dropped");
                            });
                        }

                        droppedItem.remove();
                        removeButton.remove();
                        
                        // Remove the image from the addedNeedsImages array
                        var index = addedNeedsImages.indexOf(imageName);

                        if (index !== -1) {
                            addedNeedsImages.splice(index, 1);
                        }
                    });
                }
            }
        }
    });
    
    // Add click functionality to #needs button images
    $("button img", $needs).click(function() {
        var imageName = $(this).attr("src");
        addImageToSortable(imageName);
    });
});