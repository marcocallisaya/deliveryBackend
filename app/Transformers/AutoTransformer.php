<?php

namespace App\Transformers;

use App\Auto;
use League\Fractal\TransformerAbstract;

class AutoTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Auto $auto)
    {
        return [
            'identificador'=>(int)$auto->id,
            'modeloAuto'=> (string)$auto->modelo,
            'placaAuto'=> (string)$auto->placa,
            'conductor'=> (string)$auto->conductor_id,
            'fechaCreacion'=>(string)$auto->created_at,
            'ultimaActualizacion'=>(string)$auto->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'modeloAuto'=> 'modelo',
            'placaAuto'=> 'placa',
            'conductor'=> 'conductor_id',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
