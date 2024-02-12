var __app = {
    urlbase: null,
    init: function () {
        __app.urlbase = ($('body').attr('data-urlbase')) ? $('body').attr('data-urlbase').trim('/') + '/' : '/';
    },
    urlTo: function (url) {
        return __app.urlbase + url;
    },
    validarRespuesta: function (respuesta) {
        if ((respuesta && !respuesta.codigo) || respuesta.codigo < 0) {
            respuesta = false;
        }
        return respuesta;
    },
    parsearRespuesta: function (respuesta) {
        var datos = __app.validarRespuesta(respuesta);
        if (datos) {
            return datos.datos;
        } else {
            return false;
        }
    },
    detenerEvento: function (e) {
        if (e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            if (!!e.returnValue) {
                e.returnValue = false;
            }
        }
        return;
    },
    get: function (url, data) {
        var ajax = __app.getObjectAjax(url, data, "GET");
        return $.extend({ajax: ajax}, __app.methods);
    },
    post: function (url, data) {
        var ajax = __app.getObjectAjax(url, data, "POST");
        return $.extend({ajax: ajax}, __app.methods);
    },
    methods: {
        beforeSend: function (callback) {
            this.ajax.beforeSend = callback;
            return this;
        },
        complete: function (callback) {
            this.ajax.complete = callback;
            return this;
        },
        success: function (callback) {
            this.ajax.success = callback;
            return this;
        },
        error: function (callback) {
            this.ajax.error = callback;
            return this;
        },
        send: function () {
            __app.ajax(this.ajax);
        }
    },
    getObjectAjax: function (url, data, method) {
        var ajax = new Object();
        ajax.url = url;
        ajax.data = data;
        ajax.type = method;
        return ajax;
    },
    ajax: function (args) {
        var ajax = new Object();
        ajax.url = (__app.urlbase + args.url);
        ajax.type = (args.type) ? args.type : "POST";
        ajax.data = (args.data);
        ajax.dataType = (args.dataType) ? args.dataType : "json";
        ajax.beforeSend = args.beforeSend;
        ajax.complete = args.complete;
        ajax.success = args.success;
        ajax.error = args.error;
        $.ajax(ajax);
    },
};
$(__app.init());