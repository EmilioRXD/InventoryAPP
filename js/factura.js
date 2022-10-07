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
var $contenedor_productos = $("#cuerpo_tabla_productos"),
    un_dia_en_milisegundos = (24 * 60 * 60 * 1000),
    ayudante_total = 0,
    ayudante_utilidad = 0.0,
    OFFSET = 0,
    LIMITE = 17,
    deuda = 0,
    abono_verde = 0,
    abono_bs = 0,
    cliente,
    ci = 0,
    telefono = 0;

var precioVerde = $("#dolar").text();g

function Producto(numero, nombre) {
 this.numero = numero;
 this.nombre = nombre;
}

function Venta(numero_venta, fecha, nombre_producto, numero_productos, total, total_bs, metodo_pago, usuario, familia, utilidad) {
    this.numero_venta = numero_venta;
    this.fecha = fecha;
    this.lista_productos = [];
    this.numero_productos = parseFloat(numero_productos);
    this.total = total;
    this.total_bs = total_bs;
    this.lista_productos.push(new Producto(numero_productos, nombre_producto));
    this.metodo_pago = metodo_pago;
    this.usuario = usuario;
    this.familia = familia;
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
    consultar_compra();
    escuchar_elementos();
});

function consultar_compra() {
 $.post('./modulos/factura/consultar_compra.php', {
     limite: LIMITE,
     offset: OFFSET
 }, function (respuesta) {
     respuesta = JSON.parse(respuesta);
     console.log(respuesta);
     if (respuesta !== false) {
         dibuja_tabla_creditos(respuesta);
     } else {
         //Manejar error o respuesta
     }
 });
}

function dame_posicion_venta(ventas, numero_credito) {
 for (var i = ventas.length - 1; i >= 0; i--) {
     if (ventas[i].numero_credito === numero_credito) return i;
 }
 return -1;
}

function consultar_numero_total_productos() {
    $.post('./modulos/factura/consultar_numero_total_productos.php', function (respuesta) {
        respuesta = JSON.parse(respuesta);
        numero_total_productos = respuesta;
        console.log(numero_total_productos);
    });
}

function escuchar_elementos(){
    $("#generar_reporte").click(function () {
        $("#cliente").hide();
        $("#CI").hide();
        $("#telefono").hide();

        $(".cliente").html(cliente);
        $(".ci").html(ci);
        $(".telefono").html(telefono);

        $("#quitar").removeClass("content-wrapper");
        window.print();
    });
    $(".input").keyup( function() {
        cliente     = $("#cliente").val();
        ci          = $("#CI").val();
        telefono    = $("#telefono").val();
    });
    $(document).on("click", "#cargar_productos_nuevos", function (evento) {
        if (OFFSET - LIMITE > 0) {
            OFFSET = OFFSET - LIMITE;
        } else {
            OFFSET = 0;
        }
        if (esta_buscando === true) {
            buscar_producto($("#buscar_producto").val());
        } else {
            dibuja_tabla_creditos();
        }
    });

    $(document).on("click", "#cargar_productos_antiguos", function (evento) {
        if (OFFSET + LIMITE < numero_total_productos) {
            OFFSET = OFFSET + LIMITE;
        }
        if (esta_buscando === true) {
            buscar_producto($("#buscar_producto").val());
        } else {
            dibuja_tabla_creditos();
        }
    });
}

function dibuja_tabla_creditos(ventas) {
    $contenedor_productos.empty();
    if (ventas.length <= 0) {
        $("#cargar_productos_nuevos, #cargar_productos_antiguos").hide();
        var html_contenedor = "<tr><td colspan='7'>"
            + "<h2 class='text-center'>"
            + "<i class='fa fa-4x fa-archive'></i><br>"
            + "Todavía no hay productos <br>"
            + "<small>Agrega unos con el formulario de la izquierda</small></h2>"
            + "</td></tr>";

        if (esta_buscando === true) {
            html_contenedor = "<tr><td colspan='7'>"
                + "<h2 class='text-center'>"
                + "<i class='fa fa-4x fa-frown-o'></i><br>"
                + "Ningún producto coincide con tu búsqueda <br>"
                + "<small>Comprueba tu ortografía e inténtalo de nuevo</small></h2>"
                + "</td></tr>";
        }
        $contenedor_productos
            .append(html_contenedor)
            .parent()
            .find("thead")
            .hide();
        if (esta_buscando !== true) {
            $("#buscar_producto").prop("disabled", true);
        }
        return;
    }
    $("#cargar_productos_nuevos, #cargar_productos_antiguos").show();
    $contenedor_productos
        .parent()
        .find("thead")
        .show();

    var nombre, numero, total, total_bs;
    for (var i = 0; i < ventas.length; i++) {
        $("#numero_venta").html(ventas[i].numero_venta);
        $("#fecha").html(ventas[i].fecha);
        $(".vendedor").html(ventas[i].usuario);
        $(".total_bs").html("Bs. " + ventas[i].total_bs);
        var nombre   = ventas[i].nombre_producto,
            numero   = ventas[i].numero_productos,
            precio   = ventas[i].precio_venta,
            total    = ventas[i].total,
            precio_v = precio*precioVerde,
            tatal_p  = precio_v * numero;
        console.log(numero);
        $contenedor_productos
            .append(
                $('<tr>')
                    .append(
                        $('<td class="text-right">').html(ventas[i].numero_productos),
                        $('<td style="word-wrap: break-word; white-space: normal;">').html(nombre),
                        $('<td class="text-right">').html("$ " + total/numero),
                        $('<td class="text-right">').html("Bs. " + (precio*precioVerde).toFixed(2)),
                        $('<td class="text-right">').html("Bs. " + (tatal_p).toFixed(2))
                    )
            );
    }
}