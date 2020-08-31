<?php

namespace App\Http\Controllers;

use App\AllVouchers;
use PDO;
use DataTables;
use App\Material;
use App\Inventory;
use App\Material_Received;
use App\Material_Released;
use Illuminate\Http\Request;
use App\Imports\MaterialsImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Collection;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Material::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a style="margin-right:1%;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Add Quantity" data-placement="top" title="Add Quantity Material" class="btn btn-success btn-sm addQuantityMaterial">Add Quantity</a>';
                        $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" data-placement="top" title="Edit material" class="edit btn btn-primary btn-sm editMaterial ">Edit</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-placement="top" title="Delete material" class="btn btn-danger btn-sm deleteMaterial">Delete</a>';
                        
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('material.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Material::create($this->validateMaterial());
        $id = Material::latest()->first()->id;
        DB::table('inventories')->insert([
            'material_id'=>$id,
            'quantity'=>$request->input('quantity'),
            'type'=>1,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return response()->json($material);
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
        $material = Material::findOrFail($id);
        $material->update($this->validateMaterial());
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
        $material = Material::find($id)->delete();
        return response()->json(['success'=>'deleted successfully.']);
    }
    public function validateMaterial(){
        return request()->validate([
            'code_number'=>'required',
            'name'=>'required',
            'quantity'=>'required',
            'unit'=>''
        ]);
    }
    public function importMaterial(Request $request){
        $file = $request->file('myfile');
        $name = 'material';
        Excel::import(new MaterialsImport, $name.'.xlsx');
        return redirect('/')->with('success', 'All good!');
    }
    public function materialReceived(Request $request){
        if ($request->ajax()) {
            if(!empty($request->from_date)){
                $data = DB::table('inventories')->where('type',1)->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }
            else{
                $data = Inventory::where('type',1)->get();
            }
           
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('material_name', function($row){
                        $materialName = DB::table('materials')->where('id',$row->material_id)->value('name');
                        return $materialName;
                    })
                    ->editColumn('id',function($row){
                        $materialCode = DB::table('materials')->where('id',$row->material_id)->value('code_number');
                        return $materialCode;
                    })
                    ->editColumn('created_at',function($row){
                        return date('Y-m-d',strtotime($row->created_at));
                    })
                    ->make(true);
        }
        return view('material.receive');
    }
    public function materialReceivedUpdate(Request $request, $id){
        $material = Material::findOrFail($id);
        $material->quantity += $request->input('quantity');
        $material->save();
        DB::table('inventories')->insert([
            'material_id'=>$id,
            'quantity'=>$request->input('quantity'),
            'type'=>1,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
        return response()->json(['success'=>'Material updated successfully.']);
    }
    public function materialReleased(Request $request){
        if ($request->ajax()) {
            if(!empty($request->from_date)){
                $data = DB::table('inventories')->where('type',0)->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }
            else{
                $data = Inventory::where('type',0)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('material_name', function($row){
                        $materialName = DB::table('materials')->where('id',$row->material_id)->value('name');
                        return $materialName;
                    })
                    ->editColumn('id',function($row){
                        $materialCode = DB::table('materials')->where('id',$row->material_id)->value('code_number');
                        return $materialCode;
                    })
                    ->editColumn('created_at',function($row){
                        return date('Y-m-d',strtotime($row->created_at));
                    })
                    ->make(true);
        }
        return view('material.release');
    }
    public function materialReleasedUpdate(Request $request, $id){
        $material = Material::findOrFail($id);
        $material->quantity -= $request->input('quantity');
        $material->save();
        DB::table('inventories')->insert([
            'material_id'=>$id,
            'quantity'=>$request->input('quantity'),
            'type'=>0,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
        return response()->json(['success'=>'Material updated successfully.']);
    }
    public function materialInventory(Request $request){
        if ($request->ajax()) {
            // $data = Material::latest()->get();
            
            if(!empty($request->from_date))
            {
                $inventoryCollection = new Collection();
                $inventory = DB::table('inventories')->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                $u = $inventory->uniqueStrict('material_id');
                $un = $u->values();
                for($i = 0;$i<count($un);$i++){
                    $inventoryCollection->push([
                        'material_id'=>$un[$i]->material_id,
                        'material_name'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('name'),
                        'total_received'=>DB::table('inventories')->where('material_id','=',$un[$i]->material_id)->where('type','=','1')->whereBetween('created_at', array($request->from_date, $request->to_date))->get()->sum('quantity'),
                        'total_released'=>DB::table('inventories')->where('material_id','=',$un[$i]->material_id)->where('type','=','0')->whereBetween('created_at', array($request->from_date, $request->to_date))->get()->sum('quantity'),
                        'total_quantity'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('quantity'),
                    ]);
                }
            }
            else
            {
                $inventoryCollection = new Collection();
                $inventory = Inventory::all();
                $u = $inventory->uniqueStrict('material_id');
                $un = $u->values();
                for($i = 0;$i<count($un);$i++){
                    $inventoryCollection->push([
                        'material_id'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('code_number'),
                        'material_name'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('name'),
                        'total_received'=>DB::table('inventories')->where('material_id','=',$un[$i]->material_id)->where('type','=','1')->get()->sum('quantity'),
                        'total_released'=>DB::table('inventories')->where('material_id','=',$un[$i]->material_id)->where('type','=','0')->get()->sum('quantity'),
                        'total_quantity'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('quantity'),
                    ]);
                }
            }
            return Datatables::collection($inventoryCollection)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('material.inventory');
    }
    public function getVoucher(Request $request){
        $voucherCode = AllVouchers::where("voucher_id",$request->input('voucher_code'))->first();
        return $voucherCode;
    }
    public function checkForMaterialNumber(Request $request){
        $materialNumber = Material::where('code_number',$request->input('code_number'))->first();
        //return response()->json(['message'=>'This material item code is existing already. Please use "ADD QUANTITY" instead or provide different item code.']);
        return $materialNumber;
    }
}
