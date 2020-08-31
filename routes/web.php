<?php

use App\Inventory;
use App\Maintenance;
use App\Material;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register'=>false,
]);


Route::get('/test',function(){
    // $m = DB::table('maintenances')->where('request_voucher_no','=','MA-202075191045')->get();
    // // foreach($m as $x){
    // //     $name = DB::table('materials')->where('id','=',$x->material_id)->get();
    // //     foreach($name as $n){
    // //         echo($n->name);
    // //     }
    // // }
    // dd($m);
    $allData = DB::table('material_voucher')->get();
});



Route::get('/testing',function(){
    // $material = \App\Material::first();
    // $voucher = \App\Voucher::all();
    // $material->vouchers()->attach($voucher);

    $voucher = \App\Voucher::find(1);
    $materials = $voucher->materials()->get();
    foreach($materials as $material){
        dd($material->pivot->voucher_code);
    }
    // $voucher->materials()->attach([2]);

});
Route::get('/role-test',function(){
    $inventoryCollection = new Collection();
    $inventory = Inventory::all();
    $u = $inventory->uniqueStrict('material_id');
    $un = $u->values();
    for($i = 0;$i<count($un);$i++){
        $inventoryCollection->push([
            'material_id'=>$un[$i]->material_id,
            'material_name'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('name'),
            'total_received'=>DB::table('inventories')->where('material_id','=',$un[$i]->material_id)->where('type','=','1')->get()->sum('quantity'),
            'total_released'=>DB::table('inventories')->where('material_id','=',$un[$i]->material_id)->where('type','=','0')->get()->sum('quantity'),
            'total_quantity'=>DB::table('materials')->where('id','=',$un[$i]->material_id)->value('quantity'),
        ]);
    }
    dd($inventoryCollection);
   
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard','PivotTableController@index')->name('dashboard');
    Route::get('/voucher/maintenance/print/{id}/{voucher_code}','PrintableController@maintenance')->name('printable.maintenance');
    Route::get('/voucher/metering/print/{id}/{voucher_code}','PrintableController@metering')->name('printable.metering');
    Route::get('/voucher/project/print/{id}/{voucher_code}','PrintableController@project')->name('printable.project');
    Route::get('/voucher/sitio/print/{id}/{voucher_code}','PrintableController@sitio')->name('printable.sitio');
    Route::get('/voucher/blanket/print/{id}/{voucher_code}','PrintableController@blanket')->name('printable.blanket');
    Route::get('/material_credit/print/{mcrt_number}','PrintableController@mcrt')->name('printable.mcrt');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/material','MaterialController',['except'=>['create','show']]);
    Route::resource('/voucher/maintenance','MaintenanceController',['except'=>['create','edit','show']]);
    Route::resource('/voucher/blanket','BlanketController',['except'=>['create','edit','show']]);
    Route::resource('/voucher/metering','MeteringController',['except'=>['create','edit','show']]);
    Route::resource('/voucher/project','ProjectController',['except'=>['create','edit','show']]);
    Route::resource('/voucher/sitio','SitioController',['except'=>['create','edit','show']]);
    Route::resource('/user','UserController',['except'=>['create','show']]);
    Route::resource('/import','ImportController',['only'=>['index','store']]);
    Route::post('/setting/profile','UserProfileController@changePass')->name('change.password');
    Route::get('/setting/profile','UserProfileController@index')->name('profile.index');
    Route::patch('/voucher/maintenance/return/{maintenance}','MaintenanceController@undoMaterial')->name('maintenance.undo_material');
    Route::patch('/voucher/maintenance/subtract/{maintenance}','MaintenanceController@subtractMaterial')->name('maintenance.subtract_material');
    Route::patch('/voucher/metering/return/{metering}','MeteringController@undoMaterial')->name('metering.undo_material');
    Route::patch('/voucher/metering/subtract/{metering}','MeteringController@subtractMaterial')->name('metering.subtract_material');
    Route::patch('/voucher/blanket/return/{blanket}','BlanketController@undoMaterial')->name('blanket.undo_material');
    Route::patch('/voucher/blanket/subtract/{blanket}','BlanketController@subtractMaterial')->name('blanket.subtract_material');
    Route::patch('/voucher/project/return/{project}','ProjectController@undoMaterial')->name('project.undo_material');
    Route::patch('/voucher/project/subtract/{project}','ProjectController@subtractMaterial')->name('project.subtract_material');
    Route::patch('/voucher/sitio/return/{sitio}','SitioController@undoMaterial')->name('sitio.undo_material');
    Route::patch('/voucher/sitio/subtract/{sitio}','SitioController@subtractMaterial')->name('sitio.subtract_material');
    Route::patch('admin/users/{id}/in_active/','UserController@inActive')->name('user.inactive');
    Route::patch('admin/users/{id}/is_active/','UserController@isActive')->name('user.active');
    Route::post('/materia/import','MaterialController@importMaterial')->name('material.import');
    Route::post('/allvoucher','AllVoucherController@saveToAllVoucher')->name('save.allvoucher');
    Route::get('/allvoucher/{voucher_code}','AllVoucherController@getTheVoucherCode')->name('get.allvoucher');
    Route::get('/allvoucher','AllVoucherController@index')->name('dashboard.index');
    Route::get('/material/receive','MaterialController@materialReceived')->name('material.receive');
    Route::get('/material/release','MaterialController@materialReleased')->name('material.release');
    Route::get('/material/inventory','MaterialController@materialInventory')->name('material.inventory');
    Route::patch('/material/receive/{id}','MaterialController@materialReceivedUpdate')->name('material.receive.update');
    Route::patch('/material/release/{id}','MaterialController@materialReleasedUpdate')->name('material.release.update');
    Route::post('/material/get-voucher','MaterialController@getVoucher')->name('material.getVoucher');
    Route::get('/material_credit','MaterialCreditTicketController@index')->name('material_credit.index');
    Route::patch('/material_credit/{id}','MaterialCreditTicketController@update')->name('material_credit.update');
    Route::post('/material_credit','MaterialCreditTicketController@store')->name('material_credit.store');
    Route::post('/material/code_check','MaterialController@checkForMaterialNumber')->name('material.code_check');
});