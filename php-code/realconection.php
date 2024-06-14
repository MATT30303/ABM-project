<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');


$c_database = "php-proyect";
$c_conexion = "localhost";
$c_usuario = "root";
$c_password = "";
$c_port = "3307"; 

$conn = new mysqli($c_conexion,$c_usuario,$c_password,$c_database,$c_port);
if($conn->connect_error){
    die("conection Failes: ". $conn->connect_error);
}

function abrirBase_pdo() {
    global $c_database, $c_conexion, $c_usuario, $c_password, $c_port;
    $dsn = "mysql:host=$c_conexion;port=$c_port;dbname=$c_database";
    $nombre_usuario = $c_usuario;
    $password = $c_password;
    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_PERSISTENT => false
    );
    
    try {
        $gbd = new PDO($dsn, $nombre_usuario, $password, $opciones);
        $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $gbd;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
if (!$pdo = abrirBase_pdo())    
echo '<script>alert("No se pudo conectar a la BD")</script>';
?>