@extends('layouts.print')
@section('content')
<div style="padding-top:10%;text-align:center;"><h1 style="font-size:16px;font-weight:bolder">MATERIAL CHARGE TICKET</h1></div>
<div class="row p-2">
    <div class="col-md-4">
       
    </div>
    <div class="col-md-4 p-0">
        <div style="text-align: center;"><h2 style="font-weight:bolder;font-size:24px;">SITIO</h2></div>
    </div>
    <div class="col-md-4" style="text-align: right;display:inline-block;">
        <label for="voucher_code_label" class="control-label voucher_code_label">MCT No.:&nbsp;&nbsp;&nbsp;</label>
        <span class="voucher_code" style="display: inline-block;width:50%;text-align:center">{{$mctNumber}}</span>
    </div>
</div>
<div class="row">
    <div class="col-md-4 div-4" style="display: inline-block">
        <label for="voucher_code_label" class="control-label voucher_code_label">RIV No.:&nbsp;&nbsp;&nbsp;</label>
        <span class="voucher_code" style="display: inline-block;width:50%;">{{$materialVoucher}}</span>
    </div>
    <div class="col-md-4 div-4">
    </div>
    <div class="col-md-4" style="text-align: right;display:inline-block;">
        <label for="voucher_code_label" class="control-label voucher_code_label">Date:&nbsp;&nbsp;&nbsp;</label>
        <span class="voucher_date" style="display: inline-block;width:50%;text-align:center;">{{$date}}</span>
    </div>
</div>
<div class="row pt-4">
    <div class="col-md-12" style="display: inline-block">
        <label for="voucher_code_label" class="control-label">Place of Construction : </label>
        <span class="voucher_place" style="display: inline-block;width:85%;text-align:left;">{{$placeOfConstruction}}</span>
    </div>
</div>
<table id="myTable" class="table-bordered table" cellspacing="0" width="100%">
    <thead>
        <tr style="text-align: center">
            <th>ITEM CODE NO</th>
            <th>MATERIAL DESCRIPTION</th>
            <th>QUANTITY</th>
            <th>UNIT</th>
            <th>UNIT COST</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody multiple>
        @foreach ($materials as $material)
            <tr>
                <td>{{$material->code_number}}</td>
                <td>{{$material->name}}</td>
                <td>{{$material->pivot->quantity}}</td>
                <td>{{$material->unit}}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
            <tr>
                <td>
                    <label for="purpose">PURPOSE:</label>
                </td>
                <td>
                    <span>{{$descriptionOfWork}}</span>
                </td>
                <td> 
                   
                </td>
                <td></td>
                <td>
                    <label for="total">TOTAL</label>
                </td>
                <td>
                    <span></span>
                </td>
            </tr>
    </tbody>
</table>
<p>Charge to:</p>
<div class="row" style="text-align: right">
    <div class="col-md-4">
        <div>
            <label for="wono">W.O. No. :</label>
             @if($order_type == 1)
            <span class="voucher_code underline">{{$order_number}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
        <div>
            <label for="wono">C.W.O No. :</label>
             @if($order_type == 2)
            <span class="voucher_code underline">{{$order_number}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div>
            <label for="wono">Job Order No. :</label>
             @if($order_type == 4)
            <span class="voucher_code underline">{{$order_number}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
        <div>
            <label for="wono">B.W.O. No. :</label>
             @if($order_type == 3)
            <span class="voucher_code underline">{{$order_number}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div>
            <label for="wono">Main. Order No. :</label>
             @if($order_type == 5)
            <span class="voucher_code underline">{{$order_number}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
    </div>
</div>
<div class="container p-5">
    <div class="row">
        <div class="col-md-6" style="display: inline-block">
            <label for="issued-by">Issued By: &nbsp;&nbsp;&nbsp;</label>
            <span class="underline">{{$issued_by}}</span>
        </div>
        <div class="col-md-6" style="display: inline-block">
            <label for="received-by">Received By: &nbsp;&nbsp;&nbsp;</label>
            <span class="underline">{{$received_by}}</span>
        </div>
    </div>
</div>
@endsection
