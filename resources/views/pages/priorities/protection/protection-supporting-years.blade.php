@extends('templates.master')

@section('title')
<title>4.Protection - Supporting Years</title>
@endsection

@section('content')
<div id="protection-supporting-years">
    <div class="container-fluid overflow-hidden d-flex h-100 flex-column">
            <section>
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
                            <p class="text-light text-center">Total Protection Fund Needed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 order-sm-1 order-md-2 order-lg-2 order-1">
                    @include('templates.nav.nav-sidebar-needs')
                </div>
            </div>
        </section>
            <section>
                <div class="row flex-grow-1">
                <form class="form-horizontal p-0  m-0 m-md-4 m-lg-0 needs-validation"  id="protectionSupportingYears" novalidate action="{{route('protection.existing.policy')}}" method="get">
                    <div class="col-12 ">
                        <div class="row overflow-y-auto overflow-x-hidden bg-needs-2 vh-100 justify-content-center">
                            <div class="row d-flex flex-column flex-lg-row justify-content-start align-items-start align-items-md-start align-items-lg-center h-75">
                                <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-end z-1">
                                    <h5 class="m-0 mt-4 needs-text">I will need</h5>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div
                                        class="position-relative pt-4 pb-4 pt-lg-0 pb-lg-4 m-2 m-lg-4 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('images/needs/protection/Calendar.png') }}"
                                            class="calendar-protection">
                                        <div class="position-absolute center w-100 text-center">
                                            <input type="number" name="fund_year1"
                                                class="form-control d-inline-flex text-primary w-25 f-64 text-center"
                                                id="fund_year1" required>
                                            <h5 class="needs-text">years</h5>
                                            <div class="invalid-feedback w-100">Please enter the years.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h5 class="m-0 mt-4 needs-text">to achieve my goal.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer bg-white py-4 fixed-bottom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-grid gap-2 d-md-block text-end">
                                    <a href="{{route('protection.monthly.support')}}"
                                        class="btn btn-primary text-uppercase me-md-2">Back</a>
                                    <button type="submit" class="btn btn-primary text-uppercase">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </section>
    </div>
</div>
<script>

    document.getElementById("protectionSupportingYears").addEventListener("submit", function(event) {
    event.preventDefault();
    event.stopPropagation();
    
    var form = event.target;
    if (form.checkValidity() === false) {
      // If the form is invalid, show custom error messages
      form.classList.add("was-validated");
    } else {
        //route to next page if success
        window.location.href = "{{route('protection.existing.policy')}}";
    }
  });

</script>
@endsection