<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class EmpleadoPedidosController extends ApiController
{
    public function index(Empleado $empleado)
    {
        $pedidos = $empleado->pedidos;

        return $this->showAll($pedidos,200);
    }
}
