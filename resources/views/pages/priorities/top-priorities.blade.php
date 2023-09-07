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

<div id="top_priorities" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <div class="header-avatar-default">@include('templates.nav.nav-red-menu')</div>    
                <section class="avatar-design-placeholder content-avatar-default">
                    <div class="col-12 text-center position-relative">
                        <h4 class="fw-bold">Here's how I see my priorities:</h4>
                            
                        <div id="sortable-main" class="position-relative pt-3">
                            <svg width="100%" height="auto" viewBox="0 0 767 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_205_2143)">
                                    <path class="second" d="M213.69 220.091C192.716 242.11 175.97 268.188 164.769 297.045L26.2097 243.62C44.5897 196.803 71.8854 154.479 106.016 118.74L213.69 220.091Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="fourth" d="M383.489 147.333C350.661 147.333 319.41 154.078 291.051 166.266L232.951 30.6854C279.175 10.9411 330.052 0 383.477 0V147.333H383.489Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="third" d="M291.051 166.266C261.687 178.865 235.42 197.294 213.691 220.091L106.017 118.74C141.668 81.401 184.783 51.2644 232.951 30.6855L291.051 166.266Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="first" d="M164.769 297.044C154.767 322.802 149.189 350.766 148.949 380L0 372.454C1.31449 327.101 10.4816 283.714 26.2098 243.619L164.769 297.044Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="seventh" d="M740.39 242.625L602.083 296.679C590.961 268.166 574.41 242.351 553.709 220.526L662.104 119.929C695.469 155.165 722.239 196.723 740.39 242.625Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="fifth" d="M535.329 31.2456L476.417 166.472C447.933 154.158 416.511 147.333 383.5 147.333H383.489V0H383.5C437.44 0 488.762 11.1583 535.329 31.2456Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="eight" d="M767 372.42L618.051 379.988C617.811 350.618 612.176 322.528 602.083 296.678L740.39 242.625C756.358 282.982 765.674 326.701 767 372.42Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path class="sixth" d="M662.104 119.929L553.71 220.525C532.026 197.649 505.771 179.139 476.417 166.472L535.33 31.2456C583.486 52.0188 626.555 82.3726 662.104 119.929Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                    <path opacity="0.5" d="M83.088 346V301.2H75.856C75.6 302.907 75.0667 304.336 74.256 305.488C73.4453 306.64 72.4427 307.579 71.248 308.304C70.096 308.987 68.7733 309.477 67.28 309.776C65.8293 310.032 64.3147 310.139 62.736 310.096V316.944H74V346H83.088Z" fill="#707070"/>
                                    <path opacity="0.5" d="M104.368 210.416H113.072C113.072 209.221 113.179 208.027 113.392 206.832C113.648 205.595 114.053 204.485 114.608 203.504C115.163 202.48 115.888 201.669 116.784 201.072C117.723 200.432 118.853 200.112 120.176 200.112C122.139 200.112 123.739 200.731 124.976 201.968C126.256 203.163 126.896 204.848 126.896 207.024C126.896 208.389 126.576 209.605 125.936 210.672C125.339 211.739 124.571 212.699 123.632 213.552C122.736 214.405 121.733 215.195 120.624 215.92C119.515 216.603 118.469 217.285 117.488 217.968C115.568 219.291 113.733 220.592 111.984 221.872C110.277 223.152 108.784 224.56 107.504 226.096C106.224 227.589 105.2 229.296 104.432 231.216C103.707 233.136 103.344 235.397 103.344 238H136.24V230.192H115.056C116.165 228.656 117.445 227.312 118.896 226.16C120.347 225.008 121.84 223.941 123.376 222.96C124.912 221.936 126.427 220.912 127.92 219.888C129.456 218.864 130.821 217.733 132.016 216.496C133.211 215.216 134.171 213.765 134.896 212.144C135.621 210.523 135.984 208.581 135.984 206.32C135.984 204.144 135.557 202.181 134.704 200.432C133.893 198.683 132.784 197.211 131.376 196.016C129.968 194.821 128.325 193.904 126.448 193.264C124.613 192.624 122.672 192.304 120.624 192.304C117.936 192.304 115.547 192.773 113.456 193.712C111.408 194.608 109.701 195.888 108.336 197.552C106.971 199.173 105.947 201.093 105.264 203.312C104.581 205.488 104.283 207.856 104.368 210.416Z" fill="#707070"/>
                                    <path opacity="0.5" d="M200.592 124.312V130.712C201.701 130.712 202.853 130.755 204.048 130.84C205.285 130.883 206.416 131.117 207.44 131.544C208.464 131.928 209.296 132.568 209.936 133.464C210.619 134.36 210.96 135.661 210.96 137.368C210.96 139.544 210.256 141.272 208.848 142.552C207.44 143.789 205.712 144.408 203.664 144.408C202.341 144.408 201.189 144.173 200.208 143.704C199.269 143.235 198.48 142.616 197.84 141.848C197.2 141.037 196.709 140.099 196.368 139.032C196.027 137.923 195.835 136.771 195.792 135.576H187.152C187.109 138.179 187.472 140.483 188.24 142.488C189.051 144.493 190.181 146.2 191.632 147.608C193.083 148.973 194.832 150.019 196.88 150.744C198.971 151.469 201.275 151.832 203.792 151.832C205.968 151.832 208.059 151.512 210.064 150.872C212.069 150.232 213.84 149.293 215.376 148.056C216.912 146.819 218.128 145.283 219.024 143.448C219.963 141.613 220.432 139.523 220.432 137.176C220.432 134.616 219.728 132.419 218.32 130.584C216.912 128.749 214.971 127.555 212.496 127V126.872C214.587 126.275 216.144 125.144 217.168 123.48C218.235 121.816 218.768 119.896 218.768 117.72C218.768 115.715 218.32 113.944 217.424 112.408C216.528 110.872 215.355 109.571 213.904 108.504C212.496 107.437 210.896 106.648 209.104 106.136C207.312 105.581 205.52 105.304 203.728 105.304C201.424 105.304 199.333 105.688 197.456 106.456C195.579 107.181 193.957 108.227 192.592 109.592C191.269 110.957 190.224 112.6 189.456 114.52C188.731 116.397 188.325 118.488 188.24 120.792H196.88C196.837 118.488 197.392 116.589 198.544 115.096C199.739 113.56 201.488 112.792 203.792 112.792C205.456 112.792 206.928 113.304 208.208 114.328C209.488 115.352 210.128 116.824 210.128 118.744C210.128 120.024 209.808 121.048 209.168 121.816C208.571 122.584 207.781 123.181 206.8 123.608C205.861 123.992 204.837 124.227 203.728 124.312C202.619 124.397 201.573 124.397 200.592 124.312Z" fill="#707070"/>
                                    <path opacity="0.5" d="M327.968 65.592V81.144H316.192L327.776 65.592H327.968ZM327.968 88.632V99H336.608V88.632H342.56V81.144H336.608V54.2H328.48L309.024 80.312V88.632H327.968Z" fill="#707070"/>
                                    <path opacity="0.5" d="M455 61.688V54.2H429.976L425.56 78.968H433.752C434.648 77.7307 435.608 76.8347 436.632 76.28C437.656 75.6827 438.979 75.384 440.6 75.384C441.837 75.384 442.925 75.5973 443.864 76.024C444.803 76.4507 445.613 77.048 446.296 77.816C446.979 78.584 447.491 79.48 447.832 80.504C448.173 81.528 448.344 82.616 448.344 83.768C448.344 84.8773 448.152 85.9653 447.768 87.032C447.427 88.056 446.915 88.9733 446.232 89.784C445.592 90.552 444.781 91.192 443.8 91.704C442.861 92.1733 441.795 92.408 440.6 92.408C438.552 92.408 436.867 91.8107 435.544 90.616C434.221 89.3787 433.453 87.736 433.24 85.688H424.152C424.195 88.0347 424.664 90.104 425.56 91.896C426.499 93.6453 427.736 95.1173 429.272 96.312C430.808 97.5067 432.557 98.4027 434.52 99C436.525 99.5547 438.616 99.832 440.792 99.832C443.053 99.8747 445.187 99.512 447.192 98.744C449.197 97.9333 450.947 96.8027 452.44 95.352C453.976 93.9013 455.192 92.1947 456.088 90.232C456.984 88.2267 457.432 86.072 457.432 83.768C457.432 81.6773 457.112 79.7147 456.472 77.88C455.875 76.0027 454.979 74.3813 453.784 73.016C452.632 71.6507 451.203 70.5627 449.496 69.752C447.789 68.9413 445.827 68.536 443.608 68.536C441.816 68.536 440.216 68.8133 438.808 69.368C437.4 69.88 436.077 70.7547 434.84 71.992L434.712 71.864L436.504 61.688H455Z" fill="#707070"/>
                                    <path opacity="0.5" d="M554.304 127.768C555.456 127.768 556.459 128.024 557.312 128.536C558.208 129.005 558.933 129.645 559.488 130.456C560.043 131.224 560.448 132.12 560.704 133.144C561.003 134.125 561.152 135.149 561.152 136.216C561.152 137.24 561.003 138.243 560.704 139.224C560.405 140.205 559.957 141.08 559.36 141.848C558.763 142.616 558.037 143.235 557.184 143.704C556.373 144.173 555.413 144.408 554.304 144.408C553.152 144.408 552.128 144.173 551.232 143.704C550.336 143.235 549.568 142.616 548.928 141.848C548.331 141.037 547.861 140.141 547.52 139.16C547.221 138.136 547.072 137.112 547.072 136.088C547.072 134.979 547.221 133.933 547.52 132.952C547.819 131.928 548.267 131.032 548.864 130.264C549.461 129.496 550.208 128.899 551.104 128.472C552.043 128.003 553.109 127.768 554.304 127.768ZM560.832 117.72H569.472C569.216 115.715 568.683 113.944 567.872 112.408C567.061 110.872 566.016 109.592 564.736 108.568C563.456 107.501 561.984 106.691 560.32 106.136C558.656 105.581 556.864 105.304 554.944 105.304C551.744 105.304 549.035 106.008 546.816 107.416C544.597 108.824 542.784 110.659 541.376 112.92C539.968 115.139 538.944 117.635 538.304 120.408C537.664 123.181 537.344 125.955 537.344 128.728C537.344 131.587 537.6 134.403 538.112 137.176C538.624 139.907 539.541 142.36 540.864 144.536C542.187 146.712 543.957 148.483 546.176 149.848C548.395 151.171 551.189 151.832 554.56 151.832C556.907 151.832 559.04 151.427 560.96 150.616C562.88 149.763 564.523 148.611 565.888 147.16C567.296 145.667 568.363 143.939 569.088 141.976C569.856 139.971 570.24 137.816 570.24 135.512C570.24 133.72 569.963 131.949 569.408 130.2C568.853 128.451 567.979 126.893 566.784 125.528C565.504 124.12 563.947 123.011 562.112 122.2C560.277 121.347 558.4 120.92 556.48 120.92C554.304 120.92 552.384 121.304 550.72 122.072C549.056 122.84 547.605 124.12 546.368 125.912L546.24 125.784C546.283 124.547 546.453 123.139 546.752 121.56C547.051 119.981 547.52 118.509 548.16 117.144C548.8 115.736 549.653 114.563 550.72 113.624C551.829 112.643 553.195 112.152 554.816 112.152C556.395 112.152 557.717 112.707 558.784 113.816C559.851 114.925 560.533 116.227 560.832 117.72Z" fill="#707070"/>
                                    <path opacity="0.5" d="M659.088 206.008V198.2H628.496V206.648H649.744C645.477 211.811 642.021 217.485 639.376 223.672C636.773 229.859 635.216 236.301 634.704 243H644.432C644.475 240.013 644.816 236.792 645.456 233.336C646.139 229.88 647.077 226.467 648.272 223.096C649.509 219.725 651.024 216.547 652.816 213.56C654.651 210.573 656.741 208.056 659.088 206.008Z" fill="#707070"/>
                                    <path opacity="0.5" d="M681.008 313.36C681.008 312.336 681.179 311.44 681.52 310.672C681.904 309.904 682.416 309.264 683.056 308.752C683.696 308.24 684.421 307.856 685.232 307.6C686.085 307.301 686.96 307.152 687.856 307.152C689.264 307.152 690.395 307.365 691.248 307.792C692.144 308.219 692.827 308.752 693.296 309.392C693.808 310.032 694.149 310.715 694.32 311.44C694.491 312.123 694.576 312.763 694.576 313.36C694.576 315.28 693.936 316.752 692.656 317.776C691.376 318.757 689.776 319.248 687.856 319.248C686.021 319.248 684.421 318.757 683.056 317.776C681.691 316.752 681.008 315.28 681.008 313.36ZM672.752 312.528C672.752 314.747 673.307 316.688 674.416 318.352C675.525 320.016 677.168 321.147 679.344 321.744V321.872C676.656 322.512 674.565 323.792 673.072 325.712C671.621 327.632 670.896 330.021 670.896 332.88C670.896 335.312 671.365 337.403 672.304 339.152C673.285 340.901 674.565 342.352 676.144 343.504C677.765 344.656 679.579 345.488 681.584 346C683.632 346.555 685.744 346.832 687.92 346.832C690.011 346.832 692.059 346.555 694.064 346C696.069 345.403 697.861 344.528 699.44 343.376C701.019 342.224 702.277 340.773 703.216 339.024C704.197 337.275 704.688 335.205 704.688 332.816C704.688 330 703.963 327.632 702.512 325.712C701.061 323.749 698.992 322.469 696.304 321.872V321.744C698.48 321.019 700.101 319.824 701.168 318.16C702.277 316.496 702.832 314.555 702.832 312.336C702.832 311.227 702.576 309.989 702.064 308.624C701.552 307.216 700.699 305.915 699.504 304.72C698.352 303.483 696.816 302.437 694.896 301.584C692.976 300.731 690.629 300.304 687.856 300.304C686.021 300.304 684.208 300.56 682.416 301.072C680.624 301.584 679.003 302.352 677.552 303.376C676.144 304.4 674.992 305.68 674.096 307.216C673.2 308.752 672.752 310.523 672.752 312.528ZM679.984 332.432C679.984 330.128 680.752 328.379 682.288 327.184C683.824 325.947 685.701 325.328 687.92 325.328C688.987 325.328 689.968 325.499 690.864 325.84C691.803 326.181 692.613 326.672 693.296 327.312C694.021 327.952 694.576 328.72 694.96 329.616C695.387 330.469 695.6 331.429 695.6 332.496C695.6 333.605 695.408 334.629 695.024 335.568C694.64 336.507 694.085 337.317 693.36 338C692.677 338.64 691.867 339.152 690.928 339.536C690.032 339.877 689.029 340.048 687.92 340.048C686.853 340.048 685.829 339.877 684.848 339.536C683.867 339.152 683.013 338.64 682.288 338C681.605 337.317 681.051 336.507 680.624 335.568C680.197 334.629 679.984 333.584 679.984 332.432Z" fill="#707070"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_205_2143">
                                        <rect width="767" height="380" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            
                            <div id="sortable" class="position-absolute pt-3">
                                <div class="svg-container first d-flex justify-content-center align-items-center position-relative" data-svg-class="first">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="180" height="140" viewBox="0 0 166 138" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container second d-flex justify-content-center align-items-center position-relative" data-svg-class="second">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="200" height="175" viewBox="0 0 190 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container third d-flex justify-content-center align-items-center position-relative" data-svg-class="third">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="200" height="185" viewBox="0 0 187 191" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container fourth d-flex justify-content-center align-items-center position-relative" data-svg-class="fourth">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="152" height="168" viewBox="0 0 152 168" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M151.489 148.333C118.661 148.333 87.4099 155.078 59.0512 167.266L0.950684 31.6854C47.1751 11.9411 98.0516 1 151.477 1V148.333H151.489Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container fifth d-flex justify-content-center align-items-center position-relative" data-svg-class="fifth">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="154" height="169" viewBox="0 0 154 169" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M153.329 32.2456L94.4173 167.472C65.9329 155.158 34.5108 148.333 1.49997 148.333H1.48853V1H1.49997C55.4398 1 106.762 12.1583 153.329 32.2456Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container sixth d-flex justify-content-center align-items-center position-relative" data-svg-class="sixth">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="188" height="192" viewBox="0 0 188 192" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M187.104 89.929L78.7096 190.525C57.0262 167.649 30.7706 149.139 1.41748 136.472L60.3296 1.24561C108.486 22.0188 151.555 52.3726 187.104 89.929Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container seventh d-flex justify-content-center align-items-center position-relative" data-svg-class="seventh">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="190" height="179" viewBox="0 0 190 179" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M188.39 123.625L50.0827 177.679C38.961 149.166 22.4099 123.351 1.70947 101.526L110.104 0.929199C143.469 36.1648 170.239 77.7226 188.39 123.625Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="svg-container eight d-flex justify-content-center align-items-center position-relative" data-svg-class="eight">
                                    <div class="svg-button px-0 d-flex justify-content-center align-items-center">
                                        <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                        <svg width="167" height="140" viewBox="0 0 167 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M166 131.42L17.051 138.988C16.811 109.618 11.1758 81.5276 1.08276 55.6783L139.39 1.62451C155.358 41.9819 164.674 85.7006 166 131.42Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 position-absolute" style="bottom: -60%;">
                            <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0">
                <div class="scrollable-content">
                    <section class="main-content">
                        <div class="container">
                            <div class="row px-4 pt-4 pb-2 px-sm-5 pt-sm-5 right-sidebar">
                                <div class="col-12">
                                    <h1 class="display-4 text-white fw-bold pb-3">What are your top financial priorities?</h1>
                                    <p class="text-white display-6 lh-base">Select your priorities by first to last.</p>
                                </div>
                            </div>
                            <div id="needs" class="row px-4 pb-4 px-sm-5 needs">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'protection') default @endif" data-avatar="protection" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/protection-icon.png') }}" width="auto" height="100px" alt="Protection">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Protection</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'retirement') default @endif" data-avatar="retirement" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/retirement-icon.png') }}" width="auto" height="100px" alt="Retirement">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Retirement</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'education') default @endif" data-avatar="education" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/education-icon.png') }}" width="auto" height="100px" alt="Education">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Education</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'savings') default @endif" data-avatar="savings" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/savings-icon.png') }}" width="auto" height="100px" alt="Savings">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Savings</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'debt-cancellation') default @endif" data-avatar="debt-cancellation" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/debt-cancellation-icon.png') }}" width="auto" height="100px" alt="Debt Cancellation">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Debt Cancellation</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'health-medical') default @endif" data-avatar="health-medical" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/health-medical-icon.png') }}" width="auto" height="100px" alt="Health & Medical">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Health & Medical</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'investments') default @endif" data-avatar="investments" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/investments-icon.png') }}" width="auto" height="100px" alt="Investments">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Investments</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pt-2 pb-3">
                                    <div class="col-12 button-bg">
                                        <div class="col-12 py-4 d-flex align-items-center justify-content-center hover">
                                            <button class="border-0 @if(isset($arrayData['priorities']) && $arrayData['priorities'] === 'others') default @endif" data-avatar="others" data-required="">
                                                <img class="needs-icon" src="{{ asset('images/top-priorities/others-icon.png') }}" width="auto" height="100px" alt="Others">
                                                <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <a href="{{route('avatar.my.assets')}}" class="btn btn-primary flex-fill text-uppercase me-md-2">Back</a>
                                    <a href="{{route('priorities.to.discuss') }}" class="btn btn-primary flex-fill text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection