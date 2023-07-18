{{-- Links for Needs Sidebar Right --}}
@include('templates.nav.nav-sidebar-links-needs')
{{-- Links for Needs Sidebar Right --}}


{{-- Nav Sidebar Right Needs --}}
<section class="progress-main">
    <div class="row justify-content-end align-items-center m-3">
        <div class="col-auto">
            <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasMenu">
                <div class="text-dark d-inline-flex">
                    <p class="mb-0">
                        @php
                        // Get the current route name
                        $routeName = Route::currentRouteName();
                        // Extract the folder name from the route name (assuming folder names are
                        //separated by '.')
                        $folderName = explode('.', $routeName)[0];
                        @endphp
                        {{ ucfirst($folderName) }}
                        <!-- Display the folder name with the first letter in uppercase -->
                    </p>
                </div>
            </a>
        </div>
        <div class="col-auto">
            <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasMenu">
                <div class="progress color d-inline-flex mx-2">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                    <div class="progress-value">
                        <p class="mb-0">
                            @php
                            // Set the dynamic number based on the page slug name
                            switch ($folderName) {
                            case 'protection':
                            $dynamicNumber = 1;
                            break;
                            case 'retirement':
                            $dynamicNumber = 2;
                            break;
                            case 'education':
                            $dynamicNumber = 3;
                            break;
                            case 'savings':
                            $dynamicNumber = 4;
                            break;
                            case 'investment':
                            $dynamicNumber = 5;
                            break;
                            case 'debt cancellation':
                            $dynamicNumber = 6;
                            break;
                            case 'Health and Medical':
                            $dynamicNumber = 7;
                            break;
                            case 'Others ':
                            $dynamicNumber = 8;
                            break;
                            default:
                            $dynamicNumber = 0;
                            }
                            @endphp
                            {{ $dynamicNumber }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
{{-- Nav Sidebar Right Needs --}}