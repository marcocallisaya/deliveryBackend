<?php

namespace App\Http\Controllers\Cliente;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\ClienteTransformer;


class ClienteController extends ApiController
{
    public function __construct()
    {
       // $this->middleware('guest:empleados')->except('logout');
       // $this->middleware('auth:empleados');
        $this->middleware('transform:' . ClienteTransformer::class)->only(['store','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return $this->showAll($clientes,200);
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
            'carnet' => 'required'
        ];

    $this->validate($request,$rules);

    $data = $request->all();

    $data['password'] = bcrypt($request->password);

    $cliente = Cliente::create($data);

    $cliente->save();



    return $this->showOne($cliente,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $this->showOne($cliente,200);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->all();

        if ($request->has('password'))
        {
            $data['password'] = bcrypt($request->password);
        }

        $cliente->fill($data);

        if ($cliente->isClean())
        {
            return $this->errorResponse('Debes actualizar algun campo',404);
        }

        $cliente->save();

        return $this->showOne($cliente);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return $this->showOne($cliente);
    }

     /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
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
        return response()->json(auth()->user());
    }
    public function payload()
    {
        return response()->json(auth()->payload());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}
