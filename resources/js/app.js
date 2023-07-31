import './bootstrap';
import './height-controller';
import './button';
import './avatar';
import './form-display';
// import './sortable';


// Add checkmark for every page completed in left navigation menu
$(document).ready(function () {
  // Get the current URL path
  var currentPath = window.location.pathname;
  
  // Find all the timeline items and iterate through them
  $('.timeline-item').each(function () {
      // Get the URL of the timeline item
      var itemURL = $(this).find('a').attr('href');

      // Create a URL object to parse the full URL
      var urlObject = new URL(itemURL);

      // Get only the path from the URL object
      var itemPath = urlObject.pathname;

      // Check if the current URL matches the timeline item URL
      if (itemPath === currentPath) {
          // Add the checkmark (you can use a class or a style here)
          $(this).addClass('active'); // Add your CSS class here
      }
  });
});

// Close the Offcanvas sidebar when the modal is opened.
// Get the "EXIT" button element
const exitButton = document.querySelector('.btn-exit');

// Add a click event listener to the "EXIT" button
exitButton.addEventListener('click', function() {
    // Find the offcanvas element and remove the 'show' class
    const offcanvasElement = document.querySelector('.offcanvas');
    const offcanvasElementBackdrop = document.querySelector('.offcanvas-backdrop');
    offcanvasElement.classList.remove('show');
    offcanvasElementBackdrop.classList.remove('show');
});

