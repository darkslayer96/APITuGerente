<?php

use App\Models\Pago;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Create
$router->post('/pagos/newpago', function(Request $request) use ($router){
	$pago = new Pago();
	$pago->cod = $request->input('cod');
	$pago->fechap = $request->input('fechap');
	$pago->pack = $request->pack;
	$pago->mont = $request->input('mont');
	$pago->ci = $request->input('ci');
	$pago->estado = false;

	if($pago->save()){
		return response()->json($pago);
	}else{
			return response()->json("error");
	}



});
//Read
$router->get('/pagos/{cod}', function($cod) use ($router){
	$pago = Pago::where('cod',$cod)->get()->first();
	//$pago->estado = $request->estado;


	//return response()->json("Actualizacion exitosa")
	//if($pago->update()){
		return response()->json($pago);
	//}else{
	//		return response()->json("error");
	//}
});
//Update
$router->post('/pagos/edit/{cod}', function(Request $request,$cod) use ($router){
	$pago = Pago::where('cod',$cod)->get()->first();
	$pago->estado = $request->estado;

	$pago->update();
	return response()->json("Actualizacion exitosa");
	//if($pago->update()){
		//return response()->json($pago);
	//}else{
	//		return response()->json("error");
	//}
});
//Delete