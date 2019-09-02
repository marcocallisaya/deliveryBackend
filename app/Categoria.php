<?php

namespace App;

use App\Transformers\CategoriaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $transformer = CategoriaTransformer::class;

    protected $fillable = ['name', 'description'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
