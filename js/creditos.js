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
    LIMITE = 1000;

var precioVerde = $("#dolar").text();

function Producto(numero, nombre) {
    this.numero = numero;
    this.nombre = nombre;
}

function Venta(numero_credito, fecha, nombre_cliente, numero_cliente, nombre_producto, numero_productos, total, metodo_pago, usuario) {
    this.numero_credito = numero_credito;
    this.fecha = fecha;
    this.nombre_cliente = nombre_cliente;
    this.numero_cliente = numero_cliente;
    this.lista_productos = [];
    this.numero_productos = parseFloat(numero_productos);
    this.total = total;
    this.lista_productos.push(new Producto(numero_productos, nombre_producto));
    this.metodo_pago = metodo_pago;
    this.usuario = usuario;
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
    $("#mostrar_total").text("").parent().hide();
    $("#generar_reporte").hide();
    $("#contenedor_tabla")
        .empty();
    if (creditos.length <= 0) return;
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
    for (var i = creditos.length - 1; i >= 0; i--) {
        subtotal = creditos[i].total;
        if (ayudante_numero_credito === creditos[i].numero_credito) {
            var posicion = dame_posicion_venta(creditos_totales, creditos[i].numero_credito);
            creditos_totales[posicion].agrega_producto_lista(creditos[i].numero_productos, creditos[i].nombre_producto);
            creditos_totales[posicion].total = parseFloat(creditos_totales[posicion].total);
            numero_productos += parseFloat(creditos[i].numero_productos);
        } else {
            creditos_totales.push(
                new Venta(
                    creditos[i].numero_credito,
                    creditos[i].fecha,
                    creditos[i].nombre_cliente,
                    creditos[i].numero_cliente,
                    creditos[i].nombre_producto,
                    parseFloat(creditos[i].numero_productos),
                    subtotal,
                    creditos[i].metodo_pago,
                    creditos[i].usuario
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
                        $("<td style='word-wrap: break-word; white-space: normal;'>").html(creditos_totales[i].fecha),
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
                                            .addClass('agregar-piezas btn-ms btn-success')
                                            .html(
                                                $("<i>")
                                                    .addClass('fa fa-plus-circle')
                                            )
                                    )
                                    .append(
                                        $("<button data-id = '" + creditos_totales[i].numero_credito + "'>")
                                            .addClass('eliminar btn-ms btn-danger')
                                            .html(
                                                $("<i>")
                                                    .addClass('fa fa-trash')
                                            )
                                    )
                            )
                    )
            );
    }
}