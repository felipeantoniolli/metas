<div class="container">

    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center"> <?= $titulo ?> Meta </h3>
            <form method="post" action="<?= $action ?>">
                <div class="row mt-4">
                    <div class="col-md-1 col-xs-12">
                        <label for="titulo">Titulo: </label>
                    </div>

                    <input type="hidden" name="id" value="<?= set_value('id') ?>">
                    <input type="hidden" name="estado" value="<?= set_value('estado') ?>">
                    <div class="col-md-9 col-xs-12">
                        <input type="text" name="titulo" value="<?= set_value('titulo') ?>" class="form-control">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-1 col-xs-12">
                        <label for="conteudo">Conteudo: </label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <input type="text" name="conteudo" value="<?= set_value('conteudo') ?>" class="form-control">
                    </div>
                </div>
                <div class="text-center mt-4">
                    <input type="submit" name="salvar" value="<?= $titulo ?>" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

