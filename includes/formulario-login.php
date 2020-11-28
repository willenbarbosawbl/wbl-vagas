<?php
    $alertLogin = strlen($alertLogin) ? '<div class="alert alert-danger">'.$alertLogin.'</div>' : '';
    $alertRegister = strlen($alertRegister) ? '<div class="alert alert-danger">'.$alertRegister.'</div>' : '';
?>

<div class="jumbotron text-dark">
    <div class="row">

        <div class="col">

            <form method="post">

                <h2>Login</h2>

                <?=$alertLogin?>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="acao" value="logar" class="btn btn-primary">Entrar</button>
                </div>

            </form>

        </div>
        <div class="col">
        
            <form method="post">

                <h2>Cadastre-se</h2>

                <?=$alertRegister?>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="acao" value="cadastrar" class="btn btn-primary">Cadastrar</button>
                </div>

            </form>

        </div>

    </div>
</div>