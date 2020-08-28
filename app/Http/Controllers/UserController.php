<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('role', function($row){
                        $roleName = DB::table('roles')->where('id',$row->role)->value('name');
                        return $roleName;
                    })
                    ->addColumn('status', function($row){
                        if($row->is_active == 1){
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm userActive disabled">Active</a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm userInActive">In Active</a>';
                        }
                        else{
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm userActive">Active</a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm userInActive disabled">In Active</a>';
                        }
                        return $btn;
                    })
                    ->addColumn('actions', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" data-placement="top" title="Edit user" class="edit btn btn-primary btn-sm editUser"><i class="fa fa-plus"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-placement="top" title="Delete user" class="btn btn-danger btn-sm deleteUser"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status','actions'])
                    ->make(true);
        }
        $role = Role::pluck('name','id')->all();
        $roleType = Role::all();
        return view('user.index',compact('role','roleType'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $input['is_active'] = 0;
        User::create($input);
        return response()->json(['success'=>'User saved successfully.']); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function validateMaterial(){
        return request()->validate([
            'name'=>'required',
            'username'=>'required',
            'password'=>''
        ]);
    }
    public function isActive($id){
        $user = User::find($id);
        $user->is_active = '1';
        $user->save();
        return response()->json(['success'=>'status updated.']);
    }
    public function inActive($id){
        $user = User::find($id);
        $user->is_active = '0';
        $user->save();
        return response()->json(['success'=>'status updated.']);
    }
}
