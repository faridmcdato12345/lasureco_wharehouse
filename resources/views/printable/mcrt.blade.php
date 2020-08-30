@extends('layouts.print')
@section('content')
<div style="padding-top:10%;text-align:center;"><h1 style="font-size:16px;font-weight:bolder">MATERIAL CREDIT TICKET</h1></div>
<div class="row p-2">
    <div class="col-md-4">
       
    </div>
    <div class="col-md-4 p-0">
        <div style="text-align: center;"><h2 style="font-weight:bolder;font-size:24px;"></h2></div>
    </div>
    <div class="col-md-4" style="text-align: right;display:inline-block;">
        <label for="voucher_code_label" class="control-label voucher_code_label">MCRT No.:&nbsp;&nbsp;&nbsp;</label>
        <span class="voucher_code" style="display: inline-block;width:50%;text-align:center">{{$mcrt_Number}}</span>
    </div>
</div>
<div class="row">
    <div class="col-md-4 div-4" style="display: inline-block;">
        <label for="voucher_code_label" class="control-label voucher_code_label">MCT No.:&nbsp;&nbsp;&nbsp;</label>
        <span class="voucher_code" style="display: inline-block;width:50%;">{{$mctNumber}}</span>
    </div>
    <div class="col-md-4 div-4">
    </div>
    <div class="col-md-4" style="text-align: right;display:inline-block;">
        <label for="voucher_code_label" class="control-label voucher_code_label">Date:&nbsp;&nbsp;&nbsp;</label>
        <span class="voucher_date" style="display: inline-block;width:50%;text-align:center">{{$createdAt}}</span>
    </div>
</div>
<div class="row pt-4">
    <div class="col-md-12" style="display:inline-block;">
        <label for="voucher_code_label" class="control-label">Place of Construction : </label>
        <span class="voucher_place" style="display:inline-block;width:80%;text-align:left;">{{$placeOfConstruction}}</span>
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
                <td>{{$material->material->code_number}}</td>
                <td>{{$material->material->name}}</td>
                <td>{{$material->quantity}}</td>
                <td>{{$material->material->unit}}</td>
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
<div class="row order-number-div" style="text-align: right">
    <div class="col-md-4">
        <div>
            <label for="wono">W.O. No. :</label>
            @if($orderType == 1)
            <span class="voucher_code underline">{{$orderNumber}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
            
        </div>
        <div>
            <label for="wono">C.W.O No. :</label>
            @if($orderType == 2)
            <span class="voucher_code underline">{{$orderNumber}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div>
            <label for="wono">Job Order No. :</label>
            @if($orderType == 4)
            <span class="voucher_code underline">{{$orderNumber}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
        </div>
        <div>
            <label for="wono">B.W.O. No. :</label>
            @if($orderType == 3)
            <span class="voucher_code underline">{{$orderNumber}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
            
        </div>
    </div>
    <div class="col-md-4">
        <div>
            <label for="wono">Main. Order No. :</label>
            @if($orderType == 5)
            <span class="voucher_code underline">{{$orderNumber}}</span>
            @else
            <span><hr class="horizontal"></span>
            @endif
            
        </div>
    </div>
</div>
<div class="container p-5">
    <div class="row">
        <div class="col-md-6" style="display: inline-block;">
            <label for="issued-by">Received By: &nbsp;&nbsp;&nbsp;</label>
            <span class="underline">{{$receivedBy}}</span>
        </div>
        <div class="col-md-6" style="display: inline-block">
            <label for="received-by">Returned By: &nbsp;&nbsp;&nbsp;</label>
            <span class="underline">{{$returnedBy}}</span>
        </div>
    </div>
</div>
@endsection