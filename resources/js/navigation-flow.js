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
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const currentPath = url.pathname;

    $(document).ready(function () {

        // Define an array of step paths that should be marked as active
        let allFieldsFilled = [];

        $.ajax({
            url: '/getSessionData',
            method: 'GET',
            success: function(response) {
                var customer_details = response.customer_details;
                sessionDetails(customer_details);

                $('.timeline-item').each(function (index) {
                    var itemURL = $(this).find('a').attr('href');
                    var urlObject = new URL(itemURL);
                    var itemPath = urlObject.pathname;

                    if (allFieldsFilled.includes(itemPath)) {
                        $(this).addClass('active');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        function sessionDetails(customer_details) {
            
            if (customer_details.basic_details) {
                allFieldsFilled.push('/basic-details');
            }
            
            if (customer_details.avatar) {
                allFieldsFilled.push('/avatar');
            }

            if (customer_details.identity_details) {
                var filled = false;
            
                for (var key in customer_details.identity_details) {
                    if (customer_details.identity_details.hasOwnProperty(key) && key !== 'marital_status' && (customer_details.identity_details[key] === null || customer_details.identity_details[key] === '')) {
                        filled = true;
                        break;
                    }
                }

                if (customer_details.identity_details && filled == true) {
                    allFieldsFilled.push('/identity-details');
                }
            }

            if (customer_details.family_details) {
                var spouse_data = customer_details.family_details.dependant.spouse_data
                var children_data = customer_details.family_details.dependant.children_data
                var parents_data = customer_details.family_details.dependant.parents_data
                var siblings_data = customer_details.family_details.dependant.siblings_data

                if (spouse_data || children_data || parents_data || siblings_data) {
                    allFieldsFilled.push('/family-dependant');
                }
            }
    
            let assets_fields = JSON.parse(localStorage.getItem('visitedPaths')) || [];

            if (currentPath === '/assets') {
                localStorage.setItem('visitedPaths', JSON.stringify('/assets'));
            }

            if (assets_fields === '') {
                allFieldsFilled.push('/assets');
            }
        }

        // if (basic_details !== null) {
        //     let basic_details_fields = '/basic-details';
        //     allFieldsFilled.push(basic_details_fields);
        // }
        // if (path == '/basic-details') {
        //     if (basic_details !== null) {
        //         let basic_details_fields = '/basic-details';
        //         allFieldsFilled.push(basic_details_fields);
        //     }
        // }
        // else if (path == '/welcome') {
        //     if (avatar) {
        //         let avatar_fields = '/avatar';
        //         allFieldsFilled.push(avatar_fields);
        //     }
        // }

        // localStorage.setItem('allFieldsFilled', JSON.stringify(allFieldsFilled));

        // let assets_fields = JSON.parse(localStorage.getItem('visitedPaths')) || [];
        // const visitedPaths = JSON.parse(localStorage.getItem('visitedPaths')) || [];


        
        

        

        
        // if (assets_fields !== null) {
        //     console.log('yup');
            
        // }

        // if (basic_details) {
        //     if (!visitedPaths.includes('/basic-details')) {
        //         visitedPaths.push('/basic-details');
        //         localStorage.setItem('visitedPaths', JSON.stringify(visitedPaths));
        //     }
        // }

        // console.log(visitedPaths);
        

        

        // if (avatar) {
        //     var avatar_fields = '/avatar'
        // }

        // if (identity_details) {
        //     var filled = false;
            
        //     for (var key in identity_details) {
        //         if (identity_details.hasOwnProperty(key) && key !== 'marital_status' && (identity_details[key] === null || identity_details[key] === '')) {
        //             filled = true;
        //             break;
        //         }
        //     }

        //     if (identity_details && filled == true) {
        //         var identity_details_fields = '/identity-details'
        //     }
        // }

        // if (family_details) {
        //     var spouse_data = family_details.spouse_data
        //     var children_data = family_details.children_data
        //     var parents_data = family_details.parents_data
        //     var siblings_data = family_details.siblings_data

        //     if (spouse_data || children_data || parents_data || siblings_data) {
        //         var family_details_fields = '/family-dependant'
        //     }
        // }

        // if (currentPath === '/assets') {            
        //     localStorage.setItem('visitedPaths', JSON.stringify('/assets'));
        //     // localStorage.removeItem('visitedPaths');

        // }

        // if(sessionData) {
        //     var priorities_fields = '/financial-priorities'
        // }
    
        // allFieldsFilled;
        
    
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