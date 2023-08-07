@extends('templates.master')

@section('title')
<title>Investment - Supporting Years</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayData = session('passingArrays');
@endphp

<div id="investment-supporting">
    <div class="container-fluid overflow-hidden font-color-default text-center">
        <div class="row bg-investment-supporting vh-100">
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
                            <h3 class="font-color-white" id="investment_fund_needed"></h3>
                            <p class="font-color-white">Total Investment Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                    @include ('templates.nav.nav-sidebar-needs')
                </div> 
            </section>
            <form novalidate action="{{route('form.submit.investment.supporting')}}" method="POST">
                @csrf
                <section class="needs-master-content">
                    <div class="col-12">
                        <div class="row h-100 overflow-y-auto overflow-x-hidden">
                            <div class="col-12 show-mobile">
                                <div class="row d-flex justify-content-center align-items-center bg-primary">
                                    <div class="col-9 p-0 fund-progress my-3 d-flex justify-content-start align-items-center">
                                        <div class="px-2 fund-progress-bar" style="width:75%;"></div>
                                    </div>
                                    <h3 class="font-color-white" id="investment_fund_needed"></h3>
                                    <p class="font-color-white">Total Investment Fund Needed</p>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="d-flex justify-content-center align-items-end">
                                        <h5 class="m-0 mt-4">I expect to keep investing for the next:</h5>
                                    </div>
                                    <!-- <div class="col-12 position-relative mt-4 h-100 calender"> -->
                                        <div class="position-relative py-4 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('images/needs/investment/Calendar.png') }}" class="m-auto calendar">
                                            <div class="position-absolute center w-100">
                                                <input type="text" name="invest_year" class="form-control d-inline-block w-25 f-64 text-center @error('invest_year') is-invalid @enderror" id="invest_year" required>
                                                <p class="f-34" class="mt-4"><strong>years</strong></p>
                                                @if ($errors->has('invest_year'))
                                                    <div class="invalid-feedback">{{ $errors->first('invest_year') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-12 show-mobile bg-btn_bar">
                                <div class="py-4 px-2">
                                    <div class="col-12 d-grid gap-2 d-md-block text-end">
                                        <a href="{{route('investment.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                                        <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="needs-master-footer footer bg-btn_bar hide-mobile row">
                    <div class="py-4 px-2">
                        <div class="col-12 d-grid gap-2 d-md-block text-end">
                            <input type="hidden" name="total_investment_fund_needed" id="total_investment_fund_needed" value="">
                            <a href="{{route('investment.coverage')}}" class="btn btn-primary text-uppercase">Back</a>
                            <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>

<script>
    function calculateInvestmentFund() {
        // Get the input value
        var yearsInput = document.getElementById("invest_year").value;

        var years = parseInt(yearsInput);

        // Calculate months
        var amount = years * 12 * 1000;

        // Display the result
        var result = amount.toLocaleString();
        document.getElementById("investment_fund_needed").innerText = "RM " + result;

        // Set the value of the hidden input field
        document.getElementById("total_investment_fund_needed").value = amount;

    }

    // Add an event listener to the input field
    document.getElementById("invest_year").addEventListener("input", function() {
        calculateInvestmentFund();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var invest_year = document.getElementById('invest_year');

        invest_year.addEventListener('blur', function() {
            validateYearsNumberField(invest_year);
        });

        function validateYearsNumberField(field) {
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