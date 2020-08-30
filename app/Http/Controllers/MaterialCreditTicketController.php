<?php

namespace App\Http\Controllers;

use DataTables;
use App\Material;
use App\Material_Credit;
use App\Material_Credit_Ticket;
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
        $data = json_decode($request->getContent());
        // return response()->json(['data'=>$data]);
        $mcrtNumber = '';
        $mctNumber = '';
        $receivedBy = '';
        $returnedBy = '';
        $orderNumber = '';
        $orderType = '';
        $placeOfConstruction = '';
        $descriptionOfWork = '';
        foreach($data as $d){
            $mcrtNumber = $d->mcrt_number;
            $mctNumber = $d->mct_number;
            $receivedBy = $d->received_by;
            $returnedBy = $d->returned_by;
            $orderNumber = $d->order_number;
            $orderType = $d->order_type;
            $placeOfConstruction = $d->place_of_construction;
            $descriptionOfWork = $d->description_of_work;
            DB::table('material__credits')->insert([
                'mcrt_number'=>$d->mcrt_number,
                'material_id'=>$d->material_id,
                'quantity'=>$d->quantity,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
        }
        DB::table('material__credit__tickets')->insert([
            'mcrt_number'=>$mcrtNumber,
            'mct_number'=>$mctNumber,
            'place_of_const'=>$placeOfConstruction,
            'description_of_work'=>$descriptionOfWork,
            'order_type'=>$orderType,
            'order_number'=>$orderNumber,
            'returned_by'=>$returnedBy,
            'received_by'=>$receivedBy,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
    }
    
}
