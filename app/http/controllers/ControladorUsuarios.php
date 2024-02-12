<?php

class ControladorUsuarios extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        return $this->view("welcome");
    }

    public function formCrearUsuario() {
        return $this->view("usuarios/registrarusuario");
    }

    public function formEdicionUsuario($id) {
        $variables = [
            "titulo" => "Actualizar con AJAX",
            "idUsuario" => base64_decode($id)
        ];
        return $this->view("usuarios/registrarusuario", $variables);
    }

    public function insertarUsuario(Request $request) {
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("correo", "=", $request->correo)->first();
        if ($usuario) {
            return new Respuesta(EMensajes::ERROR, "El correo ya se encuntra registrado.");
        }
        $id = $usuarioModel->insert($request->all());
        $v = ($id > 0);
        $respuesta = new Respuesta($v ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR_INSERSION);
        $respuesta->setDatos($id);
        return $respuesta;
    }

    public function listarUsuarios() {
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();
        $v = count($lista);
        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::ERROR);
        $respuesta->setDatos($lista);
        return $respuesta;
    }

    public function actualizarUsuario(Request $request) {
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("id", " = ", $request->idUsuario)
                ->update($request->all());
        $v = ($actualizados >= 0);
        return new Respuesta($v ? EMensajes::ACTUALIZACION_EXITOSA : EMensajes::ERROR_ACTUALIZACION);
    }

    public function eliminarusuario($idUsuario) {
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("id", " = ", $idUsuario)->delete();
        $v = ($eliminados > 0);
        return new Respuesta($v ? EMensajes::ELIMINACION_EXITOSA : EMensajes::ERROR_ELIMINACION);
    }

    public function buscarUsuarioPorId(Request $request) {
        $idUsuario = $request->idUsuario;
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("id", "=", $idUsuario)->first();
        $v = ($usuario != null);
        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::NO_HAY_REGISTROS);
        $respuesta->setDatos($usuario);
        return $respuesta;
    }

    public function eliminarUsuarioPorId(Request $request) {
        $idUsuario = $request->idUsuario;
        $usuarioModel = new Usuarios();
        $filasFectadas = $usuarioModel->where("id", "=", $idUsuario)->delete();
        $respuesta = new Respuesta($filasFectadas > 0? EMensajes::CORRECTO : EMensajes::ERROR);
        return $respuesta;
    }
}
