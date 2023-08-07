@extends('templates.master')

@section('title')
<title>Investment - Returns</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="investment-content">
    <div class="container-fluid overflow-hidden font-color-default">
        <div class="row bg-needs-desktop vh-100">
            <section class="col-12 d-flex needs-nav-mob">
                <div class="col-6 col-md-2 col-lg-2 col-xl-3">
                    @include('templates.nav.nav-red-menu')
                </div>
                <div class="col-md-7 col-xl-6 hide-mobile">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 bg-primary container fund-nav-rad">
                            <div class="col-12 fund-progress mt-4 d-flex justify-content-enter align-items-center">
                                <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                            </div>
                            @php
                                $totalInvestmentFundNeeded = $arrayData['TotalInvestmentFundNeeded'];
                                $formattedAmount = number_format($totalInvestmentFundNeeded);
                            @endphp
                            @if(isset($arrayData['TotalInvestmentFundNeeded']))
                                <h3 class="font-color-white text-center" id="investment_fund_needed">RM @php echo $formattedAmount  @endphp</h3>
                            @endif
                            <p class="font-color-white text-center">Total Investment Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div> 
            </section>
            <!-- <form class="form-horizontal p-0"action="{{route('investment.expected.return')}}" method="get" id="investment" name="investment"> -->
            <form novalidate action="{{route('form.submit.investment.annual.return')}}" method="POST" id="investment_annual">
                @csrf
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-12 show-mobile">
                                <div class="row d-flex justify-content-center align-items-center bg-primary">
                                    <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                        <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                                    </div>
                                    @php
                                        $totalInvestmentFundNeeded = $arrayData['TotalInvestmentFundNeeded'];
                                        $formattedAmount = number_format($totalInvestmentFundNeeded);
                                    @endphp
                                    @if(isset($arrayData['TotalInvestmentFundNeeded']))
                                        <h3 class="font-color-white text-center" id="investment_fund_needed">RM @php echo $formattedAmount  @endphp</h3>
                                    @endif
                                    <p class="font-color-white text-center">Total Investment Fund Needed</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 hide bg-half second-order position-relative">
                                <div class="row">
                                    <div class="show-desktop p-0">
                                        <img src="{{ asset('images/needs/investment/investment-avatar.png') }}" class="m-auto z-99 mh-100 mw-100 position-absolute bottom-0 py-4">
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative hide-desktop">
                                        <img src="{{ asset('images/needs/investment/investment-avatar.png') }}" class="m-auto z-99 mh-100 mw-100 py-4 position-relative">
                                        <div class="d-flex justify-content-center bg-needs_text p-master position-absolute w-100 bottom-0">
                                            <div class="col-11 col-md-4 text-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 show-mobile bg-btn_bar">
                                        <div class="py-4 px-2">
                                            <div class="col-12 d-grid gap-2 d-md-block text-end">
                                                <a href="{{route('investment.supporting')}}" class="btn btn-primary text-uppercase">Back</a>
                                                <button class="btn btn-primary text-uppercase" id="nextBtn" type="submit">Next</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-12 position-relative hide first-order">
                                <div class="row">
                                    <div class="col-12 d-flex mt-5 justify-content-start z-99">
                                        <div class="">
                                            <div class="col-8 m-auto">
                                                <div class="text-start f-34">
                                                    <p><strong>Of course, ideally I'd like to see</strong></p>
                                                    <span class="currencyinput">RM<input type="text" name="anuual_percentage" class="form-control d-inline-block w-50 f-34" id="anuual_percentage" required></span>
                                                    <p class="@error('anuual_percentage') is-invalid @enderror"><strong>in annual returns</strong></p>
                                                    @if ($errors->has('anuual_percentage'))
                                                        <div class="invalid-feedback">{{ $errors->first('anuual_percentage') }}</div>
                                                    @endif
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
                <section class="needs-master-footer footer bg-btn_bar row">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <a href="{{route('investment.supporting')}}" class="btn btn-primary text-uppercase">Back</a>
                            <button class="btn btn-primary text-uppercase" id="nextBtn" type="submit">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var anuual_percentage = document.getElementById('anuual_percentage');

        anuual_percentage.addEventListener('blur', function() {
            validateNumberField(anuual_percentage);
        });

        function validateNumberField(field) {

            var value = field.value.trim();

            if (value === '' || isNaN(value)) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            } else {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            }
        }
    });
</script>

@endsection