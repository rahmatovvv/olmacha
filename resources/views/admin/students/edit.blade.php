@extends('layouts.admin')

@section('title', 'Talabani tahrirlash')
@section('kicker', 'Foydalanuvchilar')
@section('header', $student->name)

@section('content')
<section class="card form-card">
    @include('admin.students._form', ['student' => $student])
</section>
@endsection
