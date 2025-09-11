<?php

namespace Src\Models;   

use CoffeeCode\DataLayer\DataLayer;

class Saida extends DataLayer {
    public function __construct(){
        parent::__construct("saidas",["registro_id","descricao","valor"],"id",false);
        
    }
    

    public function add(Registro $registro, string $descricao, float $valor): Saida{
        $descricao = str_replace(",",".", $descricao);
        
        $this->registro_id = $registro->id;
        $this->descricao = $descricao;
        $this->valor = $valor;
        
        return $this;
    }

    public function registro ():Registro {
        return (new Registro() )->find("id=:uid","uid={$this->registro_id}")->fetch();
    }

}