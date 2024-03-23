import './bootstrap';
import './navigation-flow';
import './height-controller';
import './button';
import './button-multiple-select';
import './avatar';
import './form-display';
import './button-avatar-display';
import './carousel-needs';
import './needs';
import './protection-validation';
import './retirement-validation';
import './education-validation';
import './savings-validation';
import './investment-validation';
import './risk-profile';
import './health-medical-validation';
import './debt-cancellation-validation';
import './summary';
import 'jquery-ui-dist/jquery-ui';
import './drag-drop';
import 'bootstrap5-toggle';
import './phoneValidation';
import './datatables';
import 'laravel-datatables-vite';
import './sortable';
import './priorities';

// Remove class 'overflow' to <body> tag
$(document).ready(function () {
    // Detect the element with id
    var login = $('#login');
    var home = $('#home');
    var pdpa = $('#pdpa');
    var avatar_welcome = $('#avatar_welcome');
    var protection_home = $('#protection_home');
    var retirement_home = $('#retirement_home');
    var savings_home = $('#savings_home');
    var investment_home = $('#investment_home');
    var health_home = $('#health-medical_home');
    var debt_home = $('#debt-cancellation_home');
    var education_home = $('#education_home');
    var summary = $('#summary');

    // Check if the element exists on the page
    if (avatar_welcome.length === 1 || protection_home.length === 1 || retirement_home.length === 1 || education_home.length === 1 || savings_home.length === 1 || investment_home.length === 1 || health_home.length === 1 || debt_home.length === 1 || login.length === 1) {
        // If it exists, remove the 'overflow' class to the body
        $('body').removeClass('overflow');
    }
});

// Mobile Responsive Mobile Menu
var scroll_top = 0;

function navbar_scroll() {
    var last_scroll_top = 0;
    var scroll_bottom = $(document).height() - $(window).height();

    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop();

        if (scroll_top === 0) {
            $('.navbar-scroll').removeClass('scrolled-up');
        } else if (scroll_top > 50) {
            if(scroll_top < last_scroll_top || scroll_top >= scroll_bottom) {
                $('.navbar-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            } else {
                var scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (scrollableHeight <= scroll_top) {
                    $('.navbar-scroll').removeClass('scrolled-down').addClass('scrolled-up');
                }
                else {
                    $('.navbar-scroll').removeClass('scrolled-up').addClass('scrolled-down');
                }
            }
        } else {
            $('.navbar-scroll').removeClass('scrolled-down');
        }

        last_scroll_top = scroll_top;
    });
}

function footer_scroll() {
    var last_scroll_top = 0;
    var scroll_bottom = $(document).height() - $(window).height();

    $(window).on('scroll', function() {
        var scroll_top = $(this).scrollTop();

        if (scroll_top > 50) {
            if (scroll_top < last_scroll_top || scroll_top >= scroll_bottom) {
                $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            } else {
                var scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (scrollableHeight <= scroll_top) {
                    $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
                }
                else {
                    $('.footer-scroll').removeClass('scrolled-up').addClass('scrolled-down');
                }
            }
        } else {
            $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        }

        last_scroll_top = scroll_top;
    });
}

$(document).ready(function () {
    if (window.matchMedia("(max-width: 767px)").matches) {
        navbar_scroll();
        footer_scroll();
    }

    // JavaScript to prevent pinch-to-zoom, double-tap-to-zoom, and viewport scaling on iOS
    document.addEventListener('gesturestart', function (e) {
        e.preventDefault();
    });

    document.addEventListener('dblclick', function (e) {
        e.preventDefault();
    });
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