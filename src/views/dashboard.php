<?php $this->layout('__layout') ?>

<div class="d-flex ">
    <div class="p-4 bg-primary rounded">
        <li class=" mt-2 p-1  "><a href="<?= url() ?>">Inicio</a></li>

    </div>
    <div class="p-4 bg-primary rounded ms-2">
        <li class=" mt-2 p-1  "><a href="<?= url('admin/operador/adicionar') ?>">Operador</a></li>
    </div>
    <div class="p-4 bg-primary rounded ms-2">
        <li class=" mt-2 p-1  "><a href="<?= url('admin/registro/filtrar/') ?>">Filtrar</a></li>
    </div>
</div>