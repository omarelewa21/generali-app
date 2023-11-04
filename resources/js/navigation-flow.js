// Left Offcanvas Navigation
$(document).ready(function () {
    // Get the current URL path
    var currentPath = window.location.pathname;

    // Define an array of step paths that should be marked as active
    var allFieldsFilled = allFieldsFilled || [];

    $('.timeline-item').each(function (index) {

        // Get the URL of the timeline item
        var itemURL = $(this).find('a').attr('href');
        var urlObject = new URL(itemURL);
        var itemPath = urlObject.pathname;

        if (customer_details && customer_details.basic_details) {
            var fields = customer_details.basic_details
            
            if (fields) {
                allFieldsFilled.push('/basic-details');
            }
        }

        if (customer_details && customer_details.avatar) {
            var fields = customer_details.avatar
            
            if (fields) {
                allFieldsFilled.push('/avatar');
            }
        }

        if (customer_details && customer_details.identity_details) {
            var fields = customer_details.identity_details
            var filled = false;
            
            for (var key in fields) {
                if (fields.hasOwnProperty(key) && key !== 'marital_status' && (fields[key] === null || fields[key] === '')) {
                    filled = true;
                    break;
                }
            }

            if (fields && filled == true) {
                allFieldsFilled.push('/identity-details');
            }
        }

        if (customer_details && customer_details.family_details) {
            var spouse_data = customer_details.family_details.dependant.spouse_data
            var children_data = customer_details.family_details.dependant.children_data
            var parents_data = customer_details.family_details.dependant.parents_data
            
            if (spouse_data || children_data || parents_data) {
                allFieldsFilled.push('/family-dependant');
            }
        }

        if (customer_details && customer_details.financial_priorities) {
            var fields = customer_details.financial_priorities
            
            if (fields) {
                allFieldsFilled.push('/financial-priorities');
            }
        }

        if (allFieldsFilled.includes(itemPath)) {
            $(this).addClass('active');
        }
        else {
            $('#assets.timeline-item').addClass('active');
        }
        // Check if the current page is /welcome and if the item is in the genderSteps array
        // if (currentPath === '/basic-details') {
            
        // }
        // else if(currentPath === '/marital-status' && myDetails.includes(itemPath)) {
        //     console.log('yes');
        //     $(this).addClass('active');

        // } else if(currentPath === '/family-dependant/details' && myFamily.includes(itemPath)) {
        //     $(this).addClass('active');

        // } else if(currentPath === '/priorities-to-discuss' && myPriorities.includes(itemPath)) {
        //     $(this).addClass('active');

        // } 
        // else if (itemPath === currentPath) {
        //     $(this).addClass('active');

        //     // Also mark all previous steps as active
        //     for (var i = 0; i < index; i++) {
        //         $('.timeline-item:eq(' + i + ')').addClass('active');
        //     }
        // }  else if (currentPath !== '/welcome'&& currentPath !== '/marital-status' && currentPath !== '/family-dependant/details' && currentPath !== '/priorities-to-discuss' && !myPriorities.includes(currentPath) && myPriorities.includes(itemPath)) {
        //     $(this).addClass('active');
        // }
    });
    
});