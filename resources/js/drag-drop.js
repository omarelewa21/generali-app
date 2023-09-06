$(function() {
    var $needs = $("#needs"),
    $sortable = $("#sortable");

    var addedNeedsImages = []; // Array to keep track of added needs images

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

        $(".dropped img.inner-dropped").each(function() {
            addedNeedsImages.push($(this).attr("src"));
        });
    }

    // Function to sort
    $(".dropped").sortable({
        connectWith: ".dropped",
        items: "img.inner-dropped",
        revert: true,
        stop: function(event, ui) {
            updateAddedNeedsImages();
        }
    }).disableSelection();

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
    
    // $needs.droppable({
    //     accept: "#sortable button img",
    //     classes: {
    //         "ui-droppable-active": "custom-state-active"
    //     },

    //     drop: function(event, ui) {
    //         var droppedItem = ui.draggable;
    //         var parentSvgButton = droppedItem.closest(".svg-button");
    //         droppedItem.draggable("enable");
    //         droppedItem.removeClass("item-dropped");
    //         parentSvgButton.removeClass("item-dropped");
    //         droppedItem.remove();
            
    //         // Remove the image from the addedNeedsImages array
    //         var imageName = droppedItem.attr("src");
    //         var index = addedNeedsImages.indexOf(imageName);

    //         if (index !== -1) {
    //             addedNeedsImages.splice(index, 1);
    //         }
    //     }
    // });
    
    // Add click functionality to #needs button images
    $("button img", $needs).click(function() {
        var imageName = $(this).attr("src");
        addImageToSortable(imageName);
    });
});



// $(function() {
//     var $needs = $("#needs"),
//     $sortable = $("#sortable");

//     var addedNeedsImages = []; // Array to keep track of added needs images

//     function addImageToSortable(imageName) {
//         var droppedContainer = $sortable.find(".dropped:empty:first");
//         if (droppedContainer.length > 0) {
            
//             if (addedNeedsImages.indexOf(imageName) === -1) {
//                 addedNeedsImages.push(imageName);
//                 var img = new Image();
//                 img.src = imageName;
//                 img.onload = function() {
//                     var droppedItem = $("<img class='inner-dropped'>").attr("src", imageName);
//                     droppedContainer.append(droppedItem);
//                     var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
//                     droppedContainer.append(removeButton);
//                     droppedItem.animate({ width: "40%" }, function() {
//                         droppedItem.animate({ height: "auto" });
//                     });
                    
//                     // var parentSvgButton = droppedContainer.closest(".svg-button");
//                     // parentSvgButton.addClass("item-dropped");
                    
//                     var parentSvgContainer = droppedContainer.closest(".svg-container");
//                 var parentSvgButton = parentSvgContainer.find(".svg-button");
//                 var pathClass = parentSvgContainer.attr("data-svg-class");

//                 parentSvgButton.addClass("item-dropped");

//                 // Check if an item has been dropped into the SVG container
//                 if (pathClass) {
//                     // Find the path elements with the specified class
//                     var paths = document.querySelectorAll("#sortable-main path." + pathClass);
//                     // Add the "item-dropped" class to the matching path elements
//                     paths.forEach(function(path) {
//                         path.classList.add("item-dropped");
//                     });
//                 }

//                     removeButton.click(function() {
//                         parentSvgButton.removeClass("item-dropped");
//                         droppedItem.remove();
//                         removeButton.remove();
//                         var index = addedNeedsImages.indexOf(imageName);

//                         if (index !== -1) {
//                             addedNeedsImages.splice(index, 1);
//                         }
//                     });
//                 };
//             }
//         }
//     }

//     // Function to update the addedNeedsImages array based on the current order of images
//     function updateAddedNeedsImages() {
//         addedNeedsImages = [];

//         $(".dropped img.inner-dropped").each(function() {
//             addedNeedsImages.push($(this).attr("src"));
//         });
//     }

//     $(".dropped").sortable({
//         connectWith: ".dropped",
//         items: "img.inner-dropped",
//         revert: true,
//         stop: function(event, ui) {
//             updateAddedNeedsImages();
//         }
//     }).disableSelection();

//     $("button img", $needs).draggable({
//         cancel: "a.ui-icon",
//         revert: "invalid",
//         containment: "document",
//         helper: "clone",
//         cursor: "move",
//         start: function(event, ui) {
//             if ($(this).hasClass("item-dropped")) {
//                 ui.helper.addClass("item-dropped");
//             }
//         }
//     });

//     $sortable.droppable({
//         accept: "#needs button img:not(.item-dropped)",
//         classes: {
//             "ui-droppable-active": "ui-state-highlight"
//         },

//         drop: function(event, ui) {
//             var droppedItem = ui.draggable.clone();
//             var droppedContainer = $(this).find(".dropped:empty:first");
            
//             if (droppedContainer.length > 0) {
//                 // Check if the needs image has already been added
//                 var imageName = droppedItem.attr("src");
//                 if (addedNeedsImages.indexOf(imageName) === -1) {
//                     addedNeedsImages.push(imageName);
//                     droppedContainer.append(droppedItem);
//                     var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
//                     droppedContainer.append(removeButton);

//                     droppedItem.animate({ width: "40%" }, function() {
//                         droppedItem.find("img").animate({ height: "30px" });
//                     });
                    
//                     var parentSvgButton = droppedContainer.closest(".svg-button");
//                     parentSvgButton.addClass("item-dropped");
                    
//                     removeButton.click(function() {
//                         parentSvgButton.removeClass("item-dropped");
//                         droppedItem.remove();
//                         removeButton.remove();
                        
//                         // Remove the image from the addedNeedsImages array
//                         var index = addedNeedsImages.indexOf(imageName);

//                         if (index !== -1) {
//                             addedNeedsImages.splice(index, 1);
//                         }
//                     });
//                 }
//             }
//         }
//     });
    
//     $needs.droppable({
//         accept: "#sortable button img",
//         classes: {
//             "ui-droppable-active": "custom-state-active"
//         },

//         drop: function(event, ui) {
//             var droppedItem = ui.draggable;
//             var parentSvgButton = droppedItem.closest(".svg-button");
//             droppedItem.draggable("enable");
//             droppedItem.removeClass("item-dropped");
//             parentSvgButton.removeClass("item-dropped");
//             droppedItem.remove();
            
//             // Remove the image from the addedNeedsImages array
//             var imageName = droppedItem.attr("src");
//             var index = addedNeedsImages.indexOf(imageName);

//             if (index !== -1) {
//                 addedNeedsImages.splice(index, 1);
//             }
//         }
//     });
    
//     // Add click functionality to #needs button images
//     $("button img", $needs).click(function() {
//         var imageName = $(this).attr("src");
//         addImageToSortable(imageName);
//     });
// });