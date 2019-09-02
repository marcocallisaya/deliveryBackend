<?php

namespace App\Http\Controllers\Pedido;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Pedido;
use App\Producto;
use Illuminate\Support\Facades\DB;

class PedidoProductosController extends ApiController
{
    public function index(Pedido $pedido)
    {
        $productos = $pedido->productos;

        return $this->showAll($productos,200);
    }

    public function store(Request $request)
    {
     
    $data = $request->all();

    $producto_id = $data['producto_id'];
    $cantidad = $data['quantity'];
    $pedido_id = $data['pedido_id'];
    $precio = $data['price'];
    $subtotal = $data['subtotal'];

    $producto = Producto::findOrFail($producto_id);
    $pedido = Pedido::findOrFail($pedido_id);

    if ($pedido->state==Pedido::RESERVA && $this->Disponible($producto,$cantidad) )
    {
        $producto->stock =  $producto->stock-$cantidad;
        $producto->order = $producto->order + $cantidad;
        $producto->save();
        $pedido->productos()->syncWithoutDetaching([$producto_id]);

        
        DB::table('pedido_producto')
        ->where('pedido_id', $pedido_id)
        ->where('producto_id', $producto_id)
        ->update([
            'price' => $precio,
            'quantity' => $cantidad,
            'subtotal' => $subtotal
        ]);

        return $this->showOne($producto);
    }

    if ($pedido->state==Pedido::FINALIZADO  && $this->Disponible($producto,$cantidad))
    {
        $producto->stock =  $producto->stock-$cantidad;
        $producto->save();
        $pedido->productos()->syncWithoutDetaching([$producto_id]);

        
        DB::table('pedido_producto')
        ->where('pedido_id', $pedido_id)
        ->where('producto_id', $producto_id)
        ->update([
            'price' => $precio,
            'quantity' => $cantidad,
            'subtotal' => $subtotal
        ]);

        return $this->showOne($producto);
    }
    else
    {
        return $this->errorResponse('no hay la cantidad pedida',422);
    }

 
   
    
    }
    private function Disponible (Producto $producto,$cantidad)
    {
        $stock = $producto->stock;

        if ($stock>0 && ($stock>=$cantidad))
        {
            
            return true;
        }
        else
        {
            return false;
        }
       
    }
    
}
