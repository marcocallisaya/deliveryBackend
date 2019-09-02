<?php

namespace App\Http\Controllers\Proveedor;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Proveedor;

class ProveedorProductosController extends ApiController
{
    public function index(Proveedor $proveedor)
    {
        $productos = $proveedor->productos;

        return $this->showAll($productos,200);
    }
}
