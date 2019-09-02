<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Producto;

class ProductoProveedorController extends ApiController
{
    public function index(Producto $producto)
    {
        $proveedor = $producto->proveedor;

        return $this->showOne($proveedor,200);
    }
}
