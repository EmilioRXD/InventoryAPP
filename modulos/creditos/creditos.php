<?php
function consultar_todos_los_creditos($limite, $offset)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT * FROM creditos WHERE metodo_pago = 'Credito' ORDER BY numero_credito DESC LIMIT ? OFFSET ?;");
    $sentencia->execute([$limite, $offset]);
    return $sentencia->fetchAll();
}

function eliminar_credito($numero_credito)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("DELETE FROM creditos WHERE numero_credito = ?");
    return $sentencia->execute([$numero_credito]);
}

function consultar_credito($numero_credito)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT * FROM creditos WHERE numero_credito = ? LIMIT 1;");
    $sentencia->execute([$numero_credito]);
    return $sentencia->fetch();
}

function abonar_credito($numero_credito, $total)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("UPDATE creditos SET total = ? WHERE numero_credito = ?");
    $resultado_sentencia = $sentencia->execute([$total,$numero_credito]);
    return $resultado_sentencia;
}