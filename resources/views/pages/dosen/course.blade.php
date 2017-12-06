@extends('layouts.master')
@section('title', 'Course')
@section('content')
<style>
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: 80%;
}
</style>
<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-user-circle"></i> Course</h1>
            <p>Lectures Course</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Admin</li>
                <li><a href="{{ route('dosen.course') }}">Lectures</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Course Views</h4>
                    </div>
                    <table id="mytable" class="table table-responsive">
                        <th>#</th>
                        <th>KODE MATAKULIAH</th>
                        <th>NAMA MATAKULIAH</th>
                        @php $no = 1; @endphp
                        @foreach($data as $dosen)
                        <tr>
                            <td>{{ $no++ }}</td>                            
                            <td>{{ $dosen->kode }}</td>
                            <td>{{ $dosen->name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>        
    </div>
</div>

<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
@endsection
