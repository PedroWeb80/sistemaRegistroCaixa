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
        if (!isset($_SESSION['operador_log']) || !isset($_SESSION['isadmin'])) {
            header('Location:' . url('unauthorized'));
            exit;
        }



    }
    public function index($data)
    {
        $this->views->addData(['title' => "área de administrador"]);

        $operadores = (new Operador())->find()->fetch(true);

        echo $this->views->render('dashboard', [
            'operadores' => $operadores,
            'operador_active' => null
        ]);
    }

    public function checkCashRegister($data)
    {
        $operador_active = null;
        $registro = null;
        $operadorSelect = $data['operadorSelect'];
        $register_data = $data['register_data'];

        if ($data['operadorSelect'] && $register_data) {
            $operador_active = (new Operador())->findById($data['operadorSelect']);
            $registro = (new Registro())
                ->find("operador_id=:uid AND criado = :data", "uid={$operador_active->id}&data={$register_data}")
                ->fetch();
            if (!isset($registro)) {
                $_SESSION['error'] = 'sem registro neste dia';
                header("Location:" . url('admin'));
                exit;
            }
        } else {
            $_SESSION['error'] = 'operador não selecionado';
            header("Location:" . url('admin'));
            exit;
        }


        $this->views->addData(['title' => "Conferir caixa"]);
        echo $this->views->render('dashboard', [
            'operador_active' => $operador_active,
            'registro' => $registro,
        ]);
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
            $operadorSelect = $data['operadorSelect'];

            $registros = (new Registro())
                ->find(
                    "operador_id = :uid AND criado BETWEEN :inicio AND :fim",
                    "uid={$operadorSelect}&inicio={$inicio}&fim={$fim}"
                )
                ->fetch(true);

        }
        $saidas = [];
        if (!isset($registros)) {
            $_SESSION["error"] = "NÃO Á REGISTRO PARA ESSE INTERVALO DE DATAS";

        } else {
            if ($data['descricao_saida']) {
                foreach ($registros as $registro) {
                    $results = $registro->saidasDescricao(strtolower(trim($data['descricao_saida'])));
                    if (isset($results)) {
                        foreach ($results as $saida) {
                            array_push($saidas, $saida);
                        }
                    }

                }
            } else {
                foreach ($registros as $registro) {
                    if ($registro->saidas()) {
                        foreach ($registro->saidas() as $saida) {
                            array_push($saidas, $saida);
                        }
                    }

                }
            }
        }
        $operadores = (new Operador())->find()->fetch(true);
        
        echo $this->views->render('filterRegisters', [
            'operadores' => isset($operadores) ? $operadores : [],
            'saidas' => $saidas,
            'operadorSelect' => (new Operador())->findById($data['operadorSelect'])

        ]);


    }

    public function filterOutsDescription($data)
    {

        $operadores = (new Operador())->find()->fetch(true);

        $this->views->addData(['title' => "Filtrar saídas"]);
        echo $this->views->render('filterRegisters', [
            'operadores' => isset($operadores) ? $operadores : [],

        ]);
    }

}