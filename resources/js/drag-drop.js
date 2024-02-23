const specificPageURLs = [
    'financial-priorities',
    'savings/goals',
];

const currentURL = window.location.href;
const queryString = window.location.search;

if (specificPageURLs.some(url => currentURL.endsWith(url) || currentURL.endsWith(queryString))) {
    document.addEventListener('DOMContentLoaded', function() {
        var $needs = $("#needs"),
        $sortable = $("#sortable");

        var addedNeedsImages = sessionData ? sessionData : Array(8).fill(null);

        // Function to click to drop
        function addImageToSortable(imageName, dataAvatar) {
            // Check if dataAvatar already exists in the array
            if (addedNeedsImages.includes(dataAvatar) || !dataAvatar) {
                return; // Don't add it again
            }

            var thebutton = document.querySelector("button[data-avatar='" + dataAvatar + "']");

            thebutton.closest(".button-bg").classList.add("selected");
            thebutton.setAttribute("disabled", "true");

            var position = addedNeedsImages.findIndex(item => item === null);
        
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

                // Check if an item has been dropped into the SVG container
                if (pathClass) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll("#sortable-main path." + pathClass);
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function(path) {
                        path.classList.add("item-dropped");
                    });
                }
            };
            updateHiddenInputValue();
        }

        // Event handler for removing a dropped image
        $(document).on("click", ".remove-button", function () {
            // Remove the image from the DOM and update related elements
            $(this).closest(".svg-container").addClass("blank-item").removeClass("item-dropped");
            const sortable = $(this).closest(".sortable-container");
            var dataAvatar = sortable.parent().attr("data-identifier")
            var theButton = $(this).closest($("#topPrioritiesButtonInput").length ? "#top_priorities" : "#savings-goals").find("button[data-avatar='" + dataAvatar + "']");
            theButton.attr("disabled", false);
            theButton.closest(".button-bg").removeClass("selected");

            let svg = $(this).closest(".svg-container");
            let currentpath = svg.attr("data-svg-class");
            if (currentpath) {
                // Find the path elements with the specified class
                var paths = document.querySelectorAll(
                    "#sortable-main path." + currentpath
                );

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

            // Update the hidden input field value
            updateHiddenInputValue();
        });

        // Function to update the hidden field
        function updateHiddenInputValue() {
            if ($("#topPrioritiesButtonInput").length) {
              const topPrioritiesButtonInput = document.getElementById("topPrioritiesButtonInput");
              topPrioritiesButtonInput.value = JSON.stringify(addedNeedsImages);
            } else {
              const savingsGoalsButtonInput = document.getElementById("savingsGoalsButtonInput");
              savingsGoalsButtonInput.value = JSON.stringify(addedNeedsImages);
            }
        }      

        $(window).resize(function () {
            if ($("#topPrioritiesButtonInput").val() && JSON.stringify(addedNeedsImages) != $("#topPrioritiesButtonInput").val().replaceAll(",null", "")) {
                const data = JSON.parse($("#topPrioritiesButtonInput").val().replaceAll(",null", ""));
                const remainingData = data.filter(item => !addedNeedsImages.includes(item));
        
                if (remainingData.length) {
                    for (let i = 0; i < remainingData.length; i++) {
                        const dataAvatar = $(`button[data-avatar="${remainingData[i]}"]`);
                        const dataName = dataAvatar.find("img").attr("src");
            
                        dataAvatar.trigger("click");
                        addImageToSortable(dataName, dataAvatar.attr("data-avatar"));
                    }
                }
            }
        });
      
          // Initialize sortable functionality for dropped items
          // $sortable.find(".dropped").sortable({
          $("#sortable .svg-button").sortable({
            // Configuration options for the sortable functionality
            connectWith: ".svg-button",
            placeholder: "ui-state-highlight",
            items: ".sortable-container",
            // handle: ".inner-dropped",
            start: function (event, ui) {
                const draggingBox = ui.item;
                const droppedPoint = draggingBox.closest(".item-dropped");
                const index = droppedPoint.attr("data-index");
        
                const attributeComp = droppedPoint.find(".dropped")[0];
                const attribute = $(attributeComp).attr("data-identifier");
                droppedPoint.addClass("draggingItem");
                const container = droppedPoint.find(".sortable-container")[0];
                // console.log(7777);
                $(container)[0].setAttribute("data-source-index", index);
                $(container)[0].setAttribute("data-source-identifier", attribute);
            },
            receive: function (event, ui) {
                const droppedBox = ui.item;
                const droppedParent = droppedBox.closest(".item-dropped");
                const index = droppedParent.attr("data-index");
                const attributeComp = droppedParent.find(".dropped")[0];
        
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
        
                if ($(container)[0] !== undefined) {
                $(container)[0].setAttribute("data-destination-index", index);
                $(container)[0].setAttribute("data-destination-identifier", attribute);
                }
            },
            stop: function (event, ui) {
                const sourceBox = $(".item-dropped.draggingItem");
                const destinationBox = $(".item-dropped.droppedContainer");
        
                if (destinationBox.length === 0) {
                    sourceBox.removeClass("draggingItem");
            
                    const container = $(sourceBox.find(".sortable-container")[0]);
            
                    container.removeAttr("data-source-index");
                    container.removeAttr("data-source-identifier");
            
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
        
                const updatedImages = [];
        
                $sortable.find(".dropped").each(function () {
                    let dataAvatar = $(this).attr("data-identifier");
                    updatedImages.push(dataAvatar);
                });
        
                addedNeedsImages = updatedImages.map(x => (x !== undefined ? x : null));
        
                updateHiddenInputValue();
            }
        });      

        var dblclick = false;

        $("button img", $needs).draggable({
            cancel: "a.ui-icon",
            // revert: "invalid",
            containment: "document",
            helper: "clone",
            cursor: "move",
            start: function (event, ui) {
                if ($(this).hasClass("item-dropped")) {
                ui.helper.addClass("item-dropped");
                }

                if (dblclick) {
                setTimeout(() => {
                    $(event.currentTarget).trigger("click");
                    $(event.currentTarget).trigger("dragstop");
                    $(event.currentTarget).trigger("mouseup");
                }, 10);

                dblclick = false;
                }
            },
            stop: function (event, ui) {
                ui.helper.hide();
            }
        });

        $("button img", $needs).on("dblclick", function (e) {
            e.preventDefault();
            dblclick = true;
        });

        $("#top_priorities, #savings-goals").droppable({
            accept: "#needs button img:not(.item-dropped)",
            classes: {
              "ui-droppable-active": "ui-state-highlight"
            },
            drop: function (event, ui) {
              // console.log($(this).find('.dropped').is(':empty'));
                if ($(this).find(".dropped").is(":empty")) {
                    var imageName = ui.draggable.parent().find("img").attr("src");
                    var button = ui.draggable.closest("button");
        
                    var dataAvatar = button.attr("data-avatar");
        
                    addImageToSortable(imageName, dataAvatar);
                }
            }
        });
      
        
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