/***
 *     __ __    ___  ____   ______   ____  _____
 *    |  T  |  /  _]|    \ |      T /    T/ ___/
 *    |  |  | /  [_ |  _  Y|      |Y  o  (   \_
 *    |  |  |Y    _]|  |  |l_j  l_j|     |\__  T
 *    l  :  !|   [_ |  |  |  |  |  |  _  |/  \ |
 *     \   / |     T|  |  |  |  |  |  |  |\    |
 *      \_/  l_____jl__j__j  l__j  l__j__j \___j
 *
 *    
 *    Entorno: Desarrollo
 */
var productos_vender = [],
    ayudante_posicion = 0,
    puede_salir = true,
    total = 0,
    total10 = 0,
    intervalo_ayudante_nprogress,
    TECLA_F1 = 112,
    TECLA_F2 = 113,
    TECLA_F3 = 114,
    TECLA_ENTER = 13,
    TECLA_MENOS = 109,
    dolar = 0,
    totalBs = 0,
    EL_CLIENTE_USA_TICKET = true;

var precioVerde = $("#dolar").text();

window.onbeforeunload = function () {
    if (puede_salir == false || productos_vender.length > 0) return "Todavía no has completado la venta.";
};

$(document)
    .ready(function () {
        principal();
    })
    .ajaxStart(function () {
        NProgress.start();
        intervalo_ayudante_nprogress = setInterval(function () {
            NProgress.inc();
        }, 1000);
    })
    .ajaxStop(function () {
        clearInterval(intervalo_ayudante_nprogress);
        NProgress.done();
    });


function Producto(rowid, codigo, nombre, cantidad, precio, posicion, familia, precio_compra) {
    this.rowid = rowid;
    this.codigo = codigo;
    this.nombre = nombre;
    this.cantidad = cantidad;
    this.precio_venta = parseFloat(precio);
    this.posicion = posicion;
    this.total = this.cantidad * this.precio_venta;
    this.familia = familia;
    this.precio_compra = parseFloat(precio_compra);
    this.utilidad = (this.precio_venta - this.precio_compra >= 0 ? this.precio_venta - this.precio_compra : 0 );
};


Producto.prototype.aumentaCantidad = function () {
    this.cantidad += 1;
    this.refrescaTotal();
};


Producto.prototype.setCantidad = function (cantidad) {
    this.cantidad = parseFloat(cantidad);
    this.refrescaTotal();
};

Producto.prototype.refrescaTotal = function () {
    this.total = this.cantidad * this.precio_venta;
};


function isInt(n) {
    return n % 1 === 0;
}


function principal() {
    autocompletado_input();
    escuchar_elementos();
    $("#codigo_producto").focus();
    dibujar_productos();
    $("li#elem_ventas").addClass("active");
}


function dame_posicion_producto(posicion) {
    for (var x = 0; x < productos_vender.length; x++) {
        if (productos_vender[x].posicion === posicion) return x;
    }
    return -1;
}


function quita_producto_local(posicion) {
    var indice = dame_posicion_producto(posicion);
    if (indice !== -1) {
        productos_vender.splice(indice, 1);
        dibujar_productos();
        $("#codigo_producto").focus();
    }
}
function dame_total_productos_locales() {
    var numero_total = 0;
    for (var i = productos_vender.length - 1; i >= 0; i--) {
        numero_total += productos_vender[i].cantidad;
    }
    return numero_total;
}

function agrega_producto_local(producto) {
    var ya_esta_en_la_lista = producto_ya_esta_en_lista(producto.codigo);
    if (ya_esta_en_la_lista !== true) {
        var _producto = new
            Producto(
            producto.rowid,
            producto.codigo,
            producto.nombre,
            1,
            producto.precio_venta,
            ayudante_posicion,
            producto.familia,
            producto.precio_compra
        );
        productos_vender.push(_producto);
        ayudante_posicion++;
    }
    dibujar_productos();
}


function producto_ya_esta_en_lista(codigo) {
    for (var x = 0; x < productos_vender.length; x++) {
        if (productos_vender[x].codigo === codigo) {
            productos_vender[x].aumentaCantidad();
            return true;
        }
    }
    return false;
}


function quitar_ultimo_producto() {
    $("#codigo_producto").val("");
    if (productos_vender.length > 0) {
        productos_vender.splice(-1, 1);
        dibujar_productos();
    }
    $("#codigo_producto").focus();
    --ayudante_posicion;
}

function dibujar_productos() {
    if (productos_vender.length <= 0) {
        $("#contenedor_tabla")
            .empty()
            .html(
                $("<h2>")
                    .addClass('text-center')
                    .html('Agrega productos al carrito<br><i class = "fa fa-4x fa-cart-plus"></i>')
            );
        $("#contenedor_total").parent().hide();
        $("#contenedor_total_verde").parent().hide();
        return;
    }

    $("#contenedor_tabla")
        .empty()
        .append(
            $("<table>")
                .addClass('table table-striped table-hover table-condensed')
                .append(
                    $("<thead>")
                        .append(
                            $("<tr>")
                                .append(
                                    $("<th>")
                                        .html('Código'),

                                    $("<th>")
                                        .html('Producto'),

                                    $("<th>")
                                        .html('Precio Bs'),

                                    $("<th>")
                                        .html('Precio $'),

                                    $("<th>")
                                        .html('Cantidad'),

                                    $("<th>")
                                        .html('Total'),

                                    $("<th>")
                                        .html('Quitar')
                                )
                        )
                )
                .append(
                    $("<tbody>")
                )
        );
    var ayudante_total = 0;
    for (var i = productos_vender.length - 1; i >= 0; i--) {
        ayudante_total += productos_vender[i].total;
        $("#contenedor_tabla tbody")
            .append(
                $("<tr>")
                    .append(
                        $("<td>")
                            .html(productos_vender[i].codigo),

                        $("<td>")
                            .html(productos_vender[i].nombre),
                            
                        $("<td>")
                            .html("Bs. " + (productos_vender[i].precio_venta*precioVerde).toFixed(2)),

                        $("<td>")
                            .html("$ " + productos_vender[i].precio_venta),

                        $("<td>")
                            .html(
                                $("<div>")
                                    .addClass('form-group')
                                    .html(
                                        $("<input>")
                                            .attr("placeholder", "Cantidad")
                                            .attr("type", "number")
                                            .attr("data-pos", productos_vender[i].posicion)
                                            .addClass('form-control modificar-cantidad')
                                            .val(productos_vender[i].cantidad)
                                    )
                            ),

                        $("<td>")
                            .html("$ " + Math.round(productos_vender[i].total * 100) / 100),

                        $("<td>")
                            .html(
                                $("<button>")
                                    .addClass('btn btn-danger quitar-producto')
                                    .attr("data-pos", productos_vender[i].posicion)
                                    .html(
                                        $("<i>")
                                            .addClass('fa fa-trash')
                                    )
                            )
                    )
            );
    }
    ayudante_total = Math.round(ayudante_total * 100) / 100;

    totalBs = ayudante_total*precioVerde;

    $("#contenedor_total").text("Bs. " + (totalBs).toFixed(2)).parent().show();
    $("#contenedor_total_verde").text("$ " + ayudante_total).parent().show();
    total = ayudante_total;
    total10 = total + (total * 0.10);
}



function preparar_para_realizar_venta() {
    if (productos_vender.length > 0) {
        $("#modal_procesar_venta").modal("show");
        $("#contenedor_total_modal").text("Bs. " + (totalBs).toFixed(2)).parent().show();
        $("#contenedor_total_modal_10").parent().hide();
        $("#contenedor_total_modal_verde").text("$ " + (total).toFixed(2)).parent().show();
        $("#contenedor_total_modal_verde_10").parent().hide();
    }
}
function deshabilita_para_venta() {
    $("input, button").prop("disabled", true);
    puede_salir = false;
}
function habilita_para_venta() {
    $("input, button").prop("disabled", false);
    puede_salir = true;
}



/* funcion que realiza la venta, captura los datos del usuario y lo guarda en la base de datos */

function realizar_venta(productos, total, totalBs, precioVerde, metodo_pago, cambio, ticket) {
    cambio = parseFloat(cambio);
    if (cambio < 0) cambio = 0;
    deshabilita_para_venta();
    $("#realizar_venta")
        .html(
            $("<i>")
                .addClass('fa fa-spin fa-spinner')
        )
        .append(" Cargando...")
        .removeClass('btn-warning btn-info')
        .addClass('btn-warning');
    productos = JSON.stringify(productos);
    ticket = JSON.stringify(ticket);
    var numero_productos = dame_total_productos_locales();
    if (!EL_CLIENTE_USA_TICKET) ticket = false;
    $.post('./modulos/ventas/realizar_venta.php', {
        "productos": productos,
        "total": total,
        "total_bs": totalBs,
        "precio_verde": precioVerde,
        "ticket": ticket,
        "cambio": cambio,
        "metodo_pago": metodo_pago
    }, function (respuesta) {
        habilita_para_venta();
        ayudante_posicion = 0;
        respuesta = JSON.parse(respuesta);
        if (respuesta === true) {
            $("#realizar_venta")
                .html(
                    $("<i>")
                        .addClass('fa fa-check-square')
                )
                .append(" ¡Venta correcta!")
                .removeClass('btn-warning btn-info')
                .addClass('btn-success');
            // $("#modal_procesar_venta").modal("hide");
            // cancelar_venta();
            // $("#codigo_producto").focus();
            // $("#pago_usuario").val("");
            // $("#contenedor_cambio").parent().hide();
        } else {
            console.log("Error, la respuesta es:", respuesta);
        }
    });
}

/* funcion que realiza la venta, captura los datos del usuario y lo guarda en la base de datos */

function realizar_credito(nombre_cliente, numero_cliente, productos, total, metodo_pago, cambio, ticket) {
    cambio = parseFloat(cambio);
    if (cambio < 0) cambio = 0;
    deshabilita_para_venta();
    $("#realizar_venta")
        .html(
            $("<i>")
                .addClass('fa fa-spin fa-spinner')
        )
        .append(" Cargando...")
        .removeClass('btn-warning btn-info')
        .addClass('btn-warning');
    productos = JSON.stringify(productos);
    ticket = JSON.stringify(ticket);
    var numero_productos = dame_total_productos_locales();
    if (!EL_CLIENTE_USA_TICKET) ticket = false;
    $.post('./modulos/creditos/realizar_credito.php', {
        "nombre_cliente":nombre_cliente,
        "numero_cliente":numero_cliente,
        "productos": productos,
        "total": total,
        "metodo_pago": metodo_pago,
        "ticket": ticket,
        "cambio": cambio
    }, function (respuesta) {
        habilita_para_venta();
        ayudante_posicion = 0;
        respuesta = JSON.parse(respuesta);
        if (respuesta === true) {
            $("#realizar_venta")
                .html(
                    $("<i>")
                        .addClass('fa fa-check-square')
                )
                .append(" ¡Venta correcta!")
                .removeClass('btn-warning btn-info')
                .addClass('btn-info');
            $("#modal_procesar_venta").modal("hide");
            cancelar_venta();
            $("#codigo_producto").focus();
            $("#pago_usuario").val("");
            $("#contenedor_cambio").parent().hide();
        } else {
            console.log("Error, la respuesta es:", respuesta);
        }
    });
}



function cancelar_venta() {
    if (productos_vender.length > 0) {
        productos_vender.length = 0;
        dibujar_productos();
        ayudante_posicion = 0;
    }
    $("#codigo_producto").focus();
    puede_salir = true;
}


function escuchar_elementos() {
    $("#realizar_factura").click( function () {
        $("#contenedor_venta").hide();
    });

    $("#metodo_pago").change(function () {
        $(".contenedor_cambio").parent().hide();
        $("#pago_usuario").val("").prop('disabled', false);
        $("#chkEfectivoExacto").prop('checked', false);
        $(".credito").show();
        $(".credito_input").addClass("hidden").val("");
        $("#contenedor_total_modal").text("Bs. " + (totalBs).toFixed(2)).parent().show();
        $("#contenedor_total_modal_10").parent().hide();
        $("#contenedor_total_modal_verde").text("$ " + (total).toFixed(2)).parent().show();
        $("#contenedor_total_modal_verde_10").parent().hide();
        if ($("#metodo_pago").val().trim() == 0) {
            dolar = 1;
        } else if ($("#metodo_pago").val().trim() == 4){
            
                $("#contenedor_total_modal").text("Bs. " + (totalBs + (totalBs * 0.10)).toFixed(2)).parent().show();
                $("#contenedor_total_modal_10").text("Bs. " + (totalBs).toFixed(2)).parent().show();
                $("#contenedor_total_modal_verde").text("$ " + (total10).toFixed(2)).parent().show();
                $("#contenedor_total_modal_verde_10").text("$ " + (total).toFixed(2)).parent().show();

            $(".credito").hide();
            $(".credito_input").removeClass("hidden");
            $("#chkEfectivoExacto").prop('checked', true);
            $("#pago_usuario").val((totalBs).toFixed(2));
            dolar = 0;
        }else{
            dolar = 0;
        }
    })

    // $("#imprimir_ticket").click(function () {
    //     $("#pago_usuario").focus();
    // });

    $(window).resize(function (event) {
        $("#codigo_producto").css("width", $(".btn-group.btn-group-justified").width());
    });
    $("#quitar_ultimo_producto").click(function () {
        quitar_ultimo_producto();
    });
    $("#preparar_venta").click(function () {
        dolar = 0;
        $(".credito").show();
        preparar_para_realizar_venta();
        $("#chkEfectivoExacto").prop('checked', false);
        $(".contenedor_cambio").parent().hide();
        $("#pago_usuario").val("").prop('disabled', false);
        $("#metodo_pago").val(2);
        $(".credito_input").addClass("hidden").val("");
    });
    $("#cancelar_toda_la_venta").click(function () {
        cancelar_venta();
    });
    $("#chkEfectivoExacto").change(function() {
        if ($("#chkEfectivoExacto").is(':checked')){
            $("#pago_usuario").prop('disabled', true);
            if (dolar == 1){
                $("#pago_usuario").val((total).toFixed(2));
            } else {
                $("#pago_usuario").val((totalBs).toFixed(2));
            }
            $(".contenedor_cambio").parent().hide();
        } else {
            $("#pago_usuario").val("").prop('disabled', false);
        }
    });
    $("#nombre_cliente").keyup(function () {
        $(this).parent().removeClass('has-error');
    })
    $("#pago_usuario").keyup(function (evento) {
        $(this).parent().removeClass('has-error');
        var pago = $(this).val();
        if(dolar==1){
            cambioVerde = pago - total;
            cambioBs = ( pago * precioVerde ) - totalBs;
        } else {
            cambioVerde = (pago / precioVerde ) - total;
            cambioBs = pago - totalBs;
        }
        if (cambioVerde >= 0 && !isNaN(pago)) {
            $("#contenedor_cambio_bs").text("Bs. " + (cambioBs).toFixed(2)).parent().show();
            $("#contenedor_cambio_verde").text("$ " + (cambioVerde).toFixed(2)).parent().show();
            // if (dolar == 1) {
            //     $("#contenedor_cambio").text("$ " + (cambio).toFixed(2)).parent().show();
            // } else{
            //     $("#contenedor_cambio").text("Bs. " + (cambio).toFixed(2)).parent().show();
            // }
        } else {
            $(".contenedor_cambio").parent().hide();
        }
        if (evento.keyCode === 13) {
            if (cambio >= 0 && !isNaN(pago)) {
                realizar_venta(productos_vender, total, cambio, $("#imprimir_ticket").prop("checked"));
            } else {
                $(this).animateCss("shake");
                $(this).parent().addClass('has-error');
            }
        }
    });

    /* Integrar datos que se alojaran en la base datos */

    $("#realizar_venta").click(function () {

        const switch_metodo_pago = {
            0: '$ Efectivo',
            1: 'Bs. Efectivo',
            2: 'Bs. Tarjeta',
            3: 'Bs. Pago Movil',
            4: 'Crédito',
        }

        var metodo_pago     = switch_metodo_pago[$("#metodo_pago").val().trim()],
            nombre_cliente  = $("#nombre_cliente").val(),
            numero_cliente  = $("#numero_cliente").val(),
            valor           = $("#metodo_pago").val().trim();
            
        var pago = $("#pago_usuario").val(),
            cambio = pago - total;
        if (cambio >= 0 && !isNaN(pago) && valor != 4) {
            realizar_venta(productos_vender, total, totalBs, precioVerde, metodo_pago, cambio, $("#imprimir_ticket").prop("checked"));
        } else if (cambio >= 0 && !isNaN(pago) && valor == 4 && nombre_cliente != ""){
            realizar_credito(nombre_cliente, numero_cliente, productos_vender, total10, metodo_pago, cambio, $("#imprimir_ticket").prop("checked"));
        } else {
            $("#nombre_cliente").animateCss("shake");
            $("#nombre_cliente").parent().addClass('has-error');
            $("#pago_usuario").animateCss("shake");
            $("#pago_usuario").parent().addClass('has-error');
        }
        $(".credito_input").addClass("hidden").val("");
    });

    /* Integrar datos que se alojaran en la base datos */



    $("#modal_procesar_venta").on("shown.bs.modal", function () {
        $("#chkEfectivoExacto").prop('checked', false);
        $("#metodo_pago").focus().val(2);
        $(".credito").show();
        $(".credito_input").addClass("hidden").val("");
    });
    $("#modal_procesar_venta").on("hidden.bs.modal", function () {
        $("#realizar_venta").html("Realizar venta");
        $("#pago_usuario").val("").parent().removeClass('has-error');
        $("#codigo_producto").focus();
    });
    $("#codigo_producto").keydown(function (evento) {
        if (evento.ctrlKey) evento.preventDefault();
        switch (evento.keyCode) {
            case TECLA_ENTER:
                comprueba_si_existe_codigo($(this).val());
                break;
            case TECLA_F1:
                preparar_para_realizar_venta();
                evento.preventDefault();
                break;
            case TECLA_F2:
                cancelar_venta();
                evento.preventDefault();
                break;
            case TECLA_MENOS:
                quitar_ultimo_producto();
                evento.preventDefault();
                break;
            default:
                // statements_def
                break;
        }
    });

    $(document).on("keyup", ".modificar-cantidad", function (evento) {
        $(this).parent().removeClass('has-error');
        if (evento.keyCode === 13) {
            var nueva_cantidad = $(this).val(),
                posicion = dame_posicion_producto($(this).data("pos"));
            if (
                nueva_cantidad.length > 0
                && nueva_cantidad > 0
                && !isNaN(nueva_cantidad)
            ) {
                productos_vender[posicion].setCantidad(nueva_cantidad);
                dibujar_productos();
                $("#codigo_producto").focus();
            } else {
                $(this).animateCss('shake');
                $(this).parent().addClass('has-error');
            }
        }

    });

    $(document).on("mouseout", ".modificar-cantidad", function () {
        $(this).parent().removeClass('has-error');
        var nueva_cantidad = $(this).val(),
            posicion = dame_posicion_producto($(this).data("pos"));
        if (
            nueva_cantidad.length > 0
            && nueva_cantidad > 0
            && !isNaN(nueva_cantidad)
        ) {
            productos_vender[posicion].setCantidad(nueva_cantidad);
            dibujar_productos();
            $(this).focus();
        } else {
            $(this).animateCss('shake');
            $(this).parent().addClass('has-error');
            $(this).focus();
        }
    });


    $(document).on("click", ".quitar-producto", function () {
        var posicion = $(this).data("pos");
        quita_producto_local(posicion);
    });
}

function autocompletado_input() {
    var opciones = {
        theme: "bootstrap",

        url: function (busqueda) {
            var sugerencias = "./modulos/ventas/autocompletado.php?busqueda=" + busqueda;
            return sugerencias;
        },

        getValue: function (producto) {
            return producto.nombre;
        },

        requestDelay: 200,

        list: {
            maxNumberOfElements: 20,


            onChooseEvent: function () {
                var producto_seleccionado = $("#codigo_producto").getSelectedItemData();
                comprueba_si_existe_codigo(producto_seleccionado.codigo);
            },

            showAnimation: {
                type: "fade", //normal|fade|fade
                time: 100
            },

            hideAnimation: {
                type: "fade", //normal|fade|fade
                time: 100
            }
        }
    };

    $("#codigo_producto").easyAutocomplete(opciones);
}


function comprueba_si_existe_codigo(codigo) {
    $.post('./modulos/ventas/comprueba_si_existe_codigo.php', {"codigo": codigo}, function (respuesta) {
        $("#codigo_producto")
            .val("")
            .trigger(
                jQuery.Event(
                    'keyup', {
                        keyCode: 27,
                        which: 27
                    }
                )
            )
            .focus();
        respuesta = JSON.parse(respuesta);
        if (respuesta !== false) {
            agrega_producto_local(respuesta);
        }

    });
}