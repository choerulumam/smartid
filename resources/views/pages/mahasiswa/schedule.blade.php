@extends('layouts.master')
@section('title', 'Schedule')
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
            <h1><i class="fa fa-calendar"></i> Schedule</h1>
            <p>Students Schedule</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Mahasiswa</li>
                <li><a href="{{ route('mahasiswa.schedule') }}">Schedule</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Schedule list</h4>
                    </div>
                    <table id="table" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>MATAKULIAH</th>
                            <th>HARI</th>
                            <th>JAM MASUK</th>
                            <th>JAM KELUAR</th>
                            <th>RUANGAN</th>
                            <th>DOSEN</th>
                        </thead>
                        <tbody>
                            @foreach($data as $schedule)
                            <tr>
                                <td>{{ $schedule->id }}</td>
                                <td>{{ $schedule->data_matakuliah->name }}</td>
                                <td>{{ $schedule->data_jadwal->hari }}</td>
                                <td>{{ $schedule->data_jadwal->jam_masuk }}</td>
                                <td>{{ $schedule->data_jadwal->jam_keluar }}</td>
                                <td>{{ $schedule->data_jadwal->ruangan }}</td>
                                <td>{{ $schedule->data_matakuliah->kode_dosen }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current taken schedule</p>
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
