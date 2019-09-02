<?php

namespace App\Http\Controllers\Cliente;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ClientePedidosController extends ApiController
{
    public function index(Cliente $cliente)
    {
        $pedidos = $cliente->pedidos;

        return $this->showAll($pedidos,200);
    }
}
