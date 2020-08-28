@extends('layouts.adminlte')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="col-sm-6 p-0">
                <div class="col-sm-3 p-0">
                    <button class="btn btn-primary addUser" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create</button>
                </div>
            </div>
            
        </div>
        <!-- /.col-md-12 -->
        <div class="col-lg-12">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>USERNAME</th>
                        <th>ROLE</th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
                        <th>STATUS</th>
                        <th width="280px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection
@section('modal')
<div class="modal-dialog">
    <div class="modal-content" style="background-color:#343a40;color:#ffffff;">
        <div class="modal-header">
            <h4 class="modal-title" id="modelHeading">ADD User</h4>
        </div>
        <div class="modal-body">
            <form id="UserAdd" name="UserAdd" class="form-horizontal"> 
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                    <div class="col-md-6">
                        <select name="role" id="role" class="form-control">
                            @foreach ($roleType as $role)
                                <option value={{$role->id}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button id="saveUser" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<!----script--->

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'role', name: 'role'},
                {data: 'created_at', name: 'created at'},
                {data: 'updated_at', name: 'updated at'},
                {data: 'status', name: 'status', orderable: false, searchable: true},
                {data: 'actions', name: 'actions', orderable: false, searchable: true},
            ]
        });
        // saving data using ajax post
        $('body').on('click','#saveUser',function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#UserAdd').serialize(),
                url: "{{ route('user.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#saveUser').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $(this).prev().click();
                    table.draw();
                },
                error: function (data) {
                    $('#UserAdd').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $('#saveBtn').html('Save Changes');
                    table.draw();
                    
                }
            });
        });
        // show edit modal form
        $('body').on('click','.editUser',function () {
            let User_id = $(this).data('id');
            $('#UserAdd').trigger("reset");
            $.get("{{ route('user.index') }}" +'/' + User_id +'/edit', function (data) {
                let UserName = data.name
                $('#modelHeading').html("Edit " + "<strong>" + UserName.toUpperCase() + "</strong>");
                $('#saveUser').html("Update");
                $(".submitBttn").attr('id','updateUserButton')
                $('#code_number').val(data.code_number);
                $('#name').val(data.name);
                $('#quantity').val(data.quantity);
                $('#unit').val(data.unit);
                $('#User_id').val(data.id);
                $('#ajaxModal').modal('show');
            })
        });
        //update the User
        $('body').on('click','#updateUserButton',function (e) {
            let urlUpdate = "{{route('user.update',':id')}}";
            urlUpdate = urlUpdate.replace(':id',$('#User_id').val());
            // e.preventDefault();
            $.ajax({
                data: $('#UserAdd').serialize(),
                url: urlUpdate,
                type: "PATCH",
                dataType: 'json',
                success: function (data) {
                    $('#UserAdd').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $('#updateUserButton').html("Save");
                    $(".submitBttn").attr('id','saveUser')
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#updateBtn').html('User Updated');
                }
            });
        });
        //delete User
    $('body').on('click', '.deleteUser', function () {
        var User_id = $(this).data("id");
        var User_name = $(this).data("name");
        var url_destroy = "{{route('user.destroy',':id')}}";
        url_destroy = url_destroy.replace(':id',User_id);
        if (confirm("Are you sure want to delete this User?") == true) {
            $.ajax({
                type: "DELETE",
                url: url_destroy,
                dataType: 'json',
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        } 
      }); 

      $('body').on('click','.userActive',function () {
        var u = $(this).data('id');
        var urlUpdate = "{{route('user.active',':id')}}";
        urlUpdate = urlUpdate.replace(':id',u);
        $(this).html('Updating..');
        $.ajax({
            url: urlUpdate,
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#updateBtn').html('User Updated');
            }
        });
      });
      $('body').on('click','.userInActive',function () {
        var u = $(this).data('id');
        var urlUpdate = "{{route('user.inactive',':id')}}";
        urlUpdate = urlUpdate.replace(':id',u);
        $(this).html('Updating..');
    
            $.ajax({
            url: urlUpdate,
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                table.draw();
            
            },
            error: function (data) {
                console.log('Error:', data);
                $('#updateBtn').html('User Updated');
            }
        });
      });
    });
</script>
@endsection
