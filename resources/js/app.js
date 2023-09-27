import './bootstrap';
import './navigation-flow';
import './height-controller';
import './button';
import './button-multiple-select';
import './avatar';
import './form-display';
import './button-avatar-display';
import './coverage-carousel';
import 'jquery-ui-dist/jquery-ui';
import './drag-drop';
import 'bootstrap5-toggle';

// $('.toast').toast('show');
// $('.tooltip').tooltip('show');

// Add class 'overflow' to <body> tag
$(document).ready(function () {
    // Detect the element with id "home"
    var home = $('#home');

    // Check if the element exists on the page
    if (home.length === 0) {
        // If it exists, add the 'overflow' class to the body
        $('body').addClass('overflow');
    }
});

// Mobile Responsive Mobile Menu
$(document).ready(function () {
    // Function to check if the page is scrolled down
    function checkScroll() {
        var scrollPosition = $(window).scrollTop();
        var $header = $('.navbar-scroll'); // Select the header element

        if (scrollPosition > 0) {
            // Page is scrolled down
            $header.removeClass('scrolled-up');
            $header.addClass('scrolled-down');
        } else {
            // Page is at the top
            $header.removeClass('scrolled-down');
            $header.addClass('scrolled-up');
        }
    }

    // Attach the scroll event listener to the window
    $(window).on('scroll', checkScroll);

    // Call the function on page load
    checkScroll();
});

document.getElementById('saveSession').addEventListener('click', function() {
    var clearRoute = this.getAttribute('data-clear-route');

    $.ajax({
        url: clearRoute,
        method: "GET",
        success: function(response) {
            console.log("Session data cleared.");
            localStorage.clear();
        },
        error: function(xhr, status, error) {
            console.log("Error clearing session data:", error);
        }
    });
});
