<?php

use CoffeeCode\Router\Router;
use Src\App\Web;
require __DIR__ ."/vendor/autoload.php";
session_start();

$router = new Router(BASE_URL);

//CONTROLLERS
$router->namespace("Src\App");

/**
 * WEB
 * index
 * 
 */
$router->group(null);
$router->get("/", "Web:index");


/**
 * WEB
 * registrar
 * 
 */

$router->post("/registro/novo", "Web:newRegister");
$router->get("/registro/editar/{criado}", "Web:editRegister");

/***
 * WEB
 * addRegisterOUT
 */
$router->post("/registro/editar","Web:addRegisterOut");

/****
 * LOGIN
 * index
 */
$router->group("login");
$router->get("/","Login:index");
$router->post("/","Login:singin");
$router->get("/sair","Login:singout");



/****
 * ADMIN
 * index
 */
$router->group("admin");
$router->get("/","Admin:index");


/****
 * ADMIN
 * criarOperador
 */
$router->get("/operador/adicionar","Admin:AddOperador");
$router->post("/operador/adicionar","Admin:saveNewOperador");












/***
 * ERROR
 */
$router->group("error");
$router->get("/{errcode}","Web:error");



$router->dispatch();


if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}


/***
 * passando parametros para filtrar dados pelo controller
 */
// $router->get("/{filter}","Web:index");
// $router->get("/{filter}/{page}","Web:index");

// $router->group("ops");
// $router->get("/{errcode}", function($data) {
//     echo "<h1>Erro: {$data["errcode"]}</h1>";
// });


// $router->group(null);
// $router->get("/", function($data) {
//     $operador = new Operador();
   
//     echo $operador->findById(1)->nome;
// });