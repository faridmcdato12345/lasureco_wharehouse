<?php

namespace App\Http\Controllers;

use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
}
