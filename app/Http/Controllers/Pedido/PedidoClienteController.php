<?php

namespace App\Http\Controllers\Pedido;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Pedido;

class PedidoClienteController extends ApiController
{
    public function index(Pedido $pedido)
    {
        $cliente = $pedido->cliente;

        return $this->showOne($cliente,200);
    }
}
