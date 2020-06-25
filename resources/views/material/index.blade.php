@extends('layouts.adminlte')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Material Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Material Page</li>
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
        <div class="col-lg-12">
            <button class="btn btn-primary addMaterial" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add</button>
        </div>
        <!-- /.col-md-12 -->
        <div class="col-lg-12">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
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
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modelHeading">ADD MATERIAL</h4>
        </div>
        <div class="modal-body">
            <form id="materialAdd" name="materialAdd" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="control-label">Item Code Number</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="code_number" name="code_number" placeholder="Enter Material Name" value="" readonly maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Material Name" value="" maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label">Quantity</label>
                    <div class="col-sm-offset-2">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="" maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="unit" class="control-label">Unit</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter Unit" value="" maxlength="50" required="">
                    </div>
                </div>
                
                <div class="col-sm-offset-2 form-group">
                    <button type="submit" class="btn btn-success form-control" id="saveMaterial" value="create">Save
                    </button>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger form-control" data-dismiss="modal">Close
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>
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
            ajax: "{{ route('material.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'created_at', name: 'created at'},
                {data: 'updated_at', name: 'updated at'},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ]
        });
        let getDate = new Date();
        let generateCodeNumber = "" + getDate.getFullYear() + (getDate.getMonth()+1) + getDate.getDate() + getDate.getHours() + getDate.getMinutes() + getDate.getSeconds();
        $('#code_number').val(generateCodeNumber)
        $('#saveMaterial').click(function (e) {
            e.preventDefault();
            $(this).html('Saving...');
            $.ajax({
                data: $('#materialAdd').serialize(),
                url: "{{ route('material.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#saveMaterial').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $(this).prev().click();
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#ajaxModal').modal('hide');
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
    });
</script>
@endsection
