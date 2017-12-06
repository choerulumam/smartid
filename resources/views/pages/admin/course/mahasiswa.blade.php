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
<<<<<<< HEAD
            <h1><i class="fa fa-university"></i> Course</h1>
=======
            <h1><i class="fa fa-user-circle"></i> Course</h1>
>>>>>>> 86d17942bc7bf8d0b68512c3b37e3026d995777a
            <p>Students Course</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Admin</li>
                {{-- <li><a href="{{ route('admin.course') }}">Course</a></li> --}}
                <li><a href="{{ route('admin.course.mahasiswa') }}">Students</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Course Views</h4>
                    </div>
                    <table id="table" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>NIM</th>
                            <th>NAME</th>
                            <th>MATAKULIAH</th>
                            <th>DOSEN</th>
                            <th>RUANGAN</th>
                            <th>HARI</th>
                            <th>MASUK</th>
                            <th>KELUAR</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            @foreach($data as $course)
                            <tr class="user{{ $course->id }}">
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->nim }}</td>
                                <td>{{ $course->data_mahasiswa->name }}</td>
                                <td>{{ $course->data_matakuliah->kode }}</td>
                                <td>{{ $course->data_matakuliah->kode_dosen }}</td>
                                <td>{{ $course->data_jadwal->ruangan }}</td>
                                <td>{{ $course->data_jadwal->hari }}</td>
                                <td>{{ $course->data_jadwal->jam_masuk }}</td>
                                <td>{{ $course->data_jadwal->jam_keluar }}</td>
                                <td>
                                    <button style="margin-right: 2px" class="edit-modal btn btn-info btn-sm" data-info="{{$course->id}},{{$course->nim}},{{$course->data_mahasiswa->name}},{{$course->data_matakuliah->kode}},{{$course->data_matakuliah->kode_dosen}},{{$course->data_jadwal->ruangan}},{{$course->data_jadwal->hari}},{{$course->data_jadwal->jam_masuk}}, {{$course->data_jadwal->jam_keluar}}, {{$course->data_matakuliah->name}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button class="delete btn btn-danger btn-sm" data-info="{{$course->id}},{{$course->nim}},{{$course->data_mahasiswa->name}},{{$course->data_matakuliah->kode}},{{$course->data_matakuliah->kode_dosen}},{{$course->data_jadwal->ruangan}},{{$course->data_jadwal->hari}},{{$course->data_jadwal->jam_masuk}}, {{$course->data_jadwal->jam_keluar}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current course data</p>
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
