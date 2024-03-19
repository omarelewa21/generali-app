const specificPageURLs = [
    'financial-priorities/discuss',
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.includes(specificPageURLs))) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const urlParams = new URLSearchParams(window.location.search);
    const paramValue = urlParams.get('transaction_id');

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
            window.location.href = '/financial-priorities?transaction_id='+paramValue;
        });
    } else {
        // Sent checkbox value to controller
        var checkboxValues = {};

        //Assign the needs sequence
        const contents = ['protection_discuss', 'retirement_discuss', 'education_discuss', 'savings_discuss', 'investments_discuss', 'health-medical_discuss', 'debt-cancellation_discuss', 'others'];

        const discussContent = ['protection_discuss', 'retirement_discuss', 'education_discuss', 'savings_discuss', 'investments_discuss', 'health-medical_discuss', 'debt-cancellation_discuss', 'others_discuss'];

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
                    else if (checkboxId === 'debt-cancellation_discuss') {
                        document.getElementById('priorityNext').setAttribute('href', '/debt-cancellation');
                        break;
                    }
                    else {
                        document.getElementById('priorityNext').setAttribute('href', '/existing-policy');
                        break;
                    }
                } else{
                    document.getElementById('priorityNext').setAttribute('href', '/financial-statement/monthly-goals');
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
                        else if (checkboxId === 'debt-cancellation_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/debt-cancellation');
                            break;
                        }
                        else {
                            document.getElementById('priorityNext').setAttribute('href', '/existing-policy');
                            break;
                        }
                    } else{
                        document.getElementById('priorityNext').setAttribute('href', '/financial-statement/monthly-goals');
                    }
                }
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
                            document.getElementById('priorityNext').setAttribute('href', '/protection');
                            break;
                        } else if (checkboxId === 'retirement_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/retirement');
                            break;
                        } else if (checkboxId === 'education_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/education');
                            break;
                        } else if (checkboxId === 'savings_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/savings');
                            break;
                        } else if (checkboxId === 'investments_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/investment');
                            break;
                        } else if (checkboxId === 'health-medical_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/health-medical');
                            break;
                        } else if (checkboxId === 'debt-cancellation_discuss') {
                            document.getElementById('priorityNext').setAttribute('href', '/debt-cancellation');
                            break;
                        } else{
                            document.getElementById('priorityNext').setAttribute('href', '/existing-policy');
                            break;
                        }
                        // Break out of the loop once the first unchecked checkbox is handled
                        break;
                    } else{
                        document.getElementById('priorityNext').setAttribute('href', '/financial-statement/monthly-goals');
                    }
                }
            } else {
                // Handle the case where no checkboxes are unchecked
            }

            var allFalse = true;
            var allChecked = true;
            discussContent.forEach(function(checkboxId) {
                if ($('#' + checkboxId).prop('checked')) {
                    allFalse = false;
                    return false;
                }
                if (!$('#' + checkboxId).length || !$('#' + checkboxId).prop('checked')) {
                    allChecked = false;
                    return false; // Break out of the loop if any checkbox is missing or unchecked
                }
            });

            var choiceValue = '';
            // If all _discuss checkboxes are false, do something
            if (allFalse) {
                $('#discuss_error').removeClass('d-none'); 
                $('#priorityNext').attr('href', '#');
            } else{
                $('#discuss_error').addClass('d-none'); 

            }
            // If all checkboxes exist and are checked
            if (allChecked) {
                choiceValue = 1;
            } else{
                choiceValue = 2;
            }
        });
        
        $('#priorityNext').on('click', function(event) {
            var allChecked = true;
            discussContent.forEach(function(checkboxId) {
                if (!$('#' + checkboxId).length || !$('#' + checkboxId).prop('checked')) {
                    allChecked = false;
                    return false; // Break out of the loop if any checkbox is missing or unchecked
                }
            });

            var choiceValue = '';
            // If all checkboxes exist and are checked
            if (allChecked) {
                choiceValue = 1;
            } else{
                choiceValue = 2;
            }
            var requestData = {
                choice: choiceValue, 
                checkboxValues: checkboxValues 
            };
            console.log(requestData);

            $.ajax({
                type: "POST",
                url: "/financial-priorities/discuss",
                data: requestData,
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
    }
}