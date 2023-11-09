// Left Offcanvas Navigation
$(document).ready(function () {
    // Get the current URL path
    var currentPath = window.location.pathname;

    // Define an array of step paths that should be marked as active with /gender
    var myAvatar = ['/basic-details', '/gender'];
    var myDetails = ['/basic-details', '/gender' , '/identity-details'];
    var myFamily = ['/basic-details', '/gender' , '/identity-details' , '/family-dependant'];
    var myAssets = ['/basic-details', '/gender' , '/identity-details' , '/family-dependant' , '/assets'];
    var myPriorities = ['/basic-details', '/gender' , '/identity-details' , '/family-dependant' , '/assets' , '/top-priorities'];
    var existingPolicies = ['/basic-details', '/gender' , '/identity-details' , '/family-dependant' , '/assets' , '/top-priorities' , 'existing-policies'];
    var summary = ['/basic-details', '/gender' , '/identity-details' , '/family-dependant' , '/assets' , '/top-priorities' , 'existing-policies' , 'summary'];

    // Find all the timeline items and iterate through them
    $('.timeline-item').each(function (index) {
        // Get the URL of the timeline item
        var itemURL = $(this).find('a').attr('href');

        // Create a URL object to parse the full URL
        var urlObject = new URL(itemURL);

        // Get only the path from the URL object
        var itemPath = urlObject.pathname;

        // Check if the current page is /welcome and if the item is in the genderSteps array
        if (currentPath === '/welcome' && myAvatar.includes(itemPath)) {
            $(this).addClass('active');

        } else if(currentPath === '/marital-status' && myDetails.includes(itemPath)) {
            $(this).addClass('active');

        } else if(currentPath === '/family-dependant-details' && myFamily.includes(itemPath)) {
            $(this).addClass('active');

        } else if(currentPath === '/priorities-to-discuss' && myPriorities.includes(itemPath)) {
            $(this).addClass('active');

        } else if (itemPath === currentPath) {
            $(this).addClass('active');

            // Also mark all previous steps as active
            for (var i = 0; i < index; i++) {
                $('.timeline-item:eq(' + i + ')').addClass('active');
            }
        }  else if (currentPath !== '/welcome'&& currentPath !== '/marital-status' && currentPath !== '/family-dependant-details' && currentPath !== '/priorities-to-discuss' && !myPriorities.includes(currentPath) && myPriorities.includes(itemPath)) {
            $(this).addClass('active');
        }
    });
});