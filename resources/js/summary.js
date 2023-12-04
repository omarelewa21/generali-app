// Array of specific page URLs where the script should run
const specificPageURLs = [
    'financial-statement/monthly-goals'
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

}