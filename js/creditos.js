/***
 *     ____     ___  ____    ___   ____  ______    ___        __ __    ___  ____   ______   ____  _____
 *    |    \   /  _]|    \  /   \ |    \|      T  /  _]      |  T  |  /  _]|    \ |      T /    T/ ___/
 *    |  D  ) /  [_ |  o  )Y     Y|  D  )      | /  [_ _____ |  |  | /  [_ |  _  Y|      |Y  o  (   \_
 *    |    / Y    _]|   _/ |  O  ||    /l_j  l_jY    _]     ||  |  |Y    _]|  |  |l_j  l_j|     |\__  T
 *    |    \ |   [_ |  |   |     ||    \  |  |  |   [_l_____jl  :  !|   [_ |  |  |  |  |  |  _  |/  \ |
 *    |  .  Y|     T|  |   l     !|  .  Y |  |  |     T       \   / |     T|  |  |  |  |  |  |  |\    |
 *    l__j\_jl_____jl__j    \___/ l__j\_j l__j  l_____j        \_/  l_____jl__j__j  l__j  l__j__j \___j
 *
 *    Última modificación: 09 de junio de 2016 por Parzibyte
 *    Entorno: Desarrollo
 */
var un_dia_en_milisegundos = (24 * 60 * 60 * 1000),
    ayudante_total = 0,
    ayudante_utilidad = 0.0,
    OFFSET = 0,
    LIMITE = 1000,
    deuda = 0,
    abono_verde = 0,
    abono_bs = 0;

var precioVerde = $("#dolar").text();

function Producto(numero, nombre) {
    this.numero = numero;
    this.nombre = nombre;
}

function Venta(delet, numero_credito, fecha, nombre_cliente, numero_cliente, nombre_producto, numero_productos, total, totalR, metodo_pago, usuario, familia, utilidad) {
    this.delet = delet;
    this.numero_credito = numero_credito;
    this.fecha = fecha;
    this.nombre_cliente = nombre_cliente;
    this.numero_cliente = numero_cliente;
    this.lista_productos = [];
    this.numero_productos = parseFloat(numero_productos);
    this.total = total;
    this.totalR = totalR;
    this.lista_productos.push(new Producto(numero_productos, nombre_producto));
    this.metodo_pago = metodo_pago;
    this.usuario = usuario,
    this.familia = familia,
    this.utilidad = utilidad;
}

Venta.prototype.agrega_producto_lista = function (numero_productos, nombre_producto) {
    this.numero_productos += parseFloat(numero_productos);
    this.lista_productos.push(new Producto(numero_productos, nombre_producto));
};

Venta.prototype.productos_como_html = function () {
    var foo = "";
    for (var i = this.lista_productos.length - 1; i >= 0; i--) {
        foo +=
            this.lista_productos[i].nombre.toString()
            + ": <strong>"
            + this.lista_productos[i].numero.toString()
            + "</strong>"
            + "<br>";
    }
    return foo;
};

$(document).ready(function () {
    consultar_todos_los_creditos();
});

function consultar_todos_los_creditos() {
    $.post('./modulos/creditos/consultar_todos_los_creditos.php', {
        limite: LIMITE,
        offset: OFFSET
    }, function (respuesta) {
        respuesta = JSON.parse(respuesta);
        if (respuesta !== false) {
            dibuja_tabla_creditos(respuesta);
        } else {
            //Manejar error o respuesta
        }
    });
}

function dame_posicion_venta(creditos, numero_credito) {
    for (var i = creditos.length - 1; i >= 0; i--) {
        if (creditos[i].numero_credito === numero_credito) return i;
    }
    return -1;
}

function dibuja_tabla_creditos(creditos) {
    $("#contenedor_tabla").empty();
    if (creditos.length <= 0){
        var html_contenedor = "<div>"
            + "<h2 class='text-center'>"
            + "<i class='fa fa-4x fa-archive'></i><br>"
            + "Todavía no hay créditos <br>"
            + "</h2>"
            + "</div>";

            $("#contenedor_tabla")
            .append(html_contenedor)
            .parent()
            .find("thead")
            .hide();
        return;
    }
    ayudante_total = 0;
    $("#contenedor_tabla")
        .append(
            $("<table>")
                .addClass('table table-bordered table-striped table-hover table-condensed')
                .append(
                    $("<thead>")
                        .append(
                            $("<tr>")
                                .append(
                                    $("<th class='text-center'>")
                                        .html('Fecha'),

                                    $("<th>")
                                        .html('Nombre Cliente'),

                                    $("<th>")
                                        .html('Numero Cliente'),

                                    $("<th>")
                                        .html('Productos'),

                                    $("<th style='width: 8em;'>")
                                        .html('N° Productos'),

                                    $("<th>")
                                        .html('Total Bs'),

                                    $("<th>")
                                        .html('Total $'),

                                    $("<th>")
                                        .html('Metodo Pago'),

                                    $("<th class='text-center'>")
                                        .html('Usuario'),

                                    $("<th class='text-center'>")
                                        .html('Opciones')
                                )
                        )
                )
                .append(
                    $("<tbody>")
                )
        );
    var ayudante_numero_credito = undefined,
        numero_productos = 0.0;
    var creditos_totales = [];
    var subtotal = 0;
    var subtotalR = 0;
    var subtotal_utilidad = 0;
    for (var i = creditos.length - 1; i >= 0; i--) {
        subtotal = creditos[i].total;
        subtotalR = creditos[i].totalR;
        subtotal_utilidad = creditos[i].utilidad;
        if (ayudante_numero_credito === creditos[i].numero_credito) {
            var posicion = dame_posicion_venta(creditos_totales, creditos[i].numero_credito);
            creditos_totales[posicion].agrega_producto_lista(creditos[i].numero_productos, creditos[i].nombre_producto);
            creditos_totales[posicion].total = parseFloat(creditos_totales[posicion].total);
            creditos_totales[posicion].totalR = parseFloat(creditos_totales[posicion].totalR);
            creditos_totales[posicion].utilidad = parseFloat(creditos_totales[posicion].utilidad) + parseFloat(subtotal_utilidad);
            numero_productos += parseFloat(creditos[i].numero_productos);
            
        } else {
            creditos_totales.push(
                new Venta(
                    creditos[i].delet,
                    creditos[i].numero_credito,
                    creditos[i].fecha,
                    creditos[i].nombre_cliente,
                    creditos[i].numero_cliente,
                    creditos[i].nombre_producto,
                    parseFloat(creditos[i].numero_productos),
                    subtotal,
                    subtotalR,
                    creditos[i].metodo_pago,
                    creditos[i].usuario,
                    creditos[i].familia,
                    subtotal_utilidad
                )
            );
            ayudante_numero_credito = creditos[i].numero_credito;
        }
    }
    for (var i = creditos_totales.length - 1; i >= 0; i--) {
        $("#contenedor_tabla tbody")
            .append(
                $("<tr>")
                    .append(
                        $("<td class='text-center'>").html(creditos_totales[i].fecha),
                        $("<td>").html(creditos_totales[i].nombre_cliente),
                        $("<td>").html(creditos_totales[i].numero_cliente),
                        $("<td>").html(creditos_totales[i].productos_como_html()),
                        $("<td>").html(creditos_totales[i].numero_productos),
                        $("<td>").html("Bs. " + (creditos_totales[i].total * precioVerde).toFixed(2)),
                        $("<td>").html("$ " + creditos_totales[i].total),
                        $("<td>").html(creditos_totales[i].metodo_pago),
                        $("<td class='text-center'>").html(creditos_totales[i].usuario),
                        $('<td>')
                            .append(
                                $("<div class='col text-center' style='padding: 0;'>")
                                    .append(
                                        $("<button data-id = '" + creditos_totales[i].numero_credito + "'>")
                                            .addClass('editar btn-ms btn-success')
                                            .html(
                                                $("<i>")
                                                    .addClass('fa fa-plus-circle')
                                            )
                                    )
                                    // .append(
                                    //     $("<button data-id = '" + creditos_totales[i].numero_credito + "'>")
                                    //         .addClass('eliminar btn-ms btn-danger')
                                    //         .html(
                                    //             $("<i>")
                                    //                 .addClass('fa fa-ban')
                                    //         )
                                    // )
                            )
                    )
            );
    }
}

// Botones

$(document).on("click", ".eliminar, .editar", function () {
    $("button[data-toggle='tooltip']").tooltip("hide");
    tooltip_esta_mostrado = false;
});

$(document).on("click", "button[data-toggle='tooltip']", function () {
    if (tooltip_esta_mostrado) {
        $(this).tooltip("hide");
        tooltip_esta_mostrado = false;
    } else {
        $(this).tooltip("show");
        tooltip_esta_mostrado = true;
    }
});

$(document).on("click", ".eliminar", function (evento) {
    id_temporal_ayudante = $(this).data("id");
    $("#modal_confirmar").modal("show");
});

$(document).on("click", ".editar", function (evento) {
    id_temporal_ayudante = $(this).data("id");
    $("#modal_abonar").modal("show");
    $("#abono_verde").val(0);
    $("#abono_bs").val(0);
    consultar_credito(id_temporal_ayudante);
});

$("#eliminar_producto").click(function () {
    $("#mostrar_resultados_eliminar")
        .html('<i class="fa fa-spin fa-spinner"></i> Eliminando...')
        .parent()
        .removeClass('alert-success alert-warning')
        .addClass('alert-warning')
        .show("slow");
    deshabilitar_para_eliminar();
    eliminar_credito(id_temporal_ayudante);
});

function eliminar_credito(id_temporal_ayudante) {
    $.post('./modulos/creditos/eliminar_credito.php', {numero_credito: id_temporal_ayudante}, function (respuesta) {
        respuesta = JSON.parse(respuesta);
        if (respuesta === true) {
            $("#mostrar_resultados_eliminar")
                .html("<i class='fa fa-check'></i>¡Correcto!")
                .parent()
                .removeClass("alert-warning alert-success")
                .addClass('alert-success')
                .delay(200)
                .hide("slow", function () {
                    $("#modal_confirmar").modal("hide");
                    habilitar_para_eliminar();
                })
                consultar_todos_los_creditos();
        } else {
            $("#mostrar_resultados_eliminar")
                .html("<strong>Error: </strong>" + respuesta.toString())
                .parent()
                .removeClass("alert-warning alert-success")
                .addClass('alert-danger')
                .delay(2000)
                .hide("slow", function () {
                    $("#modal_confirmar").modal("hide");
                    habilitar_para_eliminar();
                })
        }
    });
}

function deshabilitar_para_eliminar() {
    $("#cancelar_confirmacion_eliminar, #eliminar_producto").prop("disabled", true);
}


function habilitar_para_eliminar() {
    $("#cancelar_confirmacion_eliminar, #eliminar_producto").prop("disabled", false);
}

$("#abonar").click(function () {
    $("#mostrar_resultados_abonar")
        .html('<i class="fa fa-spin fa-spinner"></i> Abonando...')
        .parent()
        .removeClass('alert-success alert-warning')
        .addClass('alert-warning')
        .show("slow");
    deshabilitar_para_abonar();
    var abono_bs = 0,
        abono_verde = 0,
        monto_1 = 0;
        monto_2 = 0;
        monto = 0;
    abono_verde = $("#abono_verde").val();
    abono_bs    = $("#abono_bs").val();
    monto_1 = deuda - abono_verde;
    monto_2 = deuda - (abono_bs/precioVerde)
    if (abono_verde == 0){
        monto += monto_2;
    } else {
        monto += monto_1
    }
    if(monto > 0){
        abonar_credito(id_temporal_ayudante, monto);
    }else if (monto == 0) {
        eliminar_credito(id_temporal_ayudante);
        $("#mostrar_resultados_abonar")
            .html("<i class='fa fa-check'></i>¡Correcto!")
            .parent()
            .removeClass("alert-warning alert-success")
            .addClass('alert-success')
            .delay(200)
            .hide("slow", function () {
                $("#modal_abonar").modal("hide");
                habilitar_para_abonar();
            })
            consultar_todos_los_creditos();
    } else {
        $("#mostrar_resultados_abonar")
            .html("<strong>Error</strong>")
            .parent()
            .removeClass("alert-warning alert-success")
            .addClass('alert-danger')
            .delay(2000)
            .hide("slow", function () {
                $("#modal_abonar").modal("hide");
                habilitar_para_abonar();
            })
    }
});

function deshabilitar_para_abonar() {
    $("#abonar").prop("disabled", true);
}


function habilitar_para_abonar() {
    $("#abonar").prop("disabled", false);
}

function consultar_credito(id_temporal_ayudante) {
    $.post('./modulos/creditos/consultar_credito.php', {numero_credito: id_temporal_ayudante}, function (respuesta) {
        respuesta = JSON.parse(respuesta);
        $("#contenedor_total").text("Bs. " + (respuesta.total*precioVerde).toFixed(2));
        $("#contenedor_total_verde").text("$ " + respuesta.total);
        deuda = respuesta.total
    });
}

function abonar_credito(id_temporal_ayudante, monto) {
    $.post('./modulos/creditos/abonar_credito.php', {numero_credito: id_temporal_ayudante, total: monto}, function (respuesta) {
        respuesta = JSON.parse(respuesta);
        if (respuesta === true) {
            $("#mostrar_resultados_abonar")
                .html("<i class='fa fa-check'></i>¡Correcto!")
                .parent()
                .removeClass("alert-warning alert-success")
                .addClass('alert-success')
                .delay(200)
                .hide("slow", function () {
                    $("#modal_abonar").modal("hide");
                    habilitar_para_abonar();
                })
                consultar_todos_los_creditos();
        } else {
            $("#mostrar_resultados_abonar")
                .html("<strong>Error: </strong>" + respuesta.toString())
                .parent()
                .removeClass("alert-warning alert-success")
                .addClass('alert-danger')
                .delay(2000)
                .hide("slow", function () {
                    $("#modal_abonar").modal("hide");
                    habilitar_para_abonar();
                })
        }
    });
}