<?php
namespace Src\App;

use League\Plates\Engine;
use Src\Models\Operador;
use Src\Models\Registro;
use Src\Models\Saida;

class Admin
{
    private $views;


    public function __construct()
    {
        $this->views = new Engine(__DIR__ . "../../views");
        if (!isset($_SESSION['operador']) || !isset($_SESSION['isadmin'])) {
            header('Location:' . url('unauthorized'));
            exit;
        }



    }
    public function index($data)
    {
        $this->views->addData(['title' => "área de administrador"]);
        echo $this->views->render('dashboard', []);
    }

    public function addOperador($data)
    {

        $operadores = (new Operador())->find()->fetch(true);

        $this->views->addData(['title' => "adicionar operador"]);
        echo $this->views->render("AddOperador", [

            'operadores' => $operadores,

        ]);
    }

    public function saveNewOperador($data)
    {
        $operador = new Operador();

        if ($data['nome'] && $data['password']) {
            $operador->nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
            $operador->password = password_hash($data['password'], PASSWORD_BCRYPT);
            $operador->isadmin = isset($data['isadmin']) ? 1 : 0;


            if ($operador->save()) {
                $_SESSION['error'] = 'Cadastro realizado com sucesso!';
                header('Location: http://localhost/sistemacaixa/admin/operador/adicionar');
            } else {
                $_SESSION['error'] = $operador->fail()->getMessage();
                header('Location: http://localhost/sistemacaixa/admin/operador/adicionar');
            }

        } else {
            $_SESSION['error'] = "Campos devem está preenchidos!";
            header('Location: http://localhost/sistemacaixa/admin/operador/adicionar');
        }

    }

    public function filterRegisters($data)
    {

        $operadores = (new Operador())->find()->fetch(true);

         $this->views->addData(['title' => "Filtrar saídas"]);
        echo $this->views->render('filterRegisters', [
            'operadores' => isset($operadores) ? $operadores : [],
            
        ]);
    }
    public function filterRegistersPost($data)
    {
         $this->views->addData(['title' => "Filtrar saídas"]);

        $registros = null;
        if ($data) {
            $inicio = $data['inicio'];
            $fim = $data['fim'];
            $operador = $data['operador'];
            
            $registros = (new Registro())
                ->find(
                    "operador_id = :uid AND criado BETWEEN :inicio AND :fim",
                    "uid={$operador}&inicio={$inicio}&fim={$fim}"
                )
                ->fetch(true);

        }
        $saidas = [];
        if (!isset($registros)) {
            $_SESSION["error"] = "NÃO Á REGISTRO PARA ESSE INTERVALO DE DATAS";

        } else {
            foreach ($registros as $registro) {
                if ($registro->saidas()) {
                    foreach ($registro->saidas() as $saida) {
                        array_push($saidas, $saida);
                    }
                }

            }
        }
        $operadores = (new Operador())->find()->fetch(true);
        echo $this->views->render('filterRegisters', [
            'operadores' => isset($operadores) ? $operadores : [],
            'saidas' => $saidas,
            'operador' => (new Operador())->findById($data['operador'])
            
        ]);


    }

}