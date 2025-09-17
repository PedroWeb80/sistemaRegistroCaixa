<?php $this->layout('__layout') ?>

<div class="d-flex bg-custom p-4 rounded">
    
        <a class="btn btn-success " href="<?= url('admin/operador/adicionar') ?>">Adicionar operador</a>
    
    
        <a class="btn btn-success  ms-2" href="<?= url('admin/registro/filtrar/') ?>">Filtrar saídas por data</a>
        <a class="btn btn-success  ms-2" href="<?= url('admin/registro/filtrar/') ?>">Filtrar saídas por descrição</a>
    
</div>

<form action="<?= url('admin') ?>" method="post" class="form-group">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="">
            <p class="text-warning"><?= $_SESSION['error'] ?></p>
            <?php $_SESSION['error'] = '' ?>
        </div>
    <?php endif ?>
    <?php if (!$operador_active): ?>
        <h3>Conferência de caixa</h3>
        <div class="d-flex p-4 bg-custom mt-4 mb-4 rounded">
        

            <div>
                <label for="">Operador:</label>
                <select required class="form-select " aria-label="Default select example" name="operadorSelect">
                    
                    <?php foreach ($operadores as $operador): ?>
                        <option value="<?= $operador->id ?>"><?= $operador->nome ?></option>
                    <?php endforeach ?>

                </select>
            </div>
            <div class="ms-3 ">
                <label for="">Data do registro:</label>
                <input type="date" class="form-control" value="" name="register_data" required />

            </div>

            <div>
                <button class="mt-4 ms-3 btn btn-success  ">Pesquisar</button>
            </div>

        </div>
    <?php endif ?>

    <?php if ($operador_active != null): ?>

        <fieldset class="mb-4 bg-custom pb-4 p-3 text-ligth rounded ">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="">
                    <p class="text-warning"><?= $_SESSION['error'] ?></p>
                    <?php $_SESSION['error'] = '' ?>
                </div>
            <?php endif ?>
            <legend class="text-light">Informações operador:</legend>
            <form action="<?= url('registro/novo') ?>" method="post">
                <div class="col">
                    <div class="row">
                        <div class="col-6">
                            <label for="ioperador">Nome Operador:</label>
                            <input type="text" value="<?= $operador_active->nome ? $operador_active->nome : "" ?>"
                                name="nome" id="ioperador" disabled class="form-control col" placeholder="Nome operador..">
                        </div>

                        <div class="col-2">
                            <label for="idata">Data da Saída:</label>
                            <input type="date" value="<?= isset($registro) ? $registro->criado : '' ?>" name="criado"
                                id="idata" class="form-control col" placeholder="valor em cartão" disabled>

                        </div>
                        <div class="col-2 mt-4">
                            <a class="btn btn-success" href="<?= url('admin') ?>">VOLTAR</a>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-2 mr-5">
                            <label for="idinheiro">Valor em dinheiro:</label>
                            <input type="text" value="<?= $registro ? str_replace('.', ',', $registro->dinheiro) : '' ?>"
                                name="dinheiro" id="idinheiro" disabled class="form-control"
                                placeholder="Valor em dinheiro">
                        </div>

                        <div class="col-2">
                            <label for="icartao">Valor em cartão</label>
                            <input type="text" value="<?= $registro ? str_replace('.', ',', $registro->cartao) : '' ?>"
                                name="cartao" id="icartao" class="form-control col" placeholder="valor em cartão" disabled>
                        </div>
                    </div>


            </form>
        </fieldset>

        <div class=" bg-custom rounded pb-3 p-2">
            <?php $total = 0?>
            <table class="rounded">
                <thead class="">
                    <th scope="col">Id:</th>
                    <th scope="col">Descrição:</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Criado em:</th>
                    <th scope="col"></th>
                </thead>
                <tbody>

                    <?php if ($registro->saidas()): ?>
                        <?php foreach ($registro->saidas() as $saida): ?>
                            <tr>
                                <td><?= $saida->id ?></td>
                                <td>R$ <?= $saida->descricao ?></td>
                                <td>R$ <?= str_replace(".", ",", $saida->valor) ?></td>
                                <td><?= date('d/m/Y', strtotime($registro->criado)) ?></td>
                                <?php $total += $saida->valor?>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?= "<h2>Sem registro de saídas</h2>" ?>
                    <?php endif ?>



                </tbody>
                <h3 class="  rounded p-2 col-3 bg-primary"><?="Total R$".str_replace('.',',',$total)?></h3>
            </table>
        </div>
    <?php endif ?>