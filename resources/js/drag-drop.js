// $(function() {
//     var $needs = $("#needs"),
//     $sortable = $("#sortable");

//     var addedNeedsImages = []; // Array to keep track of added needs images

//     console.log(addedNeedsImages);

//     function addImageToSortable(imageName) {
//         var droppedContainer = $sortable.find(".dropped:empty:first");
//         if (droppedContainer.length > 0) {
            
//             if (addedNeedsImages.indexOf(imageName) === -1) {
//                 addedNeedsImages.push(imageName);
//                 var img = new Image();
//                 img.src = imageName;
//                 img.onload = function() {
//                     var droppedItem = $("<img>").attr("src", imageName);
//                     droppedContainer.append(droppedItem);
//                     var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
//                     droppedContainer.append(removeButton);
//                     droppedItem.animate({ width: "40%" }, function() {
//                         droppedItem.animate({ height: "auto" });
//                     });
                    
//                     var parentSvgButton = droppedContainer.closest(".svg-button");
//                     parentSvgButton.addClass("item-dropped");
                    
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

//     $sortable.sortable({
//         items: ".dropped",
//         update: function(event, ui) {
//             // Update the addedNeedsImages array to reflect the new order
//             addedNeedsImages = $sortable.find(".dropped img").map(function() {
//                 return $(this).attr("src");
//             }).get();
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

//     // $sortable.find(".dropped").droppable({
//     //     accept: "#sortable .dropped img",
//     //     drop: function(event, ui) {
//     //         var sourceDropped = ui.helper.closest(".dropped");
//     //         var targetDropped = $(this);

//     //         // Swap the images and reset the helper
//     //         var sourceImage = sourceDropped.find("img");
//     //         var targetImage = targetDropped.find("img");

//     //         // Swap their src attributes
//     //         var tempSrc = sourceImage.attr("src");
//     //         sourceImage.attr("src", targetImage.attr("src"));
//     //         targetImage.attr("src", tempSrc);

//     //         // Clear the helper
//     //         ui.helper.empty();

//     //         // Update the addedNeedsImages array
//     //         var sourceIndex = addedNeedsImages.indexOf(sourceImage.attr("src"));
//     //         var targetIndex = addedNeedsImages.indexOf(targetImage.attr("src"));

//     //         if (sourceIndex !== -1 && targetIndex !== -1) {
//     //             var tempImage = addedNeedsImages[sourceIndex];
//     //             addedNeedsImages[sourceIndex] = addedNeedsImages[targetIndex];
//     //             addedNeedsImages[targetIndex] = tempImage;
//     //         }
//     //     }
//     // });
    
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