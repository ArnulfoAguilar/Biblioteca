<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
    public function importUsuarios(Request $request)
    {
        /*

        \Excel::load($request->excel, function($reader) {
            $excel = $reader->get();
            $reader->each(function($row) {
     
                $user = new User;
                $user->name = $row->nombre;
                $user->apellidos = $row->apellidos;
                $user->carnet = $row->carnet;
                $user->email = $row->email;
                $user->password = bcrypt($row->carnet);
                $user->puntos = 0;
                $user->biografia = 'Mi biografía';
                $user->save();
     
            });
        
        });
     
        return redirect()-route('administracion.gestion.usuarios');
*/

        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        return back()->with('success', 'Importado correctamente');
        
    }
}
