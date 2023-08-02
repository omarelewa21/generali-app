@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default text-center">
        <div class="row bg-education vh-100">
            <section class="col-12 d-flex needs-coverage-nav">
                <!-- <div class="row"> -->
                    <div class="col-6">
                        @include('templates.nav.nav-red-menu')
                    </div>
                    <div class="col-6">
                        @include ('templates.nav.nav-sidebar-needs')
                    </div>
                <!-- </div> -->
                
            </section>
            <section class="col-12 d-flex justify-content-center py-2 text-center needs-coverage-title align-items-center hide-mobile">
                <h5>I'd like to provide coverage for my:</h5>
                <div id="errorContainer" style="display: none;" class="alert alert-danger"></div>
            </section>
            <form novalidate action="{{route('validate.coverage.selection')}}" method="POST" id="coverage_selection">
                @csrf
                <section class="needs-coverage-content hide">
                    <div class="col-12">
                        <div class="row overflow-auto d-flex justify-content-center h-100 position-relative">
                            <div class="col-12 show-mobile">
                                <h5>I'd like to provide coverage for my:</h5>
                                <div id="errorContainerMob" style="display: none;" class="alert alert-danger"></div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3 h-100 position-relative">
                                <div class="row h-100">
                                    <button class="border-0 bg-transparent choice z-99 mh-100 p-5" id="Self" data-avatar="Self" data-required="">
                                        <img src="{{ asset('images/avatar-gender-selection/button-gender-male.png') }}" class="m-auto mh-100 mw-100">
                                        <p class="py-2 m-0"><strong>Self</strong></p>
                                    </button>
                                    <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                        <div class="col-11 col-md-4 text-center">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3 position-relative">
                                <div class="row h-100">
                                    <button class="border-0 bg-transparent choice z-99 mh-100 p-5" id="Child" data-avatar="Child" data-required="">
                                        <img src="{{ asset('images/avatar/daughter.png') }}" class="m-auto mh-100 mw-100">
                                        <p class="py-2 m-0"><strong>Child</strong></p>
                                    </button>
                                    <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                        <div class="col-11 col-md-4 text-center">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12 col-md-6 col-xl-3 h-100 position-relative p-0">
                                //<div class="row d-flex m-auto">
                                <div class="d-flex justify-content-center h-100 position-relative">
                                    <button class="border-0 bg-transparent choice z-99" id="Self" name="coverage_selection">
                                        //<img src="{{ asset('images/avatar-gender-selection/button-gender-male.png') }}" class="h-90">
                                        //<p class="my-1"><strong>Self</strong></p>
                                        <img src="{{ asset('images/avatar-gender-selection/button-gender-male.png') }}" class="m-auto mh-100 mw-100">
                                        <p class="py-2 m-0"><strong>Self</strong></p>
                                    </button>
                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                        <div class="col-11 col-md-4 text-center">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-12 col-md-6 col-xl-3 h-100 position-relative">
                                <div class="d-flex justify-content-center h-100">
                                    <button class="border-0 bg-transparent choice z-99" id="Child" name="coverage_selection">
                                        <img src="{{ asset('images/avatar/daughter.png') }}" class="h-90">
                                        <p class="my-1"><strong>Child</strong></p>
                                    </button>
                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                        <div class="col-11 col-md-4 text-center">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile">
                                <div class="col-11 col-md-4 text-center">
                                    
                                </div>
                            </div>
                            <div class="col-12 show-mobile bg-btn_bar">
                                <div class="py-4 px-2">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <input type="hidden" name="selectedCoverageInput" id="selectedCoverageInput">
                                        <input type="hidden" name="urlInput" id="urlInput" value="education.supporting.years">
                                        <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">Back</a>
                                        <button class="btn btn-primary text-uppercase" id="nextBtn" type="submit">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar row hide-mobile">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <input type="hidden" name="selectedCoverageInput" id="selectedCoverageInput">
                            <input type="hidden" name="urlInput" id="urlInput" value="education.supporting.years">
                            <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">Back</a>
                            <!-- <a href="{{route('education.supporting.years')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                            <button class="btn btn-primary text-uppercase" id="nextBtn" type="submit">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

<script>
// Get the elements you need
const coverageSelection = document.getElementById('coverage_selection');
const nextButton = document.getElementById('nextBtn');
let selectedAvatar = null;

// Add event listener to each button with the 'data-required' attribute
const dataAvatarButtons = document.querySelectorAll('[data-avatar]');
dataAvatarButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the button click

        // Remove 'selected' attribute from all buttons
        dataAvatarButtons.forEach(btn => btn.removeAttribute('data-required'));
        // Add 'selected' attribute to the clicked button
        this.setAttribute('data-required', 'selected');
        // Store the selected data-avatar value
        selectedAvatar = this.getAttribute('data-required');
        selectedAvatarValue = this.getAttribute('data-avatar');

        // Update the hidden input field value with the selected avatar
        document.getElementById('selectedCoverageInput').value = selectedAvatarValue;
        // document.getElementById('urlInput').value = 'education.supporting.years';
    });
});

// Add event listener to the form's submit event
coverageSelection.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    if (!selectedAvatar) {
        // If no button is selected, prevent form submission and show an error message
        const errorContainer = document.getElementById('errorContainer');
        errorContainer.innerHTML = 'Please select who you want to provide coverage for.';
        errorContainer.style.display = 'block';

        const errorContainerMob = document.getElementById('errorContainerMob');
        errorContainerMob.innerHTML = 'Please select who you want to provide coverage for.';
        errorContainerMob.style.display = 'block';
        return;
    }

    // Perform your server-side validation here using Laravel or JavaScript fetch API
    // Use the selectedAvatar value instead of sending a separate fetch request
    fetch('/validate-avatar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use Blade templating to get the CSRF token
        },
        body: JSON.stringify({
            'data-required': selectedAvatar, // Include the selectedAvatar value in the request body
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.validationPassed) {
            // Form validation passed, proceed with the form submission
            // This will only trigger when the Next button is clicked, not the data-required buttons
            coverageSelection.submit(); // "this" refers to the coverageSelection element
        } else {
            // Form validation failed, handle the error (display an error message, etc.)
            const errorContainer = document.getElementById('errorContainer');
            errorContainer.innerHTML = 'Form validation failed: ' + data.errors.join(', ');
            errorContainer.style.display = 'block';
        }
    })
    .catch(error => {
        // Handle any errors that occur during the fetch request
        console.error('Error during fetch request:', error);
    });
});
</script>

@endsection