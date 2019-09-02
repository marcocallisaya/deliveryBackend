<?php

namespace App\Http\Controllers\Sucursal;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Sucursal;

class SucursalEmpleadosController extends ApiController
{
    public function index(Sucursal $sucursal)
    {
        
        $empleados =  $sucursal->empleados;

        return $this->showAll($empleados,200);
    }
}
