<?php

namespace App\Http\Controllers\Sucursal;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Sucursal;

class SucursalProductosController extends ApiController
{
    public function index(Sucursal $sucursal)
    {
         $productos = $sucursal->productos;

        return $this->showAll($productos,200);
    }
}
