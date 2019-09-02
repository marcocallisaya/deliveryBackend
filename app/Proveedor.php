<?php

namespace App;

use App\Transformers\ProveedorTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $transformer = ProveedorTransformer::class;

    protected $fillable = ['name','direction','city','phone','description'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
