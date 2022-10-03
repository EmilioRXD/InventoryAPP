<?php
if( !isset( $_POST["numero_credito"] ) ) exit();
#Definimos la raíz del directorio
if ( !defined( "RAIZ" ) ) 
{
    define( "RAIZ", dirname( dirname( dirname( __FILE__ ) ) ) );
}

$numero_credito = $_POST["numero_credito"];
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/funciones.php";
require_once RAIZ . "/modulos/creditos/creditos.php";
inicia_sesion_segura();
if ($_SESSION["administrador"] !== 1) {
    echo json_encode("Tú no eres administrador");
    exit();
}
$resultado = eliminar_credito( $numero_credito );
echo json_encode($resultado);
?>