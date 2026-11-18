@extends('layouts.admin')

@section('title', 'Guruhni tahrirlash')
@section('kicker', 'O‘quv jarayoni')
@section('header', $group->name)

@section('content')
<section class="card form-card">
    @include('admin.groups._form', ['group' => $group])
</section>
@endsection
