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
            <h1><i class="fa fa-user-circle"></i> Schedule</h1>
            <p>Management Schedule</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Admin</li>
                <li><a href="{{ route('admin.schedule') }}">Schedule</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Available Schedule</h4>
                    </div>
                    <table id="table" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>HARI</th>
                            <th>MATAKULIAH</th>
                            <th>RUANGAN</th>
                            <th>MULAI</th>
                            <th>SELESAI</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            @foreach($data as $course)
                            <tr class="course{{ $course->id }}">
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->hari }}</td>
                                <td>{{ $course->matakuliah }}</td>
                                <td>{{ $course->ruangan }}</td>
                                <td>{{ $course->jam_masuk }}</td>
                                <td>{{ $course->jam_keluar }}</td>
                                <td>
                                    <button style="margin-right: 2px" class="edit-modal btn btn-info btn-sm" data-info="{{$course->id}},{{$course->hari}},{{$course->matakuliah}}, {{ $course->ruangan }}, {{ $course->jam_masuk }}, {{ $course->jam_keluar }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button class="delete-modal btn btn-danger btn-sm" data-info="{{$course->id}},{{$course->hari}},{{$course->matakuliah}}, {{ $course->ruangan }}, {{ $course->jam_masuk }}, {{ $course->jam_keluar }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current schedule data</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form id="CourseForm" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>Add New Course</legend>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="CourseID">ID</label>
                                <div class="col-lg-8">
                                    <input class="form-control" value="{{$data->count()+1}}" id="CourseID" type="text" placeholder="ID" disabled="true">
                                </div>
                            </div>
                            <div id="FieldKode" class="form-group">
                                <label class="col-lg-4 control-label" for="CourseHari">Hari</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="CourseHari">
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                        <option>Sabtu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="CourseMK">Matakuliah</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="CourseMK">
                                        @foreach($matakuliah as $kode_mk)
                                        <option>{{ $kode_mk->kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="CourseRN">Ruangan</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="CourseRN">
                                        @foreach($ruangan as $kode_rn)
                                        <option>{{ $kode_rn->kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group bootstrap-timepicker timepicker">
                                <label class="col-lg-4 control-label" for="CourseJM">Jam Masuk</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="CourseJM" type="text">
                                </div>
                            </div>
                            <div class="form-group bootstrap-timepicker timepicker">
                                <label class="col-lg-4 control-label" for="CourseJK">Jam Keluar</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="CourseJK" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8 col-lg-offset-4">
                                    <button class="btn btn-default" id="cancel">Cancel</button>
                                    <button class="btn btn-primary" id="addData">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
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
                        <label class="control-label col-sm-3" for="MCid">ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="MCid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="MChari">hari</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="MChari">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="MCmk">Matakuliah</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="MCmk">
                                    @foreach($matakuliah as $kode_mk)
                                    <option>{{ $kode_mk->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="MCrn">Ruangan</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="MCrn">
                                @foreach($ruangan as $rn)
                                <option>{{ $rn->kode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker timepicker">
                        <label class="control-label col-sm-3" for="MCjm">Jam Masuk</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="MCjm" type="text">
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker timepicker">
                        <label class="control-label col-sm-3" for="MCjk">Jam Keluar</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="MCjk" type="text">
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
<script src="{{ asset('js/plugins/jquery.validate.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>

<script>

    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true
        });
    });

    $('#CourseJM').timepicker({
        maxHours: 24,
        showSeconds: true,
        showMeridian: false,
        defaultTime: false,
        minuteStep: 1
    });

    $('#CourseJK').timepicker({
        maxHours: 24,
        showSeconds: true,
        showMeridian: false,
        defaultTime: false,
        minuteStep: 1
    });

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff);

        $('#MCjm').timepicker({
            maxHours: 24,
            showSeconds: true,
            showMeridian: false,
            defaultTime: stuff[4],
            minuteStep: 1
        });

        $('#MCjk').timepicker({
            maxHours: 24,
            showSeconds: true,
            showMeridian: false,
            defaultTime: stuff[5],
            minuteStep: 1
        });

        $('#myModal').modal('show');
    });

    function fillmodalData(details){
        $('#MCid').val(details[0]);
        $('#MChari').val(details[1]);
        $('#MCmk').val(details[2]);
        $('#MCrn').val(details[3]);
        $('#MCjm').val(details[4]);
        $('#MCjk').val(details[5]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.schedule.update') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#MCid").val(),
                'hari': $('#MChari').val(),
                'mk': $('#MCmk').val(),
                'rn': $('#MCrn').val(),
                'jm': $('#MCjm').val(),
                'jk': $('#MCjk').val(),
            },
            success: function(data) {
                $(document).ajaxSuccess(function(){
                    swal({
                        title: "Update Success",
                        text: "Your record have been updated",
                        type: "success",
                        timer: 1000
                    }, 
                        function(){
                            location.reload(); 
                        }
                    );     
                });
            }
        });
    });

    $(document).on("click", ".delete-modal", function() {
        var stuff = $(this).data('info').split(',');
        swal({
            title: "Delete Jadwal hari " + stuff[1] + " Matakuliah " + stuff[2] +" ?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.schedule.delete') }}",
                data: {
                    "_token": $("input[name=_token]").val(),
                    "id": stuff[0]
                },
                success: function(data) {
                    $(document).ajaxSuccess(function(){
                        swal({
                            title: "Success",
                            text: "Your record have been deleted",
                            type: "success",
                            timer: 1000
                        }, 
                            function(){
                                location.reload(); 
                            }
                        )     
                    })
                }
            });
        });
    });

    $(document).on('click', '#addData', function() {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.schedule.create') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#CourseID').val(),
                'hari': $('#CourseHari').val(),
                'mk': $('#CourseMK').val(),
                'rn': $('#CourseRN').val(),
                'jm': $('#CourseJM').val(),
                'jk': $('#CourseJK').val()
            },
            success: function(data) {
                 $(document).ajaxSuccess(function(){
                    swal({
                        title: "Success",
                        text: "Your record have been added",
                        type: "success",
                        timer: 4000
                    }, 
                        function(){
                            location.reload(); 
                        }
                    );     
                });
            }
        });
    });


    $(document).ajaxError(function(){
        swal({
            title: "Error",
            text: "Your record haven't been updated",
            type: "warning",
            timer: 1000
        });     
    });
</script>
@endsection
