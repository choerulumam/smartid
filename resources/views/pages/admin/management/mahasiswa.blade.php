@extends('layouts.master')
@section('title', 'Management Mahasiswa')
@section('content')
<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-user-circle"></i> Management</h1>
            <p>Mahasiswa</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Management</li>
                <li><a href="{{ route('admin.manage.mahasiswa') }}">mahasiswa</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title-w-btn">
                    <h3 class="title">Mahasiswa Overviews</h3>
                    <p>
                        <button class="btn btn-primary add-modal"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-primary export-modal"><i class="fa fa-download"></i></button>
                        <button class="btn btn-primary export-modal"><i class="fa fa-download"></i></button>
                    </p>
                </div>
                <table id="table" class="table table-responsive">
                    <thead>
                        <th>ID</th>
                        <th>NIM</th>
                        <th>NAME</th>
                        <th>KELAS</th>
                        <th>MAC ADDRESS</th>
                        <th>EMAIL</th>
                        <th>ACTIONS</th>
                    </thead>
                    <tbody>
                        @foreach($data as $user)
                        <tr class="user{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->kelas}}</td>
                            <td>{{ $user->mac }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button style="margin-right: 2px" class="edit-modal btn btn-info btn-sm" data-info="{{$user->id}},{{$user->nim}},{{$user->name}},{{ $user->kelas}},{{$user->email}},{{$user->mac}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button class="delete-modal btn btn-danger btn-sm" data-info="{{$user->id}},{{$user->nim}},{{$user->name}},{{ $user->kelas}},{{$user->email}},{{$user->mac}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        <label class="control-label col-sm-3" for="Mid">ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Mid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="Mnim">NIM</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="Mnim" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="Mname">Name</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="Mname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="Mkelas">kelas</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="Mkelas">
                                @foreach($kelas as $mhs_kelas)
                                    <option>{{ $mhs_kelas->kode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="Mmac">Mac Address</label>
                        <div class="col-sm-9">
                            <input type="name" class="form-control" id="Mmac">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="Memail">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="Memail">
                        </div>
                    </div>
                    <div id="Mpassword" class="form-group hidden">
                        <label class="control-label col-sm-3" for="Mpass">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="Mpass" required="true">
                        </div>
                    </div>
                    {{-- <div id="MpasswordValidate" class="form-group hidden">
                        <label class="control-label col-sm-3" for="MpassV">Password Confirm</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="MpassV" required="true">
                        </div>
                    </div> --}}
                </form>
                <div class="deleteContent"> Are you Sure you want to delete <span class="dname"></span> ? <span class="hidden did"></span>
                </div>
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
        $('#table').DataTable();
    });

    $(document).on('click', '.add-modal', function() {
        $('#footer_action_button').text(' submit');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('add');
        $('.modal-title').text('Add User');
        $('#Mnim').val('');
        $('#Mname').val('');
        $('#Memail').val('');
        $('#Mmac').val('');
        $('#Mpassword').removeClass('hidden');
        // $('#MpasswordValidate').removeClass('hidden');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#Mid').val({{ $data->count() + 1 }});
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.manage.mahasiswa.create') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#Mid").val(),
                'nim': $('#Mnim').val(),
                'name': $('#Mname').val(),
                'email': $('#Memail').val(),
                'kelas': $('#Mkelas').val(),
                'mac': $('#Mmac').val(),
                'password' : $('#Mpass').val(),
            },
            success: function(data) {
                $(document).ajaxSuccess(function(){
                    swal({
                        title: "Success",
                        text: "New User Have Been Created updated",
                        type: "success",
                        timer: 1000
                    },
                        function(){
                            location.reload();
                        }
                    );     
                });
                $('#table > tbody:last-child').append("<tr class='user" + data.id + "'><td>" + data.id + "</td><td>" + data.nim + "</td><td>" + data.name + "</td><td>" + data.kelas + "</td><td>" + data.mac + "</td><td>"+ data.email +"<button class='edit-modal btn btn-info' data-info='" + data.id+","+data.nim+","+data.name+","+data.kelas+","+data.mac+", "+data.email+"'><span style='margin-right: 2px' class='fa fa-pencil-square-o'></span></button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.nim+","+data.name+","+data.kelas+","+data.mac+", "+data.email+"'><span class='fa fa-trash-o'></span></button></td></tr>");
            }
        });
    });

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').removeClass('add');
        $('.actionBtn').addClass('edit');
        $('#Mpassword').addClass('hidden');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });

    function fillmodalData(details){
        $('#Mid').val(details[0]);
        $('#Mnim').val(details[1]);
        $('#Mname').val(details[2]);
        $('#Mkelas').val(details[3]),
        $('#Memail').val(details[4]);
        $('#Mmac').val(details[5]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.manage.mahasiswa.update') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#Mid").val(),
                'nim': $('#Mnim').val(),
                'name': $('#Mname').val(),
                'kelas': $('#Mkelas').val(),
                'email': $('#Memail').val(),
                'mac': $('#Mmac').val(),
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
                $('.user' + data.id).replaceWith("<tr class='user" + data.id + "'><td>" + data.id + "</td><td>" + data.nim + "</td><td>" + data.name + "</td><td>" + data.kelas + "</td><td>" + data.mac + "</td><td>" + data.email + "<button style='margin-right: 2px' class='edit-modal btn btn-info' data-info='" + data.id+","+data.nim+","+data.name+","+data.kelas+","+data.mac+","+data.email+"'><span class='fa fa-pencil-square-o'></span></button><button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.nim+","+data.name+","+data.kelas+","+data.mac+","+data.email+"'><span class='fa fa-trash-o'></span></button></td></tr>");
            }
        });
    });

     $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[2]);
        $('#myModal').modal('show');
    });
    
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '{{ route('admin.manage.mahasiswa.delete') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
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
