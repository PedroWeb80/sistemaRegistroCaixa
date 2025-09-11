<?php
require __DIR__ ."../../vendor/autoload.php";
use Src\Models\Operador;



$operador = new Operador();
$list = $operador->find()->fetch(true);

foreach ($list as $item) {
    var_dump($item->data());
    //var_dump($item->saidas());
    foreach ($item->saidas() as $saida){
        var_dump($saida->data());
    }
}