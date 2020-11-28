<?php
    require __DIR__."/vendor/autoload.php";

    use \App\Entity\Vaga;
    use \App\Db\Pagination;

    //Buscar
    $buscar = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
    $status = in_array($status,['s','n']) ? $status : '';
    //CONDIÇÕES SQL
    $condicoes = [
        strlen($buscar) ? 'title LIKE "%'.str_replace(' ', '%', $buscar).'%" ': null,
        strlen($status) ? 'active = "'.$status.'" ': null
    ];
    //REMOVE POSIÇÕES VÁZIAS
    $condicoes = array_filter($condicoes);
    //CLÁUSULA WHERE
    $where = implode(' AND ', $condicoes);

    //QUANTIDADE TOTAL DE VAGAS
    $qtdVagas = Vaga::getQuantidadeVagas($where);
    //PAGINAÇÃO
    $obPagination = new Pagination($qtdVagas, $_GET['page'] ?? 1,3);
    
    //echo '<pre>'; print_r($obPagination->getLimit()); echo '</pre>'; exit;


    $vagas = Vaga::getVagas($where,null,$obPagination->getLimit());
    //echo "<pre>"; print_r($vagas); echo "</pre>"; exit;

    include __DIR__."/includes/header.php";
    include __DIR__."/includes/listagem.php";
    include __DIR__."/includes/footer.php";