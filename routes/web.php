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
    $router->put($uri.'/{id}', $controller.'@update');
    $router->get($uri.'/{id}/{status}', $controller.'@setStatus');
}

function resourceRespuesta($uri, $controller, $router)
{
     $router->get($uri.'/trabajadorResultado/{guia}',$controller.'@trabajadorResultado');
     $router->get($uri.'/g/{id}',$controller.'@trabajadorGuia');
     $router->get($uri.'/gui/{id}/{trab}',$controller.'@trabajadorGui2');
     $router->post($uri.'/addRespuestasGuia/{id}',$controller.'@addRespuestasGuia');
     // ----- Gráficas -------
     $router->get($uri.'/resultadoTotal/{guia}',$controller.'@resultadoTotal');
     // ----- Categorías ------
     $router->get($uri.'/resultadoCategoriaAmb/{guia}',$controller.'@resultadoCategoriaAmb');
     $router->get($uri.'/resultadoCategoriaFac/{guia}',$controller.'@resultadoCategoriaFac');
     $router->get($uri.'/resultadoCategoriaOrg/{guia}',$controller.'@resultadoCategoriaOrg');
     $router->get($uri.'/resultadoCategoriaLid/{guia}',$controller.'@resultadoCategoriaLid');
     $router->get($uri.'/resultadoCategoriaEnt/{guia}',$controller.'@resultadoCategoriaEnt');
     // ----- Domionios ------
     $router->get($uri.'/resultadoDominio1/{guia}',$controller.'@resultadoDominio1');
     $router->get($uri.'/resultadoDominio2/{guia}',$controller.'@resultadoDominio2');
     $router->get($uri.'/resultadoDominio3/{guia}',$controller.'@resultadoDominio3');
     $router->get($uri.'/resultadoDominio4/{guia}',$controller.'@resultadoDominio4');
     $router->get($uri.'/resultadoDominio5/{guia}',$controller.'@resultadoDominio5');
     $router->get($uri.'/resultadoDominio6/{guia}',$controller.'@resultadoDominio6');
     $router->get($uri.'/resultadoDominio7/{guia}',$controller.'@resultadoDominio7');
     $router->get($uri.'/resultadoDominio8/{guia}',$controller.'@resultadoDominio8');
     $router->get($uri.'/resultadoDominio9/{guia}',$controller.'@resultadoDominio9');
     $router->get($uri.'/resultadoDominio10/{guia}',$controller.'@resultadoDominio10');

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









