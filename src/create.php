<?php
require __DIR__ ."../../vendor/autoload.php";
use Src\Models\Operador;
use Src\Models\Saida;

// criar usuario
// $operador = new Operador();
// $operador->nome = "Pedro Daniel";
// $operador->isadmin = 0;
// $operador->password = "132314";
// $operador->save();

// $saida = new Saida();
// $saida->add($operador,"vale de seu andre",185.96,"25-09-05");
// $saida->save();

$operador = (new Saida())->findById(6);

$operador->destroy();