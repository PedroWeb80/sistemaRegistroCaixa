<?php $this->layout('__layout') ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="">
        <p class="text-warning"><?= $_SESSION['error'] ?></p>
        <?php $_SESSION['error'] = '' ?>
    </div>
<?php endif ?>
<form action="<?= url('admin/registro/filtrar') ?>" method="post" class="form-group">
    <div class="d-flex p-4">

        <div>
            <label for="">Operador:</label>
            <select class="form-select" aria-label="Default select example" name="operador">
                <option selected>Selecione um operador</option>
                <?php foreach ($operadores as $operador): ?>
                    <option value="<?= $operador->id ?>"><?= $operador->nome ?></option>
                <?php endforeach ?>

            </select>
        </div>
        <div class="ms-3 ">
            <label for="">Inicial:</label>
            <input type="date" class="form-control" value="" name="inicio" required />

        </div>

        <div class="ms-3 ">
            <label for="">Final:</label>
            <input type="date" class="form-control" value="" name="fim" required />
        </div>

        <div>
            <button class="mt-4 ms-3 btn btn-success  ">Pesquisar</button>
        </div>

    </div>

    <div class=" bg-custom rounded pb-3 p-2">
        <?php $total = 0?>
        <table class="rounded">
            <thead class="">

                <th scope="col">Descrição:</th>
                <th scope="col">Valor:</th>
                <th scope="col">Criado em:</th>
                <th scope="col">Operador:</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </thead>
            <tbody>

                <?php if (isset($saidas)): ?>
                    <?php foreach ($saidas as $saida): ?>
                        <tr>

                            <td><?= $saida->descricao; ?></td>
                            <td>R$ <?= str_replace(".", ",", $saida->valor) ?></td>
                            <td><?= date('d/m/Y', strtotime($saida->registro()->criado)) ?></td>
                            <td><?= $operador->nome; ?></td>
                            <?php $total += $saida->valor?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <?= "<h2>Sem registro de saídas</h2>" ?>
                <?php endif ?>



            </tbody>
            <h3 class="  rounded p-2 col-3 bg-primary"><?="Total R$".str_replace('.',',',$total)?></h3>
        </table>

</form>
</fieldset>