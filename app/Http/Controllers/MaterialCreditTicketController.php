<?php

namespace App\Http\Controllers;

use DataTables;
use App\Material;
use App\Material_Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialCreditTicketController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Material::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" data-placement="top" title="Add" class="edit btn btn-primary btn-sm addToMaintenanceVoucher"><i class="fa fa-plus"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('mcrt.index');
    }
    public function update(Request $request, $id){
        $material = Material::findOrfail($id);
        $material->quantity = $material->quantity + $request->input('req_quantity');
        $material->update();
        return response()->json(['success'=>'Material updated successfully.']);
    }
    public function store(Request $request){
        // $data = request()->validate([
        //     'mcrt_number'=>'required',
        //     'material_id'=>'required',
        //     'quantity'=>'required',
        // ]);
        DB::table('material__credits')->insert([
            'mcrt_number'=>$request->input('mcrt_number'),
            'material_id'=>$request->input('material_id'),
            'quantity'=>$request->input('quantity'),
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
        DB::table('material__credit__tickets')->insert([
            'mcrt_number'=>$request->input('mcrt_number'),
            'mct_number'=>$request->input('mct_number'),
            'place_of_const'=>$request->input('place_of_const'),
            'description_of_work'=>$request->input('description_of_work'),
            'order_type'=>$request->input('order_type'),
            'order_number'=>$request->input('order_number'),
            'returned_by'=>$request->input('returned_by'),
            'received_by'=>$request->input('received_by'),
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
    }
    public function mcrt(){

    }
}
