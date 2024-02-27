<?php
 /**
 * Template Name: Savings Goals Page
 */
?>

@extends('templates.master')

@section('title')
<title>Savings Goals</title>
@endsection

@section('content')

@php
    // Retrieving values from the session
    $savingsPriority = session('customer_details.priorities.savings_discuss');

    $image = session('customer_details.avatar.image', 'images/avatar-general/gender-male.svg');
    $goalsAmount = session('customer_details.selected_needs.need_4.advance_details.goal_amount');
    $savingsGoals = session('customer_details.selected_needs.need_4.advance_details.goal_target');
    $relationship = session('customer_details.selected_needs.need_4.advance_details.relationship');
@endphp

<div id="savings-goals">
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('form.goals') }}" method="post" class="buttonForm">
                @csrf
                <div class="row">
                    @php
                        if($relationship === 'Child'){
                            $goal_1 = 'Pursue their interests';
                            $goal_2 = 'Start their own business';
                            $goal_3 = 'Contribute to their tuition fees';
                        }
                        else{
                            $goal_1 = 'Travel around the world';
                            $goal_2 = 'Upgrade my assets & lifestyle';
                            $goal_3 = 'Contribute to charitable needs';
                        }
                    @endphp
                    <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 wrapper-avatar-default bg-white">
                    <!-- <div class="col-12 col-md-6 col-lg-6 col-xxl-7 col-xl-7 wrapper-avatar-default bg-white order-md-1 order-sm-2 order-2"> -->
                        <div class="header"><div class="row">@include('templates.nav.nav-red-white-menu')</div></div>    
                        <section class="content-avatar-default d-none d-md-block">
                            <div class="col-12 text-center position-relative">
                                <h2 class="display-5 fw-bold lh-base text-center @error('savings_goals_amount') is-invalid @enderror">I plan to have a savings goal of<br>
                                    <span class="text-primary fw-bold border-bottom border-dark border-3">RM<input type="text" class="form-control display-5 fw-bold lh-base position-relative border-0 d-inline-block w-25 text-primary @error('savings_goals_amount') is-invalid @enderror" id="savings_goals_amount" name="savings_goals_amount" value="{{ $goalsAmount !== null ? number_format(floatval($goalsAmount)) : $goalsAmount }}"></span> to:                                </h2>
                                @if ($errors->has('savings_goals_amount'))
                                    <div class="invalid-feedback">{{ $errors->first('savings_goals_amount') }}</div>
                                @endif
                                <div id="sortable-main" class="position-relative pt-3" style="height: 70%;">
                                    <svg width="100%" height="100%" viewBox="0 0 814 408" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="second @if(isset($savingsGoals) && isset($savingsGoals[1])) item-dropped @endif" d="M407.09 5C292.17 5 188.51 53.19 115.2 130.46L225.19 240.45C269.9 190.44 334.8 158.88 407.09 158.59V5Z" fill="#F2F2F2" stroke="#707070" stroke-dasharray="8 6"/>
                                        <path class="first @if(isset($savingsGoals) && isset($savingsGoals[0])) item-dropped @endif" d="M5 394.27L162.82 403.53C162.9 340.89 186.48 283.76 225.2 240.45L115.21 130.46C49.56 199.65 8.25 292.15 5 394.27Z" fill="#F2F2F2" stroke="#707070" stroke-dasharray="8 6"/>
                                        <path class="third @if(isset($savingsGoals) && isset($savingsGoals[2])) item-dropped @endif" d="M407.1 5V158.6C407.43 158.6 407.76 158.59 408.09 158.59C480.55 158.59 545.66 190.02 590.56 239.98L699.7 131.23C626.36 53.51 522.39 5 407.1 5Z" fill="#F2F2F2" stroke="#707070" stroke-dasharray="8 6"/>
                                        <path class="fourth @if(isset($savingsGoals) && isset($savingsGoals[3])) item-dropped @endif" d="M809.2 394.78C806.08 292.84 765.04 200.44 699.71 131.22L590.57 239.97C629.49 283.28 653.23 340.51 653.37 403.29L809.21 394.77L809.2 394.78Z" fill="#F2F2F2" stroke="#707070" stroke-dasharray="8 6"/>
                                        <path class="first digit @if(isset($savingsGoals) && isset($savingsGoals[0])) item-dropped @endif" opacity="0.5" d="M113.088 303H104V273.944H92.736V267.096C94.3147 267.139 95.8293 267.032 97.28 266.776C98.7733 266.477 100.096 265.987 101.248 265.304C102.443 264.579 103.445 263.64 104.256 262.488C105.067 261.336 105.6 259.907 105.856 258.2H113.088V303Z" fill="#707070"/>	
                                        <path class="second digit @if(isset($savingsGoals) && isset($savingsGoals[1])) item-dropped @endif" d="M263.368 106.416C263.283 103.856 263.581 101.488 264.264 99.312C264.947 97.0933 265.971 95.1733 267.336 93.552C268.701 91.888 270.408 90.608 272.456 89.712C274.547 88.7733 276.936 88.304 279.624 88.304C281.672 88.304 283.613 88.624 285.448 89.264C287.325 89.904 288.968 90.8213 290.376 92.016C291.784 93.2107 292.893 94.6827 293.704 96.432C294.557 98.1813 294.984 100.144 294.984 102.32C294.984 104.581 294.621 106.523 293.896 108.144C293.171 109.765 292.211 111.216 291.016 112.496C289.821 113.733 288.456 114.864 286.92 115.888C285.427 116.912 283.912 117.936 282.376 118.96C280.84 119.941 279.347 121.008 277.896 122.16C276.445 123.312 275.165 124.656 274.056 126.192H295.24V134H262.344C262.344 131.397 262.707 129.136 263.432 127.216C264.2 125.296 265.224 123.589 266.504 122.096C267.784 120.56 269.277 119.152 270.984 117.872C272.733 116.592 274.568 115.291 276.488 113.968C277.469 113.285 278.515 112.603 279.624 111.92C280.733 111.195 281.736 110.405 282.632 109.552C283.571 108.699 284.339 107.739 284.936 106.672C285.576 105.605 285.896 104.389 285.896 103.024C285.896 100.848 285.256 99.1627 283.976 97.968C282.739 96.7307 281.139 96.112 279.176 96.112C277.853 96.112 276.723 96.432 275.784 97.072C274.888 97.6693 274.163 98.48 273.608 99.504C273.053 100.485 272.648 101.595 272.392 102.832C272.179 104.027 272.072 105.221 272.072 106.416H263.368Z" fill="#707070"/>	
                                        <path class="third digit @if(isset($savingsGoals) && isset($savingsGoals[2])) item-dropped @endif" d="M528.592 107.312C529.573 107.397 530.619 107.397 531.728 107.312C532.837 107.227 533.861 106.992 534.8 106.608C535.781 106.181 536.571 105.584 537.168 104.816C537.808 104.048 538.128 103.024 538.128 101.744C538.128 99.824 537.488 98.352 536.208 97.328C534.928 96.304 533.456 95.792 531.792 95.792C529.488 95.792 527.739 96.56 526.544 98.096C525.392 99.5893 524.837 101.488 524.88 103.792H516.24C516.325 101.488 516.731 99.3973 517.456 97.52C518.224 95.6 519.269 93.9573 520.592 92.592C521.957 91.2267 523.579 90.1813 525.456 89.456C527.333 88.688 529.424 88.304 531.728 88.304C533.52 88.304 535.312 88.5813 537.104 89.136C538.896 89.648 540.496 90.4373 541.904 91.504C543.355 92.5707 544.528 93.872 545.424 95.408C546.32 96.944 546.768 98.7147 546.768 100.72C546.768 102.896 546.235 104.816 545.168 106.48C544.144 108.144 542.587 109.275 540.496 109.872V110C542.971 110.555 544.912 111.749 546.32 113.584C547.728 115.419 548.432 117.616 548.432 120.176C548.432 122.523 547.963 124.613 547.024 126.448C546.128 128.283 544.912 129.819 543.376 131.056C541.84 132.293 540.069 133.232 538.064 133.872C536.059 134.512 533.968 134.832 531.792 134.832C529.275 134.832 526.971 134.469 524.88 133.744C522.832 133.019 521.083 131.973 519.632 130.608C518.181 129.2 517.051 127.493 516.24 125.488C515.472 123.483 515.109 121.179 515.152 118.576H523.792C523.835 119.771 524.027 120.923 524.368 122.032C524.709 123.099 525.2 124.037 525.84 124.848C526.48 125.616 527.269 126.235 528.208 126.704C529.189 127.173 530.341 127.408 531.664 127.408C533.712 127.408 535.44 126.789 536.848 125.552C538.256 124.272 538.96 122.544 538.96 120.368C538.96 118.661 538.619 117.36 537.936 116.464C537.296 115.568 536.464 114.928 535.44 114.544C534.416 114.117 533.285 113.883 532.048 113.84C530.853 113.755 529.701 113.712 528.592 113.712V107.312Z" fill="#707070"/>	
                                        <path class="fourth digit @if(isset($savingsGoals) && isset($savingsGoals[3])) item-dropped @endif" d="M711.968 269.592H711.776L700.192 285.144H711.968V269.592ZM711.968 292.632H693.024V284.312L712.48 258.2H720.608V285.144H726.56V292.632H720.608V303H711.968V292.632Z" fill="#707070"/>	
                                    </svg>
                                    
                                    <div id="sortable" class="position-absolute pt-3">
                                        <div class="svg-container first d-flex justify-content-center align-items-center position-relative @if(isset($savingsGoals) && isset($savingsGoals[0])) item-dropped @endif" data-svg-class="first" data-index="1">
                                            <div class="svg-button px-0 d-flex justify-content-center align-items-center ui-sortable">
                                                @if(!isset($savingsGoals) || !isset($savingsGoals[0]))
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                                @else
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center not-available" data-identifier="{{$savingsGoals[0]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped" src="{{ asset('images/needs/savings/goals/goal-' . (($relationship === 'Child') ? (isset($savingsGoals[0]) && $savingsGoals[0] == $goal_1 ? 'interest' : 
                                                                                            ($savingsGoals[0] == $goal_2 ? 'business' : ($savingsGoals[0] == $goal_3 ? 'tuition' : 'others'))) : (isset($savingsGoals[0]) && $savingsGoals[0] != '' ? 
                                                                                            ($savingsGoals[0] == $goal_1 ? 'travel' : ($savingsGoals[0] == $goal_2 ? 'home' : ($savingsGoals[0] == $goal_3 ? 'donate' : 'others'))) : 'others')) . '.png') }}" style="width: 100px;">

                                                            <button class="remove-button btn-remove" data-avatar="{{$savingsGoals[0]}}" data-index="1"><img class="close" src="{{ asset('images/top-priorities/close.png') }}" width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="180" height="100" viewBox="0 0 166 138" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M164.769 55.0442C154.767 80.802 149.189 108.766 148.949 138L0 130.454C1.31449 85.1007 10.4816 41.7136 26.2098 1.61914L164.769 55.0442Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="svg-container second d-flex justify-content-center align-items-center position-relative @if(isset($savingsGoals) && isset($savingsGoals[1])) item-dropped @endif" data-svg-class="second" data-index="2">
                                            <div class="svg-button px-0 d-flex justify-content-center align-items-center ui-sortable">
                                                @if(!isset($savingsGoals) || !isset($savingsGoals[1]))
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                                @else
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center not-available" data-identifier="{{$savingsGoals[1]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped" src="{{ asset('images/needs/savings/goals/goal-' . (($relationship === 'Child') ? (isset($savingsGoals[1]) && $savingsGoals[1] == $goal_1 ? 'interest' : 
                                                                                            ($savingsGoals[1] == $goal_2 ? 'business' : ($savingsGoals[1] == $goal_3 ? 'tuition' : 'others'))) : (isset($savingsGoals[1]) && $savingsGoals[1] != '' ? 
                                                                                            ($savingsGoals[1] == $goal_1 ? 'travel' : ($savingsGoals[1] == $goal_2 ? 'home' : ($savingsGoals[1] == $goal_3 ? 'donate' : 'others'))) : 'others')) . '.png') }}" style="width: 100px;">
                                                            <button class="remove-button btn-remove" data-avatar="{{$savingsGoals[1]}}" data-index="2"><img class="close" src="{{ asset('images/top-priorities/close.png') }}" width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="200" height="125" viewBox="0 0 190 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M188.69 102.091C167.716 124.11 150.97 150.188 139.769 179.045L1.20972 125.62C19.5897 78.8027 46.8854 36.4788 81.0165 0.740234L188.69 102.091Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="svg-container third d-flex justify-content-center align-items-center position-relative @if(isset($savingsGoals) && isset($savingsGoals[2])) item-dropped @endif" data-svg-class="third" data-index="3">
                                            <div class="svg-button px-0 d-flex justify-content-center align-items-center ui-sortable">
                                                @if(!isset($savingsGoals) || !isset($savingsGoals[2]))
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                                @else
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center not-available" data-identifier="{{$savingsGoals[2]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped" src="{{ asset('images/needs/savings/goals/goal-' .  (($relationship === 'Child') ? (isset($savingsGoals[2]) && $savingsGoals[2] == $goal_1 ? 'interest' : 
                                                                                            ($savingsGoals[2] == $goal_2 ? 'business' : ($savingsGoals[2] == $goal_3 ? 'tuition' : 'others'))) : (isset($savingsGoals[2]) && $savingsGoals[2] != '' ? 
                                                                                            ($savingsGoals[2] == $goal_1 ? 'travel' : ($savingsGoals[2] == $goal_2 ? 'home' : ($savingsGoals[2] == $goal_3 ? 'donate' : 'others'))) : 'others')) . '.png') }}" style="width: 100px;">
                                                            <button class="remove-button btn-remove" data-avatar="{{$savingsGoals[2]}}" data-index="3"><img class="close" src="{{ asset('images/top-priorities/close.png') }}" width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="200" height="130" viewBox="0 0 187 191" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M186.051 136.266C156.687 148.865 130.42 167.294 108.691 190.091L1.0166 88.7402C36.6679 51.401 79.7832 21.2644 127.951 0.685547L186.051 136.266Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="svg-container fourth d-flex justify-content-center align-items-center position-relative @if(isset($savingsGoals) && isset($savingsGoals[3])) item-dropped @endif" data-svg-class="fourth" data-index="4">
                                            <div class="svg-button px-0 d-flex justify-content-center align-items-center ui-sortable">
                                                @if(!isset($savingsGoals) || !isset($savingsGoals[3]))
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center"></div>
                                                @else
                                                    <div class="dropped position-absolute d-flex justify-content-center align-items-center not-available" data-identifier="{{$savingsGoals[3]}}">
                                                        <div class='sortable-container'>
                                                            <img class="inner-dropped" src="{{ asset('images/needs/savings/goals/goal-' .  (($relationship === 'Child') ? (isset($savingsGoals[3]) && $savingsGoals[3] == $goal_1 ? 'interest' : 
                                                                                            ($savingsGoals[3] == $goal_2 ? 'business' : ($savingsGoals[3] == $goal_3 ? 'tuition' : 'others'))) : (isset($savingsGoals[3]) && $savingsGoals[3] != '' ? 
                                                                                            ($savingsGoals[3] == $goal_1 ? 'travel' : ($savingsGoals[3] == $goal_2 ? 'home' : ($savingsGoals[3] == $goal_3 ? 'donate' : 'others'))) : 'others')) . '.png') }}" style="width: 100px;">
                                                            <button class="remove-button btn-remove" data-avatar="{{$savingsGoals[3]}}" data-index="4"><img class="close" src="{{ asset('images/top-priorities/close.png') }}" width="100%"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <svg width="152" height="120" viewBox="0 0 152 168" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M151.489 148.333C118.661 148.333 87.4099 155.078 59.0512 167.266L0.950684 31.6854C47.1751 11.9411 98.0516 1 151.477 1V148.333H151.489Z" fill="none" stroke="none" stroke-dasharray="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 position-absolute" style="top: 65%; height:300px;">
                                    <img src="{{ $relationship === 'Child' ? asset('images/needs/savings/goals/child-avatar.png') : asset($image) }}" width="auto" height="100%" alt="Avatar" class="changeImage">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 content-section">
                    <!-- <div class="col-12 col-md-6 col-lg-6 col-xxl-5 col-xl-5 bg-primary px-0 z-index-1 order-md-2 order-1 order-xs-1 content-section"> -->
                        <div class="scrollable-content">
                            <section class="main-content">
                                <div class="container">
                                    <div class="top-menu">@include ('templates.nav.nav-sidebar-needs')</div>
                                    <div class="row px-4 pt-3 pb-2 px-sm-5 pt-md-5 right-sidebar">
                                        <div class="col-12 pt-3 pt-md-5">
                                            <p class="text-white display-6 lh-base">Drag and drop your goals on top of your avatar.</p>
                                        </div>
                                    </div>
                                    <div id="needs" class="row mx-4 pb-4 mx-sm-5 needs d-none d-md-flex">
                                        @if ($errors->has('savingsGoalsButtonInput'))
                                            <div class="col-12">
                                                <div class="col-12 alert alert-warning d-flex align-items-center" role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="25">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    <div class="text">{{ $errors->first('savingsGoalsButtonInput') }}</div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                                    <button class="border-0 w-100 d-flex align-items-center @if(isset($savingsGoals) && is_array($savingsGoals) && in_array($goal_1, $savingsGoals)) default @endif" data-avatar="{{$relationship === 'Child' ? 'Pursue their interests' :'Travel around the world'}}" data-required="" @if(isset($savingsGoals) && is_array($savingsGoals) && in_array($goal_1, $savingsGoals)) disabled @endif>
                                                        <div class="col-4">
                                                            <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-'.($relationship === 'Child' ? 'interest' :'travel').'.png') }}" width="auto" height="110px" alt="{{$goal_1}}">
                                                        </div>
                                                        <div class="col-8 d-flex justify-content-center">
                                                            <p class="avatar-text text-start mb-0 fw-bold lh-normal col-10">{{$relationship === 'Child' ? 'Pursue their interests' : 'Travel around the world'}}</p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                                    <button class="border-0 w-100 d-flex align-items-center @if(isset($savingsGoals) && is_array($savingsGoals) && in_array($goal_2, $savingsGoals)) default @endif" data-avatar="{{$relationship === 'Child' ? 'Start their own business' : 'Upgrade my assets & lifestyle'}}" data-required="" @if(isset($savingsGoals) && is_array($savingsGoals) && in_array($goal_2, $savingsGoals)) disabled @endif>
                                                        <div class="col-4">
                                                            <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-'.($relationship === 'Child' ? 'business' :'home').'.png') }}" width="auto" height="110px" alt="{{$goal_2}}">
                                                        </div>
                                                        <div class="col-8 d-flex justify-content-center">
                                                            <p class="avatar-text text-start mb-0 fw-bold lh-normal col-10">{{$relationship === 'Child' ? 'Start their own business' : 'Upgrade my assets & lifestyle'}}</p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                                    <button class="border-0 w-100 d-flex align-items-center @if(isset($savingsGoals) && is_array($savingsGoals) && in_array($goal_3, $savingsGoals)) default @endif" data-avatar="{{$relationship === 'Child' ? 'Contribute to their tuition fees' : 'Contribute to charitable needs'}}" data-required="" @if(isset($savingsGoals) && is_array($savingsGoals) && in_array($goal_3, $savingsGoals)) disabled @endif>
                                                        <div class="col-4">
                                                            <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-'.($relationship === 'Child' ? 'tuition' :'donate').'.png') }}" width="auto" height="110px" alt="{{$goal_3}}">
                                                        </div>
                                                        <div class="col-8 d-flex justify-content-center">
                                                            <p class="avatar-text text-start mb-0 fw-bold lh-normal col-10">{{$relationship === 'Child' ? 'Contribute to their tuition fees' : 'Contribute to charitable needs'}}</p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-dark fade-effect pt-2 pb-3">
                                            <div class="col-12 button-bg">
                                                <div class="col-12 py-4 d-flex align-items-center justify-content-start hover">
                                                    <button class="border-0 w-100 d-flex align-items-center @if(isset($savingsGoals) && is_array($savingsGoals) && in_array('Others', $savingsGoals)) default @endif" data-avatar="Others" data-required="" @if(isset($savingsGoals) && is_array($savingsGoals) && in_array('Others', $savingsGoals)) disabled @endif>
                                                        <div class="col-4">
                                                            <img class="needs-icon" src="{{ asset('images/needs/savings/goals/goal-others.png') }}" width="auto" height="110px" alt="goal-other">
                                                        </div>
                                                        <div class="col-8 d-flex justify-content-center">
                                                            <p class="avatar-text text-start mb-0 fw-bold lh-normal col-7">Others</p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $savingsGoals = array_pad($savingsGoals ?? [], 4, null);
                                    @endphp
                                    <div class="row px-4 px-md-5 d-flex d-md-none">
                                        <ul id="sortablemobile">
                                            @foreach($savingsGoals as $savingsGoal)
                                            @php
                                                $icon = '';
                                                if($relationship === 'Child'){
                                                    if($savingsGoal == 'Pursue their interests'){
                                                        $icon = 'goal-interest';
                                                    } else if($savingsGoal == 'Start their own business'){
                                                        $icon = 'goal-business';
                                                    } else if('Contribute to their tuition fees'){
                                                        $icon = 'goal-tuition';
                                                    } else {
                                                        $icon = 'goal-others';
                                                    }
                                                }
                                                else{
                                                    if($savingsGoal == 'Travel around the world'){
                                                        $icon = 'goal-travel';
                                                    } else if($savingsGoal == 'Upgrade my assets & lifestyle'){
                                                        $icon = 'goal-home';
                                                    } else if('Contribute to charitable needs'){
                                                        $icon = 'goal-donate';
                                                    } else{
                                                        $icon = 'goal-others';
                                                    }
                                                }

                                            @endphp
                                                <li class="handle ui-state-default dropdown @if(!$savingsGoal) is-empty @endif" data-identifier="{{ $savingsGoal }}">
                                                    <span class="arrowIcon handle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent" data-attribute="{{ $savingsGoal }}" data-index="{{ $loop->index }}" data-bs-offset="0,0"><i class="fa-solid fa-chevron-down"></i></span>
                                                    @if($savingsGoal && $savingsGoal != 'undefined')
                                                        <img class="needs-icon" src="{{ asset('images/needs/savings/goals/' . $icon . '.png') }}" alt="{{ $savingsGoal }}">
                                                        {{ $savingsGoal }}
                                                    @else
                                                        {{ $loop->iteration }}
                                                    @endif
                                                    <ul class="dropdown-menu pre-scrollable" role="menu"></ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </section>
                                
                            <section class="footer bg-accent-light-white py-4 fixed-bottom footer-scroll">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex gap-2 d-md-block text-end px-4">
                                            <!-- Add a hidden input field to store the selected button -->
                                            <input type="hidden" name="savingsGoalsButtonInput" id="savingsGoalsButtonInput" value="{{ json_encode($savingsGoals) }}">
                                            <a href="{{route('savings.coverage')}}" class="btn btn-secondary flex-fill text-uppercase me-md-2">Back</a>
                                            <button type="submit" class="btn btn-primary flex-fill text-uppercase" id="nextButton">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="missingSavingsFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingSavingsFieldsLabel">Savings Priority to discuss is required.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to enable savings priority to discuss in Priorities To Discuss page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="missingLastPageInputFields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 pt-4 justify-content-center">
                <h3 class="modal-title fs-4 text-center" id="missingLastPageInputFieldsLabel">You're required to enter previous value before you proceed to this page.</h2>
            </div>
            <div class="modal-body text-dark text-center px-4 pb-4">
                <p>Please click proceed to input the value in previous page first.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-uppercase btn-exit-sidebar" data-bs-dismiss="modal">Proceed</button>
            </div>
        </div>
    </div>
</div>
<script>
    var savingsPriority = '{{$savingsPriority}}';
    var sessionData = {!! json_encode(session('customer_details.selected_needs.need_4.advance_details.goal_target')) !!};
    var lastPageInput = '{{$relationship}}';
</script>
@endsection