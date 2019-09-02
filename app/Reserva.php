<?php

namespace App;

use App\Transformers\ReservaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $transformer = ReservaTransformer::class;

    protected $fillable = ['pedido_id','amountPending','amountGiven','date'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
