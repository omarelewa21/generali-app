<?php
/**
 * Off Canvas Section for Right Navigation
 */
?>

{{-- Off Canvas Links for Right Sidebar Navigation --}}

<div class="offcanvas bg-white offcanvas-end" tabindex="-1" id="offcanvasNeeds">
    <div class="offcanvas-header px-5 pt-5 pb-3 justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body pt-5">
        <div class="timeline-needs text-end px-4">
            @php
                // Get the current URL path
                $routeName = Route::currentRouteName();

                // Extract the folder name from the URL
                $folderName = explode('.', $routeName)[0];
            @endphp
            <a class="nav-item text-decoration-none text-dark" href="{{route('protection.home')}}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'protection' ? 'active' : '' }}" data-folder-name="protection">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'protection' ? 'text-primary' : '' }}">Protection</p>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('retirement.home')}}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'retirement' ? 'active' : '' }}" data-folder-name="retirement">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'retirement' ? 'text-primary' : '' }}">Retirement</p>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('education.home')}}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'education' ? 'active' : '' }}" data-folder-name="education">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'education' ? 'text-primary' : '' }}">Education</p>
                </div>
            </a>
            <a class="nav-item text-decoration-none text-dark" href="{{route('savings.home')}}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'savings' ? 'active' : '' }}" data-folder-name="savings">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'savings' ? 'text-primary' : '' }}">Regular Savings</p>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('investment.home')}}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'investment' ? 'active' : '' }}" data-folder-name="investment">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'investment' ? 'text-primary' : '' }}">Lump Sum Investment</p>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('health.medical.home') }}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'health' ? 'active' : '' }}" data-folder-name="health and medical">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'health' ? 'text-primary' : '' }}">Health & Medical</p>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{ route('debt.cancellation.home')}}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'debt' ? 'active' : '' }}" data-folder-name="debt cancellation">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'debt' ? 'text-primary' : '' }}">Debt Cancellation</p>
                </div>
            </a>

            {{-- <a class="nav-item text-decoration-none text-dark" href="{{url('#') }}">
                <div class="timeline-item-needs position-relative mb-5 {{ $folderName == 'others ' ? 'active' : '' }}" data-folder-name="others">
                    <p class="nav-text text-uppercase pe-5 {{ $folderName == 'others ' ? 'text-primary' : '' }}">Others</p>
                </div>
            </a> --}}

        </div>
    </div>
</div>

<script>

// Keep this script within this file
document.addEventListener('DOMContentLoaded', function() {
    // Get the current folder name
    var currentFolderName = '{{ $folderName }}';

    // Find all the timeline items and iterate through them
    $('.timeline-item-needs position-relative mb-5').each(function (index) {
        // Get the folder name from the data attribute
        var folderName = $(this).data('folder-name');

        // Check if the current folder name matches the currentFolderName
        if (folderName === currentFolderName) {
            $(this).addClass('active');

            // Also mark all previous folders as active
            for (var i = 0; i < index; i++) {
                $('.timeline-item-needs position-relative mb-5:eq(' + i + ')').addClass('active');
            }
        }
    });
});

</script>

