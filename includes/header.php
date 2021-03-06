<?php
  use \App\Session\Login;
  $userLogged = Login::getUserForLogged();
  $user = $userLogged ? $userLogged['name'].' <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' : 'Visitante <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>WBL Vagas</title>
  </head>
  <body class="bg-dark text-light">
    <div class="container">
        <div class="jumbotron bg-danger">
            <h1>WBL Vagas</h1>
            <p>Exemplo de CRUD com PHP Orientado a Objetos</p>
            <hr class="border-light">
            <div class="d-flex justify-content-start">
              <?=$user?>
            </div>
            
        </div>