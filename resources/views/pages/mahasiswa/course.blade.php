@extends('layouts.master')
@section('title', 'Classroom')
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
            <h1><i class="fa fa-university"></i> Course</h1>
            <p>Students Course</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Mahasiswa</li>
                <li><a href="{{ route('mahasiswa.course') }}">Course</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Taken Course</h4>
                    </div>
                    <table id="table" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>DOSEN</th>
                        </thead>
                        <tbody>
                            @foreach($data as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->data_matakuliah->kode }}</td>
                                <td>{{ $course->data_matakuliah->name }}</td>
                                <td>{{ $course->data_matakuliah->kode_dosen }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current taken course</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Available Course</h4>
                    </div>
                    <table id="table2" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>DOSEN</th>
                        </thead>
                        <tbody>
                            @foreach($mk as $acourse)
                            <tr>
                                <td>{{ $acourse->id }}</td>
                                <td>{{ $acourse->kode }}</td>
                                <td>{{ $acourse->name }}</td>
                                <td>{{ $acourse->kode_dosen }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current taken course</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]
        });
        $('#table2').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]
        });
    });
</script>
@endsection
