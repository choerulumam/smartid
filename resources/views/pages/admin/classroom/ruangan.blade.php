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
            <h1><i class="fa fa-user-circle"></i> Classroom</h1>
            <p>Management Classroom</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Admin</li>
                <li><a href="{{ route('admin.classroom') }}">Classroom</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Available Classroom</h4>
                    </div>
                    <table id="table" class="table table-stripped">
                        <thead>
                            <th>ID</th>
                            <th>KODE</th>
                            <th>KAPASITAS</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            @foreach($data as $classroom)
                            <tr class="user{{ $classroom->id }}">
                                <td>{{ $classroom->id }}</td>
                                <td>{{ $classroom->kode }}</td>
                                <td>{{ $classroom->kapasitas }}</td>
                                <td>
                                    <button style="margin-right: 2px" class="edit-modal btn btn-info btn-sm" data-info="{{$classroom->id}},{{$classroom->kode}},{{$classroom->kapasitas}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button class="delete-modal btn btn-danger btn-sm" data-info="{{$classroom->id}},{{$classroom->kode}},{{$classroom->kapasitas}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="card-text">This table showing current classroom data</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="classroomForm" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>Add New Class</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="ID">ID</label>
                                <div class="col-lg-10">
                                    <input class="form-control" value="{{$data->count()+1}}" id="ID" type="text" placeholder="ID" disabled="true">
                                </div>
                            </div>
                            <div id="FieldKode" class="form-group">
                                <label class="col-lg-2 control-label" for="kode">Kode</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="kode" type="text" placeholder="Kode Ruangan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="kapasitas">Kapasitas</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="kapasitas" type="text" placeholder="Kapasitas">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
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
<script src="{{ asset('js/plugins/jquery.validate.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>

<script>
    var p_data = {!! $data !!};
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true
        });

        $('#kode').on('input', function() {
            var input=$(this);
            var is_name=input.val();
            for(var i = 0; i < p_data.length; i++){
                if (is_name === p_data[i].kode) {
                    $('#FieldKode').removeClass("has-success").addClass("has-error");
                    break;
                } else {
                    $('#FieldKode').removeClass("has-error").addClass("has-success");
                }
            }
        });
    });

    $(document).on('click', '#cancel', function(){
        event.preventDefault();
        $('#kode').val('');
        $('#kapasitas').val('');
    });

    $(document).on('click', '#addData', function() {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.classroom.create') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#ID').val(),
                'kode': $('#kode').val(),
                'kapasitas': $('#kapasitas').val(),
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
