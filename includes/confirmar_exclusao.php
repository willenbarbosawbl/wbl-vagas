<main>    
    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <p>Você deseja realmente excluir a vaga <strong><?=$obVaga->title?></strong>?</p>
        </div>
        
        <div class="form-group">            
            <button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
            <a href="index.php">
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>
        </div>
    </form>
</main>