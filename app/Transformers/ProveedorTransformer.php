<?php

namespace App\Transformers;

use App\Proveedor;
use League\Fractal\TransformerAbstract;

class ProveedorTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Proveedor $proveedor)
    {
        return [
            'identificador'=>(int)$proveedor->id,
            'nombre'=>(string)$proveedor->name,
            'direccion'=>(string)$proveedor->direction,
            'ciudad'=>(string)$proveedor->city,
            'telefono'=>(string)$proveedor->phone,
            'descripcion'=>(string)$proveedor->description,
            'fechaCreacion'=>(string)$proveedor->created_at,
            'ultimaActualizacion'=>(string)$proveedor->updated_at
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
            'descripcion'=>'description',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
