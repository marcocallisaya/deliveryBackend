<?php

namespace App;

use App\Transformers\SucursalTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
  use SoftDeletes;
    protected $dates = ['deleted_at'];

  public $transformer = SucursalTransformer::class;

   protected $fillable = ['name','direction','city','phone'];

   public function empleados()
   {
     return $this->hasMany(Empleado::class);
   }

   public function productos()
   {
     return $this->belongsToMany(Producto::class);
   }

}

