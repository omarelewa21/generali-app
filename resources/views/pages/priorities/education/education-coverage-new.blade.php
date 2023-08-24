<?php
 /**
 * Template Name: Education Coverage New Page
 */
?>

@extends('templates.master')

@section('title')
<title>Education - Coverage</title>

@section('content')

@php
    // Retrieving values from the session
    $arrayDataEducation = session('passingArraysEducation');
    $educationSelectedAvatar= isset($arrayDataEducation['educationSelectedAvatar']) ?
    $arrayDataEducation['educationSelectedAvatar'] : '';
@endphp

<div id="education-coverage" class="vh-100">
    <div class="container-fluid">
    </div>
</div>