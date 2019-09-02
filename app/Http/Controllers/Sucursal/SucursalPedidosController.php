<?php

namespace App\Http\Controllers\Sucursal;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Sucursal;

class SucursalPedidosController extends ApiController
{
    public function index(Sucursal $sucursal)
    {
        $pedidos = $sucursal->empleados()->with('pedidos')->get()
        ->pluck('pedidos')->collapse()
        ;
        return $this->showAll($pedidos,200);
    }
}
