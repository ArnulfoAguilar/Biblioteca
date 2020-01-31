<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row['email'] == null){
            return null;
        }else{
            return new User([
                'name'          => $row['nombres'],
                'apellidos'     => $row['apellidos'],
                'carnet'        => $row['carnet'],
                'email'         => $row['email'], 
                'password'      => Hash::make(12345678),
                'BIOGRAFIA'     => 'Mi biografía',
                'ID_ROL'        => 2,
            ]);  
                        
        }
        
    }
    
}
