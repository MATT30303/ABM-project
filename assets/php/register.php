<?php
include("conection.php");

try {
    $qrystr = "INSERT INTO personas (nombre, apellido, dni, producto, color, precio, estado)
    VALUES (:nombre, :apellido, :dni, :producto, :color, :precio, :estado)";

    $stmt = $pdo->prepare($qrystr);
    
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $producto = $_POST["producto"];
    $color = $_POST["color"];
    $price = $_POST["price"];
    $estado = "pendiente";
    
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
    $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
    $stmt->bindParam(':color', $color, PDO::PARAM_STR);
    $stmt->bindParam(':precio', $price, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

    $stmt->execute();
    echo '<script type="text/javascript">
        confirm("datos insertados correctamente!");
        window.location.href = "/landing.html";
      </script>';
} catch (PDOException $e) {
    echo "<script type='text/javascript'>
            confirm('Error: " . $e->getMessage() . "');
          </script>";
        }
?>