<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function buscar_productos(Request $request,$id)
    {
        $term = $request->get('term');
        $querys = Producto::Where(function($query) use ($term) {
            $query->where('designacion','like','%' . $term.'%')
                    ->orWhere('codigo', 'like', '%' . $term.'%');
        })->whereExists(function ($query) use ($id) {
            $query->select()
                  ->from('empleado_proyectos')
                  ->whereColumn('empleados.id', 'empleado_proyectos.empleado_id')
                  ->where('empleado_proyectos.proyecto_id',$id);
        })->get();

        foreach ($querys as $query) {
            $query['label'] =  $query->id."-".$query->name;
        }

        $listaempleados = $querys;
        if ($querys->count() == 0) {
            $listaempleados['label'] = 'Sin resultados';
        }
        return $listaempleados;
    }

}
