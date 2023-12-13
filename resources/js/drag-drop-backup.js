const specificPageURLs = [
    'financial-priorities',
    'savings/goals',
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    document.addEventListener('DOMContentLoaded', function() {
        var $needs = $("#needs"),
        $sortable = $("#sortable");

        var addedNeedsImages = sessionData ? sessionData : [null, null, null, null, null, null, null, null];
        
        // Function to click to drop
        function addImageToSortable(imageName, dataAvatar) {
            // Check if dataAvatar already exists in the array
            if (addedNeedsImages.includes(dataAvatar)) {
                return; // Don't add it again
            }

            // Disable button if already added image
            var thebutton = document.querySelector("button[data-avatar=" + dataAvatar + "]");

            thebutton.closest(".button-bg").classList.add("selected");
            thebutton.setAttribute("disabled", "true");
        
            var position = addedNeedsImages.findIndex((item) => item === null); // Find the first empty slot
        
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
                var droppedItem = $("<img class='inner-dropped'>").attr("src", imageName).attr("data-avatar", dataAvatar);
        
                // Append the droppedItem to the container
                container.append(droppedItem);
        
                var parentSvgContainer = droppedContainer.closest(".svg-container");
                var pathClass = parentSvgContainer.attr("data-svg-class");
                var dataIndex = parentSvgContainer.attr("data-index");

                var removeButton = $("<button class='remove-button btn-remove' data-avatar='" + dataAvatar + "' data-index='" + dataIndex + "'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
                container.append(removeButton);
                droppedContainer.append(container);
        
                droppedItem.animate({ width: "100px" }, function() {
                    droppedItem.animate({ height: "auto" });
                });
        
                parentSvgContainer.removeClass("blank-item");
                parentSvgContainer.addClass("item-dropped");
                droppedContainer.attr("data-identifier", dataAvatar);
                droppedContainer.addClass("not-available");
        
                // parentSvgContainer.addClass("item-dropped");
                // droppedContainer.attr("data-identifier", dataAvatar);
                // removeButton.attr("data-identifier", dataAvatar);

                // Check if an item has been dropped into the SVG container
                if (pathClass) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function(path) {
                        path.classList.add("item-dropped");
                    });
                }

                // removeButton.click(function() {
                //     parentSvgContainer.removeClass("item-dropped");

                //     if (pathClass) {
                //         // Find the path elements with the specified class
                //         var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                //         // Add the "item-dropped" class to the matching path elements
                //         paths.forEach(function(path) {
                //             path.classList.remove("item-dropped");
                //         });
                //     }
                //     container.remove();
                //     removeButton.remove();
                //     droppedContainer.removeAttr("data-identifier");

                //     // Clear the position in the imagePositions array
                //     addedNeedsImages[position] = null;

                //     updateHiddenInputValue();
                // });
            };
            updateHiddenInputValue();
        }
        
        $(document).on("click", ".remove-button", function () {
            $(this).closest(".svg-container").addClass("blank-item").removeClass("item-dropped");

            const sortable = $(this).closest(".sortable-container");
            var dataAvatar = sortable.parent().attr("data-identifier")
            var theButton = $(this).closest("#top_priorities").find("button[data-avatar=" + dataAvatar + "]");

            theButton.attr("disabled", false);
            theButton.closest(".button-bg").removeClass("selected");

            let svg = $(this).closest(".svg-container");
            let currentpath = svg.attr("data-svg-class");

            if (currentpath) {
                // Find the path elements with the specified class
                var paths = document.querySelectorAll("#sortable-main path." + currentpath);

                // Add the "item-dropped" class to the matching path elements
                paths.forEach(function (path) {
                    path.classList.remove("item-dropped");
                });
            }

            var parentcontainer = $(this).closest(".sortable-container");
            var parentdropped = parentcontainer.closest(".dropped");
            parentdropped.attr("data-identifier", null);
            parentdropped.removeClass("not-available");
            parentcontainer.remove();

            // Clear the position in the imagePositions array
            var index = svg.attr("data-index");
            var fixindex = index - 1;

            addedNeedsImages[fixindex] = null;

            updateHiddenInputValue();
        });

        // Do this when the priorities needed to be removed on pre-select
        // var removeButtons = document.querySelectorAll('.remove-button');
        
        // if (removeButtons.length > 0) {
        //     removeButtons.forEach(function(removeButtonSession) {
        //         removeButtonSession.addEventListener('click', function() {
        //             var parentSvgContainer = $(this).closest(".svg-container");
        //             var pathClass = parentSvgContainer.attr("data-svg-class");
        //             var droppedDiv = $(this).closest(".dropped");
        //             var sortableContainer = droppedDiv.find(".sortable-container");
        //             var buttonBg = droppedDiv.attr("data-identifier");

        //             var removedIndex = addedNeedsImages.findIndex(item => item === buttonBg);

        //             if (removedIndex !== -1) {
        //                 // If the item was found in addedNeedsImages, set it to null
        //                 addedNeedsImages[removedIndex] = null;
        //             }

        //             if (pathClass) {
        //                 // Find the path elements with the specified class
        //                 var paths = document.querySelectorAll("#sortable-main path." + pathClass);
        //                 // Add the "item-dropped" class to the matching path elements
        //                 paths.forEach(function(path) {
        //                     path.classList.remove("item-dropped");
        //                 });
        //             }
        //             parentSvgContainer.removeClass("item-dropped");
        //             sortableContainer.remove();
        //             droppedDiv.removeAttr("data-identifier");
        //             updateHiddenInputValue();
        //         });
        //     });
        // }

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
            handle: ".inner-dropped",
            start: function(event, ui) {
                const draggingBox = ui.item;
                const droppedPoint = draggingBox.closest(".item-dropped");
                const index = droppedPoint.attr("data-index");
                const attributeComp = droppedPoint.find(".dropped")[0];
                const attribute = $(attributeComp).attr("data-identifier");
                droppedPoint.addClass("draggingItem");
                const container = droppedPoint.find(".sortable-container")[0];
                $(container)[0].setAttribute("data-source-index", index);
                $(container)[0].setAttribute("data-source-identifier", attribute);
            },
            receive: function (event, ui) {
                const droppedBox = ui.item;
                const droppedParent = droppedBox.closest(".item-dropped");
                const index = droppedParent.attr("data-index");
                const attributeComp = droppedParent.find(".dropped")[0];

                // if (existingSortableContainer.length > 1) {
                //     // Store the existing container's HTML
                //     var existingContainerHtml = existingSortableContainer[0].outerHTML;
                //     var originalContainer = ui.item.data("original-container");
                //     var existingDropped = originalContainer.find('.dropped');

                //     // Replace the existing container with the new one
                //     ui.item.replaceWith(existingSortableContainer);
                    
                //     // Append the stored HTML of the existing container to the new container's position
                //     existingDropped.append(existingContainerHtml);

                // } else {
                //     // Store the original image source before sorting
                //     ui.item.data("original-src", ui.item.find("img").attr("src"));
                //     // ui.sender.sortable("cancel");
                // }
                if (droppedParent.find(".sortable-container").length === 0) {
                    event.preventDefault();
                    return;
                }

                const attribute = $(attributeComp).attr("data-identifier");
                droppedParent.addClass("droppedContainer");
                const containers = droppedParent.find(".sortable-container");

                const container = containers.filter(function (index, item) {
                    const sourceIndex = $(item).attr("data-source-index");
                    const sourceIdentifier = $(item).attr("data-source-identifier");
                    return sourceIndex === undefined && sourceIdentifier === undefined;
                })[0];

                $(container)[0].setAttribute("data-destination-index", index);
                $(container)[0].setAttribute("data-destination-identifier", attribute);
            },
            stop: function(event, ui) {
                // // Get the original parent svg-container
                // var originalContainer = ui.item.data("original-container");
                // var pathClassOriginal = originalContainer.attr("data-svg-class");
                // var droppedOriginal = originalContainer.find('.dropped');
                // var temp = droppedOriginal.attr('data-identifier');

                // // Find the new parent svg-container
                // var newContainer = ui.item.closest(".svg-container");
                // var pathClassNew = newContainer.attr("data-svg-class");
                // var droppedNew = newContainer.find('.dropped');

                const sourceBox = $(".item-dropped.draggingItem");
                const destinationBox = $(".item-dropped.droppedContainer");

                if (destinationBox.length === 0) {
                    sourceBox.removeClass("draggingItem");
                    event.preventDefault();
                    return;
                }

                const sourceContainer = destinationBox.find(".sortable-container").filter(function (index, item) {
                    const sourceIndex = $(item).attr("data-source-index");
                    const sourceIdentifier = $(item).attr("data-source-identifier");
                    return sourceIndex !== undefined && sourceIdentifier !== undefined;
                });

                const destinationContainer = destinationBox.find(".sortable-container").filter(function (index, item) {
                    const destinationIndex = $(item).attr("data-destination-index");
                    const destinationIdentifier = $(item).attr("data-destination-identifier");
                    return destinationIndex !== undefined && destinationIdentifier !== undefined;
                });

                const sourceAttribute = sourceContainer.attr("data-source-identifier");
                const destinationAttribute = destinationContainer.attr("data-destination-identifier");

                sourceContainer.removeAttr("data-source-index");
                sourceContainer.removeAttr("data-source-identifier");

                destinationContainer.removeAttr("data-destination-index");
                destinationContainer.removeAttr("data-destination-identifier");

                const sourceDropped = sourceBox.find(".dropped");
                sourceDropped[0].setAttribute("data-identifier", destinationAttribute);
                sourceDropped.find(".sortable-container").remove();

                sourceDropped.append(destinationContainer);

                const destinationDropped = destinationBox.find(".dropped");
                destinationDropped[0].setAttribute("data-identifier", sourceAttribute);

                sourceBox.removeClass("draggingItem");
                destinationBox.removeClass("droppedContainer");

                // if (originalContainer) {
                //     // originalContainer.removeClass("item-dropped");
                //     originalContainer.addClass("item-moved");
                //     droppedOriginal.removeAttr("data-identifier");
                // }

                // if (pathClassOriginal) {
                //     // Find the path elements with the specified class
                //     var paths = document.querySelectorAll("#sortable-main path." + pathClassOriginal);
                //     // Add the "item-dropped" class to the matching path elements
                //     paths.forEach(function(path) {
                //         path.classList.add("item-moved");
                //     });
                // }

                // if (newContainer) {
                //     newContainer.addClass("item-dropped");
                //     newContainer.removeClass("item-moved");
                //     droppedNew.attr("data-identifier", temp);
                // }

                // if (pathClassNew) {
                //     // Find the path elements with the specified class
                //     var paths = document.querySelectorAll("#sortable-main path." + pathClassNew);
                //     // Add the "item-dropped" class to the matching path elements
                //     paths.forEach(function(path) {
                //         path.classList.add("item-dropped");
                //         path.classList.remove("item-moved");
                //     });
                // }

                // Update addedNeedsImages based on the new order of elements
                const updatedImages = [];

                $sortable.find(".dropped").each(function() {
                    let dataAvatar = $(this).attr("data-identifier");
                    updatedImages.push(dataAvatar);
                });

                // Update addedNeedsImages with the new order
                addedNeedsImages = updatedImages.map((x) => x !== undefined ? x : null);

                updateHiddenInputValue();
            }
        });

        // Function to update the addedNeedsImages array based on the current order of images
        // function updateAddedNeedsImages() {
        //     addedNeedsImages = [];

        //     $(".dropped .sorting-div img.inner-dropped").each(function() {
        //         addedNeedsImages.push($(this).attr("src"));
        //     });
        // }

        // Function to drag and drop
        // var draggedItem = null;

        // $("button img", $needs).draggable({
        //     cancel: "a.ui-icon",
        //     revert: "invalid",
        //     containment: "document",
        //     helper: "clone",
        //     cursor: "move",
        //     start: function(event, ui) {
        //         if ($(this).hasClass("item-dropped")) {
        //             ui.helper.addClass("item-dropped");
        //         }
        //         draggedItem = $(this);
        //     }
        // });

        // $sortable.droppable({
        //     accept: "#needs button img:not(.item-dropped)",
        //     classes: {
        //         "ui-droppable-active": "ui-state-highlight"
        //     },

        //     drop: function(event, ui) {
        //         var droppedItem = ui.draggable.clone();
        //         var droppedContainer = $(this).find(".dropped:empty:first");
        //         var droppedContainerSortable = $sortable.find(".dropped");

        //         if (draggedItem) {
        //             var button = draggedItem.closest('button');
        //             var dataAvatar = button.attr("data-avatar");
        //         }

        //         if (droppedContainer.length > 0) {
        //             // Check if the needs image has already been added
        //             var imageName = droppedItem.attr("src");

        //             if (addedNeedsImages.indexOf(dataAvatar) === -1) {
        //                 var position = addedNeedsImages.findIndex(item => item === null); // Find the first empty slot
        
        //                 if (position === -1) {
        //                     // If no empty slot found, add to the end of the array
        //                     position = addedNeedsImages.length;
        //                 }
                        
        //                 addedNeedsImages[position] = dataAvatar;
        //                 var container = droppedContainerSortable.eq(position);
        //                 container.append(droppedItem);
        //                 var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");

        //                 droppedItem.animate({ width: "100px" }, function() {
        //                     droppedItem.find("img").animate({ height: "auto" });
        //                 });
                        
        //                 var parentSvgContainer = container.closest(".svg-container");
        //                 var pathClass = parentSvgContainer.attr("data-svg-class");

        //                 parentSvgContainer.addClass("item-dropped");
        //                 parentSvgContainer.append(removeButton);
        //                 container.attr("data-identifier", dataAvatar);
        //                 removeButton.attr("data-identifier", dataAvatar);

        //                 // Check if an item has been dropped into the SVG container
        //                 if (pathClass) {
        //                     // Find the path elements with the specified class
        //                     var paths = document.querySelectorAll("#sortable-main path." + pathClass);
        //                     // Add the "item-dropped" class to the matching path elements
        //                     paths.forEach(function(path) {
        //                         path.classList.add("item-dropped");
        //                     });
        //                 }

        //                 removeButton.click(function() {
        //                     parentSvgContainer.removeClass("item-dropped");

        //                     if (pathClass) {
        //                         // Find the path elements with the specified class
        //                         var paths = document.querySelectorAll("#sortable-main path." + pathClass);
        //                         // Add the "item-dropped" class to the matching path elements
        //                         paths.forEach(function(path) {
        //                             path.classList.remove("item-dropped");
        //                         });
        //                     }

        //                     droppedItem.remove();
        //                     removeButton.remove();
                            
        //                     // Remove the image from the addedNeedsImages array
        //                     var index = addedNeedsImages.indexOf(imageName);

        //                     if (index !== -1) {
        //                         addedNeedsImages.splice(index, 1);
        //                     }

        //                     // Clear the position in the imagePositions array
        //                     addedNeedsImages[position] = null;

        //                     updateHiddenInputValue();
        //                 });
        //                 updateHiddenInputValue();
        //             }
        //         }
        //     }
        // });
        
        // Add click functionality to #needs button images
        // $("button", $needs).click(function() {
        //     var imageName = $(this).find('img').attr("src");
        //     var button = $(this).closest('button');
        //     var dataAvatar = button.attr("data-avatar");
        //     addImageToSortable(imageName, dataAvatar);
        // });

        // Add click functionality to #needs button images
        $("button[data-avatar]", $needs).on("click", function (event) {
            event.preventDefault();
            var imageName = $(this).find("img").attr("src");
            var button = $(this);
            var dataAvatar = button.attr("data-avatar");
            addImageToSortable(imageName, dataAvatar);
        });
    });
}