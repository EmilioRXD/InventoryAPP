<?php
    function consultar_numero_total_productos()
    {
        global $base_de_datos;
        $numero_venta = ultimo_numero_de_venta();
        $sentencia = $base_de_datos->prepare("SELECT count(codigo_producto) AS count FROM ventas WHERE numero_venta = ?;");
        $sentencia->execute([$numero_venta]);
        $fila = $sentencia->fetch();
        if ($fila === FALSE) return;
        return $fila["count"];
    }
    function ultimo_numero_de_venta()
    {
        global $base_de_datos;
        $sentencia = $base_de_datos->prepare("SELECT numero_venta AS ultima_venta FROM ventas ORDER BY numero_venta DESC LIMIT 1;");
        $sentencia->execute();
        $fila = $sentencia->fetch();
        if ($fila === FALSE) return;
        return $fila["ultima_venta"];
    }
?>