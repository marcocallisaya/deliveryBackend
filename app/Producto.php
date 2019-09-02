<?php

namespace App;

use App\Transformers\ProductoTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $transformer = ProductoTransformer::class;

    protected $fillable=['name','price','img','stock','order','state','proveedor_id', 'categoria_id'];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class);
    }
}
