<?php

namespace App;

use App\Transformers\AutoTransformer;
use Illuminate\Database\Eloquent\Model;


class Auto extends Model
{
   protected $fillable = ['modelo','placa','conductor_id'];

    protected $table = 'autos';
   public $transformer = AutoTransformer::class;   

   public function conductor()
   {
       return $this->belongsTo(Conductor::class);
   }

}
