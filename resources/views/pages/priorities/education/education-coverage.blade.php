@extends('templates.master')

@section('title')
<title>Education - Home</title>

@section('content')

<div id="education" style="min-height:100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 font-color-default text-center">
                <section class="row bg-education d-flex justify-content-center align-items-center min-height-100 overflow-auto">
                </section>  
                <section class="footer">
                    <div class="row bg-btn_bar py-4 position-fixed button-container">
                        <div class="d-flex justify-content-end pe-4">
                            <a href="{{route('education.home')}}" class="btn btn-primary text-uppercase">back</a>
                            <a href="{{route('education.home') }}" class="btn btn-primary mx-2 text-uppercase">next</a>
                        </div>
                    </div>
                </section>    
            </div>
        </div>
    </div>
</div>

@endsection