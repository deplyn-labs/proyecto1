<html>
    <head>
        <title>Proyecto 1 | Consultar y listar con Ajax</title>
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
                        <a href="crearusuario"></a>
                        <a href="<?= URL::to("usuarios/form/crear") ?>" class="btn btn-primary">Crear usuario</a>
                    </div>
                    <hr/>
                    <h4 class="card-title mb-4">Listar usuarios con AJAX</h4>
                    <table class="table table-condensed table-hover table-striped" width="100%" id="tablaListaUsuarios">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">Consultando...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="<?= URL::to("assets/plugins/jquery.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/bootstrap/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/helperform.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/rutas.api.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/app.global.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/sweetalert/sweetalert.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/modulos/lista.usuarios.js") ?>" type="text/javascript"></script>
    </body>
</html>