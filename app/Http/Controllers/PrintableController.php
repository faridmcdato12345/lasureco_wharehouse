<?php

namespace App\Http\Controllers;

use App\Voucher;
use Carbon\Carbon;
use App\Material_Credit;
use Illuminate\Http\Request;
use App\Material_Credit_Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PrintableController extends Controller
{
    public function maintenance($id,$voucher_code){
        $vouchers = Voucher::findOrFail($id);
        $materials = $vouchers->materials()->where('voucher_code','=',$voucher_code)->get();
        $materialVoucher = '';
        $placeOfConstruction = '';
        $date = '';
        $descriptionOfWork = '';
        $requestedBy = '';
        $mctNumber = '';
        $issued_by = '';
        $received_by = '';
        $order_type = '';
        $order_number = '';
        foreach($materials as $material){
            $materialVoucher = $material->pivot->voucher_code;
            $placeOfConstruction = $material->pivot->place_of_const;
            $date = Carbon::parse($material->pivot->created_at)->format('M d Y');
            $descriptionOfWork = $material->pivot->description_of_work;
            $requestedBy = $material->pivot->requested_by;
            $mctNumber = $material->pivot->mct_number;
            $issued_by = $material->pivot->issued_by;
            $received_by = $material->pivot->received_by;
            $order_type = $material->pivot->order_type;
            $order_number = $material->pivot->order_number;
        }
        return view('printable.maintenance',compact('materials','materialVoucher','placeOfConstruction','date','descriptionOfWork','requestedBy','mctNumber','issued_by','received_by','order_type','order_number'));
    }
    public function metering($id,$voucher_code){
        $vouchers = Voucher::findOrFail($id);
        $materials = $vouchers->materials()->where('voucher_code','=',$voucher_code)->get();
        $materialVoucher = '';
        $placeOfConstruction = '';
        $date = '';
        $descriptionOfWork = '';
        $requestedBy = '';
        $mctNumber = '';
        $issued_by = '';
        $received_by = '';
        $order_type = '';
        $order_number = '';
        foreach($materials as $material){
            $materialVoucher = $material->pivot->voucher_code;
            $placeOfConstruction = $material->pivot->place_of_const;
            $date = Carbon::parse($material->pivot->created_at)->format('M d Y');
            $descriptionOfWork = $material->pivot->description_of_work;
            $requestedBy = $material->pivot->requested_by;
            $mctNumber = $material->pivot->mct_number;
            $issued_by = $material->pivot->issued_by;
            $received_by = $material->pivot->received_by;
            $order_type = $material->pivot->order_type;
            $order_number = $material->pivot->order_number;
        }
        return view('printable.metering',compact('materials','materialVoucher','placeOfConstruction','date','descriptionOfWork','requestedBy','mctNumber','issued_by','received_by','order_type','order_number'));
    }
    public function blanket($id,$voucher_code){
        $vouchers = Voucher::findOrFail($id);
        $materials = $vouchers->materials()->where('voucher_code','=',$voucher_code)->get();
        $materialVoucher = '';
        $placeOfConstruction = '';
        $date = '';
        $descriptionOfWork = '';
        $requestedBy = '';
        $mctNumber = '';
        $issued_by = '';
        $received_by = '';
        $order_type = '';
        $order_number = '';
        foreach($materials as $material){
            $materialVoucher = $material->pivot->voucher_code;
            $placeOfConstruction = $material->pivot->place_of_const;
            $date = Carbon::parse($material->pivot->created_at)->format('M d Y');
            $descriptionOfWork = $material->pivot->description_of_work;
            $requestedBy = $material->pivot->requested_by;
            $mctNumber = $material->pivot->mct_number;
            $issued_by = $material->pivot->issued_by;
            $received_by = $material->pivot->received_by;
            $order_type = $material->pivot->order_type;
            $order_number = $material->pivot->order_number;
        }
        return view('printable.blanket',compact('materials','materialVoucher','placeOfConstruction','date','descriptionOfWork','requestedBy','mctNumber','issued_by','received_by','order_type','order_number'));
    }
    public function project($id,$voucher_code){
        $vouchers = Voucher::findOrFail($id);
        $materials = $vouchers->materials()->where('voucher_code','=',$voucher_code)->get();
        $materialVoucher = '';
        $placeOfConstruction = '';
        $date = '';
        $descriptionOfWork = '';
        $requestedBy = '';
        $mctNumber = '';
        $issued_by = '';
        $received_by = '';
        $order_type = '';
        $order_number = '';
        foreach($materials as $material){
            $materialVoucher = $material->pivot->voucher_code;
            $placeOfConstruction = $material->pivot->place_of_const;
            $date = Carbon::parse($material->pivot->created_at)->format('M d Y');
            $descriptionOfWork = $material->pivot->description_of_work;
            $requestedBy = $material->pivot->requested_by;
            $mctNumber = $material->pivot->mct_number;
            $issued_by = $material->pivot->issued_by;
            $received_by = $material->pivot->received_by;
            $order_type = $material->pivot->order_type;
            $order_number = $material->pivot->order_number;
        }
        return view('printable.project',compact('materials','materialVoucher','placeOfConstruction','date','descriptionOfWork','requestedBy','mctNumber','issued_by','received_by','order_type','order_number'));
    }
    public function sitio($id,$voucher_code){
        $vouchers = Voucher::findOrFail($id);
        $materials = $vouchers->materials()->where('voucher_code','=',$voucher_code)->get();
        $materialVoucher = '';
        $placeOfConstruction = '';
        $date = '';
        $descriptionOfWork = '';
        $requestedBy = '';
        $mctNumber = '';
        $issued_by = '';
        $received_by = '';
        $order_type = '';
        $order_number = '';
        foreach($materials as $material){
            $materialVoucher = $material->pivot->voucher_code;
            $placeOfConstruction = $material->pivot->place_of_const;
            $date = Carbon::parse($material->pivot->created_at)->format('M d Y');
            $descriptionOfWork = $material->pivot->description_of_work;
            $requestedBy = $material->pivot->requested_by;
            $mctNumber = $material->pivot->mct_number;
            $issued_by = $material->pivot->issued_by;
            $received_by = $material->pivot->received_by;
            $order_type = $material->pivot->order_type;
            $order_number = $material->pivot->order_number;
        }
        return view('printable.sitio',compact('materials','materialVoucher','placeOfConstruction','date','descriptionOfWork','requestedBy','mctNumber','issued_by','received_by','order_type','order_number'));
    }
    public function mcrt($mcrtNumber){
        $mcrtNumber = Material_Credit::latest()->first()->mcrt_number;
        // $this->mcrtPrint($mcrtNumber);
        $materials = Material_Credit::where('mcrt_number',$mcrtNumber)->get();
        $mcrtDetail = Material_Credit_Ticket::where('mcrt_number',$mcrtNumber)->first();
        $mcrt_Number = $mcrtDetail->mcrt_number;
        $mctNumber = $mcrtDetail->mct_number;
        $placeOfConstruction = $mcrtDetail->place_of_const;
        $descriptionOfWork = $mcrtDetail->description_of_work;
        $orderType = $mcrtDetail->order_type;
        $orderNumber = $mcrtDetail->order_number;
        $returnedBy = $mcrtDetail->returned_by;
        $receivedBy = $mcrtDetail->received_by;
        $createdAt = $mcrtDetail->created_at;
        return view('printable.mcrt',compact('materials','createdAt','mcrt_Number','mctNumber','placeOfConstruction','descriptionOfWork','orderType','orderNumber','returnedBy','receivedBy'));
    }
}
