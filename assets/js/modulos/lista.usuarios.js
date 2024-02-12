var vista = {
  controles: {
    tbodyListaUsuarios: $('#tablaListaUsuarios tbody'),
  },
  init: function () {
    vista.eventos();
    vista.peticiones.listarUsuarios();
  },
  eventos: function () {
    $(document).on(
      'click',
      '.btn-accion.eliminar',
      vista.callbacks.eventos.onClickEliminar
    );
  },
  callbacks: {
    eventos: {
      onClickEliminar: function (evento) {
        const btnEliminar = $(evento.target);
        const idUsuario = btnEliminar.data('id');
        console.log('btnEliminar', btnEliminar);
        console.log('id', btnEliminar.data('id'));

        swal(
          {
            title: 'Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false,
          },
          function (confirmado) {
            if (confirmado) {
              vista.peticiones.eliminarUsuarioPorId(idUsuario);
            }
          }
        );
      },
    },
    peticiones: {
      eliminarUsuarioPorId: {
        completo: function (respuesta) {
          const v = __app.validarRespuesta(respuesta);
          swal(
            v ? 'Correcto' : 'Error',
            respuesta.mensaje,
            v ? 'success' : 'error'
          );
          v && vista.peticiones.listarUsuarios();
        },
      },
      listarUsuarios: {
        beforeSend: function () {
          var tbody = vista.controles.tbodyListaUsuarios;
          tbody.html(vista.utils.templates.consultando());
        },
        completo: function (respuesta) {
          var tbody = vista.controles.tbodyListaUsuarios;
          var datos = __app.parsearRespuesta(respuesta);
          if (datos && datos.length > 0) {
            tbody.html('');
            for (var i = 0; i < datos.length; i++) {
              var dato = datos[i];
              tbody.append(vista.utils.templates.item(dato));
            }
          } else {
            tbody.html(vista.utils.templates.noHayRegistros());
          }
        },
      },
    },
  },
  peticiones: {
    eliminarUsuarioPorId: function (idUsuario) {
      __app
        .post(RUTAS_API.USUARIOS.ELIMINAR_USUARIO_POR_ID, {
          idUsuario,
        })
        .success(vista.callbacks.peticiones.eliminarUsuarioPorId.completo)
        .error(vista.callbacks.peticiones.eliminarUsuarioPorId.completo)
        .send();
    },
    listarUsuarios: function () {
      __app
        .get(RUTAS_API.USUARIOS.LISTAR)
        .beforeSend(vista.callbacks.peticiones.listarUsuarios.beforeSend)
        .success(vista.callbacks.peticiones.listarUsuarios.completo)
        .error(vista.callbacks.peticiones.listarUsuarios.completo)
        .send();
    },
  },
  utils: {
    templates: {
      item: function (obj) {
        return (
          '<tr>' +
          '<td>' +
          obj.nombres +
          '</td>' +
          '<td>' +
          obj.apellidos +
          '</td>' +
          '<td>' +
          obj.edad +
          '</td>' +
          '<td>' +
          obj.correo +
          '</td>' +
          '<td>' +
          obj.telefono +
          '</td>' +
          '<td>' +
          '<a href="' +
          __app.urlTo('/usuarios/form/edicion/' + btoa(obj.id)) +
          '" class="btn-accion editar">Editar</a>' +
          '  |  ' +
          '<a href="javascript:;" class="btn-accion eliminar" data-id="' +
          obj.id +
          '">Eliminar</a>' +
          '</td>' +
          '</tr>'
        );
      },
      consultando: function () {
        return '<tr><td colspan="6">Consultando...</td></tr>';
      },
      noHayRegistros: function () {
        return '<tr><td colspan="6">No hay registros...</td></tr>';
      },
    },
  },
};
$(vista.init);
