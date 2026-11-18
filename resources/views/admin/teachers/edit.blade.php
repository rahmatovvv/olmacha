@extends('layouts.admin')

@section('title', 'O‘qituvchini tahrirlash')
@section('kicker', 'Jamoa')
@section('header', $teacher->name)

@section('content')
<section class="card form-card">
    @include('admin.teachers._form', ['teacher' => $teacher])
</section>
@endsection
