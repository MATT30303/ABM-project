<?php 
include("conexion.php");


$qrystr = "INSERT INTO item 
             (usuario_id,
              rubro_id,
              item_desc,
              item_monto,
              item_fecha)
           VALUES(
              :usuario_id,
              1,
              'Teclado',
              555.54,
              '2024-05-18')";


$stmt = $pdo->prepare($qrystr);
$usuario_id = 2;
$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->execute();