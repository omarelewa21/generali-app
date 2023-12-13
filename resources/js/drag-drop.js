const specificPageURLs = [
    'financial-priorities',
    'savings/goals',
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    document.addEventListener('DOMContentLoaded', function() {
        var $needs = $("#needs"),
        $sortable = $("#sortable");

        var addedNeedsImages = sessionData ? sessionData : [];
        
        // Function to click to drop
        function addImageToSortable(imageName, dataAvatar) {
            // Check if dataAvatar already exists in the array
            if (addedNeedsImages.includes(dataAvatar)) {
                return; // Don't add it again
            }
        
            var position = addedNeedsImages.findIndex(item => item === null); // Find the first empty slot
        
            if (position === -1) {
                // If no empty slot found, add to the end of the array
                position = addedNeedsImages.length;
            }
        
            addedNeedsImages[position] = dataAvatar;
        
            var droppedContainers = $sortable.find(".dropped");
            var droppedContainer = droppedContainers.eq(position); // Select the container based on position
        
            var img = new Image();
            img.src = imageName;
            img.onload = function() {
                // Create a container div
                var container = $("<div class='sortable-container'></div>");
        
                // Create the droppedItem as an image
                var droppedItem = $("<img class='inner-dropped'>").attr("src", imageName);
        
                // Append the droppedItem to the container
                container.append(droppedItem);
        
                var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
                container.append(removeButton);
                droppedContainer.append(container);
        
                droppedItem.animate({ width: "100px" }, function() {
                    droppedItem.animate({ height: "auto" });
                });
        
                var parentSvgContainer = droppedContainer.closest(".svg-container");
                var pathClass = parentSvgContainer.attr("data-svg-class");
        
                parentSvgContainer.addClass("item-dropped");
                droppedContainer.attr("data-identifier", dataAvatar);
                removeButton.attr("data-identifier", dataAvatar);

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
                    container.remove();
                    removeButton.remove();
                    droppedContainer.removeAttr("data-identifier");

                    // Clear the position in the imagePositions array
                    addedNeedsImages[position] = null;

                    updateHiddenInputValue();
                });
            };
            updateHiddenInputValue();
        }
        

        // Do this when the priorities needed to be removed on pre-select
        var removeButtons = document.querySelectorAll('.remove-button');
        
        if (removeButtons.length > 0) {
            removeButtons.forEach(function(removeButtonSession) {
                removeButtonSession.addEventListener('click', function() {
                    var parentSvgContainer = $(this).closest(".svg-container");
                    var pathClass = parentSvgContainer.attr("data-svg-class");
                    var droppedDiv = $(this).closest(".dropped");
                    var sortableContainer = droppedDiv.find(".sortable-container");
                    var buttonBg = droppedDiv.attr("data-identifier");

                    var removedIndex = addedNeedsImages.findIndex(item => item === buttonBg);

                    if (removedIndex !== -1) {
                        // If the item was found in addedNeedsImages, set it to null
                        addedNeedsImages[removedIndex] = null;
                    }

                    if (pathClass) {
                        // Find the path elements with the specified class
                        var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                        // Add the "item-dropped" class to the matching path elements
                        paths.forEach(function(path) {
                            path.classList.remove("item-dropped");
                        });
                    }
                    parentSvgContainer.removeClass("item-dropped");
                    sortableContainer.remove();
                    droppedDiv.removeAttr("data-identifier");
                    updateHiddenInputValue();
                });
            });
        }

        // Function to update the hidden field
        function updateHiddenInputValue() {
            var topPrioritiesButtonInput = document.getElementById('topPrioritiesButtonInput');
            topPrioritiesButtonInput.value = JSON.stringify(addedNeedsImages);
        }

        // Function to sort
        $sortable.find(".dropped").sortable({
            connectWith: ".dropped",
            placeholder: "ui-state-highlight",
            items: "> .sortable-container",
            start: function(event, ui) {
                // Store the original parent svg-container
                ui.item.data("original-container", ui.item.closest(".svg-container"));

                // Store the original image source before sorting
                // $(ui.item.find("img")).data("original-src", $(ui.item.find("img")).attr("src"));
            },
            receive: function(event, ui) {
                // Check if there's already a sortable-container inside the dropped container
                var droppedContainer = $(this);
                var existingSortableContainer = droppedContainer.find(".sortable-container");

                if (existingSortableContainer.length > 1) {
                    // Store the existing container's HTML
                    var existingContainerHtml = existingSortableContainer[0].outerHTML;
                    var originalContainer = ui.item.data("original-container");
                    var existingDropped = originalContainer.find('.dropped');

                    // Replace the existing container with the new one
                    ui.item.replaceWith(existingSortableContainer);
                    
                    // Append the stored HTML of the existing container to the new container's position
                    existingDropped.append(existingContainerHtml);

                } else {
                    // Store the original image source before sorting
                    ui.item.data("original-src", ui.item.find("img").attr("src"));
                    // ui.sender.sortable("cancel");
                }
            },
            stop: function(event, ui) {
                // Get the original parent svg-container
                var originalContainer = ui.item.data("original-container");
                var pathClassOriginal = originalContainer.attr("data-svg-class");
                var droppedOriginal = originalContainer.find('.dropped');
                var temp = droppedOriginal.attr('data-identifier');

                // Find the new parent svg-container
                var newContainer = ui.item.closest(".svg-container");
                var pathClassNew = newContainer.attr("data-svg-class");
                var droppedNew = newContainer.find('.dropped');

                if (originalContainer) {
                    // originalContainer.removeClass("item-dropped");
                    originalContainer.addClass("item-moved");
                    droppedOriginal.removeAttr("data-identifier");
                }

                if (pathClassOriginal) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll("#sortable-main path." + pathClassOriginal);
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function(path) {
                        path.classList.add("item-moved");
                    });
                }

                if (newContainer) {
                    newContainer.addClass("item-dropped");
                    newContainer.removeClass("item-moved");
                    droppedNew.attr("data-identifier", temp);
                }

                if (pathClassNew) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll("#sortable-main path." + pathClassNew);
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function(path) {
                        path.classList.add("item-dropped");
                        path.classList.remove("item-moved");
                    });
                }

                // Update addedNeedsImages based on the new order of elements
                var updatedImages = [];

                $sortable.find(".dropped").each(function() {
                    var dataAvatar = $(this).attr("data-identifier");
                    updatedImages.push(dataAvatar);
                });

                // Update addedNeedsImages with the new order
                addedNeedsImages = updatedImages;

                updateHiddenInputValue();
            }
        });





        // function addImageToSortable(imageName) {
        //     var droppedContainer = $sortable.find(".dropped:empty:first");
            
        //     if (droppedContainer.length > 0) {
        //         var position = addedNeedsImages.findIndex(item => item === null); // Find the first empty slot
                
        //         if (position === -1) {
        //             // If no empty slot found, add to the end of the array
        //             position = addedNeedsImages.length;
        //         }

        //         addedNeedsImages[position] = imageName;
                
        //         var img = new Image();
        //         img.src = imageName;
        //         img.onload = function () {
        //             var droppedItem = $("<img class='inner-dropped'>").attr("src", imageName);
        //             droppedContainer.append(droppedItem);
        //             var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
        //             droppedItem.animate({ width: "100px" }, function () {
        //                 droppedItem.animate({ height: "auto" });
        //             });

        //             var parentSvgContainer = droppedContainer.closest(".svg-container");
        //             var pathClass = parentSvgContainer.attr("data-svg-class");

        //             parentSvgContainer.addClass("item-dropped");
        //             droppedContainer.append(removeButton);

        //             // Check if an item has been dropped into the SVG container
        //             if (pathClass) {
        //                 // Find the path elements with the specified class
        //                 var paths = document.querySelectorAll("#sortable-main path." + pathClass);
        //                 // Add the "item-dropped" class to the matching path elements
        //                 paths.forEach(function (path) {
        //                     path.classList.add("item-dropped");
        //                 });
        //             }

        //             removeButton.click(function () {
        //                 parentSvgContainer.removeClass("item-dropped");
        //                 if (pathClass) {
        //                     // Find the path elements with the specified class
        //                     var paths = document.querySelectorAll("#sortable-main path." + pathClass);
        //                     // Add the "item-dropped" class to the matching path elements
        //                     paths.forEach(function (path) {
        //                         path.classList.remove("item-dropped");
        //                     });
        //                 }
        //                 droppedItem.remove();
        //                 removeButton.remove();

        //                 // Clear the position in the imagePositions array
        //                 addedNeedsImages[position] = null;

        //                 // console.log(addedNeedsImages);
        //             });
        //             // console.log(addedNeedsImages);
        //         };

        //         // Update the hidden input field value with the dropped priorities
        //         var topPrioritiesButtonInput = document.getElementById('topPrioritiesButtonInput');
        //         topPrioritiesButtonInput.value = JSON.stringify(addedNeedsImages);
        //     }
        // }


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
        var draggedItem = null;

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
                draggedItem = $(this);
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
                var droppedContainerSortable = $sortable.find(".dropped");

                if (draggedItem) {
                    var button = draggedItem.closest('button');
                    var dataAvatar = button.attr("data-avatar");
                }

                if (droppedContainer.length > 0) {
                    // Check if the needs image has already been added
                    var imageName = droppedItem.attr("src");

                    if (addedNeedsImages.indexOf(dataAvatar) === -1) {
                        var position = addedNeedsImages.findIndex(item => item === null); // Find the first empty slot
        
                        if (position === -1) {
                            // If no empty slot found, add to the end of the array
                            position = addedNeedsImages.length;
                        }
                        
                        addedNeedsImages[position] = dataAvatar;
                        var container = droppedContainerSortable.eq(position);
                        container.append(droppedItem);
                        var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");

                        droppedItem.animate({ width: "100px" }, function() {
                            droppedItem.find("img").animate({ height: "auto" });
                        });
                        
                        var parentSvgContainer = container.closest(".svg-container");
                        var pathClass = parentSvgContainer.attr("data-svg-class");

                        parentSvgContainer.addClass("item-dropped");
                        parentSvgContainer.append(removeButton);
                        container.attr("data-identifier", dataAvatar);
                        removeButton.attr("data-identifier", dataAvatar);

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

                            // Clear the position in the imagePositions array
                            addedNeedsImages[position] = null;

                            updateHiddenInputValue();
                        });
                        updateHiddenInputValue();
                    }
                }
            }
        });
        
        // Add click functionality to #needs button images
        $("button", $needs).click(function() {
            var imageName = $(this).find('img').attr("src");
            var button = $(this).closest('button');
            var dataAvatar = button.attr("data-avatar");
            addImageToSortable(imageName, dataAvatar);
        });
    });
}