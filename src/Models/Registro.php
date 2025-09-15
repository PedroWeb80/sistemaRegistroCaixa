<?php

namespace Src\Models;   

use CoffeeCode\DataLayer\DataLayer;

class Registro extends DataLayer {
    public function __construct(){
        parent::__construct("registros",['criado','operador_id'],"id",false);

    }

    public function add(Operador $operador, string $dinheiro, float $cartao, string $criado): Registro{
        $this->operador_id = $operador->id;
        $this->dinheiro = $dinheiro;
        $this->cartao = $cartao;
        $this->criado = $criado;
        return $this;
    }

    public function operador() {
        return (new Operador)->findById($this->operador_id);
    }

    public function saidas() {
        return (new Saida())->find("registro_id=:uid", "uid={$this->id}")->fetch(true);
    }
    
}