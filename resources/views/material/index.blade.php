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
        <div class="col-lg-12 mb-2">
            <div class="col-sm-6 p-0">
                <div class="col-sm-6 p-0">
                    <button style="display: inline-block;" class="btn btn-primary addMaterial" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add New</button>
                </div>
            </div>
        </div>
        <!-- /.col-md-12 -->
        <div class="col-lg-12">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CODE NUMBER</th>
                        <th>NAME</th>
                        <th>QUANTITY</th>
                        <th>UNIT</th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
                        <th width="280px">ACTION</th>
                    </tr>
                </thead>
                <tbody id="materialBody">
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
            <h4 class="modal-title" id="modelHeading">ADD MATERIAL</h4>
        </div>
        <div class="modal-body">
            <form id="materialAdd" name="materialAdd" class="form-horizontal">
                <input type="hidden" name="material_id" id="material_id">
                <div class="form-group">
                    <label for="name" class="control-label">Item Code Number</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="code_number" name="code_number" placeholder="Enter Material Code" value="" maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Material Name" value="" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label">Quantity</label>
                    <div class="col-sm-offset-2">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="unit" class="control-label">Unit</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter Unit" value="" maxlength="50">
                    </div>
                </div>
                <div class="col-sm-offset-2 form-group">
                    <button type="submit" class="btn btn-success form-control submitBttn" id="saveMaterial" value="create">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('addMaterial')
<div class="modal fade" id="addMaterial" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#343a40;color:#ffffff;">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">ADD MATERIAL QUANTITY</h4>
            </div>
            <div class="modal-body">
                <form id="materialAdd" name="materialAdd" class="form-horizontal">
                    <input type="hidden" name="material_id" id="material_id">
                    <div class="form-group">
                        <label for="quantity" class="control-label">Quantity</label>
                        <div class="col-sm-offset-2">
                            <input type="number" class="form-control update_quantity" id="update_quantity" name="update_quantity" placeholder="Enter Quantity" required>
                        </div>
                    </div>
                    {{-- <div class="col-sm-offset-2 form-group">
                        <button type="submit" class="btn btn-success form-control updateQuantityMaterial" id="updateQuantityMaterial" value="create">Update
                        </button>
                    </div> --}}
                </form>
                <div class="col-sm-offset-2 form-group">
                    <button type="submit" class="btn btn-success form-control updateQuantityMaterial" id="updateQuantityMaterial" value="">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
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
                {data: 'code_number', name: 'code_number'},
                {data: 'name', name: 'name'},
                {data: 'quantity', name: 'quantity'},
                {data: 'unit', name: 'unit'},
                {data: 'created_at', name: 'created at'},
                {data: 'updated_at', name: 'updated at'},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ]
        });
        let id_num;
        $('body').on('click','.addQuantityMaterial',function(e){
            e.preventDefault();
            let curr_row = $(this).closest('tr');
            id_num = curr_row.find('td:eq(0)').text();
            $('#addMaterial').modal('show');
        });
        $("body").on('click', '.updateQuantityMaterial', function(e){
            let domQuantity = $('#update_quantity').val()
            let urlUpdate = "{{route('material.receive.update',':id')}}";
            urlUpdate = urlUpdate.replace(':id',id_num);
            e.preventDefault();
            $.ajax({
                data: {
                    quantity: domQuantity,
                },
                url: urlUpdate,
                type: "PATCH",
                dataType: 'json',
                success: function (data) {
                    $('#materialAdd').trigger("reset");
                    $('#addMaterial').modal('hide');
                    $('#update_quantity').val('');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#updateBtn').html('User Updated');
                }
            });
        });
        // saving data using ajax post
        $('body').on('click','#saveMaterial',function (e) {
            e.preventDefault();
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
                    $('#materialAdd').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $('#saveBtn').html('Save Changes');
                    table.draw();
                    
                }
            });
        });
        // show edit modal form
        $('body').on('click','.editMaterial',function () {
            let material_id = $(this).data('id');
            $('#materialAdd').trigger("reset");
            $.get("{{ route('material.index') }}" +'/' + material_id +'/edit', function (data) {
                let materialName = data.name
                $('#modelHeading').html("Edit " + "<strong>" + materialName.toUpperCase() + "</strong>");
                $('#saveMaterial').html("Update");
                $(".submitBttn").attr('id','updateMaterialButton')
                $('#code_number').val(data.code_number);
                $('#name').val(data.name);
                $('#quantity').val(data.quantity);
                $('#unit').val(data.unit);
                $('#material_id').val(data.id);
                $('#ajaxModal').modal('show');
            })
        });
        //update the material
        $('body').on('click','#updateMaterialButton',function (e) {
            let urlUpdate = "{{route('material.update',':id')}}";
            urlUpdate = urlUpdate.replace(':id',$('#material_id').val());
            // e.preventDefault();
            $.ajax({
                data: $('#materialAdd').serialize(),
                url: urlUpdate,
                type: "PATCH",
                dataType: 'json',
                success: function (data) {
                    $('#materialAdd').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    $('#updateMaterialButton').html("Save");
                    $(".submitBttn").attr('id','saveMaterial')
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#updateBtn').html('User Updated');
                }
            });
        });
        //delete material
        $('body').on('click', '.deleteMaterial', function () {
        var material_id = $(this).data("id");
        var material_name = $(this).data("name");
        var url_destroy = "{{route('material.destroy',':id')}}";
        url_destroy = url_destroy.replace(':id',material_id);
        if (confirm("Are you sure want to delete this material?") == true) {
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
    });
</script>
@endsection