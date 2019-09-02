<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoriaProductosController extends ApiController
{
    public function index(Categoria $categorium)
    {
        $productos = $categorium->productos;

       return $this->showAll($productos,200);
    }
}
