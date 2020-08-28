@extends('layouts.adminlte')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Inventory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inventory</a></li>
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
            <div class="col-lg-12">
                <table class="table table-bordered data-table dt-print-table" id="order_table">
                    <thead>
                        <tr>
                            <th>CODE NUMBER</th>
                            <th>MATERIAL DESCRIPTION</th>
                            <th>TOTAL RECEIVED</th>
                            <th>TOTAL RELEASED</th>
                            <th>TOTAL QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
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
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'print',
                    autoPrint: true,
                    title: '',
                    //For repeating heading.
                    repeatingHead: {
                        logo: '{{asset("images/logo.gif")}}',
                        logoPosition: '0',
                        logoStyle: '',
                        title: '<h3>INVENTORY</h3>',
                        dateFrom: from_date,
                        dateTo:to_date,
                    }
                }],
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{ route('material.inventory') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {data: 'material_id', name: 'material_id'},
                    {data: 'material_name', name: 'material_name'},
                    {data: 'total_received', name: 'total_received'},
                    {data: 'total_released', name: 'total_released'},
                    {data: 'total_quantity', name: 'total_quantity'},
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
    });
</script>
@endsection
