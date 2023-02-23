@extends('layouts.Admin.layout')

@if (session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif


@section('sidebar')
@include('layouts.Admin.sidebar')
@endsection

@section('content')
@include('admin.post.calender')
@endsection