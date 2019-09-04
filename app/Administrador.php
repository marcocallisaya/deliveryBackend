<?php

namespace App;

use App\Scopes\AdministradorScope;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Empleado
{
    protected $table= 'empleados';
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AdministradorScope);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
