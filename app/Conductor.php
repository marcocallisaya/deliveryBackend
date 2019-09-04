<?php

namespace App;

use App\Scopes\ConductorScope;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Empleado
{
    protected $table= 'empleados';
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ConductorScope);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function auto()
    {
        return $this->hasOne(Auto::class);
    }
}
