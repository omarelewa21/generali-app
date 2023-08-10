{{-- Off Canvas Links for Right Sidebar Navigation --}}
<div class="offcanvas bg-white offcanvas-end" tabindex="-1" id="offcanvasNeeds">
    <div class="offcanvas-header px-5 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-3 justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-2 mt-5">
        <div class="timeline-needs text-end">
            @php
            // Get the current URL path
            $routeName = Route::currentRouteName();

            // Extract the folder name from the URL
            $folderName = explode('.', $routeName)[0];
            @endphp
            <a class="nav-item text-decoration-none text-dark" href="{{route('protection.home')}}">
                <div class="timeline-item-needs {{ $folderName == 'protection' ? 'active' : '' }}" data-folder-name="protection">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'protection' ? 'text-primary' : '' }}">
                        Protection
                    </h6>

                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('retirement.home')}}">
                <div class="timeline-item-needs {{ $folderName == 'retirement' ? 'active' : '' }}" data-folder-name="retirement">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'retirement' ? 'text-primary' : '' }}">
                        Retirement
                    </h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('education.home')}}">
                <div class="timeline-item-needs {{ $folderName == 'education' ? 'active' : '' }}" data-folder-name="education">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'education' ? 'text-primary' : '' }}">
                        Education</h6>
                </div>
            </a>
            <a class="nav-item text-decoration-none text-dark" href="{{url('#')}}">
                <div class="timeline-item-needs {{ $folderName == 'savings' ? 'active' : '' }}" data-folder-name="savings">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'savings' ? 'text-primary' : '' }}">
                        Savings
                    </h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{url('investment-home')}}">
                <div class="timeline-item-needs {{ $folderName == 'investment' ? 'active' : '' }}" data-folder-name="investment">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'investment' ? 'text-primary' : '' }}">
                        Investments
                    </h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{url('#') }}">
                <div class="timeline-item-needs {{ $folderName == 'health and medical' ? 'active' : '' }}" data-folder-name="health and medical">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'Health and Medical' ? 'text-primary' : '' }}">
                        Health and Medical</h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{ url('#')}}">
                <div class="timeline-item-needs {{ $folderName == 'debt cancellation' ? 'active' : '' }}" data-folder-name="debt cancellation">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'debt cancellation' ? 'text-primary' : '' }}">
                        Debt Cancellation</h6>
                </div>
            </a>

            {{-- <a class="nav-item text-decoration-none text-dark" href="{{url('#') }}">
                <div class="timeline-item-needs {{ $folderName == 'others ' ? 'active' : '' }}" data-folder-name="others">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'others ' ? 'text-primary' : '' }}">
                        Others
                    </h6>
                </div>
            </a> --}}

        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        // Get the current folder name
        var currentFolderName = '{{ $folderName }}';

        // Find all the timeline items and iterate through them
        $('.timeline-item-needs').each(function (index) {
            // Get the folder name from the data attribute
            var folderName = $(this).data('folder-name');

            // Check if the current folder name matches the currentFolderName
            if (folderName === currentFolderName) {
                $(this).addClass('active');

                // Also mark all previous folders as active
                for (var i = 0; i < index; i++) {
                    $('.timeline-item-needs:eq(' + i + ')').addClass('active');
                }
            }
        });
    });

</script>
