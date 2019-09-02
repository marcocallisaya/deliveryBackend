<?php

namespace App\Transformers;

use App\Producto;
use League\Fractal\TransformerAbstract;

class ProductoTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Producto $producto)
    {
        return [
            'identificador'=>(int)$producto->id,
            'nombre'=>(string)$producto->name,
            'precio'=>(double)$producto->price,
            'imagen'=>(string)$producto->img,
            'stock'=>(int)$producto->stock,
            'reserva'=>(int)$producto->order,
            'estado'=>(string)$producto->state,
            'proveedor'=>(int)$producto->proveedor_id, 
            'categoria'=>(int)$producto->categoria_id,
            'fechaCreacion'=>(string)$producto->created_at,
            'ultimaActualizacion'=>(string)$producto->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'nombre'=>'name',
            'precio'=>'price',
            'imagen'=>'img',
            'stock'=>'stock',
            'reserva'=>'order',
            'estado'=>'state',
            'proveedor'=>'proveedor_id', 
            'categoria'=>'categoria_id',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
