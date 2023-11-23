import './bootstrap';
import './navigation-flow';
import './height-controller';
import './button';
import './button-multiple-select';
import './avatar';
import './form-display';
import './button-avatar-display';
import './coverage-carousel';
import './carousel-needs';
import './protection-validation';
import './retirement-validation';
import './education-validation';
import './savings-validation';
import './investment-validation';
import './health-medical-validation';
import './debt-cancellation-validation';
import 'jquery-ui-dist/jquery-ui';
import './drag-drop';
import 'bootstrap5-toggle';
import './phoneValidation';

// Remove class 'overflow' to <body> tag
$(document).ready(function () {
    // Detect the element with id
    var home = $('#home');
    var avatar_welcome = $('#avatar_welcome');
    var protection_home = $('#protection_home');
    var savings_home = $('#savings_home');
    var investment_home = $('#investment_home');

    // Check if the element exists on the page
    if (home.length === 1 || avatar_welcome.length === 1 || protection_home.length === 1) {
        // If it exists, remove the 'overflow' class to the body
        $('body').removeClass('overflow');
    }
});

// Mobile Responsive Mobile Menu
var scroll_top = 0; // Declare scroll_top as a global variable

function navbar_scroll() {
    var last_scroll_top = 0;

    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop(); // Update the global variable scroll_top
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            if(scroll_top < last_scroll_top) {
                $('.navbar-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            } else {
                $('.navbar-scroll').removeClass('scrolled-up').addClass('scrolled-down');
            }
        } else {
            $('.navbar-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        }
        last_scroll_top = scroll_top;
    });
}

function footer_scroll() {
    var last_scroll_top = 0;

    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop(); // Update the global variable scroll_top
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            if(scroll_top < last_scroll_top) {
                $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            } else {
                $('.footer-scroll').removeClass('scrolled-up').addClass('scrolled-down');
            }
        } else {
            $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        }
        last_scroll_top = scroll_top;
    });
}

$(document).ready(function () {
    navbar_scroll();
    footer_scroll();
});

// Session Clear
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
