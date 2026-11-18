@extends('layouts.admin')

@section('title', 'Yangi o‘qituvchi')
@section('kicker', 'Jamoa')
@section('header', 'Yangi o‘qituvchi')

@section('content')
<section class="card form-card">
    @include('admin.teachers._form')
</section>
@endsection
