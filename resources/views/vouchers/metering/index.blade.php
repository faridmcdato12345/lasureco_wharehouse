@extends('layouts.adminlte')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Metering Voucher</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Voucher</li>
            <li class="breadcrumb-item active">Metering</li>
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
        <!-- /.col-md-12 -->
        <div class="col-lg-7">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CODE NUMBER</th>
                        <th>NAME</th>
                        <th>QUANTITY</th>
                        <th>UNIT</th>
                        <th width="280px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="col-lg-5 cart">
            <div class="voucher-div">
                <div class="voucher-list" id="voucher-list">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CODE NUMBER</th>
                                <th>NAME</th>
                                <th>REQUESTED QUANTITY</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="voucherRequest">

                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Voucher Number:</label>
                        <div class="col-sm-offset-2">
                            <input type="text" readonly class="form-control" id="voucher_number" name="voucher_number" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">MCT Number:</label>
                        <div class="col-sm-offset-2">
                            <input type="text" readonly class="form-control" id="mct_number" name="mct_number" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Place of Construction:</label>
                        <div class="col-sm-offset-2">
                            <input type="text" readonly class="form-control" id="place_of_construction" name="place_of_construction" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Description of Work:</label>
                        <div class="col-sm-offset-2">
                            <input type="text" readonly class="form-control" id="description_of_work" name="description_of_work" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Order Number: </label>
                        <div class="col-sm-offset-2">
                            <select name="orders" id="orders" class="form-control" >
                                <option >Select Option</option>
                                <option value="1">W.O</option>
                                <option value="2">C.W.O</option>
                                <option value="3">B.W.O</option>
                                <option value="4">Job Order</option>
                                <option value="5">Main Order</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="display:none;" id="order-number">
                        <label for="quantity" class="control-label">Enter the Order Number:</label>
                        <div class="col-sm-offset-2">
                            <input type="text" class="form-control" id="order_number" name="order_number" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issued_by" class="control-label">Issued By:</label>
                        <div class="col-sm-offset-2">
                        <input type="text" readonly class="form-control" id="issued_by" name="issued_by" value="{{Auth::user()->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="received_by" class="control-label">Received By:</label>
                        <div class="col-sm-offset-2">
                        <input type="text" readonly class="form-control" id="received_by" name="received_by" value="" required>
                        </div>
                    </div>
                    {{-- <form action="" method="post">
                        <button type="submit" class="btn btn-primary form-control saveToMetering">SAVE</button>
                    </form> --}}
                    <button class="btn btn-primary form-control saveToMetering">SAVE & PRINT</button>
                </div>
            </div>
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
            <form id="materialRequest" name="materialRequest" class="form-horizontal">
                <input type="hidden" name="material_id" id="material_id">
                <div class="form-group">
                    <label for="name" class="control-label">Item Code Number</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="code_number" name="code_number" placeholder="Enter Material Name" value="" readonly maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Material Name" value="" maxlength="50" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label">Quantity</label>
                    <div class="col-sm-offset-2">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="" maxlength="50" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label"> Requested Quantity</label>
                    <div class="col-sm-offset-2">
                        <input type="number" class="form-control" autofocus id="req_quantity" name="req_quantity" placeholder="Enter Requested Quantity" value="" maxlength="50" required>
                    </div>
                </div>
                <div class="col-sm-offset-2 form-group">
                    <button type="submit" class="btn btn-success form-control submitBttn" id="saveMaterial" value="create">Save
                    </button>
                </div>
            </form>
            <button class="btn btn-primary form-control saveToVoucher" style="display:none;">Add to Voucher</button>
        </div>
    </div>
</div>

@endsection
@section('script')
<!----script--->
<script>
    $(document).ready(function() {
        $('#orders').on('change',function(){
            $('#order-number').css('display','block')
        })
        generateVoucherCode()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function generateVoucherCode(){
            let theDate = new Date()
            let voucherCode = "" + theDate.getFullYear()+(theDate.getMonth() + 1)+theDate.getDate()+theDate.getHours()+theDate.getMinutes()+theDate.getSeconds()
            $('.voucher-number').html('ME-'+ voucherCode)
        }
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('metering.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'code_number', name: 'code_number'},
                {data: 'name', name: 'name'},
                {data: 'quantity', name: 'quantity'},
                {data: 'unit', name: 'unit'},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ]
        });
        // show edit modal form
        $('body').on('click','.addToMeteringVoucher',function () {
            let material_id = $(this).data('id');
            
            $('#materialAdd').trigger("reset");
            $.get("{{ route('material.index') }}" +'/' + material_id +'/edit', function (data) {
                let materialName = data.name
                $('#modelHeading').html("<strong>REQUEST FORM</strong>");
                $('#saveMaterial').html("Save");
                // $(".submitBttn").attr('id','saveRequestedMaterial')
                $(".submitBttn").css('display','none')
                $(".saveToVoucher").css('display','block')
                $('#code_number').val(data.code_number);
                $('#name').val(data.name);
                $('#quantity').val(data.quantity);
                $('#unit').val(data.unit);
                $('#material_id').val(data.id);
                $('#ajaxModal').modal('show');
            })
        });
        //update the material
        $('body').on('click','.saveToVoucher',function (e) {
            let urlUpdate = "{{route('metering.update',':id')}}";
            urlUpdate = urlUpdate.replace(':id',$('#material_id').val());
            let req_quantity = $('#req_quantity').val()
            let rem_quantity = $('#quantity').val();
            if(parseInt(req_quantity) > parseInt(rem_quantity)){
                alert('Requested quantity is greater than remaining quantity!')
            }
            // e.preventDefault();
            else{
                $.ajax({
                    data: $('#materialRequest').serialize(),
                    url: urlUpdate,
                    type: "PATCH",
                    dataType: 'json',
                    success: function (data) {
                        
                        $('#ajaxModal').modal('hide');
                        $('#updateMaterialButton').html("Save");
                        $(".submitBttn").attr('id','saveMaterial')
                        $("#place_of_construction").attr("readonly",false)
                        $("#description_of_work").attr("readonly",false)
                        $("#requested_by").attr("readonly",false)
                        $("#voucher_number").attr("readonly",false)
                        $("#mct_number").attr("readonly",false)
                        $("#received_by").attr("readonly",false)
                        $('#order_number').attr("readonly",false)
                        $('#voucher-list table tbody').append('<tr class="item">'+'<td hidden>'+$('#material_id').val()+'</td>'+'<td>'+$('#code_number').val()+'</td>'+'<td>'+$('#name').val()+'</td>'+'<td>'+$('#req_quantity').val()+'</td>'+'<td><button class="btn minus_request col-md-6"><i class="fa fa-minus" style="color:blue;"></i></button><button class="col-md-6 btn delete_request"><i class="fa fa-times" style="color:red;"></i></button></td>'+'</tr>')
                        
                        $('#materialRequest').trigger("reset");
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#updateBtn').html('User Updated');
                    }
                });   
            } 
        });
        //select and delete request quantity on certain table row
        $("#voucherRequest").on('click', '.delete_request', function(){
            let curr_row = $(this).closest('tr');
            let id_num = curr_row.find('td:eq(0)').text();
            let req_quan = parseInt(curr_row.find('td:eq(3)').text());
            undoTheQuantity(id_num,req_quan)
            $(this).closest('tr').remove();
        });
        //select and return specific quantity on a certain table row
        $('#voucherRequest').on('click','.minus_request', function(){
            let curr_row = $(this).closest('tr');
            let id_num = curr_row.find('td:eq(0)').text();
            let req_quan = parseInt(curr_row.find('td:eq(3)').text());
            let subs = req_quan - 1;
            curr_row.find('td:eq(3)').text(subs)
            subtractQuantity(id_num)
            if(req_quan == 1){
                $(this).closest('tr').remove();
            }
        });
        //save to Metering database
        $('body').on('click','.saveToMetering',function(){
            generateVoucherCode()
            let productid = '';
            let quantity = 0;
            let voucherNo = $('#voucher_number').val();
            let voucher_id = 3;
            let place = $('#place_of_construction').val();
            let description_of_work = $('#description_of_work').val();
            let mctNo = $('#mct_number').val();
            let issued_by = $('#issued_by').val();
            let received_by = $('#received_by').val();
            let order_number = $("#order_number").val();
            let order_type = $("#orders").val();
            sendToAllVouchers(voucherNo,voucher_id)
            $("tr.item").each(function() {
                productid = $(this).find("td:eq(0)").text();
                quantity = $(this).find("td:eq(3)").text();
                sendToMeteringDb(voucher_id,productid,voucherNo,quantity,place,description_of_work,mctNo,issued_by,received_by,order_number,order_type)
                materialReleased(productid,quantity)
            });
        })
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
        //function to return the requested quantity
        function undoTheQuantity(id,req){
            let urlUpdate = "{{route('metering.undo_material',':id')}}";
            urlUpdate = urlUpdate.replace(':id',id);
            $.ajax({
                data: {
                    return_quant: req,
                },
                url: urlUpdate,
                type: "PATCH",
                dataType: 'json',
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                }
            }); 
        }
        //function to subtract the requested quantity
        function subtractQuantity(id){
            let urlUpdate = "{{route('metering.subtract_material',':id')}}";
            urlUpdate = urlUpdate.replace(':id',id);
            $.ajax({
                data: {
                    return_quant: 1,
                },
                url: urlUpdate,
                type: "PATCH",
                dataType: 'json',
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                }
            }); 
        }
        function sendToMeteringDb(voucher_id,material_id,request_voucher,quantity,place,description_of_work,mct_number,issued_by,received_by,order_number,order_type){
            let id = voucher_id
            let code = request_voucher
            let url = "{{url('/voucher/metering/print/3/:voucherCode')}}";
            url = url.replace(":voucherCode",code);
            $.ajax({
                data: {
                    voucher_id: voucher_id,
                    material_id: material_id,
                    request_voucher_no: request_voucher,
                    quantity: quantity,
                    place_of_const:  place,
                    description_of_work: description_of_work,
                    mct_number:mct_number,
                    issued_by:issued_by,
                    received_by:received_by,
                    order_number:order_number,
                    order_type:order_type,
                },
                url: "{{ route('metering.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    console.log("success")
                },
                error: function (data) {
                    console.log("error")
                    window.open(url,"_self")
                    table.draw();
                    
                }
            });
        }
        function materialReleased(material_id,released_quantity){
            let domQuantity = released_quantity
            let urlUpdate = "{{route('material.release.update',':id')}}";
            urlUpdate = urlUpdate.replace(':id',material_id);
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
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#updateBtn').html('User Updated');
                }
            });
        }
        function sendToAllVouchers(voucherNo,voucher_id){
            $.ajax({
                data: {
                    request_voucher_no: voucherNo,
                    voucher_id:voucher_id
                },
                url: "{{ route('save.allvoucher') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                },
                error: function (data) {
                }
            });
        }
    });
</script>
@endsection
