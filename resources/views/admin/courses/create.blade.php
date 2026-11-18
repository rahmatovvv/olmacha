@extends('layouts.admin')

@section('title', 'Yangi kurs')
@section('kicker', 'Katalog')
@section('header', 'Yangi kurs')

@section('content')
<section class="card form-card">
    @include('admin.courses._form')
</section>
@endsection
