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
    'assets',
    'financial-priorities'
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

                if (spouse_data && spouse_data.full_name || children_data && children_data.full_name || parents_data &&  parents_data.full_name || siblings_data && siblings_data.full_name) {
                    allFieldsFilled.push('/family-dependant');
                }
            }
    
            let assets_fields = JSON.parse(localStorage.getItem('visitedPaths')) || [];

            if (currentPath === '/assets') {
                localStorage.setItem('visitedPaths', JSON.stringify('/assets'));
            }

            if (assets_fields === '/assets') {
                allFieldsFilled.push('/assets');
            }

            if (customer_details.financial_priorities) {
                allFieldsFilled.push('/financial-priorities');
            }
        }
    });
}