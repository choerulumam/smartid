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
            <div class="col-md-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-user-circle fa-3x"></i>
                    <div class="info">
                        <h4>Users</h4>
                        <p><b>{{ $mahasiswa->count() + $dosen->count() }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-user-circle fa-3x"></i>
                    <div class="info">
                        <h4>Dosen</h4>
                        <p><b>{{ $dosen->count() }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-user-circle fa-3x"></i>
                    <div class="info">
                        <h4>Mahasiswa</h4>
                        <p><b>{{ $mahasiswa->count() }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Kelas</h4>
                        <p><b>{{ $kelas->count() }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-title">
                        Today Class Schedule
                    </h4>
                    <table class="table table-responsive">
                        <th>Hari</th>
                        <th>Matakuliah</th>
                        <th>Ruangan</th>
                    </table>
                </div>
            </div>
             <div class="col-md-6">
                <div class="card">
                    <h4 class="card-title">
                        Active User
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
