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


<style>
/* code for progress bar css */
.progress-main {
  z-index:1040;
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
    border: 12px solid #fff;
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
    z-index: 1;
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
    animation: loading-1 1.8s linear forwards;
  }
  .progress-value p {
    font-size:20px;
  }
  .progress .progress-value {
    width: 100%;
    height: 100%;
    border-radius: 0;
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
    animation: loading-2 1.5s linear forwards 1.8s;
  }

  @keyframes loading-1 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(180deg);
      transform: rotate(180deg);
    }
  }

  @keyframes loading-2 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(144deg);
      transform: rotate(144deg);
    }
  }

  @keyframes loading-3 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(90deg);
      transform: rotate(90deg);
    }
  }

  @keyframes loading-4 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(36deg);
      transform: rotate(36deg);
    }
  }

  @keyframes loading-5 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(126deg);
      transform: rotate(126deg);
    }
  }

  /* end of code for progress bar */

</style>