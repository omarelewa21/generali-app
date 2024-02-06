// Array of specific page URLs where the script should run
const specificPageURLs = [
    'financial-statement/monthly-goals',
    'financial-statement/expected-income',
    'financial-statement/increment-amount'
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    
    if (path == '/financial-statement/monthly-goals') {
        var financialStatementMonthlySupport = document.getElementById('financial_statement_monthly_support');
        financialStatementMonthlySupport.addEventListener("input", function() {
            // Retrieve the current input value
            var financialStatementMonthlySupportValue = financialStatementMonthlySupport.value;
    
            // Remove non-digit characters
            const cleanedValue = parseFloat(financialStatementMonthlySupportValue.replace(/\D/g, ''));

            if (!isNaN(cleanedValue)) {
                // If it's a valid number, format it with commas
                const formattedValue = cleanedValue.toLocaleString('en-MY');
                this.value = formattedValue;
            } else{
                this.value = financialStatementMonthlySupportValue;
            }
        });
        
    }
    if (path == '/financial-statement/expected-income') {
        if (lastPageInput == null || lastPageInput == undefined || lastPageInput == '') {
            var nameModal = document.getElementById('missingLastPageInputFields');
            nameModal.classList.add('show');
            nameModal.style.display = 'block';
            document.querySelector('body').style.paddingRight = '0px';
            document.querySelector('body').style.overflow = 'hidden';
            document.querySelector('body').classList.add('modal-open');
    
            var modalBackdrop = document.createElement('div');
            modalBackdrop.className = 'modal-backdrop fade show';
            document.querySelector('body.modal-open').append(modalBackdrop);
    
            // Close the modal
            var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
            closeButton.addEventListener('click', function() {
                nameModal.classList.remove('show');
                nameModal.style.display = 'none';
                document.querySelector('body').style.paddingRight = '';
                document.querySelector('body').style.overflow = '';
                document.querySelector('body').classList.remove('modal-open');
                var modalBackdrop = document.querySelector('.modal-backdrop');
                if (modalBackdrop) {
                    modalBackdrop.remove();
                }
                window.location.href = '/financial-statement/monthly-goals';
            });
    
        } else{
            // Add event listener to each button with the 'data-required' attribute
            const dataButtons = document.querySelectorAll('[data-avatar]');

            dataButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default behavior of the button click

                    dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                    // Add 'selected' attribute to the clicked button
                    this.setAttribute('data-required', 'selected');

                    dataButtons.forEach(btn => btn.classList.remove('selected'));

                    // Get the selected data-avatar value
                    const dataAvatar = this.getAttribute('data-avatar');

                    // Update the hidden input field value with the selected avatar
                    document.getElementById('selectedExpectingInput').value = dataAvatar;
                });
            });

            // Preselect the button on page load
            window.addEventListener('DOMContentLoaded', function() {
                const defaultBtn = document.querySelectorAll('.default');

                defaultBtn.forEach(defaultBtn => {
                    // Add the 'selected' class to the closest .button-bg div of each default button
                    defaultBtn.classList.add('selected');
                });
            });
        }
    }

    if (path == '/financial-statement/increment-amount') {
        if (lastPageInput == null || lastPageInput == undefined || lastPageInput == '') {
            var nameModal = document.getElementById('missingLastPageInputFields');
            nameModal.classList.add('show');
            nameModal.style.display = 'block';
            document.querySelector('body').style.paddingRight = '0px';
            document.querySelector('body').style.overflow = 'hidden';
            document.querySelector('body').classList.add('modal-open');
    
            var modalBackdrop = document.createElement('div');
            modalBackdrop.className = 'modal-backdrop fade show';
            document.querySelector('body.modal-open').append(modalBackdrop);
    
            // Close the modal
            var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
            closeButton.addEventListener('click', function() {
                nameModal.classList.remove('show');
                nameModal.style.display = 'none';
                document.querySelector('body').style.paddingRight = '';
                document.querySelector('body').style.overflow = '';
                document.querySelector('body').classList.remove('modal-open');
                var modalBackdrop = document.querySelector('.modal-backdrop');
                if (modalBackdrop) {
                    modalBackdrop.remove();
                }
                window.location.href = '/financial-statement/expected-income';
            });
    
        } else if (lastPageInput != 'Yes') {
            var nameModal = document.getElementById('missingYesInputFields');
            nameModal.classList.add('show');
            nameModal.style.display = 'block';
            document.querySelector('body').style.paddingRight = '0px';
            document.querySelector('body').style.overflow = 'hidden';
            document.querySelector('body').classList.add('modal-open');
    
            var modalBackdrop = document.createElement('div');
            modalBackdrop.className = 'modal-backdrop fade show';
            document.querySelector('body.modal-open').append(modalBackdrop);
    
            // Close the modal
            var closeButton = document.querySelector('#missingYesInputFields .btn-exit-sidebar');
            closeButton.addEventListener('click', function() {
                nameModal.classList.remove('show');
                nameModal.style.display = 'none';
                document.querySelector('body').style.paddingRight = '';
                document.querySelector('body').style.overflow = '';
                document.querySelector('body').classList.remove('modal-open');
                var modalBackdrop = document.querySelector('.modal-backdrop');
                if (modalBackdrop) {
                    modalBackdrop.remove();
                }
                window.location.href = '/financial-statement/expected-income';
            });
    
        } else {
            var approximateIncrementAmount = document.getElementById('approximate_increment_amount');
            approximateIncrementAmount.addEventListener("input", function() {
                // Retrieve the current input value
                var approximateIncrementAmountValue = approximateIncrementAmount.value;
        
                // Remove non-digit characters
                const cleanedValue = parseFloat(approximateIncrementAmountValue.replace(/\D/g, ''));

                if (!isNaN(cleanedValue)) {
                    // If it's a valid number, format it with commas
                    const formattedValue = cleanedValue.toLocaleString('en-MY');
                    this.value = formattedValue;
                } else{
                    this.value = approximateIncrementAmountValue;
                }
            });
        }
    }
}