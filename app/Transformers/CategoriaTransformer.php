<?php

namespace App\Transformers;

use App\Categoria;
use League\Fractal\TransformerAbstract;

class CategoriaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Categoria $categoria)
    {
        return [
            'identificador'=>(int)$categoria->id,
            'nombre'=> (string)$categoria->name,
            'descripcion'=> (string)$categoria->description,
            'fechaCreacion'=>(string)$categoria->created_at,
            'ultimaActualizacion'=>(string)$categoria->updated_at
        ];
    }

    public static function original($index)
    {
        $attributes = [
            'identificador'=>'id',
            'nombre'=> 'name',
            'descripcion'=> 'description',
            'fechaCreacion'=>'created_at',
            'ultimaActualizacion'=>'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
