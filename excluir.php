<?php
    require __DIR__."/vendor/autoload.php";
    use \App\Entity\Vaga;

    define("TITLE", "Confirmar Exclusão da Vaga");

    //echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

    //VALIDAÇÃO DO ID
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || empty($_GET['id']) || is_null($_GET['id'])){
        header('location: index.php?status=error');
        exit;
    }

    //CONSULTA VAGA
    $obVaga = Vaga::getVaga($_GET['id']);
    
    if (!$obVaga instanceof Vaga){
        header('location: index.php?status=error');
        exit;
    }
    

    //VALIDAÇÃO DO POST
    if (isset($_POST['excluir'])){
    //if (isset($_POST['title']) AND isset($_POST['description']) AND isset($_POST['active'])){
        $obVaga->delete();  
        header('location: index.php?status=success');
        exit;
    }
    include __DIR__."/includes/header.php";
    include __DIR__."/includes/confirmar_exclusao.php";
    include __DIR__."/includes/footer.php";