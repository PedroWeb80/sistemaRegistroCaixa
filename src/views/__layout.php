<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= url('src/views/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('src/views/css/stylecustom.css') ?>">
</head>

<body style="background-color:#051f45;" class="text-light">

    <div class="container-fluid">
        <div class="row">
            <aside class="col bg-custom rounded mt-1 ms-3 p-1">
                
                <ul class="list-group ">
                    <li class=""><a href="<?= url() ?>"><img width="80px" class="rounded " src="<?= url('src/views/img/logo.jpg') ?>" alt="ponto certo"></a></li>
                    <li class=" mt-2 p-1  "><a href="<?= url() ?>">Inicio</a></li>
                </ul>
            </aside>
            
            <div class="col-11">
                <div class="bg-custom p-3 rounded mb-2 d-flex">
                    
                    <h3 class="m-2 text-aling-center">Registro Saídas Caixa</h3>

                </div>

                <?= $this->section('content') ?>
            </div>

            
        </div>
        
    </div>
    <footer class="bg-custom p-5 mt-5">Todos diretos reservados: <a href="pedro.gtx@gmail.com">Pedro Daniel</a></footer>

    <script src="<?= url('src/views/js/bootstrap.min.js') ?>"></script>
</body>


</footer>
</html>