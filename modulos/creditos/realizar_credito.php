<?php
if ( !isset( $_POST["productos"] ) ) exit();
if ( !defined( "RAIZ" ) ) 
{
	define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/funciones.php";
require_once RAIZ . "/modulos/ventas/ventas.php";
inicia_sesion_segura();
$productos 		= $_POST["productos"];
$productos 		= json_decode($productos);
$nombre_cliente	= $_POST["nombre_cliente"];
$numero_cliente	= $_POST["numero_cliente"];
$total          = $_POST["total"];
$total_bs 		= $_POST["total_bs"];
$precio_verde 	= $_POST["precio_verde"];
$cambio 		= $_POST["cambio"];
$metodo_pago 	= $_POST["metodo_pago"];
$ticket 		= $_POST["ticket"];
$ticket 		= json_decode($ticket);
$resultado 		= hacer_credito($nombre_cliente, $numero_cliente, $productos, $total, $total_bs, $precio_verde, $metodo_pago, $ticket, $cambio);
echo json_encode($resultado);
?>