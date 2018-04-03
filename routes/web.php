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


//$router->get('/key', function () use ($router) {
  //  return str_random(32);
//});

$router->group(['middleware' => ['auth']],function () use($router){
$router->post('/pagos/newpago', function(Request $request) use ($router){
	$pago = new Pago();
	$pago->cod = $request->input('cod');
	$pago->pack = $request->pack;
	$pago->mont = $request->input('mont');
	$pago->ci = $request->input('ci');
	$pago->estado = false;
	$pago->api_token = '8fAEhkfVYMQV3IffrlHgo5iimywo2qK8';

	if($pago->save()){
		return response()->json($pago);
	}else{
			return response()->json("error");
	}



});
//Read
$router->get('/pagos/{cod}', function($cod) use ($router){
	$pago = Pago::select('cod','estado','pack','ci','mont')->where('cod',$cod)->get()->first();
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
	$pago->estado = true;
	$pago->fechap = date('Y-m-d H:i:s');
	$pago->update();
	return response()->json("Actualizacion exitosa");
	//if($pago->update()){
		//return response()->json($pago);
	//}else{
	//		return response()->json("error");
	//}
});
});

//Create

//Delete

