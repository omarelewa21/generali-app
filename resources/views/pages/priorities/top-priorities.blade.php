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

@include('templates.nav.nav-red-menu')

<div id="top_priorities" class="vh-100 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 gender-selection-bg vh-100 wrapper-avatar-default">
                <section class="avatar-design-placeholder content-avatar-default">
                    <div class="col-12 text-center position-relative">
                        <h4 class="fw-bold">Here's how I see my priorities:</h4>
                        <div id="sortable" class="position-relative pt-3">
                            <div class="svg-container first">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 166 138" fill="none">
                                        <path d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">1</text>
                                        <!-- <image xlink:href="{{ asset('images/top-priorities/protection-icon.svg') }}" width="60%" height="60%" x="50%" y="50%" preserveAspectRatio="xMidYMid meet" /> -->
                                    </svg>
                                </button>
                            </div>
                            <div class="svg-container second">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190 180" fill="none">
                                        <path d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">2</text>
                                    </svg>
                                </button>
                            </div>
                            <div class="svg-container third">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 187 191" fill="none">
                                        <path d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="55%" y="55%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">3</text>
                                    </svg>
                                </button>
                            </div>
                            <div class="svg-container fourth">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152 167" fill="none">
                                        <path d="M151.489 147.333C118.661 147.333 87.4099 154.078 59.0512 166.266L0.950684 30.6854C47.1751 10.9411 98.0516 0 151.477 0V147.333H151.489Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="60%" y="50%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">4</text>
                                    </svg>
                                </button>
                            </div>
                            <div class="svg-container fifth">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 154 168" fill="none">
                                        <path d="M153.329 31.2456L94.4173 166.472C65.9329 154.158 34.5108 147.333 1.49997 147.333H1.48853V0H1.49997C55.4398 0 106.762 11.1583 153.329 31.2456Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="45%" y="50%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">5</text>
                                    </svg>
                                </button>
                        
                            </div>
                            <div class="svg-container sixth">
                                <div class="d-block">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 188 192" fill="none">
                                        <path d="M187.104 89.929L78.7096 190.525C57.0262 167.649 30.7706 149.139 1.41748 136.472L60.3296 1.24561C108.486 22.0188 151.555 52.3726 187.104 89.929Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="47%" y="55%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">6</text>
                                    </svg>
                                </button>
                                </div>
                            </div>
                            <div class="svg-container seventh">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190 179" fill="none">
                                        <path d="M188.39 123.625L50.0827 177.679C38.961 149.166 22.4099 123.351 1.70947 101.526L110.104 0.929199C143.469 36.1648 170.239 77.7226 188.39 123.625Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">7</text>
                                    </svg>
                                </button>
                            </div>
                            <div class="svg-container eight">
                                <button class="svg-button position-relative px-0">
                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 166 139" fill="none">
                                        <path d="M166 131.42L17.051 138.988C16.811 109.618 11.1758 81.5276 1.08276 55.6783L139.39 1.62451C155.358 41.9819 164.674 85.7006 166 131.42Z" fill="#F2F2F2" stroke="#A0A0A0" stroke-dasharray="8 6"/>
                                        <text x="50%" y="60%" font-family="Helvetica Neue" font-size="64" fill="#707070" font-weight="700" opacity="0.5" text-anchor="middle" dominant-baseline="middle">8</text>
                                    </svg>
                                </button>
                            </div>
                            
                        </div> -->
                        <img src="{{ asset('/images/top-priorities/priorities-grid.png') }}" width="500px" class="mx-auto d-block pt-4" alt="">
                        <img src="{{ asset('/images/avatar-general/avatar-gender-male.svg') }}" width="auto" height="100%" alt="Avatar" class="changeImage">
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
                                    <p class="text-white display-6">Select your priorities by first to last.</p>
                                </div>
                            </div>
                            <div id="needs" class="row px-4 pb-4 px-sm-5">
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="protection" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/protection-icon.svg') }}" width="auto" height="100px" alt="Protection">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Protection</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="retirement" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/retirement-icon.png') }}" width="auto" height="100px" alt="Retirement">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Retirement</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="education" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/education-icon.png') }}" width="auto" height="100px" alt="Education">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Education</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="savings" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/savings-icon.png') }}" width="auto" height="100px" alt="Savings">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Savings</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="debt-cancellation" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/debt-cancellation-icon.png') }}" width="auto" height="100px" alt="Debt Cancellation">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Debt Cancellation</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="health-medical" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/health-medical-icon.png') }}" width="auto" height="100px" alt="Health & Medical">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Health & Medical</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect pe-xxl-1 pe-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="investments" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/investments-icon.png') }}" width="auto" height="100px" alt="Investments">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Investments</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-6 text-dark fade-effect ps-xxl-1 ps-xl-1 py-1 d-flex">
                                    <div class="col-12 py-4 px-3 d-flex align-items-center justify-content-center button-bg flex-grow-1">
                                        <button class="border-0" data-avatar="others" data-required="">
                                            <img class="needs" src="{{ asset('images/top-priorities/others-icon.png') }}" width="auto" height="100px" alt="Others">
                                            <p class="avatar-text text-center pt-4 mb-0 fw-bold">Others</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="footer bg-accent-light-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end px-5">
                                    <a href="{{route('avatar.my.assets')}}" class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <a href="{{route('priorities.to.discuss') }}" class="btn btn-primary text-uppercase">Next</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#sortable-list ul {
    list-style: none;
}
.droppableArea {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
#sortable-list .main {
    width:100px;
    height:100px;
}
#sortable-list .main.first {
  transform: translate(189px, 146px);
  width:109px;
}
#sortable-list .main.second {
  transform: translate(103px, 72px);
  width:123px;
}
#sortable-list .main.third {
  transform: translate(37px, 19px);
  width:122px;
}
#sortable-list .main.fifth {
  transform: translate(-1px, 1px);
}
#sortable-list .main.sixth {
  transform: translate(-40px, 20px);
  width:122px;
}
#sortable-list .main.seventh {
  transform: translate(-115px, 75px);
  width:122px;
}
#sortable-list .main.eight {
  transform: translate(-115px, 75px);
  width:117px;
}
.needs {
    z-index: 1;
}
</style>

<script>
$(function() {

    var $needs = $("#needs"),
        $sortable = $("#sortable");

    var addedNeedsImages = []; // Array to keep track of added needs images

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

                    droppedItem.animate({ width: "60%" }, function() {
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
});
</script>

@endsection