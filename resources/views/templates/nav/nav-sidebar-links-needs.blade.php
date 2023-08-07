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
                <div class="timeline-item-needs {{ $folderName == 'protection' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'protection' ? 'text-primary' : '' }}">
                        Protection
                    </h6>

                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('retirement.home')}}">
                <div class="timeline-item-needs {{ $folderName == 'retirement' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'retirement' ? 'text-primary' : '' }}">
                        Retirement
                    </h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{route('education.home')}}">
                <div class="timeline-item-needs {{ $folderName == 'education' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'education' ? 'text-primary' : '' }}">
                        Education</h6>
                </div>
            </a>
            <a class="nav-item text-decoration-none text-dark" href="{{url('#')}}">
                <div class="timeline-item-needs {{ $folderName == 'savings' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'savings' ? 'text-primary' : '' }}">
                        Savings
                    </h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{url('investment-home')}}">
                <div class="timeline-item-needs {{ $folderName == 'investment' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'investment' ? 'text-primary' : '' }}">
                        Investments
                    </h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{url('#') }}">
                <div class="timeline-item-needs {{ $folderName == 'health and medical' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'Health and Medical' ? 'text-primary' : '' }}">
                        Health and Medical</h6>
                </div>
            </a>

            <a class="nav-item text-decoration-none text-dark" href="{{ url('#')}}">
                <div class="timeline-item-needs {{ $folderName == 'debt cancellation' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'debt cancellation' ? 'text-primary' : '' }}">
                        Debt Cancellation</h6>
                </div>
            </a>

            {{-- <a class="nav-item text-decoration-none text-dark" href="{{url('#') }}">
                <div class="timeline-item-needs {{ $folderName == 'Others ' ? 'active' : '' }}">
                    <h6
                        class="display-6 nav-text-needs text-uppercase {{ $folderName == 'Others ' ? 'text-primary' : '' }}">
                        Others
                    </h6>
                </div>
            </a> --}}

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var currentPath = "{{ Request::url() }}"; // Get the current URL path
        
        console.log(currentPath);

        $('.timeline-needs').each(function (index) {
            var itemURL = $(this).find('a').attr('href');

            console.log(itemURL);

            if (itemURL === currentPath) {
                $(this).addClass('active');

                // Also mark all previous steps as active
                for (var i = 0; i < index; i++) {
                    $('.timeline-item-needs:eq(' + i + ')').addClass('active');
                }
            }
        });
    });
</script>
