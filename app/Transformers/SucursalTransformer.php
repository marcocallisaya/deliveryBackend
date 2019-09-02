<?php

namespace App\Transformers;

use App\Sucursal;
use League\Fractal\TransformerAbstract;

class SucursalTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Sucursal $sucursal)
    {
        return [
            'identificador'=>(int)$sucursal->id,
            'nombre'=>(string)$sucursal->name,
            'direccion'=>(string)$sucursal->direction,
            'ciudad'=>(string)$sucursal->city,
            'telefono'=>(string)$sucursal->phone,
            'fechaCreacion'=>(string)$sucursal->created_at,
            'ultimaActualizacion'=>(string)$sucursal->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'nombre'=>'name',
            'direccion'=>'direction',
            'ciudad'=>'city',
            'telefono'=>'phone',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
