<?php

namespace App\Scopes;

use App\Empleado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AdministradorScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('position','=', Empleado::CAJERO);
    }
}