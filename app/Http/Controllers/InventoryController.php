<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
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
        return view('material.inventory');
    }
}
