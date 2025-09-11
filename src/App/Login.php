<?php
namespace Src\App;

use League\Plates\Engine;
use Src\Models\Operador;

class Login
{
    private $views;
    public function __construct()
    {
        $this->views = new Engine(__DIR__ . "../../views");

    }

    public function index($data)
    {
        echo $this->views->render("login");
    }

    public function singin($data) {
        $operador = (new Operador())->find("nome=:nome", "nome={$data['nome']}")->fetch();
        
        if(!empty($operador) && password_verify($data['password'],$operador->password)) {
            $_SESSION["operador"] = $operador->nome;
            $_SESSION["operador_id"] = $operador->id;
            
            if($operador->isadmin > 0) {
                $_SESSION["isadmin"] = 1;
                header("Location:".url('admin'));
                exit;
            }
            header("Location:".url());

        }
        else {
            $_SESSION['error'] = 'Senha ou operador invalidos.';
            header("Location:".url('login'));
            exit;
        }
    }

    public function singout() {
        $_SESSION['operador'] = null;
        $_SESSION['id'] = null;
        $_SESSION['isadmin'] = null;
        session_destroy();
        header("Location:".url());
    }
}