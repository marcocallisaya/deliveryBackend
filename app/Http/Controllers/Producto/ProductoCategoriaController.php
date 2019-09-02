<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Producto;

class ProductoCategoriaController extends ApiController
{
    public function index(Producto $producto)
    {
        $categoria = $producto->categoria;

        return $this->showOne($categoria,200);
    }
}
