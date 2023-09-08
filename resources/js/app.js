import './bootstrap';
$('.toast').toast('show');
$('.tooltip').tooltip('show');

import './height-controller';
import './button';
import './button-multiple-select';
import './avatar';
import './form-display';
import './coverage-carousel';
import './drag-drop';
import './navigation-flow';
import './button-avatar-display';

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
