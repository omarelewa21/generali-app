// Left Offcanvas Navigation
// Array of specific page URLs where the script should run
const specificPageURLs = [
    'basic-details',
    '/welcome',
    '/avatar',
    '/identity-details',
    '/marital-status',
    'family-dependant',
    'family-dependant/details',
    'assets'
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    $(document).ready(function () {
        // Get the current URL path
        var currentPath = window.location.pathname;
    
        // Define an array of step paths that should be marked as active
        var allFieldsFilled = allFieldsFilled || [];

        if (basic_details) {
            var basic_details_fields = '/basic-details'
        }
        
        if (avatar) {
            var avatar_fields = '/avatar'
        }

        if (identity_details) {
            var filled = false;
            
            for (var key in identity_details) {
                if (identity_details.hasOwnProperty(key) && key !== 'marital_status' && (identity_details[key] === null || identity_details[key] === '')) {
                    filled = true;
                    break;
                }
            }

            if (identity_details && filled == true) {
                var identity_details_fields = '/identity-details'
            }
        }

        if (family_details) {
            var spouse_data = family_details.spouse_data
            var children_data = family_details.children_data
            var parents_data = family_details.parents_data

            if (spouse_data || children_data || parents_data) {
                var family_details_fields = '/family-dependant'
            }
        }

        if (currentPath == '/assets') {
            var assets_fields = [];
            assets_fields.push('/assets');
        }

        if (assets_fields == null) {
            allFieldsFilled.push(basic_details_fields, avatar_fields, identity_details_fields, family_details_fields, '/assets');
        }
    
        allFieldsFilled
        // console.log(allFieldsFilled);
    
        $('.timeline-item').each(function (index) {
    
            // Get the URL of the timeline item
            var itemURL = $(this).find('a').attr('href');
            var urlObject = new URL(itemURL);
            var itemPath = urlObject.pathname;
    
            // if (customer_details && customer_details.family_details) {
            //     var spouse_data = customer_details.family_details.dependant.spouse_data
            //     var children_data = customer_details.family_details.dependant.children_data
            //     var parents_data = customer_details.family_details.dependant.parents_data
                
            //     if (spouse_data || children_data || parents_data) {
            //         allFieldsFilled.push('/family-dependant');
            //     }
            // }
    
            // if (customer_details && customer_details.financial_priorities) {
            //     var fields = customer_details.financial_priorities
                
            //     if (fields) {
            //         allFieldsFilled.push('/financial-priorities');
            //     }
            // }
    
            if (allFieldsFilled.includes(itemPath)) {
                $(this).addClass('active');
            }
            else {
                //$('#assets.timeline-item').addClass('active');
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
}