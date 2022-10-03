<?php
function consultar_todos_los_creditos($limite, $offset)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT * FROM creditos WHERE metodo_pago = 'Credito' ORDER BY numero_credito DESC LIMIT ? OFFSET ?;");
    $sentencia->execute([$limite, $offset]);
    return $sentencia->fetchAll();
}

function eliminar_credito($rowid)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("DELETE FROM creditos WHERE numero_credito = ?");
    return $sentencia->execute([$rowid]);
}