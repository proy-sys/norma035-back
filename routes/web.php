<?php


 //$verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE'];
 // $router->patch($uri.'/{id}', $controller.'@update')->name('update'); se puede implementar esta ruta en caso de ser necesario.
 //$router->patch($uri.'/{id}', $controller.'@update');


function resourceEmpresa($uri, $controller, $router)
{
    $router->get($uri,$controller.'@index');
    $router->get($uri.'/listaEmpresas',$controller.'@listaEmpresas');
    $router->get($uri.'/{id}/listaPoliticas',$controller.'@listaPoliticas');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->put($uri.'/{id}', $controller.'@update');  

}

function resourceTrabajador($uri, $controller, $router)
{

    $router->get($uri.'/cantidad',$controller.'@getNumeroTrabajadores');
    $router->get($uri,$controller.'@index');
    $router->post($uri, $controller.'@store');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy');  
}

function resourcePolitica($uri, $controller, $router)
{
    
    $router->get($uri.'/verificarEstado', $controller.'@verificarEstado');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->get($uri.'/{id}/setPolitica', $controller.'@asignarPolitica');
    $router->get($uri,$controller.'@listadoPoliticas');
    $router->post($uri, $controller.'@store');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy');

}

function resourceActividad($uri, $controller, $router)
{
    $router->get($uri,$controller.'@index');
    $router->post($uri, $controller.'@store');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy');

}

function resourceDocumento($uri, $controller, $router)
{
    $router->get($uri,$controller.'@index');
    $router->post($uri, $controller.'@store');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy');

}

function resourceGuia($uri, $controller, $router)
{
    $router->get($uri,$controller.'@index');
    $router->post($uri, $controller.'@store');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->put($uri.'/{id}', $controller.'@update');
    $router->delete($uri.'/{id}', $controller.'@destroy'); 
}

function resourceSugerencia_Queja($uri, $controller, $router)
{
    $router->post($uri, $controller.'@store');
    $router->get($uri,$controller.'@listadoSugerencia_Queja');
    $router->get($uri.'/{id}', $controller.'@show');
    $router->get($uri.'/{id}/{status}', $controller.'@setStatus');
}

function resourceRespuesta($uri, $controller, $router)
{
     $router->get($uri,$controller.'@index');
     $router->post($uri, $controller.'@store');
}

//ruta prinicipal.
$router->get('/', function () use ($router) {
    return "conectado";
});



//rutas login
$router->post('/users','AuthController@store');  
$router->post('/login','AuthController@login');
$router->post('/user','AuthController@userActive');


//rutas admin
//$router->group(['middleware' => 'auth'], function () use ($router) {
    resourceEmpresa('/empresa','EmpresaController',$router);
    resourceTrabajador('/trabajador','TrabajadorController',$router);
    resourcePolitica('/politica','PoliticaController',$router);
    resourceActividad('/actividad','ActividadController',$router);
    resourceGuia('/guia','GuiaController',$router);
    resourceDocumento('/documento','DocumentoController',$router);
    resourceSugerencia_Queja('/sugerencia_queja','SugerenciaQuejaController',$router);
    resourceRespuesta('/respuesta','RespuestasController',$router);
    //ruta de actualizaciones
    
    //ruta de salida
    $router->post('/logout','AuthController@logout');

//});









