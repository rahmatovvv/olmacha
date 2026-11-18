@extends('layouts.admin')

@section('title', 'Yangi guruh')
@section('kicker', 'O‘quv jarayoni')
@section('header', 'Yangi guruh')

@section('content')
<section class="card form-card">
    @include('admin.groups._form')
</section>
@endsection
