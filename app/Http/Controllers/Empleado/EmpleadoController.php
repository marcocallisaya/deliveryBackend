<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\EmpleadoTransformer;

class EmpleadoController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('transform:' . EmpleadoTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $empleados = Empleado::all();

        return $this->showAll($empleados,200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:clientes',
            'password' => 'required|min:6', 
            'direction' => 'required', 
            'phone' => 'required', 
            'carnet' => 'required',
            'position'=> 'required',
            'sucursal_id' => 'required'
        ];

    $this->validate($request,$rules);

    $data = $request->all();

    $data['password'] = bcrypt($request->password);

    $empleado = Empleado::create($data);
    
    $empleado->save();

    return $this->showOne($empleado,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        return $this->showOne($empleado,200);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->all();

        if ($request->has('password'))
        {
            $data['password'] = bcrypt($request->password);
        }

        $empleado->fill($data);

        if ($empleado->isClean())
        {
            return $this->errorResponse('Debes actualizar algun campo',404);
        }

        $empleado->save();

        return $this->showOne($empleado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return $this->showOne($empleado);
    }
//-------------------------------------------->>>-->-<-->-->


     /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('app')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->guard('app')->user());
    }
    public function payload()
    {
        return response()->json(auth()->guard('app')->payload());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('app')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('app')->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('app')->factory()->getTTL() * 60,
            'user' => auth()->guard('app')->user(),
        ]);
    }

    
}
