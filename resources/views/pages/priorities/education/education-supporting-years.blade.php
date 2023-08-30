@extends('templates.master')

@section('title')
<title>Education - Supporting Years</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="education-content">
    <div class="container-fluid overflow-hidden font-color-default text-center">
        <div class="row bg-needs-desktop vh-100">
            <section class="col-12 d-flex needs-nav-mob">
                <div class="col-6 col-md-2 col-lg-2 col-xl-3">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-md-7 col-xl-6 hide-mobile">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 bg-primary container fund-nav-rad">
                            <div class="col-12 fund-progress mt-4 d-flex justify-content-enter align-items-center">
                                <div class="px-2 fund-progress-bar" style="width:45%;"></div>
                            </div>
                            <h3 class="font-color-white text-center">RM1,462,000</h3>
                            <p class="font-color-white text-center">Total Education Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div> 
                
            </section>
            <!-- <form class="form-horizontal"action="{{route('education.other')}}" method="get" id="children_education" name="children_education"> -->
            <form novalidate action="{{route('form.submit.education.supporting')}}" method="POST">
                @csrf
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-12 show-mobile">
                                <div class="row d-flex justify-content-center align-items-center bg-primary">
                                    <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                        <div class="px-2 fund-progress-bar" style="width:45%;"></div>
                                    </div>
                                    <h3 class="font-color-white text-center">RM1,462,000</h3>
                                    <p class="font-color-white text-center">Total Education Fund Needed</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 hide bg-half second-order position-relative d-flex justify-content-end align-items-end h-xxl-100">
                                <div class="row bg-education-supporting">
                                    <div class="show-desktop h-100 d-flex">
                                        <div class="col-12 d-flex h-100">
                                            <div class="row">
                                                <div class="col-4 position-relative">
                                                    <div class="row h-100">
                                                        <div class="z-99">
                                                            <img src="{{ asset('images/avatar/son.png') }}" class="m-auto mh-100 mw-100">
                                                            <p class="p-1 m-0"><strong>RM231,682</strong></p>
                                                        </div>
                                                        <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                                            <div class="col-11 col-md-4 text-center">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <img src="{{ asset('images/avatar/son.png') }}" class="m-auto z-99 mh-100 mw-100 position-absolute bottom-0 py-4">
                                                    <p class="text-center py-2 z-99"><strong>RM231,682</strong></p>
                                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                        <div class="col-11 col-md-4 text-center">
                                                            
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col-4 position-relative">
                                                    <div class="row">
                                                        <div class="z-99">
                                                            <img src="{{ asset('images/avatar/daughter.png') }}" class="m-auto mh-100 mw-100">
                                                            <p class="p-1 m-0"><strong>RM540,000</strong></p>
                                                        </div>
                                                        <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                                            <div class="col-11 col-md-4 text-center">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 position-relative">
                                                    <div class="row">
                                                        <div class="z-99">
                                                            <img src="{{ asset('images/avatar/young-kid.png') }}" class="m-auto mh-100 mw-100">
                                                            <p class="p-1 m-0"><strong>RM135,545</strong></p>
                                                        </div>
                                                        <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                                            <div class="col-11 col-md-4 text-center">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile hide-tablet">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 hide-desktop">
                                        <!-- <div class="col-11 col-sm-12 m-auto h-100"> -->
                                            <div class="row">
                                                <div class="col-4 position-relative h-100">
                                                    <div class="row h-100">
                                                        <div class="z-99">
                                                            <img src="{{ asset('images/avatar/son.png') }}" class="m-auto mh-100 mw-100">
                                                            <p class="py-2 m-0"><strong>RM231,682</strong></p>
                                                        </div>
                                                        <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                                            <div class="col-11 col-md-4 text-center">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <img src="{{ asset('images/avatar/son.png') }}" class="m-auto z-99 mh-100 mw-100 position-absolute bottom-0 py-4">
                                                    <p class="text-center py-2 z-99"><strong>RM231,682</strong></p>
                                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-desktop">
                                                        <div class="col-11 col-md-4 text-center">
                                                            
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col-4 position-relative">
                                                    <div class="row">
                                                        <div class="z-99">
                                                            <img src="{{ asset('images/avatar/daughter.png') }}" class="m-auto mh-100 mw-100">
                                                            <p class="py-2 m-0"><strong>RM540,000</strong></p>
                                                        </div>
                                                        <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                                            <div class="col-11 col-md-4 text-center">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 position-relative">
                                                    <div class="row">
                                                        <div class="z-99">
                                                            <img src="{{ asset('images/avatar/young-kid.png') }}" class="m-auto mh-100 mw-100">
                                                            <p class="py-2 m-0"><strong>RM135,545</strong></p>
                                                        </div>
                                                        <div class="d-flex justify-content-center bg-needs_text p-master w-100 position-absolute bottom-0">
                                                            <div class="col-11 col-md-4 text-center">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-12 show-mobile bg-btn_bar">
                                        <div class="py-4 px-2">
                                            <div class="col-12 d-grid gap-2 d-md-block text-end">
                                                <a href="{{route('education.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                                                <!-- <a href="{{route('education.other')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                                                <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 position-relative hide first-order">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-center z-99">
                                        <div class="">
                                            <div class="col-10 m-auto">
                                                <div class="text-start">
                                                    <p class="f-34 @error('education_year_1') is-invalid @enderror">
                                                        <label>1st Child</label>:
                                                        <span class="currencyinput"><input type="text" name="education_year_1" class="form-control d-inline-block w-25 f-34 @error('education_year_1') is-invalid @enderror" id="education_year_1" required></span>
                                                        &nbsp;year(s) old
                                                        @if ($errors->has('education_year_1'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_year_1') }}</div>
                                                        @endif
                                                    </p>
                                                    <p class="f-34 @error('education_year_2') is-invalid @enderror">
                                                        <label>2nd Child</label>:
                                                        <span class="currencyinput"><input type="text" name="education_year_2" class="form-control d-inline-block w-25 f-34 @error('education_year_2') is-invalid @enderror" id="education_year_2" required></span>
                                                        &nbsp;year(s) old
                                                        @if ($errors->has('education_year_2'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_year_2') }}</div>
                                                        @endif
                                                    </p>
                                                    <p class="f-34 @error('education_year_3') is-invalid @enderror">
                                                        <label>3rd Child</label>:
                                                        <span class="currencyinput"><input type="text" name="education_year_3" class="form-control d-inline-block w-25 f-34 @error('education_year_3') is-invalid @enderror" id="education_year_3" required></span>
                                                        &nbsp;year(s) old
                                                        @if ($errors->has('education_year_3'))
                                                            <div class="invalid-feedback">{{ $errors->first('education_year_3') }}</div>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0 hide-mobile hide-tablet">
                                        <div class="col-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar hide-mobile row">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('education.coverage.new')}}" class="btn btn-primary text-uppercase">Back</a>
                            <!-- <a href="{{route('education.other')}}" class="btn btn-primary mx-md-2 text-uppercase">Next</a> -->
                            <!-- <button type="submit" name="btn_next" id="btn_next" class="btn btn-primary mx-md-2 text-uppercase" value="btn_next">Next</button> -->
                            <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var education_coverage_1 = document.getElementById('education_year_1');
        var education_coverage_2 = document.getElementById('education_year_2');
        var education_coverage_3 = document.getElementById('education_year_3');

        education_coverage_1.addEventListener('blur', function() {
            validateAgeNumberField(education_coverage_1);
        });
        education_coverage_2.addEventListener('blur', function() {
            validateAgeNumberField(education_coverage_2);
        });
        education_coverage_3.addEventListener('blur', function() {
            validateAgeNumberField(education_coverage_3);
        });

        function validateAgeNumberField(field) {
            var minAge = 1;
            var maxAge = 100;

            var value = parseInt(field.value);

            if (!isNaN(value) && value >= minAge && value <= maxAge) {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            }
        }
    });
</script>
@endsection