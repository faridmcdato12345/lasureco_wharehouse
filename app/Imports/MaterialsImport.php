<?php

namespace App\Imports;

use App\Material;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class MaterialsImport implements ToCollection
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $i=0;
        foreach ($rows as $row) 
        {
            
            if(empty($row[1]) && isset($row[2])){
                $checkName = DB::table('materials')->where('name','=',$row[2])->get();
                $mat = Material::where('name','=',$row[2])->first();
                if($mat === null){
                    $i++;
                    if(strlen($i) == 1){
                        $date = date("Yndhi")."0".$i;
                    }
                    else{
                        $date = date("Yndhi").$i;
                    }
                    Material::create([
                        'code_number' => $date,
                        'name' => $row[2],
                        'quantity' => $row[3],
                        'unit' => $row[4],
                    ]);
                }
                else{
                    foreach($checkName as $name){
                        if(strcmp($name->name,$row[2]) == 0){
                            $name->quantity += $row[3];
                            DB::table('materials')->where('name','=',$row[2])->update(['quantity'=>$name->quantity]);
    
                        }
                    }  
                }
                
            }  
        }
    }
}
