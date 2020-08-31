<?php

namespace App\Http\Controllers;

use App\Material;
use App\Voucher;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class SitioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Material::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" data-placement="top" title="Add" class="edit btn btn-primary btn-sm addToSitioVoucher"><i class="fa fa-plus"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('vouchers.sitio.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $maintenance = Maintenance::create($this->validateData());
        $material_id = Material::find($request->input('material_id'));
        $voucher_id = Voucher::find($request->input('voucher_id'));
        $material_id->vouchers()->attach($voucher_id,[
            'voucher_code'=>$request->input('request_voucher_no'),
            'quantity'=>$request->input('quantity'),
            'place_of_const'=>$request->input('place_of_const'),
            'description_of_work'=>$request->input('description_of_work'),
            'mct_number'=>$request->input('mct_number'),
            'issued_by'=>$request->input('issued_by'),
            'received_by'=>$request->input('received_by'),
            'order_type'=>$request->input('order_type'),
            'order_number'=>$request->input('order_number'),
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $material = Material::findOrfail($id);
        $material->quantity = $material->quantity - $request->input('req_quantity');
        $material->update();
        // $this->insertToAllVoucher($material->id);
        return response()->json(['success'=>'Material updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    private function validateData(){
        return request()->validate([
            'request_voucher_no'=>'required',
            'quantity'=>'required',
            'place_of_const'=>'',
        ]);
    }
    public function insertToAllVoucher($voucherCode){

    }
    //function to return the requested quantity
    public function undoMaterial(Request $request, $id){
        try{
            $material = Material::findOrFail($id);
            $material->quantity += $request->input('return_quant');
            $material->update();
            return response()->json(['success'=>'Material updated successfully.']);
        }
        catch(Exception $e){
            echo 'Message: ' . $e->getMessage();
        }
    }
    //function to subtract 1 the requested  quantity
    public function subtractMaterial(Request $request, $id){
        try{
            $material = Material::findOrFail($id);
            $material->quantity += $request->input('return_quant');
            $material->update();
            return response()->json(['success'=>'Material updated successfully.']);
        }
        catch(Exception $e){
            echo 'Message: ' . $e->getMessage();
        }
    }
}
