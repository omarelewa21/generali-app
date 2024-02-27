// Array of specific folder names where the script should run
const specificPageURLs = [
    '/risk-profile',
];

// Get the current URL
const currentURL = window.location.href;

// Check if the current URL contains any of the specific folder names
if (specificPageURLs.some(folderName => currentURL.includes(folderName))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;
    console.log(savingsPriority);
    console.log(investmentPriority);
    if (!(savingsPriority === 'true' || investmentPriority === 'true')){
        var missingModal = document.getElementById('missingRiskProfileFields');
        missingModal.classList.add('show');
        missingModal.style.display = 'block';
        document.querySelector('body').style.paddingRight = '0px';
        document.querySelector('body').style.overflow = 'hidden';
        document.querySelector('body').classList.add('modal-open');

        var modalBackdrop = document.createElement('div');
        modalBackdrop.className = 'modal-backdrop fade show';
        document.querySelector('body.modal-open').append(modalBackdrop);

        // Close the modal
        var closeButton = document.querySelector('#missingRiskProfileFields .btn-exit-sidebar');
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

    } else{
        // Add event listener to each button with the 'data-required' attribute
        const dataButtons = document.querySelectorAll('[data-avatar]');
        const dataPotentialBtns = document.querySelectorAll('[data-risk]');
        var highRisk = document.getElementById("high-risk");
        var mediumRisk = document.getElementById("medium-risk");
        var lowRisk = document.getElementById("low-risk");
        var highRiskImg = document.getElementById("high-risk-img");
        var mediumRiskImg = document.getElementById("medium-risk-img");
        var lowRiskImg = document.getElementById("low-risk-img");
        var highPotentialReturn = document.getElementById("high-risk-potential-content");
        var mediumPotentialReturn = document.getElementById("medium-risk-potential-content");
        var lowPotentialReturn = document.getElementById("low-risk-potential-content");
        const dataSelected = document.querySelectorAll('.default');

        dataButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click

                // Remove 'data-required' from all elements with the class 'risk-profile-content'
                dataPotentialBtns.forEach(btn => {
                    btn.removeAttribute('data-required');
                });

                dataButtons.forEach(btn => btn.removeAttribute('data-required'));
                // Add 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');

                const selectedData = this.getAttribute('data-required');

                dataButtons.forEach(btn => btn.classList.remove('selected'));

                // Get the selected data-avatar value
                const dataAvatar = this.getAttribute('data-avatar');

                // Update the hidden input field value with the selected avatar
                document.getElementById('riskProfileInput').value = dataAvatar;

                const selectedPotential = document.getElementById('potentialReturnInput');

                if(selectedData === 'selected'){
                    switch(dataAvatar) {
                        case 'High Risk':
                            const selectedHighPR = highPotentialReturn.querySelector('#high-potential-return');
                            selectedHighPR.setAttribute('data-required', 'selected');
                            selectedPotential.value = 'High';
                            break;
                        case 'Medium Risk':
                            const selectedMediumPR = mediumPotentialReturn.querySelector('#medium-potential-return');
                            selectedMediumPR.setAttribute('data-required', 'selected');
                            selectedPotential.value = 'Medium';
                            break;
                        case 'Low Risk':
                            const selectedLowPR = lowPotentialReturn.querySelector('#low-potential-return');
                            selectedLowPR.setAttribute('data-required', 'selected');
                            selectedPotential.value = 'Low';
                            break;
                        default:
                            break;
                    }
                }
                
                // Check if the user selected a risk and remove the potential value if not
                // selectedPotential.value = '';
            });
        });

        dataPotentialBtns.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the button click

                dataPotentialBtns.forEach(btn => btn.removeAttribute('data-required'));
                // Add 'selected' attribute to the clicked button
                this.setAttribute('data-required', 'selected');

                dataPotentialBtns.forEach(btn => btn.classList.remove('selected'));

                // Get the selected data-avatar value
                const dataPotential = this.getAttribute('data-risk');

                // Update the hidden input field value with the selected avatar
                document.getElementById('potentialReturnInput').value = dataPotential;
            });
        });       

        // Preselect the button on page load
        window.addEventListener('DOMContentLoaded', function() {
            const defaultBtn = document.querySelectorAll('.default');

            defaultBtn.forEach(defaultBtn => {
                defaultBtn.classList.add('selected');
            });
        });

        $(document).ready(function () {
            if ($('.risk-btn.selected')){
                var selectedId = $('.risk-btn.selected').attr('id');
                document.getElementById(selectedId + "-img").style.display = "block";
                document.getElementById(selectedId + "-potential-content").style.display = "block";
            }
        });

        highRisk.onclick = function(){
            highRiskImg.style.display = "block";
            mediumRiskImg.style.display = "none";
            lowRiskImg.style.display = "none";
            highPotentialReturn.style.display ="block";
            mediumPotentialReturn.style.display = "none";
            lowPotentialReturn.style.display = "none";
        }
        mediumRisk.onclick = function(){
            mediumRiskImg.style.display = "block";
            highRiskImg.style.display = "none";
            lowRiskImg.style.display = "none";
            mediumPotentialReturn.style.display = "block";
            highPotentialReturn.style.display = "none";
            lowPotentialReturn.style.display = "none";
        }
        lowRisk.onclick = function(){
            lowRiskImg.style.display = "block";
            highRiskImg.style.display = "none";
            mediumRiskImg.style.display = "none";
            lowPotentialReturn.style.display = "block";
            highPotentialReturn.style.display = "none";
            mediumPotentialReturn.style.display = "none";
        }

        dataSelected.forEach(btnSelected => {
            highRiskImg.style.display = "none";
            mediumRiskImg.style.display = "none";
            lowRiskImg.style.display = "none";

            const defaultSelection = btnSelected.getAttribute('data-avatar');
            if (defaultSelection === 'High Risk') {
                highPotentialReturn.style.display = "block";
            } else if (defaultSelected === 'Medium Risk'){
                mediumPotentialReturn.style.display = "block";
            }
            else if (defaultSelected === 'Low Risk'){
                lowRiskImg.style.display = "block";
            }
        });

        const oldRiskLevel = document.getElementById('riskProfileInput').value;
        if (oldRiskLevel === 'High Risk') {
            highPotentialReturn.style.display = "block";
        } else if (oldRiskLevel === 'Medium Risk'){
            mediumPotentialReturn.style.display = "block";
        }
        else if (oldRiskLevel === 'Low Risk'){
            lowPotentialReturn.style.display = "block";
        }
    }
}