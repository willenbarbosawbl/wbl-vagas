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
?>

<main>

    <?=$mensage?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova Vaga</button>
        </a>
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
    </section>
</main>