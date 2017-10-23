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
            <h1><i class="fa fa-user-circle"></i> Course</h1>
            <p>Lectures Course</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Admin</li>
                {{-- <li><a href="{{ route('admin.course') }}">Course</a></li> --}}
                <li><a href="{{ route('admin.course.dosen') }}">Lectures</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Course Views</h4>
                    </div>
                    <table id="table" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>CODE</th>
                            <th>NAME</th>
                            <th>LECTURES</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            @foreach($matakuliah as $course)
                            <tr class="user{{ $course->id }}">
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->kode }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->kode_dosen }}</td>
                                <td>
                                    <button style="margin-right: 2px" class="edit btn btn-info btn-sm" data-info="{{$course->id}},{{$course->kode}},{{$course->name}},{{$course->kode_dosen}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button class="delete btn btn-danger btn-sm" data-info="{{$course->id}},{{$course->kode}},{{$course->name}},{{$course->name}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current course data</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="courseForm" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>Add New Course</legend>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="ID">ID</label>
                                <div class="col-lg-9">
                                    <input class="form-control" value="{{$matakuliah->count()+1}}" id="ID" type="text" placeholder="ID" disabled="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="kode">Kode Matakuliah</label>
                                <div class="col-lg-9">
                                    <input class="form-control" id="kode" type="text" placeholder="Kode Matakuliah">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="name">Nama Matakuliah</label>
                                <div class="col-lg-9">
                                    <input class="form-control" id="name" type="text" placeholder="Nama Matakuliah">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="kdosen">Kode Dosen</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="kdosen">
                                        @foreach($dosen as $kode)
                                        <option>{{ $kode->kode_dosen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-9 col-lg-offset-3">
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

<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true
        });
    });

    $(document).on("click", "#cancel", function(){
        event.preventDefault();
        $("#name").val('');
        $("#kode").val('');
    });

    $(document).on("click", "#addData", function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('admin.course.dosen.create') }}",
            data: {
                "_token": $("input[name=_token]").val(),
                "id": $("#ID").val(),
                "kode": $("#kode").val(),
                "nama_matakuliah": $("#name").val(),
                "kdosen": $("#kdosen").val()
            },
            success: function(data) {
                $(document).ajaxSuccess(function(){
                    swal({
                        title: "Success",
                        text: "Your record have been added",
                        type: "success",
                        timer: 2000
                    }, 
                        function(){
                            location.reload(); 
                        }
                    )     
                })
            }
        })
    });

    $(document).on("click", ".delete", function() {
        var stuff = $(this).data('info').split(',');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.course.dosen.delete') }}",
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
                            timer: 2000
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

    $(document).ajaxError(function(){
        swal({
            title: "Error",
            text: "Your record haven't been updated",
            type: "warning"
        });     
    });
</script>
@endsection
