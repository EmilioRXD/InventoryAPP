<?php
if( !isset( $_POST["limite"] ) ) exit();
if (!defined("RAIZ")) {
    define("RAIZ", dirname(dirname(dirname(__FILE__))));
}
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/creditos/creditos.php";
$limite = $_POST["limite"];
$offset = $_POST["offset"];
$todos_los_creditos = consultar_todos_los_creditos( $limite, $offset );
echo json_encode( $todos_los_creditos );