<?php

namespace App\Http\Controllers\Empleado;

use App\Administrador;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class EmpleadoPedidosController extends ApiController
{
    public function index(Empleado $empleado)
    {
        $id = $empleado->id;
        $pedidos = DB::table('pedidos')->where('administrador_id','=',$id)->get();

        return $pedidos;
        
    }
}
