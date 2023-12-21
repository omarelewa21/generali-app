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
import './summary';
import 'jquery-ui-dist/jquery-ui';
import './drag-drop';
import 'bootstrap5-toggle';
import './phoneValidation';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-select-bs5';
import 'datatables.net-buttons-dt';
import 'datatables.net-searchbuilder-bs5';
import 'datatables.net-datetime';

// Declare Datatables for sorting
$(document).ready(function () {
    $('#dataTable').DataTable({
        language: {
            search: `<svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>`,
            searchPlaceholder: 'Search...',
            searchBuilder: {
                button: 'Advanced Search',
                add: 'Add Condition',
                clearAll: 'Clear All',
                condition: 'Condition',
                data: 'Data',
                deleteTitle: 'Delete filtering rule',
                logicAnd: 'AND',
                logicOr: 'OR',
                title: {
                    _: 'Advanced Search',
                    0: 'Advanced Search'
                },
            }
        },
        responsive: false,
        autoWidth: true,
        scrollCollapse: true,
        scrollY: false,
        scrollX: '1054px',
        columnDefs: [
            { width: '15%', targets: 0 },
            { width: '18%', targets: 1 },
            { width: '19%', targets: 2 },
            { width: '12%', targets: 3 },
            { width: '14%', targets: 4 },
            { width: '13%', targets: 5 },
            { width: '20%', targets: 6, orderable: false },
        ],
        dom: '<"top"Bf>rt<"bottom"ip>',
        buttons: [{
            extend: 'searchBuilder',
            className: 'btn btn-secondary fw-bold btn-sm',
        }],
        initComplete: function () {
            var tableWidth = $('.dataTables_scrollHeadInner');
            var dataTable = $('.dataTables_scrollHeadInner .dataTable');
            var tableBody = $('.dataTables_scrollBody .dataTable');

            tableWidth.css('min-width', '1054px');
            dataTable.css('min-width', '1054px');
            tableBody.css('min-width', '1054px');
        },
    });

    $('#agentTable').DataTable({
        responsive: false,
        autoWidth: true,
        paging: true,
        searching: false,
        ordering: true,
        lengthChange: false,
        pageLength: 10,
        columnDefs: [
            { width: '15%', targets: 0 },
            { width: '26%', targets: 1 },
            { width: '19%', targets: 2 },
            { width: '20%', targets: 3 },
            { width: '13%', targets: 4, orderable: false },
            { width: '7%', targets: 5, orderable: false },
        ],
        scrollCollapse: true,
        scrollY: false,
        scrollX: '1054px',
        initComplete: function () {
            // var table = this.api();
            var container = $('#agentTable_wrapper');
            var tableWidth = $('.dataTables_scrollHeadInner');
            var dataTable = $('.dataTables_scrollHeadInner .dataTable');
            var tableBody = $('.dataTables_scrollBody .dataTable');

            tableWidth.css('min-width', '1054px');
            dataTable.css('min-width', '1054px');
            tableBody.css('min-width', '1054px');
        }
    });
});

// Remove class 'overflow' to <body> tag
$(document).ready(function () {
    // Detect the element with id
    var login = $('#login');
    var home = $('#home');
    var avatar_welcome = $('#avatar_welcome');
    var protection_home = $('#protection_home');
    var retirement_home = $('#retirement_home');
    var savings_home = $('#savings_home');
    var investment_home = $('#investment_home');
    var health_home = $('#health-medical_home');
    var debt_home = $('#debt-cancellation_home');
    var education_home = $('#education_home');

    // Check if the element exists on the page
    if (home.length === 1 || avatar_welcome.length === 1 || protection_home.length === 1 || retirement_home.length === 1 || education_home.length === 1 || savings_home.length === 1 || investment_home.length === 1 || health_home.length === 1 || debt_home.length === 1 || login.length === 1) {
        // If it exists, remove the 'overflow' class to the body
        $('body').removeClass('overflow');
    }
});

// Mobile Responsive Mobile Menu
var scroll_top = 0;

function navbar_scroll() {
    var last_scroll_top = 0;

    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop(); // Update the global variable scroll_top
        if (scroll_top === 0) {
            $('.navbar-scroll').removeClass('scrolled-up');
        } else if (scroll_top > 50) {
            if(scroll_top < last_scroll_top) {
                $('.navbar-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            } else {
                $('.navbar-scroll').removeClass('scrolled-up').addClass('scrolled-down');
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
            if (scroll_top < last_scroll_top || scroll_top === scroll_bottom) {
                $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            } else {
                $('.footer-scroll').removeClass('scrolled-up').addClass('scrolled-down');
            }
        } else {
            $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        }
        last_scroll_top = scroll_top;
    });

    function hasParallaxSectionClass() {
        return document.querySelector('.parallax-section') !== null;
    }

    if (hasParallaxSectionClass()) {
        // Create an intersection observer
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // The observed element is now in view
                    $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
                    $('.navbar-scroll').removeClass('scrolled-down').addClass('scrolled-up');
                }
                else {
                    // The observed element is not in view
                    $('.footer-scroll').removeClass('scrolled-up').addClass('scrolled-down');
                    $('.navbar-scroll').removeClass('scrolled-up').addClass('scrolled-down');
                }
            });
        });

        const bottomObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    $('.footer-scroll').removeClass('scrolled-down').addClass('scrolled-up');
                }
                else {
                    $('.footer-scroll').removeClass('scrolled-up').addClass('scrolled-down');
                }
            });
        });
        
        const targetElement = document.querySelector('.parallax-inner.parallax-top');
        const bottomElement = document.querySelector('.bottomObeserver');

        // Start observing the target element
        observer.observe(targetElement);
        bottomObserver.observe(bottomElement);
    }
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
