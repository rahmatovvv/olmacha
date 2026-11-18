@extends('layouts.admin')

@section('title', 'Yangi talaba')
@section('kicker', 'Foydalanuvchilar')
@section('header', 'Yangi talaba')

@section('content')
<section class="card form-card">
    @include('admin.students._form')
</section>
@endsection
