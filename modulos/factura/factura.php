<?php

    function consultar_compra($limite, $offset)
    {
        global $base_de_datos;
        require_once "../inventario/inventario.php";
        $numero_venta = ultimo_numero_de_venta();
        $sentencia = $base_de_datos->prepare("SELECT * FROM ventas WHERE numero_venta = ? ORDER BY fecha DESC LIMIT ? OFFSET ?;");
        $sentencia->execute([$numero_venta, $limite, $offset]);
        return $sentencia->fetchAll();
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