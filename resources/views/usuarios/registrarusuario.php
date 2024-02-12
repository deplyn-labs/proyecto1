<html>
    <head>
        <title>Proyecto 1 | <?= isset($titulo) ? $titulo : "Insertar con Ajax" ?></title>
        <link href="<?= URL::to("assets/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= URL::to("assets/plugins/sweetalert/sweetalert.css") ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body data-urlbase="<?= URL::base() ?>">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header bg-dark text-white">
                    <h5>Proyecto 1</h5>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <a href="<?= URL::base() ?>" >Listar usuarios</a>
                    </div>
                    <hr/>
                    <h4 class="card-title mb-4"><?= isset($titulo) ? $titulo : "Insertar con Ajax" ?></h4>
                    <form id="formUsuario" action="usuarios/registrar" method="POST">
                        <?php if (isset($idUsuario)): ?>
                            <input type="hidden" id="idUsuario" value="<?= $idUsuario ?>" />
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="nombres">Nombres (*):</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos (*):</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad (*):</label>
                            <input type="number" class="form-control" id="edad" name="edad" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo (*):</label>
                            <input type="email" class="form-control" id="correo" name="correo" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?= URL::to("assets/plugins/jquery.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/bootstrap/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/helperform.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/rutas.api.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/app.global.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/sweetalert/sweetalert.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/modulos/registrar.usuarios.js") ?>" type="text/javascript"></script>
    </body>
</html>