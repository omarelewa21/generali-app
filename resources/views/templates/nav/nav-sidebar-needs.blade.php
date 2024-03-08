<?php
/**
 * Navbar Section for Right Progress Navigation
 */
?>

{{-- Links for Needs Sidebar Right --}}
@include('templates.nav.nav-sidebar-links-needs')
{{-- Links for Needs Sidebar Right --}}

{{-- Nav Sidebar Right Needs --}}

<section class="d-flex justify-content-end pt-4 pt-md-0">
    <div class="row align-items-center px-4 py-md-4">
        <div class="col-auto pe-0">
            <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasNeeds" class="text-decoration-none">
                <p class="display-6 text-dark m-1 needs-progress">
                    @php
                    // Get the current route name
                    $routeName = Route::currentRouteName();
                    // Extract the folder name from the route name (assuming folder names are
                    //separated by '.')
                    $folderName = explode('.', $routeName)[0];
    
                    // Get all routes matching the current folder name (prefix)
                    $folderRoutes = collect(Route::getRoutes()->getRoutesByName())
                    ->filter(function ($value, $key) use ($folderName) {
                    return $key === $folderName || strpos($key, $folderName . '.') === 0;
                    });
                    
                    $routeKeys = $folderRoutes->keys()->all();
                    // Get the current route index (page number)
                    $currentPage = array_search($routeName, $routeKeys);
                    
                    $totalPagesInFolder = $folderRoutes->count();
                    // Add 1 to the index to get the page number (since arrays are 0-indexed)
                    $pageNumber = $currentPage !== false ? $currentPage + 1 : 0;
                    $progressAverage = 360 / $totalPagesInFolder;
                    $progress = $progressAverage * $pageNumber;
                    if ($progress > 180) {
                    $progressLeft = $progress - 180;
                    $progressRight = 180;
                    }
                    else if ($progress <= 180) { 
                    $progressLeft=0; 
                    $progressRight=$progress; 
                    } 
                    
                    @endphp 
                    {{ ($folderName == 'savings') ? 'Regular Savings' : (($folderName == 'investment') ? 'Lump Sum Investment' : (($folderName == 'health') ? 'Health & Medical' : (($folderName == 'debt') ? 'Debt Cancellation' : ucfirst($folderName)))) }}
                    <!-- Display the folder name with the first letter in uppercase -->
                </p>
            </a>
        </div>
        <div class="col-auto pe-sm-0 ps-0">
            <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasMenu" class="d-flex align-items-center">
                <div class="progress color d-inline-flex mx-2">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>

                    <div class="progress-value">
                        @php
                        
                            $folderNumber = [
                            'protection' => 1,
                            'retirement' => 2,
                            'education' => 3,
                            'savings' => 4,
                            'investment' => 5,
                            'health' => 6,
                            'debt' => 7,
                            // 'Others' => 8,
                            ];

                            $dynamicNumber = $folderNumber[$folderName] ?? 0;
                        @endphp

                        <p class="mb-0">
                            {{ $dynamicNumber }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- Nav Sidebar Right Needs --}}

<script>
@keyframes loading-left {
  0% {
      transform: rotate(0deg);
  }
  100% {
      transform: rotate(calc({{ $progressLeft }} * 1deg));
  }
}

@keyframes loading-right {
  0% {
      transform: rotate(0deg);
  }
  100% {
      transform: rotate(calc({{ $progressRight }} * 1deg));
  }
}
</script>