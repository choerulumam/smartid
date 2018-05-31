@extends('layouts.master')
@section('title', 'Home')
@section('content')
@php use Carbon\Carbon; 
$dt = Carbon::now(); 
@endphp 
<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Admin Dashboard</h1>
            <p>hello, {{ Auth::user()->name }}</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="#">Logs</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table " id="table-logs">
                        <thead>
                            <th>TANGGAL</th>
                            <th>WAKTU</th>
                            <th>DATA</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/socket.io.js') }}"></script>
<script>
    var tanggal = {!! $dt->toDateString(); !!};
    var waktu = "{!! $dt->toTimeString(); !!}";
    var socket = io('http://localhost:8080');
        socket.on('log', function(data){
            $('#table-logs').append('<tr><td>' + tanggal + '</td><td>' + waktu + '</td><td>' + data + '</td></tr>');
        });
</script>
@endsection
