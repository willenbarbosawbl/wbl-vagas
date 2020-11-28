<?php
    require __DIR__."/vendor/autoload.php";
    use \App\Entity\Vaga;
    use \App\Session\Login;

    //OBRIGA O USUÁRIO A ESTAR LOGADO
    Login::requireLogin();

    define("TITLE", "Editar Vaga");
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
    if (!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['active'])){
    //if (isset($_POST['title']) AND isset($_POST['description']) AND isset($_POST['active'])){ 
                
        $obVaga->title          = addslashes($_POST['title']);
        $obVaga->description    = addslashes($_POST['description']);
        if ($_POST['active'] == 's'){
            $active = 's';
        }elseif($_POST['active'] == 'n'){
            $active = 'n';
        }else{
            $active = 'n';
        }
        $obVaga->active         = addslashes($active);
        $obVaga->update();  
        header('location: index.php?status=success');
        exit;
    }
    include __DIR__."/includes/header.php";
    include __DIR__."/includes/formulario.php";
    include __DIR__."/includes/footer.php";