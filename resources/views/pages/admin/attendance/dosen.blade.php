@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lectures Attendance</h1>
            <p>hello, {{ Auth::user()->name }}</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="#">Attendance</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
