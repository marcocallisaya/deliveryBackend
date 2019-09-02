<?php

namespace App\Transformers;

use App\Cliente;
use League\Fractal\TransformerAbstract;

class ClienteTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Cliente $cliente)
    {
        return [
            'identificador' => (int)$cliente->id,
            'nombre'=> (string)$cliente->name,
            'apellidos'=>(string)$cliente->lastname,
            'correo'=>(string)$cliente->email, 
              'direccion'=>(string)$cliente->direction, 
              'telefono'=>(string)$cliente->phone, 
              'carnet'=>(string)$cliente->carnet,
              'fechaCreacion'=>(string)$cliente->created_at,
            'ultimaActualizacion'=>(string)$cliente->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'nombre'=> 'name',
            'apellidos'=>'lastname',
            'correo'=>'email', 
            'contrasena'=>'password',
              'direccion'=>'direction', 
              'telefono'=>'phone', 
              'carnet'=>'carnet',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
