<?php

namespace App\Http\Controllers\Pedido;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Pedido;

class PedidoEmpleadoController extends ApiController
{
    public function index(Pedido $pedido)
    {
        $empleado = $pedido->administrador;

        return $this->showOne($empleado,200);
    }
}
