<?php
if( !isset( $_POST["limite"] ) ) exit();
if ( !defined( "RAIZ" ) ) 
{
	define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/factura/factura.php";
$limite = $_POST["limite"];
$offset = $_POST["offset"];
$datos_compra = consultar_compra( $limite, $offset );
echo json_encode($datos_compra);
?>