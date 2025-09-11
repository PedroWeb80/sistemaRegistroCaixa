<?php
$this->layout('__layout')
    ?>

<div class="">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="">
            <p class="text-warning"><?= $_SESSION['error'] ?></p>
            <?php $_SESSION['error']='' ?>
        </div>
    <?php endif ?>
    <fieldset class=" rounded bg-custom p-4 col-10 mt-5 mx-auto">

        <h3 class="">Adicionar operador</h3>

        <form action="<?= url('admin/operador/adicionar') ?>" method="post" class="form-group">
            <div class="col-6">
                <label for="">Nome:</label>
                <input type="text" class="form-control" value="" name="nome"  placeholder="Nome do operador" required>
            </div>
            <div class="mt-3 col-6">
                <label for="">Password:</label>
                <input type="password" class="form-control" value="" name="password" required
                    placeholder="senha do operador">
            </div>
            <div class="mt-3">
                <label for="">Administrador:</label>
                <input type="checkbox" class="checkbox" value="" name="isadmin[]" >
            </div>

            <button class="  mt-3 btn btn-dark  ">Adicionar</button>
        </form>
    </fieldset>

    <div class=" bg-custom rounded pb-3 p-2 mt-4">
    <table class="rounded">
        <thead class="">
            <th scope="col">Id:</th>
            <th scope="col">Operador:</th>
            <th scope="col">Admin:</th>
        </thead>
        <tbody>

            <?php if ($operadores): ?>
                <?php foreach ($operadores as $operador): ?>
                    <tr>
                        <td><?= $operador->id ?></td>
                        <td><?= $operador->nome; ?></td>
                        <td><?= $operador->isadmin?'SIM':'NÃO'; ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <?= "<h2>Sem operador de saídas</h2>" ?>
            <?php endif ?>



        </tbody>
    </table>
</div>
</div>