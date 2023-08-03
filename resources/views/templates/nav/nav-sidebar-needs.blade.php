{{-- Links for Needs Sidebar Right --}}
@include('templates.nav.nav-sidebar-links-needs')
{{-- Links for Needs Sidebar Right --}}
<header id="wrapper-navbar">
  <nav class="navbar navbar-default transparent">
      <div class="container-fluid px-4 px-xxl-5 px-xl-5 pt-4 pt-sm-4 pt-md-5 pb-4 pb-sm-4 pb-md-3">
          <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
              <img class="d-flex" src="{{ asset('images/general/menu-button-red.svg') }}" alt="Logo" width="32px" height="26px">
          </a>
      </div>
  </nav>
</header>

{{-- Nav Sidebar Right Needs --}}
<section class="progress-main progress-mobile">
  <div class="row justify-content-end align-items-center px-4 px-xxl-5 px-xl-5 pt-4 pt-sm-4 pt-md-5 pb-4 pb-sm-4 pb-md-3">
    <div class="col-auto">
      <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasMenu">
        <div class="text-dark d-inline-flex">
          <p class="needs-text mb-0">
            @php
            // Get the current route name
            $routeName = Route::currentRouteName();
            // Extract the folder name from the route name (assuming folder names are
            //separated by '.')
            $folderName = explode('.', $routeName)[0];

            // Get all routes matching the current folder name (prefix)
            $folderRoutes = collect(Route::getRoutes()->getRoutesByName())
            ->filter(function ($value, $key) use ($folderName) {
            return strpos($key, $folderName . '.') === 0;
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
            @php
            
            $folderNumber = [
              'protection' => 1,
              'retirement' => 2,
              'education' => 3,
              'savings' => 4,
              'investment' => 5,
              'debt cancellation' => 6,
              'Health and Medical' => 7,
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

<style>
  /* code for progress bar css */
  .progress-main {
    z-index: 1040;
  }

  .progress {
    width: 44px;
    height: 44px;
    line-height: 150px;
    background: transparent;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
  }

  .progress:after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 2px solid #fff;
    position: absolute;
    top: 0;
    left: 0;
  }

  .progress>span {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1000;
  }

  .progress .progress-left {
    left: 0;
  }

  .progress .progress-bar {
    width: 100%;
    height: 100%;
    background: none;
    border-width: 2px;
    border-style: solid;
    position: absolute;
    top: 0;
  }

  .progress .progress-left .progress-bar {
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
  }

  .progress .progress-right {
    right: 0;
  }

  .progress .progress-right .progress-bar {
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-right 0.8s linear forwards;
  }

  .progress-value p {
    font-size: 20px;
  }

  .progress .progress-value {
    width: 100%;
    height: 100%;
    border-radius: 80px;
    background: #ffffff;
    color: #d10b4f;
    line-height: 3.2em;
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
  }

  .progress.color .progress-bar {
    border-color: #d10b4f;
  }

  .progress.color .progress-left .progress-bar {
    animation: loading-left 0.8s linear forwards 0.8s;
  }


  @keyframes loading-left {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate({{$progressLeft}}deg);
      transform: rotate({{$progressLeft}}deg);
    }
  }

  @keyframes loading-right {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate({{$progressRight}}deg);
      transform: rotate({{$progressRight}}deg);
    }
  }

  @media only screen and (max-device-width:986px) {
    .progress .progress-value{
        background:transparent;
        z-index:1000;
    }
    .progress-mobile {
          position: fixed;
          /* left: 0; */
          /* top: 0; */
          right: 0;
      }
  }
</style>