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
                        <label class="control-label col-sm-3" for="CLid">ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="CLid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="CLkode">kode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="CLkode" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="CLKapasitas">Kapasitas</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="CLKapasitas">
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
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>

<script>
    var p_data = {!! $data !!};
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]
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
        $('#CLid').val(details[0]);
        $('#CLkode').val(details[1]);
        $('#CLKapasitas').val(details[2]);
    };

     $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.classroom.update') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#CLid").val(),
                'kode': $('#CLkode').val(),
                'kapasitas': $('#CLKapasitas').val()
            },
            success: function(data) {
                $(document).ajaxSuccess(function(){
                    swal({
                        title: "Success",
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
            title: "Delete classroom " + stuff[1] + " ?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.classroom.delete') }}",
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
