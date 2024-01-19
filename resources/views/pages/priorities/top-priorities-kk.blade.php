<?php
/**
 * Template Name: Top Priorities Page
 */
?>

@extends('templates.master')

@section('title')
    <title>Top Priorities</title>
@endsection

@section('content')

    @php
        // Retrieving values from the session
        $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
        $topPriorities = session('customer_details.financial_priorities');

//        session()->forget('customer_details.financial_priorities');
    @endphp

        <!-- Desktop Version -->
    <style>
        #top_priorities {
            height: 0 !important;
        }

        @media (min-width: 768px) {
            #top_priorities {
                height: 100vh !important;
            }
        }
    </style>
    <div class="desktop-content" id="desktopContent">
        <div id="top_priorities" class="overflow-hidden">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 vh-100 wrapper-avatar-default bg-white"
                         style="z-index: 1;">
                        <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>
                        <section class="avatar-design-placeholder content-avatar-default">
                            <div class="col-12 text-center position-relative">
                                <h2 class="display-5 fw-bold lh-base text-center">Here's how I see my priorities:</h2>
                                <div class="position-absolute text-uppercase text-primary fw-bolder px-2 py-1 border border-primary border-2 rounded rounded-5 user-select-none" style="z-index: 3; left: 50%; top: 45%; transform: translate(-50%, -50%);">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 512 512" fill="currentColor" role="button" onClick="resetPriorities()">
                                        <path
                                            d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z"/>
                                    </svg> Refresh
                                </div>
                                <div id="sortable-main" class="position-relative pt-3">
                                    <svg width="100%" height="100%" viewBox="0 0 776 389" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            class="second @if(isset($topPriorities) && isset($topPriorities[1])) item-dropped @endif"
                                            d="M217.69 224.091C196.716 246.11 179.97 272.188 168.769 301.045L30.2097 247.62C48.5897 200.803 75.8854 158.479 110.016 122.74L217.69 224.091Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="fourth @if(isset($topPriorities) && isset($topPriorities[3])) item-dropped @endif"
                                            d="M387.489 151.333C354.661 151.333 323.41 158.078 295.051 170.266L236.951 34.6854C283.175 14.9411 334.052 4 387.477 4V151.333H387.489Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="third @if(isset($topPriorities) && isset($topPriorities[2])) item-dropped @endif"
                                            d="M295.051 170.266C265.687 182.865 239.42 201.294 217.691 224.091L110.017 122.74C145.668 85.401 188.783 55.2644 236.951 34.6855L295.051 170.266Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="first @if(isset($topPriorities) && isset($topPriorities[0])) item-dropped @endif"
                                            d="M168.769 301.044C158.767 326.802 153.189 354.766 152.949 384L4 376.454C5.31449 331.101 14.4816 287.714 30.2098 247.619L168.769 301.044Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="seventh @if(isset($topPriorities) && isset($topPriorities[6])) item-dropped @endif"
                                            d="M744.39 246.625L606.083 300.679C594.961 272.166 578.41 246.351 557.709 224.526L666.104 123.929C699.469 159.165 726.239 200.723 744.39 246.625Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="fifth @if(isset($topPriorities) && isset($topPriorities[4])) item-dropped @endif"
                                            d="M539.329 35.2456L480.417 170.472C451.933 158.158 420.511 151.333 387.5 151.333H387.489V4H387.5C441.44 4 492.762 15.1583 539.329 35.2456Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="eight @if(isset($topPriorities) && isset($topPriorities[7])) item-dropped @endif"
                                            d="M771 376.42L622.051 383.988C621.811 354.618 616.176 326.528 606.083 300.678L744.39 246.625C760.358 286.982 769.674 330.701 771 376.42Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path
                                            class="sixth @if(isset($topPriorities) && isset($topPriorities[5])) item-dropped @endif"
                                            d="M666.104 123.929L557.71 224.525C536.026 201.649 509.771 183.139 480.417 170.472L539.33 35.2456C587.486 56.0188 630.555 86.3726 666.104 123.929Z"
                                            fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <path opacity="0.5"
                                              d="M87.088 350V305.2H79.856C79.6 306.907 79.0667 308.336 78.256 309.488C77.4453 310.64 76.4427 311.579 75.248 312.304C74.096 312.987 72.7733 313.477 71.28 313.776C69.8293 314.032 68.3147 314.139 66.736 314.096V320.944H78V350H87.088Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M108.368 214.416H117.072C117.072 213.221 117.179 212.027 117.392 210.832C117.648 209.595 118.053 208.485 118.608 207.504C119.163 206.48 119.888 205.669 120.784 205.072C121.723 204.432 122.853 204.112 124.176 204.112C126.139 204.112 127.739 204.731 128.976 205.968C130.256 207.163 130.896 208.848 130.896 211.024C130.896 212.389 130.576 213.605 129.936 214.672C129.339 215.739 128.571 216.699 127.632 217.552C126.736 218.405 125.733 219.195 124.624 219.92C123.515 220.603 122.469 221.285 121.488 221.968C119.568 223.291 117.733 224.592 115.984 225.872C114.277 227.152 112.784 228.56 111.504 230.096C110.224 231.589 109.2 233.296 108.432 235.216C107.707 237.136 107.344 239.397 107.344 242H140.24V234.192H119.056C120.165 232.656 121.445 231.312 122.896 230.16C124.347 229.008 125.84 227.941 127.376 226.96C128.912 225.936 130.427 224.912 131.92 223.888C133.456 222.864 134.821 221.733 136.016 220.496C137.211 219.216 138.171 217.765 138.896 216.144C139.621 214.523 139.984 212.581 139.984 210.32C139.984 208.144 139.557 206.181 138.704 204.432C137.893 202.683 136.784 201.211 135.376 200.016C133.968 198.821 132.325 197.904 130.448 197.264C128.613 196.624 126.672 196.304 124.624 196.304C121.936 196.304 119.547 196.773 117.456 197.712C115.408 198.608 113.701 199.888 112.336 201.552C110.971 203.173 109.947 205.093 109.264 207.312C108.581 209.488 108.283 211.856 108.368 214.416Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M204.592 128.312V134.712C205.701 134.712 206.853 134.755 208.048 134.84C209.285 134.883 210.416 135.117 211.44 135.544C212.464 135.928 213.296 136.568 213.936 137.464C214.619 138.36 214.96 139.661 214.96 141.368C214.96 143.544 214.256 145.272 212.848 146.552C211.44 147.789 209.712 148.408 207.664 148.408C206.341 148.408 205.189 148.173 204.208 147.704C203.269 147.235 202.48 146.616 201.84 145.848C201.2 145.037 200.709 144.099 200.368 143.032C200.027 141.923 199.835 140.771 199.792 139.576H191.152C191.109 142.179 191.472 144.483 192.24 146.488C193.051 148.493 194.181 150.2 195.632 151.608C197.083 152.973 198.832 154.019 200.88 154.744C202.971 155.469 205.275 155.832 207.792 155.832C209.968 155.832 212.059 155.512 214.064 154.872C216.069 154.232 217.84 153.293 219.376 152.056C220.912 150.819 222.128 149.283 223.024 147.448C223.963 145.613 224.432 143.523 224.432 141.176C224.432 138.616 223.728 136.419 222.32 134.584C220.912 132.749 218.971 131.555 216.496 131V130.872C218.587 130.275 220.144 129.144 221.168 127.48C222.235 125.816 222.768 123.896 222.768 121.72C222.768 119.715 222.32 117.944 221.424 116.408C220.528 114.872 219.355 113.571 217.904 112.504C216.496 111.437 214.896 110.648 213.104 110.136C211.312 109.581 209.52 109.304 207.728 109.304C205.424 109.304 203.333 109.688 201.456 110.456C199.579 111.181 197.957 112.227 196.592 113.592C195.269 114.957 194.224 116.6 193.456 118.52C192.731 120.397 192.325 122.488 192.24 124.792H200.88C200.837 122.488 201.392 120.589 202.544 119.096C203.739 117.56 205.488 116.792 207.792 116.792C209.456 116.792 210.928 117.304 212.208 118.328C213.488 119.352 214.128 120.824 214.128 122.744C214.128 124.024 213.808 125.048 213.168 125.816C212.571 126.584 211.781 127.181 210.8 127.608C209.861 127.992 208.837 128.227 207.728 128.312C206.619 128.397 205.573 128.397 204.592 128.312Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M331.968 69.592V85.144H320.192L331.776 69.592H331.968ZM331.968 92.632V103H340.608V92.632H346.56V85.144H340.608V58.2H332.48L313.024 84.312V92.632H331.968Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M459 65.688V58.2H433.976L429.56 82.968H437.752C438.648 81.7307 439.608 80.8347 440.632 80.28C441.656 79.6827 442.979 79.384 444.6 79.384C445.837 79.384 446.925 79.5973 447.864 80.024C448.803 80.4507 449.613 81.048 450.296 81.816C450.979 82.584 451.491 83.48 451.832 84.504C452.173 85.528 452.344 86.616 452.344 87.768C452.344 88.8773 452.152 89.9653 451.768 91.032C451.427 92.056 450.915 92.9733 450.232 93.784C449.592 94.552 448.781 95.192 447.8 95.704C446.861 96.1733 445.795 96.408 444.6 96.408C442.552 96.408 440.867 95.8107 439.544 94.616C438.221 93.3787 437.453 91.736 437.24 89.688H428.152C428.195 92.0347 428.664 94.104 429.56 95.896C430.499 97.6453 431.736 99.1173 433.272 100.312C434.808 101.507 436.557 102.403 438.52 103C440.525 103.555 442.616 103.832 444.792 103.832C447.053 103.875 449.187 103.512 451.192 102.744C453.197 101.933 454.947 100.803 456.44 99.352C457.976 97.9013 459.192 96.1947 460.088 94.232C460.984 92.2267 461.432 90.072 461.432 87.768C461.432 85.6773 461.112 83.7147 460.472 81.88C459.875 80.0027 458.979 78.3813 457.784 77.016C456.632 75.6507 455.203 74.5627 453.496 73.752C451.789 72.9413 449.827 72.536 447.608 72.536C445.816 72.536 444.216 72.8133 442.808 73.368C441.4 73.88 440.077 74.7547 438.84 75.992L438.712 75.864L440.504 65.688H459Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M558.304 131.768C559.456 131.768 560.459 132.024 561.312 132.536C562.208 133.005 562.933 133.645 563.488 134.456C564.043 135.224 564.448 136.12 564.704 137.144C565.003 138.125 565.152 139.149 565.152 140.216C565.152 141.24 565.003 142.243 564.704 143.224C564.405 144.205 563.957 145.08 563.36 145.848C562.763 146.616 562.037 147.235 561.184 147.704C560.373 148.173 559.413 148.408 558.304 148.408C557.152 148.408 556.128 148.173 555.232 147.704C554.336 147.235 553.568 146.616 552.928 145.848C552.331 145.037 551.861 144.141 551.52 143.16C551.221 142.136 551.072 141.112 551.072 140.088C551.072 138.979 551.221 137.933 551.52 136.952C551.819 135.928 552.267 135.032 552.864 134.264C553.461 133.496 554.208 132.899 555.104 132.472C556.043 132.003 557.109 131.768 558.304 131.768ZM564.832 121.72H573.472C573.216 119.715 572.683 117.944 571.872 116.408C571.061 114.872 570.016 113.592 568.736 112.568C567.456 111.501 565.984 110.691 564.32 110.136C562.656 109.581 560.864 109.304 558.944 109.304C555.744 109.304 553.035 110.008 550.816 111.416C548.597 112.824 546.784 114.659 545.376 116.92C543.968 119.139 542.944 121.635 542.304 124.408C541.664 127.181 541.344 129.955 541.344 132.728C541.344 135.587 541.6 138.403 542.112 141.176C542.624 143.907 543.541 146.36 544.864 148.536C546.187 150.712 547.957 152.483 550.176 153.848C552.395 155.171 555.189 155.832 558.56 155.832C560.907 155.832 563.04 155.427 564.96 154.616C566.88 153.763 568.523 152.611 569.888 151.16C571.296 149.667 572.363 147.939 573.088 145.976C573.856 143.971 574.24 141.816 574.24 139.512C574.24 137.72 573.963 135.949 573.408 134.2C572.853 132.451 571.979 130.893 570.784 129.528C569.504 128.12 567.947 127.011 566.112 126.2C564.277 125.347 562.4 124.92 560.48 124.92C558.304 124.92 556.384 125.304 554.72 126.072C553.056 126.84 551.605 128.12 550.368 129.912L550.24 129.784C550.283 128.547 550.453 127.139 550.752 125.56C551.051 123.981 551.52 122.509 552.16 121.144C552.8 119.736 553.653 118.563 554.72 117.624C555.829 116.643 557.195 116.152 558.816 116.152C560.395 116.152 561.717 116.707 562.784 117.816C563.851 118.925 564.533 120.227 564.832 121.72Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M663.088 210.008V202.2H632.496V210.648H653.744C649.477 215.811 646.021 221.485 643.376 227.672C640.773 233.859 639.216 240.301 638.704 247H648.432C648.475 244.013 648.816 240.792 649.456 237.336C650.139 233.88 651.077 230.467 652.272 227.096C653.509 223.725 655.024 220.547 656.816 217.56C658.651 214.573 660.741 212.056 663.088 210.008Z"
                                              fill="#707070"/>
                                        <path opacity="0.5"
                                              d="M685.008 317.36C685.008 316.336 685.179 315.44 685.52 314.672C685.904 313.904 686.416 313.264 687.056 312.752C687.696 312.24 688.421 311.856 689.232 311.6C690.085 311.301 690.96 311.152 691.856 311.152C693.264 311.152 694.395 311.365 695.248 311.792C696.144 312.219 696.827 312.752 697.296 313.392C697.808 314.032 698.149 314.715 698.32 315.44C698.491 316.123 698.576 316.763 698.576 317.36C698.576 319.28 697.936 320.752 696.656 321.776C695.376 322.757 693.776 323.248 691.856 323.248C690.021 323.248 688.421 322.757 687.056 321.776C685.691 320.752 685.008 319.28 685.008 317.36ZM676.752 316.528C676.752 318.747 677.307 320.688 678.416 322.352C679.525 324.016 681.168 325.147 683.344 325.744V325.872C680.656 326.512 678.565 327.792 677.072 329.712C675.621 331.632 674.896 334.021 674.896 336.88C674.896 339.312 675.365 341.403 676.304 343.152C677.285 344.901 678.565 346.352 680.144 347.504C681.765 348.656 683.579 349.488 685.584 350C687.632 350.555 689.744 350.832 691.92 350.832C694.011 350.832 696.059 350.555 698.064 350C700.069 349.403 701.861 348.528 703.44 347.376C705.019 346.224 706.277 344.773 707.216 343.024C708.197 341.275 708.688 339.205 708.688 336.816C708.688 334 707.963 331.632 706.512 329.712C705.061 327.749 702.992 326.469 700.304 325.872V325.744C702.48 325.019 704.101 323.824 705.168 322.16C706.277 320.496 706.832 318.555 706.832 316.336C706.832 315.227 706.576 313.989 706.064 312.624C705.552 311.216 704.699 309.915 703.504 308.72C702.352 307.483 700.816 306.437 698.896 305.584C696.976 304.731 694.629 304.304 691.856 304.304C690.021 304.304 688.208 304.56 686.416 305.072C684.624 305.584 683.003 306.352 681.552 307.376C680.144 308.4 678.992 309.68 678.096 311.216C677.2 312.752 676.752 314.523 676.752 316.528ZM683.984 336.432C683.984 334.128 684.752 332.379 686.288 331.184C687.824 329.947 689.701 329.328 691.92 329.328C692.987 329.328 693.968 329.499 694.864 329.84C695.803 330.181 696.613 330.672 697.296 331.312C698.021 331.952 698.576 332.72 698.96 333.616C699.387 334.469 699.6 335.429 699.6 336.496C699.6 337.605 699.408 338.629 699.024 339.568C698.64 340.507 698.085 341.317 697.36 342C696.677 342.64 695.867 343.152 694.928 343.536C694.032 343.877 693.029 344.048 691.92 344.048C690.853 344.048 689.829 343.877 688.848 343.536C687.867 343.152 687.013 342.64 686.288 342C685.605 341.317 685.051 340.507 684.624 339.568C684.197 338.629 683.984 337.584 683.984 336.432Z"
                                              fill="#707070"/>
                                    </svg>

                                    <div id="sortable" class="position-absolute pt-3">
                                        <div
                                            class="svg-container first d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[0])) item-dropped @endif"
                                            data-svg-class="first" data-index="1">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[0]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[0]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[0] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="180" height="100" viewBox="0 0 166 138" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container second d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[1])) item-dropped @endif"
                                            data-svg-class="second" data-index="2">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[1]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[1]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[1] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="200" height="125" viewBox="0 0 190 180" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container third d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[2])) item-dropped @endif"
                                            data-svg-class="third" data-index="3">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[2]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[2]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[2] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="200" height="130" viewBox="0 0 187 191" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container fourth d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[3])) item-dropped @endif"
                                            data-svg-class="fourth" data-index="4">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[3]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[3]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[3] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="152" height="120" viewBox="0 0 152 168" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M151.489 148.333C118.661 148.333 87.4099 155.078 59.0512 167.266L0.950684 31.6854C47.1751 11.9411 98.0516 1 151.477 1V148.333H151.489Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container fifth d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[4])) item-dropped @endif"
                                            data-svg-class="fifth" data-index="5">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[4]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[4]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[4] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="154" height="120" viewBox="0 0 154 169" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M153.329 32.2456L94.4173 167.472C65.9329 155.158 34.5108 148.333 1.49997 148.333H1.48853V1H1.49997C55.4398 1 106.762 12.1583 153.329 32.2456Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container sixth d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[5])) item-dropped @endif"
                                            data-svg-class="sixth" data-index="6">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[5]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[5]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[5] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="188" height="135" viewBox="0 0 188 192" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M187.104 89.929L78.7096 190.525C57.0262 167.649 30.7706 149.139 1.41748 136.472L60.3296 1.24561C108.486 22.0188 151.555 52.3726 187.104 89.929Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container seventh d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[6])) item-dropped @endif"
                                            data-svg-class="seventh" data-index="7">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[6]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[6]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[6] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="190" height="125" viewBox="0 0 190 179" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M188.39 123.625L50.0827 177.679C38.961 149.166 22.4099 123.351 1.70947 101.526L110.104 0.929199C143.469 36.1648 170.239 77.7226 188.39 123.625Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="svg-container eight d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[7])) item-dropped @endif"
                                            data-svg-class="eight" data-index="8">
                                            <div
                                                class="svg-button px-0 d-flex justify-content-center align-items-center">
                                                @if(!isset($topPriorities) || !isset($topPriorities[7]))
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center">
                                                    </div>
                                                @else
                                                    <div
                                                        class="dropped position-absolute d-flex justify-content-center align-items-center"
                                                        data-identifier="{{$topPriorities[7]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped"
                                                                 src="{{ asset('images/top-priorities/' . $topPriorities[7] . '-icon.png') }}"
                                                                 style="width: 100px;">
                                                            <button class="remove-button"><img class="close"
                                                                                               src="/images/top-priorities/close.png"
                                                                                               width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="167" height="100" viewBox="0 0 167 140" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M166 131.42L17.051 138.988C16.811 109.618 11.1758 81.5276 1.08276 55.6783L139.39 1.62451C155.358 41.9819 164.674 85.7006 166 131.42Z"
                                                        fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 position-absolute" style="top: 50%;">
                                    <img src="{{ asset($image) }}" width="auto" height="100%" alt="Avatar"
                                         class="changeImage">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                        <div class="scrollable-content">
                            <section class="main-content">
                                <div class="container">
                                    <div class="row px-4 pt-3 pb-2 px-sm-5 pt-md-5 right-sidebar">
                                        <div class="col-12">
                                            <h1 class="display-4 text-white fw-bold pb-3">What are your top financial
                                                priorities?</h1>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <p class="text-white display-6 lh-base">Select your priorities by first to
                                                    last.</p>
                                                <div class="d-flex gap-2 justify-content-between align-items-center text-uppercase text-light fw-bolder px-2 py-1 border border-light border-2 rounded rounded-5 user-select-none" style="z-index: 4;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512" fill="currentColor" role="button" onClick="resetPriorities()">
                                                        <path
                                                            d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z"/>
                                                    </svg>
                                                    <div style="font-size: 18px;">
                                                        Refresh
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="needs" class="row px-4 pb-4 px-sm-5 needs">
                                        @if ($errors->has('topPrioritiesButtonInput'))
                                            <div class="col-12">
                                                <div class="col-12 alert alert-warning d-flex align-items-center"
                                                     role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                         viewBox="0 0 16 16" role="img" aria-label="Warning:"
                                                         width="25">
                                                        <path
                                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    <div
                                                        class="text">{{ $errors->first('topPrioritiesButtonInput') }}</div>
                                                </div>
                                            </div>
                                        @endif
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('protection', $topPriorities)) default @endif"
                                                        data-avatar="protection" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('protection', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/protection-icon.png') }}"
                                                             width="auto" height="100px" alt="Protection">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">
                                                            Protection</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('retirement', $topPriorities)) default @endif"
                                                        data-avatar="retirement"
                                                        data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('retirement', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/retirement-icon.png') }}"
                                                             width="auto" height="100px" alt="Retirement">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">
                                                            Retirement</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('education', $topPriorities)) default @endif"
                                                        data-avatar="education" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('education', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/education-icon.png') }}"
                                                             width="auto" height="100px" alt="Education">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">
                                                            Education</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg h-100">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover h-100">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('savings', $topPriorities)) default @endif"
                                                        data-avatar="savings" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('savings', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/savings-icon.png') }}"
                                                             width="auto" height="100px" alt="Savings">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">Savings</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('debt-cancellation', $topPriorities)) default @endif"
                                                        data-avatar="debt-cancellation" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('debt-cancellation', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/debt-cancellation-icon.png') }}"
                                                             width="auto" height="100px" alt="Debt Cancellation">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">Debt
                                                            Cancellation</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('health-medical', $topPriorities)) default @endif"
                                                        data-avatar="health-medical" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('health-medical', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/health-medical-icon.png') }}"
                                                             width="auto" height="100px" alt="Health & Medical">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">Health &
                                                            Medical</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('investments', $topPriorities)) default @endif"
                                                        data-avatar="investments" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('investments', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/investments-icon.png') }}"
                                                             width="auto" height="100px" alt="Investments">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">
                                                            Investments</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div
                                                    class="col-12 d-flex align-items-center justify-content-center hover">
                                                    <button
                                                        class="border-0 w-100 py-4 @if(isset($topPriorities) && is_array($topPriorities) && in_array('others', $topPriorities)) default @endif"
                                                        data-avatar="others" data-required=""
                                                        @if(isset($topPriorities) && is_array($topPriorities) && in_array('others', $topPriorities)) disabled @endif
                                                    >
                                                        <img class="needs-icon"
                                                             src="{{ asset('images/top-priorities/others-icon.png') }}"
                                                             width="auto" height="100px" alt="Others">
                                                        <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('form.top.priorities') }}" method="post" class="buttonForm">
        @csrf
        <section class="footer bg-accent-light-white py-4 fixed-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                        <!-- Add a hidden input field to store the selected button -->
                        <input type="hidden" name="topPrioritiesButtonInput"
                               id="topPrioritiesButtonInput"
                               value="{{ json_encode($topPriorities) }}">
                        <a href="{{route('avatar.my.assets')}}"
                           class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                        <button type="submit" class="btn btn-primary flex-fill text-uppercase"
                                id="nextButton">Next
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <!-- Mobile Version
    <div class="mobile-content" id="mobileContent">
    <input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
    <label for="dark-light"></label>

    <div class="light-back"></div>

    <a href="https://front.codes/" class="logo" target="_blank">
        <img src="https://assets.codepen.io/1462889/fcy.png" alt="">
    </a>

    <div class="sec-center">
        <div class="modern-dropdown-container">
            <input class="dropdown" type="checkbox" id="modernDropdown" name="modernDropdown"/>
            <label class="for-dropdown" for="modernDropdown">Dropdown Menu <i class="uil uil-arrow-down"></i></label>
            <div class="modern-dropdown-content">
                <a href="#">Dropdown Link</a>
                <input class="dropdown-sub" type="checkbox" id="dropdown-sub" name="dropdown-sub"/>
                <label class="for-dropdown-sub" for="dropdown-sub">Dropdown Sub</label>
                <div class="section-dropdown-sub">
                    <a href="#">Dropdown Link</a>
                    <a href="#">Dropdown Link</a>
                </div>
                <a href="#">Dropdown Link</a>
                <a href="#">Dropdown Link</a>
            </div>
        </div>
    </div>
    </div>
     -->

    <script>
        var sessionData = {!! json_encode(session('customer_details.financial_priorities'))!!};
    </script>
    <!-- <script>
        // Get all the path elements inside #sortable-main
    var paths = document.querySelectorAll("#sortable-main path");

    // Add the class "item-dropped" to each path element
    paths.forEach(function (path) {
      path.classList.add("item-dropped");
    });
    </script> -->
    <!-- <script>
        $(function() {
        var $needs = $("#needs"),
        $sortable = $("#sortable");

        var addedNeedsImages = []; // Array to keep track of added needs images

        console.log(addedNeedsImages);

        function addImageToSortable(imageName) {
            var droppedContainer = $sortable.find(".dropped:empty:first");
            if (droppedContainer.length > 0) {

                if (addedNeedsImages.indexOf(imageName) === -1) {
                    addedNeedsImages.push(imageName);
                    var img = new Image();
                    img.src = imageName;
                    img.onload = function() {
                        var droppedItem = $("<img>").attr("src", imageName);
                        droppedContainer.append(droppedItem);
                        var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
                        droppedContainer.append(removeButton);
                        droppedItem.animate({ width: "40%" }, function() {
                            droppedItem.animate({ height: "auto" });
                        });

                        var parentSvgButton = droppedContainer.closest(".svg-button");
                        parentSvgButton.addClass("item-dropped");

                        removeButton.click(function() {
                            parentSvgButton.removeClass("item-dropped");
                            droppedItem.remove();
                            removeButton.remove();
                            var index = addedNeedsImages.indexOf(imageName);

                            if (index !== -1) {
                                addedNeedsImages.splice(index, 1);
                            }
                        });
                    };
                }
            }
        }

        $("button img", $needs).draggable({
            cancel: "a.ui-icon",
            revert: "invalid",
            containment: "document",
            helper: "clone",
            cursor: "move",
            start: function(event, ui) {
                if ($(this).hasClass("item-dropped")) {
                    ui.helper.addClass("item-dropped");
                }
            }
        });

        $sortable.sortable({
            items: ".dropped",
            connectWith: ".dropped",
            placeholder: "ui-state-highlight",
            update: function(event, ui) {
                // Update the addedNeedsImages array to reflect the new order
                addedNeedsImages = $sortable.find(".dropped img").map(function() {
                    return $(this).attr("src");
                }).get();
            }
        });

        $sortable.find(".dropped img").draggable({
            connectToSortable: "#sortable",
            containment: "#sortable",
            helper: "clone",
            cursor: "move",
            start: function(event, ui) {
                ui.helper.addClass("item-dropped");
            },
            stop: function(event, ui) {
                // Restore original image source after dragging
                $(this).attr("src", $(this).data("original-src"));
            }
        });

        $(".remove-button").droppable({
            accept: ".dropped img",
            drop: function(event, ui) {
                // Prevent dropping images inside .remove-button
            }
        });

        $sortable.find(".dropped").sortable({
            items: "img", // Only allow sorting of images
            connectWith: ".dropped",
            placeholder: "ui-state-highlight",
            cancel: ".remove-button", // Exclude elements with the class "remove-button" from sorting
            start: function(event, ui) {
                // Store the original image source before sorting
                $(ui.item.find("img")).data("original-src", $(ui.item.find("img")).attr("src"));
            },
            stop: function(event, ui) {
                // Update the addedNeedsImages array to reflect the new order
                addedNeedsImages = $sortable.find(".dropped img").map(function() {
                    return $(this).attr("src");
                }).get();
            }
        });







        // $sortable.sortable({
        //     items: ".dropped",
        //     update: function(event, ui) {
        //         // Update the addedNeedsImages array to reflect the new order
        //         addedNeedsImages = $sortable.find(".dropped img").map(function() {
        //             return $(this).attr("src");
        //         }).get();
        //     }
        // });

        $sortable.droppable({
            accept: "#needs button img:not(.item-dropped)",
            classes: {
                "ui-droppable-active": "ui-state-highlight"
            },

            drop: function(event, ui) {
                var droppedItem = ui.draggable.clone();
                var droppedContainer = $(this).find(".dropped:empty:first");

                if (droppedContainer.length > 0) {
                    // Check if the needs image has already been added
                    var imageName = droppedItem.attr("src");
                    if (addedNeedsImages.indexOf(imageName) === -1) {
                        addedNeedsImages.push(imageName);
                        droppedContainer.append(droppedItem);
                        var removeButton = $("<button class='remove-button'><img class='close' src='/images/top-priorities/close.png' width='100%'></button>");
                        droppedContainer.append(removeButton);

                        droppedItem.animate({ width: "40%" }, function() {
                            droppedItem.find("img").animate({ height: "30px" });
                        });

                        var parentSvgButton = droppedContainer.closest(".svg-button");
                        parentSvgButton.addClass("item-dropped");

                        removeButton.click(function() {
                            parentSvgButton.removeClass("item-dropped");
                            droppedItem.remove();
                            removeButton.remove();

                            // Remove the image from the addedNeedsImages array
                            var index = addedNeedsImages.indexOf(imageName);

                            if (index !== -1) {
                                addedNeedsImages.splice(index, 1);
                            }
                        });
                    }
                }
            }
        });

        // $sortable.find(".dropped").droppable({
        //     accept: "#sortable .dropped img",
        //     drop: function(event, ui) {
        //         var sourceDropped = ui.helper.closest(".dropped");
        //         var targetDropped = $(this);

        //         // Swap the images and reset the helper
        //         var sourceImage = sourceDropped.find("img");
        //         var targetImage = targetDropped.find("img");

        //         // Swap their src attributes
        //         var tempSrc = sourceImage.attr("src");
        //         sourceImage.attr("src", targetImage.attr("src"));
        //         targetImage.attr("src", tempSrc);

        //         // Clear the helper
        //         ui.helper.empty();

        //         // Update the addedNeedsImages array
        //         var sourceIndex = addedNeedsImages.indexOf(sourceImage.attr("src"));
        //         var targetIndex = addedNeedsImages.indexOf(targetImage.attr("src"));

        //         if (sourceIndex !== -1 && targetIndex !== -1) {
        //             var tempImage = addedNeedsImages[sourceIndex];
        //             addedNeedsImages[sourceIndex] = addedNeedsImages[targetIndex];
        //             addedNeedsImages[targetIndex] = tempImage;
        //         }
        //     }
        // });

        $needs.droppable({
            accept: "#sortable button img",
            classes: {
                "ui-droppable-active": "custom-state-active"
            },

            drop: function(event, ui) {
                var droppedItem = ui.draggable;
                var parentSvgButton = droppedItem.closest(".svg-button");
                droppedItem.draggable("enable");
                droppedItem.removeClass("item-dropped");
                parentSvgButton.removeClass("item-dropped");
                droppedItem.remove();

                // Remove the image from the addedNeedsImages array
                var imageName = droppedItem.attr("src");
                var index = addedNeedsImages.indexOf(imageName);

                if (index !== -1) {
                    addedNeedsImages.splice(index, 1);
                }
            }
        });

        // Add click functionality to #needs button images
        $("button img", $needs).click(function() {
            var imageName = $(this).attr("src");
            addImageToSortable(imageName);
        });
    });
    </script> -->




    <style>
        .sortablemobileContainer {
            position: relative;
            background-color: #C0232C;
            padding: 16px;
            padding-bottom: 120px;
        }

        #sortablemobile {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #sortablemobile ul.dropdown-menu {
            width: 100%;
        }
        #sortablemobile ul.dropdown-menu.show {
            transform: translate3d(0px, 50px, 0px) !important;
        }

        #sortablemobile li {
            margin-bottom: 16px;
            padding: 12px 40px 12px 22px;
            border: 2px solid #ffffff;
            background-color: #ffffff;
            position: relative;
        }

        #sortablemobile li.is-empty {
            margin-bottom: 16px;
            padding: 12px 40px 12px 22px;
            border: 2px dashed #ffffff;
            background-color: #F2F2F288;
            color: white;
            font-size: 20px;
            font-weight: 700;
            position: relative;
        }

        #sortablemobile .ui-sortable-placeholder {
            visibility: visible !important;
            border: 2px dashed #ffffff;
            background: rgba(242, 242, 242, 0.50);
        }

        #sortablemobile li .arrowIcon {
            margin-left: -25px;
            position: absolute;
            right: 10px;
            top: 35%;
            font-size: 30px;
            transform: translate(-50%, -50%);
            color: rgba(179, 34, 42, 1);
            cursor: pointer;
        }

        /*#sortablemobile li .removeIcon {*/
        /*    background-color: rgba(179, 34, 42, 1);*/
        /*    color: white;*/
        /*    border: 2px solid white;*/
        /*    padding: 0 5px;*/
        /*    cursor: pointer;*/
        /*    border-radius: 50%;*/
        /*    position: absolute;*/
        /*    top: -50%;*/
        /*    right: 0%;*/
        /*    font-size: 20px;*/
        /*    transform: translate(50%, 70%);*/
        /*}*/

        #sortablemobile li.is-empty .arrowIcon {
            color: #fff;
        }

        #sortablemobile li .needs-icon {
            height: 2em;
        }
    </style>
    <div class="sortablemobileContainer d-block d-md-none">
        @include('templates.nav.nav-white-menu')
        <div class="row px-4 pt-3 pb-2 px-sm-5 pt-md-5 right-sidebar">
            <div class="col-12">
                <h1 class="display-4 text-white fw-bold pb-3">What are your top financial
                    priorities?</h1>
            </div>
            <div class="d-flex justify-content-between gap-2 align-items-center">
                <div>
                    <p class="text-white display-6 lh-base my-auto">Select your priorities by first to
                        last.</p>
                </div>
                <div class="d-flex gap-2 justify-content-between align-items-center text-uppercase text-light fw-bolder px-2 py-1 border border-light border-2 rounded rounded-5 user-select-none" role="button" onClick="resetPriorities()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512" fill="currentColor">
                        <path
                            d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z"/>
                    </svg>
                    <div style="font-size: 18px;">
                        Refresha
                    </div>
                </div>
            </div>
        </div>
        @php
            $topPriorities = array_pad($topPriorities ?? [], 8, null);
            $prioritiesMap = [
                'protection' => 'Protection',
                'retirement' => 'Retirement',
                'education' => 'Education',
                'savings' => 'Savings',
                'debt-cancellation' => 'Debt Cancellation',
                'health-medical' => 'Health & Medical',
                'investments' => 'Lump Sum Investment',
                'others' => 'Others',
            ];
        @endphp
        <ul id="sortablemobile">
            @foreach($topPriorities as $topPriority)
                <li class="ui-state-default dropdown @if(!$topPriority) is-empty @endif"
                    data-identifier="{{ $topPriority }}"
                >
                    <span class="arrowIcon" data-bs-toggle="dropdown" aria-expanded="false"
                          data-bs-reference="parent"
                          data-attribute="{{ $topPriority }}" data-index="{{ $loop->index }}"
                          data-bs-offset="0,0"
                    >&#8964;</span>
                    @if($topPriority)
                        {{--                        <span class="removeIcon">&#10006;</span>--}}
                        <img class="needs-icon" src="{{ asset('images/top-priorities/' . $topPriority . '-icon.png') }}"
                             alt="{{ ucwords(str_replace('-', ' ', $topPriority)) }}">
                        {{ $prioritiesMap[$topPriority] }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                    <ul class="dropdown-menu p-0 overflow-y-scroll" style="max-height: 400px;"></ul>
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

    <script>

        const data = $('#topPrioritiesButtonInput').val();
        if (data === 'null' || data === null) {
            updateMobileFields();
        }

        function nullIfNone(value) {
            if (!value) return null;
            if (value === '' || value === null || value === 'null') return null;
            return value;
        }

        function updateMobileFields(newArray = null) {
            let allNull = true;
            newArray ? newArray.map(function (value, index) {
                if (value) {
                    allNull = false;
                }
            }) : $("#sortablemobile").children('li.ui-state-default').toArray().map(function (value, index) {
                if ($(value).data('identifier')) {
                    allNull = false;
                }
            });
            let data = newArray ?? $("#sortablemobile").children('li.ui-state-default').toArray().map(function (value, index) {
                return allNull ? null : nullIfNone($(value).data('identifier'));
            });
            data = Array(8).fill(null).map((value, index) => nullIfNone(data[index]));
            let liElems = [];
            let priorityMap = {!! json_encode($prioritiesMap) !!};

            const newData = data.map(function (value, index) {
                const liElem = document.createElement('li');
                liElem.classList.add('ui-state-default', 'dropdown');
                value && liElem.setAttribute('data-identifier', value);
                if (!value) {
                    liElem.classList.add('is-empty');
                }

                const iconElem = document.createElement('span');
                iconElem.classList.add('arrowIcon');
                iconElem.setAttribute('data-bs-toggle', 'dropdown');
                iconElem.setAttribute('aria-expanded', 'false');
                iconElem.setAttribute('data-attribute', value);
                iconElem.setAttribute('data-index', index);
                iconElem.innerHTML = '&#8964;';
                liElem.appendChild(iconElem);

                if (value) {
                    const imgElem = document.createElement('img');
                    imgElem.classList.add('needs-icon');
                    imgElem.setAttribute('src', `/images/top-priorities/${value}-icon.png`);
                    liElem.appendChild(imgElem);
                    const textElem = document.createElement('span');
                    textElem.innerHTML = `${priorityMap[value]}`;
                    liElem.appendChild(textElem);
                } else {
                    const textElem = document.createElement('span');
                    textElem.innerHTML = `${index + 1}`;
                    liElem.appendChild(textElem);
                }

                const dropdownElem = document.createElement('ul');
                dropdownElem.classList.add('dropdown-menu', 'p-0', 'overflow-y-scroll');
                dropdownElem.setAttribute('style', 'max-height: 400px;');
                liElem.appendChild(dropdownElem);
                liElems.push(liElem);

                return value;
            });

            $('#sortablemobile').html(liElems);
            $('#topPrioritiesButtonInput').val(JSON.stringify(newData));
        }

        $(function () {
            new Sortable($("#sortablemobile").get(0), {
                animation: 200,
                onSort: function (event, ui) {
                    updateMobileFields();
                }
            });

            $("#sortablemobile").on('click', '.arrowIcon', function () {

                const dropdownElem = $(this).closest('li.ui-state-default').find('.dropdown-menu');
                dropdownElem.html('');

                const priorityMap = {!! json_encode($prioritiesMap) !!};
                const data = JSON.parse($('#topPrioritiesButtonInput').val());
                const index = $(this).data('index');
                const options = [];
                Object.keys(priorityMap).map(function (value) {
                    if (data.includes(value)) {
                        return;
                    }
                    const optionElem = document.createElement('li');
                    optionElem.classList.add('p-0', 'updateIndex', 'border-2', 'border-bottom', 'm-0');
                    optionElem.setAttribute('role', 'button');
                    optionElem.setAttribute('data-value', value);
                    optionElem.setAttribute('data-index', index);

                    const innerWithImage = document.createElement('a');
                    innerWithImage.classList.add('dropdown-item', 'd-flex', 'align-items-center', 'justify-content-start', 'gap-4', 'p-4');
                    const imgElem = document.createElement('img');
                    imgElem.classList.add('needs-icon');
                    imgElem.setAttribute('src', `/images/top-priorities/${value}-icon.png`);
                    innerWithImage.appendChild(imgElem);
                    const textElem = document.createElement('span');
                    textElem.innerHTML = priorityMap[value];
                    innerWithImage.appendChild(textElem);
                    optionElem.appendChild(innerWithImage);

                    // return optionElem;
                    options.push(optionElem);
                });

                if (options.length) {
                    dropdownElem.append(...options);
                } else {
                    const noOptions = document.createElement('li');
                    noOptions.classList.add('p-2');
                    noOptions.setAttribute('disabled', 'disabled');
                    noOptions.setAttribute('style', 'color: #6c757d;');
                    noOptions.innerHTML = 'No options available';
                    dropdownElem.append(noOptions);
                }
            });

            $("#sortablemobile").on('click', '.updateIndex', function () {
                const index = $(this).data('index');
                const value = $(this).data('value');
                const data = JSON.parse($('#topPrioritiesButtonInput').val());
                data[index] = value;
                updateMobileFields(data);
            });
        });

        function removeAllInWeb() {
            $("#sortable").find(".remove-button").toArray().map(function (value) {
                $(value).click();
            });
        }

        function resetPriorities() {
            updateMobileFields([null, null, null, null, null, null, null, null]);
            removeAllInWeb();
        }
    </script>

@endsection