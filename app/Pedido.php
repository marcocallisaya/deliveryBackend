<?php

namespace App;

use App\Transformers\PedidoTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $transformer = PedidoTransformer::class;

    const FINALIZADO = 'finalizado';
    const RESERVA = 'reserva';

    protected $fillable = ['price','state','cliente_id','conductor_id','administrador_id'];

    public function administrador()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

}
