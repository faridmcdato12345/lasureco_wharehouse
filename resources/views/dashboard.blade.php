@extends('layouts.adminlte')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
        <div class="col-lg-12">
            <div class="row input-daterange p-3">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                    
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                </div>
            </div>
            <table class="table table-bordered data-table" id="order_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>VOUCHER CODE</th>
                        <th>REQUESTED AT</th>
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
            <h4 class="modal-title" id="modelHeading">ITEMS</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table-bordered modal-table" style="width:100%;text-align:center;">
                    <thead>
                        <th>MATERIAL CODE</th>
                        <th>MATERIAL DESCRIPTION</th>
                        <th>QUANTITY</th>
                    </thead>
                    <tbody></tbody>
                </table>
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
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });
        load_data();
        function load_data(from_date = '', to_date = ''){
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{ route('dashboard.index') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'voucher_code', name: 'vouche_code'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: true},
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('myRow');
                },
                    columnDefs: [{
                    targets: 1,
                    className:'myColumn'
                }]
            });
        }
        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                $('#order_table').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Both Date is required');
            }
        });
        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#order_table').DataTable().destroy();
            load_data();
        });
        $("body").on('click','.viewVoucher',function(){
            $('.modal-table tbody').empty()
            var voucher_code = $(this).closest("tr").find(".myColumn").text();     
            let url = "{{route('get.allvoucher',':voucher_code')}}"
            url = url.replace(':voucher_code',voucher_code)
            $.get(url, function (data) {
                $.each(data, function(key,value){
                    let html = '<tr>'+
                                    '<td>'+value['code_number']+'</td>'+
                                    '<td>'+value['name']+'</td>'+
                                    '<td>'+value['pivot']['quantity']+'</td>'+
                                +'</tr>'    
                    $('.modal-table tbody').append(html)
                })
            })
            $('#ajaxModal').modal('show');
        });
        $("body").on('click','.printVoucher',function(){
            let voucher_code = $(this).closest("tr").find(".myColumn").text();
            let twoLetters = voucher_code.slice(0,2)
            let url = "{{url('/voucher/sitio/print/:id/:voucherCode')}}";
            console.log(voucher_code);
            $.ajax({
                type:'POST',
                url: "{{route('material.getVoucher')}}",
                dataType: 'json',
                data:{voucher_code: voucher_code},
                success: function(data){
                    switch(data.voucher_id){
                    case "1":
                        let maVoucer = "{{url('voucher/maintenance/print/:id/:voucherCode')}}"
                        maVoucer = maVoucer.replace(":id",1);
                        maVoucer = maVoucer.replace(':voucherCode',voucher_code)
                        window.open(maVoucer,"_self")
                        break;
                    case "2":
                        let blVoucer = "{{url('voucher/blanket/print/:id/:voucherCode')}}"
                        blVoucer = blVoucer.replace(":id",2);
                        blVoucer = blVoucer.replace(':voucherCode',voucher_code)
                        window.open(blVoucer,"_self")
                        break;
                    case "3":
                        let meVoucher = "{{url('voucher/metering/print/:id/:voucherCode')}}"
                        meVoucher = meVoucher.replace(":id",3);
                        meVoucher = meVoucher.replace(':voucherCode',voucher_code)
                        window.open(meVoucher,"_self")
                        break;
                    case "4":
                        let siVoucher = "{{url('voucher/sitio/print/:id/:voucherCode')}}"
                        siVoucher = siVoucher.replace(":id",4);
                        siVoucher = siVoucher.replace(':voucherCode',voucher_code)
                        window.open(siVoucher,"_self")
                        break;
                    case "5":
                        let prVoucher = "{{url('voucher/project/print/:id/:voucherCode')}}"
                        prVoucher = prVoucher.replace(":id",5);
                        prVoucher = prVoucher.replace(':voucherCode',voucher_code)
                        window.open(prVoucher,"_self")
                        break;
                    }
                },
                error:function(data){
                    switch(data.voucher_id){
                    case "1":
                        let maVoucer = "{{url('voucher/maintenance/print/:id/:voucherCode')}}"
                        maVoucer = maVoucer.replace(":id",1);
                        maVoucer = maVoucer.replace(':voucherCode',voucher_code)
                        window.open(maVoucer,"_self")
                        break;
                    case "2":
                        let blVoucer = "{{url('voucher/blanket/print/:id/:voucherCode')}}"
                        blVoucer = blVoucer.replace(":id",2);
                        blVoucer = blVoucer.replace(':voucherCode',voucher_code)
                        window.open(blVoucer,"_self")
                        break;
                    case "3":
                        let meVoucher = "{{url('voucher/metering/print/:id/:voucherCode')}}"
                        meVoucher = meVoucher.replace(":id",3);
                        meVoucher = meVoucher.replace(':voucherCode',voucher_code)
                        window.open(meVoucher,"_self")
                        break;
                    case "4":
                        let siVoucher = "{{url('voucher/sitio/print/:id/:voucherCode')}}"
                        siVoucher = siVoucher.replace(":id",4);
                        siVoucher = siVoucher.replace(':voucherCode',voucher_code)
                        window.open(siVoucher,"_self")
                        break;
                    case "5":
                        let prVoucher = "{{url('voucher/project/print/:id/:voucherCode')}}"
                        prVoucher = prVoucher.replace(":id",5);
                        prVoucher = prVoucher.replace(':voucherCode',voucher_code)
                        window.open(prVoucher,"_self")
                        break;
                    }
                }
            });
        })
    });
</script>
@endsection
