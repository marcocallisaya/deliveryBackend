<?php

namespace App;


use App\Transformers\ClienteTransformer;
use Illuminate\Database\Eloquent\Model;


// el cliente hereda de usuario 

use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Cliente extends Model implements JWTSubject
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $transformer = ClienteTransformer::class;

    protected $fillable = [
        'name','lastname', 'email', 'password', 'direction', 'phone', 'carnet'
    ];

    protected $hidden = ['password'];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    

}
