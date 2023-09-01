<?php
 /**
 * Template Name: Education Coverage New Page
 */
?>

@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayDataEducation = session('passingArrays');
    $educationSelectedAvatar = isset($arrayDataEducation['educationSelectedAvatar']) ? $arrayDataEducation['educationSelectedAvatar'] : '';
    $educationSelectedImage = isset($arrayDataEducation['educationSelectedImage']) ? $arrayDataEducation['educationSelectedImage'] : '';
@endphp

<div id="education-coverage" class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <form novalidate action="{{route('validate.education.coverage.selection')}}" method="POST">
                @csrf
                <div class="col-12 vh-100 wrapper-needs-coverage-default bg-education-home">
                    <section class="header-needs-default">
                        <div class="col-lg-6 col-md-12">
                            @include('templates.nav.nav-red-menu')
                        </div>
                        <div class="col-lg-6 col-md-12">
                            @include ('templates.nav.nav-sidebar-needs')
                        </div>
                    </section>
                    @if ($errors->has('educationSelectedAvatarInput'))
                        <section class="col-12 warning show-tablet">
                            <div class="col-12 alert alert-warning d-flex align-items-center m-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('educationSelectedAvatarInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="content-needs-default overflow-auto overflow-hidden bg-education-coverage row">
                        <div class="col-12 header-content-coverage">
                            <div class="row d-flex justify-content-center align-items-center text-center">
                                <h4 class="f-34 f-family fw-700">I'd like to provide coverage for my:</h4>
                            </div>
                        </div>
                        <div class="col-11 m-auto selection-content-coverage h-100 education_coverage z-1">
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayDataEducation['educationSelectedAvatar']) && $arrayDataEducation['educationSelectedAvatar'] === 'self') default @endif" id="self" data-avatar="self" data-required="">
                                    <img src="{{ asset('images/needs/education/education-avatar/Male.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Self</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayDataEducation['educationSelectedAvatar']) && $arrayDataEducation['educationSelectedAvatar'] === 'child1') default @endif" id="child1" data-avatar="child1" data-required="">
                                    <img src="{{ asset('images/needs/education/education-avatar/Daughter.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Child 1</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayDataEducation['educationSelectedAvatar']) && $arrayDataEducation['educationSelectedAvatar'] === 'child2') default @endif" id="child2" data-avatar="child2" data-required="">
                                    <img src="{{ asset('images/needs/education/education-avatar/Son.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Child 2</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayDataEducation['educationSelectedAvatar']) && $arrayDataEducation['educationSelectedAvatar'] === 'child3') default @endif" id="child3" data-avatar="child3" data-required="">
                                    <img src="{{ asset('images/needs/education/education-avatar/Kid.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 f-family fw-700 coverage-text"><strong>Child 3</strong></p>
                                </button>
                            </div>
                            <div class="slick-slide h-100 mh-100 d-flex justify-content-center align-items-center">
                                <button class="border-0 bg-transparent choice h-100 slick-padding mt-auto button-needs justify-content-center align-items-center @if(isset($arrayDataEducation['educationSelectedAvatar']) && $arrayDataEducation['educationSelectedAvatar'] === 'child4') default @endif" id="child4" data-avatar="child4" data-required="">
                                    <img src="{{ asset('images/needs/education/education-avatar/Kid.png') }}" class="mt-auto mh-100 mx-auto coverage-image">
                                    <p class="py-2 m-0 cf-family fw-700 overage-text"><strong>Child 4</strong></p>
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="position-absolute bottom-0 needs-stand-bg {{ $errors->has('educationSelectedAvatarInput') ? 'error-padding' : '' }}"></div>
                            </div>
                        </div>
                    </section>
                    @if ($errors->has('educationSelectedAvatarInput'))
                        <section class="col-12 warning hide-tablets">
                            <div class="col-12 alert alert-warning d-flex align-items-center m-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div class="text">{{ $errors->first('educationSelectedAvatarInput') }}</div>
                            </div>
                        </section>
                    @endif
                    <section class="footer bg-btn_bar py-4 fixed-bottom footer-needs-default">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                    <input type="hidden" name="educationSelectedAvatarInput" id="educationSelectedAvatarInput" value="{{$educationSelectedAvatar}}">
                                    <input type="hidden" name="educationSelectedAvatarImage" id="educationSelectedAvatarImage" value="{{$educationSelectedImage}}">
                                    <a href="{{route('education.home')}}" class="btn btn-primary flex-fill me-md-2 text-uppercase">Back</a>
                                    <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.education_coverage').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 2,
            prevArrow:'<svg xmlns="http://www.w3.org/2000/svg" viewBox="-5 -5 29 24" fill="none" class="slide-button" style="position: absolute;left:15px;z-index: 10000;top: 45%;cursor: pointer;border:1px solid #c21b17;"><path d="M 7.6183 0.2369 C 7.6183 0.2369 7.6567 0.2561 7.6759 0.2561 C 8.1175 0.3265 8.4375 0.6721 8.4503 1.1201 C 8.4567 1.3761 8.3607 1.6001 8.1815 1.7857 C 8.1623 1.8113 8.1367 1.8305 8.1111 1.8561 C 6.5495 3.4177 4.9879 4.9793 3.4263 6.5409 C 3.4135 6.5537 3.4007 6.5665 3.3815 6.5921 C 3.4071 6.5921 3.4199 6.5921 3.4391 6.5921 C 4.1751 6.5921 4.9111 6.5921 5.6471 6.5921 C 9.5703 6.5921 13.4999 6.5921 17.4231 6.5921 C 17.6215 6.5921 17.8199 6.6241 17.9863 6.7393 C 18.2999 6.9505 18.4599 7.3409 18.3703 7.7057 C 18.2807 8.0833 17.9799 8.3521 17.5959 8.3969 C 17.5447 8.3969 17.4871 8.3969 17.4359 8.3969 C 12.8407 8.3969 8.2455 8.3969 3.6503 8.3969 C 3.5607 8.3969 3.4775 8.3969 3.3815 8.3969 C 3.4007 8.4161 3.4071 8.4289 3.4199 8.4417 C 3.8935 8.9153 4.3607 9.3889 4.8343 9.8561 C 5.8967 10.9121 6.9527 11.9745 8.0151 13.0305 C 8.0727 13.0881 8.1367 13.1393 8.1879 13.2033 C 8.4247 13.4721 8.4887 13.7793 8.3671 14.1185 C 8.2519 14.4577 8.0023 14.6561 7.6503 14.7137 C 7.3559 14.7585 7.0935 14.6689 6.8823 14.4577 C 4.8087 12.3841 2.7287 10.3041 0.6551 8.2305 C 0.5463 8.1217 0.4375 8.0065 0.3735 7.8593 C 0.2199 7.5009 0.2967 7.1233 0.5911 6.8289 C 1.0263 6.3937 1.4615 5.9585 1.9031 5.5169 C 3.5671 3.8529 5.2311 2.1889 6.9015 0.5249 C 7.0487 0.3777 7.2279 0.2753 7.4391 0.2561 C 7.4455 0.2561 7.4583 0.2433 7.4647 0.2369 C 7.5159 0.2369 7.5735 0.2369 7.6247 0.2369 H 7.6183 Z" fill="#C1210D"/></svg>',
            // prevArrow:'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" style="width: 33px;height: 43px;color:#333333;position: absolute;left:15px;z-index: 10000;top: 45%;cursor: pointer;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg>',
            // nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" style="width: 33px;height: 43px;color:#333333;position: absolute;right: 15px;z-index: 10000;top: 45%;cursor: pointer;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg>',
            nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-5 -5 30 23" fill="none" class="slide-button" style="position: absolute;right: 15px;z-index: 10000;top: 45%;cursor: pointer;border:1px solid #c21b17;"><path d="M 11.3705 14.5356 C 11.3705 14.5356 11.332 14.5164 11.3129 14.5164 C 10.8712 14.446 10.5512 14.1005 10.5385 13.6525 C 10.532 13.3964 10.6281 13.1725 10.8072 12.9868 C 10.8264 12.9612 10.852 12.9421 10.8777 12.9164 C 12.4392 11.3549 14.0009 9.7932 15.5624 8.2317 C 15.5753 8.2189 15.5881 8.206 15.6072 8.1805 C 15.5816 8.1805 15.5688 8.1805 15.5496 8.1805 C 14.8137 8.1805 14.0777 8.1805 13.3416 8.1805 C 9.4185 8.1805 5.4888 8.1805 1.5656 8.1805 C 1.3672 8.1805 1.1689 8.1484 1.0025 8.0332 C 0.6889 7.822 0.64 7.68 0.6185 7.0669 C 0.7081 6.6893 1.0089 6.4205 1.3928 6.3756 C 1.444 6.3756 1.5016 6.3756 1.5528 6.3756 C 6.148 6.3756 10.7433 6.3756 15.3385 6.3756 C 15.4281 6.3756 15.5112 6.3756 15.6072 6.3756 C 15.5881 6.3565 15.5816 6.3436 15.5688 6.3308 C 15.0953 5.8572 14.6281 5.3836 14.1544 4.9164 C 13.092 3.8605 12.0361 2.7981 10.9737 1.7421 C 10.9161 1.6844 10.852 1.6332 10.8009 1.5693 C 10.564 1.3004 10.5001 0.9933 10.6216 0.6541 C 10.7368 0.3149 10.9864 0.1165 11.3385 0.0588 C 11.6329 0.014 11.8953 0.1036 12.1064 0.3149 C 14.1801 2.3884 16.2601 4.4685 18.3337 6.542 C 18.4424 6.6508 18.5512 6.766 18.6153 6.9132 C 18.7688 7.2717 18.692 7.6493 18.3977 7.9436 C 17.9624 8.3789 17.5272 8.8141 17.0857 9.2556 C 15.4216 10.9197 13.7577 12.5836 12.0872 14.2477 C 11.9401 14.3949 11.7609 14.4973 11.5496 14.5164 C 11.5433 14.5164 11.5305 14.5292 11.524 14.5356 C 11.4729 14.5356 11.4153 14.5356 11.364 14.5356 L 11.3705 14.5356 Z" fill="#C1210D"/></svg>',
            
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        centerMode: false,
                        slidesToShow: 2,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        centerMode: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerMode: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

    // Add event listener to each button with the 'data-required' attribute
    const dataButtons = document.querySelectorAll('[data-avatar]');

    dataButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the button click

            dataButtons.forEach(btn => btn.removeAttribute('data-required'));
            // Add 'selected' attribute to the clicked button
            this.setAttribute('data-required', 'selected');

            selectedAvatar = this.getAttribute('data-required');

            dataButtons.forEach(btn => btn.classList.remove('selected'));

            const nextButton = document.getElementById('nextButton');

            // Get the selected data-avatar value
            const dataAvatar = this.getAttribute('data-avatar');
            const dataAvatarImg = this.querySelector('img').getAttribute('src');

            // Update the hidden input field value with the selected avatar
            document.getElementById('educationSelectedAvatarInput').value = dataAvatar;
            document.getElementById('educationSelectedAvatarImage').value = dataAvatarImg;
        });
    });

    // Preselect the button on page load
    window.addEventListener('DOMContentLoaded', function() {
        const defaultBtn = document.querySelectorAll('.default');

        defaultBtn.forEach(defaultBtn => {
            // Add the 'selected' class to the closest .button-bg div of each default button
            defaultBtn.classList.add('selected');
        });
    });
</script>

@endsection