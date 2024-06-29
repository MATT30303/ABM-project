<?php
// Include the database connection file
include './conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
    
        // Fetch the record to be modified
        $sql = $pdo->prepare("SELECT * FROM personas WHERE Id = :id");
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        $sql = null;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $producto = $_POST['producto'];
    $color = $_POST['color'];
    $precio = $_POST['price'];
    $estado = $_POST['entrega'];

    // Prepare and execute the update query
    $sql = $pdo->prepare("UPDATE personas SET nombre = :nombre, apellido = :apellido, dni = :dni, producto = :producto,
    color = :color, precio = :precio, estado = :estado WHERE Id = :id");
    $sql->bindParam(":id", $id, PDO::PARAM_INT);
    $sql->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $sql->bindParam(":apellido", $apellido, PDO::PARAM_STR);
    $sql->bindParam(":dni", $dni, PDO::PARAM_INT);
    $sql->bindParam(":producto", $producto, PDO::PARAM_STR);
    $sql->bindParam(":color", $color, PDO::PARAM_STR);
    $sql->bindParam(":precio", $precio, PDO::PARAM_INT);
    $sql->bindParam(":estado", $estado, PDO::PARAM_STR);
    $sql->execute();
    $sql = null;

    // Redirect back to the main page
    header("Location: list.php");
    exit();
}

$sql = null;
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/assets/css/registrar.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap"
    rel="stylesheet">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>modificar</title>
</head>

<body>
    <div class="form">
        <form action="" method="post">
            <span class="title">MODIFICACION</span>
            <input type="hidden" name="id" required value="<?php echo htmlspecialchars($user['Id']); ?>">
            <span class="nombre">Nombre: <input type="text" id="nombre" name="nombre" required
                    value="<?php echo htmlspecialchars($user['nombre']); ?>" /></span>
            <span class="apellido">Apellido: <input type="text" placeholder="apellido" id="apellido" name="apellido"
                    required value="<?php echo htmlspecialchars($user['apellido']); ?>" /></span>
            <span class="dni">Dni: <input type="number" placeholder="dni" id="dni" name="dni" required
                    value="<?php echo htmlspecialchars($user['dni']); ?>" /></span>
            <span class="producto">Producto:
                <select name="producto" id="producto" required>
                    <option value="<?php echo htmlspecialchars($user['producto']); ?>" selected hidden>
                        <?php echo htmlspecialchars($user['producto']); ?></option>
                    <option value="cocodrilo">Cocodrilo</option>
                    <option value="dragon">Dragon</option>
                    <option value="pulpo">Pulpo</option>
                    <option value="ajolote">Ajolote</option>
                    <option value="custom">Custom</option>
                </select>
            </span>
            <span class="color">Color:
                <select name="color" id="color" required>
                    <option value="<?php echo htmlspecialchars($user['color']); ?>" selected hidden>
                        <?php echo htmlspecialchars($user['color']); ?></option>
                    <option value="negro">Negro</option>
                    <option value="gris">Gris</option>
                    <option value="violeta">Violeta</option>
                    <option value="verde">Verde</option>
                    <option value="custom">Custom</option>
                </select>
            </span>
            <span class="precio">precio: <input type="number" id="precio" name="price" required min="1"
                    value="<?php echo htmlspecialchars($user['precio']); ?>" /></span>
            <div class="entrega">
                <span>Entregado <input type="radio" name="entrega" value="entregado" /></span>
                <span>Pendiente <input type="radio" name="entrega" value="pendiente" checked /></span>
            </div>
            <div class="boton">
                <button class="atras"><a href="./list.php">ATRAS</a></button>
                <button type="submit" class="submit-button" name="update">SUBMIT</button>
            </div>
        </form>
    </div>
</body>

</html>