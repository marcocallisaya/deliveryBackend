<?php

namespace App\Transformers;

use App\Pedido;
use League\Fractal\TransformerAbstract;

class PedidoTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Pedido $pedido)
    {
        return [
            'identificador'=>(int)$pedido->id,
            'precio'=> (double)$pedido->price,
            'estado'=>(string)$pedido->state,
            'cliente'=>(int)$pedido->cliente_id,
            'conductor'=>(int)$pedido->conductor_id,
            'administrador'=>(int)$pedido->administrador_id,
            'fechaCreacion'=>(string)$pedido->created_at,
            'ultimaActualizacion'=>(string)$pedido->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'precio'=> 'price',
            'estado'=>'state',
            'cliente'=>'cliente_id',
            'conductor'=>'conductor_id',
            'administrador'=>'administrador_id',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
