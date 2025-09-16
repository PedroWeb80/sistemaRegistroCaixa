<?php
namespace Src\App;

use League\Plates\Engine;
use Src\Models\Operador;
use Src\Models\Registro;
use Src\Models\Saida;
class Web
{
    private $views;
    public function __construct()
    {
        $this->views = new Engine(__DIR__ . "../../views");

        if (!$_SESSION['operador_log']) {
            header("Location: " . url('login'));
        }

    }

    public function index($data)
    {
        //echo "<h1>Páigina inicial...</h1>";
        $id = $_SESSION['operador_log_id'] ? $_SESSION['operador_log_id'] : '';

        $registros = (new Registro())->find("operador_id = :uid", "uid={$id}")->order("id DESC")->limit(15)->fetch(true);

        $this->views->addData(['title' => "Registro de saídas"]);

        echo $this->views->render('index', [
            'registros' => $registros ? $registros : [],
            'operador' => $_SESSION['operador_log'] ? $_SESSION['operador_log'] : '',

        ]);


    }

    public function newRegister($data)
    {
        // var_dump($data);
        // die();
        $operador_id = $_SESSION['operador_log_id'] ? $_SESSION['operador_log_id'] : '';

        $registro = new Registro();

        //testa se o campo de data está preenchido para poder criar um novo registro
        if ($data['criado']) {

            $registro->add(
                (new Operador())->findById($operador_id),
                isset($data['dinheiro']) ? $this->convertToFloat($data['dinheiro']) : 0,
                isset($data['cartao']) ? $this->convertToFloat($data['cartao']) : 0,
                $data['criado'],
            );


            if ($registro->save()) {
                $_SESSION['error'] = 'Cadastro realizado com sucesso!';
                header("Location: http://localhost/sistemacaixa/registro/editar/{$registro->criado}");
                exit;
            } else {
                $_SESSION['error'] = $registro->fail()->getMessage();
                header('Location: http://localhost/sistemacaixa/');
                exit;
            }


        } else {
            $_SESSION['error'] = "O campo data é obrigatório";
            header('Location: http://localhost/sistemacaixa/');
            exit;
        }


    }

    public function editRegister($data)
    {
        //apresenta tela de edição de registro e adiçãop de saídas
        $id = $_SESSION['operador_log_id'] ? $_SESSION['operador_log_id'] : '';

        $registro = (new Registro())->find("operador_id = :uid AND criado = :criado", "uid={$id}&criado={$data['criado']}")->fetch();
        $saidas = (new Saida())->find("registro_id = :uid", "uid={$registro->id}")->order("id DESC")->fetch(true);
        $this->views->addData(['title' => "Registro de saídas"]);


        echo $this->views->render('editRegister', [
            'registro' => $registro ? $registro : null,
            'operador' => $_SESSION['operador_log'] ? $_SESSION['operador_log'] : '',
            'saidas' => isset($saidas) ? $saidas : []

        ]);
    }

    public function addRegisterOut($data)
    {
        //salva no banco de dados registro e saidas
        $registro = (new Registro())->findById($data['registro_id']);
       

        if (empty($data['descricao']) && empty($data['valor'])) {
            $_SESSION['error'] = 'Campos não podem estar vazios';
            header("Location: http://localhost/sistemacaixa/registro/editar/" . $registro->criado);
        } else {
            $saida = new Saida();
            $saida->add(
                (new Registro)->findById($data['registro_id']),
                $data['descricao'],
                $this->convertToFloat($data['valor'])
            );

            if (!$saida->save()) {
                $_SESSION['error'] = $saida->fail()->getMessage();
                header("Location: http://localhost/sistemacaixa/registro/editar/" . $registro->criado);
                exit;
            } else {
                $_SESSION['error'] = "Saida cadastrada com sucesso!";
                header("Location: http://localhost/sistemacaixa/registro/editar/" . $registro->criado);
                exit;
            }
        }


    }

    public function editValueRegister($data)
    {
        //salva no banco de dados registro e saidas
        $registro = (new Registro())->findById($data['registro_id']);
        $registro->dinheiro = $this->convertToFloat($data['dinheiro']);
        $registro->cartao = $this->convertToFloat($data['cartao']);
        // var_dump($data);
        // var_dump($registro);

        if (!$registro->save()) {
            $_SESSION['error'] = $registro->fail()->getMessage();
        }

        $_SESSION['error'] = "Registro editado com sucesso!";
        header("Location: http://localhost/sistemacaixa/registro/editar/" . $registro->criado);
        exit;
    }
    public function deleteRegisterOut($data)
    {
        //deleta uma saida
        $saida = (new Saida())->findById($data['saida_id']);
        $registro_ativo = $saida->registro()->criado;

        if ($saida->destroy()) {
            $_SESSION['error'] = "Saida deletada!";
            header("Location: http://localhost/sistemacaixa/registro/editar/" . $registro_ativo);
            exit;
        }
        else{
            $_SESSION["error"] = $saida->fail->getMessage;
            header("Location: http://localhost/sistemacaixa/registro/editar/" . $registro_ativo);
            exit;
        }
    }
    public function error($data)
    {
        echo "<h1>oooops um erro aconteceu, código {$data["errcode"]}</h1>";
    }

    private function convertToFloat(string $value): float
    {
        return floatval(str_replace(",", ".", $value));

    }


}