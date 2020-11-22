<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?=$obVaga->title?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control"><?=$obVaga->description?></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="active" value="s" checked> Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="active" value="n"<?=$obVaga->active == 'n' ? 'checked' : ''?>> Inativo
                    </label>
                </div>
            </div>     
        </div>
        <div class="form-group">
            <button type="submit" class=" btn btn-success">Enviar</button>
        </div>
    </form>
</main>