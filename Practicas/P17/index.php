<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require './vendor/autoload.php';
$app = AppFactory::create();
$app->setBasepath("/tecweb/Practicas/P17");

$app-> get ('/',function($request,$response, $argc) {

    $response->getBody()->write("Hola Mundo SLIM");
return  $response;

});
/* pasar parametros */
$app->get("/hola[/{nombre}]", function($request, $response,$argc )  { 
    $response->getBody()->write("Hola,".$argc["nombre"]);
    return  $response;

     
});

$app->post("/pruebapost", function($request, $response,$argc){
$reqPost=$request->getParsedBody();
$val1=$reqPost["val1"];
$val2=$reqPost["val2"];
$response->getBody()->write("valores:". $val1."". $val2);
return $response;
});

$app->get("/testjson",function ($request, $response,$argc){
$data[0]["nombre"]="Jose";
$data[0]["apellidos"]="Saldaña Nava";
$data[1]["nombre"]="Gabriel";
$data[1]["apellidos"]="Saldaña Nava";
$response->getBody()->write(json_encode($data,JSON_PRETTY_PRINT));
return $response;
});


$app->run();

?>