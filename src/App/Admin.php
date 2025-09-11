<?php
namespace Src\App;

use League\Plates\Engine;
use Src\Models\Operador;

class Admin {
    private $views;
    

    public function __construct(){
        $this->views = new Engine(__DIR__ ."../../views");
        if(!isset($_SESSION['operador']) && !isset($_SESSION['isadmin'])){
            header('Location:'.url('login'));
            exit;
        }
        
    }
    public function index($data) {
        echo"Bem vindo administrador ".$_SESSION['operador']." ".$_SESSION['operador_id'];
        echo"<a href='http://localhost/sistemacaixa/login/sair'>Logout</a>";
    }

    public function addOperador($data) {
        
        $this->views->addData(['title' => "adicionar operador"]);
        echo $this->views->render("AddOperador", [
            []
        ]);
    }

    public function saveNewOperador($data) {
        $operador = new Operador();

        if($data['nome'] && $data['password']) {
            $operador->nome = trim(filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING));
            $operador->password = password_hash($data['password'], PASSWORD_BCRYPT);
            $operador->isadmin = isset($data['isadmin'])?1:0;
            
            
            if($operador->save()) {
                $_SESSION['error'] = 'Cadastro realizado com sucesso!';
                header('Location: http://localhost/sistemacaixa/admin/operador/adicionar');
            }
            else {
                $_SESSION['error'] = $operador->fail()->getMessage();
                header('Location: http://localhost/sistemacaixa/admin/operador/adicionar');
            }
           
        }
        else{
             $_SESSION['error'] = "Campos devem está preenchidos!";
                header('Location: http://localhost/sistemacaixa/admin/operador/adicionar');
        }
        
    }
}