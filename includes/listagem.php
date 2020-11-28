<?php

    $mensage = '';
    if (isset($_GET['status'])){
        switch($_GET['status']){
            case 'success':
                $mensage = '<div class="alert alert-success">Ação executada com sucesso!</div>';
            break;
            case 'error':
                $mensage = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
        }
    }

    $result = '';
    foreach ($vagas as $vaga){
        $result .= '<tr>
            <td>'.$vaga->id.'</td>
            <td>'.$vaga->title.'</td>
            <td>'.$vaga->description.'</td>
            <td>'.($vaga->active == 's' ? 'Ativo' : 'Inativo').'</td>
            <td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->date)).'</td>
            <td>
                <a href="editar.php?id='.$vaga->id.'">
                    <button class="btn btn-primary">Editar</button>
                </a>
                <a href="excluir.php?id='.$vaga->id.'">
                    <button class="btn btn-danger">Excluir</button>
                </a>
            </td>
        </tr>';
    }

    $result = strlen($result) ? $result : '<tr>
        <td colspan="6" class="text-center">Nenhuma vaga encontrada!</td>
    </tr>';

    //GETs
    unset($_GET['ststus']);
    unset($_GET['page']);
    $gets = http_build_query($_GET);
    //echo '<pre>'; print_r($_GET); echo '</pre>'; exit; 

    //PÁGINACAO
    $paginacao = '';
    $paginas = $obPagination->getPages();
    foreach ($paginas as $key=>$pagina){
        $class = $pagina['pagina_atual'] ? 'btn-primary': 'btn-light';
        $paginacao .= '<a href="?page='.$pagina['pagina'].'&'.$gets.'">
                            <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                       </a> 
        ';

    }
    
    //echo '<pre>'; print_r($paginas); echo '</pre>'; exit;
?>

<main>

    <?=$mensage?>

    <section>
        <a href="index.php">
            <button class="btn btn-primary">Home</button>
        </a>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova Vaga</button>
        </a>
    </section>

    <section>
        <form method="get">

            <div class="row my-4">
            
                <div class="col">

                    <label for="buscar">Bucar por título</label>
                    <input type="text" name="buscar" class="form-control" id="buscar" value="<?=$buscar?>">

                </div>
                
                <div class="col">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value=""<?=$status == '' ? ' selected' : ''?>>Ativo/Inativo</option>
                        <option value="s"<?=$status == 's' ?' selected' : ''?>>Ativo</option>
                        <option value="n"<?=$status == 'n' ?' selected' : ''?>>Inativo</option>
                    </select>
                </div>

                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

            </div>

        </form>
    </section>

    <section>
        <table class="table bg-light mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$result?>
            </tbody>
        </table>

        <section>
            <?=$paginacao?>
        </section>

    </section>
</main>