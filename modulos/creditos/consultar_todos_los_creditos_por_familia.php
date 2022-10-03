<?php
/**
 * Created by PhpStorm.
 * User: Luis_
 * Date: 27/10/2016
 * Time: 12:12 PM
 */
if (!isset($_POST["fecha_inicio"])) exit("No hay fecha de inicio >:v");
if (!defined("RAIZ")) {
    define("RAIZ", dirname(dirname(dirname(__FILE__))));
}
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/creditos/creditos.php";
require_once RAIZ . "/modulos/funciones.php";
inicia_sesion_segura();
$todas_las_ventas = consultar_todos_los_creditos_por_familia($fecha_inicio, $fecha_fin);
echo json_encode($todas_las_ventas);
?>