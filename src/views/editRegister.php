<?php
$this->layout('__layout') ?>

<fieldset class="mb-4 bg-custom pb-4 p-3 text-ligth rounded ">
    <legend class="text-light">Informações operador:</legend>
    <?php if(isset($_SESSION['error'])):?>
    <div class="">
        <p class="text-warning"><?= $_SESSION['error'] ?></p>
        <?php $_SESSION['error'] = '' ?>
    </div>
    <?php endif?>
    <div class="col-2 mt-4">
        <a href="<?= url()?>" class="btn btn-success">Novo Registro</a>
    </div>
    <form action="<?= url('registro/editar') ?>" method="post">
        <input type="hidden" name="registro_id" value="<?= $registro->id ?>">
        <div class="col">
            <div class="row">
                <div class="col-6">
                    <label for="ioperador">Nome Operador:</label>
                    <input type="text" value="<?= $operador ? $operador : '' ?>" name="nome" id="ioperador" disabled
                        class="form-control col" placeholder="Nome operador..">
                </div>

                <div class="col-2">
                    <label for="idata">Data da Saída:</label>
                    <input type="date" value="<?= $registro ? $registro->criado : '' ?>" name="criado" id="idata"
                        class="form-control col">

                </div>


            </div>
            <div class="row mt-3">
                <div class="col-2 mr-5">
                    <label for="idinheiro">Valor em dinheiro:</label>
                    <input type="text" value="<?= $registro ? $registro->dinheiro : '' ?>" name="dinheiro"
                        id="idinheiro" class="form-control" placeholder="Valor em dinheiro">
                </div>

                <div class="col-2">
                    <label for="icartao">Valor em cartão</label>
                    <input type="text" value="<?= $registro ? $registro->cartao : '' ?>" name="cartao" id="icartao"
                        class="form-control col" placeholder="valor em cartão">
                </div>
            </div>
            <div class="row mt-5">
                <label class="">
                    <h4>Adicionar registro de saída:</h4>
                </label>
                <div class="col">
                    <label for="idescricao">Descrição:</label>
                    <input type="text" id="idescricao" name="descricao" value="" class="form-control"
                        placeholder="Descrição da saída.." required>
                </div>
                <div class="col">
                    <label for="ivalor">Valor:</label>
                    <input type="text" id="ivalor" name="valor" value="" class="form-control"
                        placeholder="Valor da saída" required>
                </div>
                <div class="col mt-4">
                    <button class="btn btn-dark">Registrar Saída</button>
                </div>
            </div>
        </div>

    </form>
</fieldset>

<div class=" bg-custom rounded pb-3 p-2">
    <table class="rounded">
        <thead class="">
            <th scope="col">Id:</th>
            <th scope="col">Descrição:</th>
            <th scope="col">Valor:</th>
            <th scope="col">Criado em:</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </thead>
        <tbody>

            <?php if ($saidas): ?>
                <?php foreach ($saidas as $saida): ?>
                    <tr>
                        <td><?= $saida->id ?></td>
                        <td><?= $saida->descricao; ?></td>
                        <td>R$ <?= str_replace(".", ",", $saida->valor) ?></td>
                        <td><?= date('d/m/Y', strtotime($saida->registro()->criado)) ?></td>
                        <td>
                            <button class="btn btn-success" type="button">Editar</button>
                            <button class="btn btn-danger" type="button">Excluir</button>
                        </td>

                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <?= "<h2>Sem registro de saídas</h2>" ?>
            <?php endif ?>



        </tbody>
    </table>
</div>