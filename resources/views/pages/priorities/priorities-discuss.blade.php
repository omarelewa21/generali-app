<?php
 /**
 * Template Name: Priorities To Discuss Page
 */
?>

@extends('templates.master')

@section('title')
<title>Priorities To Discuss</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $topPriorities = session('customer_details.financial_priorities');
    $prioritiesDiscuss = session('customer_details.priorities');
@endphp

<div id="priorities_to_discuss">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 wrapper-avatar-default bg-white px-0 order-md-1 order-sm-2 order-2">
                <div class="header"><div class="row">@include('templates.nav.nav-red-white-menu')</div></div>    
                <section class="content-avatar-default">
                    <div class="col-12 text-center position-relative">
                        <h2 class="display-5 fw-bold lh-base text-center">I'd like to figure out future plans for these:</h2>
                        <div id="sortable-main" class="position-relative pt-3">
                            <svg width="100%" height="100%" viewBox="0 0 776 389" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="second @if(isset($topPriorities) && isset($topPriorities[1])) item-dropped @endif" d="M217.69 224.091C196.716 246.11 179.97 272.188 168.769 301.045L30.2097 247.62C48.5897 200.803 75.8854 158.479 110.016 122.74L217.69 224.091Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="fourth @if(isset($topPriorities) && isset($topPriorities[3])) item-dropped @endif" d="M387.489 151.333C354.661 151.333 323.41 158.078 295.051 170.266L236.951 34.6854C283.175 14.9411 334.052 4 387.477 4V151.333H387.489Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="third @if(isset($topPriorities) && isset($topPriorities[2])) item-dropped @endif" d="M295.051 170.266C265.687 182.865 239.42 201.294 217.691 224.091L110.017 122.74C145.668 85.401 188.783 55.2644 236.951 34.6855L295.051 170.266Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="first @if(isset($topPriorities) && isset($topPriorities[0])) item-dropped @endif" d="M168.769 301.044C158.767 326.802 153.189 354.766 152.949 384L4 376.454C5.31449 331.101 14.4816 287.714 30.2098 247.619L168.769 301.044Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="seventh @if(isset($topPriorities) && isset($topPriorities[6])) item-dropped @endif" d="M744.39 246.625L606.083 300.679C594.961 272.166 578.41 246.351 557.709 224.526L666.104 123.929C699.469 159.165 726.239 200.723 744.39 246.625Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="fifth @if(isset($topPriorities) && isset($topPriorities[4])) item-dropped @endif" d="M539.329 35.2456L480.417 170.472C451.933 158.158 420.511 151.333 387.5 151.333H387.489V4H387.5C441.44 4 492.762 15.1583 539.329 35.2456Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="eight @if(isset($topPriorities) && isset($topPriorities[7])) item-dropped @endif" d="M771 376.42L622.051 383.988C621.811 354.618 616.176 326.528 606.083 300.678L744.39 246.625C760.358 286.982 769.674 330.701 771 376.42Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path class="sixth @if(isset($topPriorities) && isset($topPriorities[5])) item-dropped @endif" d="M666.104 123.929L557.71 224.525C536.026 201.649 509.771 183.139 480.417 170.472L539.33 35.2456C587.486 56.0188 630.555 86.3726 666.104 123.929Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                <path opacity="0.5" d="M87.088 350V305.2H79.856C79.6 306.907 79.0667 308.336 78.256 309.488C77.4453 310.64 76.4427 311.579 75.248 312.304C74.096 312.987 72.7733 313.477 71.28 313.776C69.8293 314.032 68.3147 314.139 66.736 314.096V320.944H78V350H87.088Z" fill="#707070"/>
                                <path opacity="0.5" d="M108.368 214.416H117.072C117.072 213.221 117.179 212.027 117.392 210.832C117.648 209.595 118.053 208.485 118.608 207.504C119.163 206.48 119.888 205.669 120.784 205.072C121.723 204.432 122.853 204.112 124.176 204.112C126.139 204.112 127.739 204.731 128.976 205.968C130.256 207.163 130.896 208.848 130.896 211.024C130.896 212.389 130.576 213.605 129.936 214.672C129.339 215.739 128.571 216.699 127.632 217.552C126.736 218.405 125.733 219.195 124.624 219.92C123.515 220.603 122.469 221.285 121.488 221.968C119.568 223.291 117.733 224.592 115.984 225.872C114.277 227.152 112.784 228.56 111.504 230.096C110.224 231.589 109.2 233.296 108.432 235.216C107.707 237.136 107.344 239.397 107.344 242H140.24V234.192H119.056C120.165 232.656 121.445 231.312 122.896 230.16C124.347 229.008 125.84 227.941 127.376 226.96C128.912 225.936 130.427 224.912 131.92 223.888C133.456 222.864 134.821 221.733 136.016 220.496C137.211 219.216 138.171 217.765 138.896 216.144C139.621 214.523 139.984 212.581 139.984 210.32C139.984 208.144 139.557 206.181 138.704 204.432C137.893 202.683 136.784 201.211 135.376 200.016C133.968 198.821 132.325 197.904 130.448 197.264C128.613 196.624 126.672 196.304 124.624 196.304C121.936 196.304 119.547 196.773 117.456 197.712C115.408 198.608 113.701 199.888 112.336 201.552C110.971 203.173 109.947 205.093 109.264 207.312C108.581 209.488 108.283 211.856 108.368 214.416Z" fill="#707070"/>
                                <path opacity="0.5" d="M204.592 128.312V134.712C205.701 134.712 206.853 134.755 208.048 134.84C209.285 134.883 210.416 135.117 211.44 135.544C212.464 135.928 213.296 136.568 213.936 137.464C214.619 138.36 214.96 139.661 214.96 141.368C214.96 143.544 214.256 145.272 212.848 146.552C211.44 147.789 209.712 148.408 207.664 148.408C206.341 148.408 205.189 148.173 204.208 147.704C203.269 147.235 202.48 146.616 201.84 145.848C201.2 145.037 200.709 144.099 200.368 143.032C200.027 141.923 199.835 140.771 199.792 139.576H191.152C191.109 142.179 191.472 144.483 192.24 146.488C193.051 148.493 194.181 150.2 195.632 151.608C197.083 152.973 198.832 154.019 200.88 154.744C202.971 155.469 205.275 155.832 207.792 155.832C209.968 155.832 212.059 155.512 214.064 154.872C216.069 154.232 217.84 153.293 219.376 152.056C220.912 150.819 222.128 149.283 223.024 147.448C223.963 145.613 224.432 143.523 224.432 141.176C224.432 138.616 223.728 136.419 222.32 134.584C220.912 132.749 218.971 131.555 216.496 131V130.872C218.587 130.275 220.144 129.144 221.168 127.48C222.235 125.816 222.768 123.896 222.768 121.72C222.768 119.715 222.32 117.944 221.424 116.408C220.528 114.872 219.355 113.571 217.904 112.504C216.496 111.437 214.896 110.648 213.104 110.136C211.312 109.581 209.52 109.304 207.728 109.304C205.424 109.304 203.333 109.688 201.456 110.456C199.579 111.181 197.957 112.227 196.592 113.592C195.269 114.957 194.224 116.6 193.456 118.52C192.731 120.397 192.325 122.488 192.24 124.792H200.88C200.837 122.488 201.392 120.589 202.544 119.096C203.739 117.56 205.488 116.792 207.792 116.792C209.456 116.792 210.928 117.304 212.208 118.328C213.488 119.352 214.128 120.824 214.128 122.744C214.128 124.024 213.808 125.048 213.168 125.816C212.571 126.584 211.781 127.181 210.8 127.608C209.861 127.992 208.837 128.227 207.728 128.312C206.619 128.397 205.573 128.397 204.592 128.312Z" fill="#707070"/>
                                <path opacity="0.5" d="M331.968 69.592V85.144H320.192L331.776 69.592H331.968ZM331.968 92.632V103H340.608V92.632H346.56V85.144H340.608V58.2H332.48L313.024 84.312V92.632H331.968Z" fill="#707070"/>
                                <path opacity="0.5" d="M459 65.688V58.2H433.976L429.56 82.968H437.752C438.648 81.7307 439.608 80.8347 440.632 80.28C441.656 79.6827 442.979 79.384 444.6 79.384C445.837 79.384 446.925 79.5973 447.864 80.024C448.803 80.4507 449.613 81.048 450.296 81.816C450.979 82.584 451.491 83.48 451.832 84.504C452.173 85.528 452.344 86.616 452.344 87.768C452.344 88.8773 452.152 89.9653 451.768 91.032C451.427 92.056 450.915 92.9733 450.232 93.784C449.592 94.552 448.781 95.192 447.8 95.704C446.861 96.1733 445.795 96.408 444.6 96.408C442.552 96.408 440.867 95.8107 439.544 94.616C438.221 93.3787 437.453 91.736 437.24 89.688H428.152C428.195 92.0347 428.664 94.104 429.56 95.896C430.499 97.6453 431.736 99.1173 433.272 100.312C434.808 101.507 436.557 102.403 438.52 103C440.525 103.555 442.616 103.832 444.792 103.832C447.053 103.875 449.187 103.512 451.192 102.744C453.197 101.933 454.947 100.803 456.44 99.352C457.976 97.9013 459.192 96.1947 460.088 94.232C460.984 92.2267 461.432 90.072 461.432 87.768C461.432 85.6773 461.112 83.7147 460.472 81.88C459.875 80.0027 458.979 78.3813 457.784 77.016C456.632 75.6507 455.203 74.5627 453.496 73.752C451.789 72.9413 449.827 72.536 447.608 72.536C445.816 72.536 444.216 72.8133 442.808 73.368C441.4 73.88 440.077 74.7547 438.84 75.992L438.712 75.864L440.504 65.688H459Z" fill="#707070"/>
                                <path opacity="0.5" d="M558.304 131.768C559.456 131.768 560.459 132.024 561.312 132.536C562.208 133.005 562.933 133.645 563.488 134.456C564.043 135.224 564.448 136.12 564.704 137.144C565.003 138.125 565.152 139.149 565.152 140.216C565.152 141.24 565.003 142.243 564.704 143.224C564.405 144.205 563.957 145.08 563.36 145.848C562.763 146.616 562.037 147.235 561.184 147.704C560.373 148.173 559.413 148.408 558.304 148.408C557.152 148.408 556.128 148.173 555.232 147.704C554.336 147.235 553.568 146.616 552.928 145.848C552.331 145.037 551.861 144.141 551.52 143.16C551.221 142.136 551.072 141.112 551.072 140.088C551.072 138.979 551.221 137.933 551.52 136.952C551.819 135.928 552.267 135.032 552.864 134.264C553.461 133.496 554.208 132.899 555.104 132.472C556.043 132.003 557.109 131.768 558.304 131.768ZM564.832 121.72H573.472C573.216 119.715 572.683 117.944 571.872 116.408C571.061 114.872 570.016 113.592 568.736 112.568C567.456 111.501 565.984 110.691 564.32 110.136C562.656 109.581 560.864 109.304 558.944 109.304C555.744 109.304 553.035 110.008 550.816 111.416C548.597 112.824 546.784 114.659 545.376 116.92C543.968 119.139 542.944 121.635 542.304 124.408C541.664 127.181 541.344 129.955 541.344 132.728C541.344 135.587 541.6 138.403 542.112 141.176C542.624 143.907 543.541 146.36 544.864 148.536C546.187 150.712 547.957 152.483 550.176 153.848C552.395 155.171 555.189 155.832 558.56 155.832C560.907 155.832 563.04 155.427 564.96 154.616C566.88 153.763 568.523 152.611 569.888 151.16C571.296 149.667 572.363 147.939 573.088 145.976C573.856 143.971 574.24 141.816 574.24 139.512C574.24 137.72 573.963 135.949 573.408 134.2C572.853 132.451 571.979 130.893 570.784 129.528C569.504 128.12 567.947 127.011 566.112 126.2C564.277 125.347 562.4 124.92 560.48 124.92C558.304 124.92 556.384 125.304 554.72 126.072C553.056 126.84 551.605 128.12 550.368 129.912L550.24 129.784C550.283 128.547 550.453 127.139 550.752 125.56C551.051 123.981 551.52 122.509 552.16 121.144C552.8 119.736 553.653 118.563 554.72 117.624C555.829 116.643 557.195 116.152 558.816 116.152C560.395 116.152 561.717 116.707 562.784 117.816C563.851 118.925 564.533 120.227 564.832 121.72Z" fill="#707070"/>
                                <path opacity="0.5" d="M663.088 210.008V202.2H632.496V210.648H653.744C649.477 215.811 646.021 221.485 643.376 227.672C640.773 233.859 639.216 240.301 638.704 247H648.432C648.475 244.013 648.816 240.792 649.456 237.336C650.139 233.88 651.077 230.467 652.272 227.096C653.509 223.725 655.024 220.547 656.816 217.56C658.651 214.573 660.741 212.056 663.088 210.008Z" fill="#707070"/>
                                <path opacity="0.5" d="M685.008 317.36C685.008 316.336 685.179 315.44 685.52 314.672C685.904 313.904 686.416 313.264 687.056 312.752C687.696 312.24 688.421 311.856 689.232 311.6C690.085 311.301 690.96 311.152 691.856 311.152C693.264 311.152 694.395 311.365 695.248 311.792C696.144 312.219 696.827 312.752 697.296 313.392C697.808 314.032 698.149 314.715 698.32 315.44C698.491 316.123 698.576 316.763 698.576 317.36C698.576 319.28 697.936 320.752 696.656 321.776C695.376 322.757 693.776 323.248 691.856 323.248C690.021 323.248 688.421 322.757 687.056 321.776C685.691 320.752 685.008 319.28 685.008 317.36ZM676.752 316.528C676.752 318.747 677.307 320.688 678.416 322.352C679.525 324.016 681.168 325.147 683.344 325.744V325.872C680.656 326.512 678.565 327.792 677.072 329.712C675.621 331.632 674.896 334.021 674.896 336.88C674.896 339.312 675.365 341.403 676.304 343.152C677.285 344.901 678.565 346.352 680.144 347.504C681.765 348.656 683.579 349.488 685.584 350C687.632 350.555 689.744 350.832 691.92 350.832C694.011 350.832 696.059 350.555 698.064 350C700.069 349.403 701.861 348.528 703.44 347.376C705.019 346.224 706.277 344.773 707.216 343.024C708.197 341.275 708.688 339.205 708.688 336.816C708.688 334 707.963 331.632 706.512 329.712C705.061 327.749 702.992 326.469 700.304 325.872V325.744C702.48 325.019 704.101 323.824 705.168 322.16C706.277 320.496 706.832 318.555 706.832 316.336C706.832 315.227 706.576 313.989 706.064 312.624C705.552 311.216 704.699 309.915 703.504 308.72C702.352 307.483 700.816 306.437 698.896 305.584C696.976 304.731 694.629 304.304 691.856 304.304C690.021 304.304 688.208 304.56 686.416 305.072C684.624 305.584 683.003 306.352 681.552 307.376C680.144 308.4 678.992 309.68 678.096 311.216C677.2 312.752 676.752 314.523 676.752 316.528ZM683.984 336.432C683.984 334.128 684.752 332.379 686.288 331.184C687.824 329.947 689.701 329.328 691.92 329.328C692.987 329.328 693.968 329.499 694.864 329.84C695.803 330.181 696.613 330.672 697.296 331.312C698.021 331.952 698.576 332.72 698.96 333.616C699.387 334.469 699.6 335.429 699.6 336.496C699.6 337.605 699.408 338.629 699.024 339.568C698.64 340.507 698.085 341.317 697.36 342C696.677 342.64 695.867 343.152 694.928 343.536C694.032 343.877 693.029 344.048 691.92 344.048C690.853 344.048 689.829 343.877 688.848 343.536C687.867 343.152 687.013 342.64 686.288 342C685.605 341.317 685.051 340.507 684.624 339.568C684.197 338.629 683.984 337.584 683.984 336.432Z" fill="#707070"/>
                            </svg>
                            
                            <div id="sortable" class="position-absolute pt-3">
                                <div class="svg-container first d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[0])) item-dropped @endif" data-svg-class="first">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[0]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <img src="http://127.0.0.1:8000/images/top-priorities/discuss-icon.png" class="position-absolute top-0 {{$topPriorities[0]}}" data-identifier="{{$topPriorities[0]}}" width="40px" style="left: 10px;">
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[0]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[0] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="180" height="100" viewBox="0 0 166 138" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container second d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[1])) item-dropped @endif" data-svg-class="second">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[1]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <img src="http://127.0.0.1:8000/images/top-priorities/discuss-icon.png" class="position-absolute {{$topPriorities[1]}}" data-identifier="{{$topPriorities[1]}}" width="40px" style="left: 20px;top: 50px">
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[1]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[1] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="200" height="125" viewBox="0 0 190 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container third d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[2])) item-dropped @endif" data-svg-class="third">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[2]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <img src="http://127.0.0.1:8000/images/top-priorities/discuss-icon.png" class="position-absolute top-0 {{$topPriorities[2]}}" width="40px" style="left: 60px;">
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[2]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[2] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="200" height="130" viewBox="0 0 187 191" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container fourth d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[3])) item-dropped @endif" data-svg-class="fourth">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[3]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <img src="http://127.0.0.1:8000/images/top-priorities/discuss-icon.png" class="position-absolute {{$topPriorities[3]}}" width="40px" style="left: 60px;top: -20px">
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[3]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[3] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="152" height="120" viewBox="0 0 152 168" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M151.489 148.333C118.661 148.333 87.4099 155.078 59.0512 167.266L0.950684 31.6854C47.1751 11.9411 98.0516 1 151.477 1V148.333H151.489Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container fifth d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[4])) item-dropped @endif" data-svg-class="fifth">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[4]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <img src="http://127.0.0.1:8000/images/top-priorities/discuss-icon.png" class="position-absolute {{$topPriorities[4]}}" width="40px" style="left: 60px;top: -20px">
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[4]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[4] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="154" height="120" viewBox="0 0 154 169" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M153.329 32.2456L94.4173 167.472C65.9329 155.158 34.5108 148.333 1.49997 148.333H1.48853V1H1.49997C55.4398 1 106.762 12.1583 153.329 32.2456Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container sixth d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[5])) item-dropped @endif" data-svg-class="sixth">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[5]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <img src="http://127.0.0.1:8000/images/top-priorities/discuss-icon.png" class="position-absolute top-0 {{$topPriorities[5]}}" width="40px" style="left: 120px;">
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[5]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[5] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="188" height="135" viewBox="0 0 188 192" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M187.104 89.929L78.7096 190.525C57.0262 167.649 30.7706 149.139 1.41748 136.472L60.3296 1.24561C108.486 22.0188 151.555 52.3726 187.104 89.929Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container seventh d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[6])) item-dropped @endif" data-svg-class="seventh">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[6]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[6]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[6] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="190" height="125" viewBox="0 0 190 179" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M188.39 123.625L50.0827 177.679C38.961 149.166 22.4099 123.351 1.70947 101.526L110.104 0.929199C143.469 36.1648 170.239 77.7226 188.39 123.625Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container eight d-flex justify-content-center align-items-center position-relative @if(isset($topPriorities) && isset($topPriorities[7])) item-dropped @endif" data-svg-class="eight">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        @if(!isset($topPriorities) || !isset($topPriorities[7]))
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        @else
                                            <div class="dropped position-absolute d-flex justify-content-center align-items-center" data-identifier="{{$topPriorities[7]}}">
                                                <div class='sortable-container'>
                                                    <img class="inner-dropped" src="{{ asset('images/top-priorities/' . $topPriorities[7] . '-icon.png') }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        @endif
                                        <svg width="167" height="100" viewBox="0 0 167 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M166 131.42L17.051 138.988C16.811 109.618 11.1758 81.5276 1.08276 55.6783L139.39 1.62451C155.358 41.9819 164.674 85.7006 166 131.42Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 position-absolute" style="top: 50%;">
                            <img src="{{ asset($image) }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 order-md-2 order-1 order-xs-1 content-section">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-3 pb-2 px-md-5 pt-md-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white fw-bold pb-3">Let's go through what you'd like to discuss.</h1>
                                </div>
                            </div>
                            <div class="row px-4 pb-2 px-md-5">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accordionPriorities">
                                        @php
                                            if (isset($topPriorities)) {
                                                foreach($topPriorities as $priority) {
                                                    if ($priority === 'protection') {
                                                        $title = 'Protection';
                                                    }
                                                    else if ($priority === 'retirement') {
                                                        $title = 'Retirement';
                                                    }
                                                    else if ($priority === 'education') {
                                                        $title = 'Education';
                                                    }
                                                    else if ($priority === 'savings') {
                                                        $title = 'Savings';
                                                    }
                                                    else if ($priority === 'debt-cancellation') {
                                                        $title = 'Debt Cancellation';
                                                    }
                                                    else if ($priority === 'health-medical') {
                                                        $title = 'Health Medical';
                                                    }
                                                    else if ($priority === 'investments') {
                                                        $title = 'Lump Sum Investment';
                                                    }
                                                    else if ($priority === 'others') {
                                                        $title = 'Others';
                                                    }
                                                    else {
                                                        $title = '';
                                                    }

                                                    if ($priority) { @endphp
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{$priority}}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$priority}}" aria-expanded="true" aria-controls="flush-collapse{{$priority}}">
                                                                    <img src="{{ asset('images/top-priorities/'.$priority.'-icon.png') }}" width="60px" height="auto" alt="{{$priority}}" class="pe-4"> {{$title}}
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{$priority}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$priority}}" data-bs-parent="#accordionPriorities">
                                                                <div class="accordion-body">
                                                                    <div class="row py-2 px-3">
                                                                        <div class="col-12 form-check form-check-reverse">
                                                                            <label class="form-check-label display-6" for="{{$priority}}">I've got this covered</label>
                                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-onlabel="YES" data-offlabel="NO" data-width="90" data-height="25" id="{{$priority}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row py-2 px-3 discussthis">
                                                                        <div class="col-12 form-check form-check-reverse">
                                                                            <label class="form-check-label display-6" for="{{$priority}}Discuss">I'd like to discuss this</label>
                                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-onlabel="YES" data-offlabel="NO" data-width="90" data-height="25" id="{{$priority}}Discuss">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @php } 
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="prioritiesDiscussInput" id="prioritiesDiscussInput" value="{{ json_encode($prioritiesDiscuss) }}">
                                    <a href="{{route('top.priorities')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                                    <a href="" class="btn btn-primary flex-fill text-uppercase" id="priorityNext">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="missingLastPageInputFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingLastPageInputFieldsLabel">Top Priorities is Required</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input the value in top priorities page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
    var lastPageInput = {!! json_encode($topPriorities) !!};
    if (lastPageInput == null || lastPageInput == undefined || lastPageInput == '') {
        var nameModal = document.getElementById('missingLastPageInputFields');
        nameModal.classList.add('show');
        nameModal.style.display = 'block';
        document.querySelector('body').style.paddingRight = '0px';
        document.querySelector('body').style.overflow = 'hidden';
        document.querySelector('body').classList.add('modal-open');

        var modalBackdrop = document.createElement('div');
        modalBackdrop.className = 'modal-backdrop fade show';
        document.querySelector('body.modal-open').append(modalBackdrop);

        // Close the modal
        var closeButton = document.querySelector('#missingLastPageInputFields .btn-exit-sidebar');
        closeButton.addEventListener('click', function() {
            nameModal.classList.remove('show');
            nameModal.style.display = 'none';
            document.querySelector('body').style.paddingRight = '';
            document.querySelector('body').style.overflow = '';
            document.querySelector('body').classList.remove('modal-open');
            var modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
            window.location.href = '/financial-priorities';
        });

    } else{
        document.addEventListener('DOMContentLoaded', function() {

            // Ensure the first accordion item is always open
            const firstAccordionItem = document.querySelector('.accordion-item:first-of-type');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (firstAccordionItem) {
                const firstCollapse = firstAccordionItem.querySelector('.accordion-collapse');
                firstCollapse.classList.add('show');
            }

            // Sent checkbox value to controller
            var checkboxValues = {};

            // First set all to true
            $('input[type="checkbox"]').each(function() {
                var checkboxId = $(this).attr('id');
                checkboxValues[checkboxId] = true;
                $(this).prop('checked', true); // Check the checkboxes initially
            });

            // Update checkboxValues object when any checkbox is changed
            $('input[type="checkbox"]').on('change', function() {
                var checkboxId = $(this).attr('id');
                
                var isChecked = $(this).prop('checked');
                checkboxValues[checkboxId] = isChecked;
                var droppedDiv = document.querySelectorAll('.dropped');

                if (!isChecked) {
                    droppedDiv.forEach(function(element) {
                        var droppedAttribute = element.getAttribute("data-identifier");
                        var image = document.querySelector('img.' + droppedAttribute);
                        // console.log(image);
                        if (image) {
                            image.style.display = 'none';
                        }
                    });
                }
                else {
                    droppedDiv.forEach(function(element) {
                        var droppedAttribute = element.getAttribute("data-identifier");
                        var image = document.querySelector('img.' + droppedAttribute);
                        if (image) {
                            image.style.display = 'block';
                        }
                    });
                }

                if (checkboxId == 'protectionDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                    if(checkboxId == 'retirementDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                        if(checkboxId == 'educationDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                            if(checkboxId == 'savingsDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                                if(checkboxId == 'investmentsDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                                    if(checkboxId == 'health-medicalDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                                        if(checkboxId == 'debt-cancellationDiscuss' && (checkboxValues[checkboxId] == false || checkboxValues[checkboxId] == 'false') ){
                                        
                                        } else {
                                            // document.getElementById('priorityNext').setAttribute('href', route('debt.cancellation.home'));
                                            console.log('go protection page');
                                        }
                                        console.log('health false');
                                    } else {
                                        // document.getElementById('priorityNext').setAttribute('href', route('debt.cancellation.home'));
                                        console.log('go debt-cancellation page');
                                    }
                                    console.log('investment false');
                                } else{
                                    // document.getElementById('priorityNext').setAttribute('href', route('health.medical.home'));
                                    console.log('go health-medical page');
                                }
                                console.log('savings false');
                            } else{
                                // document.getElementById('priorityNext').setAttribute('href', route('investment.home'));
                                console.log('go investment page');
                            }
                            console.log('education false');
                        } else {
                            // document.getElementById('priorityNext').setAttribute('href', route('savings.home'));
                            console.log('go savings page');
                        }
                        console.log('retirement false');
                    } else{
                        // document.getElementById('priorityNext').setAttribute('href', route('education.home'));
                        console.log('go education page');
                    }
                    console.log('protection false');
                }else{
                    console.log('go retirement page');
                    // document.getElementById('priorityNext').setAttribute('href', route('retirement.home'));
                }
            });

            $('#priorityNext').on('click', function(event) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('priorities.redirect') }}",
                    data: checkboxValues,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle success, if needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error, if needed
                    }
                });
            });
        });
    }
</script>
@endsection