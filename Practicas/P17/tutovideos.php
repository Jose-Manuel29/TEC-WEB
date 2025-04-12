<?php

require  'vendor/autoload.php';


$app = new Slim\App();

$app-> get ('/',function($request,$response, $argc) {

$response->write("Hola Mundo SLIM");
return  $response;

});
/* pasar parametros */
$app->get("/hola[/{nombre}]", function($request, $response,$argc )  { 
    $response->write("Hola,".$argc["nombre"]);
    return  $response;

     
});

$app->post("/pruebapost", function($request, $response,$argc){
$reqPost=$request->getParsedBody();
$val1=$reqPost["val1"];
$val2=$reqPost["val2"];
$response->write("valores:". $val1."". $val2);
return $response;
});


$app->run();

?>