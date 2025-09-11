<?php

namespace Src\Models;   

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use PDOException;

class Operador extends DataLayer {
    public function __construct(){
        parent::__construct("operadores",["nome","password"],"id",false);

    }

    public function save(): bool {
        if(
            !$this->validateNome() ||
            !$this->validatePassword() ||
            !parent::save()
            
            ){
            return false;
        }
        
        
        return true;
    }

    protected function validateNome(): bool{

        $operadorByNome = null;
        if(!$this->id) {
            $operadorByNome = $this->find("nome=:nome", "nome={$this->nome}")->count();
        }
        else {
            $operadorByNome = $this->find("nome=:nome AND id != :id", "nome={$this->nome}&id={$this->id}")->count();
        }

        if($operadorByNome) {
            $this->fail = new PDOException("Este nome de operador já existe tente outro nome!"); 
            return false;
        }

        if(empty($this->nome)) {
            
            $this->fail = new PDOException("Nome em branco!"); 
            return false;
        }
        if(mb_strlen($this->nome) <= 3){
             $this->fail = new PDOException("o campo NOME deve conter no minimo 4 letras"); 
            return false;
        }
        return true;
    }

    protected function validatePassword(): bool{
        if(empty($this->password)) {
            
            $this->fail = new PDOException("senha em branco!"); 
            return false;
        }
        return true;
    }

    public function registros(){
        return (new Saida())->find("operador_id=:uid","uid={$this->id}")->fetch(true);
    }
}