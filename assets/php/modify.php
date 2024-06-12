<?php
// Include the database connection file
include './realconection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the record to be modified
    $sql = $conn->prepare("SELECT * FROM personas WHERE Id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();
    $sql->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $producto = $_POST['producto'];
    $color = $_POST['color'];
    $fecha = $_POST['date'];
    $precio = $_POST['price'];
    $estado = $_POST['entrega'];

    // Prepare and execute the update query
    $sql = $conn->prepare("UPDATE personas SET nombre = ?, apellido = ?, dni = ?, producto = ?, color = ?, fecha = ?, precio = ?, estado = ? WHERE Id = ?");
    $sql->bind_param("ssssssssi", $nombre, $apellido, $dni, $producto, $color, $fecha, $precio, $estado, $id);
    $sql->execute();
    $sql->close();

    // Redirect back to the main page
    header("Location: list.php");
    exit();
}

$conn->close();
?>







<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/assets/css/registrar.css" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>modificar</title>
</head>

<body>
    <div class="form">
        <form action="" method="post">
            <span class="title">MODIFICACION</span>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['Id']); ?>">
            <span class="nombre">Nombre: <input type="text" id="nombre" name="nombre"
                    value="<?php echo htmlspecialchars($user['nombre']); ?>" /></span>
            <span class="apellido">Apellido: <input type="text" placeholder="apellido" id="apellido" name="apellido"
                    value="<?php echo htmlspecialchars($user['apellido']); ?>" /></span>
            <span class="dni">Dni: <input type="text" placeholder="dni" id="dni" name="dni"
                    value="<?php echo htmlspecialchars($user['dni']); ?>" /></span>
            <span class="producto">Producto:
                <select name="producto" id="producto">
                    <option value="<?php echo htmlspecialchars($user['producto']); ?>" selected hidden>
                        <?php echo htmlspecialchars($user['producto']); ?></option>
                    <option value="cocodrilo">Cocodrilo</option>
                    <option value="dragon">Dragon</option>
                    <option value="puplo">Pulpo</option>
                    <option value="ajolote">Ajolote</option>
                    <option value="custom">Custom</option>
                </select>
            </span>
            <span class="color">Color:
                <select name="color" id="color">
                    <option value="<?php echo htmlspecialchars($user['color']); ?>" selected hidden>
                        <?php echo htmlspecialchars($user['color']); ?></option>
                    <option value="negro">Negro</option>
                    <option value="gris">Gris</option>
                    <option value="violeta">Violeta</option>
                    <option value="verde">Verde</option>
                    <option value="custom">Custom</option>
                </select>
            </span>
            <span class="fecha">Fecha de entrega: <input type="date" id="F-entrega" name="date"
                    value="<?php echo htmlspecialchars($user['fecha']); ?>" /></span>
            <span class="precio">precio: <input type="text" id="precio" name="price"
                    value="<?php echo htmlspecialchars($user['precio']); ?>" /></span>
            <div class="entrega">
                <span>Entregado <input type="radio" name="entrega" value="entregado" /></span>
                <span>Pendiente <input type="radio" name="entrega" value="pendiente" /></span>
            </div>
            <div class="boton">
                <button class="atras"><a href="./list.php">ATRAS</a></button>
                <button type="submit" class="submit-button" name="update">SUBMIT</button>
            </div>
        </form>
    </div>
</body>

</html>