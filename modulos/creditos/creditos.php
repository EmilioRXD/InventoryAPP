<?php
function consultar_todos_los_creditos($limite, $offset)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT * FROM ventas WHERE metodo_pago = 'Credito' ORDER BY numero_venta DESC LIMIT ? OFFSET ?;");
    $sentencia->execute([$limite, $offset]);
    return $sentencia->fetchAll();
}