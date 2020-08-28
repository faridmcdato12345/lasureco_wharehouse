<?php

namespace App\Http\Controllers;

use DataTables;
use App\Voucher;
use App\AllVouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllVoucherController extends Controller
{
    public function saveToAllVoucher(Request $request){
        $vouchers = new AllVouchers;
        $vouchers->voucher_code = $request->input('request_voucher_no');
        $vouchers->voucher_id = $request->input('voucher_id');
        $vouchers->save();
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->from_date))
            {
                $data = DB::table('all_vouchers')->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }
            else
            {
                $data = DB::table('all_vouchers')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" data-placement="top" title="Show Voucher" class="edit btn btn-primary btn-sm viewVoucher"><i class="fa fa-eye"></i></a>';
                        return $btn;
                    })
                    ->editColumn('created_at',function($row){
                        return date('Y-m-d',strtotime($row->created_at));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard');
    }
    public function getTheVoucherCode($voucher_code){
        $voucher = DB::table('all_vouchers')->where('voucher_code','=',$voucher_code)->first();
        $v = Voucher::findOrFail($voucher->voucher_id);
        $material = $v->materials()->where('voucher_code','=',$voucher_code)->get();
        return response()->json($material);
    }
    public function printVoucher($id){
        $voucher = AllVouchers::findOrFail($id);
        return response()->json($voucher);
    }
}
