@extends('layouts.adminlte')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Import File</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Import</li>
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
        @if(Session::has('imported_material'))
        <p class="bg-primary succes-alert" style="font-weight: bold;font-size: 16px;padding: 10px 10px;">{{session('imported_material')}}</p>
        @endif
        <form method="post" action="{{route('import.store')}}" id="importMaterial" name="importMaterial" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="control-label">Select a file:</label>
                <div class="col-sm-offset-2">
                    <input type="file" id="myfile" name="myfile" class="form-control">
                </div>
            </div>
            <div class="col-sm-offset-2 form-group">
                <button type="submit" class="btn btn-success form-control importMaterialSave" id="importMaterialSave">Save
                </button>
            </div>
        </form>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection
@section('script')
@endsection