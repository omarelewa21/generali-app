const specificPageURLs = [
    'financial-priorities/discuss',
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
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
            window.location.href = '/financial-priorities';
        });
    
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure the first accordion item is always open
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            // Sent checkbox value to controller
            var checkboxValues = {};
    
            //Assign the needs sequence
            const contents = ['protection_discuss', 'retirement_discuss', 'education_discuss', 'savings_discuss', 'investments_discuss', 'health-medical_discuss', 'debt-cancellation_discuss'];
    
            // First set all to true
            $('input[type="checkbox"]').each(function() {
                var checkboxId = $(this).attr('id');
                if(priority){
                    for (var key in priority) {
                        var value = priority[key];
                        if (value === 'true') {
                            checkboxValues[key] = true;
                            $('#' + key).prop('checked', true);
                        }
                        else{
                            checkboxValues[key] = false;
                            $('#' + key).prop('checked', false);
                        }
                    }
                    var isChecked = $(this).prop('checked');
                    checkboxValues[checkboxId] = isChecked;
                    var droppedDiv = document.querySelectorAll('.dropped');
    
                    if (!isChecked) {
                        droppedDiv.forEach(function(element) {
                            var droppedAttribute = element.getAttribute("data-identifier");
                            var image = document.querySelector('img.' + droppedAttribute);
                            if (image && droppedAttribute + '_discuss' === checkboxId) {
                            // if (image) {
                                image.style.display = 'none';
                            }
                        });
                    }
                    else {
                        droppedDiv.forEach(function(element) {
                            var droppedAttribute = element.getAttribute("data-identifier");
                            var image = document.querySelector('img.' + droppedAttribute);
                            if (image && droppedAttribute + '_discuss' === checkboxId) {
                            // if (image) {
                                image.style.display = 'block';
                            }
                        });
                    }
                } else{
                    checkboxValues[checkboxId] = true;
                    $(this).prop('checked', true); // Check the checkboxes initially
                }
    
                for (const checkboxId of contents) {
                    if (checkboxValues[checkboxId] === true) {
                        // Assign link based on the sequence
                        if (checkboxId === 'protection_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/protection');
                            break;
                        }
                        else if (checkboxId === 'retirement_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/retirement');
                            break;
                        }
                        else if (checkboxId === 'education_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/education');
                            break;
                        }
                        else if (checkboxId === 'savings_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/savings');
                            break;
                        }
                        else if (checkboxId === 'investments_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/investment');
                            break;
                        }
                        else if (checkboxId === 'health-medical_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/health-medical');
                            break;
                        }
    
                        else {
                            document.getElementById('priorityNext').setAttribute('href', '/debt-cancellation');
                            break;
                        }
                    }
                }
            });
    
            // Update checkboxValues object when any checkbox is changed
            $('input[type="checkbox"]').on('change', function() {
                var checkboxId = $(this).attr('id');
                
                var isChecked = $(this).prop('checked');
                checkboxValues[checkboxId] = isChecked;
                var droppedDiv = document.querySelectorAll('.dropped');
    
                if (!isChecked) {
                    droppedDiv.forEach(function(element) {
                        var droppedAttribute = element.getAttribute("data-identifier");
                        var image = document.querySelector('img.' + droppedAttribute);
                        if (image && droppedAttribute + '_discuss' === checkboxId) {
                        // if (image) {
                            image.style.display = 'none';
                        }
                    });
                }
                else {
                    droppedDiv.forEach(function(element) {
                        var droppedAttribute = element.getAttribute("data-identifier");
                        var image = document.querySelector('img.' + droppedAttribute);
                        if (image && droppedAttribute + '_discuss' === checkboxId) {
                        // if (image) {
                            image.style.display = 'block';
                        }
                    });
                }
    
                // Get the list of unchecked checkboxes
                const uncheckedCheckboxes = contents.filter(checkboxId => checkboxValues[checkboxId] === false);
    
                // Check if there are unchecked checkboxes
                if (uncheckedCheckboxes.length > 0) {
                    // Iterate through the sequence of content checkboxes
                    for (const checkboxId of contents) {
                        // Check if the current checkbox is unchecked
                        if (checkboxValues[checkboxId] === true) {
                            // Check the sequence and redirect accordingly
                            if (checkboxId === 'protection_discuss') {
                                document.getElementById('priorityNext').setAttribute('href', '/protection")');
                                break;
                            }
                            else if (checkboxId === 'retirement_discuss') {
                                document.getElementById('priorityNext').setAttribute('href', '/retirement');
                                break;
                            }
                            else if (checkboxId === 'education_discuss') {
                                document.getElementById('priorityNext').setAttribute('href', '/education');
                                break;
                            }
                            else if (checkboxId === 'savings_discuss') {
                                document.getElementById('priorityNext').setAttribute('href', '/savings');
                                break;
                            }
                            else if (checkboxId === 'investments_discuss') {
                                document.getElementById('priorityNext').setAttribute('href', '/investment');
                                break;
                            }
                            else if (checkboxId === 'health-medical_discuss') {
                                document.getElementById('priorityNext').setAttribute('href', '/health-medical');
                                break;
                            }
    
                            else {
                                document.getElementById('priorityNext').setAttribute('href', '/debt-cancellation');
                                break;
                            }
                            // Break out of the loop once the first unchecked checkbox is handled
                            break;
                        }
                    }
                } else {
                    // Handle the case where no checkboxes are unchecked
                }
            });
    
            $('#priorityNext').on('click', function(event) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('priorities.redirect') }}",
                    data: checkboxValues,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle success, if needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error, if needed
                    }
                });
            });
        });
    }
}