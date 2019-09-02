<?php

namespace App\Transformers;

use App\Reserva;
use DateTime;
use League\Fractal\TransformerAbstract;

class ReservaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Reserva $reserva)
    {
        return [
            'identificador'=>(int)$reserva->id,
            'montoPendiente'=>(double)$reserva->amountPending,
            'montoAdelantado'=>(double)$reserva->amountGiven,
            'fechaEntrega'=>(string)$reserva->date,
            'pedido'=>(int)$reserva->pedido_id,
            'fechaCreacion'=>(string)$reserva->created_at,
            'ultimaActualizacion'=>(string)$reserva->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'montoPendiente'=>'amountPending',
            'montoAdelantado'=>'amountGiven',
            'fechaEntrega'=>'date',
            'pedido'=>'pedido_id',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
