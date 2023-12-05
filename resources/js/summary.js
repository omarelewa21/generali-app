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

    if (path == '/financial-statement/increment-amount') {
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