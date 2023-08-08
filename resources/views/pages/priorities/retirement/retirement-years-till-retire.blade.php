{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Years till Retire</title>
@endsection

@section('content')

<div id="retirementYearsTillRetire" class="vh-100 overflow-auto container-fluid">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-0 order-md-0 order-lg-0 order-0">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-6 order-sm-2 order-md-1 order-lg-1 order-2">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-8 col-xl-6 bg-primary summary-progress-bar px-4 px-lg-2">
                        <div
                            class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                            <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
                        <p class="text-light text-center">Total Retirement Fund Needed</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                @include('templates.nav.nav-sidebar-needs')
            </div>
        </div>
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <form class="form-horizontal p-0 needs-validation" id="retirementYearsTillRetireForm" novalidate action="{{ route('form.retirement.years.till.retire') }}" method="POST">
                        @csrf
                    <section>
                        <div class="row">
                        <div class="bg-needs-1 col-lg-6 d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center order-1 order-lg-0">
                            <img class="position-relative avatar-years-till-retire" src="{{ asset('images/needs/retirement/years-to-retire-avatar.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-5 my-auto d-flex flex-column justify-content-sm-center justify-content-lg-end align-items-center align-items-lg-start mx-4 mx-lg-5 order-0 order-lg-1">
                            <h5 class="needs-text">I plan to have</h5>
                            <div class="input-group w-50">
                                <input type="text" name="retirementYearsTillRetire" class="form-control text-primary @error('retirementOtherSourceOfIncome') is-invalid @enderror" value="{{ old('retirementOtherSourceOfIncome') }}" id="retirementYearsTillRetire" placeholder=" " required> 
                                <h5 class="needs-text">golden years</h5>
                            </div>
                            <h5 class="needs-text">to enjoy my retirement.</h5>
                        </div>
                        @if ($errors->has('retirementYearsTillRetire'))
                        <div class="invalid-feedback text-center alert alert-danger position-absolute errorMessage d-block" id="retirementYearsTillRetireErrorMsg">{{ $errors->first('retirementYearsTillRetire') }}</div>
                        @endif
                        </div>
                        <div class="d-flex needs-grey-bg-md justify-content-center bg-accent-bg-grey position-absolute w-100 bottom-0">
                            <div class="col-11 col-md-4 text-center">
                            </div>
                        </div>
                    </section>
                    
                    <section class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('retirement.allocated.funds')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                        <button class="btn btn-primary text-uppercase" type="submit">Next</button>
                                </div>
                            </div>
                        </div>
                    </section>
                    </form>
                </div>
            </div>
    </div>

    @endsection