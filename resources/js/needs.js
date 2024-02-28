// Array of specific folder names where the script should run
const specificPageURLs = [
    'protection',
    'retirement',
    'education',
    'savings',
    'investment',
    'health-medical',
    'debt-cancellation',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    // if (needs_priority && needs_priority === 'false' || !needs_priority) {
        console.log(needs_priority);
    if (needs_priority && needs_priority === 'false' || !needs_priority) {
        var missingModal = document.getElementById('missingNeedsFields');
        missingModal.classList.add('show');
        missingModal.style.display = 'block';
        document.querySelector('body').style.paddingRight = '0px';
        document.querySelector('body').style.overflow = 'hidden';
        document.querySelector('body').classList.add('modal-open');

        var modalBackdrop = document.createElement('div');
        modalBackdrop.className = 'modal-backdrop fade show';
        document.querySelector('body.modal-open').append(modalBackdrop);

        // Close the modal
        var closeButton = document.querySelector('#missingNeedsFields .btn-exit-sidebar');
        closeButton.addEventListener('click', function() {
            missingModal.classList.remove('show');
            missingModal.style.display = 'none';
            document.querySelector('body').style.paddingRight = '';
            document.querySelector('body').style.overflow = '';
            document.querySelector('body').classList.remove('modal-open');
            var modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
            window.location.href = '/financial-priorities/discuss';
        });
    }
}