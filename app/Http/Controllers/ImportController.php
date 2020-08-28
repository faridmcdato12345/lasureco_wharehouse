<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\MaterialsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file=$request->file('myfile');
        Excel::import(new MaterialsImport, $file);
        Session::flash('imported_material',$file->getClientOriginalName().' has been created');
        return view('import.index');
    }
}
