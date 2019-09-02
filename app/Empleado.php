<?php

namespace App;

use App\Transformers\EmpleadoTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// el empleado hereda de user
class Empleado extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guard = 'empleados';

    public $transformer = EmpleadoTransformer::class;

    protected $fillable = [
        'name','lastname', 'email', 'password', 'direction', 'phone', 'carnet', 'position','sucursal_id'
    ];

    //

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
