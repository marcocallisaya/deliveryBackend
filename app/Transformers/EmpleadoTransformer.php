<?php

namespace App\Transformers;

use App\Empleado;
use League\Fractal\TransformerAbstract;

class EmpleadoTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Empleado $empleado)
    {
        return [
            'identificador' => (int)$empleado->id,
            'nombre'=> (string)$empleado->name,
            'apellidos'=>(string)$empleado->lastname,
            'correo'=>(string)$empleado->email, 
              'direccion'=>(string)$empleado->direction, 
              'telefono'=>(string)$empleado->phone, 
              'carnet'=>(string)$empleado->carnet,
              'cargo'=>(string)$empleado->position, 
              'sucursal'=>(int)$empleado->sucursal_id,
              'fechaCreacion'=>(string)$empleado->created_at,
            'ultimaActualizacion'=>(string)$empleado->updated_at
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
              'cargo'=>'position',
              'sucursal'=>'sucursal_id',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
