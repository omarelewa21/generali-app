{{-- Off Canvas Links for Right Sidebar Navigation --}}
<div class="offcanvas bg-white offcanvas-end" tabindex="-1" id="offcanvasNeeds">
    <div class="offcanvas-header px-5 pt-xxl-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-3 justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-2">
        <div class="timeline-needs text-end">
            @php
            // Get the current URL path
            $routeName = Route::currentRouteName();

            // Extract the folder name from the URL
            $folderName = explode('.', $routeName)[0];
            @endphp

            <div class="timeline-item-needs {{ $folderName == 'protection' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{route('protection.home')}}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'protection' ? 'text-primary' : '' }}">Protection
                    </h6>
                </a>
            </div>
            <div class="timeline-item-needs {{ $folderName == 'retirement' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{route('retirement.home')}}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'retirement' ? 'text-primary' : '' }}">Retirement
                    </h6>
                </a>
            </div>
            <div class="timeline-item-needs {{ $folderName == 'education' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{route('education.home')}}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'education' ? 'text-primary' : '' }}">Education</h6>
                </a>
            </div>
            <div class="timeline-item-needs {{ $folderName == 'savings' ? 'active' : '' }}">   
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{url('#')}}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'savings' ? 'text-primary' : '' }}">Savings</h6>
                </a>
            </div>

            <div class="timeline-item-needs {{ $folderName == 'debt cancellation' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{ url('#')}}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'debt cancellation' ? 'text-primary' : '' }}">Debt
                        Cancellation</h6>
                </a>
            </div>
            <div class="timeline-item-needs {{ $folderName == 'health and medical' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{url('#') }}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'Health and Medical' ? 'text-primary' : '' }}">
                        Health and Medical</h6>
                </a>
            </div>
            <div class="timeline-item-needs {{ $folderName == 'investment' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{url('investment-home')}}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'investment' ? 'text-primary' : '' }}">Investment
                    </h6>
                </a>
            </div>
            <div class="timeline-item-needs {{ $folderName == 'Others ' ? 'active' : '' }}">
                <a class="nav-item text-dark text-decoration-none text-uppercase" href="{{url('#') }}">
                    <h6 class="display-6 nav-text-needs {{ $folderName == 'Others ' ? 'text-primary' : '' }}">Others</h6>
                </a>
            </div>
        </div>
    </div>
</div>