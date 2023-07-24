{{-- Retirement Coverage page --}}

@extends('templates.master')

@section('title')
<title>Retirement - Age to Retire</title>
@endsection

@section('content')

<div id="retirementAgeToRetire" class="vh-100 overflow-auto container-fluid">

    <div class="container p-0">
        <div class="row">
            <div class="col-3 col-md-3 col-lg-3">
                @include('templates.nav.nav-red-menu')
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-6 col-sm-12 bg-primary px-1 summary-progress-bar">
                        <!-- <div class="row d-flex"> -->
                            <div class="col-12 retirement-progress mt-3 d-flex justify-content-enter align-items-center">
                                <div class="px-2 retirement-progress-bar" role="progressbar" style="width:45%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h3 class="needsProgressValue m-1 text-light text-center">RM1,500,000</h3>
                            <p class="text-light text-center">Total Retirement Fund Needed</p>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="col-3 col-md-3 col-lg-3">
                @include ('templates.nav.nav-sidebar-needs')
            </div>  
        </div>
            <div class="col-12 text-dark px-0 my-4">
                <div class="my-4">  
                    <form novalidate action="{{ route('form.age.to.retire') }}" method="POST">
                        @csrf
                    <section>
                        <div class="row">
                        <div id="bg-ideal-age" class="col-lg-6 justify-content-end d-flex flex-column align-items-center">
                            <img class="position-relative avatar-age-to-retire" src="{{ asset('images/needs/retirement/avatar-age-to-retire.svg') }}" alt="avatar">
                        </div>
                        <div class="col-lg-6 my-auto">
                            <h5 class="needs-text d-inline py-2 ms-5">I’d like to retire </h5> <br>
                            <h5 class="needs-text d-inline ms-5">at the age of</h5>
                            <input type="text" name="ageToRetire" class="form-control form-input-needs-sm d-inline text-primary @error('ageToRetire') is-invalid @enderror" id="ageToRetireInput" placeholder=" " value="{{ old('ageToRetireInput') }}">
                            @error('ageToRetire')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                                    <a href="{{route('retirement.ideal')}}"
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