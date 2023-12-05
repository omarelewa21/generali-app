const specificPageURLs = ["financial-priorities"];

const currentURL = window.location.href;

if (specificPageURLs.some((url) => currentURL.endsWith(url))) {
    document.addEventListener("DOMContentLoaded", function () {
        var $needs = $("#needs"),
            $sortable = $("#sortable");

        var addedNeedsImages = sessionData
            ? sessionData
            : [null, null, null, null, null, null, null, null];

        // Function to click to drop
        function addImageToSortable(imageName, dataAvatar) {
            // Check if dataAvatar already exists in the array
            if (addedNeedsImages.includes(dataAvatar)) {
                return; // Don't add it again
            }

            // Disable button if already added image
            var thebutton = document.querySelector(
                "button[data-avatar=" + dataAvatar + "]"
            );
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
            img.onload = function () {
                // Create a container div
                var container = $("<div class='sortable-container'></div>");

                // Create the droppedItem as an image
                var droppedItem = $("<img class='inner-dropped'>")
                    .attr("src", imageName)
                    .attr("data-avatar", dataAvatar);

                // Append the droppedItem to the container
                container.append(droppedItem);

                var parentSvgContainer =
                    droppedContainer.closest(".svg-container");
                var pathClass = parentSvgContainer.attr("data-svg-class");
                var dataIndex = parentSvgContainer.attr("data-index");

                var removeButton = $(
                    "<button class='remove-button btn-remove' data-avatar='" +
                        dataAvatar +
                        "' data-index='" +
                        dataIndex +
                        "'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>"
                );
                container.append(removeButton);
                droppedContainer.append(container);

                droppedItem.animate({ width: "100px" }, function () {
                    droppedItem.animate({ height: "auto" });
                });

                parentSvgContainer.removeClass("blank-item");
                parentSvgContainer.addClass("item-dropped");
                droppedContainer.attr("data-identifier", dataAvatar);
                droppedContainer.addClass("not-available");

                // Check if an item has been dropped into the SVG container
                if (pathClass) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll(
                        "#sortable-main path." + pathClass
                    );
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function (path) {
                        path.classList.add("item-dropped");
                    });
                }
            };
            updateHiddenInputValue();
        }

        $(document).on("click", ".remove-button", function () {
            $(this).closest(".svg-container").addClass("blank-item").removeClass("item-dropped");
            const sortable = $(this).closest(".sortable-container");
            var dataAvatar = sortable.parent().attr("data-identifier")
            var theButton = $(this)
                .closest("#top_priorities")
                .find("button[data-avatar=" + dataAvatar + "]");
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

            updateHiddenInputValue();
        });

        // Function to update the hidden field
        function updateHiddenInputValue() {
            var topPrioritiesButtonInput = document.getElementById(
                "topPrioritiesButtonInput"
            );
            topPrioritiesButtonInput.value = JSON.stringify(addedNeedsImages);
        }

        // Function to sort
        $sortable.find(".dropped").sortable({
            connectWith: ".dropped",
            placeholder: "ui-state-highlight",
            items: "> .sortable-container",
            handle: ".inner-dropped",
            start: function (event, ui) {
                // Store the original parent svg-container
                ui.item.data(
                    "original-container",
                    ui.item.closest(".svg-container")
                );

                // Store the original image source before sorting
                // $(ui.item.find("img")).data("original-src", $(ui.item.find("img")).attr("src"));
            },
            receive: function (event, ui) {
                // Check if there's already a sortable-container inside the dropped container
                var droppedContainer = $(this);
                var existingSortableContainer = droppedContainer.find(
                    ".sortable-container"
                );
                $(ui.item).addClass("replacer");

                if (existingSortableContainer.length > 1) {
                    // Store the existing container's HTML
                    var existingContainerHtml =
                        existingSortableContainer[0].outerHTML;
                    var originalContainer = ui.item.data("original-container");
                    var existingDropped = originalContainer.find(".dropped");
                    var existingSortable = existingDropped.find(
                        ".sortable-container"
                    );

                    // // Replace the existing container with the new one
                    // ui.item.replaceWith(existingSortableContainer);

                    // // Append the stored HTML of the existing container to the new container's position

                    existingSortable.replaceWith(existingContainerHtml);
                } else {
                    var originalContainer = ui.item.data("original-container");
                    originalContainer.addClass("empty");
                }
            },
            stop: function (event, ui) {
                // Get the original parent svg-container
                var originalContainer = ui.item.data("original-container");
                var pathClassOriginal =
                    originalContainer.attr("data-svg-class");
                var droppedOriginal = originalContainer.find(".dropped");
                var sortableOriginal = droppedOriginal.find(
                    ".sortable-container"
                );
                var temp = droppedOriginal.attr("data-identifier");

                // Find the new parent svg-container
                var secondContainer = ui.item.closest(".svg-container");
                var pathClassSecond = secondContainer.attr("data-svg-class");
                var droppedSecond = secondContainer.find(".dropped");
                var sortableSecond = droppedSecond.find(
                    ".sortable-container:not(.replacer)"
                );
                var temp2 = sortableSecond
                    .find(".inner-dropped")
                    .attr("data-avatar");

                // console.log(pathClassOriginal);
                // console.log(pathClassSecond);

                var originalIndex = originalContainer.attr("data-index");
                var newIndex = secondContainer.attr("data-index");

                sortableSecond
                    .find(".btn-remove")
                    .attr("data-index", originalIndex);
                $(".svg-container[data-index=" + originalIndex + "]")
                    .find(".sortable-container")
                    .remove();
                $(".svg-container[data-index=" + originalIndex + "]")
                    .find(".dropped")
                    .append(sortableSecond);
                $(ui.item).removeClass("replacer");

                secondContainer
                    .find(".btn-remove")
                    .attr("data-index", newIndex);

                // newContainer.find(".btn-remove").attr("data-index", newIndex);

                if (originalContainer) {
                    // originalContainer.removeClass("item-dropped");
                    originalContainer.addClass("moved");
                    originalContainer.removeClass("item-dropped");
                    originalContainer.removeClass("blank-item");
                }

                droppedOriginal.attr("data-identifier", null);

                if (originalContainer.hasClass("empty")) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll(
                        "#sortable-main path." + pathClassOriginal
                    );
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function (path) {
                        path.classList.remove("item-dropped");
                        path.classList.remove("moved");
                    });
                } else {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll(
                        "#sortable-main path." + pathClassOriginal
                    );
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function (path) {
                        path.classList.add("item-dropped");
                        path.classList.add("moved");
                    });

                    originalContainer.addClass("item-dropped");
                }

                if (sortableOriginal) {
                    $(".svg-container[data-index=" + originalIndex + "]")
                        .find(".dropped")
                        .attr("data-identifier", temp2);
                }

                if (secondContainer) {
                    secondContainer.addClass("item-dropped");
                    secondContainer.removeClass("moved");
                    droppedSecond.attr("data-identifier", temp);
                    secondContainer.removeClass("blank-item");
                    secondContainer
                        .find(".btn-remove")
                        .attr("data-index", newIndex);
                }

                if (pathClassSecond) {
                    // Find the path elements with the specified class
                    var paths = document.querySelectorAll(
                        "#sortable-main path." + pathClassSecond
                    );
                    // Add the "item-dropped" class to the matching path elements
                    paths.forEach(function (path) {
                        path.classList.add("item-dropped");
                        path.classList.remove("moved");
                    });
                }

                $(".svg-container").removeClass("empty");

                // Update addedNeedsImages based on the new order of elements
                var updatedImages = [];

                $sortable.find(".dropped").each(function () {
                    var dataAvatar = $(this).attr("data-identifier");
                    updatedImages.push(dataAvatar);
                });

                // Update addedNeedsImages with the new order
                var newArray = updatedImages.map((x) =>
                    x !== undefined ? x : null
                );
                addedNeedsImages = newArray;
                console.log(addedNeedsImages);

                // console.log(addedNeedsImages);

                updateHiddenInputValue();
            },
        });

        // Add click functionality to #needs button images
        $("button[data-avatar]", $needs).on("click", function (event) {
            event.preventDefault();
            var imageName = $(this).find("img").attr("src");
            var button = $(this);
            var dataAvatar = button.attr("data-avatar");
            addImageToSortable(imageName, dataAvatar);

            // $(this).closest('.button-bg').addClass('selected');
        });
    });
}