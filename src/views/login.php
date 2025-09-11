<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= url('src/views/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('src/views/css/stylecustom.css') ?>">
</head>

<body style="background-color:#051f45;" class="text-light">
    <div class="">

        <fieldset class=" rounded bg-custom p-4 col-4 mt-5 mx-auto">
            <div>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="">
                        <p class="text-warning"><?= $_SESSION['error'] ?></p>
                        <?php $_SESSION['error'] = '' ?>
                    </div>
                <?php endif ?>
            </div>
            <img src="<?= url('src/views/img/logo.jpg') ?>" width="120px" class="rounded mx-auto d-block" />
            <h3 class="text-center">Faça seu Login</h3>

            <form action="<?= url('login') ?>" method="post" class="form-group">
                <div>
                    <label for="">Operador:</label>
                    <input type="text" class="form-control" value="" name="nome" require placeholder="Nome do operador">
                </div>
                <div class="mt-3">
                    <label for="">Password:</label>
                    <input type="password" class="form-control" value="" name="password" require
                        placeholder="senha do operador">
                </div>
                <button class=" form-control mt-3 btn btn-block btn-dark  btn-block">ENTRAR</button>
            </form>
        </fieldset>
    </div>
</body>

</html>