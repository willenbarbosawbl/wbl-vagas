<?php
    require __DIR__."/vendor/autoload.php";

    use \App\Entity\Usuario;
    use \App\Session\Login;
    //OBRIGA O USUÁRIO A NAO ESTAR LOGADO
    Login::requireLogout();

    //MENSAGEM DE ALERTA DOS FOMULARIOS
    $alertLogin     = '';
    $alertRegister  = '';

    if (isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'logar':

                //BUSCA USUÁRIO POR E-MAIL
                $obUsuario = Usuario::getUserForEmail(addslashes($_POST['email']));
                if (!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)){
                    $alertLogin = 'E-mail ou senha inválidos!';
                    break;
                }
                Login::login($obUsuario);
                //echo '<pre>'; print_r($obUsuario); echo '</pre>'; exit;
            break;
            case 'cadastrar':

                //BUSCA USUÁRIO POR E-MAIL
                $obUsuario = Usuario::getUserForEmail(addslashes($_POST['email']));
                if ($obUsuario instanceof Usuario){
                    $alertRegister = 'O e-mail digitado já está em uso.';
                    break;
                }

                // VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
                if (isset($_POST['nome'],$_POST['email'], $_POST['senha'])){
                    $obUsuario          = new Usuario;
                    $obUsuario->name    = addslashes($_POST['nome']);
                    $obUsuario->email   = addslashes($_POST['email']);
                    $obUsuario->senha   = password_hash(addslashes($_POST['senha']), PASSWORD_DEFAULT);
                    $obUsuario->register();
                    //LOGA USUARIO REGISTRADO
                    Login::login($obUsuario);
                    //echo '<pre>'; print_r($obUsuario); echo '</pre>'; exit;
                }
            break;
        }
    }

    include __DIR__."/includes/header.php";
    include __DIR__."/includes/formulario-login.php";
    include __DIR__."/includes/footer.php";