<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function buscar_productos(Request $request, $id)
    {
        $term = $request->get('term');
        $querys = Producto::Where(function ($query) use ($term) {
            $query->where('designacion', 'like', '%' . $term . '%')
                ->orWhere('codigo', 'like', '%' . $term . '%');
        })->whereExists(function ($query) use ($id) {
            $query->select()
                ->from('empleado_proyectos')
                ->whereColumn('empleados.id', 'empleado_proyectos.empleado_id')
                ->where('empleado_proyectos.proyecto_id', $id);
        })->get();

        foreach ($querys as $query) {
            $query['label'] =  $query->id . "-" . $query->name;
        }

        $listaempleados = $querys;
        if ($querys->count() == 0) {
            $listaempleados['label'] = 'Sin resultados';
        }
        return $listaempleados;
    }
    public function buscar_productos_compra(Request $request)
    {
        $term = $request->get('term');
        $querys = Producto::Where(function($query) use ($term) {
            $query->where('designacion','like','%' . $term.'%')
                    ->orWhere('codigo', 'like', '%' . $term.'%');
        })->get();

        foreach ($querys as $query) {
            $query['label'] =  $query->codigo."-".$query->designacion;
        }

        $listaempleados = $querys;
        if ($querys->count() == 0) { $listaempleados['label'] = 'Sin resultados';}
        return $listaempleados;
    }

    public function direccionarusuario(){
        #buscar usuario
        $busuario = User::find(Auth::user()->id);
        $obtener_roles = $busuario->getRoleNames();

       if($obtener_roles->first() == 'Administrador'){
            return redirect()->route('admin.compras');
        }

        elseif($obtener_roles->first() == 'Cajero'){
            return redirect()->route('admin.ventas.pos');
        }
    }

}
