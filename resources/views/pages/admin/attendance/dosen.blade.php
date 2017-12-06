@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Admin Dashboard</h1>
            <p>hello, {{ Auth::user()->name }}</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="#">Blank Page</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">You login as admin</div>
            </div>
        </div>
    </div>
</div>
@endsection
