<?php
function consultar_todos_los_creditos_por_familia($fecha_inicio, $fecha_fin)
{
    global $base_de_datos;
    $sql = 'SELECT
  familia,
  sum(totalR)    AS `total`,
  sum(utilidad) AS `utilidad`
FROM creditos
WHERE fecha >= ? AND fecha <= ?
GROUP BY familia;';
    $sentencia = $base_de_datos->prepare($sql);
    $sentencia->execute(array($fecha_inicio, $fecha_fin));
    return $sentencia->fetchAll();
}

function consultar_todos_los_creditos($limite, $offset)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT * FROM creditos WHERE delet = 0 ORDER BY numero_credito DESC LIMIT ? OFFSET ?;");
    $sentencia->execute([$limite, $offset]);
    return $sentencia->fetchAll();
}

function eliminar_credito($numero_credito)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("UPDATE creditos SET delet = 1 WHERE numero_credito = ?");
    $resultado_sentencia = $sentencia->execute([$numero_credito]);
    return $resultado_sentencia;
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

function consultar_todos_los_creditos_rep($fecha_inicio, $fecha_fin, $familia)
{
    global $base_de_datos;
    if ($_SESSION["administrador"] === 1) {
        if ($familia === "*") {
            $sql = "SELECT * FROM creditos WHERE fecha > ? AND fecha < ? ORDER BY numero_credito DESC;";
        } else {
            $sql = "SELECT * FROM creditos WHERE fecha > ? AND fecha < ? AND familia = ? ORDER BY numero_credito DESC;";
        }
    } else {
        if ($familia === "*") {
            $sql = "SELECT * FROM creditos WHERE fecha > ? AND fecha < ? AND usuario = ? ORDER BY numero_credito DESC;";
        } else {
            $sql = "SELECT * FROM creditos WHERE fecha > ? AND fecha < ? AND familia = ? AND usuario = ? ORDER BY numero_credito DESC;";
        }
    }
    $sentencia = $base_de_datos->prepare($sql);
    if ($_SESSION["administrador"] === 1) {
        if ($familia === "*") {
            $sentencia->execute([$fecha_inicio, $fecha_fin]);
        } else {
            $sentencia->execute([$fecha_inicio, $fecha_fin, $familia]);
        }
    } else {
        if ($familia === "*") {
            $sentencia->execute([$fecha_inicio, $fecha_fin, $_SESSION["nombre_de_usuario"]]);
        } else {
            $sentencia->execute([$fecha_inicio, $fecha_fin, $familia, $_SESSION["nombre_de_usuario"]]);
        }
    }
    return $sentencia->fetchAll();
}