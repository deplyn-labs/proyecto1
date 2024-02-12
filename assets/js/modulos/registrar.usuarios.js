var vista = {
    controles: {
        formUsuario: $('#formUsuario'),
        idUsuario: $('#idUsuario')
    },
    init: function () {
        vista.eventos();
        var idUsuario = vista.controles.idUsuario.val();
        vista.peticiones.consultarUsuarioPorId(idUsuario);
    },
    eventos: function () {
        vista.controles.formUsuario.on('submit', vista.callbacks.eventos.accionesFormRegistro.ejecutar);
    },
    callbacks: {
        eventos: {
            accionesFormRegistro: {
                ejecutar: function (evento) {
                    __app.detenerEvento(evento);
                    var form = vista.controles.formUsuario;
                    var obj = form.getFormData();
                    console.log(obj);
                    vista.peticiones.registrarUsuario(obj);
                }
            }
        },
        peticiones: {
            beforeSend: function () {
                vista.controles.formUsuario.find('input,button').prop('disabled', true);
            },
            completo: function () {
                vista.controles.formUsuario.find('input,button').prop('disabled', false);
            },
            finalizado: function (respuesta) {
                if (__app.validarRespuesta(respuesta)) {
                    if (!vista.controles.idUsuario.length) {
                        vista.controles.formUsuario.find('input').val('');
                    }
                    swal('Correcto', respuesta.mensaje, 'success');
                    return;
                }
                swal('Error', respuesta.mensaje, 'error');
            },
            consultarPorIdCompleto: function (respuesta) {
                if (__app.validarRespuesta(respuesta)) {
                    vista.controles.formUsuario.fillForm(respuesta.datos)
                    return;
                }
                swal('Error', respuesta.mensaje, 'error');
            }
        }
    },
    peticiones: {
        registrarUsuario: function (obj) {
            var url = RUTAS_API.USUARIOS.REGISTRAR_USUARIO;
            if (vista.controles.idUsuario.length) {
                url = RUTAS_API.USUARIOS.ACTUALIZAR_USUARIO;
                obj.idUsuario = vista.controles.idUsuario.val();
            }

            __app.post(url, obj)
                    .beforeSend(vista.callbacks.peticiones.beforeSend)
                    .complete(vista.callbacks.peticiones.completo)
                    .success(vista.callbacks.peticiones.finalizado)
                    .error(vista.callbacks.peticiones.finalizado)
                    .send();
        },
        consultarUsuarioPorId: function (id) {
            if(!id) {
                return;
            }

            __app.post(RUTAS_API.USUARIOS.CONSULTAR_USUARIO_POR_ID, {
                idUsuario: id,
            })
                    .beforeSend(vista.callbacks.peticiones.beforeSend)
                    .complete(vista.callbacks.peticiones.completo)
                    .success(vista.callbacks.peticiones.consultarPorIdCompleto)
                    .error(vista.callbacks.peticiones.consultarPorIdCompleto)
                    .send();
        }
    }
};
$(vista.init);