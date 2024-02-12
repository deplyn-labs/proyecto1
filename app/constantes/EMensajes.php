<?php

class EMensajes {

    const CORRECTO = "CORRECTO";
    const ERROR = "ERROR";
    const INSERCION_EXITOSA = "INSERSION_EXITOSA";
    const ACTUALIZACION_EXITOSA = "ACTUALIZACION_EXITOSA";
    const ELIMINACION_EXITOSA = "ELIMINACION_EXITOSA";
    const ERROR_INSERSION = "ERROR_INSERSION";
    const ERROR_ACTUALIZACION = "ERROR_ACTUALIZACION";
    const ERROR_ELIMINACION = "ERROR_ELIMINACION";
    const NO_HAY_REGISTROS = "NO_HAY_REGISTROS";
    const ERROR_CONEXION_BD = "ERROR_CONEXION_BD";

    public static function getMensaje($codigo) {
        switch ($codigo) {
            case EMensajes::CORRECTO:
                return new Respuesta(1, "Se ha realizado la operación de manera correcta.");
            case EMensajes::INSERCION_EXITOSA:
                return new Respuesta(1, "Se ha insertado el registro con éxito.");
            case EMensajes::ACTUALIZACION_EXITOSA:
                return new Respuesta(1, "Se ha actualizado el registro con éxito.");
            case EMensajes::ELIMINACION_EXITOSA:
                return new Respuesta(1, "Se ha eliminado el registro con éxito.");
            case EMensajes::ERROR_INSERSION:
                return new Respuesta(-1, "Se ha producido un error al insertar el registro.");
            case EMensajes::ERROR:
                return new Respuesta(-1, "Se ha producido un error al realizar la operación.");
            case EMensajes::ERROR_ACTUALIZACION:
                return new Respuesta(-1, "Se ha producido un error al acutalizar el registro.");
            case EMensajes::ERROR_ELIMINACION:
                return new Respuesta(-1, "Se ha producio un error al eliminar el registro.");
            case EMensajes::NO_HAY_REGISTROS:
                return new Respuesta(0, "No hay registros.");
            case EMensajes::ERROR_CONEXION_BD:
                return new Respuesta(-1, "Error al conectar con la base de datos.");
        }
    }

}
