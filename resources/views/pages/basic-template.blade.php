@extends('templates.master')  {{-- import main master.blade.php template --}}


@section('title')
<title>Welcome</title> {{-- replace title of the page --}}
@endsection

@section('content')

@include('templates.nav.nav-red') {{-- this is for navigation --}}

{{-- include main code here --}}

@endsection