<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//En esta parte del codigo definimos las rutas y lo enlazamos con los controladores 
// ademas le pasamos un tercer parametro por el cual le decimos que metodos son los 
//que vamos a usar o descartar

Route::resource('sucursals','Sucursal\SucursalController',['except'=>['create','edit']]);
Route::resource('sucursals.empleados','Sucursal\SucursalEmpleadosController',['only'=>['index']]);

Route::resource('sucursals.pedidos','Sucursal\SucursalPedidosController',['only'=>['index']]);
Route::resource('sucursals.productos','Sucursal\SucursalProductosController',['only'=>['index']]);


Route::resource('clientes','Cliente\ClienteController',['except'=>['create','edit']]);
Route::resource('cliente.pedidos','Cliente\ClientePedidosController',['only'=>['index']]);
Route::resource('cliente.reservas','Cliente\ClienteReservasController',['only'=>['index']]);

Route::resource('empleados','Empleado\EmpleadoController',['except'=>['create','edit']]);
Route::resource('empleado.pedidos','Empleado\EmpleadoPedidosController',['only'=>['index']]);

Route::resource('pedidos','Pedido\PedidoController',['except'=>['create','edit']]);
Route::resource('pedido.cliente','Pedido\PedidoClienteController',['only'=>['index']]);
Route::resource('pedido.empleado','Pedido\PedidoEmpleadoController',['only'=>['index']]);
Route::resource('pedido.productos','Pedido\PedidoProductosController',['only'=>['index','store']]);

Route::resource('reservas','Reserva\ReservaController',['except'=>['create','edit']]);

Route::resource('proveedores','Proveedor\ProveedorController',['except'=>['create','edit']]);
Route::resource('proveedor.productos','Proveedor\ProveedorProductosController',['only'=>['index']]);

Route::resource('categorias','Categoria\CategoriaController',['except'=>['create','edit']]);
Route::resource('categoria.productos','Categoria\CategoriaProductosController',['only'=>['index']]);

Route::resource('productos','Producto\ProductoController',['except'=>['create','edit']]);
Route::resource('producto.categoria','Producto\ProductoCategoriaController',['only'=>['index']]);
Route::resource('producto.proveedor','Producto\ProductoProveedorController',['only'=>['index']]);
/*
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'ClienteController@login');
    Route::post('logout', 'ClienteController@logout');
    Route::post('refresh', 'ClienteController@refresh');
    Route::post('me', 'ClienteController@me');
});*/
 
