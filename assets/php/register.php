<?php
require "./realconection.php";

try {
    echo "<br>nombre: " . $_POST["nombre"] . "<br>";
    echo "apellido: " . $_POST["apellido"] . "<br>";
    echo "dni: " . $_POST["dni"] . "<br>";
    echo "date: " . $_POST["date"] . "<br>";
    echo "producto: " . $_POST["producto"] . "<br>";
    echo "color: " . $_POST["color"] . "<br>";
    echo "estado: " . "pendiente" . "<br>";
    echo "precio: $" . $_POST["price"] . "<br>";

    $qrystr = "INSERT INTO personas (nombre, apellido, dni, producto, color, fecha, precio, estado)
    VALUES (:nombre, :apellido, :dni, :producto, :color, :fecha, :precio, :estado)";

    $stmt = $pdo->prepare($qrystr);

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $producto = $_POST["producto"];
    $color = $_POST["color"];
    $date = $_POST["date"];
    $price = $_POST["price"];
    $estado = "prendiente";

    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
    $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
    $stmt->bindParam(':color', $color, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $date, PDO::PARAM_STR); // Cambiado de :date a :fecha
    $stmt->bindParam(':precio', $price, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

    $stmt->execute();

    echo "<script type='text/javascript'>
            alert('Datos insertados correctamente.');
            window.location.href = '/assets/html/registrar.html';
          </script>";
} catch (PDOException $e) {
    echo "<script type='text/javascript'>
            alert('Error: " . $e->getMessage() . "');
            window.history.back();
          </script>";
}
?>