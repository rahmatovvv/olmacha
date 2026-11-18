@extends('layouts.admin')

@section('title', 'Kursni tahrirlash')
@section('kicker', 'Katalog')
@section('header', $course->title)

@section('content')
<section class="card form-card">
    @include('admin.courses._form', ['course' => $course])
</section>
@endsection
