import './bootstrap';
import './navigation-flow';
import './height-controller';
import './button';
import './button-multiple-select';
import './avatar';
import './form-display';
import './button-avatar-display';
import './button-avatar-display';
import './coverage-carousel';
import './carousel-needs';
import './protection-validation';
import './retirement-validation';
import './education-validation';
import './savings-validation';
import './investment-validation';
import 'jquery-ui-dist/jquery-ui';
import './drag-drop';

// $('.toast').toast('show');
// $('.tooltip').tooltip('show');

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
