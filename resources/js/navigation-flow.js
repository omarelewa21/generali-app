// Left Offcanvas Navigation
// Array of specific page URLs where the script should run
const specificPageURLs = [
    '/',
    '/login',
    '/agent',
    '/agent/logs',
    '/pdpa-disclosure'
];

const currentURL = window.location.href;

if (!specificPageURLs.some(url => currentURL.endsWith(url))) {
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
                    } else {
                        $(this).find('a').removeAttr('href');
                        $(this).find('a').addClass('disabled');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    
        function sessionDetails(customer_details) {
            if (!customer_details) return;
            
            if (customer_details.basic_details) {
                allFieldsFilled.push('/basic-details');
            }
            
            if (customer_details.avatar) {
                allFieldsFilled.push('/avatar');
            }

            if (customer_details.identity_details && (customer_details.identity_details.country || customer_details.identity_details.id_type || customer_details.identity_details.id_number || customer_details.identity_details.passport_number || customer_details.identity_details.birth_cert || customer_details.identity_details.police_number || customer_details.identity_details.registration_number || customer_details.identity_details.age || customer_details.identity_details.education_level || customer_details.identity_details.occupation || customer_details.identity_details.marital_status || customer_details.identity_details.habits)) {
                allFieldsFilled.push('/identity-details');
            }

            if (customer_details.identity_details && (customer_details.identity_details.marital_status == 'Single' || customer_details.identity_details.marital_status == 'Divorced' || customer_details.identity_details.marital_status == 'Widowed') && customer_details.family_details) {
                allFieldsFilled.push('/family-dependent');
            } else if (customer_details.identity_details && (customer_details.identity_details.marital_status == 'Married') && customer_details.family_details.spouse_data) {
                allFieldsFilled.push('/family-dependent');
            }

            if (customer_details.assets) {
                allFieldsFilled.push('/assets');
            }
            
            if (customer_details.priorities_level && customer_details.priorities_level.length > 0) {
                allFieldsFilled.push('/financial-priorities');
            }
        }
    });
}