<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Transformers\EmpleadoTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

// el empleado hereda de user
class Empleado extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    const CAJERO = 'Cajero';
    const CONDUCTOR = 'Chofer';

    protected $guard = 'empleados';

    public $transformer = EmpleadoTransformer::class;

    protected $fillable = [
        'name','lastname', 'email', 'password', 'direction', 'phone', 'carnet', 'position','sucursal_id'
    ];

    protected $hidden = ['password','remember_token'];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
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
