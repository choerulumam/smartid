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
                            <th>#</th>
                            <th>ID</th>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>DOSEN</th>
                        </thead>
                        <tbody>
                            @foreach($mk as $acourse)
                            <tr>
                                <td><input type="checkbox" name="check"/></td>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="id">ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="id" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nim">NIM</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nim" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="matakuliah">Matakuliah</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="matakuliah">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="jadwal">Jadwal</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="jadwal">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button"> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        Close
                    </button>
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

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });

    function fillmodalData(details){
        $('#id').val(details[0]);
        $('#nim').val(details[1]);
        $('#matakuliah').val(details[3] + " - " + details[9]);
        $('#jadwal').val(details[6] + " " + details[5] + " " + details[7] + "-" + details[8]);
    };
</script>
@endsection
