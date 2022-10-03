<?php
if( !isset( $_POST["numero_credito"] ) ) exit();
#Definimos la raíz del directorio
if ( !defined( "RAIZ" ) ) 
{
	define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/creditos/creditos.php";
$numero_credito = $_POST["numero_credito"];
$datos_credito = consultar_credito( $numero_credito );
echo json_encode($datos_credito);
?>